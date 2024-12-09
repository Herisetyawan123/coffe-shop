<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        try {
            $products = Product::with('category')->get();
            $categories = Category::all();
            return view('admin.pages.product.index', compact(['products', 'categories']));
        } catch (\Throwable $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validationData = $request->validate([
                'name' => 'required|max:255',
                'description' => 'required|max:255',
                'price' => 'required|numeric',
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category_id' => 'required'
            ]);

            $thumbnailName = time() . '.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('img/products'), $thumbnailName);


            $data = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'thumbnail' => url("/img/products/" . $thumbnailName),
                'category_id' => $request->category_id,
            ]);
            return redirect()->back()->with('success', 'Success add product data');
        } catch (\Throwable $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $slug): RedirectResponse
    {
        try {
            // dd($request);
            $validationData = $request->validate([
                'name' => 'required|max:255',
                'description' => 'required|max:255',
                'price' => 'required|numeric',
                'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'category_id' => 'required'
            ]);

            $product = Product::where('slug', $slug)->first();
            if ($request->hasFile('thumbnail')) {
                $thumbnailName = time() . '.' . $request->thumbnail->extension();
                $request->thumbnail->move(public_path('img/products'), $thumbnailName);
                $validationData['thumbnail'] = url("/img/products/" . $thumbnailName);

                if (Storage::exists('public/img/products' . $product->thumbnail)) {
                    Storage::delete('public/img/products' . $product->thumbnail);
                }
            }

            $product->name = $validationData["name"];
            $product->description = $validationData["description"];
            $product->price = $validationData["price"];
            $product->category_id = $validationData["category_id"];
            $product->thumbnail = $validationData['thumbnail'] ?? $product->thumbnail;
            $product->save();
            return redirect()->back()->with('success', 'Success update product data');
        } catch (\Throwable $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return redirect()->back()->with('success', 'Success delete product');
        } catch (\Throwable $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
