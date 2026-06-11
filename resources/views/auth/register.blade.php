<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Divisi -->
        <div class="mt-4">
            <x-input-label for="divisi_id" value="Divisi" />

            <select name="divisi_id" class="block mt-1 w-full border-gray-300 rounded-md">
                <option value="">-- Pilih Divisi --</option>

                @foreach($divisis as $divisi)
                    <option value="{{ $divisi->id }}">
                        {{ $divisi->nama_divisi }}
                    </option>
                @endforeach
            </select>

            <x-input-error :messages="$errors->get('divisi_id')" class="mt-2" />
        </div>

        <!-- Foto -->
        <div class="mt-4">
            <x-input-label for="foto" value="Foto" />

            <input type="file"
                   name="foto"
                   class="block mt-1 w-full border-gray-300 rounded-md">

            <x-input-error :messages="$errors->get('foto')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation"
                          required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Button -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900"
               href="{{ route('login') }}">
                Already registered?
            </a>

            <x-primary-button class="ms-4">
                Register
            </x-primary-button>
        </div>

    </form>
</x-guest-layout>