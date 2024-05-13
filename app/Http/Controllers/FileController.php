<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

/**
 * Undocumented FileController
 *
 * @author João Victor Costa <joaovictorcosta@sysout.com.br>
 * @since 12/05/2024
 * @version 1.0.0
 */
class FileController extends Controller
{
    /**
     * Listar Arquirvos
     *
     * @param Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function index(){
        $files = File::all();
        return response($files);
    }

    /**
     * Create File
     *
     * @param Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function create(Request $request){

        $data = $request->all();

        $rule = [
            'file' => ['required', 'file', 'min:1000', 'max:5000'],
        ];

        $validators = Validator::make($data, $rule);

        if($validators->fails()){
            return Response($validators->errors(),Response::HTTP_BAD_REQUEST);
        }

        else{

            $f = $request->file;

            $hash = md5_file($f->path());

            $extension = $f->extension();

            $filename = $hash.'.'.$extension;

            $dir = 'files/'.date('Y/m/d');

            $storePath = $dir.'/'.$filename;

            //Salvar arquivo
            Storage::putFileAs($dir, $f, $filename);

            //Criar Referencias
            $file = new File();

            $file->path = $storePath;

            $file->extension = $extension;

            $file->mime = $f->getMimeType();

            $file->size = $f->getsize();

            $file->created_at = now();

            $file->save();

            return response($file);
        }

    }

    function show(int $id){
        $file = File::find($id);

        if(!$file){
            return response('File not found', Response::HTTP_BAD_REQUEST);
        }

        if(Storage::exists($file->path)){

            $pathParts = explode('/', $file->path);

            $filename = array_pop($pathParts);

            return Storage::download($file->path, $filename,['Content-Type' => $file->name]);
        }
        else{
            return response('Não existe',response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
