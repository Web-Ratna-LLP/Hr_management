<br><br>
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
                                    <label class="col-md-8">From Date</label>
                                    <input type="date" class="form-control" name="purchase_from_date" id="purchase_from_date">
                                </div>
                                <div class="col-md-2">
                                    <label class="col-md-8">To Date</label>
                                    <input type="date" class="form-control" name="purchase_to_date" id="purchase_to_date">
                                </div>
                                <div class="col-md-2 ">
                                    <label class="col-md-8">Member</label>
                                    <Select class="form-control select2" id="member_id" name="member_id">
                                        <option value="">Select</option>
                                        <?php
                                            foreach ($managemember as $product) 
                                            {
                                        ?>
                                            <option value="<?php echo $product->member_id;?>"><?php echo $product->m_name; ?></option>
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
                                        <th> Name</th>
                                        <th> Email</th>
                                        <th> Number</th>
                                        <th>plan</th>
                                        <th>plan Amount</th>
                                        <th>panding Amount</th>
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
        var member_id = $("#member_id").val();
 

        $('#datatable-buttons').DataTable({   
            destroy: true,
            
            "ajax":{  
                  url:"<?php echo base_url() ?>index.php/Admin/fetchAttendancedata",
                  type:"POST",
                  data:{fromdate : fromdate, todate : todate, member_id : member_id},
                  dataType:"json",
             },

           
            dom: 'Bfrtip',
            buttons: [
                'copy','csv', 'excel', 'pdf', 'print'
            ]           

        });
        $.fn.dataTable.ext.errMode = 'throw';
    }

</script>