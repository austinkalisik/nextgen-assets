<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * =============================
     * DISPLAY CATEGORIES + SEARCH
     * =============================
     */
    public function index(Request $request)
    {
        $query = Category::query();

        // SEARCH
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $categories = $query->latest()
                            ->paginate(10)
                            ->withQueryString();

        return view('categories', compact('categories'));
    }

    /**
     * =============================
     * STORE CATEGORY
     * =============================
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        Category::create($validated);

        return back()->with('success', 'Category added successfully');
    }

    /**
     * =============================
     * DELETE CATEGORY
     * =============================
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        return back()->with('success', 'Category deleted successfully');
    }
}