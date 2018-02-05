<?php
session_start();
if($_SESSION["auth"]=='false')
    {
      header("location:index.php");
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
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>
<body background="background.jpg" >

<div class="container-fluid">
    <div class="col-sm-6" ><a href="/update_info.php">
    <button style="font-size: 120%;" class="btn btn-danger">Home</button>
  </a></div>
    <div class="col-sm-6"  align="right">
    <a href="http://chamelisales.com/logout.php" ><button style="font-size: 120%;" class="btn btn-danger">Logout</button></a>
    </div>
  </div>
</div>


<div style="color:white;"class="container">
  <center><h2>View Report</h2></center>
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
            
                // $from = $_POST['from'];
                // $to = $_POST['to'];
                if (!empty($_POST))
                {
                  $from = $_POST['from'];
                  $to = $_POST['to'];
                }
                else
                { 
                $from = date('Y-m-d',strtotime("-2 days"));
                $to = date('Y-m-d',strtotime("-1 days"));
                }
//
//                $sql1 = "SELECT I.daily_date AS date,I.daily_time AS time, S.gross_sales, S.tax, S.total, S.difference
//                            FROM systemsales S, identity I
//                            WHERE S.sales_id = I.daily_id
//                            AND I.daily_date >= '$from'
//                            AND I.daily_date <= '$to'
//                            GROUP BY S.sales_id
//                            ORDER BY I.daily_date, I.daily_time;";
      $sql1 = "CALL custom_system_sales('$from','$to');";          
      $sql2 = "SELECT I.daily_date AS date, I.daily_time AS time, M.cash, M.credit, M.paid_out, M.uber, M.postmates, M.doordash, M.grubhub,M.eat_24, M.peach, M.desi_dine_2_go, M.others, M.total, M.tip_total
                        FROM manualsales M, identity I
                        WHERE M.manual_id = I.daily_id
                        AND I.daily_date >= '$from'
                        AND I.daily_date <= '$to'
                        GROUP BY M.manual_id
                        ORDER BY I.daily_date DESC, I.daily_time;";
                
                
                $sql3 = "SELECT SUM(S.gross_sales), SUM(S.tax), SUM(S.total), SUM(S.difference)
                            FROM systemsales S, identity I
                            WHERE S.sales_id = I.daily_id
                            AND I.daily_date >= '$from'
                            AND I.daily_date <= '$to';";
                $sql4 = "SELECT SUM(M.cash), SUM(M.credit), SUM(M.paid_out), SUM(M.uber), SUM(M.postmates), SUM(M.doordash), SUM(M.grubhub), SUM(M.eat_24), SUM(M.peach), SUM(M.desi_dine_2_go), SUM(M.others), SUM(M.total), SUM(M.tip_total)
                        FROM manualsales M, identity I
                        WHERE M.manual_id = I.daily_id
                        AND I.daily_date >= '$from'
                        AND I.daily_date <= '$to';";

//      $sql2 = "CALL custom_manual_sales('$from','$to');";
                
                $result3 = mysqli_query($conn,$sql3);
                $result4 = mysqli_query($conn,$sql4);
                $result2 = mysqli_query($conn,$sql2);
                $result1 = mysqli_query($conn,$sql1);
      
    
    ?>
    <?php
    echo "From : $from  ";
    echo " / ";
    echo "  To :  $to";    ?>

<button onclick="myFunction()" class="btn btn-success bt-lg" style="font-size: 140%;">Show Graph</button>

<div id="myDIV" class="container-fluid">
    <div class="col-sm-5" ><center><div id="piechart1" ></div></center>
  <center><div id="piechart2" ></div></center></div>
    <div class="col-sm-5" ><center><div id="piechart3" ></div></center>
  <center><div id="piechart4"></div></center></div>
  </div>
</div>
<script>
function myFunction() {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>
<div>
        <center><h2>Total System Sales</h2></center>
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>Gross_Sales</th>
        <th>Tax</th>
        <th>Total</th>
        <th>Difference</th>
      </tr>
    </thead>
    <tbody>
            <?php while($row1 = mysqli_fetch_array($result3)):;?>
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

    <div>
        <center><h2>Total Manual Sales</h2></center>
  <div class="table-responsive" style="display: none;">          
  <table class="table">
    <thead>
      <tr>
        <th>Cash</th>
        <th>Credit</th>
        <th>Paid_Out</th>
        <th>Uber</th>
        <th>Postmates</th>
        <th>Doordash</th>
        <th>Grubhub</th>
        <th>Eat24</th>
        <th>Peach</th>  
        <th>DD2G</th>
        <th>Others</th>
        <th>Total</th>
        <th>Total TIP</th>
      </tr>
    </thead>
    <tbody>
<center>
      <?php 
        $data = array();
        while($row2 = mysqli_fetch_array($result4)):;
                $data[] = $row; ?>
            <tr>
                <td><?php echo $row2[0];
                $v0 = $row2[0];?></td>
                <td><?php echo $row2[1];
                $v1 = $row2[1];?></td>
                <td><?php echo $row2[2];
                $v2 = $row2[2];?></td>
                <td><?php echo $row2[3];
                $v3 = $row2[3];?></td>
                <td><?php echo $row2[4];
                $v4 = $row2[4];?></td>
                <td><?php echo $row2[5];
                $v5 = $row2[5];?></td>
                <td><?php echo $row2[6];
                $v6 = $row2[6];?></td>
                <td><?php echo $row2[7];
                $v7 = $row2[7];?></td>
                <td><?php echo $row2[8];
                $v8 = $row2[8];?></td>
                <td><?php echo $row2[9];
                $v9 = $row2[9];?></td>
                <td><?php echo $row2[10];
                $v10 = $row2[10];?></td>
                <td><?php echo $row2[11];
                $v11 = $row2[11];?></td>
                <td><?php echo $row2[12];
                $v12 = $row2[12];?></td>
            </tr>
            <?php endwhile;?>
</center>
    </tbody>
  </table>
  </div>
    </div>
   

    <div class="container-fluid">
    <div class="col-sm-12" >
      <?php 
          echo "CASH : $ $v0"."<br>";
          echo "CREDIT : $ $v1"."<br>";
          echo "PAID OUT : $ $v2"."<br>";
          echo "UBER : $ $v3"."<br>";
          echo "POSTMATES : $ $v4"."<br>";
          echo "DOORDASH : $ $v5"."<br>";
          echo "GRUBHUB : $ $v6"."<br>";
          echo "EAT24 : $ $v7"."<br>";
          echo "PEACH : $ $v8"."<br>";
          echo "DESI DINE 2GO : $ $v9"."<br>";
          echo "OTHERS : $ $v10"."<br>";
          echo "TOTAL : $ $v11"."<br>";
          echo "TOTAL TIP : $ $v12"."<br>"; 
      ?>
    </div>
    
  </div>
</div>
  <div style="margin-top:5%;">
    <div style="background-color:#20B2AA;">
        <center><h2>System Sales</h2></center>
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>Date</th>
        <th>Time</th>
        <th>Gross_Sales</th>
        <th>Tax</th>
        <th>Total</th>
        <th>Difference</th>
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
            </tr>
            <?php endwhile;?>
    </tbody>
  </table>
  </div>
    </div>
      
      
      

      
      
      
      
      
      
      
<div style="background-color:#006994; color:#ffffff;">
        <center><h2>Manual Sales</h2></center>
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>Date</th>
        <th>Time</th>
        <th>Cash</th>
        <th>Credit</th>
        <th>Paid_Out</th>
        <th>Uber</th>
        <th>Postmates</th>
        <th>Doordash</th>
        <th>Grubhub</th>
        <th>Eat24</th>
        <th>Peach</th>  
        <th>DD2G</th>
        <th>Others</th>
        <th>Total</th>
        <th>Total TIP</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row2 = mysqli_fetch_array($result2)):;?>
            <tr>
                <td><?php echo $row2[0];?></td>
                <td><?php echo $row2[1];?></td>
                <td><?php echo $row2[2];?></td>
                <td><?php echo $row2[3];?></td>
                <td><?php echo $row2[4];?></td>
                <td><?php echo $row2[5];?></td>
                <td><?php echo $row2[6];?></td>
                <td><?php echo $row2[7];?></td>
                <td><?php echo $row2[8];?></td>
                <td><?php echo $row2[9];?></td>
                <td><?php echo $row2[10];?></td>
                <td><?php echo $row2[11];?></td>
                <td><?php echo $row2[12];?></td>
                <td><?php echo $row2[13];?></td>
                <td><?php echo $row2[14];?></td>
            </tr>
            <?php endwhile;?>
    </tbody>
  </table>
  </div>
    </div>
      
      
      
      
    </div>
    </div>
    </div>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data1 = google.visualization.arrayToDataTable([
          
          ['Task', 'Hours per Day'],
          ['Cash',     <?php echo $v0 ?>],
          ['Credit',     <?php echo $v1 ?>]
          
        ]);

        var options1 = {
          title: '<?php
   echo "        From : $from          ";
   echo "        To :  $to            ";      ?>
    CASH vs CREDIT'
        };

        var data2 = google.visualization.arrayToDataTable([
          
          ['Task', 'Hours per Day'],
          ['Uber',     <?php echo $v3 ?>],
          ['Postmates',     <?php echo $v4 ?>],
          ['DoorDash',     <?php echo $v5 ?>],
          ['Peach',     <?php echo $v8 ?>],
          ['DD2G',     <?php echo $v9 ?>]
          
        ]);

        var options2 = {
          title: '<?php
    echo "        From : $from          ";
    echo "        To :  $to            ";    ?>
    ONLINE FOOD PICKUP SERVICE'
        };

        var data3 = google.visualization.arrayToDataTable([
          
          ['Task', 'Hours per Day'],
          ['PaidOut',     <?php echo $v2 ?>],
          ['Others',     <?php echo $v10 ?>]
          
        ]);

        var options3 = {
          title: '<?php
    echo "        From : $from          ";
    echo "        To :  $to            ";    ?>
    PaidOut vs Others.  Note: Prior to November 2017, "Others" include all the online orders'
        };

        var data4 = google.visualization.arrayToDataTable([
          
          ['Task', 'Hours per Day'],
          ['Total Tip',     <?php echo $v12 ?>],
          ['Total Sale',     <?php echo $v11 ?>]
          
        ]);

        var options4 = {
          title: '<?php
    echo "        From : $from          ";
    echo "        To :  $to            ";    ?>
    Total Tip vs Total Sale'
        };

        var chart1 = new google.visualization.PieChart(document.getElementById('piechart1'));

        chart1.draw(data1, options1);

        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart2.draw(data2, options2);

        var chart3 = new google.visualization.PieChart(document.getElementById('piechart3'));

        chart3.draw(data3, options3);

        var chart4= new google.visualization.PieChart(document.getElementById('piechart4'));

        chart4.draw(data4, options4);
      }
    </script>  
    
    <footer align="center" style="color:white;">
  <h4>Copyright © <?php echo date("Y"); ?> PentArray Inc. All rights reserved.</h4>
</footer>
</body>
</html>
