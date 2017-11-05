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
        //$Regras = DB::select('select id_regras, tipo, url, descricao from regras WHERE id_grupo is null and id_usuario is null');
        $Regras = Regras::select('id_regras', 'tipo', 'url', 'descricao')->where(['id_grupo' => null, 'id_usuario' => null])->paginate(5);

        return view('regrasgeral', compact('Regras'));
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

        $this->validate($request,[
            'url' => 'required|filled',
            'tipo' => 'required',
        ]);

        if($id_grupo == 0 ){
            $id_grupo = NULL;
        }
        if($id_usuario == 0 ){
            $id_usuario = NULL;
        }

        DB::insert('insert into regras (url, tipo, id_grupo, id_usuario) values (?,?,?,?)', array($url, $tipo, $id_grupo, $id_usuario));

        # Regras Grupo
        if( $id_grupo != NULL && $id_grupo != 0 ){
            $RegrasG = DB::select('select g.id_grupo, g.nome as grupo, r.id_regras, r.tipo, r.url FROM regras r, grupos g where r.id_grupo = g.id_grupo and r.id_grupo = ' .$id_grupo);
            $request->session()->flash('success', 'Regra cadastrada com sucesso');
            return view('regrasgrupos', compact('RegrasG'));
        }

        # Regras Usuario
        if( $id_usuario != NULL && $id_usuario != 0 ){
            $Regras = DB::select('select r.id_regras, r.tipo, r.url, u.nome FROM regras r, usuarios u where r.id_usuario = u.id_usuario and u.id_usuario = ' .$id_usuario);
            $request->session()->flash('success', 'Regra cadastrada com sucesso');
            return back()->with(compact($Regras));
        }

        # Regras GERAL
        $Regras = Regras::select('id_regras', 'tipo', 'url', 'descricao')->where(['id_grupo' => null, 'id_usuario' => null])->paginate(5);
        $request->session()->flash('success', 'Regra cadastrada com sucesso');
        return view('regrasgeral', compact('Regras'));
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){

        $RegrasG = DB::select('select g.id_grupo, g.nome as grupo, r.id_regras, r.tipo, r.url FROM regras r, grupos g where r.id_grupo = g.id_grupo and r.id_grupo = ' .$id);

        if(empty($RegrasG) ){
            $RegrasG = DB::select('select id_grupo, nome as grupo from grupos where id_grupo = '. $id);
            return view('regrasgrupos', compact('RegrasG'));
        }

        //return back()->withInput()->with('success', 'Regra cadastrada com sucesso');
        return view('regrasgrupos', compact('RegrasG'));
        //return redirect()->back()->with(compact('RegrasG'));
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
        return back()->with('success','Regra atualizado com sucesso');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id){
        Regras::where('id_regras', '=', $id)->delete();
        return back()->with('success','Regra removida com sucesso');
	}

}
