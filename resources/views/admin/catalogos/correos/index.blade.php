@extends('layouts.concept.default')

@section('title')
    Correos
@endsection

@section('view-body')
    <br>
    <br>
    @include('admin.catalogos.correos._form')
    @include('admin.catalogos.correos._list')
    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h5>¡Peligro!</h5>
            <p>¿Realmente desea eliminar la periodicidad?</p>
            <p>Todes les periodicidades asociades desapareceren.</p>
        </div>
        <div class="modal-footer">
            <a class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
            <a id="eliminarSubmit" data-form="generalForm" class="modal-close waves-effect waves-green btn-flat">Eliminar</a>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('js/correo.js') }}"></script>
@endsection