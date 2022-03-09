<?php

namespace Database\Factories;

use App\Models\PublicationVisit;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicationVisitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PublicationVisit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subscriber_id' => 0,
            'publication_id' =>1,
            'view' => 1,
            'click' => 1,
            'status' => 1
        ];
    }

}
