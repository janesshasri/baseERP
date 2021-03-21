<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['useremail']))
{
	$userid ="";
	$prefix = "DAPL00";
		
    $username=$_POST['username'];//here getting result from the post array after submitting the form.
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];	
    $useremail=$_POST['useremail'];//same
    $password=$_POST['repass'];//same
	$repassword = $_POST['repass'];//same
	$mobile = $_POST['mobile'];
	
		
	$check_groupname_query="select useremail from userprofile WHERE useremail='$useremail'";
    $run_query=mysqli_query($dbcon,$check_groupname_query);
	if(mysqli_num_rows($run_query)>0)
    {
		echo '0';
       // echo "<script>alert('Group $groupname is already exist in our database, Please try another one!')</script>";
        //$fmsg= "Email already exists";
        exit();
    }

	//Generating Userid
	$sql="SELECT MAX(id) as latest_id FROM userprofile ORDER BY id DESC";
	if($result = mysqli_query($dbcon,$sql)){
		$row   = mysqli_fetch_assoc($result);
		if(mysqli_num_rows($result)>0){
			$maxid = $row['latest_id'];
			$maxid+=1;
			
			$userid = $prefix.$maxid;
		}else{
			$maxid = 0;
			$maxid+=1;
			$userid = $prefix.$maxid;
		}
	}
	
   //$image =base64_encode($image);														
	$insert_userprofile="insert into userprofile (userid,username,firstname,lastname,useremail,userpassword,repass,mobile) 
	VALUE ('$userid','$username','$firstname','$lastname','$useremail','$password','$repassword','$mobile')";
	//echo $insert_userprofile;											    

	
	//echo "$insert_usercode";
	
	if(mysqli_query($dbcon,$insert_userprofile)or die(mysqli_error($dbcon)))
	{
		echo 	$useremail;
		echo "<script>alert('User creation Successful ')</script>";
		//header("location:addUsers.php");
    } else {
		echo '0';
		exit; //echo "<script>alert('User creation unsuccessful ')</script>";
	}
	
}
?>