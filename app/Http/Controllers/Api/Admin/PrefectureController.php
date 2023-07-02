<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prefecture;
use App\Traits\ColumnSelectedTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Services\Admin\PrefectureService;

class PrefectureController extends Controller
{
    use ResponseTrait;
    use ColumnSelectedTrait;

    protected $prefectureService;

    /**
     *
     *
     * @param PrefectureService $prefectureService
     */
    public function __construct(PrefectureService $prefectureService)
    {
        $this->prefectureService = $prefectureService;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request - The HTTP request object
     * @return \Illuminate\Http\JsonResponse - The JSON response object
     */
    public function index(Request $request)
    {
        /**
         * calls the get method on the $this->prefectureService object to retrieve a list of prefectures
         *The _limit value from provided (config('define.paginate.default')).
         */
        $prefectures = $this->prefectureService->get();

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => Prefecture::NAME]),
            $prefectures,
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
