    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">SubAdmin</h4>
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
                            <h4 class="mt-0 header-title">Add SubAdmin</h4>
                             <p class="text-muted m-b-30"></p>
                            <form class="" action="<?php echo base_url()?>index.php/Admin/subadminInsert" method="post">
                                <input type="hidden" class="form-control" name="subadmin_id" id="subadmin_id">
                                <div class="form-group row">
                                    <label class="col-md-3">Subadmin Name</label> 
                                    <input type="text" class="form-control col-md-8" name="subadmin_name" id="subadmin_name" required >
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3">Subadmin UserName</label> 
                                    <input type="text" class="form-control col-md-8" name="subadmin_username" id="subadmin_username" required >
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3">Subadmin Password</label> 
                                    <input type="password" class="form-control col-md-8" name="subadmin_password" id="subadmin_password" required >
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3">Subadmin Mobile</label> 
                                    <input type="text" class="form-control col-md-8" name="subadmin_mobile" id="subadmin_mobile" required maxlength="10">
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3">Subadmin Email</label> 
                                    <input type="text" class="form-control col-md-8" name="subadmin_email" id="subadmin_email"  >
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3">Subadmin Address</label>
                                    <textarea class="form-control col-md-8" name="subadmin_address" id="subadmin_address"></textarea>
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
                            <h4 class="mt-0 header-title">List Subadmin</h4>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $cnt = 1;
                                        foreach ($managesubadmin as $subadmin) 
                                        {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $subadmin->subadmin_name; ?></td>
                                        <td><?php echo $subadmin->subadmin_username; ?></td>
                                        <td><?php echo $subadmin->subadmin_mobile; ?></td>
                                        <td><?php echo $subadmin->subadmin_email; ?></td>
                                        <td><a style="color:blue;" value="<?php echo $subadmin->subadmin_id;?>" onclick="btneditsubadmin(this)"><i class="fa fa-edit"></i></a></td>
                                        <td><a style="color:red;"  value="<?php echo $subadmin->subadmin_id;?>" onclick="btndeletesubadmin(this)"><i class="fa fa-trash"></i></a></td>
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
        function btneditsubadmin(e)
        {
            var subadmin_id = $(e).attr('value');

            $.ajax({
                url:"<?php echo base_url() ?>index.php/Admin/EditSubadmin",
                type:"POST",
                data:{subadmin_id : subadmin_id},
                success:function(data)
                {   //alert(data);
                    if(data == 0)
                    {
                        $('#ErrSucc').html("subadmin Not Found");
                    }
                    else
                    {
                        var subadmin = data;
                        var subadmin1 = subadmin.split(',');

                        $("#subadmin_id").val(subadmin1[0]);
                        $('#subadmin_name').val(subadmin1[1]);
                        $('#subadmin_mobile').val(subadmin1[2]);
                        $('#subadmin_username').val(subadmin1[3]);
                        $('#subadmin_password').val(subadmin1[4]);
                        $('#subadmin_address').val(subadmin1[5]);
                        $('#subadmin_email').val(subadmin1[6]);
                    }                  
                }
            });  
            //e.preventDefault();
        }

        function btndeletesubadmin(e)
        {
            var subadmin_id = $(e).attr('value');

            if (confirm("Are you sure?")) 
            {
                $.ajax({
                    url:"<?php echo base_url() ?>index.php/Admin/DeleteSubadmin",
                    type:"POST",
                    data:{subadmin_id : subadmin_id},
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