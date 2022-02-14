let table = document.querySelector('.table');
let popupBg = document.querySelector('.popup__bg'); // Фон попап окна
let popup = document.querySelector('.popup'); // Само окно
let openPopupButtons = document.querySelectorAll('.open-popup'); // Кнопки для показа окна
let closePopupButton = document.querySelector('.close-popup'); // Кнопка для скрытия окна

openPopupButtons.forEach((button) => { // Перебираем все кнопки
    button.addEventListener('click', (e) => { // Для каждой вешаем обработчик событий на клик
        e.preventDefault(); // Предотвращаем дефолтное поведение браузера
        popupBg.classList.add('active'); // Добавляем класс 'active' для фона
        popup.classList.add('active'); // И для самого окна
    })
});

closePopupButton.addEventListener('click', () => { // Вешаем обработчик на крестик
    popupBg.classList.remove('active'); // Убираем активный класс с фона
    popup.classList.remove('active'); // И с окна
});

document.addEventListener('click', (e) => { // Вешаем обработчик на весь документ
    if (e.target === popupBg) { // Если цель клика - фот, то:
        popupBg.classList.remove('active'); // Убираем активный класс с фона
        popup.classList.remove('active'); // И с окна
    }
});

function sendNewData() {
    let actionValue = 'new';
    let nameValue = $('input.newDataName').val();
    let phoneValue = $('input.newDataPhone').val();
    let whoValue = $('textarea.newDataWho').val();
    let ids = document.querySelector('.lastId').innerHTML;

    console.log(actionValue, nameValue, phoneValue, whoValue);

    $.ajax({
        method: "POST",
        url: "server.php",
        data: { action: actionValue, fio: nameValue, phone: phoneValue, who: whoValue }
    })
        .done(function (msg) {
            //alert("Data Saved: " + msg);
        });

    popupBg.classList.remove('active'); // Убираем активный класс с фона
    popup.classList.remove('active'); // И с окна

    let html = `<div class='string'>
                    <div class='element'>
                        ${nameValue}
                    </div>
                    <div class='element'>
                        ${phoneValue}
                    </div>
                    <div class='element'>
                        ${whoValue}             
                    </div>
                    <div class='element'>
                        <button class="btn btn-primary" onclick="editData(${+ids + 1}, this)">Редактировать</button>    
                        <button class="btn btn-secondary" onclick="deleteData(${+ids + 1}, this)">Удалить</button>
                    </div>
                </div>`;
    table.insertAdjacentHTML('beforeend', html);
}

function deleteData(id, element) {
    let actionValue = 'delete';
    let identifier = id;

    console.log(identifier);

    $.ajax({
        method: "POST",
        url: "server.php",
        data: { action: actionValue, id: identifier }
    })
        .done(function (msg) {
            //alert("Data Saved: " + msg);
        });

    element.parentElement.parentElement.remove();
} 