    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Terms And Condition</h4>
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
                            <h4 class="mt-0 header-title">Add Terms & Condition</h4>
                             <p class="text-muted m-b-30"></p>
                            <form class="" action="<?php echo base_url()?>index.php/Admin/TermsInsert" method="post">
                                <input type="hidden" class="form-control" name="terms_id" id="terms_id">
                                <div class="form-group row">
                                    <label class="col-md-3">Terms Detail</label> 
                                    <textarea class="form-control col-md-9" name="terms_detail" id="terms_detail" required ></textarea> 
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
                            <h4 class="mt-0 header-title">List terms</h4>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Terms And Condition</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $cnt = 1;
                                        foreach ($manageterms as $terms) 
                                        {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><div style="overflow :scroll; width:520px; word-wrap:break-all;"><?php echo $terms->terms_detail; ?></div></td>
                                        <td><a style="color:blue;" value="<?php echo $terms->terms_id;?>" onclick="btneditterms(this)"><i class="fa fa-edit"></i></a></td>
                                        <td><a style="color:red;"  value="<?php echo $terms->terms_id;?>" onclick="btndeleteterms(this)"><i class="fa fa-trash"></i></a></td>
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
        function btneditterms(e)
        {
            var terms_id = $(e).attr('value');

            $.ajax({
                url:"<?php echo base_url() ?>index.php/Admin/EditTerms",
                type:"POST",
                data:{terms_id : terms_id},
                success:function(data)
                {   //alert(data);
                    if(data == 0)
                    {
                        $('#ErrSucc').html("Terms Not Found");
                    }
                    else
                    {
                        var terms1 = data.split('^');

                        $("#terms_id").val(terms1[0]);
                        $('#terms_detail').val(terms1[1]);
                    }                  
                }
            });  
            //e.preventDefault();
        }

        function btndeleteterms(e)
        {
            var terms_id = $(e).attr('value');

            if (confirm("Are you sure?")) 
            {
                $.ajax({
                    url:"<?php echo base_url() ?>index.php/Admin/DeleteTerms",
                    type:"POST",
                    data:{terms_id : terms_id},
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