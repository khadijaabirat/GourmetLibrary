<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
$categories = Category::all()->map(function ($category) {
            return [
                'data' => $category,
                '_links' => $category->generateHateoasLinks('categories')
            ];
        });

        return response()->json($categories, 200);
            }

    public function store(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Accès refusé. Action réservée aux administrateurs.'], 403);
        }

        $request->validate([
            'name'        => 'required|string|max:250|unique:categories',
            'description' => 'nullable|string',
        ]);

        $category = Category::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return response()->json(['message' => 'Catégorie créée avec succès', 'category' => $category], 201);
    }

    public function show(string $id)
    {
        $category = Category::with('books')->findOrFail($id);
        return response()->json([
            'data' => $category,
            '_links' => $category->generateHateoasLinks('categories')
        ], 200);
        // return response()->json($category, 200);
    }

    public function update(Request $request, string $id)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Accès refusé. Action réservée aux administrateurs.'], 403);
        }

        $category = Category::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:250|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return response()->json(['message' => 'Catégorie mise à jour avec succès', 'category' => $category], 200);
    }

    public function destroy(Request $request, string $id)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Accès refusé. Action réservée aux administrateurs.'], 403);
        }

        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Catégorie supprimée avec succès'], 200);
    }
}
