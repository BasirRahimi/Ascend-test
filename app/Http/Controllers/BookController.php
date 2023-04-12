<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return Inertia
     */
    public function index(): Inertia
    {
        $user = Auth::user();
        $books = Book::where('library_id', $user->library_id)->get();

        return Inertia::render('Book/Archive', [
            'books' => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return Inertia
     */
    public function create(): Inertia
    {
        return Inertia::render('Book/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * 
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $book = new Book();
        $book->name = $request->name;
        $book->author_name = $request->author_name;

        try {
            $book->save();
            return response()->json($book);
        } catch (Exception $err) {
            return response()->json(['error' => $err->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     * 
     * @param string $id
     * 
     * @return Inertia
     */
    public function show(string $id): Inertia
    {
        $book = Book::findOrFail($id);

        return Inertia::render('Book/Single', $book->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param string $id
     * 
     * @return Inertia
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);

        return Inertia::render('Book/Edit', $book->toArray());
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param Request $request
     * @param string $id
     * 
     * @return JsonResponse
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->name = $request->name;
        $book->author_name = $request->author_name;

        try {
            $book->save();
            return response()->json($book);
        } catch (Exception $err) {
            return response()->json(['error' => $err->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        $book = Book::find($id);

        if ($book) {
            $book->delete();
            return response()->json(['message' => 'Book successfully deleted']);
        } else {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }
}
