<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sanat Pazarı - ArtYum</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <a href="{{ url('/') }}"
               class="text-3xl font-bold text-purple-700">
                ArtYum
            </a>

            <a href="{{ url('/') }}"
               class="text-purple-600 font-medium hover:text-purple-800">
                Ana Sayfa
            </a>

        </div>
    </nav>

    <!-- Hero -->
    <section class="bg-gradient-to-r from-purple-600 to-pink-500 text-white py-20">

        <div class="max-w-7xl mx-auto px-6 text-center">

            <h1 class="text-5xl font-bold mb-6">
                ArtYum Sanat Pazarı
            </h1>

            <p class="text-xl max-w-3xl mx-auto">
                Yağlı boya tablolar, akrilik çalışmalar, dijital sanat eserleri,
                manga çizimleri ve özgün tasarımlar burada alıcılarıyla buluşuyor.
            </p>

        </div>

    </section>

    <!-- Kategoriler -->
    <section class="max-w-7xl mx-auto py-16 px-6">

        <h2 class="text-3xl font-bold text-center mb-10">
            Kategoriler
        </h2>

        <div class="grid md:grid-cols-4 gap-6">

            <div class="bg-white rounded-xl shadow p-6 text-center">
                <div class="text-5xl mb-4">🎨</div>
                <h3 class="font-bold text-lg">Yağlı Boya</h3>
            </div>

            <div class="bg-white rounded-xl shadow p-6 text-center">
                <div class="text-5xl mb-4">🖌️</div>
                <h3 class="font-bold text-lg">Akrilik</h3>
            </div>

            <div class="bg-white rounded-xl shadow p-6 text-center">
                <div class="text-5xl mb-4">💻</div>
                <h3 class="font-bold text-lg">Dijital Sanat</h3>
            </div>

            <div class="bg-white rounded-xl shadow p-6 text-center">
                <div class="text-5xl mb-4">📖</div>
                <h3 class="font-bold text-lg">Manga & Çizgi Roman</h3>
            </div>

        </div>

    </section>

    <!-- Satıştaki Eserler -->
    <section class="max-w-7xl mx-auto pb-16 px-6">

        <h2 class="text-3xl font-bold text-center mb-10">
            Satıştaki Eserler
        </h2>

        @if($products->count() > 0)

            <div class="grid md:grid-cols-3 gap-6">

                @foreach($products as $product)

                    <div class="bg-white rounded-xl shadow overflow-hidden">

                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}"
                                 class="w-full h-64 object-cover">
                        @else
                            <div class="h-64 bg-purple-100 flex items-center justify-center">
                                Görsel Yok
                            </div>
                        @endif

                        <div class="p-5">

                            <a href="{{ route('products.show',$product->id) }}"
                            class="font-bold text-lg hover:text-purple-600">
                            {{ $product->title }}
                            </a>

                            <p class="text-gray-500 text-sm mt-1">
                                Satıcı: {{ $product->user->name ?? 'Bilinmeyen Kullanıcı' }}
                            </p>

                            <p class="text-gray-600 mt-3">
                                {{ Str::limit($product->description, 100) }}
                            </p>

                            <div class="mt-5 flex justify-between items-center">

                                <span class="text-2xl font-bold text-purple-600">
                                    {{ number_format($product->price, 2, ',', '.') }} ₺
                                </span>

                                <a href="{{ route('products.show',$product->id) }}"
                                class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                                    İncele
                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="bg-white rounded-2xl shadow p-10 text-center">

                <div class="text-6xl mb-6">
                    🛍️
                </div>

                <h3 class="text-2xl font-bold text-gray-800 mb-4">
                    Henüz satışta eser bulunmuyor
                </h3>

                <p class="text-gray-600 max-w-xl mx-auto mb-8">
                    Sanat Pazarı yeni açıldı. İlk yağlı boya tablosunu,
                    akrilik çalışmayı veya dijital sanat eserini satışa
                    koyan kişi sen olabilirsin.
                </p>

                <a href="{{ route('dashboard') }}"
                   class="inline-block bg-purple-600 text-white px-6 py-3 rounded-xl hover:bg-purple-700">
                    Eser Yükle
                </a>

            </div>

        @endif

    </section>

    <!-- Bilgilendirme -->
    <section class="bg-white py-16">

        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-3xl font-bold text-center mb-10">
                Nasıl Çalışır?
            </h2>

            <div class="grid md:grid-cols-3 gap-6">

                <div class="text-center">
                    <div class="text-5xl mb-4">📤</div>
                    <h3 class="font-bold mb-2">Eserini Yükle</h3>
                    <p class="text-gray-600">
                        Çalışmanı paylaş ve satışa çıkar.
                    </p>
                </div>

                <div class="text-center">
                    <div class="text-5xl mb-4">💬</div>
                    <h3 class="font-bold mb-2">İlgi Topla</h3>
                    <p class="text-gray-600">
                        Topluluktan yorumlar ve geri bildirimler al.
                    </p>
                </div>

                <div class="text-center">
                    <div class="text-5xl mb-4">💰</div>
                    <h3 class="font-bold mb-2">Satış Yap</h3>
                    <p class="text-gray-600">
                        Eserlerini sanatseverlerle buluştur.
                    </p>
                </div>

            </div>

        </div>

    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">

        <div class="max-w-7xl mx-auto px-6 py-10 text-center">

            <h3 class="text-2xl font-bold mb-3">
                ArtYum
            </h3>

            <p class="text-gray-400">
                Sanatçılar ve sanatseverler için sosyal sanat platformu.
            </p>

            <div class="border-t border-gray-700 mt-6 pt-4 text-gray-400">
                © 2026 ArtYum. Tüm hakları saklıdır.
            </div>

        </div>

    </footer>

</body>
</html>
```
