<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['hsncode']))
{
	
    $code=$_POST['hsncode'];//same
   // $description = $_POST['description'];//same
	
    $check_suptype_query="select hsncode from hsncode_lookups WHERE hsncode='$code'";
    $run_query=mysqli_query($dbcon,$check_suptype_query);
	if(mysqli_num_rows($run_query)>0)
    {
		echo '0';
      
    exit();
    }

	 $insert_itemcategory="insert into hsncode_lookups (`hsncode`) 
	  VALUES ('$code')";													    
	//echo "$insert_paymenterm";
	
	if(mysqli_query($dbcon,$insert_itemcategory))
	{
		echo 	$code;
		//echo "<script>alert('User Group creation Successful ')</script>";
		//header("location:addUsers.php");
    } else {
		echo '0';
		exit; //echo "<script>alert('User creation unsuccessful ')</script>";
	}
	
}
?>