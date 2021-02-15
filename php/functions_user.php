<?php
header('Content-Type: text/html; charset=utf-8');
include 'connect.php';

session_start();

$full_name = @$_POST['full_name'];
$dob = @$_POST['dob'];
$adress = @$_POST['adress'];
$diag = @$_POST['diag'];
$work = @$_POST['work'];
$date_enter = @$_POST['date_enter'];
$date_enter = date("d.m.Y", strtotime($date_enter));
$date_exit = @$_POST['date_exit'];
$date_exit = date("d.m.Y", strtotime($date_exit));
$unit = @$_POST['unit'];


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
$main = $sql->fetch(PDO::FETCH_ASSOC);


if (isset($_POST['add_submit'])) {
    $sql = "INSERT INTO patients(`full_name`, `dob`, `adress`, `diag`, `work`, `date_enter`, `date_exit`, `unit`) VALUES(?,?,?,?,?,?,?,?);";
    $query = $connect->prepare($sql);
    $query->execute([$full_name, $dob, $adress, $diag, $work, $date_enter, $date_exit, $unit]);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}




if (isset($_POST['edit_submit'])) {
    $sql = "UPDATE patients SET  name=?, note=? WHERE id=?;";
    $query = $connect->prepare($sql);
    $query->execute([$edit_name, $edit_note, $get_id]);
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
    header('Location: ./profile.php');
}

if (isset($_GET['exit_submit'])) {
    header('Location: ../');
}
