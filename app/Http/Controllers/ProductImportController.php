<?php

namespace App\Http\Controllers;

use App\Models\ProductImport;
use Illuminate\Http\Request;
use App\Models\Product;
class ProductImportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productImports = ProductImport::all();
        return view('imports.index', compact('productImports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $products=Product::all();
       return view('imports.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'import_at' => 'required|date',
        ]);
        ProductImport::create([
            'product_id' => $validatedData['product_id'],
            'quantity' => $validatedData['quantity'],
            'price' => $validatedData['price'],
            'total_price' => $validatedData['price'] * $validatedData['quantity'],
            'import_at' => $validatedData['import_at'],
        ]);
        return redirect()->route('imports.index')->with('success', 'Import created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $import = ProductImport::find($id);
        return view('imports.show', compact('import'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $import = ProductImport::find($id);
        return view('imports.edit', compact('import'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'import_at' => 'required|date',
        ]);
        $productImport = ProductImport::find($id);
        $productImport->update([
            'quantity' => $validatedData['quantity'],
            'price' => $validatedData['price'],
            'total_price' => $validatedData['price'] * $validatedData['quantity'],
            'import_at' => $validatedData['import_at'],
        ]);
        return redirect()->route('imports.index')->with('success', 'Import updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $productImport = ProductImport::findOrFail($id);
        $productImport->delete();
        return redirect()->route('imports.index')->with('success', 'Import deleted successfully.');
    }
}
