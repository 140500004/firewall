<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AdController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index(){

        ///$GruposUsuarios = DB::select('SELECT u.id_usuario, u.nome as usuario, g.id_grupo, g.nome as grupo FROM usuarios u, grupos g WHERE u.id_grupo = g.id_grupo');

        $Grupos = DB::select('SELECT id_grupo, nome FROM grupos ORDER by nome');
        //$Usuarios = DB::select('select id_usuario, nome, id_grupo, status from usuarios');
        $Usuarios = DB::select('SELECT id_usuario, id_grupo, login, nome, senha, status FROM usuarios');
        //$Usuarios = DB::select('select u.id_usuario, u.nome, u.id_grupo, u.login, u.status, r.id_regras, r.tipo, r.url from usuarios u, regras r WHERE u.id_usuario = r.id_usuario order by u.nome');
        $Regras = DB::select('select id_regras, tipo, url, descricao from regras WHERE id_grupo is null and id_usuario is null');

        $RegrasUG = DB::select('select id_regras, id_grupo, id_usuario, tipo, url, descricao from regras WHERE id_grupo is not null or id_usuario is not null');

        return view('activedirectory', compact('Grupos','Usuarios', 'Regras', 'RegrasUG'));
        //return view('activedirectory', compact('GruposUsuarios'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(){
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
