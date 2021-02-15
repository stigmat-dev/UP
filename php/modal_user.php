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
                        <input type="text" class="form-control" name="edit_date" value="<?= $value['date'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="edit_name" value="<?= $value['name'] ?>" placeholder="Наименование">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="edit_unit" value="<?= $value['unit'] ?>" disabled>
                            <option value="<?= $value['unit'] ?>" selected><?= $value['unit'] ?></option>
                            <option value="Главный врач">Главный врач</option>
                            <option value="Приемная">Приемная</option>
                            <option value="Зам. по медицинской части">Зам. по медицинской части</option>
                            <option value="Зам. по реабилитации">Зам. по реабилитации</option>
                            <option value="Зам. по экономике">Зам. по экономике</option>
                            <option value="Зам. по АХП">Зам. по АХП</option>
                            <option value="Главный бухгалтер">Главный бухгалтер</option>
                            <option value="Орг. метод. отдел">Орг. метод. отдел</option>
                            <option value="Экономический отдел">Экономический отдел</option>
                            <option value="Бухгалтерия">Бухгалтерия</option>
                            <option value="Расчетный отдел">Расчетный отдел</option>
                            <option value="Отдел кадров">Отдел кадров</option>
                            <option value="Юрист">Юрист</option>
                            <option value="Стат. отдел">Стат. отдел</option>
                            <option value="Нейрохирургия 1">Нейрохирургия 1</option>
                            <option value="Нейрохирургия 2">Нейрохирургия 2</option>
                            <option value="Травматология 1">Травматология 1</option>
                            <option value="Травматология 2">Травматология 2</option>
                            <option value="Неврология">Неврология</option>
                            <option value="Интенсивная терапия">Интенсивная терапия</option>
                            <option value="ФТО">ФТО</option>
                            <option value="Госпиталь">Госпиталь</option>
                            <option value="Лаборатория">Лаборатория</option>
                            <option value="Санпропускник">Санпропускник</option>
                            <option value="Аптека">Аптека</option>
                            <option value="АХП">АХП</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="edit_executor" value="<?= $value['executor'] ?>" disabled>
                            <option value="<?= $value['executor'] ?>" selected><?= $value['executor'] ?></option>
                            <option value="Хрипливцев И.">Хрипливцев И.</option>
                            <option value="Шелудько В.">Шелудько В.</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="edit_status" value="<?= $value['status'] ?>" disabled>
                            <option value="<?= $value['status'] ?>" selected><?= $value['status'] ?></option>
                            <option value="В работе">В работе</option>
                            <option value="Выполнено">Выполнено</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea style="height: 100px;" class="form-control" name="edit_note" placeholder="Примечание"><?= $value['note'] ?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="edit_submit" class="btn btn-primary">Обновить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!---------------------------------Примечание---------------------------------------------->
<div class="modal fade" id="noteModal<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="modal-title">Примечание</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <textarea style="height: 200px;" id="note" class="form-control" disabled><?= $value['note'] ?></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
