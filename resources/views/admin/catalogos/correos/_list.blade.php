<table id="proveedor">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Opciones</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($correos as $correo)
            <tr id="nombre{{ $correo->id }}">
                <td width="40%">{{ $correo->nombre }}</td>
                <td width="35%">{{ $correo->correo }}</td>
                <td width="25%">
                    <a data-form="generalForm" data-nombre="{{ $correo->nombre }}" data-put="{{ route('admin.catalogo.correo.update', ['correo' => $correo]) }}" title="Editar" class="editar btn-floating btn-small waves-effect waves-light yellow"><i class="material-icons">edit</i></a>
                    <a data-form="generalForm" data-nombre="{{ $correo->nombre }}" data-delete="{{ route('admin.catalogo.correo.destroy', ['correo' => $correo]) }}" title="Eliminar" class="eliminar btn-floating btn-small waves-effect waves-light red accent-4"><i class="material-icons">delete</i></a>
                </td>
            </tr>
        @empty
        @endforelse
    </tbody>
</table>