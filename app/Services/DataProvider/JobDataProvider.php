<?php

namespace App\Services\DataProvider;

use App\Dto\Jobs\JobDto;
use App\Http\Requests\API\StoreJobRequest;
use App\Interfaces\Repositories\JobRepositoryInterface;
use App\Services\Formatter\JobFormatter;
use App\Services\Generator\IdGenerator;

class JobDataProvider
{
    public function __construct(
        private JobRepositoryInterface $repository,
        private IdGenerator            $idGenerator,
        private JobFormatter           $formatter,
        private JobsIdTrackerDataProvider $idTrackerDataProvider,
    ) {
    }

    public function store(StoreJobRequest $request): JobDto
    {
        $job = $this->formatter->format($request->validated());
        $id = $this->idGenerator->generate($job->getUrl());
        $job->setId($id);

        $this->idTrackerDataProvider->add($id);

        return $this->repository->create($job->getId(), $job);
    }

    public function find(string $id): JobDto
    {
        return $this->formatter->format(
            $this->repository->find($id)
        );
    }

    /**
     * TODO: Check if record deleted and only then remove from tracker
     */
    public function destroy(string $id): bool
    {
        $this->idTrackerDataProvider->remove($id);

        return $this->repository->delete($id);
    }
}
