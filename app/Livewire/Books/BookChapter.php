<?php

namespace App\Livewire\Books;

use Livewire\Component;
use App\Models\Book;
use App\Models\BookChapter;

class BookChapters extends Component
{
    public Book $book;
    public $title;
    public $description;
    public $color = '#000000';
    public $icon = '';
    public $order = 1;

    public $editingChapter = null;

    public function mount(Book $book)
    {
        $this->book = $book;
    }

    public function saveChapter()
    {
        $this->validate([
            'title' => 'required|string',
            'order' => 'required|integer',
        ]);

        if ($this->editingChapter) {
            $chapter = BookChapter::find($this->editingChapter);

            $chapter->update([
                'title' => $this->title,
                'description' => $this->description,
                'color' => $this->color,
                'icon' => $this->icon,
                'order' => $this->order,
            ]);

        } else {

            BookChapter::create([
                'book_id' => $this->book->id,
                'title' => $this->title,
                'description' => $this->description,
                'color' => $this->color,
                'icon' => $this->icon,
                'order' => $this->order,
                'is_active' => 1,
            ]);
        }

        $this->resetForm();
    }

    public function edit($id)
    {
        $chapter = BookChapter::find($id);
        $this->editingChapter = $chapter->id;

        $this->title = $chapter->title;
        $this->description = $chapter->description;
        $this->color = $chapter->color;
        $this->icon = $chapter->icon;
        $this->order = $chapter->order;
    }

    public function delete($id)
    {
        BookChapter::find($id)->delete();
    }

    public function resetForm()
    {
        $this->editingChapter = null;
        $this->title = '';
        $this->description = '';
        $this->color = '#000000';
        $this->icon = '';
        $this->order = 1;
    }

    public function render()
    {
        return view('livewire.books.book-chapters', [
            'chapters' => BookChapter::where('book_id', $this->book->id)
                ->orderBy('order')
                ->get(),
        ]);
    }
}
