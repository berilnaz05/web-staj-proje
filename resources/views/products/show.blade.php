<!DOCTYPE html>
<html lang="tr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $product->title }} - ArtYum</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body class="bg-gray-100">


<!-- Navbar -->

<nav class="bg-white shadow">

    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">


        <a href="{{ url('/') }}"
           class="text-3xl font-bold text-purple-700">
            ArtYum
        </a>


        <div class="flex items-center gap-6">


            <a href="{{ route('sanat-pazari') }}"
               class="text-gray-700 hover:text-purple-600">
                Sanat Pazarı
            </a>


            @auth

                <a href="{{ route('dashboard') }}"
                   class="text-gray-700 hover:text-purple-600">
                    Profil
                </a>

            @else

                <a href="{{ route('login') }}"
                   class="text-gray-700 hover:text-purple-600">
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

<div class="max-w-6xl mx-auto px-6 py-10">

    <!-- Ürün Kartı -->

    <div class="bg-white rounded-2xl shadow overflow-hidden">


        <div class="grid md:grid-cols-2">



            <!-- Fotoğraf -->

            <div class="bg-gray-100">


                @if($product->image)

                    <img src="{{ asset('storage/'.$product->image) }}"
                         class="w-full h-[450px] object-cover">

                @else

                    <div class="h-[450px] flex items-center justify-center text-gray-400">
                        Görsel Yok
                    </div>
                @endif

            </div>


            <!-- Bilgiler -->

            <div class="p-8">



                <h1 class="text-3xl font-bold mb-4">

                    {{ $product->title }}

                </h1>


                <p class="text-gray-600 leading-relaxed mb-6">

                    {{ $product->description }}

                </p>



                <div class="text-3xl font-bold text-purple-600 mb-6">

                    {{ number_format($product->price,2,',','.') }} ₺

                </div>


                <div class="space-y-3 text-gray-700">


                    <p>
                        🎨 Kategori:
                        <span class="font-medium">
                            {{ $product->category }}
                        </span>
                    </p>



                    <p>
                        👤 Satıcı:

                        <span class="font-medium">

                            {{ $product->user->name ?? 'Bilinmeyen Kullanıcı' }}

                        </span>

                    </p>


                    <p>
                        📦 Durum:

                        @if($product->status == 'satista')

                            <span class="text-green-600 font-medium">
                                Satışta
                            </span>

                        @else

                            <span class="text-red-600 font-medium">
                                Satıldı
                            </span>

                        @endif

                    </p>



                </div>


                <!-- Satın Alma -->


                @if(auth()->id() != $product->user_id)



                    @auth


                        <button
                            class="mt-8 w-full bg-purple-600 text-white py-3 rounded-xl hover:bg-purple-700">

                            Satın Al

                        </button>



                    @else



                        <a href="{{ route('login') }}"
                           class="block text-center mt-8 w-full bg-purple-600 text-white py-3 rounded-xl hover:bg-purple-700">

                            Satın almak için giriş yap

                        </a>



                    @endauth



                @endif





            </div>


        </div>


    </div>

<!-- Yorumlar -->

<div class="bg-white rounded-2xl shadow mt-8 p-6">

    <h2 class="text-2xl font-bold mb-6">
        Yorumlar
    </h2>

    @forelse($product->comments as $comment)

        <div class="border-b pb-4 mb-4">

            <div class="flex justify-between items-center">

                <div class="font-bold">
                    {{ $comment->user->name }}
                </div>

                @if(auth()->check() && auth()->id() == $comment->user_id)

                    <form action="{{ route('products.comment.delete', $comment->id) }}"
                          method="POST">

                        @csrf
                        @method('DELETE')

                        <button
                            onclick="return confirm('Yorumu silmek istiyor musun?')"
                            class="text-red-600 hover:text-red-800">

                            Sil

                        </button>

                    </form>

                @endif

            </div>

            <p class="text-gray-600 mt-2">
                {{ $comment->content }}
            </p>

        </div>

    @empty

        <p class="text-gray-500">
            Henüz yorum yapılmamış.
        </p>

    @endforelse


    @auth

        <form action="{{ route('products.comment', $product->id) }}"
              method="POST"
              class="mt-6">

            @csrf

            <textarea
                name="content"
                rows="4"
                class="w-full border rounded-xl p-4 focus:ring-purple-500"
                placeholder="Bu ürün hakkında düşüncelerini yaz..."></textarea>

            <button
                class="mt-3 bg-purple-600 text-white px-6 py-3 rounded-xl hover:bg-purple-700">

                Yorum Yap

            </button>

        </form>

    @else

        <a href="{{ route('login') }}"
           class="inline-block mt-5 text-purple-600 hover:underline">

            Yorum yapmak için giriş yap

        </a>

    @endauth

</div>