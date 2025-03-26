<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        Categories::insert([
            ['category_name'=>'Makanan',],
            ['category_name'=>'Minuman',],
            ['category_name'=>'Snack',],
            ['category_name'=>'Baranglain',],
        ],);
    }
}
