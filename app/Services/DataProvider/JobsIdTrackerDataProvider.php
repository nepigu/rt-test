<?php

namespace App\Services\DataProvider;

use App\Dto\JobsIdTracker\JobsIdTrackerDto;
use App\Interfaces\Repositories\JobsIdTrackerRepositoryInterface;
use App\Services\Filter\StringArrayFilter;
use App\Services\Formatter\JobIdTrackerFormatter;
use Psr\SimpleCache\InvalidArgumentException;

class JobsIdTrackerDataProvider
{
    private const KEY = 'jobs_idsss';

    public function __construct(
        private JobsIdTrackerRepositoryInterface $repository,
        private JobIdTrackerFormatter            $formatter,
        private StringArrayFilter                $filter,
    )
    {
    }

    public function list(): JobsIdTrackerDto
    {
        $ids = $this->repository->find(self::KEY);
        if(null === $ids) {
            $ids = [];
        }

        return $this->formatter->format($ids);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function add($id): void
    {
        $newDto = JobIdTrackerFormatter::format(
            array_merge($this->list()->toArray(), [$id])
        );
        $this->repository->delete(self::KEY);
        $this->repository->create(self::KEY, $newDto);
    }

    public function remove(string $id): void
    {
        $dto = $this->list();
        $filteredDto = JobIdTrackerFormatter::format(
            $this->filter
                ->removeStringFromArrayList($id, $dto->ids->toArray())
        );

        $this->repository->delete(self::KEY);
        $this->repository->create(self::KEY, $filteredDto);
    }
}
