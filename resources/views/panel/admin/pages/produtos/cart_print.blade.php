<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Imprimir venda: {{$uid->uid}}</title>
    <style>
        * {
            color: black;
            background: white;
            font-family: 'Courier New', Courier, monospace;
        }

        table {
            font-size: 80%;
        }

        table,
        th,
        td {
            border: 0px;
            width: 100%;
            text-align: right;
        }

        .header {
            text-align: left;
        }

        .header h4,
        p {
            text-align: left;
            padding: 2px;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <h4>Venda de produtos</h4>
        <p>UID: {{$uid->uid}}</p>
        <p>Data:{{date('d/m/Y H:i:s', strtotime($uid->created_at))}}</p>
    </div>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Qtd</th>
                <th>Valor</th>
                <th>Desconto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->product->name}}</td>
                <td>{{$item->qtd}}</td>
                <td>R$ {{$item->valor}}</td>
                <td>R$ {{$item->desc}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="5" class="text-right">
                    <h4><strong>Total: R$ {{number_format($total, 2, ',', '.')}}</strong></h4>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>