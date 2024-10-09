<?php

namespace App\Services\Order\Filter;

use Illuminate\Database\Eloquent\Builder;

class OrderFilterCustomer implements OrderFilter
{

    public function apply(Builder $query, OrderFilterDTO $dto): Builder
    {

        $query->whereHas('customer', function (Builder $query) use ($dto) {
            $query->when($dto->getCustomerNationalCode(), function ($query, $nationalCode) {
                $query->where('national_code', $nationalCode);
            })
                ->when($dto->getCustomerPhone(), function ($query, $phone) {
                    $query->orWhere('phone', $phone);
                });
        });

        return $query;
    }
}
