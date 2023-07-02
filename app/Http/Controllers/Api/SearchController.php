<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SearchService;
use App\Traits\ResponseTrait;
use App\Http\Requests\SearchRequest\SearchRequest;

class SearchController extends Controller
{
    use ResponseTrait;

    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * Method searchAreaByName
     *
     * @param SearchAreaRequest $request [explicite description]
     *
     * @return object
     */
    public function search(SearchRequest $request): object
    {
        $type = $request->type;

        // Call method getData from searchService for search
        $data = $this->searchService->getData($request->validated());

        if (!$data->isEmpty()) {
            return $this->responseSuccess(
                __('string.response.get.success', ['name' => $type]),
                $data
            );
        }
        return $this->responseError(
            __('string.response.get.fail', ['name' => $type]),
            $data
        );
    }
}
