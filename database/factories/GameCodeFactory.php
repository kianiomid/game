<?php

namespace Database\Factories;

use App\Models\GameCode;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GameCodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GameCode::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Str::random(8),
            'code' => rand(1, 10),
            'descriptor' => strtoupper(Str::random(8)),
            'description' => Str::random(256),
        ];
    }
}
