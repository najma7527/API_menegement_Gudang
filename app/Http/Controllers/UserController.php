<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\AuthService;

class UserController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
        $data = $this->authService->getAllUsers();
        return response()->json($data);
    }

    public function show($id)
    {
        $data = $this->authService->getUserById($id);
        return response()->json($data);
    }

    public function store(StoreUserRequest $request)
    {
        $data = $this->authService->createUser($request->validated());
        return response()->json($data, 201);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $data = $this->authService->updateUser($id, $request->validated());
        return response()->json($data);
    }

    public function destroy($id)
    {
        $this->authService->deleteUser($id);
        return response()->json(null, 204);
    }
}
