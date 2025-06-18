<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all(['name', 'stock', 'price']);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'productname',
            'quantity',
            'price',
        ];
    }

    /**
     * @param mixed $product
     *
     * @return array
     */
    public function map($product): array
    {
        return [
            $product->name,
            $product->stock,
            $product->price,
        ];
    }
}
