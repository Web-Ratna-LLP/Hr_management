<div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Leave Type</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Add Leave Type </h4>
                        <p class="text-muted m-b-30"></p>
                        <form class="" action="<?php echo base_url()?>index.php/Admin/leavetypeinsert" method="post" enctype="multipart/form-data">
                      
                            <input type="hidden" class="form-control" name="leave_id" id="leave_id">
                            <div class="form-group row">
                                <label class="col-md-3">Leave Type Name</label>
                                <input type="text" class="form-control col-md-6" name="name" id="name" required >

                            </div>
                            <div class="form-group row">
                            <label class="col-md-3">Number of Leave Days </label> 
                            <input type="text" class="form-control col-md-6" name="number" id="number"  >
                            </div>
                            
                            
                            <div class="form-group mb-0">
                                <div>
                                    <button type="submit"  class="btn btn-primary waves-effect waves-light mr-1">Submit</button>
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
                        <h4 class="mt-0 header-title">List Leave Type</h4>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                        <th>Sr.No</th>
                                        <th>Type Name</th>
                                        <th>Total Leave Days</th>
                                        <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                        $cnt = 1;
                                        foreach ($leave as $brand) 
                                        {
                                ?>
                               <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $brand->name; ?></td>
                                        <td><?php echo $brand->number; ?></td>
                                        <td><a style="color:red;"  value="<?php echo $brand->leave_id;?>" onclick="btndeleteemployee(this)"><i class="fa fa-trash"></i></a></td>
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
        function btneditemployee(e)
        {
            var id = $(e).attr('value');

            $.ajax({
                url:"<?php echo base_url() ?>index.php/Admin/EditEmployee",
                type:"POST",
                data:{id : id},
                success:function(data)
                {   //alert(data);
                    if(data == 0)
                    {
                        $('#ErrSucc').html("Employee Not Found");
                    }
                    else
                    {
                        var employee = data;
                        var employee1 = employee.split(',');

                        $("#id").val(employee1[0]);
                        $('#name').val(employee1[1]);
                        $('#mobile').val(employee1[2]);
                        $('#username').val(employee1[3]);
                        $('#password').val(employee1[4]);
                        $('#address').val(employee1[5]);
                        $('#email').val(employee1[6]);
                        $('#shop_id').val(employee1[6]);
                    }                  
                }
            });  
            //e.preventDefault();
        }

        function btndeleteemployee(e)
        {
            var leave_id = $(e).attr('value');

            if (confirm("Are you sure?")) 
            {
                $.ajax({
                    url:"<?php echo base_url() ?>index.php/Admin/Deleteleavetype",
                    type:"POST",
                    data:{leave_id : leave_id},
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
    
   <script type="text/javascript">
      function readURL1(input) {
         if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
               $('#blah1').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
         }
      }