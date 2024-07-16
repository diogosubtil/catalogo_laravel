<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Equipeças - Catálogo de produtos</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/images/icone.png') }}">
    {{ $stylesheet }}
</head>
<body>
<script src="{{ asset('/assets/components_equipecas.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/equipecas.css') }}"/>
<script src="{{ asset('/assets/equipecas.js') }}"></script>
<div class="pagina-ideia" id="pagina-ideia">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="format-detection" content="telephone=no">
    <div class="container imagemFundo">
        <header>
            <div class="row">
                <div class="col-12 mt-2 linguagens container-mercado-aux" style="visibility: hidden;"
                     id="container-mercado-multiidioma">
                    <div class="cw-dropdown-mercado-content dropdown-content" id="cw-dropdown-mercado">
                        <div class="cw-dropdown-mercado-item">
                            <span style="text-transform: uppercase;">Seleção do mercado</span>
                        </div>
                        <div class="cw-dropdown-mercado-item ideia-container-selecao-mercado">
                            <button class="ideia-selecao-mercado" id="cw-botao-tab-0-0">
                                <img src=""
                                     alt="Mercado Brasileiro" class="bandeira-mercado">
                                <span class="texto-mercado">Brasil e demais países</span>
                            </button>
                            <button class="ideia-selecao-mercado" id="cw-botao-tab-0-1">
                                <img src=""
                                     alt="Mercado Argentino" class="bandeira-mercado">
                                <span class="texto-mercado">Argentina</span>
                            </button>
                        </div>
                    </div>

                    <div class="idioma">
                        IDIOMA:
                        <button id="cw-button-idioma-pt" class="botao-altera-idioma">
                            <img src="" alt="Idioma Brasileiro"
                                 class="bandeira-habilitada">
                            <img src=""
                                 alt="Idioma Brasileiro" class="bandeira-desabilitada">
                        </button>
                        <button id="cw-button-idioma-es" class="botao-altera-idioma">
                            <img src="" alt="Idioma Espanhol"
                                 class="bandeira-habilitada">
                            <img src=""
                                 alt="Idioma Espanhol" class="bandeira-desabilitada">
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-5 logoEquipecas" >
                    <a href="/">
                        <img src="{{ asset('/assets/images/logo.webp') }}" alt="Equipecas" style="width: 100%">
                    </a>
                </div>
            </div>
        </header>
        <div class="row content-catalogo ">
            <div class="col-lg-4 container-filtros container-fechado" id="ideia-container-filtros">
                <div class="content-filtros comp-jddb0kzl" id="tab-0" style="display: none;">
                    <form id="form-busca" action="{{ route('index.pesquisa') }}" type="POST">
                        <h1 class="tituloFiltros">Catálogo de Produtos</h1>
                        <div class="camposDeBusca">
                            <div class="input-groupTata">
                                <input type="text" class="campoGeral" value="{{ !empty($_GET['geral']) ? $_GET['geral'] : '' }}" placeholder="Nome / Codigo / Descrição"
                                       id="geral" name="geral">
                            </div>
                            <div class="input-groupTata">
                                <select type="text" class="campoGeral" id="marca" name="marca">
                                    <option disabled value="" selected>Selecione a marca</option>
                                    <option value="">oi</option>
                                    <option value="">oi</option>
                                    <option value="">oi</option>
                                    <option value="">oi</option>
                                </select>
                            </div>
                            <div class="input-groupTata">
                                <select type="text" class="campoGeral" id="veiculo" name="veiculo">
                                    <option disabled value="" selected>Selecione o veiculo</option>
                                    <option>oi</option>
                                </select>
                            </div>
                            <div class="input-groupTata">
                                <select type="text" class="campoGeral" id="marca_produto" name="marca_produto">
                                    <option disabled value="" selected>Selecione a marca do produto</option>
                                    <option>oi</option>
                                </select>
                            </div>
                        </div>
                        <div class="">
                            <button class="limpar" type="button" id="limpar-busca" onclick="limparBusca()">Limpar campos</button>
                            <button class="buscar" type="submit">Buscar</button>
                        </div>
                    </form>
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
        document.querySelector('#geral').value = '';
        document.querySelector('#marca').value = '';
        document.querySelector('#veiculo').value = '';
        document.querySelector('#marca_produto').value = '';
        document.querySelector('#form-busca').submit()
    }
</script>
</body>
</html>
