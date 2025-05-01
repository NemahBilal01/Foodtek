<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable , HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'birthday',
        'profilePicture',
        'google_id',
        'facebook_id',
        'apple_id',
            ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    //user has many notifications
    public function notifications():HasMany
    {
        return $this->hasMany(Notification::class);
    }
    //user has many orders
    public function orders():HasMany
    {
        return $this->hasMany(Order::class);
    }
    //user has many cartItems
    public function cartItems():HasMany
    {
        return $this->hasMany(CartItem::class);
    }
    //user has many restaurants
    public function restaurants():HasMany
    {
        return $this->hasMany(Restaurant::class);
    }
    //user has many addresses
    public function addresses() {
        return $this->hasMany(Address::class);
    }

    public function paymentMethods(){
        return $this->hasMany(PaymentMethod::class);
    }
    public function chats()
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }

    // user has many ratings
    public function ratings():HasMany{
        return $this->hasMany(Rating::class);
    }
    public function givenRatings()
    {
        return $this->hasMany(Rating::class, 'user_id');
    }
    public function receivedRatings()
    {
        return $this->hasMany(Rating::class, 'delivery_man_id');
    }
    
}
