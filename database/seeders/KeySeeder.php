<?php

namespace Database\Seeders;

use App\Models\Key;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Общие
        Key::create([
            'name'=>'Название сайта',
            'key'=>'website_name',
            'key_group_id'=>1,
            'value'=>'Lime Market'
        ]);

        Key::create([
            'name'=>'Подпись к названию',
            'key'=>'website_slogan',
            'key_group_id'=>1,
            'value'=>'Сантехника в Краснодаре'
        ]);


        //Шапка
        Key::create([
            'name'=>'Подпись к номеру телефона',
            'key'=>'phone_desc',
            'key_group_id'=>2,
            'value'=>'Отдел продаж'
        ]);


        //Подвал
        Key::create([
            'name'=>'Подпись защиты',
            'key'=>'copyright_text',
            'key_group_id'=>3,
            'value'=>'LIME - Сантехника в Краснодаре <br> Все права защищены.'
        ]);


        //Контакты
        Key::create([
            'name'=>'Полный адрес',
            'key'=>'full_address',
            'key_group_id'=>4,
            'value'=>'г. Краснодар, улица Красных Партизан 2/4'
        ]);

        Key::create([
            'name'=>'Номер телефона',
            'key'=>'phone',
            'key_group_id'=>4,
            'value'=>'+7(900)-222-33-44'
        ]);

        Key::create([
            'name'=>'Email',
            'key'=>'email',
            'key_group_id'=>4,
            'value'=>'info@lime-market.ru'
        ]);

        Key::create([
            'name'=>'График работы',
            'key'=>'work_time',
            'key_group_id'=>4,
            'value'=>'Пн-Вс:10:00-18:00'
        ]);


        Key::create([
            'name'=>'Бренды - коллекции/серии',
            'key'=>'brand_collections_name',
            'key_group_id'=>6,
            'value'=>'Коллекции',
            'value_2'=>'Коллекция'
        ]);
    }
}
