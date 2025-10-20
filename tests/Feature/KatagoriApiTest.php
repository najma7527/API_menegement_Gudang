<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Katagori;

class KatagoriApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_katagori()
    {
        $data = [
            'nama' => 'Elektronik',
        ];
        $response = $this->postJson('/api/katagori', $data);
        $response->assertStatus(201)
                 ->assertJsonFragment(['nama' => 'Elektronik']);
    }

    public function test_can_get_katagori_list()
    {
        Katagori::factory()->count(3)->create();
        $response = $this->getJson('/api/katagori');
        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_can_update_katagori()
    {
        $katagori = Katagori::factory()->create();
        $data = ['nama' => 'Pakaian'];
        $response = $this->putJson('/api/katagori/' . $katagori->id, $data);
        $response->assertStatus(200)
                 ->assertJsonFragment(['nama' => 'Pakaian']);
    }

    public function test_can_delete_katagori()
    {
        $katagori = Katagori::factory()->create();
        $response = $this->deleteJson('/api/katagori/' . $katagori->id);
        $response->assertStatus(204);
    }
}
