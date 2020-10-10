<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    protected $label;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label = Label::factory()->create();
        $this->user = User::factory()->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }


    public function testCreate()
    {
        $response = $this
            ->actingAs($this->user)
            ->get(route('labels.create'));
        $response->assertOk();
    }

    public function testStore()
    {
        $data = [
            'name' => Factory::create()->text(30),
            'description' => Factory::create()->text(100),
        ];
        $response = $this
            ->actingAs($this->user)
            ->post(route('labels.store', $data));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('labels', $data);
    }

    public function testEdit()
    {
        $response = $this
            ->actingAs($this->user)
            ->get(route('labels.edit', $this->label));
        $response->assertOk();
    }

    public function testUpdate()
    {
        $data = [
            'name' => Factory::create()->text(30),
            'description' => Factory::create()->text(100),
        ];
        $response = $this
            ->actingAs($this->user)
            ->patch(route('labels.update', $this->label), $data);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('labels', $data);
    }

    public function testDelete()
    {
        $response = $this
            ->actingAs($this->user)
            ->delete(route('labels.destroy', $this->label));
        $response->assertSessionHasNoErrors();
        $this->assertDeleted('labels', [$this->label]);
    }
}
