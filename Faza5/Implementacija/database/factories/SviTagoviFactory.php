<?php

namespace Database\Factories;

use App\Models\bogdan\SviTagovi;
use Illuminate\Database\Eloquent\Factories\Factory;

class SviTagoviFactory extends Factory
{
    /**
     * The name of the factory's corresponding model
     *
     * @var string
     */
    protected $model = SviTagovi::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Name' => 'ApstractTag'
        ];
    }
}
