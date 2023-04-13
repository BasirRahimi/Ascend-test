<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    /**
     * Borrow a book from the library.
     * 
     * @param  Request  $request
     * @return JsonResponse
     */
    public function borrowBook(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'required'
        ]);

        $user = Auth::user();
        $book = $user->library->books()->firstOrFail($request->id);

        if ($book->isAvailable) {
            try {
                $book->user_id = $user->id;
                $book->save();
                return response()->json(['message' => 'Book has successfully been borrowed'], 200);
            } catch (Exception $error) {
                return response()->json(['message' => $error->getMessage()], $error->getCode());
            }
        } else {
            return response()->json(['message' => 'This book is not available to borrow.'], 409);
        }
    }

    /**
     * Return a borrowed book to the library.
     * 
     * @param  Request  $request
     * @return JsonResponse
     */
    public function returnBook(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'required'
        ]);

        $user = Auth::user();
        $book = $user->library->books()->firstOrFail($request->id);

        if ($book->user_id === $user->id) {
            try {
                $book->user_id = null;
                $book->save();
                return response()->json(['message' => 'Book has successfully been returned'], 200);
            } catch (Exception $error) {
                return response()->json(['message' => $error->getMessage()], $error->getCode());
            }
        } else {
            return response()->json(['message' => 'This book is not currently borrowed by the user.'], 409);
        }
    }
}
