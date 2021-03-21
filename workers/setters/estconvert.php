<?php
include("../../database/db_conection.php");//make connection here
    // sql to delete a record
//	echo $_GET['so_code'];
    $sql = "UPDATE estimates SET est_status = '".$_GET['est_status']."' WHERE est_code='".$_GET['est_code']."' ";

    if ($dbcon->query($sql) === TRUE) {
      header("Location: ../../listEstimates.php");
    } else {
       echo "Error deleting record: " . $dbcon->error;
    }
    $dbcon->close();
?>