<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreJobRequest;
use App\Http\Resources\JobResource;
use App\Services\DataProvider\JobDataProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Response;

class JobController extends Controller
{
    public function __construct(
        private JobDataProvider $dataProvider,
    ) {
    }

    public function index(): AnonymousResourceCollection
    {
        return JobResource::collection($this->dataProvider->all()->jobs);
    }

    public function store(StoreJobRequest $request): JobResource
    {
        return new JobResource($this->dataProvider->store($request->validated()));
    }

    public function show(string $id): JobResource
    {
        return new JobResource($this->dataProvider->find($id));
    }

    public function destroy(string $id): JsonResponse
    {
        $recordDeleted = $this->dataProvider->destroy($id);
        if ($recordDeleted) {
            return new JsonResponse(
                [
                    'message' => 'Record deleted successfully!',
                ],
                Response::HTTP_OK,
            );
        }

        return new JsonResponse(
            [
                'message' => 'Something went wrong!',
            ],
            Response::HTTP_UNPROCESSABLE_ENTITY,
        );
    }
}
