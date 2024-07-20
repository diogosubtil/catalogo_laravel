<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GruposController extends Controller
{
    public function index(Request $request)
    {
        $data['grupos'] = Grupo::query();

        if ($request->has('nome')) {
            $data['grupos']->where('nome', 'like', "%".$request->nome."%");
        }

        $data['grupos_all'] = $data['grupos']->count();

        return view('grupos.index')
            ->with('grupos', $data['grupos']->paginate(10)->appends($request->all()))
            ->with('grupos_all',$data['grupos_all']);
    }

    public function store(Request $request)
    {
        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

        //OBTEM OS DADOS
        $data = $request->except('_token');

        Grupo::create($data);

        //ENVIA A TRASAÇÃO (COMMIT)
        DB::commit();

        //ENVIA MENSAGEM DE SUCESSO
        session()->flash('success', 'success');

        return to_route('grupos.index');
    }

    public function update(Request $request, Grupo $grupo)
    {

        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

        //OBTEM OS DADOS
        $data = $request->except('_token');

        //SALVA O PRODUTO
        $grupo->fill($data);
        $grupo->save();

        //ENVIA A TRASAÇÃO (COMMIT)
        DB::commit();

        //ENVIA MENSAGEM DE SUCESSO
        session()->flash('success', 'success');

        return to_route('grupos.index');
    }

    public function destroy(Grupo $grupo)
    {
        $grupo->delete();

        //ENVIA MENSAGEM DE SUCESSO
        session()->flash('success', 'success');

        return to_route('grupos.index');
    }
}
