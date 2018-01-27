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
<h1 style="color:white;">
    <?php
        echo $_SESSION["name"];
    ?>
    </h1>
<h4 style="color:white;">
     <?php
        echo $_SESSION["error"];
    ?>
    </h4>
<a href="http://chamelisales.com/logout.php" ><button style="font-size: 120%;" class="btn btn-danger">Logout</button></a>
</div>
<a href="/index.php" class="btn btn-danger">
          						<span class="glyphicon glyphicon-home"></span> Home
        						</a>
<div style="color:white;"class="container">
  <center><h1>Enter Catering Details</h1></center>
    <div class="row" stlye="margin-bottom:10%;">
    <div class="col-sm-12" style="margin-top:2%; ">
           <center><a href="http://chamelisales.com/showcatering.php"><Button  style="padding-left:10%; padding-right:10%;font-size: 150%;" class="btn btn-danger">Check Catering Orders</Button></a>
            </center></div>
      </div>
  <div class="row" stlye="margin-bottom:3%;">
    <form method="post">
        <center>
    <div class="form-group" style="width:35%; font-size: 200%; margin-top:2%;">
      <input type="radio" name="delivery" value="1" checked="checked"> Delivery  
      <input type="radio" name="delivery" value="0"> Pickup<br>
    </div>
    <div class="col-sm-6" style="background-color:#40A9DE; margin-top:2%;">
    
        <div class="form-group" style="margin-top:2%;" >
      <label for="Delivery_date" style="width:35%; font-size: 120%;">Delivery Date :</label><span class="glyphicon glyphicon-calendar" style="color:white;"></span> <input type="date" style="font-size: 120%; height: 40px; width:50%; color:black;" id="date"  name="date" required>
    </div>
    <div class="form-group" >
      <label for="name" style="width:35%; font-size: 120%;">Name :</label><span class="glyphicon glyphicon-user" style="color:white;"></span> <input type="text" style="font-size: 120%; height: 40px; width:50%; color:black;" id="name" name="name" required>
        
    </div>   
    
    <div class="form-group" >
      <label for="Price" style="width:35%; font-size: 120%;">Price :</label><span class="glyphicon glyphicon-usd" style="color:white;"></span> <input type="number" style="font-size: 120%; height: 40px; width:50%; color:black;" id="price" name="price" required>
    
    </div>
    <div class="form-group" >
      <label for="Address" style="width:35%; font-size: 120%;"></label><span class="glyphicon glyphicon-home" style="color:white;"></span> <textarea rows="3" cols="50" id="address" style="font-size: 120%; height: 30%; width:50%; color:black;" name="address" placeholder="Delivery Address...."></textarea>
        
    </div>
    </div>
    
    <div class="col-sm-6" style="background-color:#40A9DE; margin-top:2%;">
    
        <div class="form-group"  style="margin-top:2%;" >
            <label for="Delivery_time" style="width:35%; font-size: 120%;">Delivery Time :</label><span class="glyphicon glyphicon-time" style="color:white;"></span> <input type="time" style="font-size: 120%; height: 40px; width:50%; color:black;" id="time"  name="time" required>
    </div>
    <div class="form-group" >
        <label for="Contact_number" style="width:35%; font-size: 120%;">Contact Number :</label><span class="glyphicon glyphicon-earphone" style="color:white;"></span> <input type="text" style="font-size: 120%; height: 40px; width:50%; color:black;" id="number" name="number" required>
    </div>   
    
    <div class="form-group" >
        <label for="Advance" style="width:35%; font-size: 120%;">Advance :</label><span class="glyphicon glyphicon-usd" style="color:white;"></span> <input type="number" style="font-size: 120%; height: 40px; width:50%; color:black;" id="advance" name="advance" value="0" required>
    </div>
    <div class="form-group" >
        <label for="Note" style="width:35%; font-size: 120%;"></label><span class="glyphicon glyphicon-pencil" style="color:white;"></span> <textarea rows="3" cols="50" style="font-size: 120%; height: 40%; width:50%; color:black;" id="note" name="note" placeholder="Additional Information......."></textarea>
    </div>    
    </div>
            <div class="form-group" >
            <div class="col-sm-12" style="color:white">
        <center><Button type="submit"  class="btn btn-default bt-lg" style="margin-top:2%;font-size: 150%;">Submit</Button></center>
    </div>
        </div>
        </center>
  </form>
      <?php
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
            
      
      if(isset($_POST['name']))
        {
            $Name = $_POST['name'];
            $Delivery_Date = $_POST['date'];
            $Delivery_Time = $_POST['time'];
            $Contact_Number= $_POST['number'];
            $Address = $_POST['address'];
            $Delivery = $_POST['delivery'];
            $Price = $_POST['price'];
            $Advance = $_POST['advance'];
            $Note = $_POST['note'];
            $user = $_SESSION["name"];
          $sql = "CALL catering_entry('$Name','$Delivery_Date','$Delivery_Time','$Contact_Number','$Address','$Delivery','$Price','$Advance','$Note')";
            $result = mysqli_query($conn,$sql);
          ?>
           <center><h2><?php echo "ORDER SAVED SUCCESSFULLY." ?></h2></center> 
            <?php
          
          if($Delivery == 1)
              $type = "Order Type : Delivery";
          else
              $type = "Order Type : Pickup";
          
          
//          $msg = "DELIVERY CONFIRMATION \n Name : '$Name' \n Delivery Date : '$Delivery_Date' \n Delivery Time : '$Delivery_Time' \n Contact Number : '$Contact_Number' \n Address : '$Address' \n Delivery (1 = True) : '$Delivery' \n Price : '$Price' \n Advance : '$Advance' \n Note : '$Note'";
//
//          // use wordwrap() if lines are longer than 70 characters
//          $msg = wordwrap($msg,70);

          // send email
          
//          mail("totasnimkhan@gmail.com","ORDER for '$Name'",$msg);
//          mail("tajzz5@yahoo.com","ORDER for '$Name'",$msg);
//          
          
          
          ///////////////////////////////////////////////////////////////////////
          

$to = "science183@gmail.com,tajzz5@yahoo.com";

$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<center><h1> Catering Order Confirmation</h1></center>
<h2>$type</h2>
<h3>Name : $Name</h3>
<h3>Delivery Date : $Delivery_Date</h3>
<h3>Delivery Time : $Delivery_Time</h3>
<h3>Phone : $Contact_Number</h3>
<h3>Address : $Address</h3>
<h3>Price :  $$Price</h3>
<h3>Advance : $$Advance</h3>
<h3>Note : $Note</h3>
<h4>Entered by: $user</h4>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

mail($to,"ORDER for '$Name'",$message,$headers);

          
          ///////////////////////////////////////////////////////////////////////
          
          
          
          
          
          
          
          
          
       }
    
         mysqli_close($conn);
    ?>
</div>
    </div>
    <footer align="center" style="color:white;">
  <h4>Copyright © <?php echo date("Y"); ?> PentArray Inc. All rights reserved.</h4>
</footer>
    </body>
</html>