<x-guest>
    <div class="d-flex flex-center w-lg-50 p-10">
        <div class="card rounded-3 w-md-550px">
            <div class="card-body p-10 p-lg-20">
                <form method="POST" class="form w-100" id="kt_sign_in_form" action="{{ route('login') }}">
                    @csrf
                    <div class="text-center mb-11">
                        <h1 class="text-dark fw-bolder mb-3">Entrar</h1>
                        <div class="text-gray-500 fw-semibold fs-6">Seu painel de controle</div>
                    </div>
                    @if (Session::has('message'))
                        <div class="alert alert-danger">{{ Session::get('message') }}</div>
                    @endif
                    @if (Session::has('status'))
                        <div class="alert alert-warning">{{ Session::get('status') }}</div>
                    @endif
                    @if ($errors->get('email') || $errors->get('password'))
                        <div class="alert alert-danger">
                            @foreach ((array) $errors->get('email') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                            @foreach ((array) $errors->get('password') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </div>
                    @endif
                    <div class="fv-row mb-8">
                        <input type="text" placeholder="E-mail" name="email"  class="form-control bg-transparent" />

                    </div>
                    <div class="fv-row mb-3">
                        <input type="password" placeholder="Senha" name="password" autocomplete="off" class="form-control bg-transparent" />

                    </div>
                    <div class="d-grid mb-10">
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                            <span class="indicator-label">Entrar</span>
                            <span class="indicator-progress">Aguarde...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-guest>
