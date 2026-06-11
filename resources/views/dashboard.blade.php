<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <!-- DATA USER -->
            <div class="mt-6 bg-white shadow-sm sm:rounded-lg p-6">

                <h2 class="text-lg font-bold mb-4">Data User</h2>

                @foreach($users as $user)
                    <div class="border-b py-4">

                        <p><b>Nama:</b> {{ $user->name }}</p>
                        <p><b>Email:</b> {{ $user->email }}</p>
                        <p><b>Divisi:</b> {{ $user->divisi->nama_divisi ?? '-' }}</p>

                        @if($user->foto)
                            <img src="{{ asset('storage/'.$user->foto) }}"
                                 width="80"
                                 class="mt-2 rounded">
                        @else
                            <span class="text-gray-500">Tidak ada foto</span>
                        @endif

                    </div>
                @endforeach

            </div>

        </div>
    </div>
</x-app-layout>