<div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title"> Shortlist Candidate</h4>
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
                        <h4 class="mt-0 header-title">Add Shortlist Candidate</h4>
                        <p class="text-muted m-b-30"></p>
                        <form class="" action="<?php echo base_url()?>index.php/Admin/Shortlistinsert" method="post" enctype="multipart/form-data">
                      
                            <input type="hidden" class="form-control" name="Shortlist_id" id="Shortlist_id">
                            <div class="form-group row">
                                <label class="col-md-3"> Name</label>
                                <Select class="form-control col-md-6" id="Candidate_id" name="Candidate_id" required="">
                                                <option>Select</option>
                                                <?php
                                                    foreach ($leave as $category) 
                                                    {
                                                ?>
                                                    <option value="<?php echo $category->Candidate_id;?>"><?php echo $category->Candidate_name; ?></option>
                                                <?php
                                                    } 
                                                ?>  
                                            </Select> 
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3"> Department</label>
                                <Select class="form-control col-md-6" id="Department_id" name="Department_id" required="">
                                                <option>Select</option>
                                                <?php
                                                    foreach ($Department as $category) 
                                                    {
                                                ?>
                                                    <option value="<?php echo $category->Department_id;?>"><?php echo $category->Department_name; ?></option>
                                                <?php
                                                    } 
                                                ?>  
                                            </Select> 
                            </div>
                            <div class="form-group row">
                            <label class="col-md-3">Shortlist Date </label> 
                            <input type="date" class="form-control col-md-6" name="start_date" id="start_date"  >
                            </div>
                            <div class="form-group row">
                            <label class="col-md-3"> Interview Date</label>
                            <input type="date" class="form-control col-md-6" name="end_date" id="end_date">
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
                    <div class="card-body">a
                        <h4 class="mt-0 header-title">List Shortlist</h4>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                        <th>Sr.No</th>
                                        <th>Candidate Name</th>
                                        <th>Department Name</th>
                                        <th>Shortlist Date</th>
                                        <th>Interview Date</th>
                                        <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                        $cnt = 1;
                                        foreach ($Shortlist as $brand) 
                                        {
                                ?>
                               <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $brand->Candidate_name; ?></td>
                                        <td><?php echo $brand->Department_name; ?></td>
                                        <td><?php echo $brand->start_date; ?></td>
                                        <td><?php echo $brand->end_date; ?></td>
                                        <td><a style="color:red;"  value="<?php echo $brand->Shortlist_id;?>" onclick="btndeleteemployee(this)"><i class="fa fa-trash"></i></a></td>
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
            var Shortlist_id = $(e).attr('value');

            if (confirm("Are you sure?")) 
            {
                $.ajax({
                    url:"<?php echo base_url() ?>index.php/Admin/DeleteShortlist",
                    type:"POST",
                    data:{Shortlist_id : Shortlist_id},
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