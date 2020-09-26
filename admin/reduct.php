<?php require_once "../functions/connect.php" ?>

<h4>Поиск и редактирование записей по <b>username</b></h4>
<form method="post">
  <p>Введите <b>username</b> для поиска:</p>
  <input type="text" name="subject" placeholder="username">
  <input type="submit" name="submit" value="Найти">
</form>
<hr class="bg-white"/>

<?php
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];
  $status = $_POST['status'];

  $content_button = "<a href='index.php'>Вернуться назад</a>";


  if(isset($_POST['submit'])){
    $search = $_POST['subject'];
    $query = mysqli_query($db, "SELECT * FROM `comments` WHERE `subject` LIKE '%$search%' ");
    while ($range = mysqli_fetch_assoc($query)) {
      echo "<p> Username : " . $range['subject'] ." <br /> Email : ". $range['email'] ." <br /> Message : ". $range['message'] ." <br /> Status : ". $range['status'] ."</p><hr />
      <form method='post' action='index.php'> <input type='text' name='email' placeholder='Email' value=". $range['email'] ." <br /> <input type='text' name='subject' placeholder='Username' value=". $range['subject'] ." <br />
      <input type='text' name='message' placeholder='Сообщение' value=". $range['message'] ." <br />
      <input type='text' name='status' placeholder='Статус' value=". $range['status'] ." <br /> <input type='submit' name='submit2' value='Изменить'/></form>" ;
    }
  }
  if (isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message']) && isset($_POST['status'])) {
    $query = "DELETE FROM `comments` WHERE `subject`='$subject'";
    mysqli_query($db, $query) or die(mysqli_error($db));

    $query = "INSERT INTO `comments` (`email`, `subject`, `message`, `status`) VALUES('$email', '$subject', '$message', '$status')";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    if ($result == true) {
      echo "Информация изменена <br> $content_button";
    }else {
      echo "Информация не изменена <br> $content_button";
    }
  }
?>
