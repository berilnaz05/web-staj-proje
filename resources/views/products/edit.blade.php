<x-app-layout>

<div class="min-h-screen bg-gray-100 py-10">

<div class="max-w-3xl mx-auto bg-white rounded-xl shadow p-8">

<h1 class="text-3xl font-bold mb-6">
    Ürünü Düzenle
</h1>


<form action="{{ route('products.update',$product->id) }}"
      method="POST"
      enctype="multipart/form-data">

@csrf
@method('PUT')


<label class="block mb-2">
    Ürün Adı
</label>

<input type="text"
       name="title"
       value="{{ $product->title }}"
       class="w-full border rounded-lg p-3 mb-4">


<label class="block mb-2">
    Açıklama
</label>

<textarea name="description"
          class="w-full border rounded-lg p-3 mb-4">{{ $product->description }}</textarea>


<label class="block mb-2">
    Fiyat
</label>

<input type="number"
       name="price"
       value="{{ $product->price }}"
       class="w-full border rounded-lg p-3 mb-4">


<label class="block mb-2">
    Kategori
</label>

<input type="text"
       name="category"
       value="{{ $product->category }}"
       class="w-full border rounded-lg p-3 mb-4">


<label class="block mb-2">
    Yeni Görsel
</label>

<input type="file"
       name="image"
       class="mb-6">


<button
class="w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700">

Kaydet

</button>


</form>

</div>

</div>

</x-app-layout>