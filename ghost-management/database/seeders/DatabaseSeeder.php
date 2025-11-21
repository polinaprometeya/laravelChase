<?php

namespace Database\Seeders;

use App\Models\User as UserModel;
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
        UserModel::factory(1000)->create();

        $this->call(EventSeeder::class);

        $this->call(AttendeeSeeder::class);
        // UserModel::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
