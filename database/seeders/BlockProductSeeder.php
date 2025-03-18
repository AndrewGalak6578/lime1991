<?php

namespace Database\Seeders;

use App\Imports\Admin\ImportBlockProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;


class BlockProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new ImportBlockProduct(), public_path('vanni.xlsx'));
    }


}
