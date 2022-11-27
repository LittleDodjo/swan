<?php

namespace Database\Factories\BaseModel\Employee;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BaseModel\Employee\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'caption' => fake()->name,
            'short_name' => fake()->name(),
        ];
    }
}
