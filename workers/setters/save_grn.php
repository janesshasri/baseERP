
<?php
include('../../database/db_conection.php');

include('../getters/functions.php');

if (isset($_POST['array'])) {
    $array=$_POST['array'];
    $grn_id=$_POST['grn_id'];
    $action=$_POST['action'];
    $table=$_POST['table'];
    
    $return=array();
    $return1=array();
    $items=array();
    if(isset($_POST['aux_entry'])){
        $aux_entry=$_POST['aux_entry'];
        $aux_table=$_POST['aux_table'];
        $aux_id=$_POST['aux_id'];
        $grn_items=$_POST['grn_items'];
    }

    if ($grn_id=="") {

        $grn_id = get_id($dbcon,$table,"GRN-00000");
    }


    if($action=="add"){
        $sql2 = "INSERT INTO grn_notes (grn_id) VALUES ('$grn_id')";

        if (mysqli_query($dbcon,$sql2)) {
            $return = update_query($dbcon,$array,$grn_id,$table,"grn_id");
            if($return['status']==true){
                $return1 = $return;

                if(isset($_POST['grn_id'])){
                    $return = update_query($dbcon,$aux_entry,$aux_id,$aux_table,"po_code");
                    
                    if($return['status']==true){

                        $obj = json_decode($array, true);
                        $items = json_decode($obj['grn_po_items'], true);
                        for($i=0;$i<count($items);$i++){
                          // print_r($items[$i]);                          
                        $sql4 = " UPDATE purchaseitemaster SET stockinqty =  stockinqty + ".$items[$i]['rwqty'].",priceperqty=".$items[$i]['rwprice_org'].",taxname=".$items[$i]['rwamt']."  WHERE id='".$items[$i]['itemcode']."' ;";
                            
                            //code updated by Jayaprakash 

                            // Inserting Log details into purchaseitemlog
                            $stockbeforeqty="";
                          $qr  = "select * from purchaseitemaster where id='".$items[$i]['itemcode']."' ;";
                          $exc = mysqli_query($dbcon,$qr)or die();
                          while($r = mysqli_fetch_array($exc)){
                            $stockbeforeqty = $r['stockinqty']+$items[$i]['rwqty'];
                          }     
                            $prefix = "DAPL00";
                             $itemcode = $prefix.$items[$i]['itemcode'];
                             $itemname = $items[$i]['itemdetails'];
                             $itemname = substr($itemname,strpos($itemname,"]")+1);
                             $stockinqty = $stockbeforeqty;
                             $adjstockinqty = $items[$i]['rwqty'];
                             $uom = $items[$i]['uom'];
                             $handler = $obj['grn_owner'];
                             $stockasofdate = $obj['grn_date'];
                             $notes = $grn_id;

                        $sql5="INSERT into purchaseitemlog(`itemcode`, `itemname`, `qtyonhand`,`qtyadjusted`, `uom`, `adjustedon`, `handler`, `notes`)
                        VALUES ('$itemcode', '$itemname', '$stockinqty',$adjstockinqty, '$uom', '$stockasofdate', '$handler', '$notes')";


                            if (mysqli_query($dbcon,$sql4)) {
                                $return['status']=true;
                                if($return['status']==true){
                                    if (mysqli_query($dbcon,$sql5)){
                                        $return['status']=true;
                                    }
                                    else{
                                        $return['status']=false;
                                        $return['error']=mysqli_error($dbcon);
                                    }
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
        $past = findbyand($dbcon,$grn_id,$table,"grn_id");

        $val_arr = $past['values'];
        $obj2 = json_decode($val_arr[0]['grn_po_items'], true);
        for($i=0;$i<count($obj2);$i++){
            
             $sql = " UPDATE purchaseitemaster SET stockinqty =  stockinqty - ".$obj2[$i]['rwqty']."  WHERE id='".$obj2[$i]['itemcode']."' ";
            if (mysqli_query($dbcon,$sql)) {
                continue;
            }else{
                break;
            }
        }
        $return = update_query($dbcon,$array,$grn_id,$table,"grn_id");
        if($return['status']===true){
            if(isset($_POST['grn_id'])){
                $return = update_query($dbcon,$aux_entry,$aux_id,$aux_table,"po_code");
                if($return['status']===true){

                    $obj = json_decode($array, true);
                    $items = json_decode($obj['grn_po_items'], true);

                    //code changed by jp for edit update grn to invent report
                    //echo $changed_row_qty;
                    if($changed_row_qty == true){
                        // echo '<pre>'; print_r($_POST['changed_item_select']); echo '</pre>'; 
                         if (isset($_POST['changed_item_select'])) {
                         $changed_item_select = $_POST['changed_item_select'];
                         $obj_change = json_decode($changed_item_select, true);
                         
                         for($j=0;$j<count($obj_change);$j++){   
                             
                         $stockbeforeqty="";
                         $qr  = "select * from purchaseitemaster where id='".$obj_change[$j]['itemcode']."' ;";
                         $exc = mysqli_query($dbcon,$qr)or die();
                         while($r = mysqli_fetch_array($exc)){
                         $stockbeforeqty = $r['stockinqty']+$items[$j]['rwqty'];
                         }
                         $prefix = "DAPL00";
                         $itemcode = $prefix.$obj_change[$j]['itemcode'];
                         print_r($obj_change[$j]);
                         $adjstockinqty = $items[$j]['rwqty']-$obj_change[$j]['rwqty'];
                         $itemname = $items[$j]['itemdetails'];
                         $itemname = substr($itemname,strpos($itemname,"]")+1);
                         $stockinqty = $stockbeforeqty;
                         $uom = $items[$j]['uom'];
                         $handler = $obj['grn_owner'];
                         $stockasofdate = $obj['grn_date'];
                         $notes = $_POST['grn_id'];
 
                        $sql5="INSERT into purchaseitemlog(`itemcode`, `itemname`, `qtyonhand`,`qtyadjusted`,`uom`, `adjustedon`, `handler`, `notes`)
                        VALUES ('$itemcode', '$itemname', '$stockinqty','$adjstockinqty', '$uom', '$stockasofdate', '$handler', '$notes')";
                             mysqli_query($dbcon,$sql5);
 
                         }
                     }                  
                     }

                    for($i=0;$i<count($items);$i++){

                          $sql0 = " UPDATE purchaseitemaster SET stockinqty =  stockinqty + ".$items[$i]['rwqty']."  WHERE id='".$items[$i]['itemcode']."' ;";

                        mysqli_query($dbcon,$sql0);
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
    }

}
echo json_encode($return);


?>
