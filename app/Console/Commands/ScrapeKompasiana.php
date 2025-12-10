<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\LandingController;

class ScrapeKompasiana extends Command
{
    protected $signature = 'scrape:kompasiana 
                            {--fresh : Clear cache before scraping}
                            {--detail : Show detailed information}';
    
    protected $description = 'Test scraping Kompasiana articles';

    public function handle()
    {
        $this->info('╔═══════════════════════════════════════════════╗');
        $this->info('║   🚀 Kompasiana Scraping Test Tool          ║');
        $this->info('╚═══════════════════════════════════════════════╝');
        $this->newLine();

        if ($this->option('fresh')) {
            Cache::forget('kompasiana_berita_v6');
            $this->warn('🗑️  Cache cleared');
        }

        $this->info('📡 Starting scraping process...');
        $this->newLine();

        $controller = new LandingController();
        
        // Use reflection to call private method
        $reflection = new \ReflectionClass($controller);
        $method = $reflection->getMethod('scrapeKompasiana');
        $method->setAccessible(true);

        $startTime = microtime(true);
        $articles = $method->invoke($controller);
        $endTime = microtime(true);

        $duration = round($endTime - $startTime, 2);

        $this->newLine();
        
        if ($articles->isEmpty()) {
            $this->error('❌ No articles found!');
            $this->warn('💡 Possible issues:');
            $this->line('   • Network connection problem');
            $this->line('   • Kompasiana blocked the request');
            $this->line('   • HTML structure changed');
            $this->newLine();
            $this->info('📋 Check logs: storage/logs/laravel.log');
            return 1;
        }

        $this->info("✅ Success! Found {$articles->count()} articles");
        $this->info("⏱️  Duration: {$duration}s");
        $this->newLine();

        // Display summary table
        $tableData = $articles->map(function($article, $index) {
            return [
                $index + 1,
                \Illuminate\Support\Str::limit($article['judul'], 50),
                $article['tanggal'],
                parse_url($article['gambar'], PHP_URL_HOST) ?? 'Invalid URL'
            ];
        });

        $this->table(
            ['#', 'Judul', 'Tanggal', 'Gambar Host'],
            $tableData
        );

        // Detailed view if requested
        if ($this->option('detail')) {
            $this->newLine();
            $this->info('📄 Detailed Information:');
            $this->newLine();

            foreach ($articles as $index => $article) {
                $this->line("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
                $this->info("Article #" . ($index + 1));
                $this->line("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
                $this->line("<fg=cyan>Judul:</> {$article['judul']}");
                $this->line("<fg=cyan>Tanggal:</> {$article['tanggal']} ({$article['tanggal_raw']})");
                $this->line("<fg=cyan>Link:</> {$article['link']}");
                $this->line("<fg=cyan>Gambar:</> {$article['gambar']}");
                $this->line("<fg=cyan>Ringkasan:</> {$article['ringkasan']}");
                $this->newLine();

                // Test if image URL is accessible
                $this->line("<fg=yellow>Testing image URL...</>");
                $imageCheck = $this->checkImageUrl($article['gambar']);
                if ($imageCheck['valid']) {
                    $this->info("  ✅ Image accessible (HTTP {$imageCheck['status']})");
                } else {
                    $this->error("  ❌ Image not accessible: {$imageCheck['error']}");
                }
                $this->newLine();
            }
        }

        $this->newLine();
        $this->info('╔═══════════════════════════════════════════════╗');
        $this->info('║   ✨ Scraping Complete!                      ║');
        $this->info('╚═══════════════════════════════════════════════╝');

        return 0;
    }

    /**
     * Check if image URL is accessible
     */
    private function checkImageUrl(string $url): array
    {
        try {
            $response = \Illuminate\Support\Facades\Http::timeout(5)->head($url);
            return [
                'valid' => $response->successful(),
                'status' => $response->status(),
                'error' => null
            ];
        } catch (\Exception $e) {
            return [
                'valid' => false,
                'status' => null,
                'error' => $e->getMessage()
            ];
        }
    }
}