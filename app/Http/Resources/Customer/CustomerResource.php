<?php

namespace App\Http\Resources\Customer;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Customer $resource
 */
class CustomerResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'first_name' => $this->resource->first_name,
            'last_name' => $this->resource->last_name,
            'national_code' => $this->resource->national_code,
            'phone' => $this->resource->phone,
        ];
    }
}
