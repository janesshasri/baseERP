
<?php
include('../../database/db_conection.php');

include('../getters/functions.php');

if (isset($_POST['array'])) {
    $array=$_POST['array'];
    $debitnote_id=$_POST['debitnote_id'];
    $action=$_POST['action'];
    $table=$_POST['table'];
    $return=array();

    if ($debitnote_id=="") {

        $debitnote_id = get_id($dbcon,$table,"DBN-0000");
    }


    if($action=="add"){
        $sql2 = "INSERT INTO debitnotes (debitnote_id) VALUES ('$debitnote_id')";

        if (mysqli_query($dbcon,$sql2)) {
            $return = update_query($dbcon,$array,$debitnote_id,$table,"debitnote_id");

            if($return['status']===true){

                $obj = json_decode($array, true);
                $items = json_decode($obj['debitnote_items'], true);
                for($i=0;$i<count($items);$i++){

                    $sql0 = " UPDATE purchaseitemaster SET stockinqty =  stockinqty - ".$items[$i]['rwqty']."  WHERE id='".$items[$i]['itemcode']."' ;";

                    mysqli_query($dbcon,$sql0);
                }
                //  print_r($obj);

                $sql0 = " UPDATE grn_notes SET grn_balance =  grn_balance - ".$obj['debitnote_value']."  WHERE grn_id='".$obj['debitnote_grn_id']."' ;";

                mysqli_query($dbcon,$sql0);    

                update_open_balance($dbcon,'payables');


                $grn_val_arr = findbyand($dbcon,$obj['debitnote_grn_id'],"grn_notes","grn_id");


                if($grn_val_arr['values'][0]['grn_balance']==0){
                    $return = updatebyand($dbcon,"Paid","grn_notes","grn_payment_status","grn_id",$obj['debitnote_grn_id']);
                    if($grn_val_arr['values'][0]['grn_po_code']){
                        $return = updatebyand($dbcon,"Closed","purchaseorders","po_status","po_code",$grn_val_arr['values'][0]['grn_po_code']);
                    }


                }else if($grn_val_arr['values'][0]['grn_balance']>0&&$grn_val_arr['values'][0]['grn_balance']<$grn_val_arr['values'][0]['grn_po_value']){
                    $return = updatebyand($dbcon,"Partially Paid","grn_notes","grn_payment_status","grn_id",$obj['debitnote_grn_id']);
                }else if($grn_val_arr['values'][0]['grn_balance']==$grn_val_arr['values'][0]['grn_po_value']){
                    $return = updatebyand($dbcon,"UnPaid","grn_notes","grn_payment_status","grn_id",$obj['debitnote_grn_id']);
                }


            }else{
                $return['status']=false;
                $return['error']=mysqli_error($dbcon);
            }
        }else{
            $return['status']=false;
            $return['error']=mysqli_error($dbcon);
        }
    }else{
        $return = update_query($dbcon,$array,$debitnote_id,$table,"debitnote_id");
    }

}
echo json_encode($return);


?>
