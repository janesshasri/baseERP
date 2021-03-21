<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['custype']))
{
	
    $custype=$_POST['custype'];//same
    $description = $_POST['description'];//same
	//$compcode=$_POST['compcode'];

   $check_custype_query="select custype from custype WHERE custype='$custype'";
    $run_query=mysqli_query($dbcon,$check_custype_query);
	if(mysqli_num_rows($run_query)>0)
    {
		echo '0';
      
        exit();
    }
   //$image =base64_encode($image);														
	$insert_custype="INSERT INTO custype(`custype`,`description`) 
	VALUES ('$custype','$description')";													    
	//echo "$insert_paymenterm";
	
	if(mysqli_query($dbcon,$insert_custype))
	{
		echo 	$custype;
		//echo "<script>alert('User Group creation Successful ')</script>";
		//header("location:addUsers.php");
    } else {
		echo '0';
		exit; //echo "<script>alert('User creation unsuccessful ')</script>";
	}
	
}
?>