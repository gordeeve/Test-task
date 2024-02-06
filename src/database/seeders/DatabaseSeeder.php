<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Task;
use App\Models\User;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(TaskSeeder::class);
    }

    /**
     * Generate fake tasks in DB
     * @param User $user
     * @param Generator $faker
     * @param int $counter
     * @return void
     */
    private function makeTasks(User $user, Generator $faker, int $counter = 100)
    {
        foreach (range(1, $counter) as $index) {
            Task::create([
                'title' => $faker->sentence(rand(6, 14)),
                'user_id' => $user->id,
                'description' => $faker->text(rand(40, 120)),
                'priority' => $faker->biasedNumberBetween(1, 5),
                'status' => $faker->randomElement(['done', 'todo']),
                'completedAt' => $faker->dateTimeThisYear()
            ]);
        }
    }
}
