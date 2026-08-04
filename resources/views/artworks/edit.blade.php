<x-app-layout>

<div class="max-w-3xl mx-auto py-10 px-6">

    <div class="bg-white rounded-xl shadow p-8">

        <h1 class="text-3xl font-bold mb-8">
            Eseri Düzenle
        </h1>

        <form action="{{ route('artworks.update', $artwork->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-5">
                <label>Eser Adı</label>

                <input
                    type="text"
                    name="title"
                    value="{{ $artwork->title }}"
                    class="w-full border rounded-lg p-3">
            </div>

            <div class="mb-5">
                <label>Açıklama</label>

                <div class="mb-5">

                    <label>Yeni Kapak</label>

                    <input
                        type="file"
                        name="cover_image"
                        class="w-full border rounded-lg p-3">

                </div>

                <textarea
                    name="description"
                    rows="5"
                    class="w-full border rounded-lg p-3">{{ $artwork->description }}</textarea>
            </div>

            <button
                class="bg-purple-600 text-white px-6 py-3 rounded-lg">

                Kaydet

            </button>

        </form>

    </div>

</div>

</x-app-layout>