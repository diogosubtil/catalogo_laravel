<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Client;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Models\Request as Requests;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //FUNÇÃO PARA EXIBIR A VIEW DASHBOARD
    public function index()
    {
        $data['produtos'] = Produto::query()->limit(20)->orderBy('id', 'desc')->get();
        return view('dashboard')->with($data);
    }
}
