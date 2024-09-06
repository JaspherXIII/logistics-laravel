<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instructor;
use Illuminate\Support\Facades\DB;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Using factories to create fake data
        Instructor::factory()
            ->count(5)
            ->hasPosts(1) // Assuming 'posts' is a relationship defined in your Instructor model
            ->create();

    }
}
