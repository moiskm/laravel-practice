<x-layouts.app>

<div>

    <div style="max-width: 1000px; margin:auto;">

        <h1 style="text-align:center; margin-bottom:25px;">
             {{ $book->title }}
        </h1>

        <div style="
            background:white;
            padding:25px;
        ">

            {{-- INFO DEL LIBRO --}}
            <div style="display:flex; gap:25px; margin-bottom:20px;">

                {{-- IMAGEN --}}
                <div>
                    @if($book->cover_image)
                        <img src="{{ $book->cover_image }}"
                             style="width:150px; height:200px; object-fit:cover; border-radius:8px;">
                    @else
                        <div style="
                            width:150px; height:200px; background:#eee;
                            display:flex; align-items:center; justify-content:center;
                            border-radius:8px;
                        ">
                            Sin imagen
                        </div>
                    @endif
                </div>

                {{-- DATOS --}}
                <div style="flex:1;">
                    <p><strong>Autor:</strong> {{ $book->author }}</p>
                    <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
                    <p><strong>Año:</strong> {{ $book->publication_year }}</p>
                    <p><strong>Precio:</strong> ${{ number_format($book->price,2) }}</p>
                    <p><strong>Stock:</strong> {{ $book->stock }}</p>
                    <p>
                        <strong>Estado:</strong>
                        @if($book->is_active)
                            <span style="color:#28a745; font-weight:bold;">Activo</span>
                        @else
                            <span style="color:#dc3545; font-weight:bold;">Inactivo</span>
                        @endif
                    </p>
                </div>
            </div>

            <hr>

            {{-- 📌 Pestañas --}}
            <div style="margin-top:25px;">
                <button onclick="showTab('info')" class="tab-btn active">Información</button>
                <button onclick="showTab('chapters')" class="tab-btn">Capítulos</button>
                <button onclick="showTab('resources')" class="tab-btn">Recursos</button>
            </div>

            {{-- CONTENEDORES --}}
            <div id="tab-info" class="tab-content" style="display:block;">
                <h3> Descripción del libro</h3>
                <p>{{ $book->description ?? 'Sin descripción.' }}</p>
            </div>

            <div id="tab-chapters" class="tab-content" style="display:none;">
                <livewire:books.book-chapters :book="$book" />
            </div>

            <div id="tab-resources" class="tab-content" style="display:none;">
                <livewire:books.book-resources :book="$book" />
            </div>

        </div>
    </div>

    {{-- ESTILOS --}}
    <style>
        .tab-btn {
            padding: 10px 18px;
            border: none;
            background: #eee;
            margin-right: 5px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
        }
        .tab-btn.active {
            background: #007bff;
            color: white;
        }
        .tab-content {
            margin-top: 20px;
        }
    </style>

    {{-- SCRIPT --}}
    <script>
        function showTab(tab) {
            document.querySelectorAll(".tab-content").forEach(el => el.style.display = "none");
            document.querySelectorAll(".tab-btn").forEach(el => el.classList.remove("active"));
            document.getElementById("tab-" + tab).style.display = "block";
            event.target.classList.add("active");
        }
    </script>

</div>

</x-layouts.app>
