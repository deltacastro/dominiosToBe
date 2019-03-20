<?php

namespace App\Http\Controllers\Admin\Catalogos;

use App\Hosting;
use App\Periodicidad;
use App\Proveedor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HostingsController extends Controller
{

    public function __construct()
    {
        $this->periodicidadModel = new Periodicidad;
        $this->proveedorModel = new Proveedor;
        $this->hostingModel = new Hosting;
        $this->response = [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hostings = $this->hostingModel->getAll();
        $periodicidades = $this->periodicidadModel->getAll();
        $proveedores = $this->proveedorModel->getAll();
        return view('admin.catalogos.hostings.index', compact('periodicidades', 'hostings', 'proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guardado = $this->hostingModel->guardar($request->all());
        
        if ($guardado->id) {
            $this->response['code'] = 200;
            $this->response['status'] = 'ok';
            $this->response['modelData'] = [
                'id' => $guardado->id,
                'nombre' => $guardado->nombre,
                'registro' => $guardado->fechaRegistro,
                'expiracion' => $guardado->fechaExpiracion
            ];
            $this->response['route']= [
                'edit' => route('admin.catalogo.hosting.update', ['hosting' => $guardado->id]),
                'delete' => route('admin.catalogo.hosting.destroy', ['hosting' => $guardado->id])
            ];
        }
        return response()->json($this->response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\hosting  $hosting
     * @return \Illuminate\Http\Response
     */
    public function show(Hosting $hosting)
    {
        if ($hosting->id) {
            $this->response['code'] = 200;
            $this->response['status'] = 'ok';
            $this->response['modelData'] = [
                'id' => $hosting->id,
                'periodicidad_id' => $hosting->periodicidad_id,
                'proveedor_id' => $hosting->proveedor_id,
                'nombre' => $hosting->nombre,
                'descripcion' => $hosting->descripcion,
                'costo' => $hosting->costo,
                'fechaRegistro' => $hosting->fechaRegistro
            ];
            $this->response['route']= [
                'edit' => route('admin.catalogo.hosting.update', ['hosting' => $hosting->id]),
                'delete' => route('admin.catalogo.hosting.destroy', ['hosting' => $hosting->id])
            ];
        }
        return response()->json($this->response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\hosting  $hosting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hosting $hosting)
    {
        $guardado = $this->hostingModel->actualizar($request->all(), $hosting);
        
        if ($guardado->id) {
            $this->response['code'] = 200;
            $this->response['status'] = 'ok';
            $this->response['modelData'] = [
                'id' => $guardado->id,
                'nombre' => $guardado->nombre,
                'registro' => $guardado->fechaRegistro,
                'expiracion' => $guardado->fechaExpiracion
            ];
            $this->response['route']= [
                'edit' => route('admin.catalogo.hosting.update', ['hosting' => $guardado->id]),
                'delete' => route('admin.catalogo.hosting.destroy', ['hosting' => $guardado->id])
            ];
        }
        return response()->json($this->response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\hosting  $hosting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hosting $hosting)
    {
        if ($hosting->eliminar()) {
            $this->response['code'] = 200;
            $this->response['status'] = 'ok';
            $this->response['modelData'] = [
                'id' => $hosting->id,
                'nombre' => $hosting->nombre
            ];
        }
        return response()->json($this->response);
    }
}
