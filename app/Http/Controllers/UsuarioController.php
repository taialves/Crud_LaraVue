<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Repositories\UsuarioRepository;

class UsuarioController extends Controller
{
    public function __construct(Usuario $usuario){
        $this->usuario = $usuario;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $usuarioRepository = new UsuarioRepository($this->usuario);

        If($request->has('attr_insc')){
            $attr_insc = 'inscritos:id,'.$request->attr_insc;
            $usuarioRepository->selectAttrRegRelations($attr_insc);
        }else{
            $usuarioRepository->selectAttrRegRelations('inscritos');
        }

        if($request->has('filtro')){
            $usuarioRepository->filtro($request->filtro);
        }

        if($request->has('attr_user')){
            $usuarioRepository->selectUserAttributes($request->attr_user);
        }
       
        return response()->json($usuarioRepository->getRegisters(),200);
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

    
        $request->validate($this->usuario->rules(), $this->usuario->feedback());

        $usuario = $this->usuario->create($request->all());

        return response()->json($usuario, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = $this->usuario->with('inscritos')->find($id);
        if($usuario === null){
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404) ;
        }
        return response()->json($usuario, 200);
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
        $usuario = $this->usuario->find($id);
        if($usuario === NULL){
            return response()->json(['erro' => 'Recurso pesquisado não existe'],404);
        }

        if($request->method() == 'PATCH'){
            $regrasDinamicas = array();

            // percorrendo todas as regras definidas no Model
            foreach($usuario->rules() as $input => $regra){

                // coletar apenas as regras aplicaveis aos parametros parciais da requisição
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas);
    
        }else{
            $request->validate($usuario->rules());
        }

        $usuario->fill($request->all());
        $usuario->save();

        return response()->json($usuario, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = $this->usuario->find($id);
        
        if($usuario === NULL){
            return response()->json(['erro' => 'Recurso pesquisado não existe'],404);
        }
        
        $usuario->delete();
        response()->json(['msg' => 'O usuario foi removido com sucesso'], 200);
    }
}
