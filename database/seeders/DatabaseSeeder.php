<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);
        User::factory(4)->HR()->create();
        User::factory(4)->user()->create();
        User::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Newton',
            'email' => 'john.newton@nabinaholding.com',
            'password' => bcrypt('hr@123'),
        ])->assignRole('HR');
        User::factory()->create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@nabinaholding.com',
            'password' => bcrypt('admin@123'),
        ])->assignRole('systemAdmin');
    }
}
