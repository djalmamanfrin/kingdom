<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\ChurchServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;
use Throwable;

class ChurchController extends Controller
{
    private ChurchServiceInterface $church;

    public function __construct(ChurchServiceInterface $church)
    {
        $this->church = $church;
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
            $church = $this->church->setPrimaryKey($id)->get();
            return responseHandler()->success(Response::HTTP_OK, $church);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $this->church->setFillable($request);
            $this->church->store();
            return responseHandler()->success(Response::HTTP_CREATED);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function update($id, Request $request): JsonResponse
    {
        try {
            $this->church->setFillable($request);
            $this->church->setPrimaryKey($id)->update();
            return responseHandler()->success(Response::HTTP_OK);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function delete($id): JsonResponse
    {
        try {
            $this->church->setPrimaryKey($id)->delete();
            return responseHandler()->success(Response::HTTP_OK);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function address(int $id): JsonResponse
    {
        try {
            $churchModel = $this->church->setPrimaryKey($id)->get();
            $address = $churchModel->address()->church();
            return responseHandler()->success(Response::HTTP_OK, $address);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }
}
