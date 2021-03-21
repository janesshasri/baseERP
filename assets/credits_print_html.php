<?php
include("../database/db_conection.php");//make connection here
include("../workers/getters/functions.php");//make connection here

if(isset($_POST['v_credits_id']))
{
    $v_credits_id = $_POST['v_credits_id'];

    $sql = "SELECT c.*,v.supname,v.address,v.city,v.state,v.country,v.zip,v.gstin FROM vendorcredits c,vendorprofile v
			WHERE c.v_credits_vendorid = v.vendorid and v_credits_id='$v_credits_id'
			ORDER BY c.id DESC";
    $result = mysqli_query($dbcon,$sql);
    $row = $result-> fetch_assoc();
}

?> 

<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">

    </head>
    <body>
        <h5 >

            <div style="text-align:center">VENDOR CREDITS</div>
        </h5>

        <table class="p_table" width="100%" style="padding:10px;">
            <tbody>
                <tr style="border-bottom:1px solid #cccccc;">
                    <td width="100%" style="padding:10px;">
                        <b>Suppliers Name & Address</b><br/>

                        <?php echo $row['supname']; ?>,<br/>
                        <?php echo $row['address']; ?>,<br/>
                        <?php echo $row['city']; ?>,<?php echo $row['state']; ?>,<br/>
                        <?php echo $row['country']; ?>
                        <?php echo $row['city']; ?> - <?php echo $row['zip']; ?><br/>
                        <b>GSTIN</b> - <?php echo $row['gstin']; ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0px;">
                        <table width="100%">
                            <tr>
                                <td style="padding:5px;">Credit Ref No. <?php echo $row['v_credits_id']; ?></td> 
                            </tr>     
                            <tr>
                                <td style="padding:5px;">
                                    Date. <?php echo $row['v_credits_paymentdate']; ?>
                                </td> 
                            </tr>    
                            <tr>
                                <td style="padding:5px;">Payment Mode: <?php echo $row['v_credits_paymentmode']; ?></td> 
                            </tr>    
                            <tr>
                                <td style="padding:5px;">
                                    <p class="h6">Credit Amount : <?php echo $row['v_credits_amount']; ?></p>
                                </td> 
                            </tr>   
                       <tr>
                                <td style="padding:5px;">
                                    <p class="h6">Credit Balance : <?php echo $row['v_credits_availcredits']; ?></p>
                                </td> 
                            </tr>   
                        </table>

                    </td>
                </tr>

                <table class="p_table" width="100%" style="padding:10px;">
                    <tbody>
                        <tr>
                            <td width="100%" style="padding-top:10px;padding-left:10px;">
                                <?php
                                if($row['v_credits_notes']!=""){
                                ?>
                                <p><b>Notes</b></p>
                                <p><?php echo $row['v_credits_notes']; ?></p><br/>
                               <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br/>
                <br/>
                <br/><br/>
                <table class="p_table" width="100%" style="padding:10px;">
                    <tbody>
                        <tr>
                            <td width="70%" style="padding:10px;">


                            </td> 
                            <td width="" style="padding:10px;">
                                
                                <b>Authorized Signatory</b>


                            </td>
                        </tr>
                    </tbody>
                </table>
            </tbody>
        </table>
