<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LandingController extends Controller
{
    public function index()
    {
        // Scraping Berita (Cache 1 menit)
        $beritaKompasiana = Cache::remember('kompasiana_berita_v6', 60, function () {
            return $this->scrapeKompasiana();
        });

        $highlight = $beritaKompasiana->first();
        $beritas = $beritaKompasiana->skip(1)->take(4);

        return view('welcome', compact('highlight', 'beritas'));
    }

    /**
     * Main scraping function
     */
    public function scrapeKompasiana()
    {
        $url = 'https://www.kompasiana.com/rezanaagustyan8132';
        
        try {
            \Log::info("Starting Kompasiana scraping: {$url}");
            
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
                'Accept-Language' => 'id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7',
                'Accept-Encoding' => 'gzip, deflate, br',
                'Connection' => 'keep-alive',
                'Referer' => 'https://www.kompasiana.com/',
                'Cache-Control' => 'no-cache',
            ])->withoutVerifying()->timeout(30)->get($url);

            if ($response->failed()) {
                \Log::error("Kompasiana request failed: HTTP {$response->status()}");
                return collect([]);
            }

            \Log::info("Kompasiana request success: HTTP {$response->status()}");

            $html = $response->body();
            $crawler = new Crawler($html);
            $data = [];

            // Scraping dengan pendekatan yang lebih spesifik
            // Kompasiana menggunakan struktur dengan div yang berisi link artikel
            
            // Cari semua link artikel dari profile
            $articleLinks = [];
            $crawler->filter('a')->each(function (Crawler $node) use (&$articleLinks) {
                $href = $node->attr('href');
                
                // Filter: hanya link artikel dengan pattern /rezanaagustyan8132/{ID}/
                if (preg_match('/\/rezanaagustyan8132\/([a-f0-9]{24})\/([^\/\?]+)/', $href, $matches)) {
                    $articleId = $matches[1];
                    $slug = $matches[2];
                    
                    // Buat link lengkap jika relatif
                    $fullLink = strpos($href, 'http') === false 
                        ? 'https://www.kompasiana.com' . $href 
                        : $href;
                    
                    $articleLinks[$articleId] = [
                        'link' => $fullLink,
                        'id' => $articleId,
                        'slug' => $slug
                    ];
                }
            });

            \Log::info("Found " . count($articleLinks) . " unique article links");

            // Sekarang scraping detail setiap artikel
            foreach (array_slice($articleLinks, 0, 10) as $articleId => $articleInfo) {
                try {
                    $articleData = $this->scrapeArticleDetail($articleInfo['link'], $articleId, $articleInfo['slug']);
                    if ($articleData) {
                        $data[] = $articleData;
                    }
                } catch (\Exception $e) {
                    \Log::error("Error scraping article {$articleId}: " . $e->getMessage());
                    continue;
                }
            }

            \Log::info("Successfully scraped " . count($data) . " articles");

            // Sort by date (newest first)
            return collect($data)->sortByDesc(function($item) {
                return strtotime($item['tanggal_raw'] ?? $item['tanggal']);
            })->values();

        } catch (\Exception $e) {
            \Log::error("Kompasiana scraping error: " . $e->getMessage());
            return collect([]);
        }
    }

    /**
     * Scrape detail artikel individual
     */
    private function scrapeArticleDetail(string $url, string $articleId, string $slug)
    {
        try {
            // Request ke halaman artikel
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
            ])->withoutVerifying()->timeout(15)->get($url);

            if ($response->failed()) {
                return null;
            }

            $html = $response->body();
            $crawler = new Crawler($html);

            // Extract judul
            $judul = '';
            $judulSelectors = [
                'h1.article__title',
                'h1.post__title', 
                'h1[itemprop="headline"]',
                'h1.title',
                'h1'
            ];
            
            foreach ($judulSelectors as $selector) {
                try {
                    $node = $crawler->filter($selector)->first();
                    if ($node->count() > 0) {
                        $judul = trim($node->text());
                        if (strlen($judul) > 10) break;
                    }
                } catch (\Exception $e) {
                    continue;
                }
            }

            if (empty($judul)) {
                // Fallback: ambil dari title tag
                $titleNode = $crawler->filter('title')->first();
                $judul = $titleNode->count() > 0 ? trim($titleNode->text()) : $slug;
                $judul = str_replace(' - Kompasiana.com', '', $judul);
            }

            // Extract gambar dengan prioritas CDN assets.kompasiana.com
            $gambar = $this->extractImageFromArticle($crawler, $articleId);

            // Extract tanggal dengan berbagai metode
            $tanggalData = $this->extractDateFromArticle($crawler);

            // Extract excerpt/ringkasan
            $ringkasan = $this->extractExcerptFromArticle($crawler, $judul);

            return [
                'judul' => $judul,
                'link' => $url,
                'kategori' => 'Lapas Besi',
                'gambar' => $gambar,
                'ringkasan' => $ringkasan,
                'tanggal' => $tanggalData['formatted'],
                'tanggal_raw' => $tanggalData['raw'],
            ];

        } catch (\Exception $e) {
            \Log::error("Error scraping article detail: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Extract gambar dari artikel
     * Prioritas: assets.kompasiana.com CDN
     */
    private function extractImageFromArticle(Crawler $crawler, string $articleId)
    {
        $gambar = '';

        // METHOD 1: Cari gambar dari meta tags (paling reliable)
        $metaSelectors = [
            'meta[property="og:image"]',
            'meta[name="twitter:image"]',
            'meta[itemprop="image"]',
        ];

        foreach ($metaSelectors as $selector) {
            try {
                $node = $crawler->filter($selector)->first();
                if ($node->count() > 0) {
                    $gambar = $node->attr('content');
                    if (!empty($gambar) && strpos($gambar, 'assets.kompasiana.com') !== false) {
                        \Log::info("Image found from meta tag: {$gambar}");
                        return $gambar;
                    }
                }
            } catch (\Exception $e) {
                continue;
            }
        }

        // METHOD 2: Cari gambar dari article body
        $imgSelectors = [
            '.article__asset img',
            '.article__body img',
            '.post__content img',
            'article img',
            '.content img'
        ];

        foreach ($imgSelectors as $selector) {
            try {
                $node = $crawler->filter($selector)->first();
                if ($node->count() > 0) {
                    $src = $node->attr('src') 
                        ?? $node->attr('data-src') 
                        ?? $node->attr('data-lazy-src')
                        ?? '';
                    
                    if (!empty($src)) {
                        // Pastikan URL lengkap
                        if (strpos($src, 'http') === false) {
                            $src = 'https://www.kompasiana.com' . $src;
                        }
                        
                        // Prioritas gambar dari assets.kompasiana.com
                        if (strpos($src, 'assets.kompasiana.com') !== false) {
                            \Log::info("Image found from article body: {$src}");
                            return $src;
                        }
                        
                        // Simpan sebagai fallback
                        if (empty($gambar)) {
                            $gambar = $src;
                        }
                    }
                }
            } catch (\Exception $e) {
                continue;
            }
        }

        // METHOD 3: Fallback - konstruksi URL gambar
        if (empty($gambar)) {
            $gambar = "https://www.kompasiana.com/image/rezanaagustyan8132/{$articleId}?page=1";
            \Log::info("Using constructed image URL: {$gambar}");
        }

        return $gambar;
    }

    /**
     * Extract tanggal dari artikel
     */
    private function extractDateFromArticle(Crawler $crawler)
    {
        $tanggal = '';
        $tanggalRaw = '';

        // METHOD 1: Dari meta tags
        $metaSelectors = [
            'meta[property="article:published_time"]',
            'meta[name="publish-date"]',
            'meta[itemprop="datePublished"]',
        ];

        foreach ($metaSelectors as $selector) {
            try {
                $node = $crawler->filter($selector)->first();
                if ($node->count() > 0) {
                    $tanggalRaw = $node->attr('content');
                    if (!empty($tanggalRaw)) {
                        \Log::info("Date found from meta: {$tanggalRaw}");
                        break;
                    }
                }
            } catch (\Exception $e) {
                continue;
            }
        }

        // METHOD 2: Dari tag <time>
        if (empty($tanggalRaw)) {
            try {
                $timeNode = $crawler->filter('time[datetime]')->first();
                if ($timeNode->count() > 0) {
                    $tanggalRaw = $timeNode->attr('datetime');
                    \Log::info("Date found from time tag: {$tanggalRaw}");
                }
            } catch (\Exception $e) {
                // Continue
            }
        }

        // METHOD 3: Dari text dengan class date
        if (empty($tanggalRaw)) {
            $dateSelectors = [
                '.article__date',
                '.post__date',
                '.publish-date',
                'time',
                '.date'
            ];

            foreach ($dateSelectors as $selector) {
                try {
                    $node = $crawler->filter($selector)->first();
                    if ($node->count() > 0) {
                        $tanggalRaw = trim($node->text());
                        if (!empty($tanggalRaw)) {
                            \Log::info("Date found from text: {$tanggalRaw}");
                            break;
                        }
                    }
                } catch (\Exception $e) {
                    continue;
                }
            }
        }

        // Format tanggal
        $tanggalFormatted = $this->formatIndonesianDate($tanggalRaw);

        return [
            'raw' => $tanggalRaw,
            'formatted' => $tanggalFormatted
        ];
    }

    /**
     * Format tanggal ke bahasa Indonesia
     */
    private function formatIndonesianDate(?string $dateString)
    {
        if (empty($dateString)) {
            return now()->locale('id')->translatedFormat('d F Y');
        }

        try {
            // Parse berbagai format tanggal
            $date = null;
            
            // ISO 8601 format (dari meta tags)
            if (preg_match('/^\d{4}-\d{2}-\d{2}/', $dateString)) {
                $date = Carbon::parse($dateString);
            }
            // Format Indonesia (e.g., "08 Desember 2024")
            else if (preg_match('/\d{1,2}\s+\w+\s+\d{4}/', $dateString)) {
                $date = Carbon::createFromFormat('d F Y', $dateString, 'Asia/Jakarta');
            }
            // Format alternatif
            else {
                $date = Carbon::parse($dateString);
            }

            if ($date) {
                // Format ke bahasa Indonesia
                return $date->locale('id')->translatedFormat('d F Y');
            }

        } catch (\Exception $e) {
            \Log::warning("Date parsing failed for: {$dateString} - " . $e->getMessage());
        }

        // Fallback: return string as-is atau tanggal hari ini
        return strlen($dateString) > 5 
            ? $dateString 
            : now()->locale('id')->translatedFormat('d F Y');
    }

    /**
     * Extract ringkasan dari artikel
     */
    private function extractExcerptFromArticle(Crawler $crawler, string $judul)
    {
        $ringkasan = '';

        // Coba dari meta description
        try {
            $metaNode = $crawler->filter('meta[name="description"]')->first();
            if ($metaNode->count() > 0) {
                $ringkasan = $metaNode->attr('content');
            }
        } catch (\Exception $e) {
            // Continue
        }

        // Coba dari excerpt class
        if (empty($ringkasan)) {
            $excerptSelectors = [
                '.article__excerpt',
                '.post__excerpt',
                'p.excerpt'
            ];

            foreach ($excerptSelectors as $selector) {
                try {
                    $node = $crawler->filter($selector)->first();
                    if ($node->count() > 0) {
                        $ringkasan = trim($node->text());
                        if (strlen($ringkasan) > 20) break;
                    }
                } catch (\Exception $e) {
                    continue;
                }
            }
        }

        // Fallback: gunakan judul
        if (empty($ringkasan) || strlen($ringkasan) < 20) {
            $ringkasan = $judul;
        }

        return Str::limit($ringkasan, 150);
    }

    /**
     * Clear cache
     */
    public function clearCache()
    {
        Cache::forget('kompasiana_berita_v6');
        return redirect()->back()->with('success', 'Cache berita berhasil dibersihkan');
    }

    /**
     * Debug scraping
     */
    public function debugScraping()
    {
        if (!app()->environment('local')) {
            abort(403);
        }

        Cache::forget('kompasiana_berita_v6');
        $berita = $this->scrapeKompasiana();

        return response()->json([
            'total' => $berita->count(),
            'data' => $berita->toArray()
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}