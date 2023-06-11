<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserProfile;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //admin
        User::factory(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin@admin.com'),
            ])
            ->each(function ($user) {
                $user->userProfile()->save(UserProfile::factory()->make(['name' => 'Admin']));
                $user->assignRole('admin');
            });

        //user 1
        User::factory(1)
            ->create([
                'email' => 'usuario1@usr.com',
                'password' => Hash::make('usuario1'),
            ])
            ->each(function ($user) {
                $user->userProfile()->save(UserProfile::factory()->make(['name' => 'Usuario Uno']));
                $user->assignRole('client');
            });

        //users
        User::factory(10)
            ->has(UserProfile::factory()->count(1))
            ->create()
            ->each(function ($user) {
                $user->assignRole('client');
            });
    }
}
