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
        $data['marcas'] = Marca::query();
        $data['grupos'] = Grupo::query();
        $data['sub_grupos'] = SubGrupo::query();
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

        Produto::create($data);

        //ENVIA A TRASAÇÃO (COMMIT)
        DB::commit();

        //ENVIA MENSAGEM DE SUCESSO
        session()->flash('success', 'success');

        return to_route('produtos.index');
    }

    public function edit(Produto $produto)
    {
        $data['marcas'] = Marca::query();
        $data['grupos'] = Grupo::query();
        $data['sub_grupos'] = SubGrupo::query();

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
        // Validação do arquivo
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $file = $request->file('csv_file');
        if ($file->isValid()) {
            $path = $file->getRealPath();
            $data = array_map('str_getcsv', file($path));
            $data_csv = [];
            foreach ($data as $key => $row) {
                if ($key == 0 ){continue;}
                $data_csv[] = [
                    'nome' => $row[0],
                    'descricao' => $row[1],
                    'codigo_interno' => $row[2],
                    'codigo_externo' => $row[3],
                    'marca' => $row[4],
                    'veiculo' => $row[5],
                    'linha_do_produto' => $row[6],
                    'visivel' => $row[7],
                    'image_url' => $row[8]
                ];
            }

            Produto::create($data_csv);

            return redirect()->back()->with('success', 'CSV importado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Erro ao importar CSV.');
        }
    }
}
