<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('custom.room') }}
        </h2>
    </x-slot>

    <div class="mx-auto w-1/2 my-12 py-4 px-4 rounded text-gray-200
    justify-center shadow-2xl" style="background: linear-gradient(135deg,
    #972e33 80%, #971724 20%);">
        <form action="{{route('room.submit')}}" method="get">
            @csrf
            <span class="text-lg mx-auto">Créer ma salle !</span>
            <br/><br/>
            <label for="room_name">Titre de la salle</label><br>
            <input class="rounded text-black" required type="text" id="room_name" name="room_name"/>
            <br/><br/>
            <div class="flex">
                <label class="flex" for="room_name">Nombre de sièges
                </label>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <input class="rounded text-black" required type="number"
                   id="room_places" name="room_places"/>
            <br/><br/>
            <input type="submit"/>
        </form>
    </div>


    <div
        class="mx-auto w-1/2 my-12 py-4 px-4 rounded text-gray-200 justify-center shadow-2xl"
        style="background: linear-gradient(135deg,#972e33 80%, #971724 20%);">
        <span class="text-lg mx-auto">Historique des games !</span>
        <table class="table-auto w-full text-center">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Places disponibles</th>
                <th>Date de création</th>
                <th>ID</th>
            </tr>
            </thead>
            <tbody>
            @foreach(Illuminate\Support\Facades\Auth::user()->gameHosted as $game)
                <tr class="italic">
                    <td>{{$game->name}}</td>
                    <td>{{$game->number_place}}</td>
                    <td>{{$game->created_at->format('d/m-Y')}}</td>
                    <td>{{$game->id}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
