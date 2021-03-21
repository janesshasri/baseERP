<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['taxname']))
{
	
    $taxname=$_POST['taxname'];//same
    $description=$_POST['description'];//same
	$taxtype=$_POST['taxtype'];
	$taxrate=$_POST['taxrate'];
	
	 $check_tax_query="select taxname from taxmaster WHERE taxname='$taxname'";
    $run_query=mysqli_query($dbcon,$check_tax_query);
	if(mysqli_num_rows($run_query)>0)
    {
		echo '0';
      
        exit();
    }
  
	
	$insert_taxmaster="INSERT INTO taxmaster(`taxname`,`description`,`taxtype`,`taxrate`) 
	VALUES ('$taxname','$description','$taxtype','$taxrate')";	
	if(mysqli_query($dbcon,$insert_taxmaster))
	{
		echo 	$taxname;
		} else {
		echo '0';
		exit; 
		}
	
}
?>
