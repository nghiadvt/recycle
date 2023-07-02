<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceArticle;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Services\Admin\ServiceArticleService;
use App\Http\Requests\Admin\ServiceArticleRequest\StoreServiceArticleRequest;

class ServiceArticleController extends Controller
{
    use ResponseTrait;

    protected $serviceArticleService;

    public function __construct(ServiceArticleService $serviceArticleService)
    {
        $this->serviceArticleService = $serviceArticleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $serviceArticle = $this->serviceArticleService->get(
            $request->input('_limit', config('define.paginate.default'))
        );

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => ServiceArticle::NAME]),
            $serviceArticle
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
     */
    public function store(StoreServiceArticleRequest $request)
    {
        try {
            //method call to the $this->serviceArticleService object to add a new ServiceArticle to the system
            // based on the validated data from the request sent by the client.
            $serviceArticle = $this->serviceArticleService
                ->store($request->validated());

            return $this->responseSuccess(
                __('string.response.store.success', ['name' => ServiceArticle::NAME]),
                $serviceArticle,
            );
        } catch (\Throwable $th) {
            return $this->responseError(
                __('string.response.store.fail', ['name' => ServiceArticle::NAME])
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
     * @param StoreServiceArticleRequest $request - The HTTP request object
     * @param int $id - The ID of the resource to be updated
     * @return \Illuminate\Http\JsonResponse - The JSON response object
     */
    public function update(StoreServiceArticleRequest $request, int $id)
    {
        try {
            //method call to the $this->serviceArticleService object to update an ServiceArticle
            //with the specified $id using the validated data from the $request.
            $serviceArticle = $this->serviceArticleService
                ->update($request->validated(), $id);

            return $this->responseSuccess(
                __('string.response.update.success', ['name' => ServiceArticle::NAME]),
                $serviceArticle
            );
        } catch (\Throwable $th) {
            return $this->responseError(
                __('string.response.update.fail', ['name' => ServiceArticle::NAME])
            );
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            //deletion operation for an ServiceArticle with the specified $id.
            ServiceArticle::findOrFail($id)->delete();

            return $this->responseSuccess(
                __('string.response.delete.success', ['name' => ServiceArticle::NAME])
            );
        } catch (\Exception) {
            return $this->responseError(
                __('string.response.delete.fail', ['name' => ServiceArticle::NAME])
            );
        }
    }
}
