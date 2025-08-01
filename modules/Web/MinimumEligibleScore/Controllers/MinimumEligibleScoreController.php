<?php

namespace BasicDashboard\Web\MinimumEligibleScore\Controllers;

use BasicDashboard\Web\Common\BaseController;
use BasicDashboard\Web\MinimumEligibleScore\Services\MinimumEligibleScoreService;
use BasicDashboard\Web\MinimumEligibleScore\Validation\StoreMinimumEligibleScoreRequest;
use BasicDashboard\Web\MinimumEligibleScore\Validation\UpdateMinimumEligibleScoreRequest;
use BasicDashboard\Web\MinimumEligibleScore\Validation\DeleteMinimumEligibleScoreRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 *
 * A MinimumEligibleScoreController is responsible for receive request and return response.
 * Generated By Custom Artisan Cmd
 * @author Nay Ba la
 * https://github.com/naybala
 * https://naybala.netlify.app/
 *
 */

class MinimumEligibleScoreController extends BaseController
{
    public function __construct(
        private MinimumEligibleScoreService $minimumEligibleScoreService
    ) {
    }

    ///////////////////////////This is Method Divider///////////////////////////////////////

    public function index(Request $request): View
    {
        return $this->minimumEligibleScoreService->index($request->all());
    }

    ///////////////////////////This is Method Divider///////////////////////////////////////

    public function create(): View
    {
        return $this->minimumEligibleScoreService->create();
    }

    ///////////////////////////This is Method Divider///////////////////////////////////////

    public function store(StoreMinimumEligibleScoreRequest $request): RedirectResponse
    {
        return $this->minimumEligibleScoreService->store($request->validated());
    }

    ///////////////////////////This is Method Divider///////////////////////////////////////

    public function edit(string $id): View | RedirectResponse
    {
        return $this->minimumEligibleScoreService->edit($id);
    }

    ///////////////////////////This is Method Divider///////////////////////////////////////

    public function show(string $id): View | RedirectResponse
    {
        return $this->minimumEligibleScoreService->show($id);
    }

    ///////////////////////////This is Method Divider///////////////////////////////////////

    public function update(UpdateMinimumEligibleScoreRequest $request, string $id): RedirectResponse
    {
        return $this->minimumEligibleScoreService->update($request->validated(), $id);
    }

    ///////////////////////////This is Method Divider///////////////////////////////////////

    public function destroy(DeleteMinimumEligibleScoreRequest $request): RedirectResponse
    {
        return $this->minimumEligibleScoreService->destroy($request->validated());
    }

    ///////////////////////////This is Method Divider///////////////////////////////////////
}
