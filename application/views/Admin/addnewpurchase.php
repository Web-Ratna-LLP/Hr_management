<style type="text/css">
	.modal-content{
		width: 800px;
	}

	/*iphone */
	@media only screen and (max-width: 800px) {
	  	.modal-content{
			width: 350px;
		}
	}

	/*normal mobile*/
	@media only screen and (max-width: 600px) {
	  	.modal-content{
			width: 330px;
		}
	}
		
</style>

<!-- Image loader -->
<div id='loader' style='display: none;'>
</div>
<!-- Image loader -->

<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Purchase</h4>
                </div>
                <div class="col-sm-6">
                    <div class="float-right d-none d-md-block">
                    </div>
                </div>
            </div>
        </div>
		<!-- end row -->
		<label style="color: red;"><?php if(isset($_SESSION['ErrSucc'])){echo $_SESSION['ErrSucc']; unset($_SESSION['ErrSucc']); }?></label>
		
        <form class="form-horizontal form-wizard-wrapper" method="post" id="purchaseform" >
	        <div class="row">
	            <div class="col-lg-12">
	                <div class="card">
	                    <div class="card-body">
	                    	<div class="form-group row">
	                    		<div class="col-md-4 row">
	                            	<span class="col-md-1"></span>
	                            	<label class="col-md-3">Subtotal</label> 
	                            	<input type="text" class="form-control col-md-8" name="sub_total" id="sub_total" value="0.00" readonly="">
	                        	</div>
	                        	<div class="col-md-4 row">
	                            	<span class="col-md-1"></span>
	                            	<label class="col-md-3">Round Off</label> 
	                            	<input type="text" class="form-control col-md-8" name="round_off" id="round_off" value="0.00" readonly="">
	                        	</div>
	                        	<div class="col-md-4 row">
	                            	<span class="col-md-1"></span>
	                            	<label class="col-md-3">Total</label> 
	                            	<input type="text" class="form-control col-md-8" name="total_amt" id="total_amt" value="0.00" readonly="">
	                        	</div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>

	        <div class="row">
	            <div class="col-lg-12">
	                <div class="card">
	                    <div class="card-body">
	                        <h4 class="mt-0 header-title"><i class="ion ion-ios-paper"></i>  General Detail</h4>
	                        <hr><br>
	                        <p class="text-muted m-b-30"></p>
	                        
	                            <input type="hidden" class="form-control" name="purchase_id" id="purchase_id" value="<?php if(isset($product)){echo $product->purchase_id;}else{echo '0';}?>">
	                            <div>
		                            <!-- Supplier add modal -->
		                            <div class="container" >
		                                <!-- Modal -->
		                                <div class="modal fade col-md-12" id="myModalParty" role="dialog">
		                                    <div class="modal-dialog" >
		                                        <div class="modal-content">
		                                            <div class="modal-header">
		                                                <h4 class="modal-title">Add Supplier</h4>
		                                            </div>
		                                            <div class="modal-body">
		                                                <div class="col-md-12">
		                                                    <div class="row">
		                                                        <div class="col-md-6">
		                                                            <div class="form-group row">
		                                                                <label class="control-label text-left col-md-5">Supplier Name</label>
		                                                                <div class="col-md-7">
		                                                                    <input type="text" id="supplier_name" name="supplier_name" class="form-control">
		                                                                    <input type="hidden" id="supplier" name="supplier" class="form-control"  value="<?php if(isset($supplier_id)){echo $allparty->supplier_id;}else{echo "0";}?>"  >
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                        <div class="col-md-6">
		                                                            <div class="form-group row">
		                                                                <label class="control-label text-left col-md-5">Supplier Mobile</label>
		                                                                <div class="col-md-7">
		                                                                	<input type="text" id="supplier_mobile" name="supplier_mobile" maxlength="10" class="form-control">
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>

		                                                    <div class="row">
		                                                        <div class="col-md-6">
		                                                            <div class="form-group row">
		                                                                <label class="control-label text-left col-md-5">Supplier Address</label>
		                                                                <div class="col-md-7">
		                                                                	<textarea class="form-control" name="supplier_address" id="supplier_address"></textarea>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                        <div class="col-md-6">
		                                                            <div class="form-group row">
		                                                                <label class="control-label text-left col-md-5">Supplier Gstno</label>
		                                                                <div class="col-md-7">
		                                                                	<input type="text" id="supplier_gstno" name="supplier_gstno"  class="form-control" maxlength="15">
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>

		                                                    <div class="row">
		                                                        <div class="col-md-6">
		                                                            <div class="form-group row">
		                                                                <label class="control-label text-left col-md-5">Country</label>
		                                                                <div class="col-md-7">
		                                                                	<Select class="form-control" id="country_id" name="country_id">
										                                        <option>Select</option>
										                                        <?php
										                                            foreach ($AllCountry as $country) 
										                                            {
										                                        ?>
										                                            <option value="<?php echo $country->country_id;?>"><?php echo  $country->country_name; ?></option>
										                                        <?php
										                                            } 
										                                        ?>  
										                                    </Select>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                        <div class="col-md-6">
		                                                            <div class="form-group row">
		                                                                <label class="control-label text-left col-md-5">State</label>
		                                                                <div class="col-md-7">
			                                                                <Select class="form-control" id="state_id" name="state_id">
										                                        <option>Select Country First</option>
										                                    </Select>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>

		                                                    <div class="row">
		                                                        <div class="col-md-6">
		                                                            <div class="form-group row">
		                                                                <label class="control-label text-left col-md-5">City</label>
		                                                                <div class="col-md-7">
		                                                                	<Select class="form-control" id="city_id" name="city_id">
										                                        <option>Select State First</option>
										                                    </Select>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                        <div class="col-md-6">
		                                                            <div class="form-group row">
		                                                                <label class="control-label text-left col-md-5">Pincode</label>
		                                                                <div class="col-md-7">
		                                                                <input type="text" class="form-control" name="pincode" id="pincode" maxlength="6">
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                   
		                                                    <div class="col-md-6">
		                                                    	<div class="form-group row">
		                                                        <label class="control-label col-md-6"></label>
		                                                        <button type="button" class="btn btn-success waves-effect waves-light" id="supplier_submit" name="save">Save</button>
		                                                        <button type="button" class="btn btn-inverse waves-effect waves-light" data-dismiss="modal" name="cancel">Cancel</button><br><br>
		                                                    	</div>
		                                                    </div>

		                                                    <label style="color: red;"><?php if(isset($_SESSION['ErrSucc'])){echo $_SESSION['ErrSucc']; unset($_SESSION['ErrSucc']); }?></label>
		                                                </div>
		                                                <br>	                                                
		                                            </div>
		                                            <div class="modal-footer">
		                                                <!-- <button type="button" class="btn btn-info" id="bookadd">Add</button>     -->
		                                                <label id="BookErr" style="color:red;"></label>
		                                                <button type="button" class="btn btn-default" data-dismiss="modal" id="btnmodalclose">Close</button>
		                                            </div>
		                                        </div>  
		                                    </div>
		                                </div>
		                            </div>

	                                <div class="row">
	                                    <div class="col-md-6">
	                                        <div class="form-group row">
	                                            <label class="col-md-3 col-form-label">Supplier Name</label> 
	                                            <Select class="form-control col-md-7 " id="supplier_id" name="supplier_id" >
	                                                <option value="">Select</option>
	                                                <?php
	                                                    foreach ($managesupplier as $supplier) 
	                                                    {
	                                                ?>
	                                                    <option value="<?php echo $supplier->supplier_id;?>"><?php echo $supplier->supplier_name; ?></option>
	                                                <?php
	                                                    } 
	                                                ?>  
	                                            </Select>&nbsp;
	                                            <button type="button" class="form-control col-md-1" data-toggle="modal" data-target="#myModalParty"><i class='fas fa-plus'></i></button>
	                                        </div>
	                                   
	                                   		<div class="form-group row">
	                                            <label class="col-md-3">Shop</label> 
	                                             <Select class="form-control col-md-8" id="shop_id" name="shop_id" >
	                                                <option value="">Select</option>
	                                                <?php
	                                                    foreach ($manageshop as $shop) 
	                                                    {
	                                                ?>
	                                                    <option value="<?php echo $shop->shop_id;?>"><?php echo  $shop->shop_name; ?></option>
	                                                <?php
	                                                    } 
	                                                ?>  
	                                            </Select>
											</div>
											

	                                        <div class="form-group row">
	                                            <label class="col-md-3">GST IN</label> 
	                                            <input type="text" class="form-control col-md-8" name="supplier_gst" id="supplier_gst" required maxlength="15">
	                                        </div>

	                                        <div class="form-group row">
	                                            <label class="col-md-3">Address</label> 
	                                            <textarea class="form-control col-md-8" name="supplier_add" id="supplier_add"></textarea>
	                                        </div>
	                                    </div>                              
	                                
	                                    <div class="col-md-6">
	                                        <div class="form-group row">
	                                            <label class="col-md-3">Bill No</label> 
	                                            <input type="text" class="form-control col-md-8" name="bill_no" id="bill_no" required >
	                                        </div> 

	                                        <div class="form-group row">
	                                            <label class="col-md-3">Referance No</label> 
	                                            <input type="text" class="form-control col-md-8" name="referance_no" id="referance_no" value="<?php if(isset($ReferanceDetail)){ echo $ReferanceDetail->ReferanceNo; }else{ echo ""; } ?>">
	                                        </div> 

	                                        <div class="form-group row">
	                                            <label class="col-md-3">Bill Date</label> 
	                                            <input type="text" class="form-control col-md-8" name="bill_date" id="bill_date" required >
	                                        </div>

	                                        <div class="form-group row">
	                                            <label class="col-md-3">Due Date</label> 
	                                            <input type="text" class="form-control col-md-8" name="due_date" id="due_date">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div><br>
	                    </div>
	                </div>
	            </div>

	            <div class="col-lg-12">
	                <div class="card">
	                    <div class="card-body">
	                    	<h4 class="mt-0 header-title"><i class="ion ion-ios-paper"></i> Product Detail</h4>
	                    	<hr><br>
	                        <div>
	                            <div class="row">
	                                <input type="hidden" name="rowSr" value="0" id="rowSr" class="form-control" >
	                                <div class="col-md-2">
	                                    <div class="form-group">
	                                        <label>Product Name</label> 
	                                        <Select class="form-control select2" id="product_id" name="product_id">
	                                            <option value="">Select</option>
	                                            <?php
	                                                foreach ($manageproduct as $product) 
	                                                {
	                                            ?>
	                                                <option value="<?php echo $product->product_id;?>"><?php echo  $product->product_name; ?></option>
	                                            <?php
	                                                } 
	                                            ?>  
	                                        </Select>
	                                    </div>
									</div>
							

	                                <div class="col-md-2">
	                                    <div class="form-group ">
	                                        <label>Varient Name</label>
	                                        <Select class="form-control" id="varientname" name="varientname">
	                                            <option value="">Select</option>
	                                        </Select>
	                                    </div>
	                                </div>

	                                <div class="col-md-1">
	                                    <div class="form-group ">
	                                        <label>Serial No</label> 
	                                        <input type="text" name="serial_no" id="serial_no" class="form-control">                                            
	                                    </div>
	                                </div>

	                                <div class="col-md-1">
	                                    <div class="form-group ">
	                                        <label >Qty</label> 
	                                        <input type="text" class="form-control" name="qty" id="qty" value="0" readonly="">
	                                    </div>
	                                </div>

	                                <div class="col-md-1">
	                                    <div class="form-group">
	                                        <label class='text-left'>Purchase Price</label> 
	                                        <input type="text" class="form-control" name="purchase_price" id="purchase_price" value="0">
	                                        <input type="hidden" class="form-control" name="org_pp" id="org_pp" value="0">
	                                    </div>
	                                </div>

	                                <div class="col-md-1">
	                                    <div class="form-group">
	                                        <label>Sale Price</label> 
	                                        <input type="text" class="form-control" name="sale_price" id="sale_price" value="0">
	                                    </div>
	                                </div>

	                                <div class="col-md-1">
	                                    <div class="form-group">
	                                        <label>Tax (%)</label> 
	                                        <input type="text" class="form-control" name="tax_id" id="tax_id" value="0" readonly>
	                                    </div>
	                                </div>

	                                <div class="col-md-1">
	                                    <div class="form-group">
	                                        <label>Tax Amount</label> 
	                                        <input type="text" class="form-control" name="tax_amt" id="tax_amt" value="0" readonly>
	                                    </div>
	                                </div>

	                                <div class="col-md-1">
	                                    <div class="form-group">
	                                        <label>Total</label> 
	                                        <input type="text" class="form-control" name="total" id="total" value="0" readonly>
	                                    </div>
	                                </div>

	                                <div class="col-md-1">
	                                    <div class="form-group">
	                                        <label style="color: white">.</label>
	                                        <button class="form-control btn btn-primary" type="button" id="btnadd">Add</button>
	                                    </div>
	                                </div>
	                            </div>
	                            <label style="color: red;" id="ErrRow"></label>
	                            <div class="row table-responsive">
	                                <table id="purchaseEntry" class="table table-striped table-bordered table-hover" data-page-size="7">
	                                    <thead>
	                                        <tr>
	                                            <th> Sr no </th>
	                                            <th> Product </th>
	                                            <th> Varient </th>
	                                            <th> Serial </th>
	                                            <th> Qty </th>
	                                            <th>  </th>
	                                            <th> Purchase Price </th>
	                                            <th> Sale Price </th>
	                                            <th> Tax(%) </th>
	                                            <th> Tax Amt </th>
	                                            <th> Total </th>
	                                            <th> </th>
	                                            <th> </th>
	                                        </tr>
	                                    </thead>

	                                    <tbody id="tbdy">
	                                        <?php
	                                            $subTotal = 0;
	                                            $itcnt = 1;
	                                            if(isset($invoicedetail))
	                                            {
	                                                foreach ($invoicedetail as $qd) {
	                                                  echo  "<td>".$itcnt."</td>"+
	                                                        "<td><input type='hidden' name='product_id[]' class='product_id' value=".$product_id."><label>".$product_name."</label></td>"+
	                                                        "<td><input type='hidden' name='varientname[]' class='varientname' value=".$varientname."><label>".$varient_name."</label></td>"+
	                                                        "<td><textarea style='display:none;' name='serial_no[]' class='serial_no form-control'>".$serial_no."</textarea><label>".$serial_no."</label></td>"+
	                                                        "<td><input type='text' name='qty[]' class='qty form-control' value=".$qty." readonly></td>"+
	                                                        "<td><input type='hidden' name='org_pp[]' class='org_pp form-control' value=".$org_pp." readonly></td>"+
	                                                        "<td><input type='text' name='purchase_price[]' class='purchase_price form-control' value=".$purchase_price." readonly></td>"+
	                                                        "<td><input type='text' name='sale_price[]' class='sale_price form-control' value=".$sale_price." readonly></td>"+
	                                                        "<td><input type='text' name='tax_id[]' class='tax_id form-control' value=".$tax_id." readonly></td>"+
	                                                        "<td><input type='text' name='tax_amt[]' class='tax_amt form-control' value=".$tax_amt." readonly></td>"+
	                                                        "<td><input type='text' name='total[]' class='total form-control' value=".$total." readonly></td>"+
	                                                        "<td class='editOn'><i class='fa fa-edit'></i></td><td class='deleteOn'><i class='fa fa-trash'></i></td>";
	                                                  $subTotal .= ($qd->price * $qd->qty);
	                                                  $itcnt++;
	                                                }
	                                            }
	                                        ?>
	                                    </tbody>

	                                    <tfoot>
	                                        <tr class="active">
	                                            <td colspan="9">
	                                                <div class="text-right">
	                                                    <ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
	                                                </div>
	                                            </td>
	                                        </tr>
	                                    </tfoot>
	                                </table>
	                            </div>
	                        </div><br>
	                    </div>
	                </div>
	            </div>

	            <div class="col-lg-12">
	                <div class="card">
	                    <div class="card-body">
	                    	<h4 class="mt-0 header-title"><i class="ion ion-ios-paper"></i> Tax Summary </h4>
	                    	<hr><br>
                            <div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label"></label>                                             
                                        </div>
                                   
                                        <div class="form-group row">
                                            <label class="col-md-3"></label> 
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3"></label> 
                                        </div>
                                    </div>                              
                                
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3">Subtotal</label> 
                                            <label class="col-md-1"></label> 
                                            <input type="text" class="form-control col-md-7" name="sub_total1" id="sub_total1" readonly="">
                                        </div> 
                                        <div class="form-group row">
			                                <label class="col-md-3">CGST @ <span id="cgst"></span></label> 
			                                <label class="col-md-1"></label> 
			                                <!-- <input type="text" class="form-control col-md-4" name="cgst" id="cgst" readonly=""> -->
			                                <input type="text" class="form-control col-md-7" name="cgst_amt" id="cgst_amt" readonly="">
			                            </div>

			                            <div class="form-group row">
			                                <label class="col-md-3">SGST @ <span id="sgst"></span></label> 
			                                <label class="col-md-1"></label> 
			                                <!-- <input type="text" class="form-control col-md-4" name="sgst" id="sgst" readonly=""> -->
			                                <input type="text" class="form-control col-md-7" name="sgst_amt" id="sgst_amt" readonly="">
			                            </div>
                                        <!-- <div class="form-group row">
                                            <label class="col-md-3">Total Tax</label> 
                                            <input type="text" class="form-control col-md-8" name="total_tax" id="total_tax" readonly="">
                                        </div> -->

                                        <div class="form-group row">
                                            <label class="col-md-3">Round Off</label> 
                                            <label class="col-md-1"></label> 
                                            <input type="text" class="form-control col-md-7" name="round_off1" id="round_off1" readonly="">
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3">Total</label> 
                                            <label class="col-md-1"></label>
                                            <input type="text" class="form-control col-md-7" name="total_amt1" id="total_amt1" readonly="">
                                        </div>
                                    </div>
                                </div>
                                <label style="color: red;" id="ErrSucc"></label>
                            </div><br>

                            <!-- Serial Number add modal -->
                            <div class="container" >
                                <!-- Modal -->
                                <div class="modal fade col-md-12" id="myModalSerial" role="dialog">
                                    <div class="modal-dialog" >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Add Serial No</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12">
	                                                    <div class="row">
	                                                        <div class="col-md-12">
	                                                            <div class="form-group row">
	                                                                <label class="control-label text-left col-md-2">Serial No</label>
	                                                                <input type="hidden" id="category_digit" name="category_digit" class="form-control">
	                                                                <div class="col-md-8">
	                                                                	<input type="text" id="txtserial_no" name="txtserial_no" class="form-control">
	                                                                </div>
	                                                                <button type="button" class="btn btn-success waves-effect waves-light col-md-2" id="btnaddserial" >Add</button>
	                                                            </div>
	                                                        </div>
	                                                        <label style="color: red;" id="SrrSucc"></label>

		                                                    <div class="col-md-12">
		                                                    	<div class="col-md-12 row">
		                                                    		<label class="col-md-9"></label>
		                                                    		<label class="control-label col-md-3" style="text-align: right;">Total Quantity : <span id="total_qty"></span></label>
		                                                    		<!-- <input type="hidden" value="" id="purchase_price" class="form-control">  -->
		                                                    	</div>
		                                                    	<div class="table-responsive">
		                                                             <table class="col-md-12 table table-striped table-bordered" id="table_serialno">
		                                                             	<thead>
		                                                             		<tr style="background-color: lightgrey" >
		                                                             			<th style="padding-left: 10px;">Serial No</th>
		                                                             			<th></th>
		                                                             		</tr>
		                                                             	</thead>
		                                                             	<tbody id="tbody"></tbody>
		                                                             </table>            
		                                                    	</div>
		                                                    </div>
	                                                    </div>                                                    
                                                </div>
                                                <br>                                                
                                            </div>
                                            <div class="modal-footer">
                                                <!-- <button type="button" class="btn btn-info" id="bookadd">Add</button>     -->
                                                <label id="BookErr" style="color:red;"></label>
                                                <button type="button" class="btn btn-default" onclick="btnmodalclose()">Close</button><!-- data-dismiss="modal" -->
                                                <button type="button" class="btn btn-success waves-effect waves-light" id="set_serialno" name="set">Set</button>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
	                    </div>
	                </div>
	            </div>

	            <div class="col-lg-12">
	            	<center>
					  <input type="submit" class="btn btn-primary waves-effect waves-light mr-1" id="btnsubmit"  value="submit"  onClick="window.location.reload();" />
						<button type="reset" class="btn btn-secondary waves-effect">Cancel</button>
	                </center>
	            </div>
	        </div>
        </form>
        <!-- end row -->
    </div>
    <!-- container-fluid -->
