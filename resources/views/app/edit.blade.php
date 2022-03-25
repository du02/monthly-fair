@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mt-2">Editar Produto</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('item.update', $item->id) }}" method="POST">
                        @csrf
                        <input name="user_id" type="hidden" value="{{ auth()->id() }}">
                        <div class="form-row">
                            <div class="col-6">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Nome</div>
                                    </div>
                                    <input
                                        name="name"
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Nome do Item"
                                        value="{{ $item->name }}"
                                        required
                                    >
                                </div>
                                @error('name')
                                    @php(toastr()->error($message))
                                @enderror
                            </div>
                            <div class="col-3">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">R$</div>
                                    </div>
                                    <input
                                        name="price"
                                        type="text"
                                        class="form-control @error('price') is-invalid @enderror"
                                        placeholder="Preço"
                                        value="{{ number_format($item->price, 2, ',') }}"
                                    >
                                </div>
                                @error('price')
                                    @php(toastr()->error($message))
                                @enderror
                            </div>
                            <div class="col-3">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Unid.</div>
                                    </div>
                                        <input
                                            name="amount"
                                            type="number"
                                            class="form-control @error('amount') is-invalid @enderror"
                                            placeholder="Quant."
                                            required
                                            value="{{ $item->amount }}"
                                        >
                                </div>
                                @error('amount')
                                    @php(toastr()->error($message))
                                @enderror
                            </div>
                            <div class="col-12 mt-2">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa-solid fa-barcode"></i>
                                        </div>
                                    </div>
                                        <input
                                            name="barcode"
                                            type="text"
                                            class="form-control"
                                            placeholder="Código de Barra"
                                            value="{{ $item->barcode }}"
                                        >
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('home') }}" class="btn btn-secondary p-2 btn-lg" data-dismiss="modal">
                                <i class="fa-solid fa-arrow-left-long"></i>
                                Voltar
                            </a>
                            <div>
                                <a href="{{ route('home') }}" class="btn btn-danger mr-2 p-2 btn-lg" data-dismiss="modal">
                                    Cancelar
                                    <i class="fa-solid fa-ban"></i>
                                </a>
                                <button type="input" class="btn btn-success text-white p-2 btn-lg">
                                    Salvar
                                    <i class="fa-solid fa-floppy-disk"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
