<?php

namespace App\Services\Order\Filter;

use App\Exceptions\OrderFilterApplyException;
use Exception;
use Illuminate\Database\Eloquent\Builder;

final readonly class OrderFilterApplier
{

    /**
     * @param array<string> $filters
     */
    public function __construct(
        private array $filters,
    )
    {
    }

    /**
     * @throws OrderFilterApplyException
     */
    public function apply(Builder $query, OrderFilterDTO $dto): Builder
    {

        try {
            foreach ($this->filters as $filter){
                $query = (new $filter)->apply($query, $dto);
            }
        }catch (Exception $exception){
            throw new OrderFilterApplyException(message: $exception->getMessage(), previous: $exception);
        }

        return $query;
    }

}
