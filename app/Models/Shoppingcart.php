<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Shoppingcart extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'shoppingcart';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'identifier',
        'instance',
        'content',
    ];

    // public function order(): BelongsTo
    // {
    //     return $this->belongsTo(Order::class);
    // }
    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
}
