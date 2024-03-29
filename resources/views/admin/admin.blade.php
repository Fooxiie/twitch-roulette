<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Panel d'administration
        </h2>
    </x-slot>

    <div class="">
        <x-tile>
            <span class="text-white text-xl">Gestion des games ♠♣♥♦ !</span>
            <table class="table-fixed w-full text-left">
                <thead>
                <tr class="bg-blackAccent text-white rounded">
                    <th class="py-2 px-4">Nom de la game</th>
                    <th class="py-2 px-4">Date de création</th>
                    <th class="py-2 px-4">Nb places</th>
                    @can('delete games')
                        <th class="py-2 px-4">Actions</th>
                    @endcan
                </tr>
                </thead>
                <tbody>
                @foreach(\App\Models\Game::all()->take(10) as $game)
                    <tr class="text-gray-100">
                        <td class="border-b border-slate-600 p-1">{{$game->name}}</td>
                        <td class="border-b border-slate-600 p-1">{{$game->created_at}}</td>
                        <td class="border-b border-slate-600 p-1">{{$game->number_place}}</td>
                        @can('delete games')
                            <td class="border-b border-slate-600 p-1"><a
                                    class="text-white hover:text-red-600 underline"
                                    href="{{route('admin.delete.room', ['roomid' => $game->id])}}">Supprimer</a>
                            </td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-tile>

        <x-tile>
            <span class="text-white text-xl">Gestion des users 👩‍💻 !</span> <a
                class="text-white underline hover:text-red-300"
                href="{{route('admin.list.user')}}">Voir tout le
                monde</a>
            <table class="table-fixed w-full text-left">
                <thead>
                <tr class="bg-blackAccent text-white rounded">
                    <th class="py-2 px-4">Pseudo</th>
                    <th class="py-2 px-4">Date de création</th>
                    <th class="py-2 px-4">Role</th>
                    @can('edit users')
                        <th class="py-2 px-4">Actions</th>
                    @endcan
                    @can('delete users')
                        <th class="py-2 px-4">Actions</th>
                    @endcan
                </tr>
                </thead>
                <tbody>
                @foreach(\App\Models\User::all()->take(10) as $user)
                    <tr class="text-gray-100">
                        <td class="border-b border-slate-600 p-1">{{$user->name}}</td>
                        <td class="border-b border-slate-600 p-1">{{$user->created_at}}</td>
                        *
                        <td class="border-b border-slate-600 p-1">{{(sizeof($user->roles) > 0) ? $user->roles->first()['name'] : "Aucun"}}</td>
                        @can('edit users')
                            <td class="border-b border-slate-600 p-1"><a
                                    class="text-white hover:text-red-600 underline"
                                    href="{{route('admin.edit.user', ['userid' => $user->id])}}">Modifier</a>
                            </td>
                        @endcan
                        @can('delete users')
                            <td class="border-b border-slate-600 p-1"><a
                                    class="text-white hover:text-red-600 underline"
                                    href="{{route('admin.delete.user', ['userid' => $user->id])}}">Supprimer</a>
                            </td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>

        </x-tile>


        <x-tile>
            <span class="text-white text-xl">Création de clé 🔑</span>
            @isset($keyadded)
                <div class="bg-blackAccent rounded-lg p-3 text-white">
                    <label for="keyadded">Ajout de la clef :</label>
                    <input type="text" disabled value="{{$keyadded}}"
                           id="keyadded" class="w-1/2 text-black"/>
                    <div class="tooltip">
                        <button class="h-full align-middle animate-pulse"
                                id="copyBtn" onclick="myFunction()"
                                onmouseout="outFunc()">
                            <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-8 w-8" viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path d="M8 2a1 1 0 000 2h2a1 1 0 100-2H8z"/>
                                <path
                                    d="M3 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v6h-4.586l1.293-1.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L10.414 13H15v3a2 2 0 01-2 2H5a2 2 0 01-2-2V5zM15 11h2a1 1 0 110 2h-2v-2z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <hr class="m-5"/>
            @endisset
            <div class="w-full">
                <form method="post" action="{{route('admin.generate.key')}}">
                    @csrf
                    <label>
                        <select name="typeKey" id="typeKey" class="rounded-lg
                         text-black">
                            <option value="addViewer">Role : viewer</option>
                            <option value="addStreamer">Role : streamer</option>
                            <option value="addModerator">Role : moderator
                            </option>
                            @if(\Illuminate\Support\Facades\Auth::user()->hasrole('super-admin'))
                                <option value="addSuperadmin">Role :
                                    super-admin
                                </option>
                            @endif
                        </select>
                        <br/>
                        <br/>
                        <input
                            class="text-white bg-red-900 rounded-lg p-2 hover:text-white hover:bg-red-700"
                            type="submit"/>
                    </label>
                </form>
            </div>
        </x-tile>
    </div>

    <script>
        function myFunction() {
            let copyText = document.getElementById("keyadded");
            navigator.clipboard.writeText(copyText.value);

            let tooltip = document.getElementById("myTooltip");
            tooltip.innerHTML = "Copied !"
        }

        function outFunc() {
            var tooltip = document.getElementById("myTooltip");
            tooltip.innerHTML = "Copy to clipboard";
        }
    </script>
</x-app-layout>
