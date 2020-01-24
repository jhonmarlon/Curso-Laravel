<?php

namespace sistemaCelComunicaciones\Http\Controllers;

use Illuminate\Http\Request;

use sistemaCelComunicaciones\Http\Requests;
use sistemaCelComunicaciones\Usuario;
use Illuminate\Support\Facades\Redirect;
use sistemaCelComunicaciones\Http\Request\UsuarioFormRequest;
use DB;

class UsuarioController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        if($request)
        {
           $query=trim($request->get("searchText"));
           $usuarios=DB::table('usuario')->where('documento','LIKE','%'.$query.'%')
           ->where ('estado','=','1')
           ->orderBy('id','desc')
           ->paginate(7);
           return view('sistema.usuario.index',["usuarios"=>$usuarios,"searchText"=>$query]);
        }
    }

    public function create()
    {
      return view("sistema.usuario.create");
    }

    public function store(UsuarioFormRequest $request)
    {
       $usuario= new Usuario;
       $usuario->nombre=$request->get('nombre');
       $usuario->nombre=$request->get('documento');
       $usuario->nombre=$request->get('idRol');
       $usuario->estado='1';
       $usuario->save();
       return Redirect::to('sistema/usuario');

    }

    public function show($id)
    {
        return view("sistema.usuario.show",["usuario"=>Usuario::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view("sistema.usuario.edit",["usuario"=>Usuario::findOrFail($id)]);
    }
    public function update(UsuarioFormRequest $request, $id)
    {
       $usuario=Usuario::findOrFail($id);
       $usuario->nombre=$request->get('nombre');
       $usuario->documento=$request->get("documento");
       $usuario->update();

       return Redirect::to('sistema/usuario');
    }
    public function destroy($id)
    {
       $usuario=Usuario::findOrFail($id);
       $usuario->estado='0';
       $usuario->update();

       return Redirect::to('sistema/usuario');
    }
}
