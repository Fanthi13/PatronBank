<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patron Bank | Реєстрація</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <?php
    if (isset($_SESSION["error"])){
        echo <<< ERROR
      <div class="callout callout-danger">
                  <h5>Помилка!</h5>
                  <p>$_SESSION[error]</p>
                </div>
ERROR;
        //echo $_SESSION["error"];
        unset($_SESSION["error"]);
    }
    ?>
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="register.php" class="h1"><b>Patron</b>Bank</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Створити акаунт</p>

            <form action="../../scripts/register.php" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Введіть cвоє ім'я" name="ім'я">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Введіть своє прізвище" name="прізвище">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Введіть свою Ел.пошту" name="Ел_пошта">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Підтвердіть свою Ел.пошту" name="підтвердження_Ел_пошти">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Введіть пароль" name="пароль">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Підтвердіть пароль" name="підтвердження_пароля">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <select class="form-control" name="city_id">
                        <?php
                            require_once "../../scripts/connect.php";
                            $sql ="SELECT * FROM cities";
                            $result = $conn->query($sql);
                            while($city = $result->fetch_assoc()){
                                echo "<option value='$city[id]'>$city[city]</option>";
                            }
                        ?>
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="date" class="form-control" name="день_народження">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-7">
                        <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                            <label for="agreeTerms">
                            Я підтверджую що ознайомлений(а) з <a href="#">Політикою конфіденційності </a> та даю згоду на обробку моїх персональних даних
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-5">
                        <button type="submit" class="btn btn-primary btn-block">Зареєструватися</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="login.php" class="text-center">Я вже зареєстрований</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>