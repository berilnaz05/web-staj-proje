<x-app-layout>

<div class="min-h-screen bg-gray-100">


    <div class="max-w-7xl mx-auto px-6 py-8">
        

        <div class="flex justify-between items-center mb-8">

            

            <h1 class="text-3xl font-bold text-gray-800">
                Satıştaki Ürünlerim
            </h1>

            <a href="{{ route('products.create') }}"
               class="bg-purple-600 text-white px-5 py-3 rounded-lg hover:bg-purple-700">
                + Yeni Ürün Ekle
            </a>

        </div>

        @if($products->count())

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($products as $product)

                    <div class="bg-white rounded-xl shadow overflow-hidden hover:shadow-lg transition">

                        <img src="{{ asset('storage/'.$product->image) }}"
                             class="w-full h-56 object-cover">

                        <div class="p-4">

                            <h3 class="font-bold text-lg">
                                {{ $product->title }}
                            </h3>

                            <p class="text-gray-500 text-sm mt-2">
                                Kategori: {{ $product->category }}
                            </p>

                            <p class="text-gray-500 text-sm">
                                Durum:
                                @if($product->condition == 'sifir')
                                    Sıfır
                                @elseif($product->condition == 'iyi')
                                    İyi
                                @else
                                    Orta
                                @endif
                            </p>

                            <p class="text-purple-600 font-bold text-xl mt-3">
                                {{ number_format($product->price, 2, ',', '.') }} ₺
                            </p>

                            @if($product->status == 'satista')

                                <span class="inline-block mt-3 px-3 py-1 rounded-full text-sm bg-green-100 text-green-700">
                                     Satışta
                                </span>

                            @else

                                <span class="inline-block mt-3 px-3 py-1 rounded-full text-sm bg-gray-200 text-gray-700">
                                     Satıldı
                                </span>

                            @endif

                            <div class="mt-5 flex gap-2">

                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="flex-1 text-center bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                                        Düzenle
                                </a>

                                <form action="{{ route('products.destroy', $product->id) }}"
                                     method="POST">

                                     @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600">
                                        Sil
                                    </button>

                                </form>

                            </div>

                            @if($product->status == 'satista')

                                <button
                                    class="w-full mt-2 bg-green-500 text-white py-2 rounded-lg hover:bg-green-600">
                                    Satıldı Olarak İşaretle
                                </button>

                            @endif

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="bg-white rounded-xl shadow p-12 text-center">

                <div class="text-6xl mb-4">
                    🎨
                </div>

                <h2 class="text-2xl font-bold mb-3">
                    Henüz satışa ürün eklemedin
                </h2>

                <p class="text-gray-500 mb-6">
                    Eklediğin tablolar ve sanat ürünleri burada listelenecek.
                </p>

                <a href="{{ route('products.create') }}"
                   class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700">
                    İlk Ürününü Ekle
                </a>

            </div>

        @endif

    </div>

</div>

</x-app-layout>