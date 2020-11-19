<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\BranchServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;
use Throwable;

class BranchController extends Controller
{
    private BranchServiceInterface $branch;

    public function __construct(BranchServiceInterface $branch)
    {
        $this->authorize('responsible');
        $this->branch = $branch;
    }

    public function get(Request $request, int $id): JsonResponse
    {
        try {
            $branch = $this->branch->setPrimaryKey($id)->get();
            $this->authorize('access', $branch);
            return responseHandler()->success(Response::HTTP_OK, $branch);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $this->branch->setFillable($request->all());
            $this->branch->store();
            return responseHandler()->success(Response::HTTP_CREATED);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function update($id, Request $request): JsonResponse
    {
        try {
            $this->branch->setFillable($request->all());
            $branch = $this->branch->setPrimaryKey($id)->get();
            $this->authorize('access', $branch);
            $branch->update();
            return responseHandler()->success(Response::HTTP_OK);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function delete($id): JsonResponse
    {
        try {
            $branch = $this->branch->setPrimaryKey($id)->get();
            $this->authorize('access', $branch);
            $branch->delete();
            return responseHandler()->success(Response::HTTP_OK);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function churches(int $id): JsonResponse
    {
        try {
            $branch = $this->branch->setPrimaryKey($id)->get();
            $this->authorize('access', $branch);
            $churches = $branch->churches();
            return responseHandler()->success(Response::HTTP_OK, $churches);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }
}
