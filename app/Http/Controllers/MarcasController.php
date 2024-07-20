<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarcasController extends Controller
{
    public function index(Request $request)
    {
        $data['marcas'] = Marca::query();

        if ($request->has('nome')) {
            $data['marcas']->where('nome', 'like', "%".$request->nome."%");
        }

        $data['marcas_all'] = $data['marcas']->count();

        return view('marcas.index')
            ->with('marcas', $data['marcas']->paginate(10)->appends($request->all()))
            ->with('marcas_all',$data['marcas_all']);
    }

    public function store(Request $request)
    {
        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

        //OBTEM OS DADOS
        $data = $request->except('_token');

        Marca::create($data);

        //ENVIA A TRASAÇÃO (COMMIT)
        DB::commit();

        //ENVIA MENSAGEM DE SUCESSO
        session()->flash('success', 'success');

        return to_route('marcas.index');
    }

    public function update(Request $request, Marca $marca)
    {

        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

        //OBTEM OS DADOS
        $data = $request->except('_token');

        //SALVA O PRODUTO
        $marca->fill($data);
        $marca->save();

        //ENVIA A TRASAÇÃO (COMMIT)
        DB::commit();

        //ENVIA MENSAGEM DE SUCESSO
        session()->flash('success', 'success');

        return to_route('marcas.index');
    }

    public function destroy(Marca $marca)
    {
        $marca->delete();

        //ENVIA MENSAGEM DE SUCESSO
        session()->flash('success', 'success');

        return to_route('marcas.index');
    }
}
