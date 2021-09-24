<?php
    if(!isset($_SESSION['username'])) 
      redirect(base_url("index.php/Admin/index"));
?>
<!DOCTYPE html><html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
        <title>Hr Management</title>        
        <link rel="shortcut icon" href="<?php echo base_url()?>assetsadmin/images/favicon.ico">
        <!-- DataTables -->
        <link href="<?php echo base_url()?>assetsadmin/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url()?>assetsadmin/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
        <!-- Responsive datatable examples -->
        <link href="<?php echo base_url()?>assetsadmin/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url()?>assetsadmin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url()?>assetsadmin/css/metismenu.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url()?>assetsadmin/css/icons.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url()?>assetsadmin/css/style.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url();?>assetsadmin/plugins/select2/css/select2.min.css" rel="stylesheet"/>
        <link href="<?php echo base_url()?>assetsadmin/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
        <script src="<?php echo base_url()?>assetsadmin/js/jquery.min.js"></script>
    </head>

    <body>
        <!-- Image loader -->
<div id='loader' style='display: none;'>
  <img src='<?php echo base_url()?>assetadmin/images/reload.gif' width='32px' height='32px'>
</div>
<!-- Image loader -->
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="index.html" class="logo">
                        <span><img src="<?php echo base_url()?>assetsadmin/images/logo-light.png" alt="" height="18"> </span>
                        <i><img src="<?php echo base_url()?>assetsadmin/images/logo-sm.png" alt="" height="22"></i>
                    </a>
                </div>
                <nav class="navbar-custom">
                    <!--<ul class="navbar-right list-inline float-right mb-0">
                         <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                            <form role="search" class="app-search">
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control" placeholder="Search.."> 
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </li> -->

                        <!-- language -->
                        <!-- <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="<?php echo base_url()?>assetsadmin/images/flags/us_flag.jpg" class="mr-2" height="12" alt=""> English <span class="mdi mdi-chevron-down"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right language-switch">
                                <a class="dropdown-item" href="#">
                                    <img src="<?php echo base_url()?>assetsadmin/images/flags/germany_flag.jpg" alt="" height="16"><span>German </span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <img src="<?php echo base_url()?>assetsadmin/images/flags/italy_flag.jpg" alt="" height="16"><span>Italian </span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <img src="<?php echo base_url()?>assetsadmin/images/flags/french_flag.jpg" alt="" height="16"><span>French </span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <img src="<?php echo base_url()?>assetsadmin/images/flags/spain_flag.jpg" alt="" height="16"><span>Spanish </span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <img src="<?php echo base_url()?>assetsadmin/images/flags/russia_flag.jpg" alt="" height="16"><span>Russian</span>
                                </a>
                            </div>
                        </li> -->

                        <!-- full screen -->
                        <!-- <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                            <a class="nav-link waves-effect" href="#" id="btn-fullscreen"><i class="mdi mdi-fullscreen noti-icon"></i></a>
                        </li> -->

                        <!-- notification -->
                        <!-- <li class="dropdown notification-list list-inline-item">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><i class="mdi mdi-bell-outline noti-icon"></i> <span class="badge badge-pill badge-danger noti-icon-badge">3</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                                <h6 class="dropdown-item-text">Notifications (258)</h6>
                                <div class="slimscroll notification-item-list">
                                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                        <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                        <p class="notify-details">Your order is placed<span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                                    </a>
                                    
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-warning"><i class="mdi mdi-message-text-outline"></i></div>
                                        <p class="notify-details">New Message received<span class="text-muted">You have 87 unread messages</span></p>
                                    </a>
                                    
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-info"><i class="mdi mdi-glass-cocktail"></i></div>
                                        <p class="notify-details">Your item is shipped<span class="text-muted">It is a long established fact that a reader will</span></p>
                                    </a>
                                    
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
                                        <p class="notify-details">Your order is placed<span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                                    </a>
                                    
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i></div>
                                        <p class="notify-details">New Message received<span class="text-muted">You have 87 unread messages</span></p>
                                    </a>
                                </div>
                                
                                <a href="javascript:void(0);" class="dropdown-item text-center text-primary">View all <i class="fi-arrow-right"></i>
                                </a>
                            </div>
                        </li>
                        <li class="dropdown notification-list list-inline-item">
                            <div class="dropdown notification-list nav-pro-img">
                                <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="<?php echo base_url()?>assetsadmin/images/users/user-4.jpg" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5"></i> Profile</a> 
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-wallet m-r-5"></i> My Wallet</a> 
                                    <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="mdi mdi-settings m-r-5"></i> Settings</a> 
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5"></i> Lock screen</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="#"><i class="mdi mdi-power text-danger"></i> Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>-->
                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-effect"><i class="mdi mdi-menu"></i></button>
                        </li>
                        <!-- <li class="d-none d-sm-block">
                            <div class="dropdown pt-3 d-inline-block">
                                <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Create</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a> 
                                    <a class="dropdown-item" href="#">Another action</a> 
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Separated link</a>
                                </div>
                            </div>
                        </li> -->
                    </ul>
                </nav> 
            </div>
            <!-- Top Bar End -->