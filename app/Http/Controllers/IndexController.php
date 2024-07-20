<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Produto;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $data['produtos'] = Produto::query();
        $data['produtos']->where('visivel', '=', "sim");

        if ($request->has('marca')) {
            $data['produtos']->where('marca', '=', $request->marca);
        }

        if ($request->has('grupo')) {
            $data['produtos']->where('grupo', '=', $request->grupo);
        }

        if ($request->has('sub_grupo')) {
            $data['produtos']->where('sub_grupo', '=', $request->sub_grupo);
        }

        if ($request->has('geral')) {
            $geral = $request->geral;
            $data['produtos']->where(function($query) use ($geral) {
                $query->where('nome', 'like', "%$geral%")
                    ->orWhere('codigo_interno', 'like', "%$geral%")
                    ->orWhere('codigo_externo', 'like', "%$geral%")
                    ->orWhere('descricao', 'like', "%$geral%");
            });
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
