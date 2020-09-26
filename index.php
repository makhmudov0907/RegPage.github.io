<?php
  require_once 'functions/connect.php';
  // pagination
  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }else {
    $page = 1;
  }

  $num_per_page = 03;
  $start_from = ($page - 1) * 03;

  $query = "SELECT * FROM `comments` ORDER BY `id` DESC LIMIT $start_from, $num_per_page";
  $result = mysqli_query($db, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Задачник</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body class="bg-dark text-white">

  <?php require_once 'blocks/header.php'; ?>

  <!-- mainCheck -> ввод данных -->
  <div class="container mt-5">
    <h1>Оставить отзыв</h1>
    <form action="functions/mainCheck.php" method="post">
      <input type="email" name="email" id="email" placeholder="Введите email" class="form-control"><br>
      <input type="text" name="subject" id="subject" placeholder="Введите username" class="form-control"><br>
      <textarea name="message" id="message" class="form-control" placeholder="Введите задачу" rows="8" cols="80"></textarea><br>
      <button type="submit" class="btn btn-success">Отправить</button>
    </form>
  </div>


  <div class="container mt-5 mb-5">

    <table class="table table-striped bg-white">
      <!-- sorting -->
      <?php
        require_once 'functions/connect.php';

        if(isset($_GET['order'])){
          $order = $_GET['order'];
        }else {
          $order = 'subject';
        }

        if(isset($_GET['sort'])){
          $sort = $_GET['sort'];
        }else {
          $sort = 'ASC';
        }

        $resultSet = $db->query("SELECT * FROM `comments` ORDER BY $order $sort");

        if($resultSet->num_rows > 0){
          $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC';
          echo "
            <tr>
              <td><a href='?order=subject&&sort=$sort'>Username</a></td>
              <td><a href='?order=email&&sort=$sort'>Email</a></td>
              <td> Message </td>
              <td><a href='?order=status&&sort=$sort'>Status</a></td>
            ";
            // цикл работает не корректно если в условии беру row работает сортировка а если rows работает пагинация
            while(($rows = $resultSet->fetch_assoc()) && ($rows = mysqli_fetch_assoc($result))){

            ?>
              <tr>
                <td><?php echo $rows['subject'] ?></td>
                <td><?php echo $rows['email'] ?></td>
                <td><?php echo $rows['message'] ?></td>
                <td><?php echo $rows['status'] ?></td>
              </tr>
          <?php
            }
          echo"
            </tr>
          ";
        }else {
          echo "No records returned";
        }

      ?>


    </table>
    <!-- pagination -->
    <?php
      $pr_query = "SELECT * FROM `comments`";
      $pr_result = mysqli_query($db,$pr_query);
      $total_record = mysqli_num_rows($pr_result);

      $total_page = ceil($total_record/$num_per_page);

        if($page>1){
          echo "<a href='index.php?page=".($page - 1)."' class='btn btn-primary mr-1'>Previous</a>";
        }

        for($i=1; $i<=$total_page; $i++){
          echo "<a href='index.php?page=".$i."' class='btn btn-success mr-1'>$i</a>";
        }

        if($i>$page){
          echo "<a href='index.php?page=".($page + 1)."' class='btn btn-primary mr-1'>Next</a>";
        }

    ?>


  </div>




</body>
</html>
