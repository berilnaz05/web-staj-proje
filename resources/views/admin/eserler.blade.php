<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">
                     Eser Yönetimi
                </h1>
                <p class="text-gray-500 mt-2">
                    Sistemde kayıtlı eserler
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($artworks as $artwork)

                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition">

                    @if($artwork->cover_image)
                        <img
                            src="{{ asset('storage/'.$artwork->cover_image) }}"
                            alt="{{ $artwork->title }}"
                            class="w-full h-56 object-cover"
                        >
                    @else
                        <div class="w-full h-56 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">
                                Görsel Yok
                            </span>
                        </div>
                    @endif

                    <div class="p-5">

                        <h2 class="text-xl font-bold text-gray-800 mb-2">
                            {{ $artwork->title }}
                        </h2>

                        <p class="text-gray-600 mb-4">
                            {{ Str::limit($artwork->description, 120) }}
                        </p>

                        <div class="text-sm text-gray-500">
                            Eser ID: {{ $artwork->id }}
                        </div>

                    </div>

                </div>

            @empty

                <div class="col-span-full">
                    <div class="bg-white rounded-xl shadow p-10 text-center">
                        <h2 class="text-2xl font-semibold">
                            Henüz eser bulunmuyor
                        </h2>
                    </div>
                </div>

            @endforelse

        </div>

    </div>
</x-app-layout>