<?php
session_start();

if (!isset($_SESSION['loggedin']) || session_status() != 2 || session_id() != $_SESSION['session_id']) {
    $_SESSION["error"] = "Please login";
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PatronBank | Cторінка Операції</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="user-home-page.php" class="nav-link">Домашня сторінка</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
      </li>

      <!-- Messages Dropdown Menu -->

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="user-home-page.php" class="brand-link">
        <img src="../dist/img/M-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight">PatronBank</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="profile.php" class="d-block"><?php echo $_SESSION['firstName']," ",$_SESSION['lastName'];?></a>
            <?php if($_SESSION['role'] == 2) {echo "<a class=text-gray> Модератор </a>";}elseif ($_SESSION['role'] == 3) {echo "<a class=text-gray> Адміністратор </a>";}else{echo "<a class=text-gray> Користувач </a>";}?>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="user-home-page.php" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>Домашня сторінка</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="operations.php" class="nav-link">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>Операції</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="history.php" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>Історія</p>
                </a>
            </li>
            <?php
            if($_SESSION['role'] == 3){
                echo <<< ADMINPAGES
            <li class="nav-item">
                <a href="admin-users-list.php" class="nav-link">
                    <i class="nav-icon fas fa-users-cog text-danger"></i>
                    <p class="text-danger">Список користувачів</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="balance-all.php" class="nav-link">
                    <i class="nav-icon fas fa-money-bill-wave text-danger"></i>
                    <p class="text-danger">Баланс користувачів</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="history-all.php" class="nav-link">
                    <i class="nav-icon fas fa-history text-danger"></i>
                    <p class="text-danger">Історія транкзакції</p>
                </a>
            </li>
ADMINPAGES;
            }
            if($_SESSION['role'] == 2){
                echo <<< MODERPAGES
            <li class="nav-item">
                <a href="moder-users-list.php" class="nav-link">
                    <i class="nav-icon fas fa-users-cog text-warning"></i>
                    <p class="text-warning">Список користувачів</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="history-all.php" class="nav-link">
                    <i class="nav-icon fas fa-history text-warning"></i>
                    <p class="text-warning">Історія транкзакції</p>
                </a>
            </li>
MODERPAGES;
            }
            ?>
            <li class="nav-item">
                <a href="../../scripts/logout.php" class="nav-link">
                    <i class="nav-icon far fa-circle text-danger"></i>
                    <p>Вихід</p>
                </a>
            </li>
        </ul>


      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Операції</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Домашня сторінка</a></li>
              <li class="breadcrumb-item active">Операції</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Баланс акаунта</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body"> <i class="fas fa-user mr-2"></i>
            <?php
            require_once "../../scripts/connect.php";

            $sql = "SELECT account from user where id = $_SESSION[id]";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = mysqli_fetch_assoc($result)){
                    echo "ID акаунта: " . $row["account"];
                    $_SESSION['account'] = $row["account"];
                }
            }else{
                echo "0";
            }
            ?>
        </div>
          <div class="card-footer"> <i class="fas fa-money-bill mr-1"></i>
              <?php
              require_once "../../scripts/connect.php";

              $sql = "SELECT balance from balance where account_id = $_SESSION[id]";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  while($row = mysqli_fetch_assoc($result)){
                      echo "Баланс: " . $row["balance"] . " $";
                  }
              }else{
                  echo "0";
              }
              ?>
          </div>
        <!-- /.card-body -->

        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

        <?php
        if(isset($_SESSION["success"])){
            echo <<< SUCCESS
                <div class="callout callout-success">
                    <h5>Успішно!</h5>
                    <p>$_SESSION[success]</p>
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

        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Грошовий переказ</h3>

            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="../../scripts/transfer.php" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Отримувач</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Введіть ІD акаунта" name="r-account">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ім'я отримувача</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Введіть ім'я" name="r-name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Сума</label>
                        <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Введіть суму" name="amount">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="check">
                        <label class="form-check-label" for="exampleCheck1">Підтвердити транкзакцію</label>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Підтвердити</button>
                </div>
            </form>
        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
