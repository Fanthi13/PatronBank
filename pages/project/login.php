<?php
    session_start();

if (isset($_SESSION['loggedin']) && session_status() == 2 && session_id() == $_SESSION["session_id"]) {
    if($_SESSION['role'] == 2){
        header('Location: moder-home-page.php');
    }elseif($_SESSION['role'] == 3){
        header('Location: admin-home-page.php');
    }else{
        header('Location: user-home-page.php');
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PatronBank | Вхід</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">

    <?php
        if(isset($_SESSION["success"]) || isset($_GET["logout"])){
            echo <<< SUCCESS
                <div class="callout callout-success">
    SUCCESS;
                if(isset($_SESSION["success"]))
                    echo "<p>$_SESSION[success]</p>";

                if(isset($_GET["logout"]))
                    echo "<p>Ви вийшли з свого акаунту</p>";

                echo <<< SUCCESS
                </div>
    SUCCESS;
        unset($_SESSION["success"]);
        }
    ?>

    <?php
    if(isset($_SESSION["error"])){
        echo <<< SUCCESS
                <div class="callout callout-danger">
                    <h5>Помилка!</h5>
                    <p>$_SESSION[error]</p>
                </div>
            SUCCESS;
        unset($_SESSION["error"]);
    }
    ?>
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="login.php" class="h1"><b>Patron</b>Bank</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Увійдіть щоб розпочату роботу</p>

      <form action="../../scripts/project-login.php" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Пошта" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Пароль" name="pass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Запам'ятати мене
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Увійти</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="recover-password.php">Я забув свій пароль</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Регістрація нового користувача</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
