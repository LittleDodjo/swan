<?php

namespace Database\Factories\BaseModel\Department;

use App\Models\BaseModel\Department\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => fake()->unique(true, 1000)->numberBetween(0, 5000000),
            'caption' => fake()->userName,
        ];
    }
}
