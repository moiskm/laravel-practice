<div>
    {{--
        - Lista recursos con botones para editar y eliminar.
    --}}
    @if($resources->isEmpty())
        <p>No hay recursos aún.</p>
    @else
        <ul style="list-style:none;padding:0;margin:0;">
            @foreach($resources as $res)
                <li style="margin-bottom:.6rem;display:flex;align-items:center;justify-content:space-between;padding:.3rem .2rem;border-bottom:1px solid #eee;">
                    <div>
                        <strong>{{ $res->title ?? '(Sin título)' }}</strong>
                        @if($res->book) <small style="color:#666;margin-left:.6rem;">{{ $res->book->title }}</small> @endif
                    </div>
                    <div>
                        <button wire:click.prevent="edit({{ $res->id }})" style="padding:.25rem .5rem;margin-right:.4rem;">Editar</button>
                        <button wire:click.prevent="delete({{ $res->id }})" style="padding:.25rem .5rem;background:#ffe6e6;border:1px solid #ffb3b3;">Eliminar</button>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
