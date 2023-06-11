<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin', 'description' => 'Administrador con acceso total a la aplicación.']);
        $client = Role::create(['name' => 'client', 'description' => 'Usuario con acceso limitado a la aplicación.']);

        $client->syncPermissions([
            //user profile
            'profiles.edit',
            'profiles.show',
            'profiles.seeShoppings',
            'profiles.invoice',

            //home
            // 'home',
            // 'home.showCategoryOrSubcategory',
            // 'home.showProduct',

            //shopping cart
            'cart.add',
            'cart.showCart',
            'cart.updateItem',
            'cart.removeItem',
            'cart.clear',
            'cart.payCart',
            'cart.storeCart',
        ]);
    }
}
