<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImport extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'quantity', 'price','total_price', 'import_at'];

    public function product(){
        return $this->belongsTo(Product::class);
        }
}
