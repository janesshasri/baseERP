<?php
include("database/db_conection.php");//make connection here
// sql to delete a record
include("workers/getters/functions.php");//make connection here

$sql = "DELETE FROM stock_movement WHERE stk_mov_id='".$_GET['id']."' limit 1;";
$past = findbyand($dbcon,$_GET['id'],"stock_movement","stk_mov_id");

if ($dbcon->query($sql) === TRUE) {
    $val_arr = $past['values'];
    $obj2 = json_decode($val_arr[0]['stk_mov_items'], true);
    for($i=0;$i<count($obj2);$i++){
        $sql = " UPDATE PURCHASEITEMASTER SET stockinqty =  stockinqty + ".$obj2[$i]['rwqty']."  WHERE id='".$obj2[$i]['itemcode']."' ";
        if (mysqli_query($dbcon,$sql)) {
            continue;
        }else{
            break;
        }
    }	
     header("Location: listtransferProductInward.php");
} else {
    echo "Error deleting record: " . $dbcon->error;
}
$dbcon->close();
?>