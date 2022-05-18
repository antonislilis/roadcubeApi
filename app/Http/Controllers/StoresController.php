<?php

namespace App\Http\Controllers;

use App\Filters\Filterer;
use App\Filters\Store\StoreNameFilter;
use App\Models\Store;
use Illuminate\Http\Request;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
       /* $stores = (new Filterer($request, Store::query()))
            ->filter([new StoreNameFilter()]);*/
        $stores = $this->storeRepository->query()
            ->filter($request)
            ->get();
        return response()->json($stores, Response::HTTP_OK);
        /*$stores = $this->storeRepository->all();
        $passed = $stores->filter(function ($value, $key) {
            return data_get($value, 'store_type_id') == 2;
        });
        $passed = $passed->all();
        return response()->json($passed, Response::HTTP_OK);*/
    }
}
