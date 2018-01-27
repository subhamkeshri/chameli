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
<div style="color:white;"class="container">
  <center><h2>Employee Information</h2></center>
  <div class="row" stlye="margin-bottom:10%;">
   
      
      <div style="padding:1%;">
      </div>
    <?php
                $user = $_POST['user'];
                $from = $_POST['from'];
                $to = $_POST['to'];
                $sql1 = "SELECT I.daily_date AS date,I.daily_time AS time, S.gross_sales, S.tax, S.total, S.difference
                            FROM systemsales S, identity I
                            WHERE S.sales_id = I.daily_id
                            AND I.daily_date >= '$from'
                            AND I.daily_date <= '$to'
                            GROUP BY S.sales_id
                            ORDER BY I.daily_date, I.daily_time;";
                $sql2 = "SELECT I.daily_date AS date, I.daily_time AS time, M.cash, M.credit, M.paid_out, M.uber, M.postmates, M.doordash, M.grubhub,M.eat_24, M.peach, M.desi_dine_2_go, M.others, M.total, M.tip_total
                        FROM manualsales M, identity I
                        WHERE M.manual_id = I.daily_id
                        AND I.daily_date >= '$from'
                        AND I.daily_date <= '$to'
                        GROUP BY M.manual_id
                        ORDER BY I.daily_date, I.daily_time;";
                $sql3 = "SELECT SUM(S.gross_sales), SUM(S.tax), SUM(S.total), SUM(S.difference)
                            FROM systemsales S, identity I
                            WHERE S.sales_id = I.daily_id
                            AND I.daily_date >= '$from'
                            AND I.daily_date <= '$to';";
                $sql4 = "CALL Tip_total_between('$user','$from','$to')";
                $sql5 = "SELECT name,employee_pin,contact_number,level
                        FROM employee;";
                $result1 = mysqli_query($conn,$sql1);
                $result2 = mysqli_query($conn,$sql2);
                $result3 = mysqli_query($conn,$sql3);
                
                $result5 = mysqli_query($conn,$sql5);
                $result4 = mysqli_query($conn,$sql4);
      
    
    ?>
  <div style="margin-top:5%;">
      
    
   
    <div style="background-color:#20B2AA; margin-top:3%;">
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Pin</th>
        <th>Contact</th>
        <th>Level</th>
      </tr>
    </thead>
    <tbody>
            <?php while($row1 = mysqli_fetch_array($result5)):;?>
            <tr>
                <td><?php echo $row1[0];?></td>
                <td><?php echo $row1[1];?></td>
                <td><?php echo $row1[2];?></td>
                <td><?php echo $row1[3];?></td>
            </tr>
            <?php endwhile;?>
    </tbody>
  </table>
  </div>
    </div>
      
    </div>
        
       <form method="post" style="margin-top:2%; margin-bottom:2%;">
        <div class="col-sm-3" style="margin-top:2%;">
            <label for="ID" style="width:35%; font-size: 140%;">Name :</label>
            <select id="user" name="user" style="font-size: 120%; height: 40px; width:50%; color:black;">
                <option value="1505">Tasnim Khan</option>
                <option value="1506">Subham Keshri</option>
                <option value="3030">Shrishak</option>
                <option value="6633">Prajjwol</option>
                <option value="1122">Marcelo</option>
                <option value="1133">Miguel Cabrera</option>
            </select>
        </div>
  <div class="col-sm-3" style="margin-top:2%;">
       <label for="from" style="width:35%; font-size: 120%;">From :</label>
  <input style="font-size: 100%; height: 40px; width:50%; color:black;" type="date" name="from" required>
        </div>
  <div class="col-sm-3" style="margin-top:2%;">
  <label for="to" style="width:35%; font-size: 120%;">To :</label>
  <input style="font-size: 100%; height: 40px; width:50%; color:black;" type="date" name="to" required>
  </div>
  <div class="col-sm-3" style="margin-top:2%;">      
        <center><Button class="btn btn-success bt-lg" type="submit" style="font-size: 140%;" >Check Tips</Button></center>
        </div>
</form>
      <div style="padding:5%;"></div>
       <div style="padding:1%;">
    <center><label for="TotalTip" style="width:35%;  font-size: 150%; background-color:#20B2AA;">Total Tip : </label>
    
            <?php while($row1 = mysqli_fetch_array($result4)):;?>
            
                <label for="TotalTip" style="width:35%; font-size: 150%; background-color:#20B2AA;"><?php echo $row1[0];?></label>

            
            <?php endwhile;?>
        </center>
        </div>
    </div>
    </div>
    <footer align="center" style="color:white;">
  <h4>Copyright © <?php echo date("Y"); ?> PentArray Inc. All rights reserved.</h4>
</footer>
</body>
</html>
