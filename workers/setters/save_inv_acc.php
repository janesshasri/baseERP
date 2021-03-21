
<?php
include('../../database/db_conection.php');

include('../getters/functions.php');

if (isset($_POST['array'])) {
    $array=$_POST['array'];
    $inv_code=$_POST['inv_code'];
    $action=$_POST['action'];
    $table=$_POST['table'];
    $prefix=$_POST['prefix'];
    $return=array();

    if ($inv_code=="") {
        $inv_code = get_id($dbcon,$table,"INVAC-0000");
        $inv_code .="-".$prefix;
    }


    if($action=="add"){
        $sql2 = "INSERT INTO $table (inv_code) VALUES ('$inv_code')";
        if (mysqli_query($dbcon,$sql2)) {
            $return = update_query($dbcon,$array,$inv_code,$table,"inv_code");
            if($return['status']==true){

                $inv_val_arr = findbyand($dbcon,$inv_code,$table,"inv_code");


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
            $return['status']=false;
            $return['error']=mysqli_error($dbcon);
        }
    }else{
        $changed_row_qty = $_POST['changed_row_qty'];
        $past = findbyand($dbcon,$inv_code,$table,"inv_code");

        $val_arr = $past['values'];
        $obj2 = json_decode($val_arr[0]['inv_items'], true);
        for($i=0;$i<count($obj2);$i++){

           // echo $obj2[$i]['rwqty'];
            
            $sql = " UPDATE salesitemaster2 SET stockinqty =  stockinqty + ".$obj2[$i]['rwqty'].",sales_priceperqty=".$obj2[$i]['rwprice_org']."  WHERE id='".$obj2[$i]['itemcode']."' ;";
            if (mysqli_query($dbcon,$sql)) {
                continue;
            }else{
                break;
            }
        }
        $return = update_query($dbcon,$array,$inv_code,$table,"inv_code");
        if($return['status']===true){
            if(isset($_POST['inv_code'])){

                    $obj = json_decode($array, true);
                    $items = json_decode($obj['inv_items'], true);

                    //code changed by jp for edit update grn to invent report
                    //echo $changed_row_qty;
                    if($changed_row_qty == true){
                        // echo '<pre>'; print_r($_POST['changed_item_select']); echo '</pre>'; 
                         if (isset($_POST['changed_item_select'])) {
                         $changed_item_select = $_POST['changed_item_select'];
                         $obj_change = json_decode($changed_item_select, true);
                         
                         for($j=0;$j<count($obj_change);$j++){   
                             
                         $stockbeforeqty="";
                         $qr  = "select * from salesitemaster2 where id='".$obj_change[$j]['itemcode']."' ;";
                         $exc = mysqli_query($dbcon,$qr)or die();
                         while($r = mysqli_fetch_array($exc)){
                         $stockbeforeqty = $r['stockinqty']-$items[$j]['rwqty'];
                         }
                         
                         $itemcode = "00000".$obj_change[$j]['itemcode'];
                         $adjstockinqty = $items[$j]['rwqty'];
                         $adjstockinqty = -1 * abs($adjstockinqty);
                         $itemname = $items[$j]['itemdetails'];
                         $itemname = substr($itemname,strpos($itemname,"]")+1);
                         $stockinqty = $stockbeforeqty;
                         $uom = $items[$j]['uom'];
                         $handler = $obj['inv_owner'];
                         $stockasofdate = $obj['inv_date'];
                         $notes = $_POST['inv_code'];
                         
                         $sql5="INSERT into salesitemlognew (`itemcode`, `itemname`, `qtyonhand`,`qtyadjusted`, `uom`, `adjustedon`, `handler`, `notes`)
                         VALUES ('$itemcode', '$itemname', '$stockinqty',$adjstockinqty, '$uom', '$stockasofdate', '$handler', '$notes')";
                           
                        if(mysqli_query($dbcon,$sql5)) {
                            $return['status']=true;
    
                        }else{
                            $return['status']=false;
                            $return['error']=mysqli_error($dbcon);
                        }
 
                         }
                     }                  
                     }

                    for($i=0;$i<count($items);$i++){

                        $sql0 = " UPDATE salesitemaster2 SET stockinqty =  stockinqty - ".$items[$i]['rwqty'].",sales_priceperqty=".$items[$i]['rwprice_org']."  WHERE id='".$items[$i]['itemcode']."' ;";

                        mysqli_query($dbcon,$sql0);
                    }                        
                
            }
        }else{
            $return['status']=false;
            $return['error']=mysqli_error($dbcon);
        }
    }

}
echo json_encode($return);


?>
