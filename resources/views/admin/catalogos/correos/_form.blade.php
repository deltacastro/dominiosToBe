<div class="row">
    <form id="generalForm" class="col s12" method="POST" action="{{ route('admin.catalogo.correo.store') }}" data-post="{{ route('admin.catalogo.correo.store') }}"  data-put="">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="">
        <div class="row">
            <div class="input-field col s12 m6 l4">
                <input id="nombre" name="nombre" type="text" class="validate" required>
                <label for="nombre">Nombre</label>
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="correo" name="correo" type="email" class="validate" required>
                <label for="correo">Correo</label>
            </div>
            <div class="input-field col s12 m6 l4">
                <a id="storeSubmit" data-form="generalForm" class="guardar btn-floating btn-large waves-effect waves-light red scale-transition"><i class="material-icons">add</i></a>
                <a id="editSubmit" data-form="generalForm" class="btn-floating btn-large waves-effect waves-light  light-green accent-3 scale-transition scale-out"><i class="material-icons">check</i></a>
                <a id="cancelSubmit" class="btn-floating btn-large waves-effect waves-light red accent-4 scale-transition scale-out"><i class="material-icons">cancel</i></a>
            </div>
        </div>
    </form>
</div>