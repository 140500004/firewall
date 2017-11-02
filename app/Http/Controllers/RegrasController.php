<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\regras;
use Illuminate\Support\Facades\DB;

class RegrasController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

    public function index(Regras $regras){
        //return $regras;
        return redirect('activedirectory');
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(){
        return "Create";
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(Request $request){
        $all = $request->all();
        $url = $all['url'];
        $tipo = $all['tipo'];
        $id_grupo = $all['id_grupo'];
        $id_usuario = $all['id_usuario'];

        if($id_grupo == 0 ){
            $id_grupo = NULL;
        }
        if($id_usuario == 0 ){
            $id_usuario = NULL;
        }

        DB::insert('insert into regras (url, tipo, id_grupo, id_usuario) values (?,?,?,?)', array($url, $tipo, $id_grupo, $id_usuario));
        //return redirect('activedirectory');
        return back()->withInput()->with('success', 'Regra cadastrada com sucesso');
        //return redirect()->route('ip.index')->with('success','Regras  atualizados com sucesso');
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){
        Regras::where('id_regras', '=', $id)->delete();
        return redirect('activedirectory');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id){
        return "Edit";
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id){

        $campos = $request->all();
        $campos = $request->except('_token', '_method');

        Regras::where('id_regras', $id)->update($campos);
        return redirect('activedirectory');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id){
        return "destroy $id";
	}

}
