    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Sale</h4>
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
                                    <h4 class="mt-0 header-title ">List Sale</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?php echo base_url()?>index.php/Admin/addnewsale" class="btn btn-primary">Add New</a>
                                    <!-- <a href="<?php echo base_url()?>index.php/Admin/printallsale" class="btn btn-primary">print</a> -->
                                </div>
                            </div>
                            <label style="color: red;"><?php if(isset($_SESSION['ErrSucc'])){echo $_SESSION['ErrSucc']; unset($_SESSION['ErrSucc']); }?></label>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Customer</th>
                                        <th>Invoice</th>
                                        <th>Serial No</th>
                                        <th>Shop</th>
                                        <th>Date</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Product</th>
                                        <th>Model</th>
                                        <th>Total</th>
                                        <th>Employee</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $cnt = 1;
                                        foreach ($managesale as $sale) 
                                        {
                                            if($sale->user_status == 0)
                                            {   $user ="Admin";     }
                                            else
                                            {   $user = $sale->employee_name;     }
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $sale->customer_name; ?></td>
                                        <td><?php echo $sale->invoice_string; ?></td>
                                        <td><?php echo $sale->serial_no; ?></td>
                                        <td><?php echo $sale->shop_name;?></td>
                                        <td><?php echo $sale->invoice_date; ?></td>
                                        <td><?php echo $sale->category_name; ?></td>
                                        <td><?php echo $sale->brand_name; ?></td>
                                        <td><?php echo $sale->product_name; ?></td>
                                        <td><?php echo $sale->varient_name; ?></td>
                                        <td><?php echo $sale->inv_totalamt; ?></td>
                                        <th><?php echo $user; ?></th>
                                        <td><a style="color:blue;" href="<?php echo base_url()?>index.php/Admin/printsale/<?php echo $sale->sale_id;?>/<?php echo $sale->shop_id;?>"><i class="fas fa-print"></i></a></td>
                                        <!-- <td><a style="color:blue;" href="<?php echo base_url()?>index.php/Admin/EditSale/<?php echo $sale->sale_id;?>"><i class="fa fa-edit"></i></a></td> -->
                                        <td><a style="color:red;"  value="<?php echo $sale->sale_id;?>" onclick="btndeletesale(this)"><i class="fa fa-trash"></i></a></td>
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
         
    });

    function btneditsale(e)
    {
        var sale_id = $(e).attr('value');

        $.ajax({
            url:"<?php echo base_url() ?>index.php/Admin/EditSale",
            type:"POST",
            data:{sale_id : sale_id},
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

    function btndeletesale(e)
    {
        var sale_id = $(e).attr('value');

        if (confirm("Are you sure?")) 
        {
            $.ajax({
                url:"<?php echo base_url() ?>index.php/Admin/DeleteSale",
                type:"POST",
                data:{sale_id : sale_id},
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