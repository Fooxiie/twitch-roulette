<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Gestion du profil
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if(\Illuminate\Support\Facades\Auth::user()->hasRole(['streamer', 'super-admin']))
                <div class="p-6 bg-white border-b border-gray-200">
                    <span class="text-xl">Gestion Streaming</span>
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
                @endif

                <div class="p-6 bg-white border-b border-gray-200">
                    <span class="text-xl">Vos permissions</span>
                    <br/>
                    @foreach(\Illuminate\Support\Facades\Auth::user()->roles as $role)
                        <div class="font-bold">
                            <div>{{$role->name}}</div>
                            <ul class="ml-4">
                                @foreach($role->permissions as $permission)
                                    <li class="font-light">droit : <span class="font-bold">{{$permission->name}}</span></li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
