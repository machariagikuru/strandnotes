<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        Subject::updateOrCreate(
            ['slug' => 'english'],
            ['name' => 'English']
        );
    }
}
