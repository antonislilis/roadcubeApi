<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\LogRepository;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LogController extends Controller
{
    public function __construct(protected LogRepository $logRepository)
    {
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        $stores = $this->logRepository->orderBy('created_at', 'desc')->get();
        return response()->json($stores, ResponseAlias::HTTP_OK);
    }

    public function destroy()
    {
        $this->logRepository->truncate();
        return response()->json([
            'message' => 'All logs have been deleted'], ResponseAlias::HTTP_NO_CONTENT );
    }
}
