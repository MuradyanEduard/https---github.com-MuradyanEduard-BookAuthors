<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['author_id', 'price'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'orders_books');
    }

    public function orders_books()
    {
        return $this->hasOne(OrdersBook::class);
    }
}
