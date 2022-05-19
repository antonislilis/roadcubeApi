<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\StoreStoreSearchRequest;
use App\Repositories\StoreRepository;
use DB;
use Illuminate\Http\Response;

class StoresController extends Controller
{
    public function __construct(protected StoreRepository $storeRepository)
    {
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoreRequest $request)
    {
        $content = $request->json()->all();
        DB::select( DB::raw("SELECT setval(pg_get_serial_sequence('stores', 'store_id'), max(store_id)) FROM stores;"));
        /*if ($wrongRequestMessages = $this->storeService->getRequestArrayWrongMessages($content)) {
            return response($wrongRequestMessages, Response::HTTP_BAD_REQUEST);
        }*/
        $stored = $this->storeRepository->create($content);

        if (!$stored) {
            return response('Store cannot be saved', Response::HTTP_BAD_REQUEST);
        }
        return response($stored, Response::HTTP_CREATED);
    }
}
