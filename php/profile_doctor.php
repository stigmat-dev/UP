<?php
header('Content-Type: text/html; charset=utf-8');
include 'functions.php';
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css" />
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style.css">
    <title>АСУП | <?= $_SESSION['name']; ?></title>
</head>

<body>

    <div class="container-fluid">

        <div class="row">
            <div class="col mt-1">
                <nav class="menu shadow">
                    <button data-toggle="modal" data-placement="top" data-target="#statModal" class="btn btn-primary mb-1 ml-auto myBtn addBtn" title="Статистика"><i class="fas fa-info"></i></button>
                    <form action="" method="GET">
                        <div class="form-group ">
                            <button name="search_submit" type="submit" class="btn btn-primary noBtn">Найти</button>
                            <input type="search" class="form-control search" name="search" value="" placeholder="Поиск...">

                            <button name="load2_submit" type="submit" class="btn btn-primary loadBtn myBtn" title="Обновить базу"><i class="fas fa-sync-alt"></i></button>
                            <button name="exit_submit" class="btn btn-primary expBtn myBtn" type="submit" title="Выход"><i class="fas fa-sign-out-alt"></i></button>
                            <label class="greeting">
                                <h5>Добрый день, <span style="font-weight:bold"><?= $_SESSION['name']; ?></span>!
                                    Сегодня: <span style="font-weight:bold">
                                        <script>
                                            var ld = new Date();
                                            document.write(ld.toLocaleDateString() + '.');
                                        </script>
                                    </span> Хорошего дня!</h5>
                            </label>
                        </div>
                    </form>
                </nav>

                <table class="table table-striped shadow">
                    <thead class="thead-dark">
                        <tr>
                            <th>№</th>
                            <th>ФИО</th>
                            <th>Дата рождения</th>
                            <th>Адрес</th>
                            <th>Диагноз</th>
                            <th>Место работы</th>
                            <th>Дата поступления</th>
                            <th>Дата выписки</th>
                            <th>ВКК</th>
                            <th>Отделение</th>
                            <th>Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $value) { ?>
                            <tr>
                                <td class="td-center"><?= $value['id'] ?></td>
                                <td><?= $value['full_name'] ?></td>
                                <td class="td-center"><?= $value['dob'] ?>
                                    (<?php
                                        $age = DateTime::createFromFormat('d.m.Y', $value['dob'])
                                            ->diff(new DateTime('now'))
                                            ->y;

                                        print YearTextArg($age);
                                        ?>)</td>
                                <td><?= $value['adress'] ?></td>
                                <td class="td-center"><a href="?note=<?= $value['id'] ?>" class="myLink" <?php if (empty($value['diag'])) {
                                                                                                                echo 'style="display: none;"';
                                                                                                            } ?> id="noteLink" data-toggle="modal" data-placement="top" data-target="#diagModal<?= $value['id'] ?>">Открыть</a></td>
                                <td class="td-center"><a href="?diag=<?= $value['id'] ?>" class="myLink" <?php if (empty($value['diag'])) {
                                                                                                                echo 'style="display: none;"';
                                                                                                            } ?> id="noteLink" data-toggle="modal" data-placement="top" data-target="#workModal<?= $value['id'] ?>">Открыть</a></td>
                                <td class="td-center"><?= $value['date_enter'] ?></td>
                                <td class="td-center"><?= $value['date_exit'] ?></td>
                                <td class="td-center"><?= $value['vkk'] ?></td>
                                <td><?= $value['unit'] ?></td>
                                <td class="td-center">

                                    <a href="?edit=<?= $value['id'] ?>" title="Редактировать запись" class="btn btn-primary btn-sm myBtn" data-toggle="modal" data-placement="top" data-target="#editModal<?= $value['id'] ?>"><i class="far fa-edit"></i></a>
                                    <a href="?delete=<?= $value['id'] ?>" title="Удалить запись" class="btn btn-danger btn-sm" data-toggle="modal" data-placement="top" data-target="#deleteModal<?= $value['id'] ?>"><i class="far fa-trash-alt"></i></a>
                                    <?php require 'modal_doctor.php'; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>


        <?php

        if (isset($_POST['upload']) and $_FILES) {
            move_uploaded_file($_FILES['file']['tmp_name'], '../files/' . $_FILES['file']['name']);
            print 'Файл загружен!';
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="file" name="file">
                <input type="submit" name="upload" value="Отправить">
            </div>
        </form>

        <?php
        $path = scandir('../files/');
        foreach ($path as $f) {
            if ($f != '.' and $f != '..') {
                echo '<a href="../files/' . $f . '" target="blank">' . $f . '</a><br>';
            }
        }
        ?>
    </div>


    <!---------------------------------Статистика---------------------------------------------->
    <div class="modal fade" id="statModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Статистика</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="text-align: center;">Общее количество пациентов: &nbsp;<span style="font-weight:bold; font-size:120%;"><?= $members ?></span>.</p>
                    <hr>
                    <ul>
                        <li>Нейрохирургическое отделение №1: &nbsp;<span style="font-weight:bold; font-size:120%;"><?= $members_nh1 ?></span>.</li>
                        <li>Нейрохирургическое отделение №2: &nbsp;<span style="font-weight:bold; font-size:120%;"><?= $members_nh2 ?></span>.</li>
                        <li>Травматологическое отделение ЗП: &nbsp;<span style="font-weight:bold; font-size:120%;"><?= $members_zp ?></span>.</li>
                        <li>Травматологическое отделение ОДА: &nbsp;<span style="font-weight:bold; font-size:120%;"><?= $members_oda ?></span>.</li>
                        <li>Неврологическое отделение: &nbsp;<span style="font-weight:bold; font-size:120%;"><?= $members_no ?></span>.</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
</body>

</html>