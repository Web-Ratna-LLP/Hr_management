    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Shop</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Add Shop</h4>
                             <p class="text-muted m-b-30"></p>
                            <form class="" action="<?php echo base_url()?>index.php/Admin/shopInsert" method="post" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" name="shop_id" id="shop_id">
                                <div class="form-group row">
                                    <label class="col-md-3">Shop Name</label> 
                                    <input type="text" class="form-control col-md-9" name="shop_name" id="shop_name" required >
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3">Shop Address</label> 
                                    <textarea class="form-control col-md-9" name="shop_address" id="shop_address" required ></textarea>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3">Shop Phone</label> 
                                    <input type="text" class="form-control col-md-9" name="shop_phone" id="shop_phone" maxlength="10">
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3">Shop Gst</label> 
                                    <input type="text" class="form-control col-md-9" name="shop_gst" id="shop_gst" required  maxlength="15">
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3">Shop Logo</label> 
                                    <input type="file" class="form-control col-md-9" name="uploadimages" onchange="readURL1(this);" id="shop_logo">
                                    <img id="blah1" src="<?php echo base_url();?>assetsadmin/images/shop/" height="100px" width="100px;">
                                </div>
                                <div class="form-group mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">Submit</button> 
                                        <button type="reset" class="btn btn-secondary waves-effect">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">List shop</h4>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Gst</th>
                                        <th>Shop logo</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $cnt = 1;
                                        foreach ($manageshop as $shop) 
                                        {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $shop->shop_name; ?></td>
                                        <td><?php echo $shop->shop_address; ?></td>
                                        <td><?php echo $shop->shop_phone; ?></td>
                                        <td><?php echo $shop->shop_gst; ?></td>
                                        <td><img src="<?php echo base_url()?>assetsadmin/images/shop/<?php echo $shop->shop_logo; ?>" height="20px" width="50px"></td>
                                        <td><a style="color:blue;" value="<?php echo $shop->shop_id;?>" onclick="btneditshop(this)"><i class="fa fa-edit"></i></a></td>
                                        <td><a style="color:red;"  value="<?php echo $shop->shop_id;?>" onclick="btndeleteshop(this)"><i class="fa fa-trash"></i></a></td>
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
        $(document).ready(function()
        {
            $("#blah1").hide();
        });

        function btneditshop(e)
        {
            var shop_id = $(e).attr('value');

            $.ajax({
                url:"<?php echo base_url() ?>index.php/Admin/EditShop",
                type:"POST",
                data:{shop_id : shop_id},
                success:function(data)
                {   //alert(data);
                    if(data == 0)
                    {
                        $('#ErrSucc').html("Shop Not Found");
                    }
                    else
                    {
                        var shop = data;
                        var shop1 = shop.split('^');

                        $("#shop_id").val(shop1[0]);
                        $('#shop_name').val(shop1[1]);
                        $('#shop_address').val(shop1[2]);
                        $('#shop_phone').val(shop1[3]);
                        $('#shop_gst').val(shop1[4]);
                        
                        $("#blah1").show();
                        var t_img = "<?php echo base_url()?>assetsadmin/images/shop/"+shop1[5];
                        $('#blah1').attr('src', t_img);
                    }                  
                }
            });  
            //e.preventDefault();
        }

        function btndeleteshop(e)
        {
            var shop_id = $(e).attr('value');

            if (confirm("Are you sure?")) 
            {
                $.ajax({
                    url:"<?php echo base_url() ?>index.php/Admin/DeleteShop",
                    type:"POST",
                    data:{shop_id : shop_id},
                    success:function(data)
                    {   
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

    <script>
        function readURL1(input) 
        {
            if (input.files && input.files[0]) 
            {
                var reader = new FileReader();
                reader.onload = function (e) 
                {
                    $('#blah1').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <style>
      input[type="file"] { 
        display:block;
      }

      .imageThumb {
         max-height: 100px;
         /*border: 2px solid;*/
         margin: 10px 10px 0 0;
         padding: 1px;
       }
    </style>