
<?php
include('../../database/db_conection.php');

include('../getters/functions.php');

if (isset($_POST['array'])) {
    $array=$_POST['array'];
    $v_refund_id=$_POST['v_refund_id'];
    $v_credits_id=$_POST['v_credits_id'];
    $action=$_POST['action'];
    $table=$_POST['table'];
    $return=array();

    if ($v_refund_id=="") {
        $v_refund_id = get_id($dbcon,$table,"CNREF00");
    }



    if($action=="add"){
        $sql2 = "INSERT INTO vendor_refund (v_refund_id) VALUES ('$v_refund_id')";

        if (mysqli_query($dbcon,$sql2)) {
            $return = update_query($dbcon,$array,$v_refund_id,$table,"v_refund_id");
            $now = findbyand($dbcon,$v_refund_id,"vendor_refund","v_refund_id");
            $now_refund_amount = $now['values'][0]['v_refund_amount'];
            $sql4 = " UPDATE vendorcredits SET v_credits_availcredits =  v_credits_availcredits - ".$now_refund_amount."  WHERE v_credits_id='".$v_credits_id."' ;";

            if (mysqli_query($dbcon,$sql4)) {
                $return['status']=true;
            }else{
                $return['status']=false;
                $return['error']=mysqli_error($dbcon);
            }
        }else{
            $return['status']=false;
            $return['error']=mysqli_error($dbcon);
        }
    }else{
        $return = update_query($dbcon,$array,$v_refund_id,$table,"v_refund_id");
    }


    echo json_encode($return);

}
?>
