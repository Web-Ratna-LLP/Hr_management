    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Purchase DEtail</h4>
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
                                    <h4 class="mt-0 header-title">List Purchase Detail</h4>
                                </div>
                            </div>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Product</th>
                                        <th>Varient</th>
                                        <th>Serial_no</th>
                                        <th>Qty</th>
                                        <th>Purchase Price</th>
                                        <th>Sale Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $cnt = 1;
                                        foreach ($purchasedetail as $pd) 
                                        {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $pd->category_name; ?></td>
                                        <td><?php echo $pd->brand_name; ?></td>
                                        <td><?php echo $pd->product_name; ?></td>
                                        <td><?php echo $pd->varient_name; ?></td>
                                        <td><div style="overflow:hidden; width:120px; word-wrap:break-word;"><?php echo $pd->serial_no; ?></div></td>
                                        <td><?php echo $pd->qty; ?></td>
                                        <td><?php echo $pd->purchase_price; ?></td>
                                        <td><?php echo $pd->sale_price; ?></td>
                                        <td><?php echo $pd->total; ?></td>
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