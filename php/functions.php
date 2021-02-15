<?php
header('Content-Type: text/html; charset=utf-8');
include 'connect.php';

$date = @$_POST['date'];
$date = date("d.m.Y", strtotime($date));
$name = @$_POST['name'];
$note = @$_POST['note'];
$unit = @$_POST['unit'];
$executor = @$_POST['executor'];
$status = @$_POST['status'];

$search = @$_GET['search'];
$search = trim(@$search);
$search = strip_tags(@$search);

$start_date = @$_GET['start_date'];
$end_date = @$_GET['end_date'];
$start_date = date("d.m.Y", strtotime($start_date));
$end_date = date("d.m.Y", strtotime($end_date));

$edit_date = @$_POST['edit_date'];
$edit_date = date("d.m.Y", strtotime($edit_date));
$edit_name = @$_POST['edit_name'];
$edit_note = @$_POST['edit_note'];
$edit_unit = @$_POST['edit_unit'];
$edit_executor = @$_POST['edit_executor'];
$edit_status = @$_POST['edit_status'];
$get_id = @$_GET['id'];
$id = $_SESSION['user_id'];


$sql = $connect->prepare("SELECT * FROM patients ORDER BY id DESC;");
$sql->execute();
$result = $sql->fetchAll();


if (isset($_POST['add_submit'])) {
    $sql = "INSERT INTO patients(`date`, `name`, `note`, `unit`, `executor`, `status`, `id_user`) VALUES(?,?,?,?,?,?,?);";
    $query = $connect->prepare($sql);
    $query->execute([$date, $name, $note, $unit, $executor, $status, $id]);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


if (isset($_POST['edit_submit'])) {
    $sql = "UPDATE patients SET date=?, name=?, note=?, unit=?, executor=?, status=? WHERE id=?;";
    $query = $connect->prepare($sql);
    $query->execute([$edit_date, $edit_name, $edit_note, $edit_unit, $edit_executor, $edit_status, $get_id]);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


if (isset($_POST['delete_submit'])) {
    $sql = "DELETE FROM patients WHERE id=?;";
    $query = $connect->prepare($sql);
    $query->execute([$get_id]);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


if (isset($_GET['search_submit'])) {
    $sql = "SELECT * FROM patients WHERE date LIKE '%$search%' AND id_user = '$id'
	or name LIKE '%$search%' AND id_user = '$id' or unit LIKE '%$search%' AND id_user = '$id' or executor LIKE '%$search%' AND id_user = '$id'
	or status LIKE '%$search%' AND id_user = '$id' ORDER BY id ASC;";
    $query = $connect->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();
}

if (isset($_GET['find_submit'])) {
    $sql = "SELECT * FROM patients WHERE date >= '$start_date' AND date <= '$end_date' AND id_user = '$id';";
    $query = $connect->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();
}

if (isset($_GET['load_submit'])) {
    $sql = $connect->prepare("SELECT * FROM patients ORDER BY id DESC;");
    $sql->execute();
    $result = $sql->fetchAll();
    header('Location: ./base.php');
}

if (isset($_GET['exit_submit'])) {
    header('Location: ../');
}
