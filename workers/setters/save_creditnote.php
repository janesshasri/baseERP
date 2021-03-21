
<?php
include('../../database/db_conection.php');

include('../getters/functions.php');

if (isset($_POST['array'])) {
    $array=$_POST['array'];
    $creditnote_id=$_POST['creditnote_id'];
    $action=$_POST['action'];
    $table=$_POST['table'];
    $return=array();

    if ($creditnote_id=="") {

        $creditnote_id = get_id($dbcon,$table,"CN-0000");
    }


    if($action=="add"){
        $sql2 = "INSERT INTO creditnotes (creditnote_id) VALUES ('$creditnote_id')";

        if (mysqli_query($dbcon,$sql2)) {
            $return = update_query($dbcon,$array,$creditnote_id,$table,"creditnote_id");

            if($return['status']===true){

                $obj = json_decode($array, true);
                $items = json_decode($obj['creditnote_items'], true);
                for($i=0;$i<count($items);$i++){

                    $sql0 = " UPDATE salesitemaster2 SET stockinqty =  stockinqty + ".$items[$i]['rwqty']."  WHERE id='".$items[$i]['itemcode']."' ;";

                    mysqli_query($dbcon,$sql0);
                }


                $sql0 = " UPDATE invoices SET inv_balance_amt =  inv_balance_amt - ".$obj['creditnote_value']."  WHERE inv_code='".$obj['creditnote_inv_code']."' ;";

                mysqli_query($dbcon,$sql0);    

                update_open_balance($dbcon,'recievables');

                $inv_val_arr = findbyand($dbcon,$obj['creditnote_inv_code'],"invoices","inv_code");

                if($inv_val_arr['values'][0]['inv_balance_amt']==0){
                    $return = updatebyand($dbcon,"Paid","invoices","inv_payment_status","inv_code",$obj['creditnote_inv_code']);
                    $return = updatebyand($dbcon,"Closed","invoices","inv_status","inv_code",$inv_val_arr['values'][0]['inv_code']);
                    if($inv_val_arr['values'][0]['inv_so_code']!=null||$inv_val_arr['values'][0]['inv_so_code']!=""){
                        $return = updatebyand($dbcon,"Closed","salesorders","so_status","so_code",$inv_val_arr['values'][0]['inv_so_code']);    
                    }


                }else if($inv_val_arr['values'][0]['inv_balance_amt']>0&&$inv_val_arr['values'][0]['inv_balance_amt']<$inv_val_arr['values'][0]['inv_value']){
                    $return = updatebyand($dbcon,"Partially Paid","invoices","inv_payment_status","inv_code",$obj['creditnote_inv_code']);
                }else if($inv_val_arr['values'][0]['inv_balance_amt']==$inv_val_arr['values'][0]['inv_value']){
                    $return = updatebyand($dbcon,"UnPaid","invoices","inv_payment_status","inv_code",$obj['creditnote_inv_code']);
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
        $return = update_query($dbcon,$array,$creditnote_id,$table,"creditnote_id");
    }

}
echo json_encode($return);


?>
