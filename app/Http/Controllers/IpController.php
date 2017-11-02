<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\ip;
use Illuminate\Http\Request;

class IpController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	public function index(Ip $ip){
        $ips = $ip->paginate(6);

        return view('ip', compact('ips'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(){
        return view('novoip');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request){
        $campos = $request->all();

        $this->validate($request,[
            'ip' => 'required|unique:ips|filled|ip',
            'descricao' => 'required',
        ]);

        Ip::create($campos);
        return redirect()->route('ip.index')->with('success','Cadastro realizado com sucesso');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id){
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id){
        $ips = Ip::where('id_ip', $id)->first();
        return view('editar',compact('ips'));
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

        $this->validate($request,[
            'ip' => 'required|filled|ip',
            'descricao' => 'required',
        ]);

        Ip::where('id_ip', $id)->update($campos);
        return redirect()->route('ip.index')->with('success','Dados atualizados com sucesso');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id){
        Ip::where('id_ip',$id)->delete();
        return redirect()->route('ip.index')->with('success','Removido com sucesso '. $id);
	}

}
