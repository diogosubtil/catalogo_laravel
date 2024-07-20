<x-app>
    @slot('stylesheet')
        <!-- STYLES -->
    @endslot

    @slot('slot')
        <div class="row g-5 g-xl-8">
            <div class="col-xl-12">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Marcas</h1>
                    </div>
                </div>
            </div>
            @if (session('success'))
                <p>{{ session('success') }}</p>
            @endif
            @if (session('error'))
                <p>{{ session('error') }}</p>
            @endif
            <div class="col-xl-4 col-md-6 col-12">
                <div class="card">
                    <div class="card h-100 ">
                        <div class="card-header flex-nowrap border-0 pt-9">
                            <div class="card-title m-0">
                                <div class="symbol symbol-45px w-45px bg-light me-5 d-flex justify-content-center">
                                    <i style="font-size: 25px" class="fa fa-truck p-3"></i>
                                </div>
                                <span class="fs-4 fw-semibold text-gray-600 m-0">
                                        Total
                                </span>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column px-9 pt-6 pb-8">
                            <div class="fs-2tx fw-bold mb-3">
                                {{ $marcas_all }}
                            </div>
                            <div class="d-flex align-items-center flex-wrap mb-5 mt-auto fs-6">
                                <i class="ki-duotone ki-Up-right fs-3 me-1 text-danger"></i>
                                <div class="fw-semibold text-gray-400">
                                    Total de marcas
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-md-6 col-12">
                <div class="card">
                    <div class="card h-100 ">
                        <div class="card-header flex-nowrap border-0 pt-9">
                            <div class="card-title m-0">
                                <div class="symbol symbol-45px w-45px bg-light me-5 d-flex justify-content-center">
                                    <i style="font-size: 25px" class="fa fa-truck p-3"></i>
                                </div>
                                <span class="fs-4 fw-semibold text-gray-600 m-0">
                                        Cadastrar
                                </span>
                            </div>
                        </div>
                        <form action="{{ route('marcas.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="" id="nome" name="nome" placeholder="Nome" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary" style="margin-top: 10px;float: right">Cadastrar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal_editar" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                        </div>
                        <form method="POST" id="form_editar" action="">
                            @method('PUT')
                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="col-xl-12 col-md-12 col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="" id="nome_editar" name="nome" placeholder="Nome" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="$('#modal_editar').modal('hide');" class="btn btn-danger">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                                        data-kt-menu-placement="bottom-end">
                                    Filtros
                                </button>
                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                    </div>
                                    <div class="separator border-gray-200"></div>
                                    <form action="{{ route('marcas.index') }}" method="GET" class="px-7 py-5" data-kt-user-table-filter="form">
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">Nome:</label>
                                            <input type="text" class="form-control" id="nome"
                                                   name="nome" placeholder="Nome" value="{{ !empty($_GET['nome']) ? $_GET['nome'] : '' }}">
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <a href="{{ route('marcas.index') }}">
                                                <button type="button"
                                                        class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                                                        data-kt-menu-dismiss="true" data-kt-user-table-filter="reset">Limpar
                                                </button>
                                            </a>

                                            <button type="submit" class="btn btn-primary fw-semibold px-6"
                                                    data-kt-menu-dismiss="true" data-kt-user-table-filter="filter">Aplicar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end align-items-center d-none"
                                 data-kt-user-table-toolbar="selected">
                                <div class="fw-bold me-5">
                                    <span class="me-2" data-kt-user-table-select="selected_count"></span>
                                    Selected
                                </div>
                                <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">
                                    Delete Selected
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <div id="kt_ecommerce_products_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                    <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-1px pe-0"></th>
                                        <th class="w-10px pe-2">
                                            #ID
                                        </th>
                                        <th class="min-w-300px">Nome</th>
                                        <th class="w-200px pe-2">Data de Cadastro</th>
                                        <th class="text-center min-w-50px">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-gray-600 fw-semibold">
                                    @foreach ($marcas as $marca)
                                        <tr>
                                            <td></td>
                                            <td>#{{ $marca->id }}</td>
                                            <td>{{ $marca->nome }}</td>
                                            <td>{{ date('d/m/Y H:i', strtotime($marca->created_at)) }}</td>
                                            <td class="text-center">
                                                <a href="#"
                                                   class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                                   data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    Ações
                                                    <i class="fa fa-chevron-down fs-6 ms-2"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                     data-kt-menu="true">
                                                    <div class="menu-item px-3">
                                                        <a href="#"
                                                           class="menu-link px-3" id="editar_modal" onclick="editarModal({{ $marca->id }}, `{{ $marca->nome }}`)">
                                                            Editar
                                                        </a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <form id="form-delete" action="{{ route('marcas.destroy', $marca->id) }}" method="post" class="menu-link px-3">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn-nostyles">
                                                                Excluir
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pr-4 pl-4">
                @if ($marcas->hasPages())
                    <div class="d-flex justify-content-between">
                        <div id="mostrarPaginas">
                            <p class="text-sm text-gray leading-5">
                                Mostrando
                                <span class="font-medium">{{ $marcas->firstItem() }}</span>
                                até
                                <span class="font-medium">{{ $marcas->lastItem() }}</span>
                                de
                                <span class="font-medium">{{ $marcas->total() }}</span>
                                resultados
                            </p>
                        </div>
                        {{ $marcas->links() }}
                    </div>
                @endif
            </div>
        </div>
    @endslot

    @slot('scripts')
        <script>
            function editarModal(id, nome){
                let action = "{{ route('marcas.update', 'id_marca') }}".replace('id_marca', id)
                $('#modal_editar').modal('show')
                $('#form_editar').attr('action', action)
                $('#nome_editar').val(nome)
            }
        </script>
    @endslot
</x-app>
