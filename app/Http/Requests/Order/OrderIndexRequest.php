<?php

namespace App\Http\Requests\Order;

use App\Enums\OrderStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property int page
 * @property int per_page
 * @property ?OrderStatus status
 * @property ?string customer_national_code
 * @property ?string customer_phone
 * @property ?int min_amount
 * @property ?int max_amount
 */
class OrderIndexRequest extends FormRequest
{

    protected function prepareForValidation(): void
    {
        if (!$this->has('page')){
            $this->merge([
                'page' => 1
            ]);
        }

        if (!$this->has('per_page')){
            $this->merge([
                'per_page' => 10
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'page' => ['required', 'integer', 'min:1'],
            'per_page' => ['required', 'integer', 'min:10', 'max:50'],
            'status' => ['nullable', Rule::enum(OrderStatus::class)],
            'customer_national_code' => ['nullable', 'min:10', 'max:10'],
            'customer_phone' => ['nullable', 'min:11', 'max:11'],
            'min_amount' => ['nullable', 'numeric'],
            'max_amount' => ['nullable', 'numeric'],
        ];
    }

    public function getPage(): int
    {
        return $this->validated('page');
    }

    public function getPrePage(): int
    {
        return $this->validated('per_page');
    }

    public function getStatus(): ?OrderStatus
    {
        return OrderStatus::tryFrom($this->validated('status'));
    }

    public function getCustomerNationalCode(): ?string
    {
        return $this->validated('customer_national_code');
    }

    public function getCustomerPhone(): ?string
    {
        return $this->validated('customer_phone');
    }

    public function getMinAmount(): ?int
    {
        return $this->validated('min_amount');
    }

    public function getMaxAmount(): ?int
    {
        return $this->validated('max_amount');
    }

}
