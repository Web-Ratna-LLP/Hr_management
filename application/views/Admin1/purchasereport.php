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
            <div class="row"> 
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="col-md-6">From Date</label>
                                    <input type="date" class="form-control" name="purchase_from_date" id="purchase_from_date">
                                </div>
                                <div class="col-md-2">
                                    <label class="col-md-6">To Date</label>
                                    <input type="date" class="form-control" name="purchase_to_date" id="purchase_to_date">
                                </div>
                                <div class="col-md-2 ">
                                    <label class="col-md-6">Product</label>
                                    <Select class="form-control select2" id="product_id" name="product_id">
                                        <option value="">Select</option>
                                        <?php
                                            foreach ($manageproduct as $product) 
                                            {
                                        ?>
                                            <option value="<?php echo $product->product_id;?>"><?php echo $product->product_name; ?></option>
                                        <?php
                                            } 
                                        ?>  
                                    </Select>
                                </div>
                                <div class="col-md-2 ">
                                    <label class="col-md-6">Category</label>
                                    <Select class="form-control select3" id="category_id" name="category_id">
                                        <option value="">Select</option>
                                        <?php
                                            foreach ($managecategory as $category) 
                                            {
                                        ?>
                                            <option value="<?php echo $category->category_id;?>"><?php echo $category->category_name; ?></option>
                                        <?php
                                            } 
                                        ?>  
                                    </Select>
                                </div>
                                <div class="col-md-2 ">
                                    <label class="col-md-6">Brand</label>
                                    <Select class="form-control select4" id="brand_id" name="brand_id">
                                        <option value="">Select</option>
                                        <?php
                                            foreach ($managebrand as $brand) 
                                            {
                                        ?>
                                            <option value="<?php echo $brand->brand_id;?>"><?php echo  $brand->brand_name; ?></option>
                                        <?php
                                            } 
                                        ?>  
                                    </Select>
                                </div>
                                <div class="col-md-2">
                                    <label class="col-md-6" style="color: white;">.</label>
                                    <button type="button" class="btn btn-success waves-effect waves-light m-r-10 form-control" id="btnsubmit">Submit</button>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mt-0 header-title">Purchase Report</h4>
                                </div>
                            </div>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Supplier Name</th>
                                        <th>Bill No</th>
                                        <th>Bill Date</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Product</th>
                                        <th>Varient</th>
                                        <th>Stock</th>
                                        <th>SubTotal</th>
                                        <th>Tax(%)</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>

<script src="<?php echo base_url();?>assetsadmin/plugins/select2/js/select2.min.js"></script>
<script type="text/javascript">

    $(document).ready(function ()
    {
        $('.select2,.select3,.select4').select2();
        fetchpurchase();
        $("#btnsubmit").click(function()
        {   
            fetchpurchase();
        });    
    });

    function fetchpurchase()
    {
        var fromdate = $("#purchase_from_date").val();
        var todate = $("#purchase_to_date").val();
        var product_id = $("#product_id").val();
        var category_id = $("#category_id").val();
        var brand_id = $("#brand_id").val();

        $('#datatable-buttons').DataTable({   
            destroy: true,
            
            "ajax":{  
                  url:"<?php echo base_url() ?>index.php/Admin/fetchpurchasedata",
                  type:"POST",
                  data:{fromdate : fromdate, todate : todate, product_id : product_id, category_id : category_id, brand_id : brand_id},
                  dataType:"json",
             },

            /*"footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
     
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
     
                // Total over all pages
                totalCredit = api
                    .column( 3 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                totalDebit = api
                    .column( 4 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
     
                // Total over this page
                pageCredit = api
                    .column( 3, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                pageDebit = api
                    .column( 4, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
     
                // Update footer
                $( api.column( 3 ).footer() ).html(
                    pageCredit +' ( total :-'+ totalCredit +' )'
                );
                $( api.column( 4 ).footer() ).html(
                    pageDebit +' ( total :-'+ totalDebit +')'
                );
            },*/

            dom: 'Bfrtip',
            buttons: [
                'copy','csv', 'excel', 'pdf', 'print'
            ]           

        });
        $.fn.dataTable.ext.errMode = 'throw';
    }

</script>