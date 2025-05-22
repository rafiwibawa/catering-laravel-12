<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
    ];

    // Relasi dengan tabel 'customers'
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relasi dengan tabel 'cart_items'
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
