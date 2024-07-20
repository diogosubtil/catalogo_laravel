@php use App\Models\Grupo;use App\Models\Marca; @endphp
    <!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Equipeças - Catálogo de produtos</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/images/icone.png') }}">
    {{ $stylesheet }}
    <style>
        .title_contatos {
            font-size: 35px;
        }

        @media (max-width: 725px) {
            .title_contatos {
                font-size: 25px;
            }
        }
    </style>
</head>
<body>
<script src="{{ asset('/assets/components_equipecas.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/equipecas.css') }}"/>
<script src="{{ asset('/assets/equipecas.js') }}"></script>
<div class="pagina-ideia" id="pagina-ideia">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="format-detection" content="telephone=no">
    <div class="container">
        <header>
            <span id="cw-botao-tab-0-0">
            </span>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-5 mt-4 logoEquipecas">
                    <a href="/">
                        <img src="{{ asset('/assets/images/logo.webp') }}" alt="Equipecas" style="width: 100%">
                    </a>
                </div>
            </div>
        </header>
        <div class="row content-catalogo ">
            <div class="col-lg-4 container-filtros container-fechado" id="ideia-container-filtros">
                <div class="content-filtros comp-jddb0kzl" id="tab-0" style="display: none;">
                    @if (Request::segment(1) != 'produto' && Request::segment(1) != 'lojas')
                        <form id="form-busca" action="{{ route('index.pesquisa') }}" type="POST">
                            <h1 class="tituloFiltros">Catálogo de Produtos</h1>
                            <div class="camposDeBusca">
                                <div class="input-groupTata">
                                    <input type="text" class="campoGeral"
                                           value="{{ !empty($_GET['geral']) ? $_GET['geral'] : null }}"
                                           placeholder="Nome / Codigo / Descrição"
                                           id="geral" name="geral">
                                </div>
                                <div class="input-groupTata">
                                    <select type="text" class="campoGeral" id="marca" name="marca">
                                        <option disabled value="" selected>Selecione a marca</option>
                                        @php
                                            $data['marcas'] = Marca::all();
                                        @endphp
                                        @foreach($data['marcas'] as $marcas)
                                            <option
                                                {{ !empty($_GET['marca']) && $_GET['marca'] == $marcas->nome ? 'selected'  : '' }} value="{{ $marcas->nome }}">{{ $marcas->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-groupTata">
                                    <select type="text" class="campoGeral" id="grupo" name="grupo">
                                        <option disabled value="" selected>Selecione o produto</option>
                                        @php
                                            $data['grupo'] = Grupo::all();
                                        @endphp
                                        @foreach($data['grupo'] as $grupo)
                                            <option
                                                {{ !empty($_GET['grupo']) && $_GET['grupo'] == $grupo->nome ? 'selected'  : '' }} value="{{ $grupo->nome }}">{{ $grupo->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-groupTata">
                                    <select type="text" class="campoGeral" id="sub_grupo" name="sub_grupo">
                                        <option disabled value="" selected>Selecione a linha do produto</option>
                                        @php
                                            $data['sub_grupo'] = Grupo::all();
                                        @endphp
                                        @foreach($data['sub_grupo'] as $sub_grupo)
                                            <option
                                                {{ !empty($_GET['sub_grupo']) && $_GET['sub_grupo'] == $sub_grupo->nome ? 'selected'  : '' }} value="{{ $sub_grupo->nome }}">{{ $sub_grupo->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="">
                                <button class="limpar" type="button" id="limpar-busca" onclick="limparBusca()">Limpar
                                    campos
                                </button>
                                <button class="buscar" type="submit">Buscar</button>
                            </div>
                        </form>
                    @endif
                    @if(Request::segment(1) == 'produto' )
                        <div class="col-12">
                            <span class="title_contatos" style="color: #8B0000"> Detalhes </span><br>
                            <span class="" style="color: #8B0000">Todos os detalhes e especificações do produto.</span>
                        </div>
                        <a href="{{ route('index') }}" class="buscar" type="submit">Voltar</a>
                    @endif
                    @if(Request::segment(1) == 'lojas' )
                        <div class="col-12">
                            <span class="title_contatos" style="color: #8B0000"> NOSSAS LOJAS </span><br>
                            <span class="" style="color: #8B0000">Venha fazer uma visita e tomar um cafézinho. Estamos prontos para te receber. </span>
                        </div>
                        <a href="{{ route('index') }}" class="buscar" type="submit">Voltar</a>
                    @endif
                </div>
            </div>
            <div class="col-lg-8">
                {{ $slot }}
            </div>
        </div>
    </div>
    <footer>
        <section class="assinatura">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="textoAssinatura">© Equipeças <span id="ideia-ano-footer"></span> - Todos os
                            direitos reservados.
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </footer>
</div>
{{ $scripts }}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    function limparBusca() {
        window.location.href = '/'
    }
</script>
</body>
</html>
