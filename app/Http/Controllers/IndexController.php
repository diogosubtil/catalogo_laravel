<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $data['produtos'] = Produto::query();
        $data['produtos']->where('visivel', '=', "sim");

        if ($request->has('geral')) {
            $data['produtos']->where('nome', 'like', "%".$request->geral."%");
            $data['produtos']->orWhere('codigo_interno', 'like', "%".$request->geral."%");
            $data['produtos']->orWhere('codigo_externo', 'like', "%".$request->geral."%");
            $data['produtos']->orWhere('descricao', 'like', "%".$request->geral."%");
        }

        if ($request->has('linha_do_produto')) {
            $data['produtos']->where('linha_do_produto', 'like', "%".$request->linha_do_produto."%");
        }
        if ($request->has('montadora')) {
            $data['produtos']->where('montadora', 'like', "%".$request->montadora."%");
        }
        if ($request->has('veiculo')) {
            $data['produtos']->where('veiculo', 'like', "%".$request->veiculo."%");
        }
        if ($request->has('ano')) {
            $data['produtos']->where('ano', 'like', "%".$request->ano."%");
        }

        $data['produtos_all'] = $data['produtos']->count();

        return view('index')
            ->with('produtos', $data['produtos']->paginate(4)->appends($request->all()))
            ->with('produtos_all',$data['produtos_all']);
    }

    public function detalhes(Produto $produto)
    {
        return view('detalhes')->with('produto', $produto);
    }

    public function lojas()
    {
        return view('lojas');
    }
}
