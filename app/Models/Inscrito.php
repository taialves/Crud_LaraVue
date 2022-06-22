<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscrito extends Model
{
    protected $table = 'inscritos';
    protected $fillable = ['usuario_id','nome','cpf','email','estado', 'cidade', 'bairro', 'logradouro', 'numero','complemento','cep'];
    use HasFactory;


    public function rules(){
        //'usuario_id' => 'exists:usuarios,id', 
        return [
            
            'nome' => 'required',
            'email' => 'required|unique:inscritos,email,'.$this->id.'|email',
            'cpf' =>'required|unique:inscritos,cpf,'.$this->id,
            'estado' =>'required',
            'cidade' =>'required',
            'bairro' =>'required',
            'logradouro' =>'required',
            'numero' =>'required|numeric',
            'complemento' =>'required',
            'cep' => 'required'
        ];   
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatorio',
            'unique' => 'O valor de :attribute já foi cadastrado',
            'email' => 'O valor de :attribute não é valido'
        ];
    }

   /* public function usuario(){
        // cada registro de inscrito deve pertencer a um usuario

        return $this->belongsTo('App\Models\Usuario');
    }*/
}
