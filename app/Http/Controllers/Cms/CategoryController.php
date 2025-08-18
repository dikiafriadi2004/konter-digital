<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Support\Str;
use App\Models\Cms\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Tambahkan paginate(10) atau sesuai kebutuhan
        $categories = Category::orderBy('id', 'desc')->paginate(5);
        return view('cms.categories.index', compact('categories'));
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
        // Validasi name
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Category name is required!',
        ]);

        // Generate slug
        $slug = Str::slug($request->name);

        // Cek apakah sudah ada kategori dengan nama atau slug sama
        $exists = Category::where('name', $request->name)
            ->orWhere('slug', $slug)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withErrors(['name' => 'Name or slug is already in use, please choose another one.'])
                ->withInput();
        }

        // Simpan kategori baru
        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $slug = Str::slug($request->name);

        // Cek apakah ada kategori lain dengan nama atau slug sama
        $exists = Category::where(function ($query) use ($request, $slug) {
            $query->where('name', $request->name)
                ->orWhere('slug', $slug);
        })
            ->where('id', '!=', $category->id) // jangan bandingin dengan dirinya sendiri
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'Name or slug is already in use, please choose another one.');
        }

        // Kalau aman → update
        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
