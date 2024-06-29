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

        return [
            'parking_id' => \Modules\Parking\Models\Parking::factory(),  // Assuming you have a ParkingSpot model and factory
            'resident_id' => \App\Models\User::factory(),  // Assuming you have a Resident model and factory
            'allocation_date' => $allocationDate,
            'expiration_date' => $expirationDate,
            'status' => $this->faker->randomElement(['Expired', 'Active', 'Upcoming']),
            'created_by' => \App\Models\User::factory(),  // Assuming you have a User model and factory
            'updated_by' => \App\Models\User::factory(),  // Assuming you have a User model and factory
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
