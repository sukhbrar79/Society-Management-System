<?php

namespace Modules\Invoice\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Invoice\Models\Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'invoice_number' => $this->faker->unique()->numerify('INV####'), // Example format for invoice number
            'resident_id' => \App\Models\User::factory(), // Assuming you have a Resident model and factory
            'amount' => $this->faker->randomFloat(2, 50, 1000), // Random amount between 50 and 1000 with 2 decimal places
            'invoice_date' => $this->faker->date(),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['Pending', 'Paid', 'Overdue']),
            'created_by' => \App\Models\User::factory(), // Assuming you have a User model and factory
            'updated_by' => \App\Models\User::factory(), // Assuming you have a User model and factory
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
