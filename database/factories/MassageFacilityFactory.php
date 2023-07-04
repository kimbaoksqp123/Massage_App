<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MassageFacility;
use App\Models\CreateRequest;
use App\Models\User;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MassageFacility>
 */
class MassageFacilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (MassageFacility $massageFacility) {
            $requestStatus = $massageFacility->isActive == 1 ? 1 : Arr::random([0,2]);
            CreateRequest::factory(1)->create(
                [
                    'facilityID' => $massageFacility->id,
                    'userID' => $massageFacility->ownerID ?? $massageFacility->id,
                    'requestStatus' => $requestStatus,
                ]
            );
        });
    }
}
