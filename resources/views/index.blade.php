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

            .image-produto-grande {
                display: none;
                background: rgba(0, 0, 0, 0.5);
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 99998;
                justify-content: center;
                align-items: center;
            }

            .image-container {
                z-index: 99999;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .image_grande_produto {
                max-width: 50rem;
                max-height: none;
                cursor: -webkit-zoom-out;
                transition: -webkit-transform 0.4s cubic-bezier(0.4, 0, 0, 1) 0s;
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
                <div id="image-produto-grande{{ $produto->id }}" class="image-produto-grande">
                    <div class="image-container">
                        <img class="image_grande_produto" id="image_grande_produto{{ $produto->id }}" src="{{ asset($produto->image_url) }}" alt="LANTERNA CENTRAL LD">
                    </div>
                </div>
                <a class="caixaProdutoHome">
                    <div class="cabecalhoCaixaProduto" style="background: #8B0000">
                        <div class="content-numeros">
                            <div id="cw-numero-produto" style="color: #FFFFFF">{{ $produto->marca_do_produto }}
                                / {{ $produto->codigo_externo }}</div>
                        </div>
                        <div class="containerFlags containerFlags-resultado" style="color: #8B0000!important;">
                            {{ $produto->codigo_interno }}
                        </div>
                    </div>
                    <div class="informacoesProdutoHome informacoesProdutoHome-resultado">
                        <h2 class="tituloProduto" id="cw-descricao-produto"
                            style="font-size: 18px">{{ $produto->nome }}</h2>
                        <div class="infosTecnicasHome">
                            <div id="imagemPequena{{ $produto->id }}">
                                <figure class="imagemHomeProduto imagemHomeProduto-detalhes">
                                    <img
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
                                                    PRODUTO
                                            </th>
                                            <th class="titTabAplic" scope="col">
                                                    CÓDIGOS
                                            </th>
                                            <th class="titTabAplic" scope="col">
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr style="max-width: 100px!important;">
                                            <td class="tituloAplicacao"  style="width: 230px!important;">
                                                {{ $produto->marca }}
                                            </td>
                                            <td class="tituloAplicacao" style="width: 150px!important;">
                                                {{ $produto->codigo_de_pesquisa_1 }}
                                            </td>
                                            <td class="tituloAplicacao">
                                                {{ $produto->codigo_de_pesquisa_4 }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="tituloAplicacao">
                                                {{ $produto->grupo }}
                                            </td>
                                            <td class="tituloAplicacao">
                                                {{ $produto->codigo_de_pesquisa_2 }}
                                            </td>
                                            <td class="tituloAplicacao">
                                                {{ $produto->codigo_de_pesquisa_5 }}
                                            </td>
                                        </tr>
                                        <tr class="linha-aplicacao linha-aplicacao-resultado">
                                            <td class="tituloAplicacao">
                                               {{ $produto->sub_grupo }}
                                            </td>
                                            <td class="tituloAplicacao">
                                                {{ $produto->codigo_de_pesquisa_3 }}
                                            </td>
                                            <td class="tituloAplicacao">
                                                {{ $produto->codigo_de_pesquisa_6 }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="btDetalhes">
{{--                                    <button onclick="pageDetalhes({{ $produto->id }})">Detalhes</button>--}}
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


            @foreach($produtos as $produto)
                var img{{ $produto->id }} = document.getElementById("imagemPequena{{ $produto->id }}");
                var imgGrande{{ $produto->id }} = document.getElementById("image_grande_produto{{ $produto->id }}");
                var imgDivGrande{{ $produto->id }} = document.getElementById("image-produto-grande{{ $produto->id }}");

                // Adiciona o evento de clique na imagem pequena
                img{{ $produto->id }}.onclick = function () {
                    if (window.innerWidth >= 768){
                        imgDivGrande{{ $produto->id }}.style.display = 'flex';
                    }
                }

                imgGrande{{ $produto->id }}.onclick = function () {
                    if (window.innerWidth >= 768) {
                        $('#image-produto-grande{{ $produto->id }}').hide();
                    }
                }

                imgDivGrande{{ $produto->id }}.onclick = function () {
                    if (window.innerWidth >= 768) {
                        $('#image-produto-grande{{ $produto->id }}').hide();
                    }
                }
            @endforeach
        </script>
    @endslot
</x-index>
