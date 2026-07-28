<x-app-layout>

<div class="min-h-screen bg-gray-100">

    <!-- Üst Navbar -->
    

        <nav class="bg-white shadow">

    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <div class="flex items-center gap-10">

            <div class="hidden md:flex items-center gap-6 text-gray-700 font-medium">

                <a href="#" class="hover:text-purple-600">
                    Keşfet
                </a>

                <a href="{{ route('sanat-pazari') }}"
                   class="hover:text-purple-600">
                    Sanat Pazarı
                </a>

                <a href="#" class="hover:text-purple-600">
                    Eserler
                </a>

            </div>

        </div>

        <div class="flex items-center gap-6 text-xl">

            <a href="#" class="relative">
                👥
                <span class="absolute -top-2 -right-3 bg-red-500 text-white text-xs px-2 rounded-full">
                    2
                </span>
            </a>

            <a href="#" class="relative">
                🔔
                <span class="absolute -top-2 -right-3 bg-red-500 text-white text-xs px-2 rounded-full">
                    5
                </span>
            </a>

            <a href="#" class="relative">
                ✉️
                <span class="absolute -top-2 -right-3 bg-red-500 text-white text-xs px-2 rounded-full">
                    1
                </span>
            </a>

            <a href="{{ route('profile.edit') }}">
                👤
            </a>

        </div>

    </div>

</nav>

    

    <!-- Ana Alan -->
    <div class="max-w-7xl mx-auto px-6 py-8">

        <div class="grid grid-cols-12 gap-6">

            <!-- Sol Menü -->
            <div class="col-span-12 md:col-span-3">

                <div class="bg-white rounded-xl shadow p-5">

                    <a href="{{ route('products.create') }}"
                    class="block w-full text-center bg-purple-600 text-white py-3 rounded-lg mb-6 hover:bg-purple-700">
                    + Ürün Sat
                    </a>

                    <div class="space-y-3">

                        <a href="{{ route('urunlerim') }}" class="block p-3 rounded-lg hover:bg-gray-100">
                             Ürünlerim
                        </a>

                        <a href="#" class="block p-3 rounded-lg hover:bg-gray-100">
                             Eserlerim
                        </a>

                        <a href={{route("sanat-pazari")}} class="block p-3 rounded-lg hover:bg-gray-100">
                             Sanat Pazarım
                        </a>

                        <a href="#" class="block p-3 rounded-lg hover:bg-gray-100">
                             Arkadaşlar
                        </a>

                        <a href="#" class="block p-3 rounded-lg hover:bg-gray-100">
                             Mesajlar
                        </a>

                        <a href="#" class="block p-3 rounded-lg hover:bg-gray-100">
                             Beğendiklerim
                        </a>

                        <a href="{{ route('profile.edit') }}"
                           class="block p-3 rounded-lg hover:bg-gray-100">
                             Ayarlar
                        </a>

                    </div>

                </div>

            </div>

            <!-- İçerik -->
            <div class="col-span-12 md:col-span-9">

                <div class="mb-10">

                    <h2 class="text-2xl font-bold mb-6">
                        Son Eklenen Eserler
                    </h2>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                        @forelse($artworks as $artwork)

                            <div class="bg-white rounded-xl shadow overflow-hidden">

                                <img
                                    src="{{ asset('storage/' . $artwork->image) }}"
                                    class="w-full h-56 object-cover"
                                >

                                <div class="p-4">

                                    <h3 class="font-bold text-lg">
                                        {{ $artwork->title }}
                                    </h3>

                                    <p class="text-gray-500 text-sm mt-2">
                                        {{ $artwork->user->name ?? 'Sanatçı' }}
                                    </p>

                                    <div class="flex gap-4 mt-3 text-sm text-gray-500">
                                        <span> 0</span>
                                        <span> 0</span>
                                    </div>

                                </div>

                            </div>

                        @empty

                            <div class="col-span-3 text-center text-gray-500">
                                Henüz eser paylaşılmamış.
                            </div>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</x-app-layout>