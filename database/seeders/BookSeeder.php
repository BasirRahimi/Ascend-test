<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Library;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run(): void
    {
        // Retrieve all existing libraries
        $libraries = Library::all();

        // Loop through each library and create 10 books for each
        $libraries->each(function ($library) {
            Book::factory()
                ->count(10)
                ->for($library) // Assign the books to the current library
                ->create();
        });
    }
}
