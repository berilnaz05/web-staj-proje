<x-app-layout>
    <div class="p-8">
        <h1 class="text-4xl font-bold mb-6">
            💬 Yorumlar
        </h1>

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-4 text-left">ID</th>
                        <th class="p-4 text-left">Yorum</th>
                        <th class="p-4 text-left">Tarih</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($comments as $comment)

                    <tr class="border-t">
                        <td class="p-4">
                            {{ $comment->id }}
                        </td>

                        <td class="p-4">
                            {{ $comment->content }}
                        </td>

                        <td class="p-4">
                            {{ $comment->created_at }}
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="3" class="p-6 text-center">
                            Henüz yorum bulunmuyor.
                        </td>
                    </tr>

                @endforelse

                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>