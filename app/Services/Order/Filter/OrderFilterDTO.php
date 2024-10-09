<?php

namespace App\Services\Order\Filter;

use App\Enums\OrderStatus;
use App\Http\Requests\Order\OrderIndexRequest;

readonly class OrderFilterDTO
{

    public function __construct(
        private ?OrderStatus $status = null,
        private ?string $customerNationalCode = null,
        private ?string $customerPhone = null,
        private ?int $minAmount = null,
        private ?int $maxAmount = null,
    )
    {
    }

    public static function fromOrderIndexRequest(OrderIndexRequest $request): self
    {
        return new self(
            status: $request->getStatus(),
            customerNationalCode: $request->getCustomerNationalCode(),
            customerPhone: $request->getCustomerPhone(),
            minAmount: $request->getMinAmount(),
            maxAmount: $request->getMaxAmount(),
        );
    }

    public function getStatus(): ?OrderStatus
    {
        return $this->status;
    }

    public function getCustomerNationalCode(): ?string
    {
        return $this->customerNationalCode;
    }

    public function getCustomerPhone(): ?string
    {
        return $this->customerPhone;
    }

    public function getMinAmount(): ?int
    {
        return $this->minAmount;
    }

    public function getMaxAmount(): ?int
    {
        return $this->maxAmount;
    }

}
