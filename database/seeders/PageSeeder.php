<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::create([
            'name'=>'Главная страница',
            'slug'=>'/',
            'type'=>1
        ]);

        Page::create([
            'name'=>'Каталог',
            'slug'=>'/catalog',
            'type'=>1
        ]);

        Page::create([
            'name'=>'Контакты',
            'slug'=>'/contacts',
            'type'=>1
        ]);
    }
}
