<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TermService;
use App\Traits\ColumnSelectedTrait;
use App\Traits\ResponseTrait;
use App\Models\Page;

class TermOfServiceController extends Controller
{
    use ColumnSelectedTrait;
    use ResponseTrait;

    protected $termService;

    /**
     * Constructor function for the TermOfServiceController class.
     *
     * @param TermService $termService
     */
    public function __construct(TermService $termService)
    {
        $this->termService = $termService;
    }

    /**
     * Get data for terms of service screen
     *
     * @param Request $request
     *
     * @return object
     */
    public function index(Request $request): object
    {
        // Get the columns in request
        $columns = $this->columnSelected($request);

        // Call method getTermOfService from termService for get all record terms of service
        $termOfServices = $this->termService->getTermOfService($columns);

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => Page::TERM_NAME]),
            $termOfServices
        );
    }

    /**
     * Get all record in pages table (type=PRIVACY)
     *
     * @param Request $request [explicite description]
     *
     * @return object
     */
    public function getPrivacyPolicy(Request $request): object
    {
        // Get the columns in request
        $columns = $this->columnSelected($request);

        // Call method getTermOfService from termService for get all record terms of service
        $privacyPolicies = $this->termService->getPrivacyPolicy($columns);

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => Page::PRIVACY_NAME]),
            $privacyPolicies
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
