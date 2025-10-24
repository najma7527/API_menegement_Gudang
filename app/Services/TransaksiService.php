<?php
namespace App\Services;

use Repositories\Interfaces\CrudInterface;

class TransaksiService
{
    protected $transaksiRepository;

    public function __construct(CrudInterface $transaksiRepository)
    {
        $this->transaksiRepository = $transaksiRepository;
    }

     public function getAllTransaksi($userId = null)
    {
        return $this->transaksiRepository->all($userId);
    }

    public function getTransaksiByUserId($userId)
    {
        return $this->transaksiRepository->getByUserId($userId);
    }

    public function getTransaksiById($id)
    {
        return $this->transaksiRepository->find($id);
    }

    public function createTransaksi(array $data)
    {
        return $this->transaksiRepository->create($data);
    }

    public function updateTransaksi($id, array $data)
    {
        return $this->transaksiRepository->update($id, $data);
    }

    public function deleteTransaksi($id)
    {
        return $this->transaksiRepository->delete($id);
    }
}
