<?php

namespace App\Services\Order\Filter;

use Illuminate\Database\Eloquent\Builder;

interface OrderFilter
{

    public function apply(Builder $query, OrderFilterDTO $dto): Builder;

}
