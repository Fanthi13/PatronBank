<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[] = "Поле $key не заповнене!";
        }
    }

    if ($_POST["Ел_пошта"] != $_POST["підтвердження_Ел_пошти"]) {
        $errors[] = "Ви ввели дві різні адреси!";
    }

    if ($_POST["пароль"] != $_POST["підтвердження_пароля"]) {
        $errors[] = "Ви ввели різні паролі";
    }

    if (!filter_var($_POST["Ел_пошта"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Невірний формат адреси!";
    }

    if (!empty($errors)) {
        $_SESSION["error"] = implode("<br>", $errors);
        header("location: ../pages/project/login.php");
        exit();
    }

    require_once "./connect.php";

    try {
        $stmt = $conn->prepare("INSERT INTO user (`city_id`, `account`, `email`, `firstname`, `lastname`, `birthday`, `password`) VALUES (?, ?, ?, ?, ?, ?, ?);");

        $pass = password_hash($_POST["пароль"], PASSWORD_ARGON2ID);

        $account = rand(1000000, 9999999);

        $stmt->bind_param('iisssss', $_POST["city_id"], $account, $_POST["Ел_пошта"], $_POST["ім'я"], $_POST["прізвище"], $_POST["день_народження"], $pass);

        $stmt->execute();

        if ($stmt->affected_rows) {
            $_SESSION["success"] = "Користувача було успішно додано " . $_POST["ім'я"] . " " . $_POST["прізвище"];
            header("location: ../pages/project/login.php");
            exit();
        } else {
            $_SESSION["error"] = "Користувача не було додано!";
            header("location: ../pages/project/login.php");
            exit();
        }
    } catch (Exception $e) {
        $_SESSION["error"] = "Ця адреса вже зайнята!";
        header("location: ../pages/project/login.php");
        exit();
    }
} else {
    $_SESSION["error"] = "Заповніть всі поля!";
    header("location: ../pages/project/login.php");
    exit();
}



