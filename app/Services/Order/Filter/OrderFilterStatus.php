<?php

namespace App\Services\Order\Filter;

use Illuminate\Database\Eloquent\Builder;

class OrderFilterStatus implements OrderFilter
{

    public function apply(Builder $query, OrderFilterDTO $dto): Builder
    {
        if ($dto->getStatus()){
            $query->where('status', $dto->getStatus());
        }
        return $query;
    }

}
