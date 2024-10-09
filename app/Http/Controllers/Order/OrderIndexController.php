<?php

namespace App\Http\Controllers\Order;

use App\Exceptions\OrderFilterApplyException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderIndexRequest;
use App\Http\Resources\Order\OrderResource;
use App\Services\Order\Filter\OrderFilterAmount;
use App\Services\Order\Filter\OrderFilterCustomer;
use App\Services\Order\Filter\OrderFilterDTO;
use App\Services\Order\Filter\OrderFilterStatus;
use App\Services\Order\OrderService;

class OrderIndexController extends Controller
{

    public function __construct(
        private readonly OrderService $orderService,
    )
    {
    }

    /**
     * @throws OrderFilterApplyException
     */
    public function __invoke(OrderIndexRequest $request)
    {

        $orderFilterDTO = OrderFilterDTO::fromOrderIndexRequest($request);

        $orders = $this->orderService->getOrders(
            orderFilterDTO: $orderFilterDTO,
            filters: [
                OrderFilterStatus::class,
                OrderFilterCustomer::class,
                OrderFilterAmount::class,
            ],
            page: $request->getPage(),
            perPage: $request->getPrePage(),
            eagerLoads: ['customer'],
        );

        return OrderResource::collection($orders);

    }


}
