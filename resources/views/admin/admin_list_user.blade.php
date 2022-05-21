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
                    <span class="text-white text-xl">Liste des utilisateurs</span>
                    <table class="table-fixed w-full text-left">
                        <thead>
                        <tr class="bg-red-800 text-white rounded">
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
                        @foreach($users as $user)
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
