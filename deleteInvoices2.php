<?php
include("database/db_conection.php");//make connection here
    // sql to delete a record
//	echo $_GET['so_code'];
$inv_code = $_GET['id'];
$past = findbyand($dbcon,$inv_code,"invoicesacc","inv_code");
$val_arr = $past['values'];
$obj2 = json_decode($val_arr[0]['inv_items'], true);
for($i=0;$i<count($obj2);$i++){
    $sql = " UPDATE salesitemaster2  SET stockinqty =  stockinqty + ".$obj2[$i]['rwqty']."  WHERE id='".$obj2[$i]['itemcode']."' ";
    if (mysqli_query($dbcon,$sql)) {
        continue;
    }else{
        break;
    }
}	

    $sql = "DELETE FROM invoicesacc WHERE inv_code='".$inv_code."' ";

    if ($dbcon->query($sql) === TRUE) {
      header("Location: listInvoicesacc.php");
    } else {
       echo "Error deleting record: " . $dbcon->error;
    }
    $dbcon->close();
?>