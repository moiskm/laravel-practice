@extends('layouts.app')

{{--
        Vista: book_resources/index.blade.php
        - Página que muestra la lista de recursos y un modal para crear/editar.
--}}

@section('content')
        <div style="padding:1rem;">
                <h1>Recursos del Libro</h1>

                <p><button id="btn-open-create" style="padding:.4rem .8rem;">Crear recurso</button></p>

        {{-- Modal (hidden by default) --}}
        <div id="resource-modal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.4);align-items:center;justify-content:center;">
            <div style="background:#fff;max-width:760px;width:90%;margin:auto;padding:1rem;border-radius:6px;position:relative;">
                <button id="modal-close" style="position:absolute;right:8px;top:8px;background:transparent;border:none;font-size:18px;">&times;</button>
                <h2>Crear / Editar Recurso</h2>
                <div>
                    @livewire('book-resource-form')
                </div>
            </div>
        </div>

        {{-- Render resource list via Livewire component (gestiona edición/elim) --}}
        <div>
            @livewire('book-resource-list')
        </div>
        
    </div>

        <script>
            (function(){
                var openBtn = document.getElementById('btn-open-create');
                var modal = document.getElementById('resource-modal');
                var closeBtn = document.getElementById('modal-close');
                // helper to find the Livewire component instance inside the modal
                function getLivewireComponent() {
                    var root = modal.querySelector('[wire\\:id]');
                    if (!root) return null;
                    try {
                        // Livewire exposes find by id
                        return window.Livewire.find(root.getAttribute('wire:id'));
                    } catch (err) {
                        return null;
                    }
                }

                function show() { modal.style.display = 'flex'; }
                function hide() { modal.style.display = 'none'; }

                if(openBtn) openBtn.addEventListener('click', function(e){ e.preventDefault(); show(); var comp = getLivewireComponent(); if(comp && comp.call) { comp.call('resetForm'); } });
                if(closeBtn) closeBtn.addEventListener('click', function(e){ e.preventDefault(); hide(); });

                // wire up edit buttons
                document.querySelectorAll('.btn-edit').forEach(function(b){
                    b.addEventListener('click', function(ev){
                        ev.preventDefault();
                        var id = this.getAttribute('data-id');
                        show();
                        var comp = getLivewireComponent();
                        if (comp && comp.call) {
                            // call server-side method to load resource into form
                            comp.call('loadResource', id);
                        }
                    });
                });

                // Delete handlers
                document.querySelectorAll('.btn-delete').forEach(function(b){
                    b.addEventListener('click', function(ev){
                        ev.preventDefault();
                        var id = this.getAttribute('data-id');
                        if (!confirm('¿Eliminar recurso? Esta acción no se puede deshacer.')) return;

                        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        fetch('/book-resources/' + id, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        }).then(function(res){
                            if (!res.ok) throw res;
                            return res.json();
                        }).then(function(json){
                            // simple: reload to refresh list
                            window.location.reload();
                        }).catch(function(err){
                            console.error('Error deleting', err);
                            alert('Error al eliminar el recurso');
                        });
                    });
                });

                // Close modal when Livewire dispatches this browser event
                window.addEventListener('closeResourceModal', function(){
                    hide();
                    // Reload the page to refresh the list (simple approach)
                    window.location.reload();
                });

                // Open modal when Livewire dispatches this browser event
                // (BookResourceList dispatches 'openResourceModal' on edit/create)
                window.addEventListener('openResourceModal', function(e){
                    // show modal when server-side Livewire triggers the event
                    show();
                    // If needed, the payload is available at e.detail
                });

                // Also listen for notify event and show temporary message near the top
                window.addEventListener('notify', function(e){
                    // optional: you could display notification here as well
                    console.info('notify', e.detail);
                });
            })();
        </script>
@endsection
