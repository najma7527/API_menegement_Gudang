<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Services\TransaksiService;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    protected $transaksiService;

    public function __construct(TransaksiService $transaksiService)
    {
        $this->transaksiService = $transaksiService;
    }

    public function index(Request $request)
    {
        try {
            // Jika ada parameter user_id, filter by user
            if ($request->has('user_id') && $request->user_id) {
                $data = $this->transaksiService->getTransaksiByUserId($request->user_id);
            } else {
                // Jika tidak ada parameter, ambil semua (atau bisa juga berdasarkan user yang login)
                $data = $this->transaksiService ->getAllTransaksi();
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
            $data = $this->transaksiService->getTransaksiByUserId($userId);
            
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
        $data = $this->transaksiService->getTransaksiById($id);
        return response()->json($data);
    }

    public function store(StoreTransaksiRequest $request)
    {
        $data = $this->transaksiService->createTransaksi($request->validated());
        return response()->json($data, 201);
    }

    public function update(UpdateTransaksiRequest $request, $id)
    {
        $data = $this->transaksiService->updateTransaksi($id, $request->validated());
        return response()->json($data);
    }

    public function destroy($id)
    {
        $this->transaksiService->deleteTransaksi($id);
        return response()->json(null, 204);
    }
}