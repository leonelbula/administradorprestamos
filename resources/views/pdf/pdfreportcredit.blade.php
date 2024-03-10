<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte</title>
    <style>
        header {
            text-align: center
        }

        header h2 {
            color: #1F1B1B;
        }

        hr {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            caption-side: bottom;
        }

        table th {
            background-color: yellow;
        }

        table td {
            padding: 5px;
        }

        table tr:nth-child(odd) {
            background-color: #F2E6E4;
        }

        table tr:nth-child(even) {
            background-color: white;
        }

        .d {
            background-color: #B6FA97
        }

        .m {
            background-color: #FA2929;
        }
    </style>
</head>

<body>
    <header>
        <h2>Lista de prestamos vigentes</h2>
    </header>
    <hr>
    <section>
        <table>
            <tr>
                <th>Codigo</th>
                <th>Nombre del cliente</th>
                <th>Fecha</th>
                <th>Valor</th>
                <th>Saldo</th>
                <th>estado</th>
            </tr>
            @foreach ($data as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->customer->fullname }}</td>
                    <td>{{ $value->date }}</td>
                    <td>{{ $value->amount }}</td>
                    <td>{{ $value->balance }}</td>
                    @if (strtotime(date('Y-m-d', time())) > strtotime($value->expiration_date))
                        <td class="d">
                            <span>Al dia</span>
                        </td>
                    @else
                        <td class="m">
                            <span>Vencido</span>
                        </td>
                    @endif
                </tr>
            @endforeach

        </table>
    </section>
</body>

</html>
