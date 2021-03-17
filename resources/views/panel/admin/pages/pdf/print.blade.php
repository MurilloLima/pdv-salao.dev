<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$ticket->token}}</title>
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
        .header h4, p {
            text-align: left;
            padding: 2px;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <h4>Cliente: {{$ticket->cliente->name}}</h4>
        <p>Ticket: {{$ticket->token}}</p>
        <p>Data:{{date('d/m/Y H:i:s', strtotime($ticket->created_at))}}</p>
    </div>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Serviços</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->servico}}</td>
                <td>R$ {{$item->valor}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-right">
                    <h4><strong>Total: R$ {{number_format($total, 2, ',', '.')}}</strong></h4>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>