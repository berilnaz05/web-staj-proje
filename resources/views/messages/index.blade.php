<x-app-layout>

<div class="bg-white rounded-2xl shadow overflow-hidden">

    <div class="grid grid-cols-4 h-[700px]">

        <!-- SOL TARAF -->
        <div class="border-r bg-gray-50">

            <div class="p-4 border-b">
                <h2 class="text-xl font-bold">
                    Arkadaşlarım
                </h2>
            </div>

            @foreach($users as $user)

                @php
                $unread = \App\Models\Message::where('sender_id', $user->id)
                    ->where('receiver_id', auth()->id())
                    ->where('is_read', false)
                    ->count();
                @endphp

                <button
                    onclick="selectFriend('{{ $user->name }}', {{ $user->id }})"
                    class="w-full flex items-center gap-3 p-4 hover:bg-gray-100 border-b text-left">

                    @if($user->avatar)

                        <img
                            src="{{ asset('storage/' . $user->avatar) }}"
                            class="w-12 h-12 rounded-full object-cover">

                    @else

                        <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center">
                            👤
                        </div>

                    @endif

                    <div class="flex items-center gap-2">

                        <span class="font-medium">
                            {{ $user->name }}
                        </span>

                        @if($unread > 0)
                            <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                        @endif

                    </div>

                </button>

            @endforeach

        </div>

        <!-- SAĞ TARAF -->
        <div class="col-span-3 flex flex-col bg-white">

            <!-- Karşılama Ekranı -->
            <div
                id="emptyState"
                class="flex-1 flex flex-col items-center justify-center text-center p-10">

                <div class="text-8xl mb-6">
                    🎨
                </div>

                <h2 class="text-4xl font-bold text-purple-700 mb-4">
                    ArtYum Sohbetler
                </h2>

                <p class="text-gray-500 max-w-lg text-lg">
                    Arkadaşlarınla çizimlerin hakkında konuşabilir,
                    yeni projeler planlayabilir ve sanat topluluğuyla
                    iletişim kurabilirsin.
                </p>

            </div>

            <!-- Sohbet Alanı -->
            <div
                id="chatArea"
                class="hidden flex-col h-full">

                <div
                    id="chatHeader"
                    class="p-5 border-b bg-white font-bold text-xl shadow-sm">

                    Kullanıcı

                </div>

                <div
                    id="chatMessages"
                    class="flex-1 p-5 overflow-y-auto bg-gray-50">

                </div>

                <div class="p-4 border-t bg-white">

                    <div class="flex gap-3">

                        <input
                            id="messageInput"
                            type="text"
                            placeholder="Mesaj yaz..."
                            class="flex-1 border rounded-xl p-3 focus:ring-2 focus:ring-purple-400 focus:outline-none">

                        <button
                            onclick="sendMessage()"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-6 rounded-xl transition">

                            Gönder

                        </button>

                    </div>

                    <input
                        type="hidden"
                        id="receiver_id">

                </div>

            </div>

        </div>

    </div>

</div>

<script>



let aktifArkadas = null;

async function mesajlariYukle(id)
{
    let response = await fetch(`/messages/load/${id}`);

    let messages = await response.json();

    let html = '';

    let lastDate = '';

    messages.forEach(message => {

        const saat = new Date(message.created_at)
            .toLocaleTimeString('tr-TR', {
                hour: '2-digit',
                minute: '2-digit'
            });

        let currentDate = new Date(message.created_at)
            .toLocaleDateString('tr-TR');

        if(lastDate !== currentDate)
        {
            html += `
                <div class="text-center my-4">
                    <span class="bg-gray-200 px-3 py-1 rounded-full text-sm text-gray-600">
                        ${currentDate}
                    </span>
                </div>
            `;

            lastDate = currentDate;
        }

        if(message.sender_id == {{ auth()->id() }})
        {
            html += `
                <div class="flex justify-end mb-2">
                    <div class="bg-purple-600 text-white px-4 py-2 rounded-xl max-w-[70%]">
                        ${message.message}
                        <div class="text-xs text-purple-200 mt-1 text-right">
                            ${saat}
                        </div>
                    </div>
                </div>
            `;
        }
        else
        {
            html += `
                <div class="flex justify-start mb-2">
                    <div class="bg-gray-200 text-gray-800 px-4 py-2 rounded-xl max-w-[70%]">
                        ${message.message}
                        <div class="text-xs text-gray-500 mt-1 text-right">
                            ${saat}
                        </div>
                    </div>
                </div>
            `;
        }

    });

    document.getElementById('chatMessages').innerHTML = html;

    let chatBox = document.getElementById('chatMessages');

    chatBox.scrollTop = chatBox.scrollHeight;
}

async function selectFriend(name, id)
{
    aktifArkadas = id;

    document.getElementById('emptyState')
        .classList.add('hidden');

    document.getElementById('chatArea')
        .classList.remove('hidden');

    document.getElementById('chatArea')
        .classList.add('flex');

    document.getElementById('chatHeader')
        .innerText = name;

    document.getElementById('receiver_id')
        .value = id;

    await mesajlariYukle(id);
}

async function sendMessage()
{
    let receiver_id =
        document.getElementById('receiver_id').value;

    let message =
        document.getElementById('messageInput').value;

    if(!receiver_id)
    {
        alert('Önce bir arkadaş seç.');
        return;
    }

    if(message.trim() === '')
    {
        return;
    }

    await fetch('/messages/send', {

        method: 'POST',

        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },

        body: JSON.stringify({
            receiver_id: receiver_id,
            message: message
        })

    });

    document.getElementById('messageInput').value = '';

    await mesajlariYukle(receiver_id);
}

setInterval(() => {

    if(aktifArkadas)
    {
        mesajlariYukle(aktifArkadas);
    }

}, 2000);

</script>

</x-app-layout>