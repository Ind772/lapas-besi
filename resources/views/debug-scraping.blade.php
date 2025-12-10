<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug Scraping Kompasiana</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h1 class="text-3xl font-bold mb-4">Debug Scraping Kompasiana</h1>
            
            <div class="flex gap-4 mb-6">
                <a href="/test-scraping" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    <i class="fas fa-refresh"></i> Refresh Scraping
                </a>
                <a href="/clear-berita-cache" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    <i class="fas fa-trash"></i> Clear Cache
                </a>
                <a href="/" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    <i class="fas fa-home"></i> Kembali ke Home
                </a>
            </div>

            @if($berita && $berita->count() > 0)
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <strong>Berhasil!</strong> Ditemukan {{ $berita->count() }} artikel.
                </div>

                <div class="space-y-4">
                    @foreach($berita as $index => $item)
                        <div class="border rounded-lg p-4 hover:shadow-lg transition">
                            <div class="flex gap-4">
                                <div class="flex-shrink-0">
                                    <img src="{{ $item['gambar'] }}" 
                                         alt="{{ $item['judul'] }}"
                                         class="w-32 h-32 object-cover rounded"
                                         onerror="this.src='https://via.placeholder.com/150?text=No+Image'">
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-start justify-between mb-2">
                                        <span class="bg-yellow-500 text-slate-900 text-xs font-bold px-2 py-1 rounded">
                                            #{{ $index + 1 }}
                                        </span>
                                        <span class="text-sm text-gray-500">{{ $item['tanggal'] }}</span>
                                    </div>
                                    <h3 class="font-bold text-lg mb-2">{{ $item['judul'] }}</h3>
                                    <p class="text-gray-600 text-sm mb-2">{{ $item['ringkasan'] }}</p>
                                    <div class="flex gap-4 text-xs text-gray-500">
                                        <a href="{{ $item['link'] }}" target="_blank" class="text-blue-600 hover:underline">
                                            🔗 Buka Artikel
                                        </a>
                                        <a href="{{ $item['gambar'] }}" target="_blank" class="text-blue-600 hover:underline">
                                            🖼️ Lihat Gambar
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Debug -->
                            <details class="mt-4">
                                <summary class="cursor-pointer text-sm text-gray-600 hover:text-gray-800">
                                    🔍 Lihat Data Raw
                                </summary>
                                <pre class="bg-gray-100 p-3 rounded mt-2 text-xs overflow-x-auto">{{ json_encode($item, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                            </details>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <strong>Gagal!</strong> Tidak ada artikel yang berhasil di-scrape.
                    <p class="mt-2 text-sm">Kemungkinan penyebab:</p>
                    <ul class="list-disc ml-6 text-sm mt-2">
                        <li>Kompasiana memblokir request dari server</li>
                        <li>Struktur HTML Kompasiana berubah</li>
                        <li>Koneksi internet bermasalah</li>
                        <li>URL profile tidak valid</li>
                    </ul>
                </div>

                <div class="mt-4 p-4 bg-gray-100 rounded">
                    <h3 class="font-bold mb-2">Langkah Troubleshooting:</h3>
                    <ol class="list-decimal ml-6 space-y-2 text-sm">
                        <li>Jalankan <code class="bg-white px-2 py-1 rounded">php artisan cache:clear</code></li>
                        <li>Akses <code class="bg-white px-2 py-1 rounded">/debug-scraping</code> untuk download HTML</li>
                        <li>Cek file <code class="bg-white px-2 py-1 rounded">storage/logs/kompasiana_debug.html</code></li>
                        <li>Cek log Laravel di <code class="bg-white px-2 py-1 rounded">storage/logs/laravel.log</code></li>
                    </ol>
                </div>
            @endif
        </div>

        <!-- Info Tambahan -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <h3 class="font-bold mb-2">📌 Informasi</h3>
            <ul class="text-sm space-y-1">
                <li><strong>Cache Key:</strong> kompasiana_berita_v6</li>
                <li><strong>Cache Duration:</strong> 10 menit (600 detik)</li>
                <li><strong>Source URL:</strong> <a href="https://www.kompasiana.com/rezanaagustyan8132" target="_blank" class="text-blue-600 hover:underline">https://www.kompasiana.com/rezanaagustyan8132</a></li>
                <li><strong>Environment:</strong> {{ app()->environment() }}</li>
            </ul>
        </div>
    </div>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</body>
</html>