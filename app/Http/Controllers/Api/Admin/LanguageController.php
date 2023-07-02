<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\LanguageService;
use App\Http\Requests\Admin\LanguageRequest\LanguageRequest;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Traits\ResponseTrait;
use App\Traits\ColumnSelectedTrait;

class LanguageController extends Controller
{
    use ResponseTrait;
    use ColumnSelectedTrait;

    protected $languageService;

    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return object
     */
    public function index(Request $request): object
    {
        // Get the columns in request
        $columns = $this->columnSelected($request);

        // Call method getLanguages from languageService to get list language.
        $languages = $this->languageService->getLanguages($columns);

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => Language::NAME]),
            $languages
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
     * @param LanguageRequest $request
     *
     * @return object
     */
    public function store(LanguageRequest $request): object
    {
        // Call method addLanguage from languageService to add a language.
        $languages = $this->languageService->addLanguage($request->validated());

        return $this->responseSuccess(
            __('string.response.store.success', ['name' => Language::NAME]),
            $languages
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
    public function edit(Request $request)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param LanguageRequest $request [The validated request instance]
     * @param int $id
     *
     * @return object
     */
    public function update(LanguageRequest $request, int $id): object
    {
        // Update a language record with the validated request data and the given ID.
        $languages = $this->languageService->updateLanguage($id, $request->validated());

        if (!$languages) {
            return $this->responseError(
                __('string.response.update.fail', ['name' => Language::NAME]),
                $languages->errorInfo,
                400,
            );
        }

        return $this->responseSuccess(
            __('string.response.update.success', ['name' => Language::NAME]),
            $languages
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return object
     */
    public function destroy(int $id): object
    {
        try {
            Language::findOrFail($id)->delete();

            return $this->responseSuccess(
                __('string.response.delete.success', ['name' => Language::NAME])
            );
        } catch (\exception $e) {
            \Log::error($e);
            return $this->responseError(
                __('string.response.delete.fail', ['name' => Language::NAME])
            );
        }
    }
}
