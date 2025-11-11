<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ticket;
use App\Models\Customer;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),
            'subject' => $this->faker->sentence(4),
            'body' => $this->faker->paragraph,
            'status' => 'new',
        ];
    }
}
