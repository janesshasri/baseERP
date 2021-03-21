<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['paymentterm']))
{
	
    $paymentterm=$_POST['paymentterm'];//same
    $description=$_POST['description'];//same
	//$compcode=$_POST['compcode'];

   $check_pterm_query="select paymentterm from paymentterm WHERE paymentterm='$paymentterm'";
    $run_query=mysqli_query($dbcon,$check_pterm_query);
	if(mysqli_num_rows($run_query)>0)
    {
		echo '0';
      
        exit();
    }
   //$image =base64_encode($image);														
	$insert_paymenterm="INSERT INTO paymentterm(`paymentterm`,`description`) 
	VALUES ('$paymentterm','$description')";													    
	//echo "$insert_paymenterm";
	
	if(mysqli_query($dbcon,$insert_paymenterm))
	{
		echo 	$paymentterm;
		//echo "<script>alert('User Group creation Successful ')</script>";
		//header("location:addUsers.php");
    } else {
		echo '0';
		exit; //echo "<script>alert('User creation unsuccessful ')</script>";
	}
	
}
?>