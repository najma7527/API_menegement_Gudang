<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKatagoriRequest;
use App\Http\Requests\UpdateKatagoriRequest;

use App\Services\KatagoriService;

class KatagoriController extends Controller
{
    protected $katagoriService;

    public function __construct(KatagoriService $katagoriService)
    {
        $this->katagoriService = $katagoriService;
    }

    public function index()
    {
        $data = $this->katagoriService->getAllKatagori();
        return response()->json($data);
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
