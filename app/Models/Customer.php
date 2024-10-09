<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * @property int id
 * @property string first_name
 * @property string last_name
 * @property string national_code
 * @property string phone
 */
class Customer extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'national_code',
        'phone',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

}
