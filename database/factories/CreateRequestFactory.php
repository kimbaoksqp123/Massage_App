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
        $userIds = User::whereNot('userType', 2)->pluck('id')->toArray();
        return [
            'createdDate' => Carbon::now()->format('Y-m-d'),
        ];
    }
}
