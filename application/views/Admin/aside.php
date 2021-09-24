    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="slimscroll-menu" id="remove-scroll">
            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu" id="side-menu">
                    <!-- <li class="menu-title">Main</li> -->
                    <?php 
                        if(isset($_SESSION["adminid"]))
                        {
                    ?>
                        <li>
                            <a href="<?php echo base_url()?>index.php/Admin/dashboard" class="waves-effect"><i class="ti-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                       
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-calendar"></i><span> Award <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
                            <ul class="submenu">
                                <li><a href="<?php echo base_url()?>index.php/Admin/award">Add  Award </a></li>
                                <li><a href="<?php echo base_url()?>index.php/Admin/listaward"> List Award </a></li>
                                <!-- <li><a href="<?php echo base_url()?>index.php/Admin/memberimport"> Import </a></li> -->
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-calendar"></i><span> Department <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
                            <ul class="submenu">
                                <li><a href="<?php echo base_url()?>index.php/Admin/department">Add Department </a></li>
                                <li><a href="<?php echo base_url()?>index.php/Admin/listdepartment"> List Department </a></li>
                                <!-- <li><a href="<?php echo base_url()?>index.php/Admin/planimport"> Import </a></li> -->
                            </ul>
                        </li>
						<li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-calendar"></i><span> Employees <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
                            <ul class="submenu">
							<li><a href="<?php echo base_url()?>index.php/Admin/manageemployee" >Add Employees </a></li>
                              
                                
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url()?>index.php/Admin/holiday" class="waves-effect"><i class="ti-calendar"></i><span> Holiday </span></a></li> 
			
						<li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-calendar"></i><span> Leave Application <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
                            <ul class="submenu">
							<li><a href="<?php echo base_url()?>index.php/Admin/leavetype" class="waves-effect">	Add Leave type </a></li>
                                <li><a href="<?php echo base_url()?>index.php/Admin/addleave"> 	Add Leave Application </a></li>
                                <li><a href="<?php echo base_url()?>index.php/Admin/listaddleave"> 	List Leave Application </a></li>
                                
                            </ul>
                        </li>
						<li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-calendar"></i><span> Recruitment <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
                            
							<ul class="submenu"><span>Candidate Information</span>
							<li><a href="<?php echo base_url()?>index.php/Admin/addCandidate" class="waves-effect">	Add new Candidate  </a></li>
                                <li><a href="<?php echo base_url()?>index.php/Admin/listCandidate"> 		List Candidate </a></li>
								<li><a href="<?php echo base_url()?>index.php/Admin/Shortlist">     Candidate Shortlist   </a></li>
                                
                            </ul>
							<ul class="submenu"><span>Interview </span>
							<li><a href="<?php echo base_url()?>index.php/Admin/addinterview" class="waves-effect">	 new Candidate  Interview </a></li>
                                <li><a href="<?php echo base_url()?>index.php/Admin/listinterview"> 		List Interview </a></li>
                                
                            </ul>
							<ul class="submenu"><span>Candidate Selection </span>
							<li><a href="<?php echo base_url()?>index.php/Admin/addselection" class="waves-effect">	 new Candidate  Selection </a></li>
                                <li><a href="<?php echo base_url()?>index.php/Admin/listselection"> 		List Selection </a></li>
                                
                            </ul>
							
                        </li>
						<li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-calendar"></i><span> Payroll  <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
                            <ul class="submenu">
							<li><a href="<?php echo base_url()?>index.php/Admin/manageemployee" class="waves-effect">	Salary generate Employees </a></li>
                                
                                
                            </ul>
                        </li>
                        <!-- <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-calendar"></i><span> Alert <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
                            <ul class="submenu">
                                <li><a href="<?php echo base_url()?>index.php/Admin/unpaidmember">Unpaid Member </a></li>
                                <li><a href="<?php echo base_url()?>index.php/Admin/endingmember"> Ending Member </a></li>
                            </ul>
                        </li> 
                        <li><a href="<?php echo base_url()?>index.php/Admin/payment" class="waves-effect"><i class="ti-calendar"></i><span> Payment </span></a></li>
                        <li><a href="<?php echo base_url()?>index.php/Admin/attendance" class="waves-effect"><i class="ti-calendar"></i><span> Attendance </span></a></li>
                        <li><a href="<?php echo base_url()?>index.php/Admin/attendancetrainer" class="waves-effect"><i class="ti-calendar"></i><span>Trainer Attendance </span></a></li>
                        
                         <li><a href="<?php echo base_url()?>index.php/Admin/attendance" class="waves-effect"><i class="ti-calendar"></i><span> BMI </span></a></li>
                        <li><a href="<?php echo base_url()?>index.php/Admin/equipment" class="waves-effect"><i class="ti-calendar"></i><span> Equipment Stock </span></a></li> -->
                        <li><a href="<?php echo base_url()?>index.php/Admin/inquiry" class="waves-effect"><i class="ti-calendar"></i><span> inquiry </span></a></li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-email"></i><span> Report <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
                            <ul class="submenu">
                                <li><a href="<?php echo base_url()?>index.php/Admin/purchasereport"> Purchase Report </a></li>
                                <li><a href="<?php echo base_url()?>index.php/Admin/salereport"> Sale Report </a></li>
                            </ul>
                        </li>
                    <?php 
                        }
                        else
                        {
                    ?>
                        <li>
                            <a href="<?php echo base_url()?>index.php/Admin/employeedashboard" class="waves-effect"><i class="ti-home"></i>
                                <!-- <span class="badge badge-primary badge-pill float-right">2</span> --> 
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li><a href="<?php echo base_url()?>index.php/Admin/attendancetrainer" class="waves-effect"><i class="ti-calendar"></i><span>Trainer Attendance </span></a></li>

                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="ti-calendar"></i><span> Member <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
                            <ul class="submenu">
                                <li><a href="<?php echo base_url()?>index.php/Admin/member">Add  Member </a></li>
                                <li><a href="<?php echo base_url()?>index.php/Admin/listmember"> List Member </a></li>
                            </ul>
                        </li>
                    <?php
                        }
                    ?>
                    <li><a href="<?php echo base_url()?>index.php/Admin/logout" class="waves-effect"><i class="ti-calendar"></i><span> Logout </span></a></li>
                </ul>
            </div>
            <!-- Sidebar -->
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -left -->
    </div>
    <!-- Left Sidebar End -->
    <!-- ============================================================== --->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">