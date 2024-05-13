<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShopController extends Controller
{
    /**
     * Lista de Shops
     *
     * @return @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function index(){
        $list = Shop::all();
        return Response($list);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */


    public function delete(Request $request){
        $shop = shop::find($request->id);

        if($shop){
            $shop::delete();
            return response('Usuário deletado',Response::HTTP_ACCEPTED);
        }

        else{
            return response('Usuário não encontrado',Response::HTTP_NOT_FOUND);
        }
    }

    public function created(Request $request){

    }


    private function save(Shop $shop, Request $request){
        $shop->name = $request->name;
        $shop->save();
    }
}
