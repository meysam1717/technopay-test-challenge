<?php

namespace Tests\Unit\Services\Order;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Services\Order\Filter\OrderFilterStatus;
use Database\Factories\DTOs\OrderFilterDTOFactory;
use Database\Factories\OrderFactory;
use Tests\TestCase;

class OrderFilterStatusTest extends TestCase
{

    /** @test */
    public function it_applies_status_filter_in_order()
    {

        $order = OrderFactory::new()
            ->create();

        $dto = OrderFilterDTOFactory::new()
            ->viaStatus($order->status)
            ->create();

        $orderFilterStatus = new OrderFilterStatus();

        $orders = $orderFilterStatus->apply(
            query: Order::query(),
            dto: $dto,
        )->get();

        $this->assertCount(1, $orders);
    }

    /** @test */
    public function it_does_not_return_orders_that_have_another_status()
    {

        $orders = OrderFactory::new()
            ->count(10)
            ->create();

        $filteredOrders = $orders->filter(fn(Order $order) => $order->status !== OrderStatus::ACCEPTED);

        $dto = OrderFilterDTOFactory::new()
            ->viaStatus(OrderStatus::ACCEPTED)
            ->create();

        $orderFilterStatus = new OrderFilterStatus();

        $queriedOrders = $orderFilterStatus->apply(
            query: Order::query(),
            dto: $dto,
        )->get();

        $this->assertCount($orders->count() - $filteredOrders->count(), $queriedOrders);
    }

}
