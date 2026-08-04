<x-app-layout>

<div class="max-w-5xl mx-auto py-10 px-6">

    <div class="bg-white rounded-2xl shadow overflow-hidden">

        @if($artwork->cover_image)

            <img
                src="{{ asset('storage/'.$artwork->cover_image) }}"
                class="w-full h-96 object-cover">

        @endif

        <div class="p-8">

            <h1 class="text-4xl font-bold">
                {{ $artwork->title }}
            </h1>

            <p class="text-gray-500 mt-2">
                {{ $artwork->user->name ?? 'Bilinmeyen Kullanıcı' }}
            </p>

            <p class="mt-6">
                {{ $artwork->description }}
            </p>

            @if(auth()->id() == $artwork->user_id)

                <div class="flex gap-3 mt-8">

                    <a href="{{ route('artworks.edit', $artwork->id) }}"
                       class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                        Düzenle
                    </a>

                    <form
                        action="{{ route('artworks.destroy', $artwork->id) }}"
                        method="POST"
                        class="inline">

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            onclick="return confirm('Bu eseri silmek istediğine emin misin?')"
                            class="bg-red-500 text-white px-4 py-2 rounded-lg">

                            Sil

                        </button>

                    </form>

                </div>

            @endif

        </div>

    </div>

</div>

</x-app-layout>