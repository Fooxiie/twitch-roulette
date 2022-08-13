<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Gestion du profil
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-tile class="mt-0">
                @if(\Illuminate\Support\Facades\Auth::user()->hasRole(['streamer', 'super-admin']))
                    <div>
                        <span class="text-xl text-white">Gestion
                            Streaming</span>
                        <br/>
                        <form method="get"
                              action="{{route('auth.twitch.profil.save')}}">
                            @csrf
                            <div>
                                <x-label for="wizebot_key"
                                         :value="__('Clé Wizebot')"></x-label>

                                <x-input id="wizebot_key" class="block mt-1
                                w-full text-black" type="text" name="wizebotkey"
                                         :value="Auth::user()->wizebot_key"
                                         required autofocus></x-input>
                            </div>
                            <input class="text-white
                            underline" type="submit">
                        </form>
                    </div>
                @endif
            </x-tile>

            <x-tile class="mt-0">
                <div>
                    <span class="text-xl">Vos permissions</span>
                    <br/>
                    @foreach(\Illuminate\Support\Facades\Auth::user()->roles as $role)
                        <div class="font-bold">
                            <div>{{$role->name}}</div>
                            <ul class="ml-4">
                                @foreach($role->permissions as $permission)
                                    <li class="font-light">droit : <span class="font-bold">{{$permission->name}}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </x-tile>

            <x-tile class="mt-0">
                <div class="">
                    <span class="text-xl">Activer une clef</span>
                    @isset($error)
                        <div class="bg-red-400 rounded p-3 text-white">
                            {{$error}}
                        </div>
                    @endisset

                    @isset($success)
                        <div class="bg-green-400 rounded p-3 text-black">
                            {{$success}}
                        </div>
                    @endisset

                    <form method="post" action="{{route('auth.twitch.profil.activateKey')}}">
                        @csrf
                        <div>
                            <x-label for="key">Clé à activer</x-label>

                            <x-input id="key" class="block mt-1 w-full
                            text-black" type="text" name="key"
                                     required></x-input>
                        </div>
                        <input class="text-white underline" type="submit">
                    </form>
                </div>
            </x-tile>
        </div>
    </div>
</x-app-layout>
