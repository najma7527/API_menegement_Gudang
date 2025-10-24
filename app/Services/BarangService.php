<?php
namespace App\Services;

use Repositories\Interfaces\BarangRepositoryInterface;

class BarangService
{
    protected $barangRepository;

    public function __construct(BarangRepositoryInterface $barangRepository)
    {
        $this->barangRepository = $barangRepository;
    }

     public function getAllBarang($userId = null)
    {
        return $this->barangRepository->all($userId);
    }

    public function getBarangByUserId($userId)
    {
        return $this->barangRepository->getByUserId($userId);
    }

    public function getBarangById($id)
    {
        return $this->barangRepository->find($id);
    }

    public function createBarang(array $data)
    {
        return $this->barangRepository->create($data);
    }

    public function updateBarang($id, array $data)
    {
        return $this->barangRepository->update($id, $data);
    }

    public function deleteBarang($id)
    {
        return $this->barangRepository->delete($id);
    }
}