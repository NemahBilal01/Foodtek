<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    /** @use HasFactory<\Database\Factories\AddressFactory> */
    use HasFactory ,SoftDeletes;

    protected $fillable=[
        'user_id',
        'address_line',
        'description',
        'province',
        'city',
        'zip_code',

    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

}
