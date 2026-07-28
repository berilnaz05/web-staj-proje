<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Sat - ArtYum</title>

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

            <a href="{{ route('sanat-pazari') }}"
               class="text-purple-600 font-medium hover:text-purple-800">
                Sanat Pazarı
            </a>

        </div>
    </nav>

    <!-- Başlık -->
    <section class="bg-gradient-to-r from-purple-600 to-pink-500 text-white py-16">

        <div class="max-w-4xl mx-auto px-6 text-center">

            <h1 class="text-5xl font-bold mb-4">
                Eserini Satışa Çıkar
            </h1>

            <p class="text-lg">
                Fiziksel sanat eserlerini ArtYum topluluğuyla buluştur.
            </p>

        </div>

    </section>

    <!-- Form -->
    <section class="max-w-3xl mx-auto py-12 px-6">

        <div class="bg-white rounded-2xl shadow p-8">

            <form action="{{ route('products.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="mb-6">
                    <label class="block font-semibold mb-2">
                        Ürün Başlığı
                    </label>

                    <input type="text"
                           name="title"
                           class="w-full border rounded-lg px-4 py-3"
                           placeholder="Örn: Gün Batımı Yağlı Boya Tablo"
                           required>
                </div>

                <div class="mb-6">
                    <label class="block font-semibold mb-2">
                        Açıklama
                    </label>

                    <textarea name="description"
                              rows="5"
                              class="w-full border rounded-lg px-4 py-3"
                              placeholder="Eser hakkında bilgi ver..."
                              required></textarea>
                </div>

                <div class="mb-6">
                    <label class="block font-semibold mb-2">
                        Kategori
                    </label>

                    <select name="category"
                            class="w-full border rounded-lg px-4 py-3"
                            required>

                        <option value="">Kategori Seç</option>

                        <option value="Yagli Boya">
                            Yağlı Boya
                        </option>

                        <option value="Akrilik">
                            Akrilik
                        </option>

                        <option value="Suluboya">
                            Suluboya
                        </option>

                        <option value="Karakalem">
                            Karakalem
                        </option>

                        <option value="Dijital Baski">
                            Dijital Baskı
                        </option>

                        <option value="Heykel">
                            Heykel
                        </option>

                    </select>
                </div>

                <div class="mb-6">
                    <label class="block font-semibold mb-2">
                        Fiyat (₺)
                    </label>

                    <input type="number"
                           step="0.01"
                           name="price"
                           class="w-full border rounded-lg px-4 py-3"
                           placeholder="500"
                           required>
                </div>

                <div class="mb-8">
                    <label class="block font-semibold mb-2">
                        Eser Fotoğrafı
                    </label>

                    <input type="file"
                           name="image"
                           accept="image/*"
                           class="w-full border rounded-lg px-4 py-3"
                           required>
                </div>

                <button type="submit"
                        class="w-full bg-purple-600 text-white py-4 rounded-xl font-semibold hover:bg-purple-700">

                    Satışa Çıkar

                </button>

            </form>

        </div>

    </section>

</body>
</html>