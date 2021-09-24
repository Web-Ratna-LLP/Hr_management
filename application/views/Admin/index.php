<?php
function count_digit($number)
{
    return strlen($number);
}

function divider($number_of_digits)
{
    $tens = "1";

    if ($number_of_digits > 8)
        return 10000000;

    while (($number_of_digits - 1) > 0) {
        $tens .= "0";
        $number_of_digits--;
    }
    return $tens;
}

function currencyformate($TotalAmount)
{
    $ext = "";                                  //thousand,lac, crore
    $number_of_digits = count_digit($TotalAmount);      //this is call

    if ($number_of_digits > 3) {
        if ($number_of_digits % 2 != 0)
            $divider = divider($number_of_digits - 1);
        else
            $divider = divider($number_of_digits);
    } else {
        $divider = 1;
    }

    $fraction = $TotalAmount / $divider;
    $fraction = number_format($fraction, 2);

    if ($number_of_digits == 4 || $number_of_digits == 5)
        $ext = "k";
    if ($number_of_digits == 6 || $number_of_digits == 7)
        $ext = "L";
    if ($number_of_digits == 8 || $number_of_digits == 9)
        $ext = "Cr";

    $data = $fraction . " " . $ext;
    //$data = $fraction;
    return $data;
}
?>

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
                                <div class="col-md-5">
                                    <h4>Welcome to <?php echo $_SESSION['username']; ?> </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-6">
                                <div class="float-left mini-stat-img mr-4">
                                    <img src="<?php echo base_url() ?>assetsadmin/images/services-icon/01.png" alt="">
                                </div>
                                <h3 class="font-size-16 text-uppercase mt-0 text-white-50">Total Member</h3>
                                <div class="row">
                                    <div class="col-md-7">
                                        <!-- <h6>In Amount </h6> -->
                                    </div>
                                    <div class="col-md-5">
                                        <h5 class="font-weight-medium font-size-24">
                                            
                                             <?php if (isset($TotalCustomer)) {
                                                echo count($TotalCustomer);
                                            } else {
                                                echo "0.00";
                                            } ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-6">
                                <div class="float-left mini-stat-img mr-4" style="width: 47px;">
                                    <img src="<?php echo base_url() ?>assetsadmin/images/services-icon/02.png" alt="">
                                </div>
                                <h3 class="font-size-16 text-uppercase mt-0 text-white-50"> Membership Plan </h3>
                                <div class="row">
                                    <div class="col-md-8">
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="font-weight-medium font-size-24">
                                        <?php if (isset($TotalProduct)) {
                                                echo count($TotalProduct);
                                            } else {
                                                echo "0.00";
                                            } ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-6">
                                <div class="float-left mini-stat-img mr-4">
                                    <img src="<?php echo base_url() ?>assetsadmin/images/services-icon/04.png" alt="">
                                </div>
                                <h3 class="font-size-16 text-uppercase mt-0 text-white-50">Total Payment</h3>
                                <div class="row">
                                    <div class="col-md-8">
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="font-weight-medium font-size-24">
                                            <?php if (isset($TotalProduct)) {
                                                echo count($TotalProduct);
                                            } else {
                                                echo "0.00";
                                            } ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card mini-stat bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-6">
                                <div class="float-left mini-stat-img mr-4">
                                    <img src="<?php echo base_url() ?>assetsadmin/images/services-icon/03.png" alt="">
                                </div>
                                <h3 class="font-size-16 text-uppercase mt-0 text-white-50">Total Due Payment </h3>
                                <div class="row">
                                    <div class="col-md-8">
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="font-weight-medium font-size-24">
                                        <?php
                                            if (isset($TotalStockAmount)) {
                                                $totalstk = currencyformate($TotalStockAmount);
                                                echo $totalstk;
                                            } else {
                                                echo "0.00";
                                            }
                                            ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
