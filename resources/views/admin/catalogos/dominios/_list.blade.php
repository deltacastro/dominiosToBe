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
        @forelse ($dominios as $dominio)
            <tr id="nombre{{ $dominio->id }}">
                <td width="25%">{{ $dominio->nombre }}</td>
                <td width="25%">{{ $dominio->fechaRegistro }}</td>
                <td width="25%">{{ $dominio->fechaExpiracion }}</td>
                <td width="25%">
                    <a data-form="generalForm" data-nombre="{{ $dominio->nombre }}" data-put="{{ route('admin.catalogo.dominio.update', ['dominio' => $dominio]) }}" title="Editar" class="editar btn-floating btn-small waves-effect waves-light yellow"><i class="material-icons">edit</i></a>
                    <a data-form="generalForm" data-nombre="{{ $dominio->nombre }}" data-delete="{{ route('admin.catalogo.dominio.destroy', ['dominio' => $dominio]) }}" title="Eliminar" class="eliminar btn-floating btn-small waves-effect waves-light red accent-4"><i class="material-icons">delete</i></a>
                </td>
            </tr>
        @empty
            <tr>
                <td class="center" colspan="4">
                    <span class="large">No hay ni un carajo</span> <br><i class="large material-icons">healing</i>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>