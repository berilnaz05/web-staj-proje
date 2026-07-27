<x-app-layout>
    <div class="p-8">

        <h1 class="text-4xl font-bold mb-6">
            🚨 Şikayet Yönetimi
        </h1>

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-4 text-left">ID</th>
                        <th class="p-4 text-left">Sebep</th>
                        <th class="p-4 text-left">Açıklama</th>
                        <th class="p-4 text-left">Durum</th>
                        <th class="p-4 text-left">Tarih</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($reports as $report)

                    <tr class="border-t hover:bg-gray-50">

                        <td class="p-4">
                            {{ $report->id }}
                        </td>

                        <td class="p-4 font-medium">
                            {{ $report->reason }}
                        </td>

                        <td class="p-4">
                            {{ $report->description ?? '-' }}
                        </td>

                        <td class="p-4">

                            @if($report->status == 'pending')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm">
                                    Bekliyor
                                </span>

                            @elseif($report->status == 'reviewed')
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm">
                                    İncelendi
                                </span>

                            @elseif($report->status == 'resolved')
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
                                    Çözüldü
                                </span>

                            @else
                                <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm">
                                    Reddedildi
                                </span>
                            @endif

                        </td>

                        <td class="p-4">
                            {{ $report->created_at->format('d.m.Y') }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500">
                            Henüz şikayet bulunmuyor.
                        </td>
                    </tr>

                @endforelse

                </tbody>
            </table>

        </div>

    </div>
</x-app-layout>