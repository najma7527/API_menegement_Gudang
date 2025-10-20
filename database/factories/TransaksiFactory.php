<?php
namespace Database\Factories;

use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransaksiFactory extends Factory
{
    protected $model = Transaksi::class;

    public function definition()
    {
        return [
            'barang_id' => 1, // Akan di-set di test
            'jumlah' => $this->faker->numberBetween(1, 10),
            'total_harga' => $this->faker->numberBetween(1000, 100000),
            'tipe_transaksi' => 'masuk',
            'harga_satuan' => $this->faker->numberBetween(1000, 100000),
            'tanggal' => $this->faker->date('Y-m-d')
        ];
    }
}
