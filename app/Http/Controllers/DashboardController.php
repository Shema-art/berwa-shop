<?php

namespace App\Http\Controllers;

use App\Models\Export;
use App\Models\Product;
use App\Models\ProductImport;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $totalStock = Product::sum('quantity');
        $totalImports = ProductImport::sum('quantity');
        $totalExports = Export::sum('quantity');

        return view('dashboard', compact('products', 'totalStock', 'totalImports', 'totalExports'));
    }
} 