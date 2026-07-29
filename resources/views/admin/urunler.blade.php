<x-app-layout>

<div class="max-w-7xl mx-auto py-8 px-6">

    <h1 class="text-3xl font-bold mb-6">
        Ürün Yönetimi
    </h1>

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>
                    <th class="p-4 text-left">ID</th>
                    <th class="p-4 text-left">Görsel</th>
                    <th class="p-4 text-left">Ürün</th>
                    <th class="p-4 text-left">Satıcı</th>
                    <th class="p-4 text-left">Fiyat</th>
                    <th class="p-4 text-left">İşlem</th>
                </tr>

            </thead>

            <tbody>

                @foreach($products as $product)

                <tr class="border-t">

                    <td class="p-4">
                        {{ $product->id }}
                    </td>

                    <td class="p-4">
                        <img src="{{ asset('storage/'.$product->image) }}"
                             class="w-20 h-20 object-cover rounded">
                    </td>

                    <td class="p-4">
                        {{ $product->title }}
                    </td>

                    <td class="p-4">
                        {{ $product->user->name ?? '-' }}
                    </td>

                    <td class="p-4">
                        {{ number_format($product->price, 2, ',', '.') }} ₺
                    </td>

                    <td class="p-4">

                        <form action="{{ route('admin.product.delete',$product->id) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Ürünü silmek istiyor musun?')"
                                class="bg-red-600 text-white px-3 py-2 rounded">

                                Sil

                            </button>
                            

                        </form>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

</x-app-layout>