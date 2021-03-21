
<?php
include('../../database/db_conection.php');

include('../getters/functions.php');

if (isset($_POST['array'])) {
    $array=$_POST['array'];
    $payment_id=$_POST['payment_id'];
    $payment_grn_id=$_POST['payment_grn_id'];
    $payment_amount=$_POST['payment_amount'];
    $page_payment_v_credits_id=$_POST['page_payment_v_credits_id'];

    $action=$_POST['action'];
    $action=$_POST['action'];
    $table=$_POST['table'];
    $return=array();

    if ($payment_id=="") {

        $payment_id = get_id($dbcon,$table,"00000");
    }


    if($action=="add"){
        $sql2 = "INSERT INTO payments (payment_id) VALUES ('$payment_id')";
        if (mysqli_query($dbcon,$sql2)) {
            $return = update_query($dbcon,$array,$payment_id,$table,"payment_id");
            $grn_val_arr = findbyand($dbcon,$payment_grn_id,"grn_notes","grn_id");
            // print_r($grn_val_arr);
            $balance = $grn_val_arr['values'][0]['grn_balance']-$payment_amount;
            $return = updatebyand($dbcon,$balance,"grn_notes","grn_balance","grn_id",$payment_grn_id);
            update_open_balance($dbcon,'payables');
            $grn_val_arr = findbyand($dbcon,$payment_grn_id,"grn_notes","grn_id");

            if($grn_val_arr['values'][0]['grn_balance']==0){
                $return = updatebyand($dbcon,"Paid","grn_notes","grn_payment_status","grn_id",$payment_grn_id);
                if($grn_val_arr['values'][0]['grn_po_code']){
                    $return = updatebyand($dbcon,"Closed","purchaseorders","po_status","po_code",$grn_val_arr['values'][0]['grn_po_code']);
                }


            }else if($grn_val_arr['values'][0]['grn_balance']>0&&$grn_val_arr['values'][0]['grn_balance']<$grn_val_arr['values'][0]['grn_po_value']){
                $return = updatebyand($dbcon,"Partially Paid","grn_notes","grn_payment_status","grn_id",$payment_grn_id);
            }else if($grn_val_arr['values'][0]['grn_balance']==$grn_val_arr['values'][0]['grn_po_value']){
                $return = updatebyand($dbcon,"UnPaid","grn_notes","grn_payment_status","grn_id",$payment_grn_id);
            }

            if($page_payment_v_credits_id!=""){
                $now = findbyand($dbcon,$payment_id,"payments","payment_id");
                $now_refund_amount = $now['values'][0]['payment_credits_used'];
                $sql90 = " UPDATE vendorcredits SET v_credits_availcredits =  v_credits_availcredits - ".$now_refund_amount."  WHERE v_credits_id='".$page_payment_v_credits_id."' ;";

                if (mysqli_query($dbcon,$sql90)) {
                    $return['status']=true;
                }else{
                    $return['status']=false;
                    $return['error']=mysqli_error($dbcon);
                }
            }


        }else{
            $return['status']=false;
            $return['error']=mysqli_error($dbcon);
        }
    }else{
        $return = update_query($dbcon,$array,$payment_id,$table,"payment_id");
    }

}
echo json_encode($return);


?>
