<?php

if (isset($_POST['upload']) and $_FILES) {
    move_uploaded_file($_FILES['file']['tmp_name'], '../files/' . $_FILES['file']['name']);
    echo 'Файл загружен!';
} else {
    echo 'Ошибка!';
}
