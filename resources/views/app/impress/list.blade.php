<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>
    <style>
        * {
            font-family: "Inconsolata", "Fira Mono", "Source Code Pro", Monaco, Consolas, "Lucida Console", monospace;
        }
        .h2 {
            display: flex;
            justify-content: center;
        }
        .table {
            width: 100%;
            border-top: 1px solid #eee;
            border-right: 1px solid #eee;
            border-left: 1px solid #eee;
        }
        thead {
            height: 50px;
            background-color: #eee;
        }
        td {
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .text-center {
            text-align: center;
        }
        .container-value {
            display: flex;
            justify-content: end;
        }
        .value {
            background-color: #eee;
            padding: 20px;
            margin-top: 10px;
        }
    </style>

    <body>
        <div>
            <p style="text-align: right">Educ Infinity - Fair | {{ date("d.m.Y") }}</p>
            <h2 class="h2">Lista Mensal/Semanal</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col">
                            Item
                        </th>
                        <th scope="col">
                            Preço
                        </th>
                        <th scope="col">
                            Unid.
                        </th>
                        <th scope="col">
                            Valor
                        </th>
                        <th scope="col">
                            Código de Barra
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td class="text-center">R$ {{ number_format($item->price, 2, ',') }}</td>
                            <td class="text-center">{{ $item->amount }}</td>
                            <td class="text-center">R$ {{ number_format(($item->amount * $item->price), 2, ',') }}</td>
                            <td class="text-center">{{ $item->barcode }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="container-value">
            <div class="value">
                Valor Total: <b>R$ {{ number_format($total_value, 2, ',') }}</b>
            </div>
        </div>
    </body>
</html>
