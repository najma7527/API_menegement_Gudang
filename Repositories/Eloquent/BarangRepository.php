<?php
namespace Repositories\Eloquent;

use App\Models\Barang;
use Repositories\Interfaces\BarangRepositoryInterface;

class BarangRepository implements BarangRepositoryInterface
{
	 public function all($userId = null)
    {
        if ($userId) {
            return Barang::where('user_id', $userId)->get();
        }
        return Barang::all();
    }

	 public function getByUserId($userId)
    {
        return Barang::where('user_id', $userId)->get();
    }

	public function find($id)
	{
	return Barang::findOrFail($id);
	}

	public function create(array $data)
	{
	return Barang::create($data);
	}

	public function update($id, array $data)
	{
	$barang = Barang::findOrFail($id);
		$barang->update($data);
		return $barang;
	}

	public function delete($id)
	{
	$barang = Barang::findOrFail($id);
		$barang->delete();
		return true;
	}
}
