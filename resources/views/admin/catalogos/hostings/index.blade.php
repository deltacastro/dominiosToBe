@extends('layouts.concept.default')

@section('title')
    Hostings
@endsection

@section('view-body')
    <br>
    <br>
    @include('admin.catalogos.hostings._form')
    @include('admin.catalogos.hostings._list')
    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h5>¡Peligro!</h5>
            <p>¿Realmente desea eliminar el hosting?</p>
            <p>Todos los dominios asociados desapareceran.</p>
        </div>
        <div class="modal-footer">
            <a class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
            <a id="eliminarSubmit" data-form="generalForm" class="modal-close waves-effect waves-green btn-flat">Eliminar</a>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('js/hosting.js') }}"></script>
@endsection