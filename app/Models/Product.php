<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
    ];

    /**
     * Get the import records for the product.
     */
    public function productImports()
    {
        return $this->hasMany(ProductImport::class);
    }
    public function productExports()
    {
        return $this->hasMany(export::class);
    }

    /**
     * Get the export records for the product.
     */
    // public function productExports()
    // {
    //     return $this->hasMany(ProductExport::class);
    // }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }
}
