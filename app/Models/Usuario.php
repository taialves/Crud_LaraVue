<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $fillable = ['nome','email','senha'];
    use HasFactory;

    public function rules(){
        return [
           'nome' => 'required',
           'email' => 'required|unique:usuarios,email,'.$this->id.'|email',
           'senha' => 'required|min:8'
       ];   
   }

   public function feedback(){
        return [
            'unique' => 'O :attribute informado já foi cadastrado'
        ];
   }

   public function inscritos(){
        return $this->hasMany('App\Models\Inscrito');
   }

}
