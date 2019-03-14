<table id="proveedor">
    <thead>
        <tr>
            <th>Proveedor</th>
            <th>Opciones</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($proveedores as $proveedor)
            <tr id="nombre{{ $proveedor->id }}">
                <td width="75%">{{ $proveedor->nombre }}</td>
                <td width="25%">
                    <a data-form="proveedorForm" data-nombre="{{ $proveedor->nombre }}" data-put="{{ route('admin.catalogo.proveedor.update', ['proveedor' => $proveedor]) }}" title="Editar" class="editar btn-floating btn-small waves-effect waves-light yellow"><i class="material-icons">edit</i></a>
                    <a data-form="proveedorForm" data-nombre="{{ $proveedor->nombre }}" data-delete="{{ route('admin.catalogo.proveedor.destroy', ['proveedor' => $proveedor]) }}" title="Eliminar" class="eliminar btn-floating btn-small waves-effect waves-light red accent-4"><i class="material-icons">delete</i></a>
                </td>
            </tr>
        @empty
            <tr>
                <td class="center" colspan="2">
                    <span class="large">No hay ni un carajo</span> <br><i class="large material-icons">healing</i>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
