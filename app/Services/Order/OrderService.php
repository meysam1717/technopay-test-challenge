<?php

namespace App\Services\Order;

use App\Exceptions\OrderFilterApplyException;
use App\Models\Order;
use App\Services\Order\Filter\OrderFilterApplier;
use App\Services\Order\Filter\OrderFilterDTO;
use Illuminate\Pagination\LengthAwarePaginator;

final readonly class OrderService
{

    /**
     * @param array<string> $filters
     * @param array<string, mixed> $eagerLoads
     * @throws OrderFilterApplyException
     */
    public function getOrders(
        OrderFilterDTO $orderFilterDTO,
        array          $filters,
        int            $page,
        int            $perPage,
        array          $eagerLoads = [],
    ): LengthAwarePaginator
    {
        $orderFilterApplier = new OrderFilterApplier($filters);

        $orderQuery = Order::query()->with($eagerLoads);

        $orderQuery = $orderFilterApplier->apply($orderQuery, $orderFilterDTO);

        return $orderQuery->paginate(perPage: $perPage, page: $page);
    }

}