</div>


<script src="<?php echo base_url();?>assetsadmin/plugins/select2/js/select2.min.js"></script>
<script type="text/javascript">

    $(document).ready(function (){


    	$('.select2').select2().on('change', function(evt, params)
        {
            fetchvarient();
        });

        $('#country_id').change(function()
        {   
            get_state();
        });  

        $('#state_id').change(function()
        {    
            get_city();
        });   

    	fetchsupplier();

        $('#country_id').change(function()
        {   
            get_state();
        });  

        $('#state_id').change(function()
        {    
            get_city();
        }); 

        $("#supplier_id").change(function()
        {
            var supplier_id = $("#supplier_id").val();

            $.ajax({
                url : "<?php echo base_url()?>index.php/Admin/fetchsupplierdetail",
                type : "post",
                data : {supplier_id : supplier_id},
                success : function(data)
                {
                    var supplier = data.split("^");
                    $("#supplier_gst").val(supplier[1]);
                    $("#supplier_add").val(supplier[2]);
                }
            });
        });

        $("#varientname").change(function()
        {
            var pid = $("#varientname").val();

            $.ajax({
                url : "<?php echo base_url()?>index.php/Admin/fetchotherdetail",
                type : "post",
                data : {pid : pid},
                success : function(data)
                {
                    var other = data.split("^");

                    $("#tax_id").val(other[8]);
                    //$("#total").val(other[4]);
                    $("#category_digit").val(other[7]);
                    //$("#tax_id").val(other[8]);
                    $smodal = $('#myModalSerial');
                    $smodal.modal('show');
                    $("#tbody tr").remove();
                    $("#total_qty").text(0);
                    $("#purchase_price").val(0);
                    $("#tax_amt").val(0);
                    $("#total").val(0);

                    //calculate();
                    //pricefind();
                }
            });
        })

        $("#qty").keyup(function()
        {
            calculate();
        });

        $("#purchase_price").change(function()
        {
            calculate();
        });

        var rwcnt = 1;
        generatedate();

        $("#btnadd").click(function()
        {
            var rowSr = $('#rowSr').val();
            var product_id = $("#product_id").val();
            var product_name = $("#product_id option:selected").html();
         //   var actul_shop = $("#actul_shop option:selected").html();
            var varientname = $('#varientname').val();
            var varient_name = $("#varientname option:selected").html();
            var serial_no = $("#serial_no").val();
            /*var shop_id = $("#shop_id").val();
            var shop_name = $("#shop_id option:selected").html();*/
            var qty = $("#qty").val();
            var org_pp = $("#org_pp").val();
            var purchase_price = $("#purchase_price").val();
            var sale_price = $("#sale_price").val();
            var tax_id = $("#tax_id").val();
            var tax_amt = $("#tax_amt").val();
            var total = $("#total").val();
                  
            if(parseFloat(qty) <= 0)
            {
            	$("#ErrRow").html("Please add qty");
            }
            else
            {
                $("#ErrRow").html("");

                if(purchase_price <= 0)
                {
                	$("#ErrRow").html("Please add purchase price");
                }
            	else
            	{
            		if(sale_price <= 0)
	                {
	                	$("#ErrRow").html("Please add sale price");
	                }
	            	else
	            	{
	            		var SrNo = rwcnt;
		                if(rowSr != "0")
		                {
		                    SrNo = rowSr;
		                }
		                var str = "<td>"+SrNo+"</td>"+
		                        "<td><input type='hidden' name='product_id[]' class='product_id' value="+product_id+"><label  class='text-left'>"+product_name+"</label></td>"+
		                        "<td><input type='hidden' name='varientname[]' class='varientname' value="+varientname+"><label  class='text-left'>"+varient_name+"</label></td>"+
		                        "<td><textarea style='display:none;' name='serial_no[]' class='serial_no form-control'>"+serial_no+"</textarea><label class='text-left'>"+serial_no+"</label></td>"+
		                        "<td><input type='text' name='qty[]' class='qty form-control' value="+qty+" readonly></td>"+
		                        "<td><input type='hidden' name='org_pp[]' class='org_pp form-control' value="+org_pp+" readonly></td>"+
		                        "<td><input type='text' name='purchase_price[]' class='purchase_price form-control' value="+purchase_price+" readonly></td>"+
		                        "<td><input type='text' name='sale_price[]' class='sale_price form-control' value="+sale_price+" readonly></td>"+
		                        "<td><input type='text' name='tax_id[]' class='tax_id form-control' value="+tax_id+" readonly></td>"+
		                        "<td><input type='text' name='tax_amt[]' class='tax_amt form-control' value="+tax_amt+" readonly></td>"+
		                        "<td><input type='text' name='total[]' class='total form-control' value="+total+" readonly></td>"+
		                        "<td class='editOn'><i class='fa fa-edit'></i></td><td class='deleteOn'><i class='fa fa-trash'></i></td>";

		                if(rowSr <= 0)
		                {
		                    $('#tbdy').append("<tr>"+str+"</tr>");
		                    rwcnt++;
		                    clearVal();
		                    FinalSum();
		                }
		                else
		                {
		                    var tr = null;
		                    $('#tbdy').find('tr').each(function (key, val) {
		                        if($(this).find("td:first").text() == rowSr)
		                        {
		                            tr = $(this); 
		                        }
		                    });
		                    tr.html(str);
		                    clearVal();
		                    FinalSum();
		                }  
	            	}
            	}
            }
        });

        $("#purchaseEntry").on("click",".editOn", function()
        {
            var tr = $(this).closest('tr');
            var lines = $('td', tr).map(function(index, td) {
                return $(td);
            });
          
            //lines arrays of td
            $('#rowSr').val(lines[0].text());
            //$('#product_id').select2().trigger('change');
            
            $("#product_id").val(lines[1].find('.product_id').val());
            $('#product_id').select2().trigger('change');

		//	$("#actul_shop").val(lines[11].find('.actul_shop').val());
          //  $('#actul_shop').select2().trigger('change');

            //$('#product_name').val(lines[1].find('.product_name').val());
            $('#serial_no').val(lines[3].find('.serial_no').val());
            /*$('#shop_id').val(lines[4].find('.shop_id').val());
            $('#shop_name').val(lines[4].find('.shop_name').val());*/
            $('#qty').val(lines[4].find('.qty').val());
            $('#org_pp').val(lines[5].find('.org_pp').val());
            $('#purchase_price').val(lines[6].find('.purchase_price').val());
            $('#sale_price').val(lines[7].find('.sale_price').val());
            $('#tax_id').val(lines[8].find('.tax_id').val());
            $('#tax_amt').val(lines[9].find('.tax_amt').val());
            $('#total').val(lines[10].find('.total').val());
            $('#varientname').val(lines[2].find('.varientname').val());
            $('#varient_name').val(lines[2].find('.varient_name').val());
        });

        $("#purchaseEntry").on("click",".deleteOn", function()
        {
            var tr=$(this).closest('tr');
            tr.remove();
            Searilize();
            FinalSum();
        });

        $("#btnsubmit").click(function(e)
        //$("#btnsubmit").one("click", function(e)
        {
            var result1 = [];
            var result2 = [];

            var purchase_id = $("#purchase_id").val();
            var supplier_id = $("#supplier_id").val();
            var shop_id = $("#shop_id").val();
            //var actul_shop = $("#actul_shop").val();
            var bill_no = $("#bill_no").val();
            var referance_no = $("#referance_no").val();
            var b_date = $("#bill_date").val();
            var d_date = $("#due_date").val();

            var d = new Date(b_date.split("-").reverse().join("/"));
            var dd = d.getDate();
            var mm = d.getMonth()+1;
            var yy = d.getFullYear();
            var bill_date = yy+"-"+mm+"-"+dd;

            var d1 = new Date(d_date.split("-").reverse().join("/"));
            var dd1 = d1.getDate();
            var mm1 = d1.getMonth()+1;
            var yy1 = d1.getFullYear();
            var due_date = yy1+"-"+mm1+"-"+dd1;

            var sub_total = $("#sub_total").val();
            var total_tax = $("#total_tax").val();
            var round_off = $("#round_off").val();
            var total_amt = $("#total_amt").val();

            var obj1 = {};
                obj1['purchase_id'] = purchase_id;
                obj1['supplier_id'] = supplier_id;
                obj1['shop_id'] = shop_id;
//obj1['actul_shop'] = actul_shop;
                obj1['bill_no'] = bill_no;
                obj1['referance_no'] = referance_no;
                obj1['bill_date'] = bill_date;
                obj1['due_date'] = due_date;
                obj1['sub_total'] = sub_total;
                obj1['total_tax'] = total_tax;
                obj1['round_off'] = round_off;
                obj1['total_amt'] = total_amt;
                result1.push(obj1);

            var product_id = "";
            var varientname = "";
            var serial_no = "";
            /*var shop_id = "";*/

            $('#tbdy').find('tr').each(function (key, val) 
            {
                var lines = $('td', $(this)).map(function(index, td) {
                    return $(td);
                });

                product_id = lines[1].find('.product_id').val();
                //var product_name = lines[1].find('.product_name').val();
                varientname = lines[2].find('.varientname').val();
                serial_no = lines[3].find('.serial_no').val();
                /*shop_id = lines[4].find('.shop_id').val();*/
                var qty = lines[4].find('.qty').val();
                var org_pp = lines[5].find('.org_pp').val();
                var purchase_price = lines[6].find('.purchase_price').val();
                var sale_price = lines[7].find('.sale_price').val();
                var tax_id = lines[8].find('.tax_id').val();
                var tax_amt = lines[9].find('.tax_amt').val();
                var total = lines[10].find('.total').val();
              //  var actul_shop = lines[11].find('.actul_shop').val();
                
                var obj2 = {};
                obj2['product_id'] = product_id;
                //obj2['product_name'] = product_name;
                obj2['varientname'] = varientname;
                /*obj2['shop_id'] = shop_id;*/
                obj2['serial_no'] = serial_no;
                obj2['qty'] = qty;
                obj2['org_pp'] = org_pp;
                obj2['purchase_price'] = purchase_price;
                obj2['sale_price'] = sale_price;
                obj2['tax_id'] = tax_id;
                obj2['tax_amt'] = tax_amt;
                obj2['total'] = total;
               // obj2['actul_shop'] = actul_shop;
                result2.push(obj2);
            });

            var objectresult = {result1,result2};
    		if(supplier_id <= 0 || supplier_id == null)
    		{
    			$("#ErrSucc").html("Please Select Supplier");
    		}
    		else
    		{
    			if(shop_id <= 0 || shop_id == null)
	    		{
					console.log('123');
	    			$("#ErrSucc").html("Please Select Shop");
	    		}
	    		else
	    		{
	    			$("#ErrSucc").html("");
	    			$("#this").val('Please wait ...').attr('disabled','disabled');
	    			
	    			$.ajax({
		                url:"<?php echo base_url(); ?>index.php/Admin/purchaseInsert",
		                type:"POST",
		                data: JSON.stringify(objectresult),
		                datatype: "JSON",
		                beforeSend: function(){
						    // Show image container
						    $("#loader").show();
						},
		                success : function(Jsonstr)
		                {   
		                    //alert(Jsonstr);
		                    if(Jsonstr == 1 || Jsonstr == 3)
		                    {
								window.location.reload();
								return redirect('Admin/managepurchase');
							//	return redirect('Admin/managepurchase');

		                        window.location.replace("<?php echo base_url()?>index.php/Admin/managepurchase");
		                    }
		                    else if(Jsonstr == 2 || Jsonstr == 4)
		                    {
								window.location.reload();
								return redirect('Admin/managepurchase');

		                    }
		                },
		                complete:function(data){
						    // Hide image container
						    $("#loader").hide();
						}
		            });	
	    		}
    		}
            e.preventDefault();
        });

        $("#supplier_submit").click(function(e)
        {
        	var supplier_name = $("#supplier_name").val();
            var supplier_mobile = $("#supplier_mobile").val();
            var supplier_address = $("#supplier_address").val();
            var supplier_gstno = $("#supplier_gstno").val();
            var country_id = $("#country_id").val();
            var state_id = $("#state_id").val();
            var city_id = $("#city_id").val();
            var pincode = $("#pincode").val();

            $.ajax({
            	url : "<?php echo base_url()?>index.php/Admin/supplierInsert",
            	type : "Post",
            	data : {supplier_name : supplier_name , supplier_mobile : supplier_mobile, supplier_address : supplier_address , supplier_gstno : supplier_gstno, country_id :country_id , state_id : state_id, city_id : city_id, pincode : pincode },
            	success : function(data)
            	{
            		fetchsupplier();
            		$("#myModalParty").modal("hide");
            	}
            });
        });

        $("#txtserial_no").on('keyup keydown change',function()
        /*$("#txtserial_no").on('change',function()*/
        {
        	var cat_digit = $("#category_digit").val();
        	var ser_no = $("#txtserial_no").val();

        	if(ser_no.length == cat_digit)
        	{	
        		addserialno();
        	}
        	else
        	{	
        		$("#SrrSucc").html("You Enter Less Serial No, If want to add then press Add Button");
        	}
        });

        // start serial modal detail
        $("#btnaddserial").click(function()
        {
        	var txtserial_no = $("#txtserial_no").val();
        	var ser_no = $("#txtserial_no").val();
        	var cat_digit = $("#category_digit").val();
        	
	    	if(txtserial_no == '' || txtserial_no == null)
	    	{
	    		$("#SrrSucc").html("Please Enter Serial No");
	    	}
	    	else
	    	{
	        	addserialno();
	        }
	    });

        $("#table_serialno").on("click", ".deleteOn", function()
        {
            var tr = $(this).closest('tr');
            tr.remove();
            countrow();
        });

        $("#set_serialno").click(function()
        {
        	var tot_qty = $("#total_qty").text();
        	var maxserial_no = [];
        	var textareaserial = new Array();

        	$('#tbody').find('tr').each(function (key, val) 
	        {
	            var lines = $('td', $(this)).map(function(index, td) {
	                return $(td);
	            });

	            maxserial_no = parseFloat(lines[0].find('.serial').val());
	            textareaserial.push(maxserial_no);
	        });
	        
	        $("#serial_no").val(textareaserial);
	        $("#qty").val(tot_qty);
	        $("#myModalSerial").modal("hide");
        });
        // End serial modal detail
    });

	function fetchvarient()
	{
		var pid = $("#product_id").val();
            
        $.ajax({
            url : "<?php echo base_url()?>index.php/Admin/fetchvarient",
            type : "post",
            data : {pid : pid},
            success : function(data)
            {
                var varient = data;
                var varient1 = varient.split("~");
                $("#varientname").html("");
                $("#varientname").prepend("<option value=''>select</option>").val();
                $.each(varient1, function (index, value) 
                {
                    var str = value.split("^");
                    var listItem = $("<option></option>").val(str[0]).html(str[1]);
                    $("#varientname").append(listItem);
                });

                $('select option').filter(function(){
                    return ($(this).val().trim()=="" && $(this).text().trim()=="");
                }).remove();
            }
        });
	}

	function btnmodalclose()
    {
    	clearVal();
    	$("#myModalSerial").modal("hide");
    }

	function addserialno()
	{
		var txtserial_no = $("#txtserial_no").val();
        	
		$("#SrrSucc").html("");
    	var markup = "<tr><td><input type='text' name='serial[]' class='serial form-control' value='"+txtserial_no+"' readonly></td><td class='deleteOn'><a href='#'><i class='fas fa-window-close'></i></a></td></tr>";
    	$("#tbody").append(markup);
        
        countrow();
	}

	function countrow()
	{
		$("#txtserial_no").val("");
		var rowCount = $('#tbody tr').length;
		$("#total_qty").text(rowCount);
	}

    function calculate()
    {
        var subtotal = 0;
        var purchase_price = 0;
        var qty = 0;
        var tax_id = 0;
        var tax_amt = 0;
        var tax_amt1 = 0;
        var subtotal = 0;
        var total = 0; 

        purchase_price = parseFloat($('#purchase_price').val());
        qty = parseFloat($('#qty').val());
        tax_id = parseFloat($('#tax_id').val());

        if(qty > 0)
        {
            subtotal = purchase_price * qty;
        }
        else
        {
            subtotal = purchase_price;
        }

        if(tax_id > 0)
        {
            tax_amt = ((purchase_price * tax_id) / 100);
        } 
        purchase = purchase_price - tax_amt;

        if(tax_id > 0)
        {
            tax_amt1 = ((subtotal * tax_id) / 100);
        }   

        $('#org_pp').val(purchase_price.toFixed(2));
        $('#purchase_price').val(purchase.toFixed(2));
        $('#total').val(subtotal.toFixed(2));
        $('#tax_amt').val(tax_amt1.toFixed(2));
    }

    function FinalSum()
    {
        var rdoff = 0;
        var sgst = 0;
        var cgst = 0;
        var sgst_amt = 0;
        var cgst_amt = 0;
        var tax_id = 0;
        var tax_amt = 0;
        var Total = 0;
        var FinalTotal = 0;
        var sub_total = 0;

        $('#tbdy').find('tr').each(function (key, val) 
        {
            var lines = $('td', $(this)).map(function(index, td) {
                return $(td);
            });

            sub_total += (parseFloat(lines[6].find('.purchase_price').val()));
            tax_id += (parseFloat(lines[8].find('.tax_id').val()));
            tax_amt += (parseFloat(lines[9].find('.tax_amt').val()));
            Total += (parseFloat(lines[10].find('.total').val()));
        });

        cgst = tax_id/2;
        sgst = tax_id/2;
        cgst_amt = tax_amt/2;
        sgst_amt = tax_amt/2;

        FinalTotal = Math.round(Total);
        rdoff = FinalTotal - Total;

        $('#sub_total').val(sub_total.toFixed(2));
        $('#sub_total1').val(sub_total.toFixed(2));
        $('#cgst').html(cgst.toFixed(2));
        $('#sgst').html(sgst.toFixed(2));
        $('#cgst_amt').val(cgst_amt.toFixed(2));
        $('#sgst_amt').val(sgst_amt.toFixed(2));
        /*$('#total_tax').val(Tax_amt.toFixed(2));*/
        $('#round_off').val(rdoff.toFixed(2));
        $('#round_off1').val(rdoff.toFixed(2));
        $('#total_amt').val(FinalTotal);
        $('#total_amt1').val(FinalTotal);
    }

    function clearVal()
    {
        $('#rowSr').val(0);
        $('#product_id').val("");
		//$('.select2.select2-container').remove();
		$('.select2').select2();
		/*$("#product_id").select2("val", "");*/
        //$('#product_name').html("");
        $('#varientname').val("");
        $('#serial_no').val("");
        /*$('#shop_id').val("");*/
        $('#qty').val(0);
        $('#purchase_price').val(0);
        $('#sale_price').val(0);
        $('#tax_id').val(0);
        $('#tax_amt').val(0);
        $('#total').val(0);
    }    

    function Searilize()
    {
        var cnt = 1;
        $('#tbdy').find('tr').each(function (key, val) {
            $(this).find("td:first").text(cnt);
            cnt++;
        }); 
    }

    function fetchsupplier()
	{
		$.ajax({
        	url : "<?php echo base_url()?>index.php/Admin/fetchsupplier",
        	type : "Post",
        	success : function(data)
        	{
        		var supplier = data;
                var supplier1 = supplier.split("~");
                $("#supplier_id").html("");
                $("#supplier_id").prepend("<option value=''>select</option>").val();
                $.each(supplier1, function (index, value) 
                {
                    var str = value.split("^");
                    var listItem = $("<option></option>").val(str[0]).html(str[1]);
                    $("#supplier_id").append(listItem);
                });

                $('select option').filter(function(){
                    return ($(this).val().trim()=="" && $(this).text().trim()=="");
                }).remove();
        	}
        });	
	}

	function get_state()
    {
        var country_id = $('#country_id').val();
        if(country_id != '')
        {
           $.ajax({
                url:"<?=base_url() ?>index.php/Admin/selectStateBycountryid",
                method:"POST",
                data:{country_id : country_id},
                success:function(data)
                {
                    $('#state_id').html(data);
                    $('#city_id').html('<option value="">Select City</option>');
                }
            });
        }
        else
        {
           $('#state_id').html('<option value="">Select State</option>');
           $('#city_id').html('<option value="">Select City</option>');
        }
    }

    function get_city()
    {
        var state_id = $('#state_id').val();
        if(state_id != '')
        {
           $.ajax({
                url:"<?=base_url() ?>index.php/Admin/selectCityBystateid",
                method:"POST",
                data:{state_id : state_id},
                success:function(data)
                {
                    $('#city_id').html(data);
                }
            });
        }
        else
        {
           $('#state_id').html('<option value="">Select State</option>');
           $('#city_id').html('<option value="">Select City</option>');
        }
    }
    
    function generatedate()
    {
        var bill_date = $("#bill_date").val();
        if(bill_date == '')
        {
            var date = new Date();
            var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
            /*$( '#bill_date' ).datepicker({
                dateFormat: 'dd/mm/yy',
                //changeMonth: true,
                //changeYear: true,
                //yearRange: '2019:'+(new Date).getFullYear()
            });*/
            $('#bill_date').datepicker( 'setDate', today );
            $('#due_date').datepicker( 'setDate', today );
        }
    }
</script>