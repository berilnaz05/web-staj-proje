<x-app-layout>

<div class="max-w-4xl mx-auto py-10 px-6">

    <h1 class="text-3xl font-bold mb-8">
        Bildirimler
    </h1>

    @forelse($requests as $request)

    <div class="bg-white p-5 rounded-xl shadow mb-4">

        <p class="mb-4">
            <strong>{{ $request->sender->name }}</strong>
            sana arkadaşlık isteği gönderdi.
        </p>

        <div class="flex gap-3">

            <form action="{{ route('friend.accept', $request->id) }}"
                  method="POST">
                @csrf

                <button class="bg-green-500 text-white px-4 py-2 rounded-lg">
                    Kabul Et
                </button>

            </form>

            <form action="{{ route('friend.reject', $request->id) }}"
                  method="POST">
                @csrf

                <button class="bg-red-500 text-white px-4 py-2 rounded-lg">
                    Reddet
                </button>

            </form>

        </div>

    </div>

    @empty

    <p class="text-gray-500">
        Yeni bildirimin yok.
    </p>

    @endforelse

</div>

</x-app-layout>