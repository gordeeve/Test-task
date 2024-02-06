<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'test',
            'email'     => 'test@test.test',
            'password'  => 'password'
        ]);

        User::create([
            'name'      => 'test2',
            'email'     => 'test2@test.test',
            'password'  => 'password'
        ]);

        User::factory()->times(8)->create();
    }
}
