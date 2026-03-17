<?php

namespace App\Http\Controllers;
use App\Models\Borrowing;
use App\Models\Copy;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function borrow(Request $request)
    {
        $request->validate(['copy_id' => 'required|exists:copies,id']);

        $copy = Copy::findOrFail($request->copy_id);

        if ($copy->status !== 'disponible') {
            return response()->json(['message' => 'Cette copie n\'est pas disponible pour le moment.'], 400);
        }

        $copy->update(['status' => 'emprunte']);

        $borrowing = Borrowing::create([
            'user_id' => $request->user()->id,
            'copy_id' => $copy->id,
            'borrowed_at' => now(),
        ]);

        return response()->json(['message' => 'Livre emprunté avec succès', 'borrowing' => $borrowing], 201);
    }

    public function returnBook(Request $request, $id)
    {
        $borrowing = Borrowing::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->whereNull('returned_at')
            ->firstOrFail();

        $borrowing->update(['returned_at' => now()]);

         $borrowing->copy->update(['status' => 'disponible']);

        return response()->json(['message' => 'Livre retourné avec succès']);
    }
}
