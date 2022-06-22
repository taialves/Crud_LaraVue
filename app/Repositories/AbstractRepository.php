<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;


abstract class AbstractRepository{
    public function __construct(Model $model){
        $this->model = $model;
    }

    public function selectAttrRegRelations($atributos){
        $this->model = $this->model->with($atributos);
    }
    
    public function filtro($filtros){
        $filtros = explode(';',$filtros);
            
        foreach($filtros as $key => $condicao){
            $c = explode(':',$condicao);
            $this->model = $this->model->where($c[0],$c[1],$c[2]);
        } 
    }
    public function selectAttributes($atributos){
        $this->model = $this->model->selectRaw($atributos);

    }

    public function getRegisters(){
        return $this->model->get();
    }
}

?>