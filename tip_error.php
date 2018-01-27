<?php
session_start();
if($_SESSION["name"]=="")
    {
      header("location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Chameli Restaurent</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body background="background.jpg" >
<center><h2 style="color:red; background:white;">
     <?php
        echo $_SESSION["daily"];
    ?>
    </h2></center>
    <center><a href="http://chamelisales.com/employee.php"><Button  style="font-size: 150%;" class="btn btn-danger">Go Back</Button></a></center>
</body>
</html>