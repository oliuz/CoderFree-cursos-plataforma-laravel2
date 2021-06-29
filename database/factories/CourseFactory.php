<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Level;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(6);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'subtitle' => $this->faker->sentence(),
            'description' => $this->faker->text(),
            'image' => 'courses/' . $this->faker->image('public/storage/courses', 640, 480, null, false),
            'status' => 3,
            'user_id' => 1,
            'level_id' => Level::all()->random()->id,
            'subcategory_id' => Subcategory::all()->random()->id,
            'price' => $this->faker->randomElement([12.99, 19.99, 39.99]),
        ];
    }
}
