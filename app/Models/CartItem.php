<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'menu_id',
        'quantity',
    ];

    // Relasi dengan tabel 'carts'
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // Relasi dengan tabel 'menus'
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
