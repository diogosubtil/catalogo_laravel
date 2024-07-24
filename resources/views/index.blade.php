@php use Illuminate\Support\Facades\File;use Illuminate\Support\Facades\Storage; @endphp
<x-index>
    @slot('stylesheet')
        <style>
            .pagina-ideia .page-link {
                padding: 5px .75rem !important;
            }

            .pagina-ideia .pagination li a {
                font-size: 15px !important;
                line-height: 20px !important;

            }

            .pagina-ideia .page-item.active .page-link {
                background-color: #8B0000 !important;
                border-color: #8B0000 !important;
            }

            .pagina-ideia .tituloAplicacao > * {
                padding-right: 0px !important;
            }
        </style>
    @endslot

    @slot('slot')
        <ul class="nav nav-tabs mt-3 container-botoes-pesquisa-resultado"
            id="container-botoes-pesquisa-resultado-0" style="display: none;">

        </ul>
        <ul class="nav nav-tabs mt-3 container-botoes-pesquisa-resultado"
            id="container-botoes-pesquisa-resultado-1" style="display: none;">
            <li class="nav-item waves-effect waves-light">
                <a class="tabelaDestaque vermelho-padrao-fonte" id="cw-botao-tudo-1" style=""
                   href="?cw_tabAtiva=1&amp;cw_ie_tp=1">Todos</a>
            </li>
        </ul>
        <div class="prodEncontradosOrd ">
            <div id="cw-container-total-resultado-plural" class="prodEncontrados vermelho-padrao-fonte" style="">
                <em><strong id="">{{ $produtos_all }}</strong> produtos encontrados</em>
            </div>
            <div id="cw-lista-vazia" class="prodEncontrados" _cw-server-rendered="1" style="display: none;">
                Nenhum item encontrado.
            </div>
        </div>
        <div id="cw-lista">
            @foreach($produtos as $produto)
                <a class="caixaProdutoHome">
                    <div class="cabecalhoCaixaProduto" style="background: #8B0000">
                        <div class="content-numeros">
                            <div id="cw-numero-produto" style="color: #FFFFFF">{{ $produto->codigo_interno }}
                                / {{ $produto->codigo_externo }}</div>
                        </div>
                    </div>
                    <div class="informacoesProdutoHome informacoesProdutoHome-resultado">
                        <h2 class="tituloProduto" id="cw-descricao-produto"
                            style="font-size: 18px">{{ $produto->nome }}</h2>
                        <div class="infosTecnicasHome">
                            <div>
                                <figure class="imagemHomeProduto">
                                    <img id="cw-arquivo-foto-produto" onerror=""
                                         src="{{ !empty($produto->image_url) && File::exists(public_path($produto->image_url)) ? asset($produto->image_url) : asset('/assets/images/default.jpg') }}"
                                         alt="{{ $produto->nome }}">
                                </figure>
                            </div>
                            <div class="tabelaHome tabelaHome-resultado"
                                 id="cw-container-fabricante-aplicacao-produto">
                                <div class="container-tabela-aplicacao-resultado">
                                    <table width="100%" border="0">
                                        <thead>
                                        <tr>
                                            <th class="titTabAplic" scope="col">
                                                <div>
                                                    ITEM
                                                </div>
                                            </th>
                                            <th class="titTabAplic" scope="col">
                                                <div id="cw-coluna-complementoaplicacao2" style="">
                                                    Código
                                                </div>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="tituloAplicacao">
                                                <strong>Marca:</strong> {{ $produto->marca_do_produto }}
                                            </td>
                                            <td class="tituloAplicacao">
                                                <strong>Cod. Interno:</strong> {{ $produto->codigo_interno }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="tituloAplicacao">
                                                <strong>Produto:</strong> {{ $produto->grupo }}
                                            </td>
                                            <td class="tituloAplicacao">
                                                <strong>Cod. Fabricante:</strong> {{ $produto->codigo_externo }}
                                            </td>
                                        </tr>
                                        <tr class="linha-aplicacao linha-aplicacao-resultado">
                                            <td class="tituloAplicacao">
                                                <strong>Linha do produto:</strong> {{ $produto->sub_grupo }}
                                            </td>
                                            <td class="tituloAplicacao">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="btDetalhes">
                                    <button onclick="pageDetalhes({{ $produto->id }})">Detalhes</button>
                                    <button style="margin-left: 5px" onclick="pageComprar()">Comprar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
            <div class="pr-4 pl-4 d-flex justify-content-center">
                @if ($produtos->hasPages())
                    <div class="d-flex justify-content-between">
                        {{ $produtos->links() }}
                    </div>
                @endif
            </div>
        </div>
    @endslot

    @slot('scripts')
        <script>

            function pageDetalhes($id) {
                window.location.href = "{{ route('index.detalhes', 'id_produto') }}".replace('id_produto', $id)
            }

            function pageComprar() {
                window.location.href = "{{ route('index.lojas') }}"
            }
        </script>
    @endslot
</x-index>
