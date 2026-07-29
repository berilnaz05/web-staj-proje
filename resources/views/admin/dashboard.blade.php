<x-app-layout>
    <div class="min-h-screen bg-gray-950 text-white">

        <div class="flex">

            <!-- Sol Menü -->
            <aside class="w-64 min-h-screen bg-gray-900 border-r border-gray-800">

                <div class="p-6">
                    <h1 class="text-3xl font-bold text-purple-400">
                        ArtYum
                    </h1>
                    <p class="text-gray-400 text-sm">
                        Admin Paneli
                    </p>
                </div>

                <nav class="px-4 space-y-2">

                    <a href="#" class="block p-3 rounded-xl bg-purple-600 hover:bg-purple-700">
                         Dashboard
                    </a>

                    <a href="{{ route('admin.kullanicilar') }}" class="block p-3 rounded-xl bg-purple-600 hover:bg-purple-700" >
                    Kullanıcılar
                    </a>

                    <a href="{{ route('admin.eserler') }}" class="block p-3 rounded-xl bg-purple-600 hover:bg-purple-700" >
                    Eserler
                    </a>

                    <a href="{{ route('admin.urunler') }}" class="block p-3 rounded-xl bg-purple-600 hover:bg-purple-700" >
                    Ürünler
                    </a>

                    <a href="{{ route('admin.sikayetler') }}" class="block p-3 rounded-xl bg-purple-600 hover:bg-purple-700" >
                    Şikayetler
                    </a>

                    <a href="{{ route('admin.yorumlar') }}" class="block p-3 rounded-xl bg-purple-600 hover:bg-purple-700" >
                    Yorumlar
                    </a>

                </nav>

            </aside>

            <!-- İçerik -->
            <main class="flex-1 p-8">

                <h2 class="text-4xl font-bold mb-8">
                    Hoş Geldin Admin 
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    <div class="bg-gray-900 p-6 rounded-2xl">
                        <h3 class="text-gray-400">Kullanıcılar</h3>
                        <p class="text-4xl font-bold mt-3">
                            {{ $userCount }}
                        </p>
                    </div>

                    <div class="bg-gray-900 p-6 rounded-2xl">
                        <h3 class="text-gray-400">Eserler</h3>
                        <p class="text-4xl font-bold mt-3">
                            {{ $artworkCount }}
                        </p>
                    </div>

                    <div class="bg-gray-900 p-6 rounded-2xl">
                        <h3 class="text-gray-400">Yorumlar</h3>
                        <p class="text-4xl font-bold mt-3">
                            {{ $commentCount }}
                        </p>
                    </div>

                    <div class="bg-gray-900 p-6 rounded-2xl">
                        <h3 class="text-gray-400">Şikayetler</h3>
                        <p class="text-4xl font-bold mt-3">
                            {{ $reportCount }}
                        </p>
                    </div>

                </div>

            </main>

        </div>

    </div>
</x-app-layout>