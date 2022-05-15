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
                    <span class="text-lg font-bold text-gray-200">Modification de l'utilisateur : {{$user->name}}</span>
                    <div>
                        <form action="{{route('admin.edit.user.submit', ['userid' => $user->id])}}" method="post">
                            @csrf
                            <label class="text-gray-200" for="role">Role de l'utilisateur</label>
                            <select id="role" name="role" class="rounded bg-gray-700 text-gray-200">
                                @foreach(\Spatie\Permission\Models\Role::all() as $role)
                                    @if($user->roles[0]->name == $role->name)
                                        <option selected name="{{$role->name}}">{{$role->name}}</option>
                                    @else
                                        <option name="{{$role->name}}">{{$role->name}}</option>
                                    @endif
                                @endforeach
                            </select>

                            <input type="submit" class="text-blue-300 hover:text-white"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
