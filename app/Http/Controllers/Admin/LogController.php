<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\LogRepository;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
    public function __construct(protected LogRepository $logRepository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = $this->logRepository->orderBy('created_at', 'desc')->get();
        return response()->json($stores, Response::HTTP_OK);
    }

    public function destroy()
    {
        $stores = $this->logRepository->truncate();
        return response()->json([
            'message' => 'All logs have been deleted'], Response::HTTP_NO_CONTENT );
    }
}
