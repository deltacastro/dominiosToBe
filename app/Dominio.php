<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dominio extends Model
{
    use SoftDeletes;

    protected $table = 'dominios';

    protected $fillable = ['periodicidad_id', 'proveedor_id', 'nombre', 'descripcion', 'costo', 'fechaRegistro', 'fechaExpiracion', 'estatus', 'created_by', 'updated_by'];

    protected $dates = ['deleted_at'];
    
    //RELATIONSHIPS

    public function periodicidad()
    {
        return $this->hasOne(Periodicidad::class, 'id', 'periodicidad_id');
    }

    public function proveedor()
    {
        return $this->hasOne(Proveedor::class, 'id', 'proveedor_id');
    }

    //ACCESORS

    //INTERNAL FUNCTIONS

    private function buildDataFillable ($data, $periodicidad) {
        $dataFillable = array();
        $fechaExpiracion = '';
        foreach ($this->fillable as $value) {
            if ($value == 'fechaRegistro') {
                $fechaExpiracion = $this->yearRange($data[$value], $periodicidad);
                $dataFillable[$value] = isset($data[$value]) ? $data[$value] : null;
            } else if($value == 'fechaExpiracion') {
                $dataFillable[$value] = $fechaExpiracion;
            } else {
                $dataFillable[$value] = isset($data[$value]) ? $data[$value] : null;
            }
        }
        return $dataFillable;
    }

    private function yearRange ($date, $periodicidad) {
        $dateStr = strtotime($date);
        $fechaExpiracion = strtotime($periodicidad, $dateStr);
        return date('Y-m-d', $fechaExpiracion);
    }

    private function periodicidadConvertion($periodicidad_id)
    {
        $periodicidad = ['años' => 'year', 'año' => 'year', 'mes' => 'month'];
        $periodicidadModel = Periodicidad::find($periodicidad_id);
        $periodicidadNombre = $periodicidadModel->nombre;
        $explode = explode(' ', $periodicidadNombre);
        $format = "+ $explode[0] ";
        $format .= $periodicidad[$explode[1]];
        return $format;
    }

    //CRUD FUNCTIONS

    public function guardar($data) {
        $periodicidad_id = $data['periodicidad_id'];
        $periodicidad = $this->periodicidadConvertion($periodicidad_id);
        $data = $this->buildDataFillable($data, $periodicidad);
        $data['created_by'] = \Auth::user()->id;
        $data['updated_by'] = \Auth::user()->id;
        $data['estatus'] = 1;
        $data = $this->create($data);
        return $data;
    }

    public function actualizar($data, $model) {
        $periodicidad_id = $data['periodicidad_id'];
        $periodicidad = $this->periodicidadConvertion($periodicidad_id);
        $data = $this->buildDataFillable($data, $periodicidad);
        unset($data['created_by']);
        $data['updated_by'] = \Auth::user()->id;
        $data['estatus'] = 1;
        $data = $model->fill($data)->save();
        return $data ? $this->find($model->id) : false;
    }

    public function eliminar() {
        return $this->delete();
    }

    public function getAll() {
        return $this->all();
    }

    public function getAllList() {
        return $this->all()->pluck('nombre', 'id');
    }

    public function getExpiraciones()
    {
        $mesExpiracion = $this->getMesExpira();
        $semanaExpiracion = $this->getSemanaExpira();
    }

    public function getSemanaExpira ()
    {
        $rango['inicio'] = date('Y-m-d');
        $date = strtotime($rango['inicio']);
        $fechaExpiracion = strtotime('+1 week', $date);
        $rango['fin'] = date('Y-m-d', $fechaExpiracion);
        $data = $this->with('proveedor')->whereBetween('fechaExpiracion', $rango)->get();
        return $data;
    }

    public function getMesExpira() {
        $date = date('Y-m-d');
        $date = strtotime($date);
        $fechaExpiracion = strtotime('+1 month', $date);
        $fechaExpiracion = date('Y-m-d', $fechaExpiracion);
        $data = $this->with('proveedor')->where('fechaExpiracion', $fechaExpiracion)->get();
        return $data;
    }

    public function getCaducados()
    {
        $date = date('Y-m-d');
        $data = $this->with('proveedor')->where('fechaExpiracion', '<' ,$date)->get();
        return $data;
    }
}
