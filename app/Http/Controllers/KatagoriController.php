<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKatagoriRequest;
use App\Http\Requests\UpdateKatagoriRequest;
use Illuminate\Http\Request;

use App\Services\KatagoriService;

class KatagoriController extends Controller
{
    protected $katagoriService;

    public function __construct(KatagoriService $katagoriService)
    {
        $this->katagoriService = $katagoriService;
    }

     public function index(Request $request)
    {
        try {
            // Jika ada parameter user_id, filter by user
            if ($request->has('user_id') && $request->user_id) {
                $data = $this->katagoriService->getkatagoriByUserId($request->user_id);
            } else {
                // Jika tidak ada parameter, ambil semua (atau bisa juga berdasarkan user yang login)
                $data = $this->katagoriService->getAllKatagori();
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

    // Endpoint khusus untuk mendapatkan barang by user ID
    public function getByUser($userId)
    {
        try {
            $data = $this->katagoriService->getKatagoriByUserId($userId);
            
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
        $data = $this->katagoriService->getKatagoriById($id);
        return response()->json($data);
    }

    public function store(StoreKatagoriRequest $request)
    {
        $data = $this->katagoriService->createKatagori($request->validated());
        return response()->json($data, 201);
    }

    public function update(UpdateKatagoriRequest $request, $id)
    {
        $data = $this->katagoriService->updateKatagori($id, $request->validated());
        return response()->json($data);
    }

    public function destroy($id)
    {
        $this->katagoriService->deleteKatagori($id);
        return response()->json(null, 204);
    }
}
