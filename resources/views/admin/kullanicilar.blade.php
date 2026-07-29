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

            <x-app-layout>

<div class="max-w-6xl mx-auto py-10 px-6">

    <h1 class="text-3xl font-bold mb-8">
        Kullanıcılar
    </h1>

    <div class="grid md:grid-cols-3 gap-6">

        @foreach($users as $user)

        <div class="bg-white rounded-xl shadow p-6">

            <h2 class="text-xl font-bold">
                {{ $user->name }}
            </h2>

            <p class="text-gray-500">
                {{ $user->email }}
            </p>

            <form
                action="{{ route('friend.send',$user->id) }}"
                method="POST"
                class="mt-4">

                @csrf

                <button
                    class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">

                    Arkadaş Ekle

                </button>

            </form>

        </div>

        @endforeach

    </div>

</div>

</x-app-layout>

        </div>

    </div>
</x-app-layout>