<!-- ввод отзывов с главной страницы -->
<?php
  $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
  $subject = filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING);
  $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

  if(mb_strlen($subject) < 3 || mb_strlen($subject) > 90) {
    echo "Недопустимая длина логина";
    exit();
  } else if(mb_strlen($message) < 2 || mb_strlen($message) > 1600) {
    echo "Недопустимая длина пароля";
    exit();
  }

  require_once 'connect.php';

  $db->query("INSERT INTO `comments` (`email`, `subject`, `message`) VALUES('$email', '$subject', '$message')");

  $db->close();

  function redirect_to($new_location) {
    header("Location: " . $new_location);
  }
  redirect_to("/zadachnik/index.php");

 ?>
