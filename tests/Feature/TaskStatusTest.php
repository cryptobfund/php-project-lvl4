<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    protected $taskStatus;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->taskStatus = TaskStatus::factory()->create();
        $this->user = User::factory()->create();
    }

    public function testWelcome()
    {
        $response = $this->get(route('welcome'));
        $response->assertOk();
    }

    public function testIndex()
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
    }


    public function testCreate()
    {
        $response = $this
            ->actingAs($this->user)
            ->get(route('task_statuses.create'));
        $response->assertOk();
    }

    public function testStore()
    {
        $data = Factory::create()->text(30);
        $response = $this
            ->actingAs($this->user)
            ->post(route('task_statuses.store', ['name' => $data]));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', ['name' => $data]);
    }

    public function testEdit()
    {
        $response = $this
            ->actingAs($this->user)
            ->get(route('task_statuses.edit', $this->taskStatus));
        $response->assertOk();
    }

    public function testUpdate()
    {
        $data = Factory::create()->text(30);
        $response = $this
            ->actingAs($this->user)
            ->patch(route('task_statuses.update', $this->taskStatus), ['name' => $data]);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('task_statuses', ['name' => $this->taskStatus->name]);
        $this->assertDatabaseHas('task_statuses', ['name' => $data]);
    }

    public function testDelete()
    {
        $response = $this
            ->actingAs($this->user)
            ->delete(route('task_statuses.destroy', $this->taskStatus));
        $response->assertSessionHasNoErrors();
        $this->assertDeleted('task_statuses', [$this->taskStatus]);
    }
}
