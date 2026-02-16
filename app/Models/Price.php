<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Price extends Model
{
    use HasFactory;

    protected $table = 'prices';
    protected $fillable = ['product_id', 'price', 'price_date'];

    protected $casts = [
        'price' => 'decimal:2',
        'price_date' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
