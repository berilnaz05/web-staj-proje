<x-app-layout>

<div class="max-w-4xl mx-auto py-10 px-6">

    <h1 class="text-3xl font-bold mb-8">
        Arkadaşlık İstekleri
    </h1>

    @forelse($requests as $request)

    <div class="bg-white shadow rounded-xl p-5 mb-4">

        <h2 class="font-bold">
            {{ $request->sender->name }}
        </h2>

        <div class="flex gap-3 mt-4">

            <form
                action="{{ route('friend.accept',$request->id) }}"
                method="POST">

                @csrf

                <button
                    class="bg-green-600 text-white px-4 py-2 rounded-lg">

                    Kabul Et
                </button>

            </form>

            <form
                action="{{ route('friend.reject',$request->id) }}"
                method="POST">

                @csrf

                <button
                    class="bg-red-600 text-white px-4 py-2 rounded-lg">

                    Reddet
                </button>

            </form>

        </div>

    </div>

    @empty

    <p>Bekleyen arkadaşlık isteği yok.</p>

    @endforelse

</div>

</x-app-layout>