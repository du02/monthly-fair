@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12 d-flex justify-content-center">
            <div class="col-md-6 col-sm-12">
                <div class="card shadow-sm mt-4">
                    <div class="card-header">
                        <h4 class="card-title mt-2">Editar dados</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.update', auth()->id()) }}" method="POST" class="form-group">
                            @csrf
                            <input name="user_id" type="hidden" value="{{ auth()->id() }}">

                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                </div>
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                                    id="inlineFormInputGroup"
                                    placeholder="Usuário"
                                    value="{{ $user->name }}"
                                >
                                @error('name')
                                    @php(toastr()->error($message))
                                @enderror
                            </div>

                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                </div>
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    id="inlineFormInputGroup"
                                    placeholder="E-mail"
                                    required
                                    value="{{ $user->email }}"
                                >
                                @error('email')
                                    @php(toastr()->error($message))
                                @enderror
                            </div>

                            <i class="text-info">Para salvar as novas auterações, digite a senha*</i>
                               <div class="input-group mb-3">
                                   <div class="input-group-prepend">
                                       <div class="input-group-text">
                                           <i class="fa-solid fa-key"></i>
                                       </div>
                                   </div>
                                   <input
                                       type="password"
                                       name="password"
                                       class="form-control form-control-lg @error('password') is-invalid @enderror"
                                       id="inlineFormInputGroup"
                                       placeholder="Senha"
                                       required
                                       value=""
                                   >
                               </div>
                               @error('password')
                                @php(toastr()->error($message))
                               @enderror

                               <div class="d-flex justify-content-between">
                                   <a href="{{ route('home') }}" type="submit" class="btn btn-secondary btn-lg">Voltar</a>

                                   <div>
                                       <a href="{{ route('home') }}" type="submit" class="btn btn-danger btn-lg">Cancelar</a>
                                       <button type="submit" class="btn btn-success btn-lg">Enviar</button>
                                   </div>
                               </div>
                           </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
