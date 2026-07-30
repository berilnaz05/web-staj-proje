<x-app-layout>

@if(session('success'))

<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
    {{ session('success') }}
</div>

@endif

<div class="max-w-6xl mx-auto py-10 px-6">

    <h1 class="text-3xl font-bold mb-8">
        "{{ $q }}" için sonuçlar
    </h1>

    {{-- Kullanıcılar --}}
{{-- Kullanıcılar --}}
<h2 class="text-2xl font-bold mb-4">
    Kullanıcılar
</h2>

@forelse($users as $user)

<div class="bg-white p-4 rounded-xl shadow mb-3 flex justify-between items-center">

    <div>
        <div class="font-bold">
            👤 {{ $user->name }}
        </div>

        <div class="text-sm text-gray-500">
            
        </div>
    </div>

    <div class="flex gap-2">

        @if($user->id != auth()->id())

        <form action="{{ route('friend.send', $user->id) }}"
              method="POST">

            @csrf

            <button
                class="bg-green-500 text-white px-4 py-2 rounded-lg">

                Arkadaş Ekle

            </button>

        </form>

        @endif

    </div>

</div>

@empty

<p class="text-gray-500">
    Kullanıcı bulunamadı.
</p>

@endforelse


    {{-- Ürünler --}}
    <h2 class="text-2xl font-bold mb-4 mt-10">
        Ürünler
    </h2>

    @forelse($products as $product)

        <a href="{{ route('products.show',$product->id) }}"
           class="block bg-white p-4 rounded-xl shadow mb-3">

            🛍️ {{ $product->title }}

            <div class="text-purple-600 font-bold">
                {{ $product->price }} ₺
            </div>

        </a>

    @empty

        <p class="text-gray-500 mb-6">
            Ürün bulunamadı.
        </p>

    @endforelse


    {{-- Eserler --}}
    <h2 class="text-2xl font-bold mb-4 mt-10">
        Eserler
    </h2>

    @forelse($artworks as $artwork)

        <div class="bg-white p-4 rounded-xl shadow mb-3">
            🎨 {{ $artwork->title }}
        </div>

    @empty

        <p class="text-gray-500">
            Eser bulunamadı.
        </p>

    @endforelse

</div>

</x-app-layout>