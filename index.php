<?php include('./config/constants.php'); ?>

<!DOCTYPE html>
<head>
<link rel="stylesheet" href="./style.css">
</head>
<body>

  <form action="" method="POST">
    <h1>Guest Page for YunHo's Portfolio Website</h1>
    <input type="text" name='title' placeholder='write your title'><br><br>
    <textarea name="message" placeholder ="write your message" cols="22" rows="10"></textarea><br><br>
    <input type="submit" name='submit' value="Send Message to YunHo"/>
  </form>

  <?php
    if(isset($_SESSION['result'])){
      echo $_SESSION['result'];
      unset($_SESSION['result']);
    };
  ?>

  <table class = 'table'>
    <tr>
        <th>id</th>
        <th>title</th>
    </tr>

    <?php 
      $sql = "SELECT * FROM Messages";
      $res = mysqli_query($conn, $sql);
      
      //Serial Number shown
      $sn = 1;
      if($res == TRUE){
        
        $rowsnum = mysqli_num_rows($res);
        
        if($rowsnum>0){
          while($rows=mysqli_fetch_assoc($res)){
            $title = $rows['title'];
    ?>

    <tr>
      <td><?php echo $sn++; ?></td>
      <td><?php echo $title; ?></td>
    </tr>

      <?php
          };
        } else {
            "No Messeage to YunHo";
          }
        }
      ?>
    </tr>
  </table>
</body>


<?php
  if(isset($_POST['submit'])){
    //echo 'hello';
    $title = $_POST['title'];
    $message = $_POST['message'];

    $sql = "INSERT INTO Messages SET  
      title = '$title',
      _message = '$message', 
      _date = NOW()";

    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if($res){
      $_SESSION['result'] = "Message Sent Successfully";
      header('location: ./index.php');
    } else {
      $_SESSION['result'] = "There is Error";
      header('location: ./index.php');    
    }

  }
?>