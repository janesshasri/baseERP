
<?php
include('../../database/db_conection.php');

include('../getters/functions.php');

if (isset($_POST['array'])) {
    $array=$_POST['array'];
    $cust_payment_id=$_POST['cust_payment_id'];
    $cust_payment_inv_id=$_POST['cust_payment_inv_id'];
    $cust_payment_amount=$_POST['cust_payment_amount'];
    $page_cust_payment_v_credits_id=$_POST['page_cust_payment_v_credits_id'];

    $action=$_POST['action'];
    $table=$_POST['table'];
    $return=array();

    if ($cust_payment_id=="") {

        $cust_payment_id = get_id($dbcon,$table,"CUSTPAYACC-0000");
    }




    if($action=="add"){
        $sql2 = "INSERT INTO customer_paymentsacc (cust_payment_id) VALUES ('$cust_payment_id')";
        if (mysqli_query($dbcon,$sql2)) {
            $return = update_query($dbcon,$array,$cust_payment_id,$table,"cust_payment_id");

            $inv_val_arr = findbyand($dbcon,$cust_payment_inv_id,"invoicesacc","inv_code");
            // print_r($grn_val_arr);
            $balance = $inv_val_arr['values'][0]['inv_balance_amt']-$cust_payment_amount;
            $return = updatebyand($dbcon,$balance,"invoicesacc","inv_balance_amt","inv_code",$cust_payment_inv_id);
            //update_open_balance($dbcon,'recievables');

            $inv_val_arr = findbyand($dbcon,$cust_payment_inv_id,"invoicesacc","inv_code");

            if($inv_val_arr['values'][0]['inv_balance_amt']==0){
                $return = updatebyand($dbcon,"Paid","invoicesacc","inv_payment_status","inv_code",$cust_payment_inv_id);
                $return = updatebyand($dbcon,"Closed","invoicesacc","inv_status","inv_code",$inv_val_arr['values'][0]['inv_code']);
                if($inv_val_arr['values'][0]['inv_so_code']!=null||$inv_val_arr['values'][0]['inv_so_code']!=""){
                    $return = updatebyand($dbcon,"Closed","salesorders","so_status","so_code",$inv_val_arr['values'][0]['inv_so_code']);    
                }


            }else if($inv_val_arr['values'][0]['inv_balance_amt']>0&&$inv_val_arr['values'][0]['inv_balance_amt']<$inv_val_arr['values'][0]['inv_value']){
                $return = updatebyand($dbcon,"Partially Paid","invoicesacc","inv_payment_status","inv_code",$cust_payment_inv_id);
            }else if($inv_val_arr['values'][0]['inv_balance_amt']==$inv_val_arr['values'][0]['inv_value']){
                $return = updatebyand($dbcon,"UnPaid","invoicesacc","inv_payment_status","inv_code",$cust_payment_inv_id);
            }

            /*            if($page_payment_v_credits_id!=""){
                $now = findbyand($dbcon,$payment_id,"payments","payment_id");
                $now_refund_amount = $now['values'][0]['payment_credits_used'];
                $sql90 = " UPDATE vendorcredits SET v_credits_availcredits =  v_credits_availcredits - ".$now_refund_amount."  WHERE v_credits_id='".$page_payment_v_credits_id."' ;";

                if (mysqli_query($dbcon,$sql90)) {
                    $return['status']=true;
                }else{
                    $return['status']=false;
                    $return['error']=mysqli_error($dbcon);
                }
            }*/

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
