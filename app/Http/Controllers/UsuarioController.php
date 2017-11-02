<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\usuario;

class UsuarioController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	public function index(){
        return redirect('activedirectory');
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(){
        return "Create";
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request){
        $campos = $request->all();


        $this->validate($request,[
            'nome' => 'required',
            'login' => 'required|unique:usuarios',
            'senha' => 'required|min:6',
            'senhac' => 'required|same:senha',
            'id_grupo' => 'required'
        ],[
            'senhac.same' => 'Senha não consiste'
        ]);

        $campos['senha'] = bcrypt($campos['senha']);

        // Busca nome do grupo para samba
        $nomeGrupo = DB::select('select nome as grupo from grupos where id_grupo = ' .$campos['id_grupo']);
        $nomeGrupo = $nomeGrupo[0]->grupo;


        # Criar Usuario
        $saida1 = shell_exec("/usr/local/samba/bin/samba-tool user create '" . $campos['login'] . "' --given-name='" . $campos['nome'] . "' password='" . $campos['senhac'] . "'; echo $?");
        # Redefini Senha
        $saida2 = shell_exec("/usr/local/samba/bin/samba-tool user setpassword '" . $campos['login'] . "' --newpassword='" . $campos['senhac'] . "' --must-change-at-next-login; echo $?");
        # Add ao grupo
        $saida3 = shell_exec("/usr/local/samba/bin/samba-tool group addmembers '" . $nomeGrupo . "' '". $campos['login'] . "'; echo $?");

        $saida1 = substr("$saida1",-2);
        $saida2 = substr("$saida3",-2);
        $saida3 = substr("$saida3",-2);

        if( $saida1 != 0 or $saida2 != 0 or $saida3 != 0 ){
            return back()->with('error','Alguma coisa deu errado no samba para criar o usuario \'' . $campos['nome'] . '\' entre em contato com o administrador');
        }

        Usuario::create($campos);
        return back()->with('success',' Usuario \'' . $campos['nome'] . '\' criado com sucesso');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){
        $Usuario = DB::select('select g.id_grupo, g.nome as grupo, u.id_usuario, u.nome, u.login, u.status from usuarios u, grupos g where g.id_grupo = u.id_grupo and u.id_usuario = ' .$id);
        $Regras = DB::select('select r.id_regras, r.tipo, r.url, u.nome FROM regras r, usuarios u where r.id_usuario = u.id_usuario and u.id_usuario = ' .$id);
        $Grupos = DB::select('select g.id_grupo, g.nome FROM grupos g');

        return view('usuario', compact('Usuario','Regras', 'Grupos'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id){
        return "Edit";
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request){
        $campos = $request->all();

        $id = $campos['id_usuario'];
        $campos = $request->except('_token', '_method','senhac');

        // Busca nome do grupo para samba
        $nomeGrupo = DB::select('select nome as grupo from grupos where id_grupo = ' .$campos['id_grupo']);
        $nomeGrupo = $nomeGrupo[0]->grupo;

        // Busca nome do grupo atual
        $grupoAnterior = DB::select('select g.nome from usuarios u, grupos g where u.id_grupo = g.id_grupo and u.id_usuario = ' . $id);
        $grupoAnterior = $grupoAnterior[0]->nome;
        //return $grupoAnterior;

        $this->validate($request,[
            'senha' => 'required|min:6',
            'senhac' => 'required|same:senha',
            'id_grupo' => 'required'
        ],[
            'senhac.same' => 'Senha não consiste'
        ]);

        # Redefini Senha
        $saida1 = shell_exec("/usr/local/samba/bin/samba-tool user setpassword '" . $campos['login'] . "' --newpassword='" . $campos['senha'] . "' --must-change-at-next-login; echo $?");
        $saida1 = substr("$saida1",-2);

        ## Habilitar Usuário
        $saida5 = shell_exec("/usr/local/samba/bin/samba-tool user enable ".$campos['login']."; echo $?");
        $saida5 = substr("$saida5",-2);

        // Desabilitar o Usuário
        $saida2 = 0;
        if( !empty($campos['status'])){
            $saida2 = shell_exec("/usr/local/samba/bin/samba-tool user disable '" . $campos['login'] . "'; echo $?");
            $saida2 = substr("$saida2",-2);
        }
        if( empty($campos['status'])){
            $campos['status'] = 'A';
        }

        ## Adicionar Usuario no novo grupo
        $saida4 = shell_exec("/usr/local/samba/bin/samba-tool group addmembers '" .$nomeGrupo."' '" .$campos['login']."'; echo $?");
        $saida4 = substr("$saida4",-2);

        ## Remover Usuario do grupo
        $saida3 = shell_exec("/usr/local/samba/bin/samba-tool group removemembers '" .$grupoAnterior."' '" .$campos['login']."'; echo $?");
        $saida3 = substr("$saida3",-2);

        if( $saida1 != 0 or $saida2 != 0 or $saida3 != 0 or $saida4 != 0 or $saida5 != 0 ){
            return back()->with('error','Alguma coisa deu errado no samba na modificação do usuario \'' . $campos['nome'] . '\' entre em contato com o administrador');
        }

        $campos['senha'] = bcrypt($campos['senha']);
        Usuario::where('id_usuario', $id)->update($campos);
        return back()->with('success',' Modificações no usuario \'' . $campos['nome'] . '\' realizada com sucesso');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id){

        $nomeUsuario = DB::select('select login as usuario from usuarios where id_usuario = ' .$id);
        $nomeUsuario = $nomeUsuario[0]->usuario;

        $saida = shell_exec("/usr/local/samba/bin/samba-tool user delete '" . $nomeUsuario ."'; echo $?");
        $saida = substr("$saida",-2);
        if( $saida != 0 ){
            return back()->with('error','Alguma coisa deu errado no samba ao remover o usuario \'' . $nomeUsuario . '\' entre em contato com o administrador');
        }

        Usuario::where('id_usuario', '=', $id)->delete();
        return back()->with('success',' Usuario \'' . $nomeUsuario .'\' removido com sucesso');
	}
}
