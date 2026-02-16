<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = ['product_name', 'category_id', 'manufacturer_id'];

    protected $casts = [
        'category_id' => 'integer',
    ];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }

    public function prices()
    {
        return $this->hasMany(Price::class, 'product_id');
    }
}
