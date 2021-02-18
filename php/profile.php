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
  <title>АСУП | <?= $_SESSION['name']; ?></title>
</head>

<body>

  <div class="container-fluid">


    <ul class="myTab">
      <li class="nav-item">
        <p class="nav-link active" data-toggle="tab" href="#description">Общее количество пациентов: <span style="font-weight:bold; font-size:120%;">‹ <?= $members ?> ›</span> &nbsp; | &nbsp;
          Нейрохирургия №1: <span style="font-weight:bold; font-size:120%;">‹ <?= $members_nh1 ?> ›</span> &nbsp; | &nbsp;
          Нейрохирургия №2: <span style="font-weight:bold; font-size:120%;">‹ <?= $members_nh2 ?> ›</span> &nbsp; | &nbsp;
          Травматология ЗП: <span style="font-weight:bold; font-size:120%;">‹ <?= $members_zp ?> ›</span> &nbsp;| &nbsp;
          Травматология ОДА: <span style="font-weight:bold; font-size:120%;">‹ <?= $members_oda ?> ›</span> &nbsp;| &nbsp;
          Неврология: <span style="font-weight:bold; font-size:120%;">‹ <?= $members_no ?> ›</span>
        </p>
      </li>
    </ul>

    <div class="tab-content p-3">
      <div class="tab-pane fade show active">
        <div class="row">

          <div class="col mt-1">
            <nav class="menu shadow">
              <button type="submit" name="mail_submit" class="btn btn-primary mb-1 ml-auto myBtn addBtn" data-toggle="modal" data-target="#Modal" title="Добавить запись"><i class="far fa-address-card"></i></button>
              <form action="" method="GET">
                <div class="form-group ">
                  <button name="search_submit" type="submit" class="btn btn-primary noBtn">Найти</button>

                  <input type="search" class="form-control search" name="search" value="" placeholder="Поиск...">

                  <button name="load_submit" type="submit" class="btn btn-primary loadBtn myBtn" title="Обновить базу"><i class="fas fa-sync-alt"></i></button>
                  <button name="exit_submit" class="btn btn-primary expBtn myBtn" type="submit" title="Выход"><i class="fas fa-sign-out-alt"></i></button>
                  <label class="greeting">
                    <h5>Добрый день, <span style="font-weight:bold"><?= $_SESSION['name']; ?></span>!
                      Сегодня: <span style="font-weight:bold">
                        <script>
                          var today = new Date();
                          var dd = String(today.getDate()).padStart(2, '0');
                          var mm = String(today.getMonth() + 1).padStart(2, '0');
                          var yyyy = today.getFullYear();

                          today = dd + '.' + mm + '.' + yyyy + '.';
                          document.write(today);
                        </script>
                      </span> Хорошего дня!</h5>
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
                  <th>Место работы</th>
                  <th>Дата поступления</th>
                  <th>Дата выписки</th>
                  <th>ВКК</th>
                  <th>Отделение</th>
                  <th>Действие</th>
                </tr>
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
                    <td class="td-center"><a href="?diag=<?= $value['id'] ?>" class="myLink" <?php if (empty($value['diag'])) {
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
                      <?php require 'modal_user.php'; ?>
                    </td>
                  </tr>
                <?php } ?>
              </thead>
            </table>

          </div>
        </div>
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
              <input type="text" class="form-control mydate" name="dob" value="" placeholder="Дата рождения в формате ДД.ММ.ГГГГ">
            </div>


            <div class="form-group">
              <input type="text" class="form-control" name="adress" value="" placeholder="Адрес">
            </div>


            <div class="form-group">
              <textarea style="height: 100px;" class="form-control" name="diag" placeholder="Диагноз"></textarea>
            </div>


            <div class="form-group">
              <textarea style="height: 80px;" class="form-control" name="work" placeholder="Место работы"></textarea>
            </div>


            <div class="form-group">
              <label>Дата поступления</label>
              <input type="date" class="form-control" name="date_enter" value="<?php echo date('Y-m-d'); ?>">
            </div>


            <div class="form-group">
              <select class="form-control" name="vkk">
                <option style="background: grey; color: white;" value="" selected>ВКК</option>
                <option value="Есть">Есть</option>
                <option value="Нет">Нет</option>
              </select>
            </div>


            <div class="form-group">
              <select class="form-control" name="unit">
                <option style="background: grey; color: white;" value="" selected>Выберите отделение</option>
                <option value="Нейрохирургия 1">Нейрохирургия 1</option>
                <option value="Нейрохирургия 2">Нейрохирургия 2</option>
                <option value="Травматология ЗП">Травматология ЗП</option>
                <option value="Травматология ОДА">Травматология ОДА</option>
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