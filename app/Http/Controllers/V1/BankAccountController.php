<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\BankAccountServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;
use Throwable;

class BankAccountController extends Controller
{
    private BankAccountServiceInterface $bankAccount;

    public function __construct(BankAccountServiceInterface $bankAccount)
    {
        $this->bankAccount = $bankAccount;
    }

    public function index(): JsonResponse
    {
        try {
            throw new InvalidArgumentException('Method not allowed', 422);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function get(int $id): JsonResponse
    {
        try {
            $bankAccount = $this->bankAccount->setPrimaryKey($id)->get();
            return responseHandler()->success(Response::HTTP_OK, $bankAccount);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $this->bankAccount->setFillable($request->all());
            $this->bankAccount->store();
            return responseHandler()->success(Response::HTTP_CREATED);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function update($id, Request $request): JsonResponse
    {
        try {
            $this->bankAccount->setFillable($request->all());
            $this->bankAccount->setPrimaryKey($id)->update();
            return responseHandler()->success(Response::HTTP_OK);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function delete($id): JsonResponse
    {
        try {
            $this->bankAccount->setPrimaryKey($id)->delete();
            return responseHandler()->success(Response::HTTP_OK);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }
}
