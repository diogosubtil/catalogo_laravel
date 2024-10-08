<x-index>
    @slot('stylesheet')
        <style>
            #image-produto-grande {
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

            #image_grande_produto {
                max-width: 50rem;
                max-height: none;
                cursor: -webkit-zoom-out;
                transition: -webkit-transform 0.4s cubic-bezier(0.4, 0, 0, 1) 0s;
            }
            .pagina-ideia .tituloAplicacao > * {
                padding-right: 0px!important;
            }
        </style>
    @endslot

    @slot('slot')
        <div class="col-lg-12" style="">
            <div id="image-produto-grande">
                <div class="image-container">
                    <img id="image_grande_produto" src="{{ asset($produto->image_url) }}" alt="LANTERNA CENTRAL LD">
                </div>
            </div>
            <ol class="caminhoDePao">
            </ol>
            <div class="caixaProdutoHome">
                <div class="cabecalhoCaixaProduto" style="background: #8B0000">
                    <div class="content-numeros">
                        <div style="color: #FFFFFF">{{ $produto->marca_do_produto }} / {{ $produto->codigo_externo }}</div>
                    </div>
                </div>
                <div class="informacoesProdutoHome informacoesProdutoHome-resultado">
                    <h2 class="tituloProduto" id="cw-descricao-produto" style="font-size: 18px">{{ $produto->nome }}</h2>
                    <div class="infosTecnicasHome">
                        <div id="imagemPequena">
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
                                            <div>
                                                PRODUTO
                                            </div>
                                        </th>
                                        <th class="titTabAplic" scope="col">
                                            <div id="cw-coluna-complementoaplicacao2" style="">
                                                CÓDIGOS
                                            </div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="tituloAplicacao" >
                                            <strong></strong> {{ $produto->marca }}
                                        </td>
                                        <td class="tituloAplicacao">
                                            <strong>Cod. Interno:</strong> {{ $produto->codigo_interno }}
                                        </td>
                                    </tr>
                                    <tr >
                                        <td class="tituloAplicacao">
                                            <strong></strong> {{ $produto->grupo }}
                                        </td>
                                        <td class="tituloAplicacao">
                                            <strong>Cod. Fabricante:</strong> {{ $produto->codigo_externo }}
                                        </td>
                                    </tr>
                                    <tr class="linha-aplicacao linha-aplicacao-resultado">
                                        <td class="tituloAplicacao">
                                            <strong></strong> {{ $produto->sub_grupo }}
                                        </td>
                                        <td class="tituloAplicacao">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="btDetalhes">
                                <button style="margin-left: 5px" onclick="pageComprar()">Comprar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="container-aplicacao" style="">
                <div class="cabecalhoCaixaAplicacao" style="background: #8B0000">
                    <div class="content-numeros">
                        <div class="">Descrição</div>
                    </div>
                </div>
                <div class="informacoesProdutoHome container-scroll mb-2">
                    <span>
                        {{ $produto->descricao }}
                    </span>
                </div>
            </div>
        </div>
    @endslot

    @slot('scripts')
        <script>
            function pageComprar() {
                window.location.href = "{{ route('index.lojas') }}"
            }

            var img = document.getElementById("imagemPequena");
            var imgGrande = document.getElementById("image_grande_produto");
            var imgDivGrande = document.getElementById("image-produto-grande");

            // Adiciona o evento de clique na imagem pequena
            img.onclick = function () {
                if (window.innerWidth >= 768){
                    imgDivGrande.style.display = 'flex';
                }
            }

            imgGrande.onclick = function () {
                if (window.innerWidth >= 768) {
                    $('#image-produto-grande').hide();
                }
            }

            imgDivGrande.onclick = function () {
                if (window.innerWidth >= 768) {
                    $('#image-produto-grande').hide();
                }
            }

            let btn_comprar = document.querySelector('#botao_comprar')
            btn_comprar.addEventListener('click', function () {
                window.location.href = "{{ route('index.lojas') }}"
            })
        </script>
    @endslot
</x-index>
