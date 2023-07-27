<!DOCTYPE html>
<html>
<head>
    <title>Конфигуратор двери</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS */
        .form-container {
            margin-top: 10px;
            margin-right: 10px;
        }

    </style>
</head>
<body>
<h1>Конфигуратор входной двери</h1>
<div>
    <div class="row">
        <div class="col-md-6">
            <div class="door-images">
                <div class="row">
                    <div class="col-md-6">
                        <div class="door-visual">
                            <img id="doorImage" src="../images/default_door.jpg" width="300" alt="Дверь">
                        </div>
                        <h4>Вид снаружи</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="door-visual-mirror">
                            <img id="doorImageMirror" src="../images/default_door.jpg" width="300" alt="Дверь (зеркальное)">
                        </div>
                        <h4>Вид изнутри</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 form-container">
            <form action="{{ route('doorStore') }}" method="POST" id="create_door_form">
                @csrf
                <!-- Значение для хранения итоговой цены -->
                <input type="hidden" name="total_price" value="0">
                <div class="options">
                    <h2>Выберите параметры:</h2>
                    <div class="form-group">
                        <label for="paint_color">Цвет покраски:</label>
                        <select id="paint_color" name="paint_color" class="form-control">
                            <option value="default">Не выбрано</option>
                            <option value="red">Красный</option>
                            <option value="blue">Синий</option>
                            <option value="green">Зеленый</option>
                            <option value="yellow">Желтый</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="film_color">Цвет плёнки:</label>
                        <select id="film_color" name="film_color" class="form-control">
                            <option value="default">Не выбрано</option>
                            <option value="green">Зеленый</option>
                            <option value="yellow">Желтый</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="handle_color">Цвет ручки:</label>
                        <select id="handle_color" name="handle_color" class="form-control">
                            <option value="default">Не выбрано</option>
                            <option value="red">Красный</option>
                            <option value="blue">Синий</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="width">Ширина:</label>
                        <input type="number" id="width" name="width" class="form-control" min="500" max="1200" step="1" value="1000">
                    </div>
                    <div class="form-group">
                        <label for="height">Высота:</label>
                        <input type="number" id="height" name="height" class="form-control" min="1500" max="2200" step="1" value="1800">
                    </div>
                    <div class="form-group">
                        <label>Открывание:</label>
                        <div class="form-check">
                            <input type="radio" name="opening" value="left" class="form-check-input">
                            <label class="form-check-label">Левое</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="opening" value="right" class="form-check-input">
                            <label class="form-check-label">Правое</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Аксессуары:</label>
                        <div class="form-check">
                            <input type="checkbox"  name="accessories[]" value="a1" class="form-check-input">
                            <label class="form-check-label">А1</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox"  name="accessories[]" value="a2" class="form-check-input">
                            <label class="form-check-label">А2</label>
                        </div>
                    </div>
                    <div class="total-price">
                        <h2>Итоговая стоимость: <span id="price">0</span> рублей</h2>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-md-6">
                                <button id="generateBtn" type="button" class="btn btn-lg btn-primary mt-3">Сгенерировать</button>
                            </div>
                            <div class="col-md-6">
                                <button id="send" type="send" class="btn btn-lg btn-primary" hidden>Отправить комплектацию</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Подключение скрипта -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    document.getElementById("send").addEventListener("click", function () {
        // Получаем данные формы, включая итоговую цену
        var formData = $("#create_door_form").serializeArray();
        $.ajax({
            type: "POST",
            url: "/door-store",
            data: {
                'formData': formData,
                "_token": "{{ csrf_token() }}",
            },

            dataType: "html",
            success: function (paintColor) {
                console.log(paintColor)
            },
            error: function (error) {
                console.error(error); // выведет объект ошибки в консоль
            }
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
        // Обработчик кнопки "Сгенерировать"
        document.getElementById("generateBtn").addEventListener("click", function () {
            if (!validateForm()) {
                alert("Пожалуйста, выберите все параметры.");
                return;
            }

            function validateForm() {
                // Check if all required parameters are selected
                var paintColor = $("#paint_color").val();
                var filmColor = $("#film_color").val();
                var handleColor = $("#handle_color").val();
                var width = $("#width").val();
                var height = $("#height").val();
                var selectedOpening = $("input[name='opening']:checked").val();
                var selectedAccessories = $("input[name='accessories[]']:checked").length;

                if (
                    paintColor === "default" ||
                    filmColor === "default" ||
                    handleColor === "default" ||
                    width === "" ||
                    height === "" ||
                    isNaN(width) ||
                    isNaN(height) ||
                    selectedOpening === undefined ||
                    selectedAccessories === 0
                ) {
                    return false; // Validation failed
                }

                return true; // Validation succeeded
            }

            var paintColor = $("#paint_color").val();
            var filmColor = $("#film_color").val();
            var handleColor = $("#handle_color").val();


            var selectedOpening = $("input[name='opening']:checked").val();
            if (selectedOpening === "left") {
                var imagePath = "../images/" + paintColor + "_" + filmColor + "_" + handleColor + ".jpg";
                $("#doorImage").attr("src", imagePath);
                var imagePathMirror = "../images/door-mirror/" + paintColor + "_" + filmColor + "_" + handleColor + ".jpg";
                $("#doorImageMirror").attr("src", imagePathMirror);
            } else {
                var imagePath = "../images/door-mirror/" + paintColor + "_" + filmColor + "_" + handleColor + ".jpg";
                $("#doorImage").attr("src", imagePath);
                var imagePathMirror = "../images/" + paintColor + "_" + filmColor + "_" + handleColor + ".jpg";
                $("#doorImageMirror").attr("src", imagePathMirror);
            }
            document.getElementById("send").removeAttribute("hidden");

            updateTotalPrice();
        });

        $("select, input").change(function () {
            // Вызываем функцию для обновления цены
            updateTotalPrice();
        });

        function updateTotalPrice() {
            var basePrice = 0; // Изначальная цена без параметров

            // Цены для каждого значения параметра
            var prices = {
                'default': 0,
                'red': 500,
                'blue': 600,
                'green': 700,
                'yellow': 800,
            }
            // Цены для каждого аксессуара
            var accessoryPrices = {
                'a1': 300,
                'a2': 400
            };
            // Получаем выбранные аксессуары
            var accessories = $("input[name='accessories[]']:checked");

            // Суммируем стоимость аксессуаров
            accessories.each(function () {
                var accessory = $(this).val();
                basePrice += accessoryPrices[accessory] || 0;
            });

            // Получаем значения выбранных параметров из элементов формы
            var paintColor = $("#paint_color").val();
            var filmColor = $("#film_color").val();
            var handleColor = $("#handle_color").val();

            // Суммируем цены параметров
            basePrice += prices[paintColor] || 0;
            basePrice += prices[filmColor] || 0;
            basePrice += prices[handleColor] || 0;

            // Получаем значения ширины и высоты
            var width = parseInt($("#width").val());
            var height = parseInt($("#height").val());


            basePrice += width * 5 + height * 10;

            // Обновляем итоговую цену на странице
            $("#price").text(basePrice);

             $("input[name='total_price']").val(basePrice);
        }

    });
</script>
</body>
</html>
