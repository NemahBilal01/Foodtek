<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_id', 
        'sender_id', 
        'sender_type', 
        'message', 
        'is_archived'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}


