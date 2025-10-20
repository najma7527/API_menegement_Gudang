<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;

use App\Services\BarangService;

class BarangController extends Controller
{
    protected $barangService;

    public function __construct(BarangService $barangService)
    {
        $this->barangService = $barangService;
    }

    public function index()
    {
        $data = $this->barangService->getAllBarang();
        return response()->json($data);
    }

    public function show($id)
    {
        $data = $this->barangService->getBarangById($id);
        return response()->json($data);
    }

    public function store(StoreBarangRequest $request)
    {
        $data = $this->barangService->createBarang($request->validated());
        return response()->json($data, 201);
    }

    public function update(UpdateBarangRequest $request, $id)
    {
        $data = $this->barangService->updateBarang($id, $request->validated());
        return response()->json($data);
    }

    public function destroy($id)
    {
        $this->barangService->deleteBarang($id);
        return response()->json(null, 204);
    }
}
