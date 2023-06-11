<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // users
        Permission::create(['name'=>'users.index']);
        Permission::create(['name'=>'users.create']);
        Permission::create(['name'=>'users.edit']);
        Permission::create(['name'=>'users.show']);
        Permission::create(['name'=>'users.destroy']);
        Permission::create(['name'=>'users.trashed']);
        Permission::create(['name'=>'users.restore']);
        Permission::create(['name'=>'users.forceDelete']);
        Permission::create(['name'=>'users.pdf']);

        // users_profiles
        Permission::create(['name'=>'profiles.edit']);
        Permission::create(['name'=>'profiles.show']);
        Permission::create(['name'=>'profiles.seeShoppings']);
        Permission::create(['name'=>'profiles.invoice']);

        // categories
        Permission::create(['name'=>'categories.index']);
        Permission::create(['name'=>'categories.create']);
        Permission::create(['name'=>'categories.edit']);
        Permission::create(['name'=>'categories.show']);
        Permission::create(['name'=>'categories.destroy']);
        Permission::create(['name'=>'categories.trashed']);
        Permission::create(['name'=>'categories.restore']);
        Permission::create(['name'=>'categories.forceDelete']);

        // subcategories
        Permission::create(['name'=>'subcategories.create']);
        Permission::create(['name'=>'subcategories.edit']);
        Permission::create(['name'=>'subcategories.destroy']);

        // products
        Permission::create(['name'=>'products.index']);
        Permission::create(['name'=>'products.create']);
        Permission::create(['name'=>'products.edit']);
        Permission::create(['name'=>'products.show']);
        Permission::create(['name'=>'products.destroy']);
        Permission::create(['name'=>'products.trashed']);
        Permission::create(['name'=>'products.restore']);
        Permission::create(['name'=>'products.forceDelete']);
        Permission::create(['name'=>'products.pdf']);

        // home
        // Permission::create(['name'=>'home']);
        // Permission::create(['name'=>'home.showCategoryOrSubcategory']);
        // Permission::create(['name'=>'home.showProduct']);

        // shopping cart
        Permission::create(['name'=>'cart.add']);
        Permission::create(['name'=>'cart.showCart']);
        Permission::create(['name'=>'cart.updateItem']);
        Permission::create(['name'=>'cart.removeItem']);
        Permission::create(['name'=>'cart.clear']);
        Permission::create(['name'=>'cart.payCart']);
        Permission::create(['name'=>'cart.storeCart']);
        Permission::create(['name'=>'cart.sales']);
        Permission::create(['name'=>'cart.showSale']);
        Permission::create(['name'=>'cart.invoices']);
    }
}
