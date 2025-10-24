<?php
namespace Repositories\Interfaces;

interface BarangRepositoryInterface
{
	public function all($userId);
	public function find($id);
	public function create(array $data);
	public function update($id, array $data);
	public function delete($id);
	public function getByUserId($userId);
}
