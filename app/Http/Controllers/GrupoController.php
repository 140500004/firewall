<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use Validator;
use App\grupo;
use App\Http\Controllers\Session;

class GrupoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


    public function index(Grupo $grupo){
	    //$grupos = $grupo->all();
        //return view('activedirectory', compact('grupos'));
        //return redirect('activedirectory');
        return "Testede aqui";

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(){
        return "create";
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request){

	    $nome = $request->all();
        $this->validate($request,[
            'nome' => 'required|unique:grupos|filled'
        ],
        [
            'nome.unique' => 'O grupo <strong>' . $nome['nome'] . '</strong> já está em uso.'

        ]);

        $saida = shell_exec("/usr/local/samba/bin/samba-tool group add " . $nome['nome'] ."; echo $?");
        $saida = substr("$saida",-2);
        if( $saida != 0 ){
            return back()->with('error','Alguma coisa deu errado no samba para criar o grupo \'' . $nome['nome'] . '\' entre em contato com o administrador');
        }

        Grupo::create($nome);
        return back()->with('success',' Grupo \'' . $nome['nome'] . '\' criado com sucesso');
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){
        return "show";
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id){
        return "edit";
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id){
        return "update";
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id){
        $g = DB::select('select nome from usuarios where id_grupo ='. $id);
        if(!empty($g)){
            return back()->with('warning','Para excluir um grupo é necessário que ele esteja vazio.');
        }

        $nomeGrupo = DB::select('select nome as grupo from grupos where id_grupo = ' .$id);
        $nomeGrupo = $nomeGrupo[0]->grupo;

        $saida = shell_exec("/usr/local/samba/bin/samba-tool group delete " . $nomeGrupo ."; echo $?");
        $saida = substr("$saida",-2);
        if( $saida != 0 ){
            return back()->with('error','Alguma coisa deu errado no samba ao remover o grupo \'' . $nomeGrupo . '\' entre em contato com o administrador');
        }

        Grupo::where('id_grupo', '=', $id)->delete();
        return back()->with('success',' Grupo \'' . $nomeGrupo .'\' removido com sucesso');
    }
}
