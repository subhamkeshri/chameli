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
  <title>Chameli  Restaurant</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body background="background.jpg">
    <script>
        
    function hide(){
var earrings = document.getElementById('earringstd');
earrings.style.visibility = 'hidden';
}

function show(){
var earrings = document.getElementById('earringstd');
earrings.style.visibility = 'visible';
}
    
    function genderSelectHandler(select){
if(select.value == ''){
show();
}else {
hide();
}}
    </script>
    
    
    
    <div align="right" style="margin-right:5%;">
<h1 style="color:white;">
    <?php
        echo $_SESSION["name"];
    ?>
    </h1>
<a href="http://chamelisales.com/logout.php" ><button style="font-size: 120%;" class="btn btn-danger">Logout</button></a>
</div>
<a href="/update_info.php" class="btn btn-danger">
          						<span class="glyphicon glyphicon-home"></span> Home
        						</a>
<div class="container">
  <div class="jumbotron">
    <div align="right" style="fontsize:50%;">
        <h3><?php
            $user = $_SESSION["user_id"];
      ?></h3>
        
      </div>
   <center><h1>Chameli Restaurent</h1></center>  
   <center><?php 
       $_SESSION["tiperror"] ="";
       echo $_SESSION["tiperror"];
       ?> </center>
      
   <form method="post">
       <label for="ID" style="width:35%; font-size: 15pt;">Name :</label>
            <select id="user" name="user" style="font-size: 15pt; height: 50px; width:50%; color:black;">
                <option value="1505">Tasnim Khan</option>
                <option value="1506">Subham Keshri</option>
                <option value="3030">Shrishak</option>
                <option value="6633">Prajjwol</option>
                <option value="1122">Marcelo</option>
                <option value="1133">Miguel Cabrera</option>
            </select>
            <br>
          <label for="tip" style="width:35%; font-size: 15pt;">Tip :</label> <input type="number" step="any" id="ptip" style="font-size: 15pt; height: 50px; width:50%; color:black;" name="ptip" required>
          <center><input type="submit" class="btn btn-danger btn-lg" style="color:black; margin-top:2%;" style="font-size: 120%;"></center>
      
          </form>
      <div align="right">
          <a href="/frontpage.php" ><input type="submit"  value="Done" class="btn btn-success btn-lg" style="color:black; margin-top:2%;" style="font-size: 120%;"></a></div>
      <h3><?php
            $tip = $_POST['ptip'];
            $user = $_POST['user'];
            echo "$user,$tip";
      ?></h3>
  </div>     
</div>
<?php
if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        echo "conn. err";
        }
$tip = $_POST['ptip'];
$user = $_POST['user'];
    echo "$tip,$user";

if(isset($_POST['ptip']))
    {
            $sql = "CALL tip_entry('$user','$tip')";
            $result = mysqli_query($conn,$sql);
            echo "testing";
    }
    else
    {
        echo "not testing";    
    }
         mysqli_close($conn);
?>
    <footer align="center" style="color:white;">
  <h4>Copyright © <?php echo date("Y"); ?> PentArray Inc. All rights reserved.</h4>
</footer>
</body>
</html>
