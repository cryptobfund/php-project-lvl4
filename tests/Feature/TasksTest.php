<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TasksTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected $task;
    protected $user;
    protected $taskStatus;

    protected function setUp(): void
    {
        parent::setUp();

        $this->taskStatus = TaskStatus::factory()->create();
        $this->user = User::factory()->create();
        $this->task = Task::factory()->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
    }


    public function testCreate()
    {
        $response = $this
            ->actingAs($this->user)
            ->get(route('tasks.create'));
        $response->assertOk();
    }

    public function testStore()
    {
        $data = [
            'name' => Factory::create()->text(30),
            'description' => Factory::create()->text(100),
            'status_id' => $this->taskStatus->id,
            'created_by_id' => $this->user->id,
            'assigned_to_id' => $this->user->id
        ];
        $response = $this
            ->actingAs($this->user)
            ->post(route('tasks.store', $data));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('tasks', $data);
    }

    public function testEdit()
    {
        $response = $this
            ->actingAs($this->user)
            ->get(route('tasks.edit', $this->task));
        $response->assertOk();
    }

    public function testUpdate()
    {
        $data = [
            'name' => Factory::create()->text(30),
            'description' => Factory::create()->text(100),
            'status_id' => TaskStatus::factory()->create()->id,
            'assigned_to_id' => User::factory()->create()->id
        ];
        $response = $this
            ->actingAs($this->user)
            ->patch(route('tasks.update', $this->task), $data);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('tasks', $data);
    }

    public function testDelete()
    {
//        $response = $this
//            ->actingAs($this->user)
//            ->delete(route('tasks.destroy', $this->task));
//        //$response->assertUnauthorized();

        $response = $this
            ->actingAs($this->task->creator)
            ->delete(route('tasks.destroy', $this->task));
        $response->assertSessionHasNoErrors();
        $this->assertDeleted('tasks', [$this->task]);
    }

    public function testShow()
    {
        $response = $this->get(route('tasks.show'));
        $response->assertOk();
    }
}
