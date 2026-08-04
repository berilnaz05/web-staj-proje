<x-app-layout>

<div class="max-w-7xl mx-auto py-8 px-6">

    <h1 class="text-4xl font-bold mb-8">
        Eserler
    </h1>

    <div class="flex flex-col md:flex-row gap-4 mb-8">

        <input
            type="text"
            placeholder="Eser ara..."
            class="flex-1 border rounded-xl px-4 py-3">

        <select class="border rounded-xl px-4 py-3">
            <option>Tüm Türler</option>
            <option>Fantastik</option>
            <option>Romantik</option>
            <option>Aksiyon</option>
            <option>Bilim Kurgu</option>
            <option>Korku</option>
        </select>

        <a href="{{ route('artworks.create') }}"
           class="bg-purple-600 text-white px-5 py-3 rounded-xl text-center">
            + Yeni Eser
        </a>

    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">

        @forelse($artworks as $artwork)

        <a href="{{ route('artworks.show', $artwork->id) }}"
           class="group block">

            <div class="overflow-hidden rounded-xl shadow bg-white">

                @if($artwork->cover_image)

                    <img
                        src="{{ asset('storage/' . $artwork->cover_image) }}"
                        class="w-full h-72 object-cover group-hover:scale-105 transition duration-300">

                @else

                    <div class="w-full h-72 bg-gray-200 flex items-center justify-center text-gray-500">
                        Kapak Yok
                    </div>

                @endif

            </div>

            <h2 class="font-bold mt-3 truncate">
                {{ $artwork->title }}
            </h2>

            <p class="text-xs text-gray-400 mt-1">
                {{ $artwork->user->name ?? 'Bilinmeyen Kullanıcı' }}
            </p>

            <p class="text-sm text-gray-500 mt-1">
                {{ $artwork->chapters_count ?? 0 }} Bölüm
            </p>

            <span class="inline-block mt-2 text-xs bg-purple-100 text-purple-700 px-2 py-1 rounded-full">
                {{ $artwork->category->name ?? 'Tür Yok' }}
            </span>

            <div class="flex items-center gap-3 mt-2 text-sm text-gray-500">

                <span>👁 0</span>

                <span>❤️ 0</span>

                <span>💬 0</span>

            </div>

        </a>

        @empty

        <div class="col-span-6 text-center text-gray-500">
            Henüz eser yok.
        </div>

        @endforelse

    </div>

</div>

</x-app-layout>