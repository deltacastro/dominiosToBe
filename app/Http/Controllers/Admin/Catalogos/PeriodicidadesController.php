<?php

namespace App\Http\Controllers\Admin\Catalogos;

use App\Periodicidad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PeriodicidadesController extends Controller
{
    public function __construct()
    {
        $this->periodicidadModel = new Periodicidad;
        $this->response = [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodicidades = $this->periodicidadModel->getAll();
        return view('admin.catalogos.periodicidades.index', compact('periodicidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guardado = $this->periodicidadModel->guardar($request->all());
        
        if ($guardado->id) {
            $this->response['code'] = 200;
            $this->response['status'] = 'ok';
            $this->response['modelData'] = [
                'id' => $guardado->id,
                'nombre' => $guardado->nombre
            ];
            $this->response['route']= [
                'edit' => route('admin.catalogo.periodicidad.update', ['periodicidad' => $guardado->id]),
                'delete' => route('admin.catalogo.periodicidad.destroy', ['periodicidad' => $guardado->id])
            ];
        }
        return response()->json($this->response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Periodicidad  $periodicidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Periodicidad $periodicidad)
    {
        $guardado = $this->periodicidadModel->actualizar($request->all(), $periodicidad);
        
        if ($guardado->id) {
            $this->response['code'] = 200;
            $this->response['status'] = 'ok';
            $this->response['modelData'] = [
                'id' => $guardado->id,
                'nombre' => $guardado->nombre
            ];
            $this->response['route']= [
                'edit' => route('admin.catalogo.periodicidad.update', ['periodicidad' => $guardado->id]),
                'delete' => route('admin.catalogo.periodicidad.destroy', ['periodicidad' => $guardado->id])
            ];
        }
        return response()->json($this->response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Periodicidad  $periodicidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Periodicidad $periodicidad)
    {

        if ($periodicidad->eliminar()) {
            $this->response['code'] = 200;
            $this->response['status'] = 'ok';
            $this->response['modelData'] = [
                'id' => $periodicidad->id,
                'nombre' => $periodicidad->nombre
            ];
        }
        return response()->json($this->response);
    }
}
