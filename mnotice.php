<?php
session_start();
if (!isset($_SESSION['managerId'])) {
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
  <?php if (isset($_GET['delete'])) {
    if ($con->query("delete from useraccounts where id = '$_GET[id]'")) {
      header("location:mindex.php");
    }
  } ?>
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
          <a class="nav-link active" href="mindex.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item "> <a class="nav-link" href="maccounts.php">Accounts</a></li>
        <li class="nav-item "> <a class="nav-link" href="maddnew.php">Add New Account</a></li>
        <li class="nav-item "> <a class="nav-link" href="mfeedback.php">Feedback</a></li>
        


      </ul>
      <?php include 'msideButton.php'; ?>

    </div>
  </nav><br><br><br>
  <?php
  $array = $con->query("select * from useraccounts where id = '$_GET[id]'");
  $row = $array->fetch_assoc();


  ?>
  <div class="container">
    <div class="card w-100 text-center shadowBlue">
      <div class="card-header">
        Send Notice to <?php echo $row['name'] ?>
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="alert alert-success w-50 mx-auto">
            <h5>Write notice for <?php echo $row['name'] ?></h5>
            <input type="hidden" name="userId" value="<?php echo $row['id'] ?>">
            <textarea class="form-control" name="notice" required placeholder="Write your message"></textarea>
            <button type="submit" name="send" class="btn btn-primary btn-block btn-sm my-1">Send</button>
          </div>
        </form><?php
                if (isset($_POST['send'])) {
                  if ($con->query("insert into notice (notice,userId) values ('$_POST[notice]','$_POST[userId]')")) {
                    echo "<div class='alert alert-success'>Successfully send</div>";
                  } else
                    echo "<div class='alert alert-danger'>Not sent Error is:" . $con->error . "</div>";
                }

                ?>
      </div>
      <div class="card-footer text-muted">
        <?php echo bankName; ?>
      </div>
    </div>

</body>

</html>