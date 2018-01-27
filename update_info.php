<?php
session_destroy();
?>
<?php
session_start();
$_SESSION["auth"]="false";
$host = 'localhost';
$user = 'chamelis_203';
$pass = 'pentarraychameli203';
$db = 'chamelis_accounts';
$conn = mysqli_connect($host,$user,$pass,$db) or die($mysqli->error);
$_SESSION["error"]="Success";
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
					<center>
						<img src="Clogo.png"  style="margin-top:2%; margin-bottom:2%;" width="30%" height="15%">
						</center>
						<div class="container">
							<div class="jumbotron">
								<center>
									<h1>Chameli Restaurant</h1>
								</center>
								<form method="post" >
									<center>
										<input style="width:30%; margin-bottom:2%; font-size: 120%;" type="password" placeholder="Manager Code"  class="form-control" name="userid" required>
										</center>
										<center>
											<input type="submit" class="btn btn-danger bt-lg" style="width:30%; margin-bottom:2%;" value="Log In">
											</center>
										</form>
										<span class="glyphicon glyphicon-info-sign" style="color:green;"></span>
										<?php
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
        else
        echo "Connected.";
    ?>
										<br>
											<h4>
												<?php  

        if(isset($_POST['userid']))
        {
            // Set session variables
            $id = $_POST['userid'];
            $x=0;
            $_SESSION["userid"] = $_POST['userid'];
            echo "$test";
            $sql="SELECT name from user_id Where id = '$id'";
            $result = mysqli_query($conn,$sql);
            if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
               echo "\n Hello,  \n " . $row["name"]. "
												<br>";
               if($x==0)
               {
                  $username = $row["name"];
				  $x=1;
				  $_SESSION["auth"]="true";
               }
               
            }
                $_SESSION["name"]= $username;?>
												</h4>
												<div class="row" stlye="margin-bottom:10%;">
                                                    <div class="col-sm-4" style="margin-top:2%; ">
														<center>
															<a href="http://chamelisales.com/owner.php">
																<Button  style="font-size: 90%; width:100%;" class="btn btn-success">View Report</Button>
															</a>
														</center>
													</div>
                                                    <div class="col-sm-4" style="margin-top:2%; ">
														<center>
															<a href="http://chamelisales.com/showcatering.php">
																<Button  style="font-size: 90%; width:100%;" class="btn btn-success">View Catering</Button>
															</a>
														</center>
													</div>
                                                    <div class="col-sm-4" style="margin-top:2%; ">
														<center>
															<a href="http://chamelisales.com/timing.php">
																<Button  style="font-size: 90%; width:100%;" class="btn btn-success">View Employee Hours</Button>
															</a>
														</center>
													</div>
                                                    
                                                    
												</div>
                                
                                                <div class="row" stlye="margin-bottom:10%;">
                                                   
                                                    <div class="col-sm-4" style="margin-top:2%;">
                                                          <center><a href="http://chamelisales.com/employeeinfo.php"><Button  style="font-size: 90%; width:100%;" class="btn btn-primary">Employee Info</Button></a>
                                                            </center></div>
													<div class="col-sm-4" style="margin-top:2%;">
														<center>
															<a href="http://chamelisales.com/timing.php">
																<Button  style="font-size: 90%; width:100%;" class="btn btn-primary">Edit Daily Sales</Button>
															</a>
														</center>
													</div>
													<div class="col-sm-4" style="margin-top:2%; ">
														<center>
															<a href="http://chamelisales.com/timing.php">
																<Button  style="font-size: 90%; width:100%;" class="btn btn-primary">Edit Catering Order</Button>
															</a>
														</center>
													</div>
                                                    
												</div>
												<div align="right" >
													<a href="http://chamelisales.com/logout.php" >
														<button style="font-size: 120%; margin-top:2%;" class="btn btn-danger">Logout</button>
													</a>
												</div>
												<?php
         } else {
            echo "User Not Found";
         }
         mysqli_close($conn);
        }
       
      
    ?>
</div>
</div>
<center><br>
<label style="color:white;">Powered By</label>
<img src="p_logo.png"  style="margin-top:2%; margin-bottom:2%;" width="10%" height="5%"></center>
<footer align="center" style="color:white;">
  <h4>Copyright © <?php echo date("Y"); ?> PentArray Inc. All rights reserved.</h4>
</footer>
</body>
</html>
