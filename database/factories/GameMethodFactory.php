<?php

namespace Database\Factories;

use App\Models\GameMethod;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GameMethodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GameMethod::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'ارسال کل کلمه',
            'descriptor' => 'ALL_WORD',
            'enable' => true
        ];
    }
}
