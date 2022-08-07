<?php

namespace Database\Seeders;

use App\Models\Bet;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\{Models\Permission, Models\Role, PermissionRegistrar};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'create games']);
        Permission::create(['name' => 'delete games']);

        Permission::create(['name' => 'see users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        Permission::create(['name' => 'generateKey']);

        Role::findOrCreate('viewer');

        $role = Role::findOrCreate('streamer');
        $role->givePermissionTo('create games');

        $role = Role::findOrCreate('moderator');
        $role->givePermissionTo(['delete games', 'see users', 'generateKey']);

        $role = Role::findOrCreate('super-admin');
        $role->givePermissionTo(Permission::all());

        $users = User::factory(1)->state([
            'name' => 'Fooxiie',
            'email' => 'eyJpdiI6IlJEckM5c2xGZ1laZHJvejZ2LzBXSHc9PSIsInZhbHVlIjoiSVl3Q0U2WjRhdHAwYmhzdzJSVUdOUmUxcWhVVFZVSVdwNU9NSlVheVJIND0iLCJtYWMiOiI3YWRlNWZkYjA2ODRlN2IxNjZhOTI3MTk1NTRmNzUzMGUwMDYzNjlkMWExNzA0NmNmNDA2Mjg4YzMzZjExNzQ4IiwidGFnIjoiIn0=',
            'password' => 'nonono',
            'twitch_token' => '223367250',
            'avatar' => 'https://static-cdn.jtvnw.net/jtv_user_pictures/f46b7230-f33c-4222-bf7d-b699f2c91f39-profile_image-300x300.png',
            'wizebot_key' => 'c6b3aa51b4233e4ba07e3b5e4b768f05',
            'remember_token' => 'wbawsS4b2N'
        ])->create();

        $users[0]->assignRole('super-admin');
        $users[0]->assignRole('streamer');
//        $users[0]->assignRole('moderator');
        $users[0]->assignRole('viewer');

        $users = User::factory(1)->state([
            'name' => 'FauxJustin'
        ])->create();
        $users[0]->assignRole('streamer');
        $users = User::factory(1)->state([
            'name' => 'FausseEnelya74'
        ])->create();
        $users[0]->assignRole('streamer');
//
//        $users = User::factory(15)->create();
//        foreach ($users as $user) {
//            $user->assignRole('viewer');
//        }
    }
}
