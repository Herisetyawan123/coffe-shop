<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::with('category')->get();
            $categories = Category::all();
            return view('admin.pages.transaksi.index', compact(['products', 'categories']));
        } catch (\Throwable $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'buyer_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
        ]);

        $transaction = Transaction::create([
            'product_name' => $request->product_name,
            'buyer_name' => $request->buyer_name,
            'quantity' => $request->quantity,
            'total' => $request->total,
        ]);

        return redirect()->back()->with('success', 'Transaksi berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function history()
    {
     // Ambil data transaksi dengan pagination
     $transactions = Transaction::orderBy('created_at', 'desc')->paginate(10);

     // Kirim data ke view
     return view('admin.pages.transaksi.history', compact('transactions'));   //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
