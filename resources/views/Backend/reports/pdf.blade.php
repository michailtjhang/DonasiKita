<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-size: 12px;
        }

        td {
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            /* Ensures responsive layout */
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            word-wrap: break-word;
            /* Ensures long text wraps */
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>{{ $title }}</h2>
    <p>Date Range: {{ $range }}</p>
    <table>
        <thead>
            <tr>
                @foreach (array_keys($data->first()) as $column)
                    <th>{{ ucfirst($column) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    @foreach ($row as $value)
                        <td>{{ $value }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
