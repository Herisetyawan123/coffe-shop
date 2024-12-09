<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::paginate(10);
            return view('admin.pages.category.index', [
                'categories' => $categories
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validate([
                'name' => 'required'
            ]);

            Category::create($validated);
            DB::commit();
            return redirect()->back()->with('success', 'Category added successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function update(Request $request, $slug)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'name' => 'required'
            ]);

            $category = Category::where('slug', $slug)->first();
            $category->name = $request->input('name');
            $category->save();

            DB::commit();
            return redirect()->back()->with('success', 'Category updated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function destroy($slug)
    {
        try {
            DB::beginTransaction();
            Category::where('slug', $slug)->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Category deleted successfully');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1451) {
                DB::rollBack();
                return redirect()->back()->with('error', 'This category is being used by other products.');
            } else {
                DB::rollBack();
                return redirect()->back()->with('error', $e->getMessage());
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
