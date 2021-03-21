
<?php

include_once('../../database/db_conection.php');
include('functions.php');

if (isset($_GET['u_id'])) {

    $u_id = $_GET['u_id'];

    $return=array();
    $values=array();
    $sql = "SELECT * FROM stock_movement where  stk_mov_id='$u_id' LIMIT 1;";
    $result = mysqli_query($dbcon, $sql);
    $values = sql_fetch_all($result);

    if (mysqli_num_rows($result) > 0) {

        $items = json_decode($values[0]['stk_mov_items'], true);
        $list = "";
        $list.= '
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Item Details</th>
      <th scope="col">Price</th>
      <th scope="col">Qty Transfered</th>
      <th scope="col">Tax</th>
      <th scope="col">Amount</th>
    </tr>
  </thead><tbody>';
        $gdtotal = 0;
        $total = 0;
        for($i=0;$i<count($items);$i++){
            //
            //            $sql4 = " UPDATE PURCHASEITEMASTER SET stockinqty =  stockinqty - ".$items[$i]['qty_req']."  WHERE id='".$items[$i]['itemcode']."' ;";
            $amt = $items[$i]['rwprice']*$items[$i]['rwqty'];
            $total = ($amt)+($amt*($items[$i]['tax_val']/100));
            $list.= '<tr>
                <td scope="row">'.$items[$i]['itemdetails'].'</td>
                <td>'.$items[$i]['rwprice'].'</td>
                <td>'.$items[$i]['rwqty'].'</td>
                <td>'.$items[$i]['tax_val'].' %</td>
                <td>'.nf($total).'</td>
                </tr>'; 
            $gdtotal+=$total;

        }  
        $list.= '</tbody>
                </table>';

        $list.= '<hr><p class="lead">Total Transfered Value : <b>'.round($gdtotal,2).'</b></p>';
        $return['status']=true;
        $return['list']=$list;

    }else{
        $return['status']=false;
        $return['error']=mysqli_error($conn);
    }

}
echo json_encode($return);


?>
