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
                        <div style="color: #FFFFFF">{{ $produto->codigo_interno }} / {{ $produto->codigo_externo }}</div>
                    </div>
                </div>
                <div class="informacoesProdutoHome informacoesProdutoHome-detalhes">
                    <h2 class="tituloProduto" style="">{{ $produto->nome }}</h2>
                    <div class="infosTecnicasHome">
                        <div id="imagemPequena">
                            <figure class="imagemHomeProduto imagemHomeProduto-detalhes">
                                <img  src="{{ asset($produto->image_url) }}"
                                     alt="{{ $produto->nome }}">
                            </figure>
                        </div>

                        <div class="container-dados-tecnicos-e-btn">
                            <div class="tabelaHome">
                                <h3 class="tituloDados" id="titulo-dados-tecnicos">DADOS
                                    TÉCNICOS</h3>
                                <div class="infos cw-esconde-coluna cw-sem-conteudo">
                                    <strong>Linha do produto: </strong>
                                    <span class="cw-esconde-coluna">{{ $produto->linha_do_produto }}</span>
                                </div>
                                <div class="infos cw-esconde-coluna cw-sem-conteudo">
                                    <strong>Marca: </strong>
                                    <span class="cw-esconde-coluna">{{ $produto->marca }}</span>
                                </div>
                                <div class="infos cw-esconde-coluna cw-sem-conteudo">
                                    <strong>Veiculo: </strong>
                                    <span class="cw-esconde-coluna">{{ $produto->veiculo }}</span>
                                </div>
                                <div class="infos cw-esconde-coluna cw-sem-conteudo">
                                    <strong>Cod. Interno: </strong>
                                    <span class="cw-esconde-coluna">{{ $produto->codigo_interno }}</span>
                                </div>
                                <div class="infos cw-esconde-coluna cw-sem-conteudo">
                                    <strong>Cod. Externo: </strong>
                                    <span class="cw-esconde-coluna">{{ $produto->codigo_externo }}</span>
                                </div>
                            </div>

                            <div class="btDetalhes">
                                <button style="margin-left: 5px" id="botao_comprar">Comprar</button>
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
