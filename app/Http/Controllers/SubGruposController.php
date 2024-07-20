<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\SubGrupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubGruposController extends Controller
{
    public function index(Request $request)
    {
        $data['grupos'] = Grupo::all();
        $data['sub_grupos'] = SubGrupo::query();

        if ($request->has('nome')) {
            $data['sub_grupos']->where('nome', 'like', "%".$request->nome."%");
        }

        $data['sub_grupos_all'] = $data['sub_grupos']->count();

        return view('sub_grupos.index')
            ->with('sub_grupos', $data['sub_grupos']->paginate(10)->appends($request->all()))
            ->with('sub_grupos_all',$data['sub_grupos_all'])
            ->with('grupos', $data['grupos']);
    }

    public function store(Request $request)
    {
        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

        //OBTEM OS DADOS
        $data = $request->except('_token');

        SubGrupo::create($data);

        //ENVIA A TRASAÇÃO (COMMIT)
        DB::commit();

        //ENVIA MENSAGEM DE SUCESSO
        session()->flash('success', 'success');

        return to_route('sub_grupos.index');
    }

    public function update(Request $request, SubGrupo $subGrupo)
    {

        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

        //OBTEM OS DADOS
        $data = $request->except('_token');
        //SALVA O PRODUTO
        $subGrupo->fill($data);
        $subGrupo->save();

        //ENVIA A TRASAÇÃO (COMMIT)
        DB::commit();

        //ENVIA MENSAGEM DE SUCESSO
        session()->flash('success', 'success');

        return to_route('sub_grupos.index');
    }

    public function destroy(SubGrupo $subGrupo)
    {
        $subGrupo->delete();

        //ENVIA MENSAGEM DE SUCESSO
        session()->flash('success', 'success');

        return to_route('sub_grupos.index');
    }
}
