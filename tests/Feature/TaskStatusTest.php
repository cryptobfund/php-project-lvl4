<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use App\Models\User;
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

    //    $this->taskStatus = factory(TaskStatus::class)->create();
    //    $this->user = factory(User::class)->create();
    }

    public function testWelcome()
    {
        $response = $this->get(route('welcome'));
        $response->assertOk();
    }

    //public function testIndex()
    //{
    //    $response = $this->get(route('task_statuses.index'));
    //    $response->assertOk();
    //}

    //public function testCreate()
    //{
    //    $response = $this
    //       ->actingAs($this->user)
    //        ->get(route('task_statuses.create'));
    //    $response->assertOk();
    //}
}
