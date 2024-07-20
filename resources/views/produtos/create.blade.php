<x-app>
    @slot('stylesheet')
        <!-- STYLES -->
    @endslot

    @slot('slot')
        <div class="row g-5 g-xl-8">
            <div class="col-xl-12">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Cadastrar Produto</h1>
                    </div>
                </div>
            </div>

            <div class="col-xl-12">
                <div class="row">
                    <div class="col">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Cadastrar as informações</h3>
                            </div>
                            <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="name" class="mb-3 required">Nome</label>
                                                <input type="text" class="form-control" value="" id="nome" name="nome" placeholder="Nome" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="name" class="mb-3 required">Descrição</label>
                                                <textarea type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="name" class="mb-3 required">Código Interno</label>
                                                <input type="text" class="form-control" value="" id="codigo_interno" name="codigo_interno" placeholder="Código interno" required>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="name" class="mb-3 required">Código Externo</label>
                                                <input type="text" class="form-control" value="" id="codigo_externo" name="codigo_externo" placeholder="Código externo" required>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <label for="visivel" class="form-label fs-6 fw-bold mb-3 required">Visivel</label>
                                            <select name="visivel" class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                                    data-placeholder="Selecione" data-allow-clear="true"
                                                    data-kt-user-table-filter="role" data-hide-search="true" required>
                                                <option value="sim">Sim</option>
                                                <option value="nao">Não</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <label for="marca" class="form-label fs-6 fw-bold mb-3 required">Marca</label>
                                            <select name="marca" class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                                    data-placeholder="Selecione" data-allow-clear="true"
                                                    data-kt-user-table-filter="role" data-hide-search="true" required>
                                                <option value="">Selecione</option>
                                                @foreach($marcas as $marca)
                                                    <option value="{{ $marca->nome }}">{{ $marca->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <label for="grupo" class="form-label fs-6 fw-bold mb-3 required">Grupo</label>
                                            <select name="grupo" class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                                    data-placeholder="Selecione" data-allow-clear="true"
                                                    data-kt-user-table-filter="role" data-hide-search="true" required>
                                                <option value="">Selecione</option>
                                                @foreach($grupos as $grupo)
                                                    <option value="{{ $grupo->nome }}">{{ $grupo->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <label for="sub_grupo" class="form-label fs-6 fw-bold mb-3 required">SubGrupo</label>
                                            <select name="sub_grupo" class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                                    data-placeholder="Selecione" data-allow-clear="true"
                                                    data-kt-user-table-filter="role" data-hide-search="true" required>
                                                <option value="">Selecione</option>
                                                @foreach($sub_grupos as $sub_grupo)
                                                    <option value="{{ $sub_grupo->nome }}">{{ $sub_grupo->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="name">Imagem do produto</label>
                                                <input type="file" class="col-12" name="image_url" id="image_url">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                    <a href="{{ route('produtos.index') }}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endslot

    @slot('scripts')
        <!-- SCRIPTS -->
    @endslot
</x-app>
