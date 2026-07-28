<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtYum</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <h1 class="text-3xl font-bold text-purple-700">
                ArtYum
            </h1>

            <div class="hidden md:flex space-x-8 text-gray-700 font-medium">
                <a href="#anasayfa" class="hover:text-purple-600">Ana Sayfa</a>
                <a href="#eserler" class="hover:text-purple-600">Eserler</a>
                <a href="{{ route('sanat-pazari') }}"
                class="hover:text-purple-600">
                Sanat Pazarı </a>

                <a href="#topluluk" class="hover:text-purple-600">Topluluk</a>
                <a href="#hakkimizda" class="hover:text-purple-600">Hakkımızda</a>
                <a href="#iletisim" class="hover:text-purple-600">İletişim</a>
            </div>

            <div>
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="mr-3 text-gray-700">
                        Giriş Yap
                    </a>

                    <a href="{{ route('register') }}"
                       class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                        Kayıt Ol
                    </a>
                @endauth
            </div>

        </div>
    </nav>

    <!-- Hero -->
    <section id="anasayfa"
        class="text-center py-24 bg-gradient-to-r from-purple-600 to-pink-500 text-white">

        <h2 class="text-6xl font-bold mb-6">
            ArtYum
        </h2>

        <p class="text-xl mb-8">
            Sanatını dünyayla paylaş, keşfet ve ilham al.
        </p>

        <div class="flex justify-center gap-4">
            <a href="{{ route('register') }}"
               class="bg-white text-purple-700 px-6 py-3 rounded-xl font-semibold">
                Hemen Katıl
            </a>

            <a href="#eserler"
               class="border border-white px-6 py-3 rounded-xl">
                Eserleri Keşfet
            </a>
        </div>

    </section>

    <!-- Özellikler -->
    <section id="hakkimizda" class="max-w-7xl mx-auto py-16 px-6">

        <h3 class="text-3xl font-bold mb-3 text-center">
            Neden ArtYum?
        </h3>

        <p class="text-center text-gray-600 mb-10">
            Sanatçılar ve sanatseverler için oluşturulmuş yaratıcı bir topluluk.
        </p>

        <div class="grid md:grid-cols-3 gap-6">

            <div class="bg-white p-8 rounded-xl shadow text-center">
                <div class="text-5xl mb-4"></div>
                <h4 class="font-bold text-xl mb-2">Eserlerini Sergile</h4>
                <p class="text-gray-600">
                    Çizimlerini, tablolarını ve dijital çalışmalarını paylaş.
                </p>
            </div>

            <div class="bg-white p-8 rounded-xl shadow text-center">
                <div class="text-5xl mb-4"></div>
                <h4 class="font-bold text-xl mb-2">Geri Bildirim Al</h4>
                <p class="text-gray-600">
                    Topluluktan yorumlar alarak gelişimini sürdür.
                </p>
            </div>

            <div class="bg-white p-8 rounded-xl shadow text-center">
                <div class="text-5xl mb-4"></div>
                <h4 class="font-bold text-xl mb-2">Sanatçılarla Tanış</h4>
                <p class="text-gray-600">
                    Yeni arkadaşlar edin ve ortak projeler üret.
                </p>
            </div>

        </div>

    </section>

    <!-- Sanat Pazarı -->
    <section id="sanatpazari" class="max-w-7xl mx-auto py-16 px-6">

    <h3 class="text-3xl font-bold text-center mb-10">
        Sanat Pazarı
    </h3>


    <div class="grid md:grid-cols-3 gap-6">

        @forelse($products as $product)

            <div class="bg-white rounded-xl shadow overflow-hidden">

                <img src="{{ asset('storage/'.$product->image) }}"
                     class="w-full h-56 object-cover">


                <div class="p-5">

                    <h4 class="font-bold text-lg">
                        {{ $product->title }}
                    </h4>


                    <p class="text-gray-500 text-sm mt-2">
                        {{ $product->category }}
                    </p>


                    <p class="text-purple-600 font-bold mt-3">
                        {{ number_format($product->price, 2, ',', '.') }} ₺
                    </p>


                    <a href="{{ route('products.show',$product->id) }}"
                       class="block text-center mt-4 bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700">
                        İncele
                    </a>


                </div>

            </div>


        @empty

            <p class="text-center text-gray-500 col-span-3">
                Henüz satışta ürün bulunmuyor.
            </p>

        @endforelse


    </div>

</section>

    <!-- Son Eklenen Eserler -->
    <section id="eserler" class="max-w-7xl mx-auto py-16 px-6">

        <h3 class="text-3xl font-bold text-center mb-10">
            Son Eklenen Eserler
        </h3>

        <div class="grid md:grid-cols-3 gap-6">

            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="h-56 bg-purple-200"></div>
                <div class="p-5">
                    <h4 class="font-bold text-lg">Gün Batımı</h4>
                    <p class="text-gray-600">Yağlı boya manzara çalışması.</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="h-56 bg-pink-200"></div>
                <div class="p-5">
                    <h4 class="font-bold text-lg">Portre Çalışması</h4>
                    <p class="text-gray-600">Dijital sanat örneği.</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="h-56 bg-indigo-200"></div>
                <div class="p-5">
                    <h4 class="font-bold text-lg">Fantastik Dünya</h4>
                    <p class="text-gray-600">Konsept tasarım çalışması.</p>
                </div>
            </div>

        </div>

    </section>

    <!-- Footer -->
    <footer id="iletisim" class="bg-gray-900 text-white mt-16">

        <div class="max-w-7xl mx-auto px-6 py-10">

            <div class="grid md:grid-cols-3 gap-8">

                <div>
                    <h4 class="text-xl font-bold mb-3">
                        ArtYum
                    </h4>

                    <p class="text-gray-400">
                        Sanatçılar ve sanatseverler için oluşturulmuş sosyal sanat platformu.
                    </p>
                </div>

                <div>
                    <h4 class="text-xl font-bold mb-3">
                        Hızlı Bağlantılar
                    </h4>

                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#anasayfa">Ana Sayfa</a></li>
                        <li><a href="#eserler">Eserler</a></li>
                        
                        <li><a href="#topluluk">Topluluk</a></li>
                        <li><a href="#iletisim">İletişim</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xl font-bold mb-3">
                        İletişim
                    </h4>

                    <p class="text-gray-400">artyum@gmail.com</p>
                    <p class="text-gray-400">Türkiye</p>
                </div>

            </div>

            <div class="border-t border-gray-700 mt-8 pt-4 text-center text-gray-400">
                © 2026 ArtYum. Tüm hakları saklıdır.
            </div>

        </div>

    </footer>

</body>
</html>