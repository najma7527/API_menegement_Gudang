<?php
namespace Repositories\Eloquent;

use App\Models\katagori;
use Repositories\Interfaces\KatagoriInterface;

class KatagoriRepository implements KatagoriInterface
{
	 public function all($userId = null)
    {
        if ($userId) {
            return Katagori::where('user_id', $userId)->get();
        }
        return Katagori::all();
    }

	 public function getByUserId($userId)
    {
        return Katagori::where('user_id', $userId)->get();
    }

	public function find($id)
	{
		return katagori::findOrFail($id);
	}

	public function create(array $data)
	{
		return katagori::create($data);
	}

	public function update($id, array $data)
	{
		$katagori = katagori::findOrFail($id);
		$katagori->update($data);
		return $katagori;
	}

	public function delete($id)
	{
		$katagori = katagori::findOrFail($id);
		$katagori->delete();
		return true;
	}
}
