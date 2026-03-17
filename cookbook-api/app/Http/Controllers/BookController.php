<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index()
    {
        return response()->json(Book::with('category')->get(), 200);
    }

    public function store(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Accès refusé. Action réservée aux administrateurs.'], 403);
        }

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:200',
            'author'      => 'required|string|max:200',
            'description' => 'nullable|string',
        ]);

        $book = Book::create([
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'author'      => $request->author,
            'description' => $request->description,
        ]);

        return response()->json(['message' => 'Le livre a été ajouté avec succès', 'book' => $book], 201);
    }

    public function show(string $id)
    {
        $book = Book::with('category')->findOrFail($id);
        return response()->json($book, 200);
    }

    public function update(Request $request, string $id)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Accès refusé. Action réservée aux administrateurs.'], 403);
        }

        $book = Book::findOrFail($id);

        $request->validate([
            'category_id' => 'sometimes|exists:categories,id',
            'title'       => 'sometimes|string|max:200',
            'author'      => 'sometimes|string|max:200',
            'description' => 'nullable|string',
        ]);

        $book->update([
            'category_id' => $request->category_id ?? $book->category_id,
            'title'       => $request->title ?? $book->title,
            'slug'        => $request->title ? Str::slug($request->title) : $book->slug,
            'author'      => $request->author ?? $book->author,
            'description' => $request->description ?? $book->description,
        ]);

        return response()->json(['message' => 'Le livre a été mis à jour avec succès', 'book' => $book], 200);
    }

    public function destroy(Request $request, string $id)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Accès refusé. Action réservée aux administrateurs.'], 403);
        }

        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(['message' => 'Le livre a été supprimé avec succès'], 200);
    }

    public function search(Request $request)
    {
        $keyword = $request->query('q');

        if (!$keyword) {
            return response()->json(['message' => 'Le paramètre q est requis.'], 422);
        }

        $books = Book::with('category')
            ->where('title', 'LIKE', "%{$keyword}%")
            ->orWhere('author', 'LIKE', "%{$keyword}%")
            ->orWhereHas('category', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%");
            })
            ->get();

        return response()->json($books, 200);
    }


    public function getNewArrivals(Request $request)
    {
        $query = Book::with('category')->latest();

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        return response()->json($query->take(5)->get(), 200);
    }


    public function showBySlug($category_slug, $book_slug)
    {
        $category = Category::where('slug', $category_slug)->firstOrFail();
        $book = Book::where('slug', $book_slug)
            ->where('category_id', $category->id)
            ->firstOrFail();

        return response()->json($book, 200);
    }
}
