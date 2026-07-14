<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Announcement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_by' => User::where('role', 'admin')->inRandomOrder()->first()?->id ?? User::factory()->admin(),
            'title' => fake()->sentence(5),
            'content' => fake()->paragraphs(3, true),
            'image' => null,
            'video_url' => null,
        ];
    }
}
