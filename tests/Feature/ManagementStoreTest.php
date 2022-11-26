<?php

namespace Tests\Feature;

use App\Models\BaseModel\Employee\Employee;
use App\Models\BaseModel\Management\Management;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ManagementStoreTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store()
    {
        $user = User::factory()->make();
        $depends = Employee::factory()->create(['rank' => 5]);
        $manager = Employee::factory()->create(['rank' => 4]);
        $response = $this->actingAs($user)->json('POST', 'api/management', [
            'depends_id' => $depends->id,
            'manager_id' => $manager->id,
            'caption' => fake()->userName
        ], [
            'Accept' => 'application/json'
        ]);
        $response->assertStatus(200);
    }

    public function test_update()
    {
        fwrite(STDERR, print_r("Начало!", TRUE));
        $user = User::factory()->make();
        $depends = Employee::factory()->create(['rank' => 5]);
        $manager = Employee::factory()->create(['rank' => 4]);
        $second_manager = Employee::factory()->create(['rank' => 4]);
        $management = Management::factory()->create([
            'depends_id' => $depends->id,
            'manager_id' => $manager->id,
        ]);
        $message = "$manager->id будет изменено на $second_manager->id";
        fwrite(STDERR, print_r($message, TRUE));
        $response = $this->actingAs($user)->json('PATCH', 'api/management/'.$management->id, [
            'manager_id' => $second_manager->id,
            'caption' => fake()->userName
        ], [
            'Accept' => 'application/json'
        ]);
        $response->assertStatus(200);
    }
}
