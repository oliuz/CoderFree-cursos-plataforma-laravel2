<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(5)->create()->each(function(Category $category){
            Subcategory::factory(5)->create([
                'category_id' => $category->id
            ]);
        });
    }
}
