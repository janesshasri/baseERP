<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['partyname']))
{
	
   // $custype=$_POST['custype'];//same
    $partyname = $_POST['partyname'];//same
	//$compcode=$_POST['compcode'];

   $check_partyname_query="select partyname from partyname WHERE partyname='$partyname'";
    $run_query=mysqli_query($dbcon,$check_partyname_query);
	if(mysqli_num_rows($run_query)>0)
    {
		echo '0';
      
        exit();
    }
   //$image =base64_encode($image);														
	$insert_partyname="INSERT INTO partyname(`partyname`) 
	VALUES ('$partyname')";													    
	//echo "$insert_partyname";
	
	if(mysqli_query($dbcon,$insert_partyname))
	{
		echo 	$partyname;
		//echo "<script>alert('User Group creation Successful ')</script>";
		//header("location:addUsers.php");
    } else {
		echo '0';
		exit; //echo "<script>alert('User creation unsuccessful ')</script>";
	}
	
}
?>