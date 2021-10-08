<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [
             'name' => 'Laravel'    
            ],
            [
             'name' => 'CodeIgniter'    
            ],
            [
             'name' => 'Symfony'    
            ],
            [
             'name' => 'PHP'    
            ],
            [
             'name' => 'Angular'    
            ],
            [
             'name' => 'React'    
            ],
            [
             'name' => 'Vue'    
            ],
            [
             'name' => 'Javascript'    
            ],
        ];

        foreach($tags as $tag) {
            Tag::create($tag);
        }
    }
}
