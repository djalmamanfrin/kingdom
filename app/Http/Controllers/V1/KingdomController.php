<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Repositories\ElasticInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class KingdomController extends Controller
{
    private ElasticInterface $elastic;

    public function __construct(ElasticInterface $elastic)
    {
        $this->elastic = $elastic;
    }

    public function search(Request $request): JsonResponse
    {
        try {
            $term = $request->get('term');
            $page = $request->get('page') ?? 1;
            $perPage = $request->get('per_page') ?? 30;
            $services = $this->elastic->search(new Service(), $term, $page, $perPage);
            return responseHandler()->success(Response::HTTP_OK, $services);
        } catch (Throwable $e) {
            return responseHandler()->error($e);
        }
    }
}
