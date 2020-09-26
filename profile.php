<?php
  session_start();

  if (!$_SESSION['user']) {
    header('Location: index.php');
  }
  // echo fileperms(__FILE__);
  // chmod(__FILE__, 0746);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Профиль</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="bg-dark text-white">

  <?php require_once 'blocks/header.php'; ?>

  <!-- Профиль -->
  <div class="container col-4 mt-5">


    <form>
      <img src="<?= $_SESSION['user']['img']; ?>" width="300" alt="">
      <h2 style="margin: 10px 0;"><?= $_SESSION['user']['full_name']; ?></h2>
      <a href="#"><?= $_SESSION['user']['email']; ?></a>
      <a href="functions/logout.php" class="logout">Выход</a>
    </form>




  </div>
</body>
</html>
