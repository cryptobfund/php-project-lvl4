<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
