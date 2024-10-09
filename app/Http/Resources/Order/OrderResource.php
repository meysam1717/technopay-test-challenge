<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Customer\CustomerResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Order $resource
 */
class OrderResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'customer' => CustomerResource::make($this->whenLoaded('customer')),
            'status' => $this->resource->status,
            'amount' => $this->resource->amount,
        ];
    }
}
