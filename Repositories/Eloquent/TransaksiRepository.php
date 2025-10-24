<?php
namespace Repositories\Eloquent;

use App\Models\transaksi;
use App\Models\Transaksi as ModelsTransaksi;
use Repositories\Interfaces\CrudInterface;

class TransaksiRepository implements CrudInterface
{
     public function all($userId = null)
    {
        if ($userId) {
            return Transaksi::where('user_id', $userId)->get();
        }
        return Transaksi::all();
    }

	 public function getByUserId($userId)
    {
        return Transaksi::where('user_id', $userId)->get();
    }

    public function find($id)
    {
        return transaksi::findOrFail($id);
    }

    public function create(array $data)
    {
        return transaksi::create($data);
    }

    public function update($id, array $data)
    {
        $transaksi = transaksi::findOrFail($id);
        $transaksi->update($data);
        return $transaksi;
    }

    public function delete($id)
    {
        $transaksi = transaksi::findOrFail($id);
        $transaksi->delete();
        return true;
    }
}
