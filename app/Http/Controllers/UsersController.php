<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UsersController extends Controller
{
    //FUNÇÃO PARA EXIBIR A VIEW INDEX
    public function index(Request $request)
    {
        //OBTEM OS PEDIDOS
        $data['users'] = User::query()
            ->orderByDesc('id');

        if ($request->has('name')) {
            $data['users']->where('name', 'like', "%".$request->name."%");
        }

        $data['users_all'] = $data['users']->count();

        return view('users.index')
            ->with('users', $data['users']->paginate(10)->appends($request->all()))
            ->with('users_all',$data['users_all']);
    }

    //FUNÇÃO PARA EXIBIR A VIEW CREATE
    public function create()
    {

        //RETORNA A VIEW
        return view('users.create');
    }

    //FUNÇÃO PARA CADASTRAR
    public function store(Request $request)
    {
        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

        //OBTEM OS DADOS DO REQUEST E FAZ O CADASTRO
        $data = $request->except('_token');
        $data['password'] = Hash::make($data['password']);
        User::create($data);

        //ENVIA A TRASAÇÃO (COMMIT)
        DB::commit();

        //ENVIA MENSAGEM DE SUCESSO
        session()->flash('success', 'success');

        //RETORNA A VIEW
        return to_route('users.index');
    }

    //FUNÇÃO PARA EXIBIR A VIEW EDIT
    public function edit(User $user)
    {
        //RETORNA A VIEW
        return view('users.edit')->with('user', $user);
    }

    //FUNÇÃO PARA UPDATE
    public function update(Request $request, User $user)
    {
        //VALIDAÇÃO DA SENHA
        if ($request->password){
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
        }

        //VALIDAÇÃO EMAIL
        if ($request->email != $user->email){
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            ]);
        }

        //VALIDAÇÕES
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);


        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

        //VALIDAÇÃO E-MAIL
        if ($request->email != $user->email){
            $user->email_verified_at = null;
        }

        $data = $request->except('_token');
        //VALIDAÇÃO PARA REDEFINIR SENHA
        if ($request->password){
            $data['password'] = Hash::make($request->password);
        } else {
            $data['password'] = $user->password;
        }

        $user->fill($data);
        $user->save();

        //ENVIA A TRASAÇÃO (COMMIT)
        DB::commit();

        //ENVIA MENSAGEM DE SUCESSO
        session()->flash('success', 'success');

        //RETORNA A VIEW
        return to_route('users.index');
    }

    //FUNÇÃO PARA UPDATE
    public function destroy(User $user)
    {
        //INICIA A TRANSAÇÃO
        DB::beginTransaction();

        $user->delete();

        //ENVIA A TRASAÇÃO (COMMIT)
        DB::commit();

        //ENVIA MENSAGEM DE SUCESSO
        session()->flash('success', 'success');

        //RETORNA A VIEW
        return to_route('users.index');
    }

}
