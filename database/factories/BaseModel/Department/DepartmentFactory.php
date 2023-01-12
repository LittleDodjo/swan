<?php

namespace Database\Factories\BaseModel\Department;

use App\Models\BaseModel\Department\Department;
use App\Models\BaseModel\Employee\Employee;
use App\Models\BaseModel\Management\Management;
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
            'management_id' => Management::factory()->create(),
            'manager_id' => Employee::factory()->create(),
            'deputy_id' => Employee::factory()->create(),
            'caption' => fake()->userName,
        ];
    }
}
