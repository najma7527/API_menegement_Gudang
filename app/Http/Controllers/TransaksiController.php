<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Services\TransaksiService;

class TransaksiController extends Controller
{
    protected $transaksiService;

    public function __construct(TransaksiService $transaksiService)
    {
        $this->transaksiService = $transaksiService;
    }

    public function index()
    {
        $data = $this->transaksiService->getAllTransaksi();
        return response()->json($data);
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
