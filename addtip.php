<?php
session_start();
$_SESSION["tip"]="true";
if($_SESSION["name"]=="")
    {
      header("location:index.php");
    }
if($_POST['gsales']=="")
    {
      header("location:error.php");
      $_SESSION["daily"]="Enter the Daily Sales First!!";
    }
require 'db.php';
if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
$_SESSION["daily"]="";
$tip = $_POST['ptip'];
$user = $_POST['user'];
$x=0;

if(x==0)
        {
          $sql = "CALL tip_entry('$user','$tip')";
            $result = mysqli_query($conn,$sql);
            $x=1;
            header("location:tip.php");
      }
         mysqli_close($conn);
if($x==0)
    {
    $_SESSION["tiperror"]="ERROR!!!   Tip Has Already Been Added For This User 
OR
You have not Entered the daily sales yet.!!!"; 
    header("location:tip.php");
}
?>