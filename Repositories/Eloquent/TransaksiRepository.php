<?php
namespace Repositories\Eloquent;

use App\Models\transaksi;
use Repositories\Interfaces\CrudInterface;

class TransaksiRepository implements CrudInterface
{
    public function all()
    {
        return transaksi::all();
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
