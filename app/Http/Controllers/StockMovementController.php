<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StockMovementController extends Controller
{
    public function storeStockIn(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $product = Product::find($request->product_id);
            $product->quantity += $request->quantity;
            $product->save();

            StockMovement::create([
                'product_id' => $request->product_id,
                'type' => 'in',
                'quantity' => $request->quantity,
            ]);
        });

        return back()->with('success', 'Stock added successfully.');
    }

    public function storeStockOut(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $product = Product::find($request->product_id);

            if ($product->quantity < $request->quantity) {
                throw ValidationException::withMessages([
                    'quantity' => 'Not enough stock available.',
                ]);
            }

            $product->quantity -= $request->quantity;
            $product->save();

            StockMovement::create([
                'product_id' => $request->product_id,
                'type' => 'out',
                'quantity' => $request->quantity,
            ]);
        });

        return back()->with('success', 'Stock removed successfully.');
    }
} 