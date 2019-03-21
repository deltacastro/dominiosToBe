<div class="row">
    <form id="generalForm" class="col s12" method="POST" action="{{ route('admin.catalogo.dominio.store') }}" data-post="{{ route('admin.catalogo.dominio.store') }}"  data-put="">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="">
        <div class="row">
            <div class="input-field col s12 m6 l4">
                <select id="periodicidad_id" name="periodicidad_id" class="validate" required>
                    <option value="" disabled selected>Elige Periodicidad</option>
                    @forelse ($periodicidades as $periodicidad)
                        <option value="{{ $periodicidad->id }}">{{ $periodicidad->nombre }}</option>
                    @empty
                        <option value="" disabled class="test">Vacio....</option>
                    @endforelse
                </select>
                <span id="spanPeriodicidad" class="helper-text" data-error="mensaje de error" data-success="Excelente"></span>
            </div>
            <div class="input-field col s12 m6 l4">
                <select id="proveedor_id" name="proveedor_id" required>
                    <option value="" disabled selected>Elige Proveedor</option>
                    @forelse ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                    @empty
                        <option value="" disabled>Vacio....</option>
                    @endforelse
                </select>
                <span id="spanProveedor" class="helper-text" data-error="mensaje de error" data-success="Excelente"></span>
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="nombre" name="nombre" type="text" class="validate" required>
                <label for="nombre">Nombre</label>
                <span id="spanNombre" class="helper-text" data-error="mensaje de error" data-success="Excelente"></span>
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="descripcion" name="descripcion" type="text" class="validate" required>
                <label for="descripcion">Descripcion</label>
                <span id="spanDescripcion" class="helper-text" data-error="mensaje de error" data-success="Excelente"></span>
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="costo" name="costo" type="text" class="validate" required>
                <label for="costo">Costo</label>
                <span id="spanCosto" class="helper-text" data-error="mensaje de error" data-success="Excelente"></span>
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="fechaRegistro" type="text" name="fechaRegistro" class="datepicker" required>
                <label for="fechaRegistro">Fecha Registro</label>
                <span id="spanFechaRegistro" class="helper-text" data-error="mensaje de error" data-success="Excelente"></span>
            </div>
            <div class="input-field col s12 m6 l4">
                <a id="storeSubmit" data-form="generalForm" class="guardar btn-floating btn-large waves-effect waves-light red scale-transition"><i class="material-icons">add</i></a>
                <a id="editSubmit" data-form="generalForm" class="btn-floating btn-large waves-effect waves-light  light-green accent-3 scale-transition scale-out"><i class="material-icons">check</i></a>
                <a id="cancelSubmit" class="btn-floating btn-large waves-effect waves-light red accent-4 scale-transition scale-out"><i class="material-icons">cancel</i></a>
            </div>
        </div>
    </form>
</div>