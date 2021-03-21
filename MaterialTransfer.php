<?php include('header.php');?>
	<!-- Left Sidebar -->
	
	<!-- End Sidebar -->


    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">

					
										<div class="row">
					<div class="col-xl-12">
							<div class="breadcrumb-holder">
                                    <h1 class="main-title float-left">Material/Item Transfer</h1>
                                    <ol class="breadcrumb float-right">
										<li class="breadcrumb-item">Home</li>
										<li class="breadcrumb-item active">Material/Item</li>
                                    </ol>
                                    <div class="clearfix"></div>
                            </div>
					</div>
			</div>
            <!-- end row -->

            
			<!--div class="alert alert-success" role="alert">
					  <h4 class="alert-heading">Company Registrtion Form</h4>
					  <p></a></p>
			</div-->

			
			<div class="row">
			
                    

					
					<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">						
						<div class="card mb-3">
							<div class="card-header">
								<!--h3><i class="fa fa-check-square-o"></i>Create Company </h3-->
								<h4><div class="fa-hover col-md-6 col-sm-6"><i class="fa fa-truck bigfonts" aria-hidden="true"></i>
									Material Transfer</h4>				
							</div>
								
							<div class="card-body">
								
								<!--form autocomplete="off" action="#"-->
								<form action="" class="validation fv-form fv-form-bootstrap" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate"><button type="submit" class="fv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>

								
								<div class="form-row">
								<div class="form-group col-md-6">
								  <label ><b>Stock Issue#:</b>&nbsp;&nbsp;SI-001</label>
								</div>
								</div>
								<div class="form-row">
								<div class="form-group col-md-3">
								<label >Date</label>
								<input type="date" class="form-control" name="date" placeholder="date" required class="form-control" autocomplete="off">
								</div>	
									<div class="form-group col-md-6">
									  <label >Description</label>
									  <input type="text" class="form-control" name="description" placeholder="STOCK ISSUE" required class="form-control" autocomplete="off">
									</div>
									</div>
									</div>
									<div class="form-group col-md-4">
									  <label >Document Ref#</label>
									  <input type="text" class="form-control" name="location" placeholder="GRN doc ref no" required class="form-control" autocomplete="off">
									</div>
									</div>
									
									
								
<!--link  rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" /-->									
<table  class="table table-hover small-text" id="tb">
<tr class="tr-header">
<th>Item Code</th>
<th>Description</th>
<th>UOM</th>
<th>Qty</th>
<th> Uni Cost</th>
<th> Sub Totals</th>
<th><a href="javascript:void(0);" style="font-size:18px;" id="addMore" title="Add More Person">
<span class="glyphicon glyphicon-plus"></span></a></th>
<tr>

<td><select name="itemcode" class="form-control-lg">
  <option value="">Select Item Code</option>
    <option value="Cap">Cap</option>
    <option value="Sticker">Sticker</option>
</select></td>
<td><input type="text" name="orderno" class="form-control"></td>

<td><input type="text" name="name" class="form-control"></td>
<td><input type="text" name="qty" class="form-control"></td>
<td><input type="text" name="needdate" class="form-control"></td>
<td><input type="text" name="needdate" class="form-control"></td>
<td><a href='javascript:void(0);'  class='remove'><span class='glyphicon glyphicon-remove'></span></a></td>
</tr>
</table>
								
								    <!--div class="form-row">
									<div class="form-group col-md-12">
									  <label >Location</label>
									  <input type="text" class="form-control" name="location" placeholder="Material Stock Location" autocomplete="off">
									</div>
									</div-->										
																
								    <!--div class="form-row">
									<div class="form-group col-md-4">
									  <label for="inputState">Product Tax(GST)</label>
									  <select id="inputState" class="form-control name="prodtax">
										<option selected>select GST</option>
										<option>18%</option>
									</select>
									</div>
									
									  <div class="form-row">
									<div class="form-group col-md-6">
									  <label for="inputState">Tax Method</label>
									  <select id="inputState" class="form-control name="tmethod">
										<option selected>select </option>
										<option>Inclusive</option>
										<option>Exclusive</option>
									</select>
									</div>
									
									<div class="form-group col-md-6">
									<i class="fa fa-rupee fonts" aria-hidden="true"></i>
									 <label>Price<span class="text-danger">*</label></span>
									<input type="text" class="form-control" id="price" name="price"placeholder="Price per qty" required class="form-control" autocomplete="off">
									</div>
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-10">
									<label>Alert Qty<span class="text-danger"></label></span>
									 <input type="text" class="form-control" id="alertqty" name="alertqty"placeholder="Alert Qty" required class="form-control" autocomplete="off">
									</div>
									</div>
									
									 <div class="form-row">
									<div class="form-group col-md-8">
									 <label>Initial Stock<span class="text-danger">*</label></span>
									  <input type="text" class="form-control" id="iniStock" placeholder="Initial Stock" required class="form-control" autocomplete="off">
									 </div></div>
									
									
								    <div class="form-row">
									<div class="form-group col-md-6">
									 <label>Curr Stock<span class="text-danger">*</label></span>
									  <input type="text" class="form-control" id="currstock" placeholder="Current Stock" required class="form-control" autocomplete="off">
									</div-->
									
									</div>
									</div>
										<div class="form-row">
									<div class="form-group col-md-12">
									 <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<b>Totals</b>&nbsp;&nbsp;&nbsp;1000</label>
									</div>
									</div>
									
								
										
								    <div class="form-row">
								    <div class="form-group text-right m-b-10">
                                                       &nbsp;<button class="btn btn-primary" name="submit" type="submit">
                                                            Submit
                                                        </button>
                                                        <button type="reset" name="cancel" class="btn btn-secondary m-l-5">
                                                            Cancel
                                                        </button>
                                                    </div>
													</div>
													</div>
													
								</form>
								</div>
								</div>
								</div>
								
								
								
		      </div>
			<!-- END container-fluid -->

		</div>
		<!-- END content -->

    </div>
	<!-- END content-page -->

	
    
	<footer class="footer">
		<span class="text-right">
		Copyright <a target="_blank" href="#"></a>
		</span>
		<span class="float-right">
		Powered by <a target="_blank" href="https://www.pikeadmin.com"><b>e-Schoolz</b></a>
		</span>
	</footer>

</div>
<!-- END main -->

<script src="assets/js/modernizr.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/moment.min.js"></script>

<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/plugins/switchery/switchery.min.js"></script>

<!-- App js -->
<script src="assets/js/pikeadmin.js"></script>

<!-- BEGIN Java Script for this page -->

<!-- END Java Script for this page -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
<script>
$(function(){
    $('#addMore').on('click', function() {
              var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
              data.find("input").val('');
     });
     $(document).on('click', '.remove', function() {
         var trIndex = $(this).closest("tr").index();
            if(trIndex>1) {
             $(this).closest("tr").remove();
           } else {
             alert("Sorry!! Can't remove first row!");
           }
      });
});      
</script>
<!-- END Java Script for this page -->

</body>
</html>