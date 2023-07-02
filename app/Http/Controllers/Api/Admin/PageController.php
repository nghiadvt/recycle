<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\PageService;
use App\Traits\ColumnSelectedTrait;
use App\Traits\ResponseTrait;
use App\Models\Page;
use App\Http\Requests\Admin\PageRequest\PageRequest;

class PageController extends Controller
{
    use ColumnSelectedTrait;
    use ResponseTrait;

    protected $pageService;

    /**
     * Constructor function for the PageController class.
     *
     * @param PageService $pageService
     *
     */
    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    /**
     * Get all record pages table
     *
     * @param Request $request
     *
     * @return object
     */
    public function index(Request $request): object
    {
        // Get the columns in request
        $columns = $this->columnSelected($request);
        $type = $request->type;

        // Call method getTermAndPrivacies from pageService to get list term and privacy.
        $data = $this->pageService->getTermAndPrivacies($columns, $type);

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => Page::NAME]),
            $data
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
     * Store a newly created record in table pages
     *
     * @param PageRequest $request
     *
     * @return object
     */
    public function store(PageRequest $request): object
    {
        // Call method addItem from pageService to add a record in table pages.
        $data = $this->pageService->addItem($request->validated());

        return $this->responseSuccess(
            __('string.response.store.success', ['name' => Page::NAME]),
            $data
        );
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
     * Method update
     *
     * @param PageRequest $request
     * @param int $id
     *
     * @return object
     */
    public function update(PageRequest $request, int $id): object
    {
        // Update a term or a privacy record with the validated request data and the given ID.
        $data = $this->pageService->updateItem($id, $request->validated());

        if (!$data) {
            return $this->responseError(
                __('string.response.update.fail', ['name' => Page::NAME]),
            );
        }

        return $this->responseSuccess(
            __('string.response.update.success', ['name' => Page::NAME]),
            $data
        );
    }

    /**
     * method destroy
     *
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id): mixed
    {
        try {
            //deletion operation for an Page with the specified $id.
            Page::findOrFail($id)->delete();

            return $this->responseSuccess(
                __('string.response.delete.success', ['name' => Page::NAME])
            );
        } catch (\Exception) {
            return $this->responseError(
                __('string.response.delete.fail', ['name' => Page::NAME])
            );
        }
    }
}
