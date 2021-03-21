
<?php

include_once('../../database/db_conection.php');
include('functions.php');


if (isset($_GET['id'])&&isset($_GET['type'])) {

    $id = $_GET['id'];
    $type = $_GET['type'];

    $return=array();
    $values=array();
    if($type=="grn"){
        $sql = "SELECT * FROM grn_notes where  grn_id='$id' LIMIT 1;";

    }else{
        $sql = "SELECT * FROM invoices where  inv_code='$id' LIMIT 1;";

    }
    $result = mysqli_query($dbcon, $sql);
    $values = sql_fetch_all($result);

    if (mysqli_num_rows($result) > 0) {

        $items = $type =="grn" ? json_decode($values[0]['grn_po_items'], true) : json_decode($values[0]['inv_items'],true);
        $list = "";
        $list.= '
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Item Details</th>
      <th scope="col">Price</th>
      <th scope="col">Qty</th>
      <th scope="col">Amt</th>
      <th scope="col">Tax</th>
      <th scope="col">Tax Amt</th>
      <th scope="col">Amount</th>
    </tr>
  </thead><tbody>';
        $gdtotal = 0;
        $total = 0;
        for($i=0;$i<count($items);$i++){
            $object = (object) $items[$i];

            //print_r($object);
            $amt = $items[$i]['rwprice']*$items[$i]['rwqty'];
            $total = ($amt)+($amt*($items[$i]['tax_val']/100));
            $list.= '<tr>
                <td scope="row">'.$items[$i]['itemdetails'].'</td>
                <td>'.$items[$i]['rwprice'].'</td>
                <td>'.$items[$i]['rwqty'].'</td>
                <td>'.nf($items[$i]['rwqty']*$items[$i]['rwprice']).'</td>
                <td>'.$items[$i]['tax_val'].'</td>
                <td>'.gettaxamt_print   ($object).'</td>
                <td>'.(gettaxamt_print($object)+(nf($items[$i]['rwqty']*$items[$i]['rwprice']))).'</td>
                </tr>'; 
            $gdtotal+=$total;

        }  
        $list.= '</tbody>
                </table>';

        $return['status']=true;
        $return['list']=$list;

    }else{
        $return['status']=false;
        $return['error']=mysqli_error($conn);
    }

}
echo json_encode($return);


?>
