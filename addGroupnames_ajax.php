<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['groupname']))
{
	//$prefix = "DAPL/";
	//$postfix = "/";
	
    $groupname=$_POST['groupname'];//same
    $description=$_POST['description'];//same
	
	
	$check_groupname_query="select groupname from groups WHERE groupname='$groupname'";
    $run_query=mysqli_query($dbcon,$check_groupname_query);
	if(mysqli_num_rows($run_query)>0)
    {
		echo '0';
       // echo "<script>alert('Group $groupname is already exist in our database, Please try another one!')</script>";
        //$fmsg= "Email already exists";
        exit();
    }

   //$image =base64_encode($image);														
	$insert_groups="INSERT INTO groups(`groupname`,`description`) 
	VALUES ('$groupname','$description')";													    

	
	//echo "$insert_usercode";
	
	if(mysqli_query($dbcon,$insert_groups))
	{
		echo 	$groupname;
		//echo "<script>alert('User Group creation Successful ')</script>";
		//header("location:addUsers.php");
    } else {
		echo '0';
		exit; //echo "<script>alert('User creation unsuccessful ')</script>";
	}
	
}
?>