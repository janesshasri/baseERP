<?php
include("database/db_conection.php");
if(isset($_POST['invCode']))
{
    $invCode=$_POST['invCode'];
	$query="SELECT inv_code FROM invoicesacc WHERE inv_code = '".$invCode."'";
    $run_query=mysqli_query($dbcon,$query);
	if(mysqli_num_rows($run_query)==0) {
		echo '0'; // Ok
    } else {
        echo '1'; // Exits
    }

}
?>