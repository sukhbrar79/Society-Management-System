<?php

namespace Modules\Complaint\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ComplaintFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Complaint\Models\Complaint::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $blockIds = \Modules\Block\Models\Block::pluck('id')->toArray();
        $flatIds = \Modules\Flat\Models\Flat::pluck('id')->toArray();
        $userIds = \App\Models\User::pluck('id')->toArray();

        return [
            'subject' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['pending','in_progress','resolved','closed']), // Adjust as needed
            'priority' => $this->faker->randomElement(['low','medium','high']), // Adjust as needed
            'block_id' => $this->faker->randomElement($blockIds),
            'flat_id' => $this->faker->randomElement($flatIds), // Example range for floor
            'user_id' => $this->faker->randomElement($userIds), // Example range for floor
            'created_by' => null, // Adjust as needed
            'updated_by' => null, // Adjust as needed
            'deleted_by' => null, // Adjust as needed
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ];
    }
}
