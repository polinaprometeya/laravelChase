<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //   \app\Models\User::factory(10)->create();  <---- old syntax without use App\Models\User;
        User::factory(10)->create();
        User::factory(2)->unverified()->create();
        Task::factory(20)->create();

        //this always adds new data on top of what is already there. So it does not update. any data.
        //  User::factory()->create([
        //         'name' => 'Test User',
        //         'email' => 'test@example.com',
        //     ]);
    }
}
