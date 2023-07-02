<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Admin\CategoryService;
use App\Traits\ColumnSelectedTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CategoryRequest\StoreRequest;
use App\Http\Requests\Admin\ImageRequest\IconRequest;

class CategoryController extends Controller
{
    use ResponseTrait;
    use ColumnSelectedTrait;

    protected $categoryService;

    /**
     * constructor function
     *
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $category = $this->categoryService->get(
            $request->input('_limit', config('define.paginate.default'))
        );

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => Category::NAME]),
            $category,
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
     * @param StoreRequest $request
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        try {
            //method call to the $this->containerGarbageService object to add a new Service
            //to the system based on the validated data from the request sent by the client.
            $category = $this->categoryService
                ->store($request->validated());

            return $this->responseSuccess(
                __('string.response.store.success', ['name' => Category::NAME]),
                $category,
            );
        } catch (\Throwable $th) {
            return $this->responseError(
                __('string.response.store.fail', ['name' => Category::NAME])
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
     */
    /**
     * Update the specified resource in storage.
     *
     * @param StoreRequest $request
     * @param int $id
     * @return mixed
     */
    public function update(StoreRequest $request, int $id)
    {
        try {
            //method call to the $this->categoryService object to update an ContainerGarbageType
            //with the specified $id using the validated data from the $request.
            $category = $this->categoryService
                ->update($request->validated(), $id);

            return $this->responseSuccess(
                __('string.response.update.success', ['name' => Category::NAME]),
                $category
            );
        } catch (\Throwable $th) {
            return $this->responseError(
                __('string.response.update.fail', ['name' => Category::NAME])
            );
        }
    }

    /**
     * method destroy
     *
     * @param string $id
     * @return object
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Category::findOrFail($id)->delete();

            return $this->responseSuccess(
                __('string.response.delete.success', ['name' => Category::NAME])
            );
        } catch (\Exception) {
            return $this->responseError(
                __('string.response.delete.fail', ['name' => Category::NAME])
            );
        }
    }

    /**
     * update_icon function
     *
     * @param IconRequest $request
     * @param $id
     * @return mixed
     */
    public function update_icon(IconRequest $request, $id)
    {
        // Update container garbage types of service record with the validated request data and the given ID.
        $category = $this->categoryService->updateIcon($request->validated(), $id);
        if ($category) {
            return $this->responseSuccess(
                __('string.response.update.success', ['name' => Category::NAME]),
                $category
            );
        }
        return $this->responseError(
            __('string.response.update.fail', ['name' => Category::NAME]),
        );
    }
}
