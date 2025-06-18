<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Check if essential columns are present and not empty
        if (empty($row['productname']) || !isset($row['quantity']) || !isset($row['price'])) {
            // Skip this row or handle error, for now, skipping
            return null;
        }

        return new Product([
            'name'     => $row['productname'],
            'stock'    => $row['quantity'],
            'price'    => $row['price'],
        ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'productname' => 'required|string|max:255',
            '*.productname' => 'required|string|max:255',

            'quantity' => 'required|integer|min:0',
            '*.quantity' => 'required|integer|min:0',

            'price' => 'required|numeric|min:0|regex:/^\d*(\.\d{1,2})?$/',
            '*.price' => 'required|numeric|min:0|regex:/^\d*(\.\d{1,2})?$/',
        ];
    }

    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'productname.required' => 'The product name is required in row :row.',
            '*.productname.required' => 'The product name is required in row :row.',
            'quantity.required' => 'The quantity is required in row :row.',
            '*.quantity.required' => 'The quantity is required in row :row.',
            'quantity.integer' => 'The quantity must be a whole number in row :row.',
            '*.quantity.integer' => 'The quantity must be a whole number in row :row.',
            'quantity.min' => 'The quantity cannot be negative in row :row.',
            '*.quantity.min' => 'The quantity cannot be negative in row :row.',
            'price.required' => 'The price is required in row :row.',
            '*.price.required' => 'The price is required in row :row.',
            'price.numeric' => 'The price must be a number in row :row.',
            '*.price.numeric' => 'The price must be a number in row :row.',
            'price.min' => 'The price cannot be negative in row :row.',
            '*.price.min' => 'The price cannot be negative in row :row.',
            'price.regex' => 'The price format is invalid in row :row. It can have up to two decimal places.',
            '*.price.regex' => 'The price format is invalid in row :row. It can have up to two decimal places.',
        ];
    }
}
