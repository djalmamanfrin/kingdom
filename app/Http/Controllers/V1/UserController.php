<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class UserController extends Controller
{
    private UserServiceInterface $user;

    public function __construct(UserServiceInterface $user)
    {
        $this->user = $user;
    }

    public function index(): JsonResponse
    {
        try {
            $users = $this->user->all();
            return responseHandler()->success(Response::HTTP_OK, $users);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }

    }

    public function get(int $id): JsonResponse
    {
        try {
            $user = $this->user->setPrimaryKey($id)->get();
            return responseHandler()->success(Response::HTTP_OK, $user);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $this->user->setFillable($request);
            $this->user->store();
            return responseHandler()->success(Response::HTTP_CREATED);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function update($id, Request $request): JsonResponse
    {
        try {
            $this->user->setFillable($request);
            $this->user->setPrimaryKey($id)->update();
            return responseHandler()->success(Response::HTTP_OK);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function delete($id): JsonResponse
    {
        try {
            $this->user->setPrimaryKey($id)->get()->delete();
            return responseHandler()->success(Response::HTTP_OK);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function profile($id): JsonResponse
    {
        try {
            $profile = $this->user->setPrimaryKey($id)->get()->profile();
            return responseHandler()->success(Response::HTTP_OK, $profile);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function branches(int $id): JsonResponse
    {
        try {
            $branches = $this->user->setPrimaryKey($id)->get()->branches();
            return responseHandler()->success(Response::HTTP_OK, $branches);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function bankCards(int $id): JsonResponse
    {
        try {
            $bankCards = $this->user->setPrimaryKey($id)->get()->bankCards();
            return responseHandler()->success(Response::HTTP_OK, $bankCards);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function bankAccounts(int $id): JsonResponse
    {
        try {
            $bankAccount = $this->user->setPrimaryKey($id)->get()->bankAccounts()->get();
            return responseHandler()->success(Response::HTTP_OK, $bankAccount);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function addresses(int $id): JsonResponse
    {
        try {
            $addresses = $this->user->setPrimaryKey($id)->get()->addresses();
            $dict = config('dictionaries.user.bank_cards');
            return responseHandler()->success(Response::HTTP_OK, $addresses);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function indications(int $id): JsonResponse
    {
        try {
            $indications = $this->user->setPrimaryKey($id)->get()->indications();
            return responseHandler()->success(Response::HTTP_OK, $indications);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function notifications(int $id): JsonResponse
    {
        try {
            $notifications = $this->user->setPrimaryKey($id)->get()->notifications();
            return responseHandler()->success(Response::HTTP_OK, $notifications);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }
}
