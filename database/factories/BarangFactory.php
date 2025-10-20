<?php
namespace Database\Factories;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Factories\Factory;

class BarangFactory extends Factory
{
    protected $model = Barang::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->word(),
            'katagori_id' => \App\Models\Katagori::factory()->create()->id,
            'stok' => $this->faker->numberBetween(1, 100),
            'harga' => $this->faker->numberBetween(1000, 100000)
        ];
    }
}
