<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['category']))
{
	$code ="";
	$prefix = "CAT00";
	
    $category=$_POST['category'];//same
   // $description = $_POST['description'];//same
	
    $check_suptype_query="select category from itemcategory WHERE category='$category'";
    $run_query=mysqli_query($dbcon,$check_suptype_query);
	if(mysqli_num_rows($run_query)>0)
    {
		echo '0';
      
        exit();
    }
   //$image =base64_encode($image);	
//Generating Category Codes
$sql="SELECT MAX(id) as latest_id FROM itemcategory ORDER BY id DESC";
	if($result = mysqli_query($dbcon,$sql)){
		$row   = mysqli_fetch_assoc($result);
		if(mysqli_num_rows($result)>0){
			$maxid = $row['latest_id'];
			$maxid+=1;
			
			$code = $prefix.$maxid;
		}else{
			$maxid = 0;
			$maxid+=1;
			$code = $prefix.$maxid;
		}
	}	   
	 $insert_itemcategory="insert into itemcategory(`code`,`category`) 
	VALUES ('$code','$category')";													    
	//echo "$insert_paymenterm";
	
	if(mysqli_query($dbcon,$insert_itemcategory))
	{
		echo 	$category;
		//echo "<script>alert('User Group creation Successful ')</script>";
		//header("location:addUsers.php");
    } else {
		echo '0';
		exit; //echo "<script>alert('User creation unsuccessful ')</script>";
	}
	
}
?>