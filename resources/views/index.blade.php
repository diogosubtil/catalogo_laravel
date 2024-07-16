<x-index>
    @slot('stylesheet')
        <style>
            .pagina-ideia .page-link {
                padding: 5px .75rem;
            }
            .pagina-ideia .pagination li a {
                font-size: 15px;
            }
            .pagina-ideia .page-item.active .page-link {
                background-color: #8B0000;
                border-color: #8B0000;
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
                    <a class="tabelaDestaque vermelho-padrao-fonte" id="cw-botao-tudo-1" style="" href="?cw_tabAtiva=1&amp;cw_ie_tp=1">Todos</a>
                </li>
            </ul>
            <div class="prodEncontradosOrd ">
                <div id="cw-container-total-resultado-plural" class="prodEncontrados vermelho-padrao-fonte" style="">
                    <em><strong id="" >{{ $produtos_all }}</strong> produtos encontrados</em>
                </div>
                <div id="cw-container-total-resultado" class="prodEncontrados" style="display: none;">
                    <em><strong id="cw-total-resultado"></strong> produto encontrado</em>
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
                                <div id="cw-numero-produto" style="color: #FFFFFF">{{ $produto->codigo_interno }} / {{ $produto->codigo_externo }}</div>
                            </div>
                        </div>
                        <div class="informacoesProdutoHome informacoesProdutoHome-resultado">
                            <h2 class="tituloProduto" id="cw-descricao-produto" style="">{{ $produto->nome }}</h2>
                            <div class="infosTecnicasHome">
                                <div>
                                    <figure class="imagemHomeProduto">
                                        <img id="cw-arquivo-foto-produto" onerror=""
                                             src="{{ asset($produto->image_url) }}" alt="{{ $produto->nome }}">
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
                                                        VEÍCULO
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
                                                    <td class="tituloAplicacao" >
                                                        Marca: {{ $produto->marca }}
                                                    </td>
                                                    <td class="tituloAplicacao">
                                                        Cod. Interno {{ $produto->codigo_interno }}
                                                    </td>
                                                </tr>
                                                <tr class="linha-aplicacao linha-aplicacao-resultado">
                                                    <td class="tituloAplicacao">
                                                            Modelo: {{ $produto->veiculo }}
                                                    </td>
                                                    <td class="tituloAplicacao">
                                                        Cod. Externo {{ $produto->codigo_externo }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="btDetalhes">
                                        <button id="botao_detalhes">Detalhes</button>
                                        <button style="margin-left: 5px" id="botao_comprar">Comprar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
                <div class="pr-4 pl-4">
                    @if ($produtos->hasPages())
                        <div class="d-flex justify-content-between">
                            <div id="mostrarPaginas">
                                <p class="text-sm text-gray leading-5">
                                    Mostrando
                                    <span class="font-medium">{{ $produtos->firstItem() }}</span>
                                    até
                                    <span class="font-medium">{{ $produtos->lastItem() }}</span>
                                    de
                                    <span class="font-medium">{{ $produtos->total() }}</span>
                                    resultados
                                </p>
                            </div>
                            {{ $produtos->links() }}
                        </div>
                    @endif
                </div>
            </div>
    @endslot

    @slot('scripts')
        <script>
            let btn_detalhes = document.querySelector('#botao_detalhes')
            let btn_comprar = document.querySelector('#botao_comprar')

            btn_detalhes.addEventListener('click', function () {
                window.location.href = "{{ route('index.detalhes', $produto->id) }}"
            })

            btn_comprar.addEventListener('click', function () {
                window.location.href = "{{ route('index.lojas') }}"
            })
        </script>
    @endslot
</x-index>
