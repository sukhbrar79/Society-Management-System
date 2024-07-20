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
        $managerIds = \App\Models\User::whereHas('roles', function($query) {
            $query->where('name', 'manager');
        })->pluck('id')->toArray();
        return [
            'spot_number' => $this->faker->bothify('##??'),
            'spot_type' => $this->faker->randomElement(['Compact', 'Standard', 'Large', 'Handicapped']),
            'location' => $this->faker->address,
            'created_by' => $this->faker->randomElement($managerIds),  // Assuming you have a User model and factory
            'updated_by' => $this->faker->randomElement($managerIds),  // Assuming you have a User model and factory
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
