<?php

namespace Database\Factories;

use App\Models\MassageService;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ServicePrice;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MassageService>
 */
class MassageServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [];
    }
    public function configure(): static
    {
        return $this->afterCreating(function (MassageService $massageService) {
            ServicePrice::factory()->count(3)->sequence(
                ['price' => $this->faker->numberBetween(30, 45) * 10000, 'durationTime' => 60],
                ['price' => $this->faker->numberBetween(46, 60) * 10000, 'durationTime' => 90],
                ['price' => $this->faker->numberBetween(61, 80) * 10000, 'durationTime' => 120],
            )->create(['serviceID' => $massageService->id]);
        });
    }
}
