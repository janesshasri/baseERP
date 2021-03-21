
<?php
include('../../database/db_conection.php');

include('../getters/functions.php');

if (isset($_POST['array'])) {
    $array=$_POST['array'];
    $itemcode=$_POST['itemcode'];
    $action=$_POST['action'];
    $table=$_POST['table'];
    $compcode=$_POST['compcode'];
    $table2 = "salesitemlognew";
    $return=array();

   // $prefix = $compcode!='' ?  strtoupper(substr($compcode, 0, 3)):'';
    $prefix = $compcode!='' ?  strtoupper(substr($compcode, 0, 3))."-":'';
    
    if ($itemcode=="") {  
        $itemcode = get_id($dbcon,$table,$prefix."0");
    }
    
    if($action=="add"){
        $sql2 = "INSERT INTO ".$table." (itemcode) VALUES ('$itemcode')";


        if (mysqli_query($dbcon,$sql2)) {
            $return = update_query($dbcon,$array,$itemcode,$table,"itemcode");

            $obj = json_decode($array,true);

            $sql4 = "INSERT INTO salesitemlognew (entrytype,";
            $sql4.= "orgid," ;
            $sql4.="itemcode,itemname,qtyonhand,newqty,uom,adjustedon,handler,notes) 
            VALUES ('".$obj['entrytype']."',";
            $sql4.= "'".$obj['orgid']."'," ;
            $sql4.="'$itemcode','".$obj['itemname']."','".$obj['stockinqty']."','".$obj['stockinqty']."','".$obj['sales_uom']."','".$obj['stockinqty_date']."','".$obj['handler']."','".$obj['notes']."')";
           
            if(mysqli_query($dbcon,$sql4)){
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
        $return = update_query($dbcon,$array,$itemcode,$table,"itemcode");
        $obj = json_decode($array,true);
        $adjstk = $_POST['adjstk'];
        $oldstock = $obj['stockinqty'] - $adjstk;

        $sql3 = "INSERT INTO salesitemlognew (entrytype,itemcode,itemname,orgid,qtyonhand,newqty,qtyadjusted,
        uom,adjustedon,handler,notes) VALUES ('".$obj['entrytype']."','$itemcode','".$obj['itemname']."','".$obj['orgid']."','".$oldstock."','".$obj['stockinqty']."','".$adjstk."','".$obj['sales_uom']."','".$obj['stockinqty_date']."','".$obj['handler']."','".$obj['notes']."')";


        if (mysqli_query($dbcon,$sql3) ) {  
            $return['status']=true;
        }
        else{
            $return['status']=false;
            $return['error']=mysqli_error($dbcon);
        }
    }

}
echo json_encode($return);
?>
