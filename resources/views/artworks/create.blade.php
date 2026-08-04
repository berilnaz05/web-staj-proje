<x-app-layout>

<div class="max-w-3xl mx-auto py-10 px-6">

    <div class="bg-white shadow rounded-xl p-8">

        <h1 class="text-3xl font-bold mb-8">
            Yeni Eser Oluştur
        </h1>

        <form action="{{ route('artworks.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Eser Adı
                </label>

                <input
                    type="text"
                    name="title"
                    class="w-full border rounded-lg p-3"
                    required>

            </div>

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Açıklama
                </label>

                <textarea
                    name="description"
                    rows="5"
                    class="w-full border rounded-lg p-3"></textarea>

            </div>



            <div class="mb-6">

            <label class="block font-semibold mb-2">
                Tür
            </label>

            <select
                name="category_id"
                class="w-full border rounded-lg p-3"
                required>

                <option value="">
                    Tür Seç
                </option>

                <option value="">
                    Fantastik
                </option>

                <option value="">
                    Romantik
                </option>

                <option value="">
                    Korku
                </option>

                <option value="">
                    Bilim Kurgu
                </option>

                <option value="">
                    Polisiye
                </option>

                <option value="">
                    Tarihi
                </option>

                <option value="">
                    Reealistik
                </option>

                <option value="">
                    Komedi
                </option>

                <option value="">
                    Reenkarnasyon
                </option>

                <option value="">
                    Dram
                </option>

                <option value="">
                    Macera
                </option>

                <option value="">
                    Gerilim
                </option>

                @foreach($categories as $category)

                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>

                @endforeach

            </select>

        </div>
            <div class="mb-8">

                <label class="block font-semibold mb-2">
                    Kapak Görseli
                </label>

                <input
                    type="file"
                    name="cover_image"
                    class="w-full">

            </div>

            <button
                class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700">

                Eseri Oluştur

            </button>

        </form>

    </div>

</div>

</x-app-layout>