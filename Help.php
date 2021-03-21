<?php include('header.php');?>

    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">

					
					<div class="row">
						<div class="col-xl-12">
							<div class="breadcrumb-holder">
								<h1 class="main-title float-left"><a style="color:#008080">Purchase Order & Product Inward & Stock(Inventory)</a></h1>
								<ol class="breadcrumb float-right">
									<li class="breadcrumb-item">Home</li>
									<li class="breadcrumb-item active">Help Docs</li>
								</ol>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<!-- end row -->


					
<div class="row">
<div class="col-xl-12">
<h5><a style="color:#008080">What is Purchase Order?</a></h5>
A purchase order (PO) is a commercial document and first official offer issued by a buyer to a seller, indicating types,
quantities, and agreed prices for products or services. It is used to control the purchasing of products and services from external suppliers.
</div>

<div class="container"></br>
  <h5><a style="color:#008080">Purchase Order Status Workflow</a></h5>
  <table class="table">
    <thead>
      <tr>
        <th>PO Status</th>
        <th>Description</th>        
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><b>Created</b></td>
        <td>When Purchase Order is Created the status will be converted to <b>Created</b></td>
        
      </tr>      
      <tr class="success">
        <td><b>Approved</b>	</td>
        <td>When a Manager/Supervisor Reviews and updates the status as Approved, the PO status will be converted to <b>Approved</b> </br>
		   and PO will be sent to the Vendor for receiving Products/Goods</td>       
      </tr>
      <tr class="danger">
        <td><b>Delivered</b></td>
        <td>When the Goods/Products are received against PO to the buyer, the PO status will be converted to <b>Delivered</b></td>        
      </tr>
	  
      <tr class="info">
        <td><b>Billed</b></td>
        <td>When GRN is Recorded against the vendor Invoice the Po Status will be converted to</b> Billed </b></td>       
      </tr>
	  
	  </tr>
      <tr class="info">
        <td><b>Closed</b></td>
        <td>When Supplier Payments are Fully Paid the PO Status will be converted to <b> Closed</b> </td>
       
      </tr>
      <tr class="warning">
        <td><b>Cancelled</b></td>
        <td>When PO becomes VOID the status will be converted to <b>Cancelled</b></td>       
      </tr>
    </tbody>
  </table>
</div>
</div>
<br><a style="color:green">To Create Purchase Order - <b>goto Purchase -> Purchase Orders </b></a></br>

<b><a style="color:green">Purchase Order Screen - </b> contains Purchase Item Details,Shipping details,Billing and Shipping Address Details</a> </br>
</br>

<div class="row">
<div class="col-xl-12">
<h5><a style="color:#008080">Product Inward</a></h5>

<b>What is Product Inward</b> ?- Taking in the stock for warehouse according to your order to a vendor.
<br><b>Example :</b> Raw Material,Packaging Material,Printing Material </br>

<br>Before you proceed to creating a <b> PURCHASE ORDER,</b> you can create an item(Purchase Order Item).</br>

<br><b>Creating a new item:</b> If you would be buying an item on a regular basis, you can create the item as a purchase item and map to PO.</br>

<br><a style="color:green">To Create Purchase Item - <b>goto Inventory -> Product Inward </b></a></br>

<b><a style="color:darkgreen">Product inward Screen - </b> contains Product information,Price Information & Stock Information</a> </br>
</br>

<h5><a style="color:#008080">Goods Receipt Note(GRN) </a></h5>
<b>What is GRN?</b> - Your GRN acts as internal proof of goods received to process and match against your supplier 
invoices/purchase orders. </br>Goods Receipt Notes. The goods receipt note is an internal document produced 
after inspecting delivery for proof of order receipt. </br>Generally produced by your stores team.<br>

