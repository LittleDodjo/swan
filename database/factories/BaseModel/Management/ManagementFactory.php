<?php

namespace Database\Factories\BaseModel\Management;

use App\Models\BaseModel\Department\Department;
use App\Models\BaseModel\Employee\Employee;
use App\Models\BaseModel\Employee\EmployeeDependency;
use App\Models\BaseModel\Management\Management;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BaseModel\Management\Management>
 */
class ManagementFactory extends Factory
{

    protected $model = Management::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['depends_id' => "mixed", 'manager_id' => "mixed", 'caption' => "string"])]
    public function definition(): array
    {
        return [
            'depends_id' => Employee::factory(),
            'manager_id' => Employee::factory(),
            'caption' => fake()->company,
        ];
    }

//    public function configure()
//    {
//        return $this->afterMaking(function (Management $management) {
//            //
//        })->afterCreating(function (Management $management) {
//            Department::factory()->count(5)->create([
//                'management_id' => $management->id,
//                'manager_id' => Employee::factory()->create(['rank' => 3])
//            ]);
//        });
//    }
}
