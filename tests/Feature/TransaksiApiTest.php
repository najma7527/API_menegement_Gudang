<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Transaksi;
use App\Models\Barang;
use App\Models\Katagori;

class TransaksiApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_transaksi()
    {
        $katagori = Katagori::factory()->create();
        $barang = Barang::factory()->create(['katagori_id' => $katagori->id]);
        $data = [
            'barang_id' => $barang->id,
            'jumlah' => 5,
            'total_harga' => 50000,
            'tipe_transaksi' => 'masuk',
            'harga_satuan' => 10000,
            'tanggal' => now()->toDateString()
        ];
        $response = $this->postJson('/api/transaksi', $data);
        $response->assertStatus(201)
                 ->assertJsonFragment(['barang_id' => $barang->id]);
    }

    public function test_can_get_transaksi_list()
    {
        $katagori = Katagori::factory()->create();
        $barang = Barang::factory()->create(['katagori_id' => $katagori->id]);
        Transaksi::factory()->count(3)->create(['barang_id' => $barang->id]);
        $response = $this->getJson('/api/transaksi');
        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_can_update_transaksi()
    {
        $katagori = Katagori::factory()->create();
        $barang = Barang::factory()->create(['katagori_id' => $katagori->id]);
        $transaksi = Transaksi::factory()->create(['barang_id' => $barang->id]);
        $data = ['jumlah' => 10];
        $response = $this->putJson('/api/transaksi/' . $transaksi->id, $data);
        $response->assertStatus(200)
                 ->assertJsonFragment(['jumlah' => 10]);
    }

    public function test_can_delete_transaksi()
    {
        $katagori = Katagori::factory()->create();
        $barang = Barang::factory()->create(['katagori_id' => $katagori->id]);
        $transaksi = Transaksi::factory()->create(['barang_id' => $barang->id]);
    $response = $this->deleteJson('/api/transaksi/' . $transaksi->id);
    $response->assertStatus(204);
    }
}
