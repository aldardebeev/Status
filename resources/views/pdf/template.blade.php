<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Конфигурация двери</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
    </style>
</head>
<body>
<h1>Конфигурация двери</h1>
<p><strong>Цвет покраски:</strong> {{ $door->paint_color }}</p>
<p><strong>Цвет плёнки:</strong> {{ $door->film_color }}</p>
<p><strong>Цвет ручки:</strong> {{ $door->handle_color }}</p>
<p><strong>Ширина:</strong> {{ $door->width }} мм</p>
<p><strong>Высота:</strong> {{ $door->height }} мм</p>
<p><strong>Открывание:</strong> {{ $door->opening }}</p>
<p><strong>Аксессуары:</strong> {{ implode(', ', $door->accessories) }}</p>
<p><strong>Итоговая стоимость:</strong> {{ $door->total_price }} рублей</p>

<img src="../images/default_door.jpg">

</body>
</html>
