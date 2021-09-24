<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Department </h4>
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
                        <h4 class="mt-0 header-title" >Add Department </h4>
                         <p class="text-muted m-b-30"></p>
                        <form class="form-horizontal form-wizard-wrapper" action="<?php echo base_url()?>index.php/Admin/departmentInsert"  method="post">
                            <input type="hidden" class="form-control" name="Department_id" id="Department_id" >
                            <div style="border-color: black; border: 1px solid; padding :15px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Department Name</label> 
                                            <input type="text" class="form-control col-md-8" name="Department_name" id="Department_name" value="<?php if(isset($product)){echo $product->name;}else{echo '';}?>" required>
                                        </div>
                                   
                                       
                                
                            <div class="form-group mb-0">
                                <div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1" >Submit</button> 
                                    <button type="reset" class="btn btn-secondary waves-effect">Cancel</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- container-fluid -->
</div>
