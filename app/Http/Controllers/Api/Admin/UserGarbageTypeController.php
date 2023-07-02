<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserGarbageType;
use App\Http\Requests\Admin\UserGarbageRequest\UserGarbageRequest;
use App\Traits\ResponseTrait;
use App\Services\UserGarbageTypeService;

class UserGarbageTypeController extends Controller
{
    use ResponseTrait;

    protected $userGarbageTypeService;

    /**
     * constructor function
     *
     * @param UserGarbageTypeService $userGarbageTypeService
     */
    public function __construct(UserGarbageTypeService $userGarbageTypeService)
    {
        $this->userGarbageTypeService = $userGarbageTypeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        /**
         * calls the getAreas method on the $this->areaService object to retrieve a list of areas
         * the _limit value from provided (config('define.paginate.default')).
         */
        $userGarbage = $this->userGarbageTypeService->get(
            $request->input('_limit', config('define.paginate.default'))
        );
        return $this->responseSuccess(
            __('string.response.get.success', ['name' => UserGarbageType::NAME]),
            $userGarbage,
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserGarbageRequest $request
     * @return mixed
     */
    public function store(UserGarbageRequest $request)
    {
        //method call to the $this->userGarbageTypeService object to add a new UserGarbageType
        //to the system based on the validated data from the request sent by the client.
        $userGarbageType = $this->userGarbageTypeService->store($request->validated());

        return $this->responseSuccess(
            __('string.response.store.success', ['name' => UserGarbageType::NAME]),
            $userGarbageType,
        );
    }

    /**
     * Display the specified resource.
     *
     * @param integer $id
     * @return mixed
     */
    public function show(int $id)
    {
        $userGarbageType = $this->userGarbageTypeService->show($id);
        return $this->responseSuccess(
            __('string.response.store.success', ['name' => UserGarbageType::NAME]),
            $userGarbageType,
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserGarbageRequest $request
     * @param int $id
     * @return mixed
     */
    public function update(UserGarbageRequest $request, int $id)
    {
        try {
            //method call to the $this->userGarbageTypeService object to update an UserGarbageType
            //with the specified $id using the validated data from the $request.
            $userGarbageType = $this->userGarbageTypeService
                ->update($request->validated(), $id);

            return $this->responseSuccess(
                __('string.response.update.success', ['name' => UserGarbageType::NAME]),
                $userGarbageType
            );
        } catch (\Throwable $th) {
            return $this->responseError(
                __('string.response.update.fail', ['name' => UserGarbageType::NAME])
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
