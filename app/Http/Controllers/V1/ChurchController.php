<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\ChurchServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class ChurchController extends Controller
{
    private ChurchServiceInterface $church;

    public function __construct(ChurchServiceInterface $church)
    {
        $this->authorize('responsible');
        $this->church = $church;
    }

    public function get(int $id): JsonResponse
    {
        try {
            $church = $this->church->setPrimaryKey($id)->get();
            $this->authorize('access', $church);
            return responseHandler()->success(Response::HTTP_OK, $church);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $this->church->setFillable($request->all());
            $this->church->store();
            return responseHandler()->success(Response::HTTP_CREATED);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function update($id, Request $request): JsonResponse
    {
        try {
            $this->church->setFillable($request->all());
            $church = $this->church->setPrimaryKey($id)->get();
            $this->authorize('access', $church);
            $church->update();
            return responseHandler()->success(Response::HTTP_OK);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function delete($id): JsonResponse
    {
        try {
            $church = $this->church->setPrimaryKey($id)->get();
            $this->authorize('access', $church);
            $church->delete();
            return responseHandler()->success(Response::HTTP_OK);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function address(int $id): JsonResponse
    {
        try {
            $church = $this->church->setPrimaryKey($id)->get();
            $this->authorize('access', $church);
            $address = $church->address();
            return responseHandler()->success(Response::HTTP_OK, $address);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }
}
