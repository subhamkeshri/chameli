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
  <title>Chameli Restaurant</title>
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
    <a href="http://chamelisales.com/logout.php" ><button style="font-size: 120%;" class="btn btn-danger">Logout</button></a>
</div>
<a href="/update_info.php" class="btn btn-danger">
          						<span class="glyphicon glyphicon-home"></span> Home
        						</a>
<div style="color:white;"class="container">
  <center><h2>Catering Details</h2></center>
  <div class="row" stlye="margin-bottom:10%;">
    <form method="post" style="margin-top:2%; margin-bottom:2%;">
  <div class="col-sm-4" style="margin-top:2%;">
       <label for="from" style="width:35%; font-size: 120%;">From :</label>
  <input style="font-size: 120%; height: 40px; width:50%; color:black;" type="date" name="from" required>
        </div>
  <div class="col-sm-4" style="margin-top:2%;">
  <label for="to" style="width:35%; font-size: 120%;">To :</label>
  <input style="font-size: 120%; height: 40px; width:50%; color:black;" type="date" name="to" required>
  </div>
  <div class="col-sm-4" style="margin-top:2%;">      
        <center><Button class="btn btn-success bt-lg" type="submit" style="font-size: 140%;" >Submit</Button></center>
        </div>
</form>
      
      <div style="padding:1%;">
      </div>
    <?php
    
                $sql1 = "SELECT M.daily_date AS delivery_date, M.daily_time AS delivery_time, M.name, M.contact_number, M.address, M.delivery, M.price, M.advance, M.due,M.note
                        FROM catering M
                        WHERE I.daily_date >= '$from'
                        AND I.daily_date <= '$to'
                        ORDER BY I.daily_date, I.daily_time;";
                $result1 = mysqli_query($conn,$sql1);
      
    
    ?>
  <div style="margin-top:5%;">
    <div style="background-color:#20B2AA;">
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>Delivery Date</th>
        <th>Delivery Time</th>
        <th>Name</th>
        <th>Contact</th>
        <th>Address</th>
        <th>Order Type</th>
        <th>Price</th>
        <th>Advance</th>
        <th>Due</th>
        <th>Note</th>
      </tr>
    </thead>
    <tbody>
            <?php while($row1 = mysqli_fetch_array($result1)):;?>
            <tr>
                <td><?php echo $row1[0];?></td>
                <td><?php echo $row1[1];?></td>
                <td><?php echo $row1[2];?></td>
                <td><?php echo $row1[3];?></td>
                <td><?php echo $row1[4];?></td>
                <td><?php echo $row1[5];?></td>
                <td><?php echo $row1[6];?></td>
                <td><?php echo $row1[7];?></td>
                <td><?php echo $row1[8];?></td>
                <td><?php echo $row1[9];?></td>
            </tr>
            <?php endwhile;?>
    </tbody>
  </table>
  </div>
    </div>
    </div>
    </div>
    </div>
    <footer align="center" style="color:white;">
  <h4>Copyright © <?php echo date("Y"); ?> PentArray Inc. All rights reserved.</h4>
</footer>
</body>
</html>
