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
                                <div class="col-md-6">
                                    <h4 class="mt-0 header-title">List Purchase</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?php echo base_url()?>index.php/Admin/addnewpurchase" class="btn btn-primary">Add New</a>
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
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $cnt = 1;
                                        foreach ($managepurchase as $purchase) 
                                        {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $purchase->supplier_name; ?></td>
                                        <td><?php echo $purchase->bill_no; ?></td>
                                        <td><?php echo $purchase->bill_date; ?></td>
                                        <td><?php echo $purchase->category_name; ?></td>
                                        <td><?php echo $purchase->brand_name; ?></td>
                                        <td><?php echo $purchase->product_name; ?></td>
                                        <td><?php echo $purchase->varient_name; ?></td>
                                        <td><?php echo $purchase->min_stock; ?></td>
                                        <td><?php echo $purchase->price; ?></td>
                                        <td><?php echo $purchase->tax_id; ?></td>
                                        <td><?php echo $purchase->total; ?></td>
                                        <!-- <td><a style="color:blue;" value="<?php echo $purchase->purchase_id;?>" onclick="btneditpurchase(this)"><i class="fa fa-edit"></i></a></td> -->
                                        <td><a style="color:red;"  value="<?php echo $purchase->purchase_id;?>" onclick="btndeletepurchase(this)"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    <?php
                                            $cnt++;
                                        }
                                    ?> 
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

<script type="text/javascript">

    $(document).ready(function ()
    {
        $('#country_id').change(function()
        {   
            get_state();
        });  

        $('#state_id').change(function()
        {    
            get_city();
        });    
    });

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

    function btneditproduct(e)
    {
        var product_id = $(e).attr('value');

        $.ajax({
            url:"<?php echo base_url() ?>index.php/Admin/Editproduct",
            type:"POST",
            data:{product_id : product_id},
            success:function(data)
            {   //alert(data);
                if(data == 0)
                {
                    $('#ErrSucc').html("product Not Found");
                }
                else
                {
                    var product = data;
                    var product1 = product.split(',');

                    $("#product_id").val(product1[0]);
                    $('#product_name').val(product1[1]);
                    $('#product_mobile').val(product1[2]);
                    $('#product_address').val(product1[3]);
                    $('#product_gstno').val(product1[4]);
                    $('#country_id').val(product1[5]);
                    $('#state_id').val(product1[6]);
                    $('#city_id').val(product1[7]);
                    $('#pincode').val(product1[8]);
                }                  
            }
        });  
        //e.preventDefault();
    }

    function btndeletepurchase(e)
    {
        var purchase_id = $(e).attr('value');

        if (confirm("Are you sure?")) 
        {
            $.ajax({
                url:"<?php echo base_url() ?>index.php/Admin/DeletePurchase",
                type:"POST",
                data:{purchase_id : purchase_id},
                success:function(data)
                {   //alert(data);
                    if(data == 0)
                    {
                        window.location.reload("true");
                    }
                    else
                    {
                        window.location.reload("true");
                        //$('#ErrSucc').html("khatavahi Delete Successfully");
                    }                  
                }
            });          
        }
        return false;
        e.preventDefault();
    }
</script>