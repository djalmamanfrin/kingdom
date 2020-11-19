<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Entrepreneur;
use App\Models\Responsible;
use App\Services\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;
use Throwable;

class UserController extends Controller
{
    private UserServiceInterface $user;

    public function __construct(UserServiceInterface $user)
    {
        $this->user = $user;
    }

    public function get(int $id): JsonResponse
    {
        try {
            $user = $this->user->setPrimaryKey($id)->get();
            $this->authorize('access', $user);
            return responseHandler()->success(Response::HTTP_OK, $user);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $this->user->setFillable($request->all());
            $this->user->store();
            return responseHandler()->success(Response::HTTP_CREATED);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function update($id, Request $request): JsonResponse
    {
        try {
            $this->user->setFillable($request->all());
            $user = $this->user->setPrimaryKey($id)->get();
            $this->authorize('access', $user);
            $user->update();
            return responseHandler()->success(Response::HTTP_OK);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function delete($id): JsonResponse
    {
        try {
            $user = $this->user->setPrimaryKey($id)->get();
            $this->authorize('access', $user);
            $user->delete();
            return responseHandler()->success(Response::HTTP_OK);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function profile($id): JsonResponse
    {
        try {
            $user = $this->user->setPrimaryKey($id)->get();
            $this->authorize('access', $user);
            $profile = $user->profile();
            return responseHandler()->success(Response::HTTP_OK, $profile);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function branches(int $id): JsonResponse
    {
        try {
            $user = $this->user->setPrimaryKey($id)->get();
            $this->authorize('access', $user);
            $this->authorize('responsible');

            /** @var Responsible $responsible */
            $responsible = $user->profile();
            $branches = $responsible->branches();
            return responseHandler()->success(Response::HTTP_OK, $branches);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function companies(int $id): JsonResponse
    {
        try {
            $user = $this->user->setPrimaryKey($id)->get();
            $this->authorize('access', $user);
            $this->authorize('entrepreneur');

            /** @var Entrepreneur $entrepreneur */
            $entrepreneur = $user->profile();
            $companies = $entrepreneur->companies();
            return responseHandler()->success(Response::HTTP_OK, $companies);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function addresses(int $id): JsonResponse
    {
        try {
            $user = $this->user->setPrimaryKey($id)->get();
            $this->authorize('access', $user);
            $addresses = $user->addresses();
            return responseHandler()->success(Response::HTTP_OK, $addresses);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function indications(int $id): JsonResponse
    {
        try {
            $user = $this->user->setPrimaryKey($id)->get();
            $this->authorize('access', $user);
            $indications = $user->indications();
            return responseHandler()->success(Response::HTTP_OK, $indications);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }

    public function notifications(int $id): JsonResponse
    {
        try {
            $user = $this->user->setPrimaryKey($id)->get();
            $this->authorize('access', $user);
            $notifications = $user->notifications();
            return responseHandler()->success(Response::HTTP_OK, $notifications);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }
}
