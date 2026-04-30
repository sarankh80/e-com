<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\DataTables\CategoryDataTable;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return view('category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $parentCategories = Category::where('parent_id', 0)->get();
        return view('category.add', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'name_kh' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:12048',
            'parent_id' => 'required|integer',
        ]);

        $data = $request->all();
        
        // Auto-generate slug from English name
        $data['slug'] = Str::slug($request->name);
        
        // Handle status checkbox
        $data['is_active'] = $request->has('is_active');

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
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
   public function edit(Category $category)
    {
        // Fetch all categories except the current one to avoid self-parenting
        $parentCategories = Category::where('id', '!=', $category->id)->get();

        return view('category.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'name_kh'     => 'nullable|string|max:255',
            'parent_id'   => 'nullable|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string',
            'is_active'   => 'boolean',
        ]);

        $data = $request->all();

        // 1. Generate/Update Slug based on English Name
        $data['slug'] = Str::slug($request->name);

        // 2. Handle Image Upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            // Store new image
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        // 3. Handle Parent ID (Convert "0" or empty string to null)
        $data['parent_id'] = $request->parent_id ?: 0;

        // 4. Handle Checkbox (is_active)
        $data['is_active'] = $request->has('is_active');

        $category->update($data);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        // Delete image file before deleting record
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}
