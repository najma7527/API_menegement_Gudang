<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Services\BarangService;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    protected $barangService;

    public function __construct(BarangService $barangService)
    {
        $this->barangService = $barangService;
    }

     public function index(Request $request)
    {
        try {
            // Jika ada parameter user_id, filter by user
            if ($request->has('user_id') && $request->user_id) {
                $data = $this->barangService->getBarangByUserId($request->user_id);
            } else {
                // Jika tidak ada parameter, ambil semua (atau bisa juga berdasarkan user yang login)
                $data = $this->barangService->getAllBarang();
            }
            
            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Data barang berhasil diambil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data barang: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getByUser($userId)
    {
        try {
            $data = $this->barangService->getBarangByUserId($userId);
            
            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Data barang user berhasil diambil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data barang user: ' . $e->getMessage()
            ], 500);
        }
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