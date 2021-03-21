<?php
include("database/db_conection.php");//make connection here
include("workers/getters/functions.php");//make connection here

if(isset($_GET['id'])){

   echo  $grn_id = $_GET['id'];

    $past = findbyand($dbcon,$grn_id,"grn_notes","grn_id");
    $val_arr = $past['values'];
    $obj2 = json_decode($val_arr[0]['grn_po_items'], true);
    for($i=0;$i<count($obj2);$i++){
        $sql = " UPDATE purchaseitemaster  SET stockinqty =  stockinqty - ".$obj2[$i]['rwqty']."  WHERE id='".$obj2[$i]['itemcode']."' ";
        if (mysqli_query($dbcon,$sql)) {
            continue;
        }else{
            break;
        }
    }	

   echo  $sql3 = "UPDATE purchaseorders SET po_status = 'Approved' WHERE po_code='".$val_arr[0]['grn_po_code']."' ";
    if ($dbcon->query($sql3) === TRUE) {
        
       echo $sql2 = "DELETE FROM grn_notes WHERE grn_id='".$_GET['id']."' ";

        if ($dbcon->query($sql2) === TRUE) {

           header("Location: listGoodsReceiptNote.php");
        } else {
            echo "Error deleting record: " . $dbcon->error;
        }   

    } else {
        echo "Error deleting record: " . $dbcon->error;
    }


    $dbcon->close();
}
?>