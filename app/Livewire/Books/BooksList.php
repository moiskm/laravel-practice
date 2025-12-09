<?php

namespace App\Livewire\Books;

use Livewire\Component;
use App\Models\Book;

class BooksList extends Component
{
   public function render()
{
    return view('livewire.books.books-list', [
        'books' => \App\Models\Book::orderBy('title')->get()
    ]);
}

}
