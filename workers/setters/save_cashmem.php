
<?php
include('../../database/db_conection.php');

include('../getters/functions.php');

if (isset($_POST['array'])) {
    $array=$_POST['array'];
    $inv_code=$_POST['inv_code'];
    $inv_owner=$_POST['inv_owner'];
    $action=$_POST['action'];
    $table=$_POST['table'];
    $return=array();
    
    if ($inv_code=="") {
  
        $inv_code = get_id($dbcon,$table,"INV-0");
    }
    

    if($action=="add"){
        $sql2 = "INSERT INTO invoices (inv_code) VALUES ('$inv_code')";

        if (mysqli_query($dbcon,$sql2)) {
            $return = update_query($dbcon,$array,$inv_code,$table,"inv_code");
            $return['inv_code'] = $inv_code;
            $return['inv_owner'] = $inv_owner;

            $obj = json_decode($array, true);
            $items = json_decode($obj['inv_items'], true);               

            for($i=0;$i<count($items);$i++){
                    // Inserting Log details into purchaseitemlog
                    $stockbeforeqty="";
                    $qr  = "select * from salesitemaster2 where id='".$items[$i]['itemcode']."' ;";
                    $exc = mysqli_query($dbcon,$qr)or die();
                    while($r = mysqli_fetch_array($exc)){   
                    $stockbeforeqty = $r['stockinqty'];
                    } 
                // print_r($items[$i]);
                $sql4 = " UPDATE salesitemaster2 SET stockinqty =  stockinqty - ".$items[$i]['rwqty'].",sales_priceperqty=".$items[$i]['rwprice_org']."  WHERE id='".$items[$i]['itemcode']."' ;";
                        
                        //code updated by Jayaprakash 


                    //$prefix = "DAPL00";
                    $itemcode = "00000".$items[$i]['itemcode'];
                    $itemname = $items[$i]['itemdetails'];
                    $itemname = substr($itemname,strpos($itemname,"]")+1);
                    $stockinqty = $stockbeforeqty-$items[$i]['rwqty'];
                    $adjstockinqty = -1 * abs($items[$i]['rwqty']);
                    $uom = $items[$i]['uom'];
                    $handler = $obj['inv_owner'];
                    $stockasofdate = $obj['inv_date'];
                    $notes = $inv_code;

                    $sql5="INSERT into salesitemlognew (`itemcode`, `itemname`, `qtyonhand`,`qtyadjusted`, `uom`, `adjustedon`, `handler`, `notes`)
                    VALUES ('$itemcode', '$itemname', '$stockinqty',$adjstockinqty, '$uom', '$stockasofdate', '$handler', '$notes')";
                    if(mysqli_query($dbcon,$sql5)) {
                        $return['status']=true;

                    }
                    else{
                    $return['status']=false;
                    $return['error']=mysqli_error($dbcon);
                    }

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
        $return = update_query($dbcon,$array,$inv_code,$table,"inv_code");
    }

}
echo json_encode($return);


?>
