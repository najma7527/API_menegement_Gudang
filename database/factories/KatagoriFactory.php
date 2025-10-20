<?php
namespace Database\Factories;

use App\Models\Katagori;
use Illuminate\Database\Eloquent\Factories\Factory;

class KatagoriFactory extends Factory
{
    protected $model = Katagori::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->word(),
            'deskripsi' => $this->faker->sentence(),
        ];
    }
}
