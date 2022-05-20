<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\StoreStoreSearchRequest;
use App\Repositories\StoreRepository;
use DB;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class StoresController extends Controller
{
    public function __construct(protected StoreRepository $storeRepository)
    {
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        $stores = $this->storeRepository->all();
        return response()->json($stores, ResponseAlias::HTTP_OK);
    }


    public function search(StoreStoreSearchRequest $request): \Illuminate\Http\JsonResponse
    {
        $stores = $this->storeRepository->query()
            ->filter($request)
            ->get();
        return response()->json($stores, ResponseAlias::HTTP_OK);
    }


    public function store(StoreStoreRequest $request): Response
    {
        $content = $request->json()->all();
        DB::select( DB::raw("SELECT setval(pg_get_serial_sequence('stores', 'store_id'), max(store_id)) FROM stores;"));

        $stored = $this->storeRepository->create($content);

        if (!$stored) {
            return response('Store cannot be saved', ResponseAlias::HTTP_BAD_REQUEST);
        }
        return response($stored, ResponseAlias::HTTP_CREATED);
    }
}
