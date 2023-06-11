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
                $user->userProfile()->save(UserProfile::factory()->make([
                                                                    'name' => 'Pedro Manuel',
                                                                    'surname_first' => 'Carrascoso',
                                                                    'surname_second' => 'Núñez',
                                                                    'dni' => '49113854E',
                                                                    'birthdate' => '1992-04-24 00:00:00',
                                                                    'bio' => 'Este es mi proyecto de fin de grado y espero que les guste :)'
                                                                ]));
                $user->assignRole('client');
            });


        //user 2
        User::factory(1)
            ->create([
                'email' => 'usuario2@usr.com',
                'password' => Hash::make('usuario2'),
            ])
            ->each(function ($user) {
                $user->userProfile()->save(UserProfile::factory()->make([
                                                                    'name' => 'Patricia',
                                                                    'surname_first' => 'Rovira',
                                                                    'surname_second' => 'Medina',
                                                                    'dni' => '52235012G',
                                                                    'birthdate' => '1997-11-02 00:00:00',
                                                                    'bio' => 'Este es otro usuario más para probar'
                                                                ]));
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
