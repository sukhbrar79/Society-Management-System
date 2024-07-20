<?php

namespace Modules\Visitor\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VisitorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Visitor\Models\Visitor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $blockIds = \Modules\Block\Models\Block::pluck('id')->toArray();
        $flatIds = \Modules\Flat\Models\Flat::pluck('id')->toArray();
        $userIds = \App\Models\User::whereHas('roles', function($query) {
            $query->where('name', 'resident');
        })->pluck('id')->toArray();

        return [
            'name' => $this->faker->name,
            'contact_number' => $this->faker->phoneNumber,
            'purpose' => $this->faker->sentence,
            'vehicle_number' => strtoupper($this->faker->bothify('??## ???')),
            'block_id' => $this->faker->randomElement($blockIds),
            'flat_id' => $this->faker->randomElement($flatIds), // Example range for floor
            'resident_id' => $this->faker->randomElement($userIds), // Example range for floor
            'created_by' => null, // Adjust as needed
            'updated_by' => null, // Adjust as needed
            'deleted_by' => null, // Adjust as needed
            'check_in_time' => Carbon::now(),
            'check_out_time' => Carbon::now()->addHours(rand(1, 5)),
            'check_in_date' => Carbon::now(),
            'check_out_date' => Carbon::now()->addHours(rand(1, 5)),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ];
    }
}
