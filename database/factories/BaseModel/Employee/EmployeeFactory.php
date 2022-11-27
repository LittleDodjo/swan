<?php

namespace Database\Factories\BaseModel\Employee;

use App\Models\BaseModel\Employee\Employee;
use App\Models\BaseModel\Employee\EmployeeDependency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BaseModel\Employee\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'organization_id' => 1,
            'appointment_id' => 1,
            'first_name' => fake()->name,
            'last_name' => fake()->lastName,
            'patronymic' => fake()->lastName,
            'phone_number' => fake()->phoneNumber,
            'cabinet' => fake()->buildingNumber,
            'rank' => fake()->numberBetween(1, 7),
            'email' => fake()->unique()->email,
            'employee_dependency_id' => EmployeeDependency::factory(),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Employee $employee) {
            //
        })->afterCreating(function (Employee $employee) {

        });
    }
}
