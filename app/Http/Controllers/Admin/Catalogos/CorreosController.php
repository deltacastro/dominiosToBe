<?php

namespace App\Http\Controllers\Admin\Catalogos;

use App\Correo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CorreosController extends Controller
{

    public function __construct()
    {
        $this->correoModel = new Correo;
        $this->response = [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $correos = $this->correoModel->getAll();
        return view('admin.catalogos.correos.index', compact('correos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|max:50',
            'correo' => 'required|email',
        ]);
        $guardado = $this->correoModel->guardar($request->all());
        
        if ($guardado->id) {
            $this->response['code'] = 200;
            $this->response['status'] = 'ok';
            $this->response['modelData'] = [
                'id' => $guardado->id,
                'nombre' => $guardado->nombre,
                'correo' => $guardado->correo
            ];
            $this->response['route']= [
                'edit' => route('admin.catalogo.correo.update', ['correo' => $guardado->id]),
                'destroy' => route('admin.catalogo.correo.destroy', ['correo' => $guardado->id])
            ];
        }
        return response()->json($this->response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Correo  $correo
     * @return \Illuminate\Http\Response
     */
    public function show(Correo $correo)
    {
        if ($correo->id) {
            $this->response['code'] = 200;
            $this->response['status'] = 'ok';
            $this->response['modelData'] = [
                'id' => $correo->id,
                'nombre' => $correo->nombre,
                'correo' => $correo->correo
            ];
            $this->response['route']= [
                'edit' => route('admin.catalogo.correo.update', ['correo' => $correo->id]),
                'delete' => route('admin.catalogo.correo.destroy', ['correo' => $correo->id])
            ];
        }
        return response()->json($this->response);
    }

    public function update (Request $request, Correo $correo)
    {
        $guardado = $this->correoModel->actualizar($request->all(), $correo);
        
        if ($guardado->id) {
            $this->response['code'] = 200;
            $this->response['status'] = 'ok';
            $this->response['modelData'] = [
                'id' => $guardado->id,
                'nombre' => $guardado->nombre,
                'correo' => $guardado->correo
            ];
            $this->response['route']= [
                'edit' => route('admin.catalogo.correo.update', ['correo' => $guardado->id]),
                'destroy' => route('admin.catalogo.correo.destroy', ['correo' => $guardado->id])
            ];
        }
        return response()->json($this->response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Correo  $correo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Correo $correo)
    {
        if ($correo->eliminar()) {
            $this->response['code'] = 200;
            $this->response['status'] = 'ok';
            $this->response['modelData'] = [
                'id' => $correo->id,
                'nombre' => $correo->nombre,
                'correo' => $correo->correo
            ];
        }
        return response()->json($this->response);
    }
}
