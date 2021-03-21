<?php 
include('../../database/db_conection.php');
include('functions.php');

function gettaxamt_total($arr){
    $ttax=0;
    $items = json_decode($arr, true);

    for($i=0;$i<count($items);$i++){
        if($items[$i]['tax_method']==0){
            $ttax+= $items[$i]['rwamt']*($items[$i]['tax_val']/100);
        }else{
            $ttax+= ($items[$i]['rwqty']*$items[$i]['rwprice_org'])*($items[$i]['tax_val']/100);
        }
    }

    return $ttax;

}

if(isset($_GET['type'])&&$_GET['type']=='vendorpayables'){

/*
    echo '<thead>
    <tr>
        <th>GRN#</th>
        <th>PO#</th>
        <th>Bill#</th>
        <th>
            Due Date</th>
        <th>Vendor</th>
        <th>Excluding Tax Amt</th>
        <th>Tax</th>
        <th>Total</th>
        <th>Balance Due</th>
    </tr>
</thead>
<tbody>';*/

    if(isset($_GET['st'])||isset($_GET['end'])||isset($_GET['vendorwise'])||isset($_GET['pstatuswise'])){
        $timestamp = strtotime($_GET['st']);
        $st = date('Y-m-d H:i:s', $timestamp);
        $timestamp = strtotime($_GET['end']);
        $end = date('Y-m-d H:i:s', $timestamp);
        $vendorwise = $_GET['vendorwise'];
        $pstatuswise = $_GET['pstatuswise'];

         $sql = "SELECT * from grn_notes g,vendorprofile v where (grn_date BETWEEN '$st' AND '$end') and g.grn_po_vendor=v.vendorid and g.grn_balance>0;";    

    }else{
         $sql = "SELECT * from grn_notes g,vendorprofile v where g.grn_po_vendor=v.vendorid and g.grn_balance>0;";    
    }
    $return = array();
    
    $result = mysqli_query($dbcon,$sql);
    $values = sql_fetch_all($result);
    $return['status']=true;
    $return['values']=$values;
/*
    if ($result->num_rows > 0){
        while ($row =$result-> fetch_assoc()){
            echo '                           <tr>
                                                <td>'.$row['grn_id'].'</td>
                                                <td>'.$row['grn_po_code'].'</td>
                                                <td>'.$row['grn_invoice_no'].'</td>
                                                <td>'.$row['grn_date'].'</td>
                                                <td>'.$row['supname'].'</td>
                                                <td>'.($row['grn_po_value']-gettaxamt_total($row['grn_po_items'])).'</td>
                                                <td>'.gettaxamt_total($row['grn_po_items']).'</td>
                                                <td>'.$row['grn_po_value'].'</td>
                                                <td>'.$row['grn_balance'].'</td>
                                            </tr>';  
        }
    }
*/



/*    echo '</tbody>
<tfoot>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
</tfoot>';*/
    
    echo json_encode($return);
    
    
}
?>
