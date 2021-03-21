<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['itemname']))
{
	
    $itemname=$_POST['itemname'];//same
   // $description = $_POST['description'];//same
	
    $check_suptype_query="select itemname from salesitemaster2 WHERE itemname='$itemname'";
    $run_query=mysqli_query($dbcon,$check_suptype_query);
	if(mysqli_num_rows($run_query)>0)
    {
		echo 0;
    }else{
			 echo 1;
		}

	
}
?>