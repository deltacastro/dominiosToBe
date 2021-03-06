@extends('layouts.concept.default')

@section('title')
    Proveedores
@endsection

@section('view-body')
    <br>
    <br>
    @include('admin.catalogos.proveedores._form')
    @include('admin.catalogos.proveedores._list')
    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h5>¡Peligro!</h5>
            <p>¿Realmente desea eliminar el proveedor?</p>
            <p>Todes les dominies asociades desapareceren.</p>
        </div>
        <div class="modal-footer">
            <a class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
            <a id="eliminarSubmit" data-form="proveedorForm" class="modal-close waves-effect waves-green btn-flat">Eliminar</a>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('js/proveedor.js') }}"></script>
@endsection