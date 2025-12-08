<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Models\Book;
use App\Models\BookResource;

class BookResourceForm extends Component
{
    use WithFileUploads;

    // listenerss: metodos publicos que pueden ser invocados desde otros componentes
    protected $listeners = [
        'loadResource',
        'resetForm',
    ];

    //vistas predeterminadasss
    public $resourceId;
    public $book_id;
    public $type = 'pdf';
    public $title;
    public $file; // UploadedFile
    public $external_url;
    public $duration_seconds;
    public $display_order = 0;
    public $description;
    public $metadata = [];
    public $is_active = true;

    public function mount($bookId = null, $resourceId = null)
    {
        $this->book_id = $bookId;
        $this->resourceId = $resourceId;

        // Si se monta el componente con un resourceId, cargar valores del recurso
        if ($this->resourceId) {
            $resource = BookResource::findOrFail($this->resourceId);
            $this->book_id = $resource->book_id;
            $this->type = $resource->type;
            $this->title = $resource->title;
            $this->external_url = $resource->external_url;
            $this->duration_seconds = $resource->duration_seconds;
            $this->display_order = $resource->display_order;
            $this->description = $resource->description;
            $this->metadata = $resource->metadata ?? [];
            $this->is_active = (bool) $resource->is_active;
        }
    }

    /**
  
     * Carga un BookResource existente para permitir su edición en el formulario
     */
    public function loadResource($resourceId)
    {
        $resource = BookResource::findOrFail($resourceId);

        $this->resourceId = $resource->id;
        $this->book_id = $resource->book_id;
        $this->type = $resource->type;
        $this->title = $resource->title;
        $this->external_url = $resource->external_url;
        $this->duration_seconds = $resource->duration_seconds;
        $this->display_order = $resource->display_order;
        $this->description = $resource->description;
        $this->metadata = $resource->metadata ?? [];
        $this->is_active = (bool) $resource->is_active;
    }

    /**
     * resetForm()
     *
     * Deja en blanco (estado por defecto) todas las propiedades del formulario
     * para poder crear un recurso nuevo
     */
    public function resetForm()
    {
        $this->resourceId = null;
        $this->book_id = null;
        $this->type = 'pdf';
        $this->title = null;
        $this->file = null;
        $this->external_url = null;
        $this->duration_seconds = null;
        $this->display_order = 0;
        $this->description = null;
        $this->metadata = [];
        $this->is_active = true;
    }

    protected function rules()
    {
        $types = BookResource::TYPES;

        return [
            'book_id' => ['required', 'exists:books,id'],
            'type' => ['required', Rule::in($types)],
            'title' => ['required', 'string', 'max:255'],
            'file' => ['nullable', 'file', 'max:10240'], // 10 MB
            'external_url' => ['nullable', 'url'],
            'duration_seconds' => ['nullable', 'integer', 'min:0'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'metadata' => ['nullable', 'array'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function updated($field)
    {
        // Validación para el campo actualizado
        $this->validateOnly($field);
    }

    public function save()
    {
        // Validar todos los campos según las reglas definidas
        $validated = $this->validate();

        if ($this->file) {
            $path = $this->file->store('book_resources', 'public');
            $validated['file_path'] = '/storage/' . $path;
        }

        // Si existe resourceId, actualizamos; en caso contrario creamos uno nuevo
        if ($this->resourceId) {
            $resource = BookResource::findOrFail($this->resourceId);
            $resource->update($validated);
            session()->flash('message', 'Recurso actualizado correctamente');
        } else {
            $resource = BookResource::create($validated);
            $this->resourceId = $resource->id;
            session()->flash('message', 'Recurso creado correctamente');
        }

        // Notificar a otros componentes y al frontend
        $this->dispatch('bookResourceSaved', $resource->id);
        $this->dispatch('notify', [
            'message' => $this->resourceId ? 'Recurso actualizado correctamente' : 'Recurso creado correctamente',
            'type' => 'success',
        ]);
        // Indica al frontend  que puede cerrar el modal
        $this->dispatch('closeResourceModal');
    }

    public function render()
    {
        $books = Book::select('id', 'title')->orderBy('title')->get();
        return view('livewire.book-resource-form', compact('books'));
    }
}
