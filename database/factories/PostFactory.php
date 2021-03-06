<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(5),
            'body' => $this->faker->realText(500),
            'user_id' => $this->faker->randomDigitNot(0),
            'img_path' => '/img/post_images/post_image.jpg',
            'category_id' => $this->faker->numberBetween(1, 5),
            'approved' => 'approved',
        ];
    }
}
