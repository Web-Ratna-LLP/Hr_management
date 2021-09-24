<style type="text/css">
    .select2-container .select2-selection--single {
        height: 34px !important;
    }

    .select2-container--default .select2-selection--single {
        border: 1px solid #ccc !important;
        border-radius: 0px !important;
    }

    .modal-content {
        width: 800px;
    }

    /*iphone */
    @media only screen and (max-width: 800px) {
        .modal-content {
            width: 350px;
        }
    }

    /*normal mobile*/
    @media only screen and (max-width: 600px) {
        .modal-content {
            width: 330px;
        }
    }
</style>

<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Edit</h4>
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
                        <h4 class="mt-0 header-title"><i class="ion ion-ios-paper"></i> Edit Stock Transfer</h4>
                        <hr><br>


                        <?php if (count($transferphone)) : foreach ($transferphone as $row) : ?>
                        <?php echo form_open('Admin/Updatephone/'.$row ->transfer_id ); ?>
                                <p class="text-muted m-b-30"></p>
                                <input type="hidden" class="form-control" name="tarnsfer_id" id="tarnsfer_id">
                                <div>
                                    <div class="row">
                                        <!-- Customer add modal -->


                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">From Shop</label>
                                                <!-- <input type="hidden" class="form-control col-md-8" name="customer_name" id="customer_name" required > -->
                                                <Select class="form-control col-md-7" id="shop_id" name="shop_id" value="<?php echo $row->shop_id; ?>">
                                                    <option value="">Select</option>
                                                    <?php
                                                    foreach ($manageshop as $shop) {
                                                    ?>
                                                        <option value="<?php echo $shop->shop_id; ?>"><?php echo  $shop->shop_name; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </Select>&nbsp;
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3">To Shop</label>
                                                <Select class="form-control col-md-7" id="actul_shop" name="actul_shop" >
                                                    <option value="">Select</option>
                                                    <?php
                                                    foreach ($manageshop as $shop) {
                                                    ?>
                                                        <option value="<?php echo $shop->shop_id; ?>"><?php echo  $shop->shop_name; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3"></label>
                                                <input type="hidden">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3">Transfer Date</label>
                                                <input name="transferdate" id="transferdate" class="form-control col-md-8" value="<?php echo $row->transferdate; ?>" type="date">
                                            </div>

                                        </div>

                                    </div>

                                </div>
                    </div><br>
                </div>
            </div>
        </div>



        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title"><i class="ion ion-ios-paper"></i> Product Detail</h4>
                    <hr><br>
                    <div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label>Scan</label>
                                    <input type="text" class="form-control" name="imei_no" id="imei_no">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <input type="hidden" name="rowSr" value="0" id="rowSr" class="form-control">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <!-- <div class="main-search-input-item" id="autocomplete-container">
                                                <input type="text" id="searchText" class="typeahead form-control" name="searchText"  placeholder="Search Products, Varient, Barcode" type="search" value="<?php if (isset($_SESSION['SearchText'])) {
                                                                                                                                                                                                                echo $_SESSION['SearchText'];
                                                                                                                                                                                                                unset($_SESSION['SearchText']);
                                                                                                                                                                                                            } ?>" required/>
                                            </div> -->
                                        <?php
                                       // foreach ($manageproduct as $product) {
                                        ?>
                                            <input  id="product_detail_id" name="product_detail_id"  >
                                        <?php
                                        //}
                                        ?>
                                    <input type="hidden"  value="" class="form-control">
                                    <!-- <input type="hidden" class="form-control" name="pd_name" id="pd_name">
                                            <input type="hidden" class="form-control" name="vn_name" id="vn_name"> -->
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Serial No</label>
                                    <input class="form-control" id="serial_no" name="serial_no" value="<?php echo $row->serial_no; ?>">
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group ">
                                    <label>Qty</label>
                                    <input type="text" class="form-control" name="qty" id="qty" value="" readonly>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" class="form-control" name="price" id="price" value="<?php echo $row->price; ?>">
                                    <input type="hidden" class="form-control" name="org_pp" id="org_pp" value="0">
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Discount</label>
                                    <input type="text" class="form-control" name="discount" id="discount" value="0">
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Tax (%)</label>
                                    <input type="text" class="form-control" name="tax_id" id="tax_id" value="0" readonly>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Tax Amount</label>
                                    <input type="text" class="form-control" name="tax_amt" id="tax_amt" value="0" readonly>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Total</label>
                                    <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->total; ?>" readonly>
                                </div>
                            </div>


                        </div>
                  
                <div class="row">


                    </tbody>

                    </table>
                </div>
                    </div><br>
                </div>
            </div>
        </div>

      
        <div class="col-lg-12">
            <center>
                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">Submit</button>
                <button type="reset" class="btn btn-secondary waves-effect">Cancel</button>
            </center>
        </div>
    </div>
</form>

      <?php endforeach; ?>
                <?php else : ?>
                <?php endif; ?>
    <!-- end row -->
</div>
<!-- container-fluid -->
</div>
</div>