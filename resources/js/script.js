// Обработка формы после загрузки страницы
document.addEventListener('DOMContentLoaded', function () {
    // Находим форму и элементы для отображения выбранных параметров и итоговой цены
    const configForm = document.getElementById('configForm');
    const selectedOptionsDiv = document.getElementById('selectedOptions');
    const totalPriceDiv = document.getElementById('totalPrice');

    // Обработчик отправки формы
    configForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Предотвращаем отправку формы по умолчанию

        // Собираем данные формы
        const formData = new FormData(configForm);

        // Отправляем данные на сервер с помощью fetch API
        fetch('save_configuration.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                // Обновляем данные на странице после успешного ответа сервера
                selectedOptionsDiv.innerHTML = `<h5>Выбранные параметры:</h5>${formatSelectedOptions(data)}`;
                totalPriceDiv.innerHTML = `<h5>Итоговая цена:</h5>${data.totalPrice} руб.`;
            })
            .catch(error => console.error('Произошла ошибка:', error));
    });
});

// Функция для форматирования выбранных параметров
function formatSelectedOptions(data) {
    let optionsHTML = '';
    for (const [param, value] of Object.entries(data)) {
        if (param !== 'totalPrice') {
            optionsHTML += `<p><strong>${param}:</strong> ${value}</p>`;
        }
    }
    return optionsHTML;
}
