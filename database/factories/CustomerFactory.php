<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'phone' => '+996' . $this->faker->numerify('7########'),
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
