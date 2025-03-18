<?php

namespace Database\Seeders;

use App\Models\KeyGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeyGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KeyGroup::create([
            'name'=>'Общие'
        ]);

        KeyGroup::create([
            'name'=>'Шапка'
        ]);

        KeyGroup::create([
            'name'=>'Подвал'
        ]);

        KeyGroup::create([
            'name'=>'Контакты'
        ]);

        KeyGroup::create([
            'name'=>'Соц. сети'
        ]);

        KeyGroup::create([
            'name'=>'Админ-панель'
        ]);
    }
}
