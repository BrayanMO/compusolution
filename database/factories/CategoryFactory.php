<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image' => 'categories/' . $this->faker->image(storage_path().'\app\public\categories', 640, 480, null, false)
            // 'image' => 'categories/' . $this->faker->image(, 640, 480, null, false)
        ];
    }
}
