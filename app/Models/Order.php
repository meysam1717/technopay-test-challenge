<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int customer_id
 * @property OrderStatus status
 * @property int amount
 * @property-read Customer|null customer
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'status',
        'amount',
    ];

    protected $casts = [
        'status' => OrderStatus::class,
    ];


    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

}
