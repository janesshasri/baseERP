
<?php
include('../../database/db_conection.php');

include('../getters/functions.php');

if (isset($_POST['array'])) {
    $array=$_POST['array'];
    $stk_mov_id=$_POST['stk_mov_id'];
    $action=$_POST['action'];
    $table=$_POST['table'];
    $return=array();

    if ($stk_mov_id=="") {

        $stk_mov_id = get_id($dbcon,$table,"STKMOV00");
    }



    if($action=="add"){
        $sql2 = "INSERT INTO stock_movement (stk_mov_id) VALUES ('$stk_mov_id')";

        if (mysqli_query($dbcon,$sql2)) {
            $return = update_query($dbcon,$array,$stk_mov_id,$table,"stk_mov_id");
            if($return['status']==true){

                $obj = json_decode($array, true);
                $items = json_decode($obj['stk_mov_items'], true);
                $sms_msg = "";
                $stkloc = $obj['stk_mov_location'];
                $findocstk = findbyand($dbcon,$stkloc,"warehouse","location_id");
                $locname = $findocstk['values'][0]['warehousename'];

                for($i=0;$i<count($items);$i++){

                    $sql4 = " UPDATE purchaseitemaster SET stockinqty =  stockinqty - ".$items[$i]['rwqty']."  WHERE id='".$items[$i]['itemcode']."' ;";


                    if (mysqli_query($dbcon,$sql4)) {

                        $findstk = findbyand($dbcon,$items[$i]['itemcode'],"purchaseitemaster","id");

                        $sms_msg.=($i+1).". Transferred Qty = ".$items[$i]['rwqty']." of ".PHP_EOL.$items[$i]['itemdetails'];
                        $sms_msg.=PHP_EOL." Available Stock = ".$findstk['values'][0]['stockinqty'].PHP_EOL;
                        if($findstk['values'][0]['stockinqty']<=$findstk['values'][0]['lowstockalert']){
                            $sms_msg.=" LOW STOCK ALERT ! (".$findstk['values'][0]['lowstockalert'].") .".PHP_EOL;
                        }

                        $return['status']=true;
                        if(count($items)-1==$i){
                            $sms_msg.=" Transferred to ".$locname;
                            $return['sms_msg']=$sms_msg;
                        }
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
            $return['status']=false;
            $return['error']=mysqli_error($dbcon);
        }
    }else{
        $past = findbyand($dbcon,$stk_mov_id,"stock_movement","stk_mov_id");

        $val_arr = $past['values'];
        $obj2 = json_decode($val_arr[0]['stk_mov_items'], true);
        for($i=0;$i<count($obj2);$i++){
            $sql = " UPDATE purchaseitemaster SET stockinqty =  stockinqty + ".$obj2[$i]['rwqty']."  WHERE id='".$obj2[$i]['itemcode']."' ";
            if (mysqli_query($dbcon,$sql)) {
                $return['status']=true;
            }else{
                $return['status']=false;
                $return['error']=mysqli_error($dbcon);
            }
        }	

        if($return['status']==true){

            $return = update_query($dbcon,$array,$stk_mov_id,$table,"stk_mov_id");

            if($return['status']==true){

                $obj = json_decode($array, true);
                $items = json_decode($obj['stk_mov_items'], true);

                for($i=0;$i<count($items);$i++){

                    $sql4 = " UPDATE purchaseitemaster SET stockinqty =  stockinqty - ".$items[$i]['rwqty']."  WHERE id='".$items[$i]['itemcode']."' ;";


                    if (mysqli_query($dbcon,$sql4)) {
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
            $return['status']=false;    
            $return['error']=mysqli_error($dbcon);
        }
    }

}
echo json_encode($return);


?>
