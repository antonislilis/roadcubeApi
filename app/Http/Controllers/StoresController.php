<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreSearchRequest;
use App\Repositories\StoreRepository;
use Illuminate\Http\Response;

class StoresController extends Controller
{
    protected $storeRepository;

    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = $this->storeRepository->all();
        return response()->json($stores, Response::HTTP_OK);
    }


    public function search(StoreStoreSearchRequest $request)
    {
        $stores = $this->storeRepository->query()
            ->filter($request)
            ->get();
        return response()->json($stores, Response::HTTP_OK);
    }
}
