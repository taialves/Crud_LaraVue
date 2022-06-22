<?php

namespace App\Http\Controllers;

use App\Models\Inscrito;
use Illuminate\Http\Request;
use App\Repositories\InscritoRepository;

class InscritoController extends Controller
{
    public function __construct(Inscrito $inscrito){
        $this->inscrito = $inscrito;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $inscritoRepository = new InscritoRepository($this->inscrito);

        /*If($request->has('attr_user')){
            $attr_user = 'usuario:id,'.$request->attr_user;
            $inscritoRepository->selectAttrRegRelations($attr_user);
        }else{
            $inscritoRepository->selectAttrRegRelations('usuario');
        }*/

        if($request->has('filtro')){
            $inscritoRepository->filtro($request->filtro);
        }

        if($request->has('attr_insc')){
            $inscritoRepository->selectAttributes($request->attr_insc);
        }
       
        return response()->json($inscritoRepository->getRegisters(),200);
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $request->validate($this->inscrito->rules(),$this->inscrito->feedback());

        $inscrito = $this->inscrito->create($request->all());

        return response()->json($inscrito, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //        $inscrito = $this->inscrito->with('usuario')->find($id);

        $inscrito = $this->inscrito->find($id);
        if($inscrito === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404) ;
        }
        return response()->json($inscrito, 200);
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inscrito = $this->inscrito->find($id);
        if($inscrito === NULL){
            return response()->json(['erro' => 'Recurso pesquisado não existe'],404);
        }

        if($request->method() == 'PATCH'){
            $regrasDinamicas = array();

            // percorrendo todas as regras definidas no Model
            foreach($inscrito->rules() as $input => $regra){

                // coletar apenas as regras aplicaveis aos parametros parciais da requisição
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas,$inscrito->feedback());
            
        }else{
            $request->validate($inscrito->rules(),$inscrito->feedback());
        }

        $inscrito->fill($request->all());
        $inscrito->save();

        return response()->json($inscrito, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inscrito = $this->inscrito->find($id);
        
        if($inscrito === NULL){
            return response()->json(['erro' => 'Recurso pesquisado não existe'],404);
        }
        
        $inscrito->delete();
        response()->json(['msg' => 'O inscrito foi removido com sucesso'], 200);
    }
}
