<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['custype']))
{
	//$prefix = "DAPL/";
	//$postfix = "/";
	
    $custype=$_POST['custype'];//same
    $description=$_POST['description'];//same
	
	
	$check_custype_query="SELECT custype FROM custype where custype = '$custype'";
	//echo "check_custype_query";		  
    $run_query=mysqli_query($dbcon,$check_custype_query);
	if(mysqli_num_rows($run_query)>0)
    {
		echo '0';
       // echo "<script>alert('Group $groupname is already exist in our database, Please try another one!')</script>";
        //$fmsg= "Email already exists";
        exit();
    }

   $insert_customerType="insert into custype(`custype`,`description`) 
	VALUES ('$custype','$description')";
	
	
	//echo "$insert_usercode";
	
	if(mysqli_query($dbcon,$insert_customerType))
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