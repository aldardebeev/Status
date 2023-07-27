<!DOCTYPE html>
<html>
<head>
    <title>Конфигуратор двери</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <form action="{{ route('doorStore') }}" method="POST" id="create_door_form">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="door-visual">
                    <!-- Визуальное представление двери здесь -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="options">
                    <h2>Выберите параметры:</h2>
                    <div class="form-group">
                        <label for="paint_color">Цвет покраски:</label>
                        <select id="paint_color" name="paint_color" class="form-control">
                            <option value="red">Красный</option>
                            <option value="blue">Синий</option>
                            <option value="green">Зеленый</option>
                            <option value="yellow">Желтый</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="film_color">Цвет плёнки:</label>
                        <select id="film_color" name="film_color" class="form-control">
                            <option value="silver">Серебряный</option>
                            <option value="gold">Золотой</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="handle_color">Цвет ручки:</label>
                        <select id="handle_color" name="handle_color" class="form-control">
                            <option value="bronze">Бронзовый</option>
                            <option value="chrome">Хром</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="width">Ширина:</label>
                        <input type="number" id="width" name="width" class="form-control" min="50" max="120" step="1" value="80">
                    </div>
                    <div class="form-group">
                        <label for="height">Высота:</label>
                        <input type="number" id="height" name="height" class="form-control" min="150" max="220" step="1" value="200">
                    </div>
                    <div class="form-group">
                        <label>Открывание:</label>
                        <div class="form-check">
                            <input type="radio" name="opening" value="left" class="form-check-input">
                            <label class="form-check-label">Слева</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="opening" value="right" class="form-check-input">
                            <label class="form-check-label">Справа</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Аксессуары:</label>
                        <div class="form-check">
                            <input type="checkbox" name="accessories[]" value="handle" class="form-check-input">
                            <label class="form-check-label">Ручка</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="accessories[]" value="peephole" class="form-check-input">
                            <label class="form-check-label">Глазок</label>
                        </div>
                    </div>
                    <div class="total-price">
                        <h2>Итоговая стоимость: <span id="price">0</span> рублей</h2>
                    </div>
                    <button id="send" type="send" class="btn btn-lg btn-primary">
                        Создать пасту
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Подключение скрипта -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Обработчик кнопки "Отправить комплектацию"
        document.getElementById("send").addEventListener("click", function () {
            // Получение всех выбранных параметров
            // let paintColor = document.getElementById("paintColor").value;
            var fromData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "/door-store",
                data: {
                    'fromData' : fromData,
                    "_token": "{{ csrf_token() }}",
                },

                dataType: "json",
                success: function (paintColor) {
                    console.log(paintColor)
                },
                error: function (error) {
                    console.error(error); // выведет объект ошибки в консоль
                }
            });


        });
    });
</script>
</body>
</html>
