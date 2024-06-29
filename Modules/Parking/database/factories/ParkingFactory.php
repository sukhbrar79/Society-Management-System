<?php

namespace Modules\Parking\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ParkingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Parking\Models\Parking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'spot_number' => $this->faker->bothify('##??'),
            'spot_type' => $this->faker->randomElement(['Compact', 'Standard', 'Large', 'Handicapped']),
            'location' => $this->faker->address,
            'created_by' => \App\Models\User::factory(),  // Assuming you have a User model and factory
            'updated_by' => \App\Models\User::factory(),  // Assuming you have a User model and factory
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
