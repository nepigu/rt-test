<?php

namespace App\Services\DataProvider;

use App\Dto\Jobs\JobDto;
use App\Dto\Jobs\JobsDto;
use App\Interfaces\Repositories\JobRepositoryInterface;
use App\Services\Formatter\JobFormatter;
use App\Services\Generator\IdGenerator;
use Psr\SimpleCache\InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class JobDataProvider
{
    public function __construct(
        private JobRepositoryInterface    $repository,
        private IdGenerator               $idGenerator,
        private JobsIdTrackerDataProvider $idTrackerDataProvider,
    ) {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function store(array $jobData): JobDto
    {
        $jobData['id'] = $this->idGenerator->generate();
        $this->idTrackerDataProvider->add($jobData['id']);

        return JobFormatter::format(
            $this->repository->create(
                $jobData['id'],
                JobFormatter::format($jobData)
            )
        );
    }

    public function find(string $id): JobDto
    {
        $job = $this->repository->find($id);
        if (null === $job) {
            throw new UnprocessableEntityHttpException(
                sprintf('Record with id %s not found', $id)
            );
        }

        return JobFormatter::format($job);
    }

    public function all(): JobsDto
    {
        $ids = $this->idTrackerDataProvider->list()->toArray();
        $jobs = [];
        foreach ($ids as $id) {
            $jobs[] = $this->repository->find($id);
        }

        return JobFormatter::formatMultiple($jobs);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function destroy(string $id): bool
    {
        $isDeleted = $this->repository->delete($id);
        if ($isDeleted) {
            $this->idTrackerDataProvider->remove($id);
        }

        return $isDeleted;
    }
}
