    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Brand</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Add Brand</h4>
                             <p class="text-muted m-b-30"></p>
                            <form class="" action="<?php echo base_url()?>index.php/Admin/brandInsert" method="post">
                                <input type="hidden" class="form-control" name="brand_id" id="brand_id">
                                <div class="form-group row">
                                    <label class="col-md-3">Brand Name</label> 
                                    <input type="text" class="form-control col-md-9" name="brand_name" id="brand_name" required >
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
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">List Brand</h4>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Name</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $cnt = 1;
                                        foreach ($managebrand as $brand) 
                                        {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $brand->brand_name; ?></td>
                                        <td><a style="color:blue;" value="<?php echo $brand->brand_id;?>" onclick="btneditbrand(this)"><i class="fa fa-edit"></i></a></td>
                                        <td><a style="color:red;"  value="<?php echo $brand->brand_id;?>" onclick="btndeletebrand(this)"><i class="fa fa-trash"></i></a></td>
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
        function btneditbrand(e)
        {
            var brand_id = $(e).attr('value');

            $.ajax({
                url:"<?php echo base_url() ?>index.php/Admin/EditBrand",
                type:"POST",
                data:{brand_id : brand_id},
                success:function(data)
                {   //alert(data);
                    if(data == 0)
                    {
                        $('#ErrSucc').html("Brand Not Found");
                    }
                    else
                    {
                        var brand = data;
                        var brand1 = brand.split(',');

                        $("#brand_id").val(brand1[0]);
                        $('#brand_name').val(brand1[1]);
                    }                  
                }
            });  
            //e.preventDefault();
        }

        function btndeletebrand(e)
        {
            var brand_id = $(e).attr('value');

            if (confirm("Are you sure?")) 
            {
                $.ajax({
                    url:"<?php echo base_url() ?>index.php/Admin/DeleteBrand",
                    type:"POST",
                    data:{brand_id : brand_id},
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