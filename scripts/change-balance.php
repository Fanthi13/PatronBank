<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "./connect.php";

    if (!isset($_POST['newbalance'], $_POST['check'])) {
        // Could not get the data that should have been sent.
        $_SESSION['error'] = "Заповніть всі поля";
        echo "<script>history.back();</script>";
        exit();
    }

    if ($_POST['newbalance'] < 0){
        $_SESSION['error'] = "Введіть число більше нуля!";
        echo "<script>history.back();</script>";
        exit();
    }

    if ($stmt = $conn->prepare('select u.id, account_id, balance from user u left join balance on u.id = account_id where u.id = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('i', $_SESSION["userBalanceID"]);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $acc_id, $balance);
            $stmt->fetch();

            if($balance == null){

                $addB = $conn->prepare("INSERT INTO balance (`account_id`, `balance`) VALUES (?, ?);");

                $startB = 0;

                $addB->bind_param('ii', $id,$startB);

                $addB->execute();

                if ($stmt->affected_rows) {
                    $_SESSION["error"] = "Акаунт користувача " . $_POST['r-name'] . " був доданий!";
                }
            }

            $sql = "UPDATE balance SET balance = $_POST[newbalance] where account_id = $id";
            $conn->query($sql);
            if ($conn->affected_rows == 1){
                $_SESSION["success"] = "Баланс користувача успішно змінений!";
                header("location: ../pages/project/balance-all.php");
            }else{
                $_SESSION["error"] = "Не вдалось змінити дані!";
                header("location: ../pages/project/balance-all.php?userBalanceID=$_SESSION[userBalanceID]");
            }

        } else {
            // Incorrect username
            $_SESSION['error'] = "Невірний ID акаунта!";
            echo "<script>history.back();</script>";
            exit();
            //echo 'Incorrect username and/or password!';
        }

        $stmt->close();
    }

}else{
    $_SESSION["error"] = "Заповніть всі поля!";
    header("location: ../pages/project/balance-all.php?userBalanceID=$_SESSION[userBalanceID]");
    exit();
}
?>
