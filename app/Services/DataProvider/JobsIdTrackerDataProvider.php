<?php

namespace App\Services\DataProvider;

use App\Dto\JobsIdTracker\JobsIdTrackerDto;
use App\Interfaces\Repositories\JobsIdTrackerRepositoryInterface;
use App\Services\Filter\StringArrayFilter;
use App\Services\Formatter\JobIdTrackerFormatter;

class JobsIdTrackerDataProvider
{
    private const KEY = 'jobs_ids';

    public function __construct(
        private JobsIdTrackerRepositoryInterface $repository,
        private JobIdTrackerFormatter $formatter,
        private StringArrayFilter $filter,
    ) {
    }

    public function list(): JobsIdTrackerDto
    {
        return $this->formatter->format($this->repository->list(self::KEY));
    }

    public function add($id): void
    {
        $dto = $this->list();
        $dto->addId($id);

        $this->repository->create(self::KEY, $dto);
    }

    public function remove(string $id): void
    {
        $dto = $this->list();
        $dto->setIds(
            $this->filter
                ->removeStringFromArrayList($id, $dto->getIds())
        );

        $this->repository->create(self::KEY, $dto);
    }
}
