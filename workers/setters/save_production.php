
<?php
include('../../database/db_conection.php');

include('../getters/functions.php');

if (isset($_POST['array'])) {
    $array=$_POST['array'];
    $pro_code=$_POST['pro_code'];
    $action=$_POST['action'];
    $table=$_POST['table'];
    $prod_status=$_POST['pro_status'];
    $prod_orgid=$_POST['prod_orgid'];
    $compname=$_POST['compname'];
    $return=array();
    
    $prefix = $compname!='' ?  strtoupper(substr($compname, 0, 3)):'';

    if ($pro_code=="") {
  
        $pro_code = get_id($dbcon,$table,$prefix."PRD-0");
    }

    if($action=="add"){
        $sql2 = "INSERT INTO productionlist (prod_code) VALUES ('$pro_code')";

        if (mysqli_query($dbcon,$sql2)) {

            $return = update_query($dbcon,$array,$pro_code,$table,"prod_code");
            $return['code']= $pro_code;

        }else{
            $return['status']=false;
            $return['error']=mysqli_error($dbcon);
        }
    }else{

        $return = update_query($dbcon,$array,$pro_code,$table,"prod_code");

        if($return['status']==true && $prod_status=="Completed"){

            $obj = json_decode($array, true);
            $items = json_decode($obj['prod_raw_items'], true); 

            
            for($i=0;$i<count($items);$i++){
           
                $return = findbyand($dbcon,$items[$i]['item'],'purchaseitemaster','itemcode');
                if($return['status']){  // get purchaseitemrow
                  $sql4 = " UPDATE purchaseitemaster SET stockinqty =  stockinqty - ".$items[$i]['qty']."  WHERE itemcode='".$items[$i]['item']."' AND orgid='".$prod_orgid."' ;";

                   if (mysqli_query($dbcon,$sql4)) {
                        // purchase log insert
                        $found_rows = $return['values'][0];
                        $row = new stdClass();
                        $row->entrytype =  $obj['entrytype'];
                        $row->orgid =  $obj['orgid'];
                        $row->itemcode =  $items[$i]['item'];
                        $row->itemname =  $found_rows['itemname'];
                        $row->qtyonhand =  $found_rows['stockinqty'];
                        $row->newqty =  $found_rows['stockinqty'] - $items[$i]['qty'];
                        $row->qtyadjusted =  $items[$i]['qty'];
                        $row->uom =  $found_rows['stockinuom'];
                        $row->handler =  $obj['prod_handler'];

                        $return  = insertRow($dbcon,'purchaseitemlog',$row);

                     if($return['status']){

                        $sql4 = " UPDATE scrapinventory SET scrap_inventory_qty =  scrap_inventory_qty + ((scrap_qty/scrap_from_qty)*".$items[$i]['qty'].")  WHERE scrap_from_itemcode='".$items[$i]['item']."'  ;";

                        if (mysqli_query($dbcon,$sql4)) {
                            $return['status']=true;
                            $return['code']= $pro_code;
    
                        }else{
                            $return['status']=false;
                            $return['error']=mysqli_error($dbcon);
                            break;        
                        }

                     }else{
                        $return['status']=false;
                        $return['error']=mysqli_error($dbcon);    
                        break;
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

            //  add to sales inventory 
            $return = findbyand($dbcon,$obj['prod_item'],'salesitemaster2','itemcode');

            if($return['status']){
                $sql = " UPDATE salesitemaster2 SET stockinqty =  stockinqty + ".$obj['prod_qty']."  WHERE itemcode='".$obj['prod_item']."' ;";
          
                if (mysqli_query($dbcon,$sql)) {
                    $sales_foundrows = $return['values'][0];

                    // sales log insert 
                    $salesrow = new stdClass();
                    $salesrow->entrytype =  $obj['entrytype'];
                    $salesrow->orgid =  $obj['orgid'];
                    $salesrow->itemcode =  $obj['prod_item'];
                    $salesrow->itemname =  $sales_foundrows['itemname'];
                    $salesrow->qtyonhand =  $sales_foundrows['stockinqty'];
                    $salesrow->newqty =  $sales_foundrows['stockinqty'] + $obj['prod_qty'];
                    $salesrow->qtyadjusted =  $obj['prod_qty'];
                    $salesrow->uom =  $sales_foundrows['sales_uom'];
                    $salesrow->handler =  $obj['prod_handler'];

                    $return  = insertRow($dbcon,'salesitemlognew',$salesrow);

                    if($return['status']){

                        $return['status']=true;
                        $return['code']= $pro_code;

                    }else{
                        $return['status']=false;
                        $return['error']=mysqli_error($dbcon);    
                    }


                    $return['status']=true;
                    $return['code']= $pro_code;
                }else{
                    $return['status']=false;
                    $return['error']=mysqli_error($dbcon);
                }
            }
  

        }

    }

}

$return['values'] = [];
echo json_encode($return);


?>
