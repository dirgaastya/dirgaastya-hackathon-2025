<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            ['name'=> 'Transportation', 'description' => '-', 'created_at'=> now(), 'updated_at' => now()],
            ['name'=> 'Food & Drinks', 'description' => '-', 'created_at'=> now(), 'updated_at' => now()],
            ['name'=> 'Groceries', 'description' => '-', 'created_at'=> now(), 'updated_at' => now()],
            ['name'=> 'Bills & Utilities', 'description' => '-', 'created_at'=> now(), 'updated_at' => now()],
            ['name'=> 'Housing', 'description' => '-', 'created_at'=> now(), 'updated_at' => now()],
            ['name'=> 'Shopping', 'description' => '-', 'created_at'=> now(), 'updated_at' => now()],
            ['name'=> 'Health & Beauty', 'description' => '-', 'created_at'=> now(), 'updated_at' => now()],
            ['name'=> 'Entertainment', 'description' => '-', 'created_at'=> now(), 'updated_at' => now()],
            ['name'=> 'Education', 'description' => '-', 'created_at'=> now(), 'updated_at' => now()]
        ];
        Category::insert($categories);
    }
}
