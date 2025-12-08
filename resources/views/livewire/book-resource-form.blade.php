<div>
    {{--
        - Formulario  para crear o editar BookResource.
    --}}
    {{-- Notification container (shown via JS when Livewire dispatches 'notify') --}}
    <div id="lf-notify" style="display:none;padding:10px;margin-bottom:10px;border-radius:4px;">
    </div>
    @if (session()->has('message'))
        <div class="flash">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="save">
        <div>
            <label>Libro</label>
            <select wire:model="book_id">
                <option value="">-- Selecciona --</option>
                @foreach($books ?? [] as $book)
                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>
            @error('book_id') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Tipo</label>
            <select wire:model="type">
                @foreach(App\Models\BookResource::TYPES as $t)
                    <option value="{{ $t }}">{{ strtoupper($t) }}</option>
                @endforeach
            </select>
            @error('type') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Título</label>
            <input type="text" wire:model.defer="title">
            @error('title') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Archivo (opcional)</label>
            <input type="file" wire:model="file">
            @error('file') <span class="error">{{ $message }}</span> @enderror
            @if ($file)
                <div>Nombre: {{ $file->getClientOriginalName() }}</div>
            @endif
        </div>

        <div>
            <label>URL externa</label>
            <input type="text" wire:model.defer="external_url">
            @error('external_url') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Duración (segundos)</label>
            <input type="number" wire:model.defer="duration_seconds">
            @error('duration_seconds') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Orden de visualización</label>
            <input type="number" wire:model.defer="display_order">
            @error('display_order') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Descripción</label>
            <textarea wire:model.defer="description"></textarea>
            @error('description') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Activo</label>
            <input type="checkbox" wire:model="is_active">
            @error('is_active') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Guardar</button>
    </form>
    
    <script>
        document.addEventListener('notify', function(e) {
            try {
                var box = document.getElementById('lf-notify');
                if (!box) return;
                var msg = e.detail && e.detail.message ? e.detail.message : 'Guardado correctamente';
                var type = e.detail && e.detail.type ? e.detail.type : 'success';
                box.textContent = msg;
                box.style.display = 'block';
                if (type === 'success') {
                    box.style.background = '#ecfdf5';
                    box.style.color = '#065f46';
                    box.style.border = '1px solid #10b98133';
                } else {
                    box.style.background = '#fff1f2';
                    box.style.color = '#7f1d1d';
                    box.style.border = '1px solid #ef444433';
                }
                setTimeout(function() { box.style.display = 'none'; }, 4000);
            } catch (err) {
                console.error(err);
            }
        });
    </script>
</div>
