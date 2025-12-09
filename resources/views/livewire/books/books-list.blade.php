<x-layouts.app>

    <div style="max-width: 1000px; margin:auto;">

        <h1 style="margin-bottom:25px; text-align:center;">
            Lista de Libros
        </h1>

        <div style="
        background:white;
        padding:25px;
        border-radius:10px;
        border:1px solid #ddd;
        box-shadow:0 2px 6px rgba(0,0,0,0.05);
    ">

            @if($books->isEmpty())
            <p style="text-align:center; font-size:18px;">
                No hay libros registrados todavía.
            </p>
            @else

            <table style="width:100%; border-collapse:collapse; font-size:15px;">
                <thead>
                    <tr style="background:#f5f5f5;">
                        <th style="padding:12px; border-bottom:1px solid #ddd;">Portada</th>
                        <th style="padding:12px; border-bottom:1px solid #ddd;">Título</th>
                        <th style="padding:12px; border-bottom:1px solid #ddd;">Autor</th>
                        <th style="padding:12px; border-bottom:1px solid #ddd;">Estado</th>
                        <th style="padding:12px; border-bottom:1px solid #ddd;">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($books as $book)
                    <tr>
                        {{-- Portada --}}
                        <td style="padding:12px; border-bottom:1px solid #eee; text-align:center;">
                            @if($book->cover_image)
                            <img src="{{ $book->cover_image }}"
                                alt="Portada"
                                style="width:55px; height:75px; object-fit:cover; border-radius:5px;">
                            @else
                            <span style="color:#888;">Sin imagen</span>
                            @endif
                        </td>

                        {{-- Título --}}
                        <td style="padding:12px; border-bottom:1px solid #eee;">
                            {{ $book->title }}
                        </td>

                        {{-- Autor --}}
                        <td style="padding:12px; border-bottom:1px solid #eee;">
                            {{ $book->author }}
                        </td>


                        {{-- Estado --}}
                        <td style="padding:12px; border-bottom:1px solid #eee;">
                            @if($book->is_active)
                            <span style="color:#28a745; font-weight:bold;">Activo</span>
                            @else
                            <span style="color:#dc3545; font-weight:bold;">Inactivo</span>
                            @endif
                        </td>

                        {{-- Acciones --}}
                        <td style="padding:12px; border-bottom:1px solid #eee; text-align:center;">
                            <a href="{{ route('books.show', $book->id) }}"
                                style="
                                        background:#007bff;
                                        padding:7px 14px;
                                        color:white;
                                        border-radius:5px;
                                        text-decoration:none;
                                        font-size:14px;
                                   ">
                                Ver detalles
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @endif

        </div>

    </div>

</x-layouts.app>
