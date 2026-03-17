<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Copy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class StatsController extends Controller
{
     public function popularBooks()
    {
         $books = Book::withCount(['copies as total_borrowings' => function ($query) {
            $query->join('borrowings', 'copies.id', '=', 'borrowings.copy_id');
        }])->orderByDesc('total_borrowings')->take(5)->get();

        return response()->json($books, 200);
    }

    public function globalStats(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Accès refusé.'], 403);
        }

        $stats = [
            'total_categories' => Category::count(),
            'total_books' => Book::count(),
            'copies_status' => Copy::select('status', DB::raw('count(*) as total'))->groupBy('status')->pluck('total', 'status'),
            'top_categories' => Category::withCount('books')->orderByDesc('books_count')->take(3)->get()
        ];

        return response()->json($stats, 200);
    }
}
