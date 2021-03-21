<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['suptype']))
{
	
    $suptype=$_POST['suptype'];//same
    $description = $_POST['description'];//same
	//$compcode=$_POST['compcode'];

   $check_suptype_query="select suptype from suptype WHERE suptype='$suptype'";
    $run_query=mysqli_query($dbcon,$check_suptype_query);
	if(mysqli_num_rows($run_query)>0)
    {
		echo '0';
      
        exit();
    }
   //$image =base64_encode($image);														
	$insert_suptype="INSERT INTO suptype(`suptype`,`description`) 
	VALUES ('$suptype','$description')";													    
	//echo "$insert_paymenterm";
	
	if(mysqli_query($dbcon,$insert_suptype))
	{
		echo 	$suptype;
		//echo "<script>alert('User Group creation Successful ')</script>";
		//header("location:addUsers.php");
    } else {
		echo '0';
		exit; //echo "<script>alert('User creation unsuccessful ')</script>";
	}
	
}
?>