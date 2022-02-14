<?php
include "config.php";

$sql = "select * from catalog";
$res = mysqli_query($connect,$sql);
$ids;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
</head>
<body>
    <div class='table'>
        <div class='string'>
            <div class='element'>ФИО</div>
            <div class='element'>Телефон</div>
            <div class='element'>Кем приходится</div>
            <div class='element'>Действие</div>
        </div>
        <?php
        while($data = mysqli_fetch_assoc($res)):?>
            <div class='string'>
                <div class='element'>
                <?= $data['fio']?>
                </div>
                <div class='element'>
                    <?= $data['phone']?>
                </div class='element'>
                <div class='element'>
                    <?= $data['who']?>               
                </div>
                <div class='element'>
                    <button class="btn-primary" onclick="editData(<?= $data['id']?>)">Редактировать</button>    
                    <button class="btn-secondary" onclick="deleteData(<?= $data['id']?>, this)">Удалить</button>
                </div>
            </div>
        <?php
            $ids = $data['id'];
            endwhile;
        ?>
    </div>
    <div class="lastId"><?= $ids?></div>
    <div class="btn-block"><button class="btn btn-primary open-popup">Добавить контакт</button></div>

    <!-- Modal -->
    <div class="popup__bg"> 
        <div class="popup">
            <svg class="close-popup" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#2982ff" d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z"/></svg>
            <label>
                <input type="text" name="name" class="newDataName">
                <div class="label__text">
                    ФИО
                </div>
            </label>
            <label>
                <input type="tel" name="tel" class="newDataPhone">
                <div class="label__text">
                    Телефон
                </div>
            </label>
            <label>
                <textarea name="message" class="newDataWho"></textarea>
                <div class="label__text">
                    Кем приходится
                </div>
            </label>
            <button type="submit" class="newData" onclick="sendNewData()">Отправить</button>
        </div>
    </div>  
    <script src="js/script.js" defer></script>
</body>
</html>





