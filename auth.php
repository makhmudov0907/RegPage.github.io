<?php
  session_start();

  if ($_SESSION['user']) {
    header('Location: profile.php');
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Авторизационная форма</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="bg-dark text-white">

  <?php require_once 'blocks/header.php'; ?>

  <!-- форма авторизации -->
  <div class="container col-4 mt-5">


    <form action="functions/signin.php" method="post">
      <label>Логин</label>
      <input type="text" name="login" placeholder="Введите логин">
      <label>Пароль</label>
      <input type="password" name="password" placeholder="Введите пароль">
      <button type="submit">Войти</button>
      <p> У вас нет аккаунта? - <a href="registr.php">Зарегистрируйтесь</a> </p>

      <?php
        if ($_SESSION['message']) {
          echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
        }
        unset($_SESSION['message']);
      ?>

    </form>




  </div>
</body>
</html>
