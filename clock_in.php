<?php
if($_SESSION["name"]=="test")
    {
      header("location:index.php");
    }
else
{
    session_start();
}
require 'db.php';
if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
}
$_SESSION["num"]="5";            
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Clock In</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>    
</head>
<body background="background.jpg" >
<div align="right" style="margin-right:5%;">
     <h1 style="color:white;"><?php
        echo $_SESSION["name"];
        ?></h1>
    <a href="http://chamelisales.com/timing.php" ><button style="font-size: 120%;" class="btn btn-danger">Logout</button></a>
</div>
        <?php
$user = $_SESSION["userid"];
//
if(isset($_SESSION['userid']))
        {
            $sql = "CALL employee_clock_in('$user')";
            $result = mysqli_query($conn,$sql);
            if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
               
                  $flag = $row["flag"];
               }
               
            }

    
    
    if($flag == 1)
            {
            ?>
               <label for="true" style="width:100%; font-size: 200%; background-color:white; color:red;">Logged in Successfully / Iniciado sesión con éxito</label>
            <?php
            }
           
             else
            { ?>
                <label for="false" style="width:100%; font-size: 200%; background-color:white; color:red;">ERROR!!! Already Logged In. / ERROR!!! Ya iniciado sesión.</label>
           <?php
            }
            }
      
         mysqli_close($conn);

    
    ?>
    <footer align="center" style="color:white;">
  <h4>Copyright © <?php echo date("Y"); ?> PentArray Inc. All rights reserved.</h4>
</footer>
</body>
</html>
