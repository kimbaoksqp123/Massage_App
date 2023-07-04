<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MassageFacility;
use App\Models\User;
use Carbon\Carbon;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CreateRequest>
 */
class CreateRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $facilityIds = MassageFacility::all()->pluck('id')->toArray();
        $userIds = user::whereNot('id', 1)->pluck('id')->toArray();
        return [
            'facilityID' => $this->faker->randomElement($facilityIds),
            'userID' => $this->faker->randomElement($userIds),
            'requestStatus' => $this->faker->randomElement([0,1,2]),
            'createdDate' => new Carbon('2023-07-03'),
        ];
    }
}
