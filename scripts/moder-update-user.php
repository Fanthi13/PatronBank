<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    if(!isset($_POST["check"])){
        $errors[] = "Ви не підтвердили зміни!";
    }

    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[] = "Поле $key не заповнене!";
        }
    }

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Невірний формат ел.пошти!";
    }

    if (!empty($errors)) {
        $_SESSION["error"] = implode("<br>", $errors);
        if ($_SESSION['role'] == 3){
            header("location: ../pages/project/admin-users-list.php?userUpdateId=$_SESSION[userUpdateId]");
        }else if($_SESSION['role'] == 2){
            header("location: ../pages/project/moder-users-list.php?userUpdateId=$_SESSION[userUpdateId]");
        }
        exit();
    }

    require_once "./connect.php";



    $sql = "UPDATE `user` SET `city_id` = '$_POST[city_id]', `email` = '$_POST[email]', `firstName` = '$_POST[firstName]', `lastName` = '$_POST[lastName]', `birthday` = '$_POST[birthday]' WHERE `user`.`id` = $_SESSION[userUpdateId];";
    $conn->query($sql);

    if ($conn->affected_rows == 1){
        $_SESSION["success"] = "Користувач $_POST[firstName] $_POST[lastName] успішно змінений!";
        if ($_SESSION['role'] == 3) {
            header("location: ../pages/project/admin-users-list.php");
        }else if($_SESSION['role'] == 2){
            header("location: ../pages/project/moder-users-list.php");
        }
    }else{
        $_SESSION["error"] = "Не вдалось змінити дані про користувача!";
        if ($_SESSION['role'] == 3){
            header("location: ../pages/project/admin-users-list.php?userUpdateId=$_SESSION[userUpdateId]");
        }else if($_SESSION['role'] == 2){
            header("location: ../pages/project/moder-users-list.php?userUpdateId=$_SESSION[userUpdateId]");
        }
    }

}else {
    $_SESSION["error"] = "Заповніть всі поля!";
    if ($_SESSION['role'] == 3){
        header("location: ../pages/project/admin-users-list.php?userUpdateId=$_SESSION[userUpdateId]");
    }else if($_SESSION['role'] == 2){
        header("location: ../pages/project/moder-users-list.php?userUpdateId=$_SESSION[userUpdateId]");
    }
    exit();
}