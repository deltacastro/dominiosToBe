<?php

namespace App\Http\Controllers\Admin\Catalogos;

use App\Dominio;
use App\Periodicidad;
use App\Proveedor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DominiosController extends Controller
{

    public function __construct()
    {
        $this->periodicidadModel = new Periodicidad;
        $this->proveedorModel = new Proveedor;
        $this->dominioModel = new Dominio;
        $this->response = [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dominios = $this->dominioModel->getAll();
        $periodicidades = $this->periodicidadModel->getAll();
        $proveedores = $this->proveedorModel->getAll();
        return view('admin.catalogos.dominios.index', compact('periodicidades', 'dominios', 'proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guardado = $this->dominioModel->guardar($request->all());
        
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
                'edit' => route('admin.catalogo.dominio.update', ['dominio' => $guardado->id]),
                'delete' => route('admin.catalogo.dominio.destroy', ['dominio' => $guardado->id])
            ];
        }
        return response()->json($this->response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dominio  $dominio
     * @return \Illuminate\Http\Response
     */
    public function show(Dominio $dominio)
    {
        if ($dominio->id) {
            $this->response['code'] = 200;
            $this->response['status'] = 'ok';
            $this->response['modelData'] = [
                'id' => $dominio->id,
                'periodicidad_id' => $dominio->periodicidad_id,
                'proveedor_id' => $dominio->proveedor_id,
                'nombre' => $dominio->nombre,
                'descripcion' => $dominio->descripcion,
                'costo' => $dominio->costo,
                'fechaRegistro' => $dominio->fechaRegistro
            ];
            $this->response['route']= [
                'edit' => route('admin.catalogo.dominio.update', ['dominio' => $dominio->id]),
                'delete' => route('admin.catalogo.dominio.destroy', ['dominio' => $dominio->id])
            ];
        }
        return response()->json($this->response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dominio  $dominio
     * @return \Illuminate\Http\Response
     */
    public function edit(Dominio $dominio)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dominio  $dominio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dominio $dominio)
    {
        $guardado = $this->dominioModel->actualizar($request->all(), $dominio);
        
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
                'edit' => route('admin.catalogo.dominio.update', ['dominio' => $guardado->id]),
                'delete' => route('admin.catalogo.dominio.destroy', ['dominio' => $guardado->id])
            ];
        }
        return response()->json($this->response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dominio  $dominio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dominio $dominio)
    {
        if ($dominio->eliminar()) {
            $this->response['code'] = 200;
            $this->response['status'] = 'ok';
            $this->response['modelData'] = [
                'id' => $dominio->id,
                'nombre' => $dominio->nombre
            ];
        }
        return response()->json($this->response);
    }
}
