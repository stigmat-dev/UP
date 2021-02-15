<?php
header('Content-Type: text/html; charset=utf-8');
include 'functions_user.php';
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
  <title>Кабинет | <?= $_SESSION['name']; ?></title>
</head>

<body>

  <div class="container-fluid">
    <div class="row">
      <div class="col mt-1">
        <nav class="menu shadow">
          <button type="submit" name="mail_submit" class="btn btn-primary mb-1 ml-auto myBtn addBtn" data-toggle="modal" data-target="#Modal" title="Добавить запись"><i class="far fa-address-card"></i></button>
          <form action="" method="GET">
            <div class="form-group ">
              <button name="search_submit" type="submit" class="btn btn-primary noBtn">Найти</button>
              <input type="search" class="form-control search" name="search" value="" placeholder="&#128269; Поиск">
              <button name="load_submit" type="submit" class="btn btn-primary loadBtn myBtn" title="Обновить базу"><i class="fas fa-sync-alt"></i></button>
              <button name="exit_submit" class="btn btn-primary expBtn myBtn" type="submit" title="Выход"><i class="fas fa-sign-out-alt"></i></button>
              <button name="find_submit" type="submit" class="btn btn-primary ml-auto searchBtn myBtn" title="Найти по датам"><i class="fas fa-search"></i></button>
              <input name="end_date" class="dates" type="date" title="Конечная дата" value="<?php echo date('Y-m-d'); ?>">
              <input name="start_date" class="dates" type="date" title="Начальная дата" value="<?php echo date('Y-m-d'); ?>">
              <label class="greeting">
                <h5>Добрый день, <?= $_SESSION['name']; ?>!</h5>
              </label>
            </div>
          </form>
        </nav>

        <table class="table shadow">
          <thead class="thead-dark">
            <tr>
              <th>№</th>
              <th>ФИО</th>
              <th>Дата рождения</th>
              <th>Адрес</th>
              <th>Диагноз</th>
              <th>Трудоустройство</th>
              <th>Дата поступления</th>
              <th>Дата выписки</th>
              <th>Отделение</th>
            </tr>
            <?php foreach ($result as $value) { ?>
              <tr>
                <td><?= $value['id'] ?></td>
                <td><?= $value['full_name'] ?></td>
                <td><?= $value['dob'] ?> (Возраст: <?= $age ?>)</td>
                <td><?= $value['adress'] ?></td>
                <td><?= $value['diag'] ?></td>
                <td><?= $value['work'] ?></td>
                <td><?= $value['date_enter'] ?></td>
                <td><?= $value['date_exit'] ?></td>
                <td><?= $value['unit'] ?></td>
              </tr>
            <?php } ?>
          </thead>
        </table>
      </div>
    </div>
  </div>

  <!-- ---------------------------------------------------------Форма Добавить запись -------------------------------------------------------------------------->

  <div class="modal fade" tabindex="-1" role="dialog" id="Modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content shadow">
        <div class="modal-header">
          <h5 class="modal-title"><i class="far fa-address-card"></i>&nbsp; Добавить запись</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="full_name" value="" placeholder="ФИО">
            </div>
            <div class="form-group">
              <input type="date" class="form-control mydate" name="dob" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="adress" value="" placeholder="Адрес">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="diag" value="" placeholder="Диагноз">
            </div>
            <div class="form-group">
              <select class="form-control" name="work">
                <option value="" selected>Выберите статус</option>
                <option value="Работает">Работает</option>
                <option value="Не работает">Не работает</option>
              </select>
            </div>
            <div class="form-group">
              <label>Дата поступления</label>
              <input type="date" class="form-control mydate" name="date_enter" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="form-group">
              <label>Дата выписки</label>
              <input type="date" class="form-control mydate" name="date_exit" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="form-group">
              <select class="form-control" name="unit">
                <option value="" selected>Выберите отделение</option>
                <option value="Нейрохирургия 1">Нейрохирургия 1</option>
                <option value="Нейрохирургия 2">Нейрохирургия 2</option>
                <option value="Травматология 1">Травматология ЗП</option>
                <option value="Травматология 2">Травматология ОДА</option>
                <option value="Неврология">Неврология</option>

              </select>
            </div>

        </div>
        <div class="modal-footer">
          <button type="submit" name="add_submit" class="btn btn-primary">Добавить</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="../js/script.js"></script>
</body>

</html>