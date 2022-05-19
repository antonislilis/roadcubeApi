<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\StoreRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Properties\StoreStoreRequest;
use App\Services\Admin\StoreService;
use Illuminate\Http\Response;

class StoresAdminController extends Controller
{
    protected $storeService;
    protected $storeRepository;

    public function __construct(StoreService $storeService, StoreRepository $storeRepository)
    {
        $this->storeService = $storeService;
        $this->storeRepository = $storeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $stores = $this->storeRepository->all();
        return response()->json($stores, Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoreRequest $request)
    {
        $content = $request->json()->all();

        if ($wrongRequestMessages = $this->propertyService->getRequestArrayWrongMessages($content)) {
            return response($wrongRequestMessages, Response::HTTP_BAD_REQUEST);
        }
        $stored = $this->storeRepository->create($content);

        if (!$stored) {
            return response('Store cannot be saved', Response::HTTP_BAD_REQUEST);
        }
        return response($stored, Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
