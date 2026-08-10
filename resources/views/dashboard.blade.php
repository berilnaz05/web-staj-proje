<x-app-layout>

<nav class="bg-gradient-to-r from-purple-600 to-pink-500 text-white px-6  py-3">

    <!-- Üst Navbar -->
    @php
    $friendRequestCount = \App\Models\Friend::where(
        'receiver_id',
        auth()->id()
    )
    ->where('status','pending')
    ->count();


    $messageCount = \App\Models\Message::where(
        'receiver_id',
        auth()->id()
    )
    ->where('is_read', false)
    ->count();
    @endphp
 
        <div class="flex items-center gap-4">

        <form action="{{ route('search') }}" method="GET">

            <input
                type="text"
                name="q"
                placeholder="Eser, ürün veya kullanıcı ara..."
                class="border rounded-full px-4 py-2 w-72">

        </form>
        <!-- Logo -->
                <div class="shrink-0 flex items-center px-4">
                    
                <nav class="bg-gradient-to-r from-purple-600 via-fuchsia-500 to-pink-500 shadow-lg"></nav>
        

            <div class="relative">

            <button onclick="toggleNotification()"
            class="relative text-xl">

                🛎️

                @if($friendRequestCount + $messageCount > 0)

                <span class="absolute -top-2 -right-3 bg-red-500 text-white text-xs px-2 rounded-full">
                    {{ $friendRequestCount + $messageCount }}
                </span>

                @endif

            </button>


            <div id="notificationBox"
                class="hidden absolute right-0 top-12 w-80 h-96 bg-white rounded-2xl shadow-xl border z-50">
            

            <div class="p-4 border-b font-bold">
                Bildirimler
            </div>


            @if($friendRequestCount > 0)

            <a href="{{ route('friend.requests') }}"
            class="block px-4 py-3 hover:bg-gray-100">

            👥 
            {{ $friendRequestCount }} yeni arkadaşlık isteğin var

            </a>

            @endif



            @if($messageCount > 0)

            <a href="{{ route('messages.index') }}"
            class="block px-4 py-3 hover:bg-gray-100">

            💬
            {{ $messageCount }} yeni mesajın var

            </a>

            @endif



            @if($friendRequestCount == 0 && $messageCount == 0)

            <div class="p-4 text-gray-500 text-center">

            Henüz bildirim yok.

            </div>

            @endif


            </div>

            </div>

        <a href="{{ route('profile.edit') }}">
            
            @if(auth()->user()->avatar)

                <img
                    src="{{ asset('storage/' . auth()->user()->avatar) }}"
                    class="w-10 h-10 rounded-full object-cover border">

            @else

                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                    Profil
                </div>

            @endif

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

                        <a href="{{ route('artworks.index') }}" class="block p-3 rounded-lg hover:bg-gray-100">
                             Seriler
                        </a>

                        <a href="{{route('sanat-pazari')}}" class="block p-3 rounded-lg hover:bg-gray-100">
                             Sanat Pazarım
                        </a>

                        <a href= "{{route('artworks.index')}}" class="block p-3 rounded-lg hover:bg-gray-100">
                             Keşfet 
                        </a>

                        <a href="{{ route('dashboard',['tab'=>'friends']) }}"
                        class="block p-3 rounded-lg hover:bg-gray-100">
                            Arkadaşlar
                        </a>

                        <a href="{{route('messages.index')}}" class="block p-3 rounded-lg hover:bg-gray-100">
                             Mesajlar
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

                @if($tab == 'friends')

                    <div class="mb-10">

                        <h2 class="text-2xl font-bold mb-6">
                            Arkadaşlarım
                        </h2>

                        <div class="grid md:grid-cols-2 gap-4">

                            @forelse($friends as $friend)

                                @php
                                    $user =
                                        $friend->sender_id == auth()->id()
                                            ? $friend->receiver
                                            : $friend->sender;
                                @endphp

                                <div class="bg-white rounded-xl shadow p-5">

                                    <h3 class="font-bold text-lg">
                                        👤 {{ $user->name }}
                                    </h3>

                                </div>

                            @empty

                                <div class="text-gray-500">
                                    Henüz arkadaşın yok.
                                </div>

                            @endforelse

                        </div>

                    </div>

                @else

                    <div class="mb-10">

                        <h2 class="text-2xl font-bold mb-6">
                            Son Eklenen Eserler
                        </h2>

                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                            @forelse($artworks as $artwork)

                                <div class="bg-white rounded-xl shadow overflow-hidden">

                                    <img
                                        src="{{ asset('storage/' . $artwork->cover_image) }}"
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
                                            <span>0</span>
                                            <span>0</span>
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

                @endif

            </div>

        </div>

    </div>

</div>

</x-app-layout>

<script>

function toggleNotification(){

    document
    .getElementById('notificationBox')
    .classList
    .toggle('hidden');

}


document.addEventListener('click', function(e){

    let box = document.getElementById('notificationBox');

    if(!e.target.closest('.relative')){
        box.classList.add('hidden');
    }

});

</script>