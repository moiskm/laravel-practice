<?php

namespace App\Livewire\Books;

use Livewire\Component;
use App\Models\Book;

class BookShow extends Component
{
    public $book;

    public function mount(Book $book)
    {
        $this->book = $book->load(['chapters', 'resources']);
    }

    public function render()
    {
        return view('livewire.books.book-show');
    }
}
