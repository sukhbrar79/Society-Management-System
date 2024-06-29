<?php

namespace Modules\Flat\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FlatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Flat\Models\Flat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $blockIds = \Modules\Block\Models\Block::pluck('id')->toArray();

        return [
            'name' => rand(1,100).chr(rand(65,75)),
            'slug' => Str::slug($this->faker->unique()->name),
            'description' => $this->faker->paragraph,
            'status' => $this->faker->numberBetween(0, 1), // Adjust as needed
            'block_id' => $this->faker->randomElement($blockIds),
            'floor' => $this->faker->numberBetween(1, 10), // Example range for floor
            'rooms' => $this->faker->numberBetween(1, 5), // Example range for rooms
            'created_by' => null, // Adjust as needed
            'updated_by' => null, // Adjust as needed
            'deleted_by' => null, // Adjust as needed
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ];
    }
}
