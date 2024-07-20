<?php

namespace Modules\Parking\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ParkingAllocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Parking\Models\ParkingAllocation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $allocationDate = $this->faker->dateTimeThisYear();
        $expirationDate = (clone $allocationDate)->modify('+1 month');

        $userIds = \App\Models\User::whereHas('roles', function($query) {
            $query->where('name', 'resident');
        })->pluck('id')->toArray();

        $managerIds = \App\Models\User::whereHas('roles', function($query) {
            $query->where('name', 'manager');
        })->pluck('id')->toArray();

        $parkingIds = \Modules\Parking\Models\Parking::pluck('id')->toArray();

        return [
            'parking_id' => $this->faker->randomElement($parkingIds),  // Assuming you have a ParkingSpot model and factory
            'resident_id' => $this->faker->randomElement($managerIds),  // Assuming you have a Resident model and factory
            'allocation_date' => $allocationDate,
            'expiration_date' => $expirationDate,
            'status' => $this->faker->randomElement(['Expired', 'Active', 'Upcoming']),
            'created_by' => $this->faker->randomElement($managerIds),  // Assuming you have a User model and factory
            'updated_by' => $this->faker->randomElement($managerIds),  // Assuming you have a User model and factory
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
