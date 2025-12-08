<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BookResource;

class BookResourceList extends Component
{
    public function render()
    {
        $resources = BookResource::with('book')->orderBy('created_at', 'desc')->get();

        return view('livewire.book-resource-list', compact('resources'));
    }

    public function create()
    {
        // Abrir modal vacio para crear un nuevo recurso
        $this->dispatch('openResourceModal');
        $this->dispatch('resetForm');
    }

    public function edit($id)
    {
        // Abrir modal y pedir al formulario que cargue el recurso por id
        $this->dispatch('openResourceModal');
        $this->dispatch('loadResource', $id);
    }

    public function delete($id)
    {
        $resource = BookResource::find($id);

        if ($resource) {
            $resource->delete();
            // Notificar éxito 
            $this->dispatch('notify', ['message' => 'Recurso eliminado', 'type' => 'success']);
        } else {
            // Notificar error si no existe
            $this->dispatch('notify', ['message' => 'Recurso no encontrado', 'type' => 'error']);
        }

    
    }
}
