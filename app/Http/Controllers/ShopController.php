<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ShopController extends Controller
{
    /**
     * Lista de Lojas
     *
     *@return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function index(){
        $list = Shop::all();
        return Response($list);
    }

    /**
     * Lista lojas com relação ao id passado
     *
     * @param Request $request
     * @param integer $id
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */

    public function show(int $id){
        $shop = Shop::find($id);

        if($shop){
            return response($shop, Response::HTTP_OK);
        }else{
            return response('Não encontrado', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Cria Loja
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request){
        return $this->store($request);
    }

    /**
     * Editar Loja
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request){
        return $this->store($request);
    }

    /**
     * Deletar Loja
     *
     * @param Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function destroy(Request $request){
        $shop = shop::find($request->id);
        if($shop && $request->id){
            $shop->delete();
            return response('',Response::HTTP_ACCEPTED);
        }

        else{
            return response('',Response::HTTP_NOT_FOUND);
        }
    }




    private function validation(Request $request){

        $rules = [
            'name' => ['required', 'string']
        ];

        $method = $request->method();

        if ($method == 'PUT') {
            $rules['id'] = ['required', 'integer', 'exists:shops,id'];
        }

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        return $validator;

    }


    /**
     *
     *
     * @param Request $request
     * @return void
     */
    private function store(Request $request){

        $validator = $this->validation($request);
        if($validator -> fails()){
            return response($validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        else{
            $shop = $request->id ? Shop::find($request->id) : new Shop();
            return $this->save($shop,$request);
        }
    }


    /**
     * Salva o Loja no Banco de dados
     *
     * @param Shop $shop
     * @param Request $request
     * @return void
     */
    private function save(Shop $shop, Request $request){
        $shop->name = $request->name;
        $shop->save();
    }
}
