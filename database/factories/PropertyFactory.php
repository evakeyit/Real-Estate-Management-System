<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition(): array
    {
        $types = ['Apartment', 'House', 'Villa', 'Commercial', 'Land'];

        return [
            'type' => fake()->randomElement($types),
            'price' => fake()->randomFloat(2, 50000, 2500000),
            'location' => fake()->city().', '.fake()->streetAddress(),
        ];
    }
}
