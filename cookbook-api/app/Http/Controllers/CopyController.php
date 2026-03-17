<?php

namespace App\Http\Controllers;
use App\Models\Copy;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\BookDegradedNotification;
use Illuminate\Support\Facades\Notification;

class CopyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Accès refusé.'], 403);
        }

        $request->validate([
            'book_id' => 'required|exists:books,id',
            'reference_code' => 'required|string|unique:copies',
        ]);

        $copy = Copy::create([
            'book_id' => $request->book_id,
            'reference_code' => $request->reference_code,
            'status' => 'disponible',
        ]);

        return response()->json(['message' => 'Exemplaire ajouté avec succès', 'copy' => $copy], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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

    public function getDegradedByBook(Request $request, $bookId)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Accès refusé.'], 403);
        }

        $copies = Copy::where('book_id', $bookId)
                      ->where('status', 'degrade')
                      ->get();

        return response()->json([
            'book_id' => $bookId,
            'total_degrades' => $copies->count(),
            'copies' => $copies
        ], 200);
    }

    public function updateStatus(Request $request, $id){
                if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Accès refusé.'], 403);
        }

        $copy = Copy::findOrFail($id);

        $request->validate([
            'status' => 'required|in:disponible,emprunte,degrade,perdu',
            'damage_details' => 'nullable|string'
        ]);

        $copy->update([
            'status' => $request->status,
             'damage_details' => $request->status === 'degrade' ? $request->damage_details : null,
        ]);

        if ($request->status === 'degrade') {
             $admins = User::where('role', 'admin')->get();
            Notification::send($admins, new BookDegradedNotification($copy));
        }
        return response()->json(['message' => 'Statut mis à jour', 'copy' => $copy], 200);

    }
}
