<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <img src="{{Auth::user()->avatar}}" width="150" height="150"
         class="rounded-full border border-gray-400 mx-auto shadow-2xl
         border-2 border-white" alt="Icone de l'utilisateur"/>
    <p class="text-xl text-center my-4 text-gray-200">Bienvenue
        <b><u>{{Auth::user()->name}}</u></b></p>
    @if(\Illuminate\Support\Facades\Auth::user()->hasRole(['streamer', 'super-admin']))
        <div id="error-reports">
            @if (Auth::user()->wizebot_key == null)
                <div
                    class="mx-auto w-1/3 my-12 py-4 rounded text-red-600 justify-center bg-red-200">
                    <div class="flex justify-center">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-5 w-5" viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="text-lg font-bold justify-center">
                            Aucun compte WizeBot lié ! (Obligatoire!)
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-5 w-5" viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <div class="justify-center text-center">
                        <a href="{{route('auth.twitch.profil')}}"><u>Régler ça
                                !</u></a>
                    </div>
                </div>
            @endif
        </div>
    @endif
    @if(\Illuminate\Support\Facades\Auth::user()->hasRole(['streamer', 'super-admin']))
        <div class="flex items-center justify-center">
            <a href="{{route('room')}}"
               class="bg-casino text-white px-2 py-4 mx-auto w-auto
           text-center border border-gray-400 rounded-bl-xl
           rounded-tr-xl">Créer ma room !</a>
        </div>
    @endif
</x-app-layout>
