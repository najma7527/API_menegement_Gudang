<?php
namespace App\Services;

use Repositories\Interfaces\KatagoriInterface;

class KatagoriService
{
	protected $katagoriRepository;

	public function __construct(KatagoriInterface $katagoriRepository)
	{
		$this->katagoriRepository = $katagoriRepository;
	}

	 public function getAllKatagori($userId = null)
    {
        return $this->katagoriRepository->all($userId);
    }

    public function getKatagoriByUserId($userId)
    {
        return $this->katagoriRepository->getByUserId($userId);
    }

	public function getKatagoriById($id)
	{
		return $this->katagoriRepository->find($id);
	}

	public function createKatagori(array $data)
	{
		return $this->katagoriRepository->create($data);
	}

	public function updateKatagori($id, array $data)
	{
		return $this->katagoriRepository->update($id, $data);
	}

	public function deleteKatagori($id)
	{
		return $this->katagoriRepository->delete($id);
	}
}
