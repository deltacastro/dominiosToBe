<table id="proveedor">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Registro</th>
            <th>Expiración</th>
            <th>Opciones</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($hostings as $hosting)
            <tr id="nombre{{ $hosting->id }}">
                <td width="25%">{{ $hosting->nombre }}</td>
                <td width="25%">{{ $hosting->fechaRegistro }}</td>
                <td width="25%">{{ $hosting->fechaExpiracion }}</td>
                <td width="25%">
                    <a data-form="generalForm" data-nombre="{{ $hosting->nombre }}" data-put="{{ route('admin.catalogo.hosting.update', ['hosting' => $hosting]) }}" title="Editar" class="editar btn-floating btn-small waves-effect waves-light yellow"><i class="material-icons">edit</i></a>
                    <a data-form="generalForm" data-nombre="{{ $hosting->nombre }}" data-delete="{{ route('admin.catalogo.hosting.destroy', ['hosting' => $hosting]) }}" title="Eliminar" class="eliminar btn-floating btn-small waves-effect waves-light red accent-4"><i class="material-icons">delete</i></a>
                </td>
            </tr>
        @empty
        @endforelse
    </tbody>
</table>