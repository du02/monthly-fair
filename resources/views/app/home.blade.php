@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow-sm border">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <button
                            type="button"
                            class="btn btn-success shadow-sm btn-lg"
                            data-toggle="modal"
                            data-target="#Add">
                            <i class="fa-solid fa-cart-plus p-2"></i>
                            Novo Item
                        </button>
                        <a
                            href="{{ route('item.impress') }}"
                            target="_blank"
                            type="button"
                            class="btn btn-secondary mt-1 shadow-sm btn-lg"
                        >
                            <i class="fa-solid fa-print"></i>
                            Imprimir
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover border">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">
                                        <i class="fa-solid fa-box-open"></i>
                                        Item
                                    </th>
                                    <th scope="col">
                                        <i class="fa-solid fa-coins"></i>
                                        Preço
                                    </th>
                                    <th scope="col">
                                        <i class="fa-solid fa-box"></i>
                                        Unid.
                                    </th>
                                    <th scope="col">
                                        <i class="fa-solid fa-money-bill"></i>
                                        Valor
                                    </th>
                                    <th scope="col">
                                        <i class="fa-solid fa-barcode"></i>
                                        Código de Barra
                                    </th>
                                    <th scope="col" class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <th scope="row" class="text-center">{{ $item->id }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>R$ {{ number_format($item->price, 2, ',') }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>R$ {{ number_format(($item->amount * $item->price), 2, ',') }}</td>
                                        <td>{{ $item->barcode }}</td>
                                        <td class="text-center">
                                            <a
                                                href="{{ route('item.edit', $item->id) }}"
                                                class="btn btn-info btn-lg text-white p-3">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>

                                            <a href="{{ route('item.destroy', $item->id) }}"
                                               class="btn btn-danger btn-lg p-3">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Paginate -->
                        <div class="col-md-12 d-flex justify-content-center">
                            {{ $items->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow border">
                <div class="card-header p-4">
                    <i class="fa-solid fa-hand-holding-dollar"> Valor total</i>
                </div>
                <div class="card-body">
                    <h2>R$ {{ number_format($total_value, 2, ',') }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Modal Insert -->
<div class="modal fade" id="Add" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="TituloModalCentralizado">Adicionar Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('item.store') }}" method="POST">
                    @csrf
                    <input name="user_id" type="hidden" value="{{ auth()->id() }}">
                    <div class="form-row">
                        <div class="col-5">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa-solid fa-box-open"></i>
                                    </div>
                                </div>
                                    <input
                                        name="name"
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Nome do Item"
                                        required
                                        value="{{ old('name') }}"
                                    >
                                        @error('name')
                                            @php(toastr()->error($message))
                                        @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">R$</div>
                                </div>
                                    <input
                                        name="price"
                                        type="text"
                                        class="form-control @error('price') is-invalid @enderror"
                                        placeholder="Preço"
                                        value="{{ old('price') }}"
                                    >
                                        @error('price')
                                            @php(toastr()->error($message))
                                        @enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">U.</div>
                                </div>
                                    <input
                                        name="amount"
                                        type="number"
                                        class="form-control @error('amount') is-invalid @enderror"
                                        placeholder="Qtd"
                                        required
                                        value="{{ old('amount') }}"
                                    >
                                        @error('amount')
                                            @php(toastr()->error($message))
                                        @enderror
                            </div>
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
                                        value="{{ old('barcode') }}"
                                    >
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary mr-2 p-2" data-dismiss="modal">Fechar</button>
                        <button type="input" class="btn btn-success p-2">
                            Salvar
                            <i class="fa-solid fa-floppy-disk"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


