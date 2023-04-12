<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the books or a specific book by ID.
     * Will only get books that are registered to the Users library
     *
     * @param int|null $id
     * @return BookResource
     */
    public function index($id = null): BookResource
    {
        $user = Auth::user();
        if ($id) {
            $book = $user->library->availableBooks()->where('id', $id)->firstOrFail();
            return new BookResource($book);
        } else {
            $books = $user->library->availableBooks();
            return new BookResource($books);
        }
    }

    /**
     * Store a newly created book in the database.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'author_name' => 'required',
            'library_id' => 'required'
        ]);

        $book = Book::create($validatedData);

        return response()->json($book, 201);
    }

    /**
     * Update the specified book in the database.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'author_name' => 'required',
            'library_id' => 'required'
        ]);

        $user = Auth::user();

        $book = $user->library->availableBooks()->where('id', $id)->firstOrFail();
        $book->update($validatedData);

        return response()->json($book);
    }

    /**
     * Remove the specified book from the database.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $user = Auth::user();
        $book = $user->library->availableBooks()->where('id', $id)->firstOrFail();
        $book->delete();

        return response()->json(['message' => 'Book successfully deleted'], 204);
    }
}
