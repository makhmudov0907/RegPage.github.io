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
  <title>Форма регистрации</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="bg-dark text-white">

  <?php require_once 'blocks/header.php'; ?>

  <!-- форма регистрации -->
  <div class="container col-4 mt-5">

    <form action="functions/signup.php" method="post" enctype="multipart/form-data">
      <label>ФИО</label>
      <input type="text" name="full_name" placeholder="Введите свое полное имя">

      <label>Логин</label>
      <input type="text" name="login" placeholder="Введите логин">

      <label>Почта</label>
      <input type="email" name="email" placeholder="Введите адресс своей почты">

      <label>Изображение профиля</label>
      <input type="file" name="img">

      <label>Пароль</label>
      <input type="password" name="password" placeholder="Введите пароль">

      <label>Подтверждение пароля</label>
      <input type="password" name="password_confirm" placeholder="Подтвердите пароль">

      <button type="submit">Зарегистрироваться</button>
      <p> У вас уже есть аккаунт? - <a href="auth.php">Авторизируйтесь</a> </p>
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
