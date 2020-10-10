<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seedLabels = [
            'bug',
            'documentation',
            'duplicate',
            'invalid',
            'question',
            'enhancement'
        ];
        foreach ($seedLabels as $seedLabel) {
            $label = new Label();
            $label->name = $seedLabel;
            $label->description;
            $label->save();
        }
    }
}
