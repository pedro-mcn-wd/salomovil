<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'delivery_address',
        'billing_address',
        'credit_card_number',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function shoppingcart(): HasOne
    // {
    //     return $this->hasOne(Shoppingcart::class);
    // }
    public function shoppingcart(): BelongsTo
    {
        return $this->belongsTo(Shoppingcart::class);
    }
}
