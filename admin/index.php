<?php
  session_start();

  if (!$_SESSION['user']) {
    header('Location: ../index.php');
  }

?>
<?php
  require_once "../functions/connect.php";
  require_once "includes/header.php";

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


  <!-- Профиль -->
  <div class="container-fluid mt-5 mb-5">

    <table class="table table-striped bg-white">
      <!-- sorting -->
      <?php
        require_once '../functions/connect.php';

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

            while( ($rows = mysqli_fetch_assoc($resultSet)) && ($row = mysqli_fetch_assoc($result)) ){

            ?>
              <tr>
                <td><?php echo $row['subject'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['message'] ?></td>
                <td><?php echo $row['status'] ?></td>
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


  <div class="container">
    <?php require_once "reduct.php" ?>
  </div>



</body>
</html>
