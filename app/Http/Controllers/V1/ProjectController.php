<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\ProjectServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;
use Throwable;

class ProjectController extends Controller
{
    private ProjectServiceInterface $project;

    public function __construct(ProjectServiceInterface $project)
    {
        $this->project = $project;
    }

    public function get(int $id): JsonResponse
    {
        try {
            $project = $this->project->setPrimaryKey($id)->get();
            return responseHandler()->success(Response::HTTP_OK, $project);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $this->project->setFillable($request->all());
            $this->project->store();
            return responseHandler()->success(Response::HTTP_CREATED);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function update($id, Request $request): JsonResponse
    {
        try {
            $this->project->setFillable($request->all());
            $this->project->setPrimaryKey($id)->update();
            return responseHandler()->success(Response::HTTP_OK);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function delete($id): JsonResponse
    {
        try {
            $this->project->setPrimaryKey($id)->delete();
            return responseHandler()->success(Response::HTTP_OK);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function branch(int $id): JsonResponse
    {
        try {
            $project = $this->project->setPrimaryKey($id)->get();
            return responseHandler()->success(Response::HTTP_OK, $project->branch());
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function type(int $id): JsonResponse
    {
        try {
            $project = $this->project->setPrimaryKey($id)->get();
            return responseHandler()->success(Response::HTTP_OK, $project->projectType());
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function products(int $id): JsonResponse
    {
        try {
            $items = $this->project->setPrimaryKey($id)->products();
            return responseHandler()->success(Response::HTTP_OK, $items);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }


}
