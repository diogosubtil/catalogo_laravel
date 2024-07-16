<x-app>
    @slot('stylesheet')
        <!-- STYLES -->
    @endslot

    @slot('slot')
        <div class="row g-5 g-xl-8">
            <!--begin::Col-->
            <div class="col-xl-4">
                <!--begin::Misc Widget 1-->
                <div class="row mb-5 mb-xl-8 g-5 g-xl-8">
                    <!--begin::Col-->
                </div>
                <!--end::Misc Widget 1-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-12 ps-xl-12">
                <div class="row g-5 g-xl-8">
                    <div class="card card-xl-stretch mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0">
                            <h3 class="card-title fw-bold text-dark">Últimos Produtos</h3>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-2">

                            @foreach ($produtos as $produto)
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Bullet-->
                                    <span class="bullet bullet-vertical h-40px bg-primary"></span>
                                    <!--end::Bullet-->
                                    <!--begin::Description-->
                                    <div class="flex-grow-1 mx-5">
                                        <a href="{{ route('produtos.edit', $produto->id) }}" class="text-gray-800 text-hover-primary fw-bold fs-6"
                                           data-bs-toggle="tooltip" data-bs-placement="bottom"
                                           title="Nome do produto">{{ $produto->nome }}</a>
                                        <span class="text-muted fw-semibold d-block">{{ $produto->descricao }}</span>
                                    </div>
                                    <!--end::Description-->
                                    <span class="badge badge-light-primary fs-8 fw-bold">Novo</span>
                                </div>
                                <!--end:Item-->
                            @endforeach

                        </div>
                        <!--end::Body-->
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Col-->
        </div>
    @endslot

    @slot('scripts')
        <!-- SCRIPTS -->
    @endslot
</x-app>
