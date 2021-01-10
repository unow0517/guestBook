<?php include('./config/constants.php'); ?>

<!DOCTYPE html>
<head>
<link rel="stylesheet" href="./style.css">
</head>
<body>
  <!-- submit form -->
  <form action="" method="POST">
    <h1>Guest Page for YunHo's Portfolio Website</h1>
    <input required type="text" name='title' placeholder='write your title'><br><br>
    <textarea required name="message" placeholder ="write your message" cols="22" rows="10"></textarea><br><br>
    <input type="submit" name='submit' value="Send Message to YunHo"/>
  </form>
  <!-- submit form End-->


  <?php
    //result message start
    if(isset($_SESSION['result'])){
      echo $_SESSION['result'];
      unset($_SESSION['result']);
    };
    //result message end
  ?>

    <!-- Read the messages from database -->
  <table class = 'table'>
    <tr>
        <th>id</th>
        <th>title</th>
    </tr>

    <?php 
      $sql = "SELECT * FROM Messages ORDER BY _date DESC";
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
  <!-- Read the messages from database End-->
</body>


<?php
  // add submitted form to database
  if(isset($_POST['submit'])){
    //echo 'hello';
    //escape single quote, double quote with real_escape_string
    $title = mysqli_real_escape_string($conn, $_POST['title']) ;
    $message =  mysqli_real_escape_string($conn, $_POST['message']);


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
    };
  };
  // add submitted form to database
?>