<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Marca;
use App\Models\Produto;
use App\Models\SubGrupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProdutosController extends Controller
{
    public function index(Request $request)
    {
        $data['produtos'] = Produto::query();

        if ($request->has('nome')) {
            $data['produtos']->where('nome', 'like', "%".$request->nome."%");
        }

        $data['produtos_all'] = $data['produtos']->count();

        return view('produtos.index')
            ->with('produtos', $data['produtos']->paginate(10)->appends($request->all()))
            ->with('produtos_all',$data['produtos_all']);
    }

    public function create()
    {
        $data['marcas'] = Marca::all();
        $data['grupos'] = Grupo::all();
        $data['sub_grupos'] = SubGrupo::all();

        return view('produtos.create')
            ->with('marcas',$data['marcas'])
            ->with('grupos',$data['grupos'])
            ->with('sub_grupos',$data['sub_grupos']);
    }

    public function store(Request $request)
    {
        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

        //OBTEM OS DADOS
        $data = $request->except('_token');

        $file = $request->file('image_url');
        if (isset($file)) {
            //MOVE O ARQUIVO PARA O LOCAL
            $path = '/uploads/';
            $data['image_url'] = $path . $file->getClientOriginalName();
            $file->move(public_path('uploads/'), $file->getClientOriginalName());
        }

        dd($data);
        Produto::create($data);

        //ENVIA A TRASAÇÃO (COMMIT)
        DB::commit();

        //ENVIA MENSAGEM DE SUCESSO
        session()->flash('success', 'success');

        return to_route('produtos.index');
    }

    public function edit(Produto $produto)
    {
        $data['marcas'] = Marca::all();
        $data['grupos'] = Grupo::all();
        $data['sub_grupos'] = SubGrupo::all();

        return view('produtos.edit')
            ->with(['produto' => $produto])
            ->with(['marcas' => $data['marcas']])
            ->with(['grupos' => $data['grupos']])
            ->with(['sub_grupos' => $data['sub_grupos']]);
    }

    public function update(Request $request, Produto $produto)
    {

        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

        //OBTEM OS DADOS
        $data = $request->except('_token');

        $file = $request->file('image_url');
        if (isset($file)) {
            //MOVE O ARQUIVO PARA O LOCAL
            $path = '/uploads/';
            $data['image_url'] = $path . $file->getClientOriginalName();
            $file->move(public_path('uploads/'), $file->getClientOriginalName());
        }

        //SALVA O PRODUTO
        $produto->fill($data);
        $produto->save();

        //ENVIA A TRASAÇÃO (COMMIT)
        DB::commit();

        //ENVIA MENSAGEM DE SUCESSO
        session()->flash('success', 'success');

        return to_route('produtos.index');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();

        //ENVIA MENSAGEM DE SUCESSO
        session()->flash('success', 'success');

        return to_route('produtos.index');
    }

    public function importCsv(Request $request)
    {
        $file = $request->file('csv_file');
        if ($file->isValid()) {
            $path = $file->getRealPath();
            $data = array_map('str_getcsv', file($path));

            foreach ($data as $key => $row) {
                if ($key == 0 ){continue;}
                $marca_row = !empty($row[11]) ? $row[11] : 'Outros';
                $grupo_row = !empty($row[12]) ? $row[12] : 'Outros';
                $sub_grupo_row = !empty($row[13]) ? $row[13] : 'Outros';
                $data_csv = [
                    'codigo_interno' => $row[0],
                    'codigo_externo' => $row[1],
                    'marca_do_produto' => $row[2],
                    'nome' => $row[3],
                    'descricao' => $row[4],
                    'marca' => $marca_row,
                    'grupo' => $grupo_row,
                    'sub_grupo' => $sub_grupo_row,
                    'visivel' => 'sim',
                    'image_url' => !empty($row[15]) ? $row[15] : null,
                    'codigo_de_pesquisa_1' => !empty($row[5]) ? $row[5] : null,
                    'codigo_de_pesquisa_2' => !empty($row[6]) ? $row[6] : null,
                    'codigo_de_pesquisa_3' => !empty($row[7]) ? $row[7] : null,
                    'codigo_de_pesquisa_4' => !empty($row[8]) ? $row[8] : null,
                    'codigo_de_pesquisa_5' => !empty($row[9]) ? $row[9] : null,
                    'codigo_de_pesquisa_6' => !empty($row[10]) ? $row[10] : null,
                ];

                $marca = [
                    'nome' => $marca_row,
                ];

                $grupo = [
                    'nome' => $grupo_row,
                ];

                $sub_grupo = [
                    'nome' => $sub_grupo_row,
                    'grupo' =>  $grupo_row,
                ];

                if (Produto::where('codigo_interno', $row[0])->exists()) {
                    Produto::query()->where('codigo_interno', $row[0])->update($data_csv);
                } else {
                    Produto::create($data_csv);
                }

                if (!Marca::query()->where('nome', $marca['nome'])->exists()) {
                    Marca::create($marca);
                }
                if (!Grupo::where('nome', $grupo['nome'])->exists()) {
                    Grupo::create($grupo);
                }
                if (!SubGrupo::where('nome', $sub_grupo['nome'])->exists()) {
                    SubGrupo::create($sub_grupo);
                }
            }

            return redirect()->back()->with('success', 'CSV importado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Erro ao importar CSV.');
        }
    }

    public function deletarTodos()
    {
        Produto::query()->delete();
        Marca::query()->delete();
        Grupo::query()->delete();
        SubGrupo::query()->delete();

        //ENVIA MENSAGEM DE SUCESSO
        session()->flash('success', 'success');

        return to_route('produtos.index');
    }
}
