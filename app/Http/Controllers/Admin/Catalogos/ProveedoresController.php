<?php

namespace App\Http\Controllers\Admin\Catalogos;

use App\Proveedor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProveedoresController extends Controller
{

    public function __construct()
    {
        $this->proveedorModel = new Proveedor;
        $this->response = [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = $this->proveedorModel->getAll();
        return view('admin.catalogos.proveedores.index', compact('proveedores'));
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
        $guardado = $this->proveedorModel->guardar($request->all());
        
        if ($guardado->id) {
            $this->response['code'] = 200;
            $this->response['status'] = 'ok';
            $this->response['modelData'] = [
                'id' => $guardado->id,
                'nombre' => $guardado->nombre
            ];
            $this->response['route']= [
                'edit' => route('admin.catalogo.proveedor.update', ['proveedor' => $guardado->id]),
                'destroy' => route('admin.catalogo.proveedor.destroy', ['proveedor' => $guardado->id])
            ];
        }
        return response()->json($this->response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedor $proveedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        $guardado = $this->proveedorModel->actualizar($request->all(), $proveedor);
        
        if ($guardado->id) {
            $this->response['code'] = 200;
            $this->response['status'] = 'ok';
            $this->response['modelData'] = [
                'id' => $guardado->id,
                'nombre' => $guardado->nombre
            ];
            $this->response['route']= [
                'edit' => route('admin.catalogo.proveedor.update', ['proveedor' => $guardado->id]),
                'destroy' => route('admin.catalogo.proveedor.destroy', ['proveedor' => $guardado->id])
            ];
        }
        return response()->json($this->response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedor)
    {
        if ($proveedor->eliminar()) {
            $this->response['code'] = 200;
            $this->response['status'] = 'ok';
            $this->response['modelData'] = [
                'id' => $proveedor->id,
                'nombre' => $proveedor->nombre
            ];
        }
        return response()->json($this->response);
    }
}
