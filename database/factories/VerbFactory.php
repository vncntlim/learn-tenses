<?php

use App\Models\Verb;
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VerbFactory extends Factory
{

    protected $model = Verb::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'verb' => '',
            'sentences' => '',
        ];
    }
}
