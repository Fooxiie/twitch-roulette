<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestion du profil
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="get" action="{{route('auth.twitch.profil.save')}}">
                        @csrf
                        <div>
                            <x-label for="wizebot_key" :value="__('Clé Wizebot')"></x-label>

                            <x-input id="wizebot_key" class="block mt-1 w-full" type="text" name="wizebotkey"
                                     :value="Auth::user()->wizebot_key" required autofocus></x-input>
                        </div>
                        <input type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
