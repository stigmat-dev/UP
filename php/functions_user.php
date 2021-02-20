<?php
header('Content-Type: text/html; charset=utf-8');
include 'connect.php';

session_start();



$full_name = @$_POST['full_name'];
$dob = @$_POST['dob'];
$dob = date("d.m.Y", strtotime($dob));

$adress = @$_POST['adress'];
$diag = @$_POST['diag'];
$work = @$_POST['work'];
$date_enter = @$_POST['date_enter'];
$date_enter = date("d.m.Y", strtotime($date_enter));
$date_exit = @$_POST['date_exit'];
$date_exit = date("d.m.Y", strtotime($date_exit));
$vkk = @$_POST['vkk'];
$unit = @$_POST['unit'];


$search = @$_GET['search'];
$search = trim(@$search);
$search = strip_tags(@$search);


$edit_full_name = @$_POST['edit_full_name'];
$edit_dob = @$_POST['edit_dob'];
$edit_adress = @$_POST['edit_adress'];
$edit_diag = @$_POST['edit_diag'];
$edit_work = @$_POST['edit_work'];
$edit_date_enter = @$_POST['edit_date_enter'];
$edit_vkk = @$_POST['edit_vkk'];
$edit_unit = @$_POST['edit_unit'];
$get_id = @$_GET['id'];




$sql = $connect->prepare("SELECT * FROM patients ORDER BY id DESC;");
$sql->execute();
$result = $sql->fetchAll();
$main = $sql->fetch(PDO::FETCH_ASSOC);




if (isset($_POST['add_submit'])) {
    $sql = "INSERT INTO patients(`full_name`, `dob`, `adress`, `diag`, `work`, `date_enter`, `vkk`, `unit`) VALUES(?,?,?,?,?,?,?,?);";
    $query = $connect->prepare($sql);
    $query->execute([$full_name, $dob, $adress, $diag, $work, $date_enter, $vkk, $unit]);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}



if (isset($_POST['edit_submit'])) {
    $sql = "UPDATE patients SET full_name=?, dob=?, adress=?, diag=?, work=?, date_enter=?, vkk=?, unit=? WHERE id=?;";
    $query = $connect->prepare($sql);
    $query->execute([$edit_full_name, $edit_dob, $edit_adress, $edit_diag, $edit_work, $edit_date_enter, $edit_vkk, $edit_unit, $get_id]);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


if (isset($_GET['search_submit'])) {
    $sql = "SELECT * FROM patients WHERE full_name LIKE '%$search%'
	or dob LIKE '%$search%' 
    or adress LIKE '%$search%' 
    or diag LIKE '%$search%' 
	or work LIKE '%$search%' 
    or date_enter LIKE '%$search%' 
    or unit LIKE '%$search%' ORDER BY id ASC;";
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

if (isset($_GET['load2_submit'])) {
    $sql = $connect->prepare("SELECT * FROM patients ORDER BY id DESC;");
    $sql->execute();
    $result = $sql->fetchAll();
    header('Location: ./profile_doctor.php');
}


if (isset($_GET['exit_submit'])) {
    header('Location: ../');
}


function YearTextArg($year)
{
    $m = substr($year, -1, 1);
    $l = substr($year, -2, 2);
    return $year . ' ' . ((($m == 1) && ($l != 11)) ? 'год' : ((($m == 2) && ($l != 12) || ($m == 3) && ($l != 13) || ($m == 4) && ($l != 14)) ? 'года' : 'лет'));
}

function CountTextArg($man)
{
    $m = substr($man, -1, 1);
    $l = substr($man, -2, 2);
    return $man . ' ' . ((($m == 1) && ($l != 11)) ? 'человек' : ((($m == 2) && ($l != 12) || ($m == 3) && ($l != 13) || ($m == 4) && ($l != 14)) ? 'человека' : 'человек'));
}

$members = $connect->query("SELECT COUNT(*) as count FROM patients")->fetchColumn();
$members_nh1 = $connect->query("SELECT COUNT(*) as count FROM patients WHERE unit='Нейрохирургия 1'")->fetchColumn();
$members_nh2 = $connect->query("SELECT COUNT(*) as count FROM patients WHERE unit='Нейрохирургия 2'")->fetchColumn();
$members_zp = $connect->query("SELECT COUNT(*) as count FROM patients WHERE unit='Травматология ЗП'")->fetchColumn();
$members_oda = $connect->query("SELECT COUNT(*) as count FROM patients WHERE unit='Травматология ОДА'")->fetchColumn();
$members_no = $connect->query("SELECT COUNT(*) as count FROM patients WHERE unit='Неврология'")->fetchColumn();
