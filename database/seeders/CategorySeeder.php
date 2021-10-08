<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $categories = [
            [
                'name' => 'Web Development',
            ],
            [
                'name' => 'Mobile Development',
            ],
            [
                'name' => 'Game Development',
            ],
            [
                'name' => 'Desktop Applications',
            ],
        ];

        foreach($categories as $category) {
            Category::create($category);
        }
    }
}
