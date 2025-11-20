<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User as UserModel;
use App\Models\Event;

class AttendeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = UserModel::all();
        $events = Event::all();
        foreach ($users as $user) {
            $eventsToAttend = $events->random(rand(1, 3));


        }
    }
}
