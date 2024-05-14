<?php

namespace App\Http\Middleware;

use App\Models\Route;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


/**
 * Middileware de permissão de usuário
 *
 * @author João Victor Costa <joaovictorcosta@sysout.com.br>
 * @since 14/05/2024
 * @version 1.0.0
 */
class CheckRoutePermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //Verifica a rota da api
        $requestRoute  = $request->route();
        // Verifica a permissão daquela rota
        $requestRoutePermission = $requestRoute->getAction('permission');
        //Condicional para verificação da permissão, caso não tenha permissão o middleware deixa passar direto
        if($requestRoutePermission){
            //Verifica a rota no banco de dados
            $route = Route::where('key',$requestRoutePermission)->first();
            //Condicional para verificar a existência da rota no banco de dados.
            if($route){
                $userGroup = $request->user()->group;

                $userHasPermission = $userGroup->routes->contains('id',$route->id);

                if(!$userHasPermission){
                    return response('Sem permissão de usuário', Response::HTTP_UNAUTHORIZED);
                }

            }

        }

        return $next($request);
    }
}
