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
            'description' => 'Reparaciones',
            'code' => 'SERV_TELM',
        ]);



        //moviles
        $cat_mov = Category::create([
            'name' => 'Moviles',
            'description' => 'Dispositivos móviles de primeras marcas.',
            'code' => 'MOV',
        ]);

        Subcategory::create([
            'category_id' => $cat_mov->id,
            'name' => 'Xiaomi',
            'description' => 'Para los fans, por los fans.',
            'code' => 'MOV_XIA',
        ]);

        Subcategory::create([
            'category_id' => $cat_mov->id,
            'name' => 'Huawei',
            'description' => 'Haz posible lo imposible',
            'code' => 'MOV_HUA',
        ]);

        Subcategory::create([
            'category_id' => $cat_mov->id,
            'name' => 'Samsung',
            'description' => 'Haz lo que no puedes.',
            'code' => 'MOV_SAM',
        ]);

        Subcategory::create([
            'category_id' => $cat_mov->id,
            'name' => 'Apple',
            'description' => 'Piensa diferente',
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
            'name' => 'Xiaomi',
            'description' => 'Para los fans, por los fans',
            'code' => 'TAB_XIA',
        ]);

        Subcategory::create([
            'category_id' => $cat_tab->id,
            'name' => 'Huawei',
            'description' => 'Haz posible lo imposible',
            'code' => 'TAB_HUA',
        ]);

        Subcategory::create([
            'category_id' => $cat_tab->id,
            'name' => 'Lenovo',
            'description' => 'Para aquellos que hacen',
            'code' => 'TAB_HUA',
        ]);

        Subcategory::create([
            'category_id' => $cat_tab->id,
            'name' => 'Realme',
            'description' => 'Atrévete a Saltar',
            'code' => 'TAB_HUA',
        ]);

        Subcategory::create([
            'category_id' => $cat_tab->id,
            'name' => 'Samsung',
            'description' => 'Haz lo que no puedes',
            'code' => 'TAB_SAM',
        ]);

        Subcategory::create([
            'category_id' => $cat_tab->id,
            'name' => 'Apple',
            'description' => 'Piensa diferente',
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
            'name' => 'Powerbanks',
            'description' => 'Baterías portátiles para tablets y móviles',
            'code' => 'COMP_POWBK',
        ]);
    }
}
