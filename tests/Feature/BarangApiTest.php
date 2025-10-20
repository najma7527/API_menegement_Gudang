<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Barang;

class BarangApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_barang()
    {
        $katagori = \App\Models\Katagori::factory()->create();
        $data = [
            'nama' => 'Barang Test',
            'katagori_id' => $katagori->id,
            'stok' => 10,
            'harga' => 10000
        ];
        $response = $this->postJson('/api/barang', $data);
        $response->assertStatus(201)
                 ->assertJsonFragment(['nama' => 'Barang Test']);
    }

    public function test_can_get_barang_list()
    {
        Barang::factory()->count(3)->create();
        $response = $this->getJson('/api/barang');
        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_can_update_barang()
    {
        $barang = Barang::factory()->create();
        $data = ['nama' => 'Barang Updated'];
        $response = $this->putJson('/api/barang/' . $barang->id, $data);
        $response->assertStatus(200)
                 ->assertJsonFragment(['nama' => 'Barang Updated']);
    }

    public function test_can_delete_barang()
    {
        $barang = Barang::factory()->create();
        $response = $this->deleteJson('/api/barang/' . $barang->id);
        $response->assertStatus(204);
    }
}
