<?php
session_start();
if (!isset($_SESSION['userId'])) {
  header('location:login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Banking</title>
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>
  <style>
    body {
      height: 100vh;
      background-image: linear-gradient(to right bottom, #21202e, #454450, #6c6b75, #96959d, #c2c1c6, #c1bfca, #c1bece, #c0bcd2, #938cb0, #695f8f, #3f346f, #100d4f);
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">
      <img src="images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
      <!--  <i class="d-inline-block  fa fa-building fa-fw"></i> --><?php echo bankName; ?>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item ">
          <a class="nav-link " href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active "> <a class="nav-link" href="accounts.php">Accounts</a></li>
        <li class="nav-item "> <a class="nav-link" href="statements.php">Account Statements</a></li>
        <li class="nav-item "> <a class="nav-link" href="transfer.php">Funds Transfer</a></li>
      

      </ul>
      <?php include 'sideButton.php'; ?>

    </div>
  </nav><br><br><br>
  <div class="container">
    <div class="card  w-75 mx-auto">
      <div class="card-header text-center">
        Notification from Bank
      </div>
      <div class="card-body">
        <?php
        $array = $con->query("select * from notice where userId = '$_SESSION[userId]' order by date desc");
        if ($array->num_rows > 0) {
          while ($row = $array->fetch_assoc()) {
            echo "<div class='alert alert-success'>$row[notice]</div>";
          }
        } else
          echo "<div class='alert alert-info'>Notice box empty</div>";
        ?>
      </div>
      <div class="card-footer text-muted">
        <?php echo bankName ?>
      </div>
    </div>

  </div>
</body>

</html>