<?php
if($_SESSION["name"]=="test")
    {
      header("location:index.php");
    }
else
{
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Chameli  Restaurant</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body background="background.jpg">
    <center><img src="Clogo.jpg"  style="margin-top:2%; margin-bottom:2%;" width="20%" height="10%"></center>
<div class="container">
  <div class="jumbotron">
    <div align="right" style="fontsize:50%;">
        <h3><?php
        echo $_SESSION["name"];
            $user = $_SESSION["user_id"];
      ?></h3>
        <a href="http://chamelisales.com/logout.php" ><button style="font-size: 120%;" class="btn btn-danger">Logout</button></a>
      </div>
   <div style="margin-top:2%; margin-bottom:15%;"><center><h1>Chameli Restaurant</h1></center></div>
   
        <div class="row" stlye="margin-bottom:10%;">
      <div class="col-sm-3" style="margin-top:2%;"> 
    <center><a href="http://chamelisales.com/employee.php"><button style="padding-left:10%; padding-right:10%; font-size: 150%;" class="btn btn-success">Daily Entry</button></a>
        </center></div>
      <div class="col-sm-3" style="margin-top:2%; ">
           <center><a href="http://chamelisales.com/catering.php"><Button  style="padding-left:10%; padding-right:10%;font-size: 150%;" class="btn btn-danger">New Catering</Button></a>
            </center></div>
    <div class="col-sm-3" style="margin-top:2%; ">
           <center><a href="http://chamelisales.com/showcatering.php"><Button  style="padding-left:10%; padding-right:10%;font-size: 150%;" class="btn btn-danger">Check Catering Orders</Button></a>
            </center></div>
      <div class="col-sm-3" style="margin-top:2%;">
          <center><a href="http://chamelisales.com/owner.php"><Button  style="padding-left:10%; padding-right:10%;font-size: 150%;" class="btn btn-info">View</Button></a>
      </center></div>
    
      </div>
    
  </div>     
</div>
<footer align="center" style="color:white;">
  <h4>Copyright © <?php echo date("Y"); ?> PentArray Inc. All rights reserved.</h4>
</footer>
</body>
</html>
