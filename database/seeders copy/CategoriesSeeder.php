<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Subcategory;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //servicios
        $cat_serv = Category::create([
            'name' => 'Servicios',
            'description' => 'Servicios de fibra y móvil',
            'code' => 'SERV',
        ]);

        Subcategory::create([
            'category_id' => $cat_serv->id,
            'name' => 'Internet y Móvil',
            'description' => 'Compañías de Internet y Móvil',
            'code' => 'SERV_INT'
        ]);

        Subcategory::create([
            'category_id' => $cat_serv->id,
            'name' => 'Reparaciones',
            'description' => 'Reparación de móviles y tablets',
            'code' => 'SERV_TELM',
        ]);



        //moviles
        $cat_mov = Category::create([
            'name' => 'Moviles',
            'description' => 'Moviles andriod y iPhones',
            'code' => 'MOV',
        ]);

        Subcategory::create([
            'category_id' => $cat_mov->id,
            'name' => 'Moviles Xiaomi',
            'description' => 'Marca Xiaomi',
            'code' => 'MOV_XIA',
        ]);

        Subcategory::create([
            'category_id' => $cat_mov->id,
            'name' => 'Moviles Huawei',
            'description' => 'Marca Huawei',
            'code' => 'MOV_HUA',
        ]);

        Subcategory::create([
            'category_id' => $cat_mov->id,
            'name' => 'Moviles Samsung',
            'description' => 'Marca Samsung',
            'code' => 'MOV_SAM',
        ]);

        Subcategory::create([
            'category_id' => $cat_mov->id,
            'name' => 'Moviles Apple',
            'description' => 'Marca Apple',
            'code' => 'MOV_PLE',
        ]);




        //tablets
        $cat_tab = Category::create([
            'name' => 'Tablets',
            'description' => 'Tablets y iPads',
            'code' => 'TAB',
        ]);

        Subcategory::create([
            'category_id' => $cat_tab->id,
            'name' => 'Tablets Xiaomi',
            'description' => 'Marca Xiaomi',
            'code' => 'TAB_XIA',
        ]);

        Subcategory::create([
            'category_id' => $cat_tab->id,
            'name' => 'Tablets Huawei',
            'description' => 'Marca Huawei',
            'code' => 'TAB_HUA',
        ]);

        Subcategory::create([
            'category_id' => $cat_tab->id,
            'name' => 'Tablets Samsung',
            'description' => 'Marca Samsung',
            'code' => 'TAB_SAM',
        ]);

        Subcategory::create([
            'category_id' => $cat_tab->id,
            'name' => 'Tablets Apple',
            'description' => 'Marca Apple',
            'code' => 'TAB_PLE',
        ]);




        //Complementos
        $cat_comp = Category::create([
            'name' => 'Complementos',
            'description' => 'Complementos para todo tipo de dispositivos móviles y tablets',
            'code' => 'COMP',
        ]);

        Subcategory::create([
            'category_id' => $cat_comp->id,
            'name' => 'Auriculares',
            'description' => 'Auriculares y Airpods',
            'code' => 'COMP_AURI',
        ]);

        Subcategory::create([
            'category_id' => $cat_comp->id,
            'name' => 'Fundas',
            'description' => 'Fundas para móviles y iPhones',
            'code' => 'COMP_FUND',
        ]);

        Subcategory::create([
            'category_id' => $cat_comp->id,
            'name' => 'Cables',
            'description' => 'Cables para móviles y tablets',
            'code' => 'COMP_CABL',
        ]);

        Subcategory::create([
            'category_id' => $cat_comp->id,
            'name' => 'Cargadores',
            'description' => 'Cargadores para móviles y  tablets',
            'code' => 'COMP_CARG',
        ]);

        Subcategory::create([
            'category_id' => $cat_comp->id,
            'name' => 'Baterías portátiles',
            'description' => 'Baterías portátiles para tablets y móviles',
            'code' => 'COMP_POWBK',
        ]);
    }
}
