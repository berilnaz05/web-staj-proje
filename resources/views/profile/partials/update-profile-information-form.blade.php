<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profil Bilgisi') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Profil bilgilerinizi ve E mail adresinizi güncelleyin.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        <div class="mb-6">

            <label for="avatarInput" class="cursor-pointer">

                @if(Auth::user()->avatar)

                    <img
                        src="{{ asset('storage/' . Auth::user()->avatar) }}"
                        class="w-32 h-32 rounded-full object-cover border-4 border-purple-500 hover:opacity-80">

                @else

                    <div class="w-32 h-32 rounded-full bg-gray-300 flex items-center justify-center text-4xl hover:bg-gray-400">
                        👤
                    </div>

                @endif

            </label>

            <input
                id="avatarInput"
                type="file"
                name="avatar"
                accept="image/*"
                class="hidden">

        </div>
        
        <div class="mb-6">

            <label class="block font-semibold mb-2">
                Profil Fotoğrafı
            </label>

            <input
                type="file"
                name="avatar"
                accept="image/*"
                class="w-full border rounded-lg p-2">

        </div>

        <div class="mb-6">

            <label class="block font-semibold mb-2">
                Kullanıcı Adı
            </label>

            <input
                type="text"
                name="username"
                value="{{ old('username', Auth::user()->username) }}"
                class="w-full border rounded-lg p-3">

        </div>

        <div class="mb-6">

            <label class="block font-semibold mb-2">
                Hakkımda
            </label>

            <textarea
                name="bio"
                rows="4"
                class="w-full border rounded-lg p-3">{{ old('bio', Auth::user()->bio) }}</textarea>

        </div>

        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('İsim')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Kaydet') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Kaydedildi.') }}</p>
            @endif
        </div>
    </form>
</section>
