<?php

namespace Tests\Unit\Services\Order;

use App\Models\Order;
use App\Services\Order\Filter\OrderFilterAmount;
use Database\Factories\DTOs\OrderFilterDTOFactory;
use Database\Factories\OrderFactory;
use Tests\TestCase;

class OrderFilterAmountTest extends TestCase
{

    /** @test */
    public function it_applies_minimum_amount_filter_if_order_exists()
    {

        $order = OrderFactory::new()->create();

        $dto = OrderFilterDTOFactory::new()
            ->viaMinAmount($order->amount - 1)
            ->withoutMaxAmount()
            ->create();

        $orderFilterAmount = new OrderFilterAmount();

        $orders = $orderFilterAmount->apply(
            query: Order::query(),
            dto: $dto,
        )->get();

        $this->assertCount(1, $orders);
    }

    /** @test */
    public function it_does_not_apply_minimum_amount_filter_if_orders_amount_higher_than_min_amount()
    {

        $order = OrderFactory::new()->create();

        $dto = OrderFilterDTOFactory::new()
            ->viaMinAmount($order->amount + 1)
            ->withoutMaxAmount()
            ->create();

        $orderFilterAmount = new OrderFilterAmount();

        $orders = $orderFilterAmount->apply(
            query: Order::query(),
            dto: $dto,
        )->get();

        $this->assertCount(0, $orders);
    }

    /** @test */
    public function it_applies_maximum_amount_filter_if_order_exists()
    {

        $order = OrderFactory::new()->create();

        $dto = OrderFilterDTOFactory::new()
            ->viaMaxAmount($order->amount + 1)
            ->withoutMinAmount()
            ->create();

        $orderFilterAmount = new OrderFilterAmount();

        $orders = $orderFilterAmount->apply(
            query: Order::query(),
            dto: $dto,
        )->get();

        $this->assertCount(1, $orders);
    }

    /** @test */
    public function it_does_not_apply_maximum_amount_filter_if_orders_amount_lower_than_max_amount()
    {

        $order = OrderFactory::new()->create();

        $dto = OrderFilterDTOFactory::new()
            ->viaMaxAmount($order->amount - 1)
            ->withoutMinAmount()
            ->create();

        $orderFilterAmount = new OrderFilterAmount();

        $orders = $orderFilterAmount->apply(
            query: Order::query(),
            dto: $dto,
        )->get();

        $this->assertCount(0, $orders);
    }

    /** @test */
    public function it_applies_both_filters_if_order_exists()
    {

        $order = OrderFactory::new()->create();

        $dto = OrderFilterDTOFactory::new()
            ->viaMinAmount($order->amount - 1)
            ->viaMaxAmount($order->amount + 1)
            ->create();

        $orderFilterAmount = new OrderFilterAmount();

        $orders = $orderFilterAmount->apply(
            query: Order::query(),
            dto: $dto,
        )->get();

        $this->assertCount(1, $orders);
    }

    /** @test */
    public function it_does_not_apply_both_filters_if_orders_amount_lower_than_max_amount_or_higher_than_min_amount()
    {

        $order = OrderFactory::new()->create();

        $dto = OrderFilterDTOFactory::new()
            ->viaMinAmount($order->amount + 1)
            ->viaMaxAmount($order->amount - 1)
            ->create();

        $orderFilterAmount = new OrderFilterAmount();

        $orders = $orderFilterAmount->apply(
            query: Order::query(),
            dto: $dto,
        )->get();

        $this->assertCount(0, $orders);
    }

}
