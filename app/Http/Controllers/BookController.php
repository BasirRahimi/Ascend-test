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
        $books = $user->library->books();

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
     * Display the specified resource.
     * 
     * @param string $id
     * 
     * @return Inertia
     */
    public function show(string $id): Inertia
    {
        $user = Auth::user();
        $book = $user->library->books()->where('id', $id)->firstOrFail();

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
        $user = Auth::user();
        $book = $user->library->books()->where('id', $id)->firstOrFail();

        return Inertia::render('Book/Edit', $book->toArray());
    }
}
