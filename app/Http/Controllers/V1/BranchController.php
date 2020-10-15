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
        $this->branch = $branch;
    }

    public function index(): JsonResponse
    {
        try {
            throw new InvalidArgumentException('Method not allowed');
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function get(int $id): JsonResponse
    {
        try {
            $branch = $this->branch->setPrimaryKey($id)->get();
            return responseHandler()->success(Response::HTTP_OK, $branch);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $this->branch->setFillable($request);
            $this->branch->store();
            return responseHandler()->success(Response::HTTP_CREATED);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function update($id, Request $request): JsonResponse
    {
        try {
            $this->branch->setFillable($request);
            $this->branch->setPrimaryKey($id)->update();
            return responseHandler()->success(Response::HTTP_OK);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function delete($id): JsonResponse
    {
        try {
            $this->branch->setPrimaryKey($id)->delete();
            return responseHandler()->success(Response::HTTP_OK);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function churches(int $id): JsonResponse
    {
        try {
            $branches = $this->branch->setPrimaryKey($id)->churches();
            return responseHandler()->success(Response::HTTP_OK, $branches);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function projects(int $id): JsonResponse
    {
        try {
            $branches = $this->branch->setPrimaryKey($id)->projects();
            return responseHandler()->success(Response::HTTP_OK, $branches);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }


}
