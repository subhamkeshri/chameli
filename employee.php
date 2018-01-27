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
<a href="http://chamelisales.com/logout.php" ><button style="font-size: 120%;" class="btn btn-danger">Logout</button></a>
</div>
<a href="/index.php" class="btn btn-danger btn">
          						<span class="glyphicon glyphicon-home"></span> Home
        						</a>
    
    <center><img src="Clogo.jpg"  style="margin-bottom:1%;" width="20%" height="10%"></center>
<div style="color:white;"class="container">
  <center><h1>Enter Today's Sale</h1></center>
  <div class="row" >
    <form method="post" name="Form" onSubmit="return confirm('Are you sure you want to Submit?');">
    <div class="col-sm-4" style="background-color:#40DEB8;">
        <center><h1>System Sales</h1></center>
        
     <div class="form-group">
         <label for="Gsales" style="width:35%; font-size: 120%;">Date :</label><span class="glyphicon glyphicon-calendar" style="color:white;"></span><input type="date" style="font-size: 120%; height: 40px; width:60%; color:black;" id="date" value="<?php echo date('Y-m-d'); ?>" name="date" required>
    </div>   
    <div class="form-group">
        <label for="Gsales" style="width:35%; font-size: 120%;">Gross Sale :</label><span class="glyphicon glyphicon-usd" style="color:white;"></span><input type="number" step="any" style="font-size: 120%; height: 50px; width:60%; color:black;" placeholder="0.00" name="gsales" required> 
    </div>
     <div class="form-group">
      <label for="tax" style="width:35%; font-size: 120%;">Tax :</label><span class="glyphicon glyphicon-usd" style="color:white;"></span><input type="number" step="any" id="tax" style="font-size: 120%; height: 50px; width:60%; color:black;"  placeholder="0.00" name="tax" required>
    </div>
        <div class="form-group">
        <textarea rows="4" cols="50"  id="note" style="font-size: 120%; height: 185px; width:100%; color:black;"  name="note" placeholder="Enter any Note here about today's sale..."></textarea>
    </div>
    </div>
    <div class="col-sm-8" style="background-color:#40A9DE;">
        <div class="row" stlye="margin-bottom:3%;">
            <center><h1>Manual Sales</h1></center>
            <div class="col-sm-6" >
    <div class="form-group">
      <label for="cash" style="width:35%; font-size: 120%;">Cash :</label><span class="glyphicon glyphicon-usd" style="color:white;"></span><input type="number" step="any" style="font-size: 120%; height: 50px; width:50%; color:black;" id="cash" size="10" placeholder="0.00" name="cash" required>
    </div>
    <div class="form-group">
      <label for="credit" style="width:35%; font-size: 120%;">Credit :</label><span class="glyphicon glyphicon-usd" style="color:white;"></span><input type="number"  step="any" style="font-size: 120%; height: 50px; width:50%; color:black;" id="credit" size="10" placeholder="0.00" name="credit" required>
    </div>
    <div class="form-group">
      <label for="Paid_Out" style="width:35%; font-size: 120%;">Paid Out :</label><span class="glyphicon glyphicon-usd" style="color:white;"></span><input type="number" step="any" style="font-size: 120%; height: 50px; width:50%; color:black;" id="paid_out" size="10" placeholder="0.0" name="paidout" value="0.00" required>
    </div>
    <div class="form-group">
      <label for="uber" style="width:35%; font-size: 120%;">Uber :</label><span class="glyphicon glyphicon-usd" style="color:white;"></span><input type="number" step="any" id="uber" style="font-size: 120%; height: 50px; width:50%; color:black;" size="10" placeholder="0.0" name="uber" value="0.00" required>
    </div>
    <div class="form-group">
        <label for="postmates" style="width:35%; font-size: 120%;">Postmates :</label><span class="glyphicon glyphicon-usd" style="color:white;"></span><input type="number" step="any" style="font-size: 120%; height: 50px; width:50%; color:black;" id="postmates" size="10" placeholder="0.0" value="0.00" name="postmates" required>
    </div>
    <div class="form-group">
      <label for="doordash" style="width:35%; font-size: 120%;">Doordash :</label><span class="glyphicon glyphicon-usd" style="color:white;"></span><input type="number" step="any" style="font-size: 120%; height: 50px; width:50%; color:black;" id="doordash" size="10" placeholder="0.0" name="doordash" value="0.00" required>
    </div>
        </div>
            <div class="col-sm-6" >
    <div class="form-group">
      <label for="grubhub" style="width:35%; font-size: 120%;">Grubhub :</label><span class="glyphicon glyphicon-usd" style="color:white;"></span><input type="number" step="any" style="font-size: 120%; 15pt; height: 50px; width:50%; color:black;" id="grubhub" size="10" placeholder="0.0" name="grubhub" value="0.00" required>
    </div>
    <div class="form-group">
      <label for="eat24" style="width:35%; font-size: 120%;">Eat24 :</label><span class="glyphicon glyphicon-usd" style="color:white;"></span><input type="number" step="any" style="font-size: 120%; height: 50px; width:50%; color:black;" id="eat24" size="10" placeholder="0.0" name="eat24" value="0.00" required>
    </div>
    <div class="form-group">
      <label for="dd2g" style="width:35%; font-size: 120%;">DD2G :</label><span class="glyphicon glyphicon-usd" style="color:white;"></span><input type="number" step="any" style="font-size: 120%; height: 50px; width:50%; color:black;" id="dd2g" size="10" placeholder="0.0" name="dd2g" value="0.00" required>
    </div>
    <div class="form-group">
      <label for="Peach" style="width:35%; font-size: 120%;">Peach :</label><span class="glyphicon glyphicon-usd" style="color:white;"></span><input type="number" step="any" id="peach" style="font-size: 120%; height: 50px; width:50%; color:black;" size="10" placeholder="0.0" name="peach" value="0.00" required>
    </div>
    <div class="form-group">
      <label for="others" style="width:35%; font-size: 120%;">Others :</label><span class="glyphicon glyphicon-usd" style="color:white;"></span><input type="number" step="any" id="others" style="font-size: 120%; height: 50px; width:50%; color:black;" size="10" placeholder="0.0" name="others" value="0.00" required>
    </div>
    </div>
        </div>
        </div>
         <div class="col-sm-12" style="color:white; margin-top:2%;">
        <center><Button type="Submit" class="btn btn-success" style="font-size: 250%;">Submit</Button></center>
    </div>
  </form>
      <?php
      if(isset($_POST['gsales']))
      { ?>
      <br>
      <center><?php echo " Daily Sales Added Successfully" ?></center>
      <a href="/tip.php"><Button type="Submit" class="btn btn-info" style="font-size: 150%; margin-top:1%;">Add Tip</Button></a>
     <?php }
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
        else
      
      if(isset($_POST['gsales']))
        {
            $entrydate = $_POST['date'];
            $note = $_POST['note'];
            $gsales = $_POST['gsales'];
            $tax = $_POST['tax'];
            $cash = $_POST['cash'];
            $credit = $_POST['credit'];
            $paidout = $_POST['paidout'];
            $uber = $_POST['uber'];
            $postmates = $_POST['postmates'];
            $doordash = $_POST['doordash'];
            $grubhub = $_POST['grubhub'];
            $eat24 = $_POST['eat24'];
            $dd2g = $_POST['dd2g'];
            $peach = $_POST['peach'];
            $others = $_POST['others'];
            $user = $_POST['user'];
            $tip = $_POST['ptip'];
            $user = $_SESSION["name"];
            $stotal = $gsales + $tax;
            $mtotal = $cash + $credit + $paidout + $uber + $postmates + $doordash + $grubhub + $eat24 + $dd2g + $peach + $others ;
            $diff = $mtotal - $stotal;
            $sql = "CALL daily_entry('$entrydate','$note','$gsales','$tax','$cash','$credit','$paidout','$uber','$postmates','$doordash','$grubhub','$eat24','$peach','$dd2g','$others')";
            $result = mysqli_query($conn,$sql);
//            echo "$entrydate";
//            echo " Daily Sales Added Successfully";
//            $msg = "Today's Sale \n Date : '$entrydate' \n Gross Sale : '$gsales' \n Tax : '$tax' \n Cash : '$cash' \n Credit : '$credit' \n Paid Out : '$paidout' \n Uber : '$uber' \n Postmates : '$postmates' \n Doordash : '$doordash' \n Grubhub : '$grubhub' \n Eat24 : '$eat24' \n Desi Dine Togo : '$dd2g' \n Peach : '$peach' \n Others : '$others'\n \n Note : '$note'";
//
//            // use wordwrap() if lines are longer than 70 characters
//            $msg = wordwrap($msg,70);,tajzz5@yahoo.com
//
//            // send email
//            mail("admin@pentarray.com","Daily Sales for '$entrydate'",$msg);
            $to = "science183@gmail.com,tajzz5@yahoo.com";

$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<center><h1> Daily Sales Report</h1></center>
<h3>Date : $entrydate</h3>
<h3>Gross Sale : $$gsales | Tax : $$tax</h3>
<h3>Total : $stotal</h3>
<h3>Cash : $$cash | Credit : $$credit</h3>
<h3>Paid Out : $$paidout </h3>
<h3>Postmates : $$postmates | Uber : $$uber</h3>
<h3>Eat24 : $$eat24 | Grubhub : $$grubhub</h3>
<h3>Doordash : $$doordash | Peach : $$peach</h3>
<h3>Desi Dine 2go : $$dd2g | Others : $$others</h3>
<h3>Total : $mtotal </h3>
<h3>Difference : $diff</h3>
<h3>Note : $note</h3>
<h4>Closed by: $user</h4>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

mail($to,"Daily Sales Report : '$entrydate'",$message,$headers);
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