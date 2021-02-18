<!-- ---------------------------------------------------------Форма Обновить запись -------------------------------------------------------------------------->

<div class="modal fade" id="editModal<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-edit"></i>&nbsp; Редактировать запись № <?= $value['id'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="?id=<?= $value['id'] ?>" method="post">


                    <div class="form-group">
                        <input type="text" class="form-control" name="edit_full_name" value="<?= $value['full_name'] ?>" placeholder="ФИО">
                    </div>


                    <div class="form-group">
                        <input type="text" class="form-control" name="edit_dob" value="<?= $value['dob'] ?>" placeholder="Дата рождения">
                    </div>


                    <div class="form-group">
                        <input type="text" class="form-control" name="edit_adress" value="<?= $value['adress'] ?>" placeholder="Адрес">
                    </div>


                    <div class="form-group">
                        <textarea style="height: 100px;" class="form-control" name="edit_diag" value="<?= $value['diag'] ?>"><?= $value['diag'] ?></textarea>
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="edit_work" value="<?= $value['work'] ?>">
                            <option style="background: grey; color: white;" value="<?= $value['work'] ?>" selected><?= $value['work'] ?></option>
                            <option value="Работает">Работает</option>
                            <option value="Не работает">Не работает</option>
                            <option value="Пенсия">Пенсия</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="edit_date_enter" value="<?= $value['date_enter'] ?>">
                    </div>


                    <div class="form-group">
                        <label for="">ВКК</label>&nbsp;
                        <input type="checkbox" class="" name="edit_vkk" value="<?= $value['vkk'] ?>">
                    </div>


                    <div class="form-group">
                        <select class="form-control" name="edit_unit" value="<?= $value['unit'] ?>">
                            <option style="background: grey; color: white;" value="<?= $value['unit'] ?>" selected><?= $value['unit'] ?></option>

                            <option value="Нейрохирургия 1">Нейрохирургия 1</option>
                            <option value="Нейрохирургия 2">Нейрохирургия 2</option>
                            <option value="Травматология ЗП">Травматология ЗП</option>
                            <option value="Травматология ОДА">Травматология ОДА</option>
                            <option value="Неврология">Неврология</option>

                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="edit_submit" class="btn btn-primary">Обновить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!---------------------------------Диагноз---------------------------------------------->
<div class="modal fade" id="diagModal<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="modal-title">Диагноз</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <textarea style="height: 300px;" id="note" class="form-control" disabled><?= $value['diag'] ?></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>