<div class="container"></br>
  <h5><a style="color:#008080">GRN Process Workflow</a></h5>
  <table class="table">
    <thead>
      <tr>
        <th>GRN Status</th>
        <th>Description</th>        
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><b>Recorded</b></td>
        <td>When PO Status is Delivered , to start recording the GRN. The GRN Status will be converted to <b>Recorded</b><br>
		and the GRN Payment Status will be converted to <b> Unpaid</b></td>
        
      </tr>      
      <tr class="success">
        <td><b>Approved</b></td>
        <td>a Manager/Supervisor reviews GRN Entries and Approves the GRN Status to <b> Approved </b> and the PO Status in Purchase Order will be converted to <b>Billed</b></td>       
      </tr>
      <tr class="danger">
        <td><b>Partially Paid</b></td>
        <td>When bill payment is paid partial Amount against vendor invoice the Payment status of GRN will be converted to <b>Partially Paid</b> </td>
        
      </tr>
      <tr class="info">
        <td><b>Paid</b></td>
        <td>Once Vendor Payment is paid full amount against Vendor Invoice Through GRN the PO status will be converted to <b>Closed</b> and </br>
		GRN Payment Status will be converted to <b>Paid</b>and PO Status of PO will be converted to <b>Closed</b> </td>       
      </tr>
      <tr class="warning">
        <td><b>Overdue</b></td>
        <td>When the Payments are not made beyond due date, the GRN Status will be converted to <b>Over Due</b></td>       
      </tr>
    </tbody>
  </table>
</div>
</div>
</div>

<h5><a style="color:#008080">Vendor Credits</a></h5>
<a style="color:#008080"><b>What is Vendor Credit? - </b> </a><br>Vendor credits are credits that you make advance payment to the vendor. </br>
<a style="color:#008080"><b>When to Apply Vendor credits? - </b></a></br>Vendor Credits can be applied to a bill. Doing so the the bill amount gets reduced accordingly.</br>
<a style="color:#008080"><b>Where do I enter Vendor Credits? - </b></br>
<a style="color:green"><b>goto GRN -> Vendor Credits</b></br>
<a style="color:#008080"><b>Where do I Apply Vendor Credits to the Bill? - </b></br>
<a style="color:green"><b>goto GRN -> list Vendor Credits</b></br></br>
<a style="color:#008080"><b>What is Vendor Credits Refund?</b></a><br>
If you’ve received a direct payment from the vendor towards the amount owed to you, you can record this in corresponding vendor credit note created.</br>
<a style="color:#008080"><b>Where do I Record Vendor Refund? </b></br>
<a style="color:green"><b>goto GRN -> Vendor Refund</b></a></br></br>

<h5><a style="color:#008080">Inventory Management </a></h5>


<a style="color:#008080"><b>What is Inventory Management ?</b></a></br>Inventory Management is the Management of Inventory and Stock.Inventory Management refers to the process of Ordering,Storing and Using Company's Inventory: Raw Materials,
Components and Finished Products</br></br>

<h5><a style="color:#008080">When do update the Stock (Inventory) automatically?</a></h5>
The Moment GRN is recorded and Approved.</br>
<h5><a style="color:#008080">Where do Stock(Inventory) details Updated?</a></h5>
<a style="color:green"><b>goto Invenory -> Product Inward. You can check the Inventory list in Inventory -> list Product Inward </b></a></br>
<h5><a style="color:#008080">Can Stock and Price details Update Manually?</a></h5>
<b>Yes,</b>Manual stock adjustment is possible in <a style="color:green"><b>goto Inventory -> list Product Inward -> in Edit mode of Product Inward Screen</b></a></br>
</br>
<h5><a style="color:#008080">Stock Movement/Transfers</a></h5>
<a style="color:#008080"><b>What is Goods Issue? </b></a></</br>- A Goods Issue is defined as a physical outbound movement of goods or materials from the warehouse or 
it is the issue of physical goods or materials from the warehouse. It results in decrease in stock from the warehouse. 
For e.g goods are issued from the store to production department to make the product.</br>
<a style="color:#008080"><b>Where do I record Product Transfer Entry Task i.e., Product Inward(Material Issue Register)?</b></a></br>
<a style="color:green"><b>goto Invenory -> STOCK ADJUSTMENT -> Transfer/Issue Stock Inward.</a>You can check the Location/Warehouse wise Stock Availability <a style="color:green">goto Invenory -> STOCK ADJUSTMENT -> list Transfers </b></a></br>
<a style="color:#008080"><b>What is Warehouse? </b></a></br>- A location represents a physical space within a warehouse that an item of stock can be held in, like a shelf or a bin. Using locations with Bright pearl means it is possible to monitor how many items of a particular product are stored in a particular location at any one time.
</div>
<?php include('footer.php');?>


