<?php

namespace Modules\Parking\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ParkingRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Parking\Models\ParkingRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'resident_id' => \App\Models\User::factory(),  // Assuming you have a Resident model and factory
            'parking_id' => \Modules\Parking\Models\Parking::factory(), // Assuming you have a ParkingSpot model and factory
            'request_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['Pending', 'Approved', 'Rejected']),
            'created_by' => \App\Models\User::factory(),  // Assuming you have a User model and factory
            'updated_by' => \App\Models\User::factory(),  // Assuming you have a User model and factory
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
