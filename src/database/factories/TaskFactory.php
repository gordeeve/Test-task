<?php

namespace Database\Factories;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(rand(6, 14)),
            'user_id' => rand(1,10),
            'description' => fake()->text(rand(40, 120)),
            'priority' => fake()->biasedNumberBetween(1, 5),
            'status' => fake()->randomElement([TaskStatus::DONE->value, TaskStatus::TODO->value]),
            'completedAt' => fake()->dateTimeThisYear()
        ];
    }
}
