
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card w-50">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->has('error'))
                    <div class="alert alert-danger">
                        {{ $errors->first('error') }}
                    </div>
                @endif

                <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-login-tab" data-bs-toggle="pill" data-bs-target="#pills-login" type="button" role="tab" aria-controls="pills-login" aria-selected="true">Entrar</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-register-tab" data-bs-toggle="pill" data-bs-target="#pills-register" type="button" role="tab" aria-controls="pills-register" aria-selected="false">Registrar-se</button>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
                        <form action="{{ route('login.entrar') }}" method="POST">
                            @csrf
                            <div class="text-center mb-3">
                                <p>Entrar com:</p>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-facebook-f"></i>
                                </button>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-google"></i>
                                </button>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-twitter"></i>
                                </button>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-github"></i>
                                </button>
                            </div>

                            <p class="text-center">ou:</p>

                            <div class="mb-4">
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email" required/>
                            </div>

                            <div class="mb-4">
                                <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required/>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-4">Entrar</button>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab">
                        <form action="{{ route('usuario.store') }}" method="POST">
                            @csrf
                            <div class="text-center mb-3">
                                <p>Registrar-se com:</p>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-facebook-f"></i>
                                </button>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-google"></i>
                                </button>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-twitter"></i>
                                </button>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-github"></i>
                                </button>
                            </div>

                            <p class="text-center">ou:</p>

                            <div class="mb-3">
                                <select name="id_tipo" id="id_tipo" class="form-select" required>
                                    <option value="">Tipo de Usuário</option>
                                    <option value="0">Cliente</option>
                                    <option value="1">Advogado</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <input type="text" name="nome" id="registerName" class="form-control" placeholder="Nome" required/>
                            </div>

                            <div class="mb-3">
                                <input type="email" name="email" id="registerEmail" class="form-control" placeholder="Email" required/>
                            </div>

                            <div class="mb-3">
                                <input type="password" name="senha" id="registerPassword" class="form-control" placeholder="Senha" required/>
                            </div>

                            <div class="mb-3">
                                <input type="password" name="senha_confirmation" id="registerRepeatPassword" class="form-control" placeholder="Repetir senha" required/>
                            </div>

                            <div class="mb-3">
                                <input type="text" name="endereco" id="registerAddress" class="form-control" placeholder="Endereço" required/>
                            </div>

                            <div class="mb-3">
                                <input type="text" name="telefone" id="registerPhone" class="form-control" placeholder="Telefone" required/>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3">Registrar-se</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
