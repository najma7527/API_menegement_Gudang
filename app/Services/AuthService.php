<?php
namespace App\Services;

use Repositories\Eloquent\UserRepository;

class AuthService
{
	protected $userRepository;

	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	public function getAllUsers()
	{
		return $this->userRepository->all();
	}

	public function getUserById($id)
	{
		return $this->userRepository->find($id);
	}

	public function createUser(array $data)
	{
		return $this->userRepository->create($data);
	}

	public function updateUser($id, array $data)
	{
		return $this->userRepository->update($id, $data);
	}

	public function deleteUser($id)
	{
		return $this->userRepository->delete($id);
	}
}
