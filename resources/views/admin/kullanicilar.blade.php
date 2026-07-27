<x-app-layout>
    <div class="p-8">

        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800">
                 Kullanıcı Yönetimi
            </h1>
            <p class="text-gray-500 mt-2">
                Sistemde kayıtlı kullanıcılar
            </p>
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-4 text-left">ID</th>
                        <th class="p-4 text-left">Ad Soyad</th>
                        <th class="p-4 text-left">E-posta</th>
                        <th class="p-4 text-left">Rol</th>
                        <th class="p-4 text-left">Kayıt Tarihi</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($users as $user)

                    <tr class="border-t hover:bg-gray-50">

                        <td class="p-4">
                            {{ $user->id }}
                        </td>

                        <td class="p-4 font-medium">
                            {{ $user->name }}
                        </td>

                        <td class="p-4">
                            {{ $user->email }}
                        </td>

                        <td class="p-4">

                            @if($user->role === 'admin')
                                <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm">
                                    Admin
                                </span>
                            @else
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
                                    Kullanıcı
                                </span>
                            @endif

                        </td>

                        <td class="p-4">
                            {{ $user->created_at->format('d.m.Y') }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500">
                            Henüz kullanıcı bulunmuyor.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>
</x-app-layout>