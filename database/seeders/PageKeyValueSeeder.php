<?php

namespace Database\Seeders;

use App\Models\PageKeyValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageKeyValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PageKeyValue::create([
            'name'=>'Фото 1',
            'page_id'=>1,
            'type'=>3,
        ]);

        PageKeyValue::create([
            'name'=>'Фото 2',
            'page_id'=>1,
            'type'=>3,
        ]);

        PageKeyValue::create([
            'name'=>'Фото 3',
            'page_id'=>1,
            'type'=>3,
        ]);

        PageKeyValue::create([
            'name'=>'Заголовок каталога товаров',
            'page_id'=>1,
            'type'=>1,
            'value'=>'Каталог товаров'
        ]);

        PageKeyValue::create([
            'name'=>'1 блок товаров',
            'page_id'=>1,
            'type'=>1,
            'value'=>'Популярные товары'
        ]);

        PageKeyValue::create([
            'name'=>'2 блок товаров',
            'page_id'=>1,
            'type'=>1,
            'value'=>'Сантехника'
        ]);

        PageKeyValue::create([
            'name'=>'3 блок товаров',
            'page_id'=>1,
            'type'=>1,
            'value'=>'Мебель для ванной'
        ]);

        PageKeyValue::create([
            'name'=>'4 блок товаров',
            'page_id'=>1,
            'type'=>1,
            'value'=>'Аксессуары для ванной'
        ]);

        PageKeyValue::create([
            'name'=>'5 блок товаров',
            'page_id'=>1,
            'type'=>1,
            'value'=>'Для дачи'
        ]);


    }
}
