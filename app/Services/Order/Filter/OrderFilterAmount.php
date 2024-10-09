<?php

namespace App\Services\Order\Filter;

use Exception;
use Illuminate\Database\Eloquent\Builder;

class OrderFilterAmount implements OrderFilter
{

    public function apply(Builder $query, OrderFilterDTO $dto): Builder
    {

        if ($dto->getMinAmount()){
            $query->where('amount', '>=', $dto->getMinAmount());
        }

        if ($dto->getMaxAmount()){
            $query->where('amount', '<=', $dto->getMaxAmount());
        }

        return $query;
    }

}
