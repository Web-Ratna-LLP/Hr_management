

           
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <!-- <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle arrow-none waves-effect waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-settings mr-2"></i> Settings
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Action</a> 
                                    <a class="dropdown-item" href="#">Another action</a> 
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Separated link</a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5 row">
                                        <h4>Welcome to <?php echo $_SESSION['username']; ?> </h4>
                                    </div>
                                </div> 
                            </div>                       
                        </div>
                    </div>
                </div>

                <div class="row"> 
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="row">
                                            <?php 
                                                $todaycollection = number_format($TodaySale,2);
                                            ?>
                                            <center>
                                                <span style="font-weight: bold">Today Sale :- </span>
                                                 &nbsp; &nbsp; 
                                                 <span style="color:blue;">
                                                    <?php if(isset($todaycollection)){ echo $todaycollection; }else{ echo "0.00"; } ?> 
                                                </span>
                                            </center>
                                        </h4>
                                    </div>
                                </div> 
                            </div>                       
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="row">
                                            <?php 
                                                $totalcollection = number_format($TotalSale,2);
                                            ?>
                                            <center>
                                                <span style="font-weight: bold">Total Sale :- </span>
                                                 &nbsp; &nbsp; 
                                                 <span style="color:red;">
                                                    <?php if(isset($totalcollection)){ echo $totalcollection; }else{ echo "0.00"; } ?> 
                                                </span>
                                            </center>
                                        </h4>
                                    </div>
                                </div> 
                            </div>                       
                        </div>
                    </div>
                </div>

                <div class="row"> 
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title"> Today Product Wise Sale</h4>
                                <table id="" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Product Name</th>
                                            <th>Varient Name</th>
                                            <th>Invoice</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $cnt = 1;
                                            foreach ($todayprod_sale as $ps) 
                                            {
                                        ?>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $ps->product_name; ?></td>
                                            <td><?php echo $ps->varient_name; ?></td>
                                            <td><?php echo $ps->invoice_string; ?></td>
                                            <td><?php echo $ps->invoice_date; ?></td>
                                            <td><?php echo $ps->inv_totalamt; ?></td>
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

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title"> Total Product Wise Sale</h4>
                                <table id="" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Product Name</th>
                                            <th>Varient Name</th>
                                            <th>Invoice</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $cnt = 1;
                                            foreach ($totalprod_sale as $ps) 
                                            {
                                        ?>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $ps->product_name; ?></td>
                                            <td><?php echo $ps->varient_name; ?></td>
                                            <td><?php echo $ps->invoice_string; ?></td>
                                            <td><?php echo $ps->invoice_date; ?></td>
                                            <td><?php echo $ps->inv_totalamt; ?></td>
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

                <div class="row"> 
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Product Wise Stock</h4>
                                <table id="" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Product Name</th>
                                            <th>Varient Name</th>
                                            <th>Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $cnt = 1;
                                            foreach ($prod_stock as $ps) 
                                            {
                                        ?>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $ps->product_name; ?></td>
                                            <td><?php echo $ps->varient_name; ?></td>
                                            <td><?php echo $ps->min_stock; ?></td>
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

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title"> Total Product Wise Stock value</h4>
                                <table id="" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Product Name</th>
                                            <th>Varient Name</th>
                                            <th>Stock</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $cnt = 1;
                                            foreach ($prod_stock as $ps) 
                                            {
                                        ?>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $ps->product_name; ?></td>
                                            <td><?php echo $ps->varient_name; ?></td>
                                            <td><?php echo $ps->min_stock; ?></td>
                                            <td><?php echo $ps->purchase_price; ?></td>
                                            <td><?php echo $ps->min_stock * $ps->purchase_price; ?></td>
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
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- content -->
                