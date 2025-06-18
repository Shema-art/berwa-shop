<?php

namespace App\Http\Controllers;

use App\Models\export;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Policies\ExportPolicy;

class ExportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exports = export::all();
        return view('exports.index', compact('exports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('exports.create', compact('products'));
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
            'exported_at' => 'required|date',
        ]);

        $import = DB::table('product_imports')->where('product_id', $validatedData['product_id'])->sum('quantity');
        $export = DB::table('exports')->where('product_id', $validatedData['product_id'])->sum('quantity');
        

        $stock = $import - $export;
        if ($stock >= $validatedData['quantity']) {
            Export::create([ // Changed from $export->create() to Export::create()
                'product_id' => $validatedData['product_id'],
                'quantity' => $validatedData['quantity'],
                'price' => $validatedData['price'],
                'total_price' => $validatedData['price'] * $validatedData['quantity'],
                'exported_at' => $validatedData['exported_at'],
            ]);

            return redirect()->route('exports.index')->with('success', 'Export created successfully.');
        } else {
            return redirect()->route('exports.index')->with('error', 'Stock is not sufficient.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $export = export::find($id);
        return view('exports.show', compact('export'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $export = export::find($id);
        return view('exports.edit', compact('export'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'exported_at' => 'required|date',
        ]);
        $export = export::find($id);
        $export->update([
            'quantity' => $validatedData['quantity'],
            'price' => $validatedData['price'],
            'total_price' => $validatedData['price'] * $validatedData['quantity'],
            'exported_at' => $validatedData['exported_at'],
        ]);
        return redirect()->route('exports.index')->with('success', 'Export updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    $export = export::find($id);
    $export->delete();
    return redirect()->route('exports.index')->with('success', 'Export deleted successfully.');
    }
}
