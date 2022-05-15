<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            Panel d'administration
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-500 border-b border-gray-500">
                    <span class="text-white text-xl">Gestion des games ♠♣♥♦ !</span>
                    <table class="table-fixed w-full text-left">
                        <thead>
                        <tr class="bg-gray-700 text-gray-200 rounded">
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
                                    <td class="border-b border-slate-600 p-1"><a class="text-blue-400 hover:text-white"
                                                                                 href="{{route('admin.delete.room', ['roomid' => $game->id])}}">Supprimer</a>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <hr class="m-5"/>

                    <span class="text-white text-xl">Gestion des users 👩‍💻 !</span>
                    <table class="table-fixed w-full text-left">
                        <thead>
                        <tr class="bg-gray-700 text-gray-200 rounded">
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
                                <td class="border-b border-slate-600 p-1">{{$user->roles->first()['name']}}</td>
                                @can('edit users')
                                    <td class="border-b border-slate-600 p-1"><a class="text-blue-400 hover:text-white"
                                                                                 href="{{route('admin.edit.user', ['userid' => $user->id])}}">Modifier</a>
                                    </td>
                                @endcan
                                @can('delete users')
                                    <td class="border-b border-slate-600 p-1"><a class="text-blue-400 hover:text-white"
                                                                                 href="{{route('admin.delete.user', ['userid' => $user->id])}}">Supprimer</a>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
