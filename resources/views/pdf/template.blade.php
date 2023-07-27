<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Конфигурация двери</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1>Конфигурация двери</h1>
<table>
    <tr>
        <th>Параметр</th>
        <th>Значение</th>
    </tr>
    <tr>
        <td>Цвет покраски</td>
        <td>{{ $door->paint_color }}</td>
    </tr>
    <tr>
        <td>Цвет плёнки</td>
        <td>{{ $door->film_color }}</td>
    </tr>
    <tr>
        <td>Цвет ручки</td>
        <td>{{ $door->handle_color }}</td>
    </tr>
    <tr>
        <td>Ширина</td>
        <td>{{ $door->width }} мм</td>
    </tr>
    <tr>
        <td>Высота</td>
        <td>{{ $door->height }} мм</td>
    </tr>
    <tr>
        <td>Открывание</td>
        <td>{{ $door->opening }}</td>
    </tr>
    <tr>
        <td>Аксессуары</td>
        <td>{{ implode(', ', $door->accessories) }} </td>
    </tr>
    <tr>
        <td>Итоговая стоимость</td>
        <td>{{ $door->total_price }}рублей</td>
    </tr>
</table>
<p><strong>Итоговая "дилерская" цена:</strong> {{ $door->total_price * 1.2}} рублей</p>
</body>
</html>'