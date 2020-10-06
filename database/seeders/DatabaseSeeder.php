<?php

namespace Database\Seeders;

use App\Models;
use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $seedStatuses = [
            'новый',
            'в работе',
            'на тестировании',
            'завершен'
        ];
        foreach ($seedStatuses as $seedStatus) {
            $status = new TaskStatus();
            $status->name = $seedStatus;
            $status->save();
        }
    }
}
