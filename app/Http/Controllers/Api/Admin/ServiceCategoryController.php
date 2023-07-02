<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Services\Admin\ServiceCategoryService;
use App\Http\Requests\Admin\ServiceCategoryRequest\StoreServiceCategoryRequest;
use App\Models\ServiceCategory;

/**
 * Summary of ServiceCategoryController
 */
class ServiceCategoryController extends Controller
{
    use ResponseTrait;

    protected $categoryService;

    /**
     * Summary of __construct
     * @param ServiceCategoryService $categoryService
     */
    public function __construct(ServiceCategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request - The HTTP request object
     * @return \Illuminate\Http\JsonResponse - The JSON response object
     */
    public function index(Request $request)
    {
        /**
         * calls the get method on the $this->categoryService object to retrieve a list of CategoryServices
         *The _limit value from provided (config('define.paginate.default')).
         */
        $categoryService = $this->categoryService->get(
            $request->input('_limit', config('define.paginate.default'))
        );

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => ServiceCategory::NAME]),
            $categoryService,
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
     * @param StoreServiceCategoryRequest $request - The HTTP request object
     * @return \Illuminate\Http\JsonResponse - The JSON response object
     */
    public function store(StoreServiceCategoryRequest $request)
    {
        try {
            //method call to the $this->categoryService object to add a new ServiceCategory
            //to the system based on the validated data from the request sent by the client.
            $serviceCategory = $this->categoryService
                ->store($request->validated());

            return $this->responseSuccess(
                __('string.response.store.success', ['name' => ServiceCategory::NAME]),
                $serviceCategory,
            );
        } catch (\Throwable $th) {
            return $this->responseError(
                __('string.response.store.fail', ['name' => ServiceCategory::NAME])
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
     * @param StoreServiceCategoryRequest $request - The HTTP request object
     * @param int $id - The ID of the resource to be updated
     * @return \Illuminate\Http\JsonResponse - The JSON response object
     */
    public function update(StoreServiceCategoryRequest $request, int $id)
    {
        try {
            //method call to the $this->categoryService object to update an ServiceCategory with
            //the specified $id using the validated data from the $request.
            $serviceCategory = $this->categoryService
                ->update($request->validated(), $id);

            return $this->responseSuccess(
                __('string.response.update.success', ['name' => ServiceCategory::NAME]),
                $serviceCategory
            );
        } catch (\Throwable $th) {
            return $this->responseError(
                __('string.response.update.fail', ['name' => ServiceCategory::NAME])
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            //deletion operation for an ServiceCategory with the specified $id.
            ServiceCategory::findOrFail($id)->delete();

            return $this->responseSuccess(
                __('string.response.delete.success', ['name' => ServiceCategory::NAME])
            );
        } catch (\Exception) {
            return $this->responseError(
                __('string.response.delete.fail', ['name' => ServiceCategory::NAME])
            );
        }
    }
}
