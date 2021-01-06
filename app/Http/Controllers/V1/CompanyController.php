<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\CompanyServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;
use Throwable;

class CompanyController extends Controller
{
    private CompanyServiceInterface $company;

    public function __construct(CompanyServiceInterface $company)
    {
        $this->authorize('entrepreneur');
        $this->company = $company;
    }

    public function get($id): JsonResponse
    {
        try {
            $company = $this->company->setPrimaryKey($id)->get();
            return responseHandler()->success(Response::HTTP_OK, $company);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $this->company->setFillable($request->all());
            $this->company->store();
            return responseHandler()->success(Response::HTTP_CREATED);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function update($id, Request $request): JsonResponse
    {
        try {
            $this->company->setFillable($request->all());
            $this->company->setPrimaryKey($id)->update();
            return responseHandler()->success(Response::HTTP_OK);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function delete($id): JsonResponse
    {
        try {
            $this->company->setPrimaryKey($id)->delete();
            return responseHandler()->success(Response::HTTP_OK);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }
}
