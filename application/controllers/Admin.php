<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ( function_exists( 'date_default_timezone_set' ) ) {
    date_default_timezone_set('Asia/Kolkata');
}

class Admin extends CI_Controller {

	public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();   
        $this->load->model('AdminModel');
    }

	public function index()
	{
		$this->load->view('Admin/loginpage');
	}

	public function login()
	{
		if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) 
        {
            $uname = $_REQUEST['username'];
			$pass = $_REQUEST['password'];
			
            //check login
            $res = $this->AdminModel->checkLogin($uname,$pass);
            //print_r($res);die;
            if(isset($res))
            {			
                if($_SESSION['usertype'] == "Admin")
                {         
                    redirect(base_url("index.php/Admin/dashboard"));     
                }
                elseif($_SESSION['usertype'] == "employee")
                {      
                    redirect(base_url("index.php/Admin/employeedashboard")); 
                }
            }
            else
            {
                $_SESSION['ErrSucc'] = "Invalid Username and Password....";
                redirect(base_url("index.php/Admin/index"));
            }
        }
        else
        {
            redirect(base_url("index.php/Admin/index"));
        }
    }

    public function logout()
    {
        session_unset();
        //session_destroy();
        redirect(base_url("index.php/Admin/index"));
    } 
    
    public function dashboard()
    {
        $todaydate = date("Y/m/d");
        $todaymonth = date("m");

        $emp_id = "";
        if(isset($_SESSION["employee_id"]))
        {
            $emp_id = $_SESSION["employee_id"];
        }

        //----------------------Total Available stock value -------------------
        $TotalStockAmount = $this->AdminModel->TotalStockAmount()->result();
        $totalstockamt = 0;
        if(isset($TotalStockAmount))
        {
            foreach ($TotalStockAmount as $tq) 
            {   $totalstockamt += $tq->stockprice;       }
        }
        $data["TotalStockAmount"] = $totalstockamt;

        //----------------------Total Stock Quantity -------------------
        $TotalQty = $this->AdminModel->TotalQuantity()->result();
        $totalqty = 0;
        if(isset($TotalQty))
        {
            foreach ($TotalQty as $tq) 
            {   $totalqty += $tq->stock;       }
        }
        $data["TodayQty"] = $totalqty;

        //----------------------Total plan -------------------
      //  $data["TotalProduct"] = $this->AdminModel->GetAllPlan()->result();
        //----------------------Total Member -------------------
        //$data["TotalCustomer"] = $this->AdminModel->GetAllMember()->result();



        //----------------------Today Total Sale-------------------
        $TodaySale = (object)$this->AdminModel->TotalSale($todaydate)->result();
        $todayamt = 0;
        if(isset($TodaySale))
        {
            foreach ($TodaySale as $tds) 
            {   $todayamt += $tds->inv_totalamt;       }
        }
        $data["TodaySale"] = $todayamt;

        //----------------------Weekly Total Sale-------------------
        $WeeklySale = (object)$this->AdminModel->WeeklySale($todaydate)->result();
        $weeklyamt = 0;
        if(isset($WeeklySale))
        {
            foreach ($WeeklySale as $ws) 
            {   $weeklyamt += $ws->inv_totalamt;       }
        }
        $data["WeeklySale"] = $weeklyamt;

        //----------------------Monthly Total Sale-------------------
        $MonthlySale = (object)$this->AdminModel->MonthlySale($todaymonth)->result();
        $monthlyamt = 0;
        if(isset($MonthlySale))
        {
            foreach ($MonthlySale as $ms) 
            {   $monthlyamt += $ms->inv_totalamt;       }
        }
        $data["MonthlySale"] = $monthlyamt;

        //----------------------Overall Total Sale-------------------
        $TotalSale = (object)$this->AdminModel->TotalSale()->result();
        $totalamt = 0;
        if(isset($TotalSale))
        {
            foreach ($TotalSale as $ts) 
            {   $totalamt += $ts->inv_totalamt;       }
        }
        $data["TotalSale"] = $totalamt;



        //----------------------Product Wise Sale-------------------
        $data["todayprod_sale"] = (object)$this->AdminModel->ProductWiseSale($todaydate)->result();             //today sell
        $data["totalprod_sale"] = (object)$this->AdminModel->ProductWiseSale()->result();                       //total sell


        //----------------------Employee Wise Sell-------------------
        $data["Emptoday_sale"] = (object)$this->AdminModel->EmployeeWiseSale($todaydate,$emp_id)->result();     //Emp today sell
        $data["Emptotal_sale"] = (object)$this->AdminModel->EmployeeWiseSale(null,$emp_id)->result();           //Emp total sell


        //----------------------Product Wise Stock------------------
        $data["prod_stock"] = (object)$this->AdminModel->ProductWiseStock()->result();                          //today stock
        $data["prod_stock_value"]= (object)$this->AdminModel->ProductWiseStock()->result();                     //total stock value
        
        //----------------------Product Wise Stock------------------
        $data["prod_stock"] = (object)$this->AdminModel->ProductWiseStock()->result();                          //today stock
        $data["prod_stock_value"]= (object)$this->AdminModel->ProductWiseStock()->result();                     //total stock value
     
        //-------------------------shop wise stock-----------------------     
         $data["shop_stock"] = (object)$this->AdminModel->shopWiseStock()->result();                          //today stock
         $data["shop_stock_value"]= (object)$this->AdminModel->shopWiseStock()->result();     
         $data["shop_stock_value"]= (object)$this->AdminModel->shopWiseStock()->result();     

         //transfer wise shop

        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/index',$data);
        $this->load->view('Admin/footer');
    }

    public function employeedashboard()
    {
        $todaydate = date("Y/m/d");
        $emp_id = "";
        if(isset($_SESSION["employee_id"]))
        {
            $emp_id = $_SESSION["employee_id"];
        }
        //Today sell by Employee
        $TodaySale = (object)$this->AdminModel->TotalSale($todaydate,$emp_id)->result();
        $todayamt = 0;
        if(isset($TodaySale))
        {
            foreach ($TodaySale as $tdse) 
            {   $todayamt += $tdse->inv_totalamt;       }
        }
        $data["TodaySale"] = $todayamt;

        //Total sell by Employee
        $TotalSale = (object)$this->AdminModel->TotalSale(null,$emp_id)->result();
        $totalamt = 0;
        if(isset($TotalSale))
        {
            foreach ($TotalSale as $ttse) 
            {   $totalamt += $ttse->inv_totalamt;       }
        }
        $data["TotalSale"] = $totalamt;

        //----------------------Product Wise Sale-------------------
        //----------------------Today data--------------------------
        $data["todayprod_sale_emp"] = (object)$this->AdminModel->ProductWiseSale($todaydate,$emp_id)->result();
        $data["totalprod_sale_emp"] = (object)$this->AdminModel->ProductWiseSale(null,$emp_id)->result();        

        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/empindex',$data);
        $this->load->view('Admin/footer');
    }
 
// ------------------- Change Password ----------------------
    public function changepassword()
    {   
        $user = "";
        if(isset($_SESSION['employee_id']))
        {
            $user =  $_SESSION['employee_id']; 
        }
        else if(isset($_SESSION['adminid']))
        {
            $user = $_SESSION['adminid'];    
        }
        else
        {
            $user = "";
        }
        
        $this->load->view("Admin/header");
        $this->load->view("Admin/aside");
        $this->load->view("Admin/changepassword",$user);
        $this->load->view("Admin/footer");
    }

    public function EmpPasswordInsert()
    {
        $employee_id = $_REQUEST['user'];
        $new_password = $_REQUEST['new_password'];

        $data = array( 'employee_password' => $new_password  );

        if($employee_id > 0)
        {        
            $res = $this->AdminModel->UpdateEmployee($data,$employee_id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "Employee Password Updated Succesfully....";
                redirect(base_url("index.php/Admin/changepassword"));
            }   
            else
            {
                $_SESSION['ErrSucc'] = "Employee not able to update.....";
                redirect(base_url("index.php/Admin/changepassword"));
            } 
        }
    }

    public function AdminPasswordInsert()
    {
        $adminid = $_REQUEST['user'];
        $new_password = $_REQUEST['new_password'];

        $data = array('password' => $new_password );

        if($adminid > 0)
        {        
            $res = $this->AdminModel->UpdateAdmin($data,$adminid);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "Admin Password Updated Succesfully....";
                redirect(base_url("index.php/Admin/changepassword"));
            }   
            else
            {
                $_SESSION['ErrSucc'] = "Admin not able to update.....";
                redirect(base_url("index.php/Admin/changepassword"));
            } 
        }
    }

    
// ------------------- Manage Customer ----------------------
    public function managecustomer()
    {
        $data["managecustomer"] = $this->AdminModel->GetAllCustomer()->result();
       
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/customer',$data);
        $this->load->view('Admin/footer');
    }

    public function ConfirmCustomer()
    {
        $customer_id = $_REQUEST["customer_id"];
        $data = array('customer_status' => 2);

        $res = $this->AdminModel->UpdateCustomer($data,$customer_id);
        if($res > 0)
        {
            $_SESSION['ErrSucc'] = "Customer Confirm Succesfully....";
            /*redirect(base_url("index.php/Admin/manageemi"));*/
            echo 1;
        }   
        else
        {
            $_SESSION['ErrSucc'] = "Customer not able to confirm.....";
            /*redirect(base_url("index.php/Admin/manageemi"));*/
            echo 2;
        } 
    }

    public function CustomerInsert()
    {
        $user_id = 0;
        $customer_status = 1;
        if(isset($_SESSION['employee_id']))
        {
            $user_id = $_SESSION['employee_id'];
            $customer_status = 1;
        }
        else
        {
            $user_id = 0;
            $customer_status = 2;
        }

        $customer_id = $_REQUEST['customer_id'];
        $customer_name = $_REQUEST['customer_name'];
        $customer_mobile = $_REQUEST['customer_mobile'];
        $customer_email = $_REQUEST['customer_email'];
        $customer_address = $_REQUEST['customer_address'];

        
        $data = array(  'customer_id' => $customer_id,
                        'customer_name' => $customer_name,
                        'customer_mobile' => $customer_mobile,
                        'customer_email' => $customer_email,
                        'customer_address' => $customer_address,
                        'customer_status' => $customer_status,
                        'user_status' => $user_id,
                    );
        
        if($customer_id > 0)
        {        
            $res = $this->AdminModel->UpdateCustomer($data,$customer_id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "Customer Updated Succesfully....";
                redirect(base_url("index.php/Admin/managecustomer"));
            }   
            else
            {
                $_SESSION['ErrSucc'] = "Customer not able to update.....";
                redirect(base_url("index.php/Admin/managecustomer"));
            } 
        }
        else
        {
            $res1 = $this->AdminModel->InsertCustomer($data);
            if($res1 > 0)
            {
                $_SESSION['ErrSucc'] = "Customer Added Succesfully....";
                redirect(base_url("index.php/Admin/managecustomer"));
            }   
            else
            {
                $_SESSION['ErrSucc'] = "Customer not able to add.....";
                redirect(base_url("index.php/Admin/managecustomer"));
            } 
        }
    }

    public function EditCustomer()
    {
        $customer_id = $_REQUEST['customer_id'];

        $res = $this->AdminModel->GetAllCustomer($customer_id)->row();
        if($res != null)
        {
            echo $res->customer_id.','.$res->customer_name.','.$res->customer_mobile.','.$res->customer_email.','.$res->customer_address;
        }
        else
        {
            echo '0';
        }
    }

	public function DeleteCustomer()
	{
		$customer_id = $_REQUEST['customer_id'];
           
	    $res1 = $this->AdminModel->DeleteCustomer($customer_id);
		if($res1 > 0)
        {
            $this->db->trans_complete();
            $_SESSION['ErrSucc'] = "Delete Customer Successfully";
        }  
        else
        {
            $this->db->trans_complete();
            $_SESSION['ErrSucc'] = "Problem Occured Try Again";
        }
        
    }

// ------------------- Manage Category ----------------------
    public function managecategory()
    {
        $data["managecategory"] = $this->AdminModel->GetAllCategory()->result();

        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/category',$data);
        $this->load->view('Admin/footer');
    }

    public function categoryInsert()
    {
        $category_id = $_REQUEST['category_id'];
        $category_name = $_REQUEST['category_name'];
        $category_digit = $_REQUEST['category_digit'];

        $data = array( 'category_name' => $category_name,
                       'category_digit' => $category_digit );

        if($category_id > 0)
        {        
            $res = $this->AdminModel->UpdateCategory($data,$category_id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "Category Updated Succesfully....";
                redirect(base_url("index.php/Admin/managecategory"));
                //echo 3;
            }   
            else
            {
                $_SESSION['ErrSucc'] = "Category Not able to update.....";
                //echo 4;
                redirect(base_url("index.php/Admin/managecategory"));
            } 
        }
        else
        {
            $res1 = $this->AdminModel->InsertCategory($data);
            if($res1 > 0)
            {
                $_SESSION['ErrSucc'] = "Category Added Succesfully....";
                //echo 1;
                redirect(base_url("index.php/Admin/managecategory"));
            }   
            else
            {
                //echo 2;
                $_SESSION['ErrSucc'] = "Category Not able to add.....";
                redirect(base_url("index.php/Admin/managecategory"));
            } 
        }
    }

    public function EditCategory()
    {
        $category_id = '';

        if(isset($_REQUEST['category_id']))
        {
            $category_id = $_REQUEST['category_id'];
        }        

        if($category_id !='')
        {
            $res = $this->AdminModel->GetAllCategory($category_id)->row();
            
            if($res != null)
            {
                echo $res->category_id.','.$res->category_name.','.$res->category_digit;
            }
            else
            {
                echo '0';
            }
        }
        else
        {
            echo '0';
        }
    }

    public function DeleteCategory()
    {
        $category_id = $_REQUEST['category_id'];

        $res = $this->AdminModel->DeleteCategory($category_id);
        if($res > 0)
        {
            $_SESSION['ErrSucc'] = "Category Delete Succesfully....";
            echo 1;
        }
        else
        {
            $_SESSION['ErrSucc'] = "Category Not Found....";
            echo 0;
        }
    }

// ------------------- Manage Terms -------------------------
    public function manageterms()
    {
        $data["manageterms"] = $this->AdminModel->GetAllterms()->result();

        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/terms',$data);
        $this->load->view('Admin/footer');
    }

    public function TermsInsert()
    {
        $terms_id = $_REQUEST['terms_id'];
        $terms_detail = $_REQUEST['terms_detail'];

        $data = array( 'terms_detail' => $terms_detail );

        if($terms_id > 0)
        {        
            $res = $this->AdminModel->UpdateTerms($data,$terms_id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "Terms Updated Succesfully....";
                redirect(base_url("index.php/Admin/manageterms"));
                //echo 3;
            }   
            else
            {
                $_SESSION['ErrSucc'] = "Terms Not able to update.....";
                //echo 4;
                redirect(base_url("index.php/Admin/manageterms"));
            } 
        }
        else
        {
            $res1 = $this->AdminModel->InsertTerms($data);
            if($res1 > 0)
            {
                $_SESSION['ErrSucc'] = "Terms Added Succesfully....";
                //echo 1;
                redirect(base_url("index.php/Admin/manageterms"));
            }   
            else
            {
                //echo 2;
                $_SESSION['ErrSucc'] = "Terms Not able to add.....";
                redirect(base_url("index.php/Admin/manageterms"));
            } 
        }
    }

    public function EditTerms()
    {
        $terms_id = '';

        if(isset($_REQUEST['terms_id']))
        {
            $terms_id = $_REQUEST['terms_id'];
        }        

        if($terms_id !='')
        {
            $res = $this->AdminModel->GetAllTerms($terms_id)->row();
            
            if($res != null)
            {
                echo $res->terms_id.'^'.$res->terms_detail;
            }
            else
            {
                echo '0';
            }
        }
        else
        {
            echo '0';
        }
    }

    public function DeleteTerms()
    {
        $terms_id = $_REQUEST['terms_id'];

        $res = $this->AdminModel->DeleteTerms($terms_id);
        if($res > 0)
        {
            $_SESSION['ErrSucc'] = "Terms Delete Succesfully....";
            echo 1;
        }
        else
        {
            $_SESSION['ErrSucc'] = "Terms Not Found....";
            echo 0;
        }
    }

// ------------------- Manage Financial Year ----------------
    public function managefinancialyear()
    {
        $data["managefinancialyear"] = $this->AdminModel->GetAllFinancialYear()->result();

        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/financialyear',$data);
        $this->load->view('Admin/footer');
    }

    public function FinancialYearInsert()
    {
        $financialyear_id = $_REQUEST['financialyear_id'];
        $financial_name = $_REQUEST['financial_name'];
        $start_date = $_REQUEST['start_date'];
        $end_date = $_REQUEST['end_date'];

        $data = array( 'financial_name' => $financial_name,
                       'start_date' => $start_date,
                       'end_date' => $end_date );

        if($financialyear_id > 0)
        {        
            $res = $this->AdminModel->UpdateFinancialYear($data,$financialyear_id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "Financial Year Updated Succesfully....";
                redirect(base_url("index.php/Admin/managefinancialyear"));
                //echo 3;
            }   
            else
            {
                $_SESSION['ErrSucc'] = "Financial Year Not able to update.....";
                //echo 4;
                redirect(base_url("index.php/Admin/managefinancialyear"));
            } 
        }
        else
        {
            $res1 = $this->AdminModel->InsertFinancialYear($data);
            if($res1 > 0)
            {
                $_SESSION['ErrSucc'] = "Financial Year Added Succesfully....";
                //echo 1;
                redirect(base_url("index.php/Admin/managefinancialyear"));
            }   
            else
            {
                //echo 2;
                $_SESSION['ErrSucc'] = "Financial Year Not able to add.....";
                redirect(base_url("index.php/Admin/managefinancialyear"));
            } 
        }
    }

    public function EditFinancialYear()
    {
        $financialyear_id = '';

        if(isset($_REQUEST['financialyear_id']))
        {
            $financialyear_id = $_REQUEST['financialyear_id'];
        }        

        if($financialyear_id !='')
        {
            $res = $this->AdminModel->GetAllFinancialYear($financialyear_id)->row();
            
            if($res != null)
            {
                echo $res->financialyear_id.','.$res->financial_name.','.$res->start_date.','.$res->end_date;
            }
            else
            {
                echo '0';
            }
        }
        else
        {
            echo '0';
        }
    }

    public function DeleteFinancialYear()
    {
        $financialyear_id = $_REQUEST['financialyear_id'];

        $res = $this->AdminModel->DeleteFinancialYear($financialyear_id);
        if($res > 0)
        {
            $_SESSION['ErrSucc'] = "Financial Year Delete Succesfully....";
            echo 1;
        }
        else
        {
            $_SESSION['ErrSucc'] = "Financial Year Not Found....";
            echo 0;
        }
    }

// ------------------- Manage PaymentTerm -------------------
    public function managepaymentterm()
    {
        $data["managepaymentterm"] = $this->AdminModel->GetAllPaymentTerm()->result();

        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/paymentterm',$data);
        $this->load->view('Admin/footer');
    }

    public function PaymentTermInsert()
    {
        $payment_term_id = $_REQUEST['payment_term_id'];
        $payment_term_name = $_REQUEST['payment_term_name'];

        $data = array('payment_term_name' => $payment_term_name );
        
        if($payment_term_id > 0)
        {        
            $res = $this->AdminModel->UpdatePaymentTerm($data,$payment_term_id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "Payment Term Updated Succesfully....";
                redirect(base_url("index.php/Admin/managepaymentterm"));
            }   
            else
            {
                $_SESSION['ErrSucc'] = "Payment Term not able to update.....";
                redirect(base_url("index.php/Admin/managepaymentterm"));
            } 
        }
        else
        {
            $res1 = $this->AdminModel->InsertPaymentTerm($data);
            if($res1 > 0)
            {
                $_SESSION['ErrSucc'] = "Payment Term Added Succesfully....";
                redirect(base_url("index.php/Admin/managepaymentterm"));
            }   
            else
            {
                $_SESSION['ErrSucc'] = "Payment Term not able to add.....";
                redirect(base_url("index.php/Admin/managepaymentterm"));
            } 
        }
    }

    public function EditPaymentTerm()
    {
        $payment_term_id = '';

        if(isset($_REQUEST['payment_term_id']))
        {
            $payment_term_id = $_REQUEST['payment_term_id'];
        }        

        if($payment_term_id !='')
        {
            $res = $this->AdminModel->GetAllPaymentTerm($payment_term_id)->row();
            
            if($res != null)
            {
                echo $res->payment_term_id.','.$res->payment_term_name;
            }
            else
            {
                echo '0';
            }
        }
        else
        {
            echo '0';
        }
    }

    public function DeletePaymentTerm()
    {
        $payment_term_id = $_REQUEST['payment_term_id'];

        $res = $this->AdminModel->DeletePaymentTerm($payment_term_id);
        if($res > 0)
        {
            $_SESSION['ErrSucc'] = "PaymentTerm Delete Succesfully....";
            echo 1;
        }
        else
        {
            $_SESSION['ErrSucc'] = "PaymentTerm Not Found....";
            echo 0;
        }
    }

// ------------------- Manage Brand -------------------------
    public function managebrand()
    {
        $data["managebrand"] = $this->AdminModel->GetAllBrand()->result();

        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/brand',$data);
        $this->load->view('Admin/footer');
    }

    public function brandInsert()
    {
        $brand_id = $_REQUEST['brand_id'];
        $brand_name = $_REQUEST['brand_name'];

        $data = array( 'brand_name' => $brand_name );

        if($brand_id > 0)
        {        
            $res = $this->AdminModel->UpdateBrand($data,$brand_id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "Brand Updated Succesfully....";
                redirect(base_url("index.php/Admin/managebrand"));
                //echo 3;
            }   
            else
            {
                $_SESSION['ErrSucc'] = "Brand Not able to update.....";
                //echo 4;
                redirect(base_url("index.php/Admin/managebrand"));
            } 
        }
        else
        {
            $res1 = $this->AdminModel->InsertBrand($data);
            if($res1 > 0)
            {
                $_SESSION['ErrSucc'] = "Brand Added Succesfully....";
                //echo 1;
                redirect(base_url("index.php/Admin/managebrand"));
            }   
            else
            {
                //echo 2;
                $_SESSION['ErrSucc'] = "Brand Not able to add.....";
                redirect(base_url("index.php/Admin/managebrand"));
            } 
        }
    }

    public function EditBrand()
    {   
        $brand_id = '';

        if(isset($_REQUEST['brand_id']))
        {
            $brand_id = $_REQUEST['brand_id'];
        }        

        if($brand_id !='')
        {
            $res = $this->AdminModel->GetAllBrand($brand_id)->row();
            
            if($res != null)
            {
                echo $res->brand_id.','.$res->brand_name;
            }
            else
            {
                echo '0';
            }
        }
        else
        {
            echo '0';
        }
    }

    public function DeleteBrand()
    {
        $brand_id = $_REQUEST['brand_id'];

        $res = $this->AdminModel->DeleteBrand($brand_id);
        if($res > 0)
        {
            $_SESSION['ErrSucc'] = "Brand Delete Succesfully....";
            echo 1;
        }
        else
        {
            $_SESSION['ErrSucc'] = "Brand Not Found....";
            echo 0;
        }
    }

// ------------------- Manage Tax ---------------------------
    public function managetax()
    {
        $data["managetax"] = $this->AdminModel->GetAllTax()->result();

        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/tax',$data);
        $this->load->view('Admin/footer');
    }

    public function taxInsert()
    {
        $tax_id = $_REQUEST['tax_id'];
        $tax_name = $_REQUEST['tax_name'];
        $tax_rate = $_REQUEST['tax_rate'];

        $data = array( 'tax_name' => $tax_name,
                       'tax_rate' => $tax_rate );

        if($tax_id > 0)
        {        
            $res = $this->AdminModel->UpdateTax($data,$tax_id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "Tax Updated Succesfully....";
                redirect(base_url("index.php/Admin/managetax"));
                //echo 3;
            }   
            else
            {
                $_SESSION['ErrSucc'] = "Tax Not able to update.....";
                //echo 4;
                redirect(base_url("index.php/Admin/managetax"));
            } 
        }
        else
        {
            $res1 = $this->AdminModel->InsertTax($data);
            if($res1 > 0)
            {
                $_SESSION['ErrSucc'] = "Tax Added Succesfully....";
                //echo 1;
                redirect(base_url("index.php/Admin/managetax"));
            }   
            else
            {
                //echo 2;
                $_SESSION['ErrSucc'] = "Tax Not able to add.....";
                redirect(base_url("index.php/Admin/managetax"));
            } 
        }
    }

    public function EditTax()
    {   
        $tax_id = '';

        if(isset($_REQUEST['tax_id']))
        {
            $tax_id = $_REQUEST['tax_id'];
        }        

        if($tax_id !='')
        {
            $res = $this->AdminModel->GetAllTax($tax_id)->row();
            
            if($res != null)
            {
                echo $res->tax_id.','.$res->tax_name.','.$res->tax_rate;
            }
            else
            {
                echo '0';
            }
        }
        else
        {
            echo '0';
        }
    }

    public function DeleteTax()
    {
        $tax_id = $_REQUEST['tax_id'];

        $res = $this->AdminModel->DeleteTax($tax_id);
        if($res > 0)
        {
            $_SESSION['ErrSucc'] = "Tax Delete Succesfully....";
            echo 1;
        }
        else
        {
            $_SESSION['ErrSucc'] = "Tax Not Found....";
            echo 0;
        }
    }

//-------------------- State --- City -----------------------
    public function selectStateBycountryid()
    {
        $country_id = $_REQUEST['country_id'];
        $res = $this->AdminModel->GetAllStateBycountryid($country_id);
        echo $res;
    }

    public function selectCityBystateid()
    {
        $state_id = $_REQUEST['state_id'];
        $res = $this->AdminModel->GetAllStateBystateid($state_id);
        echo $res;
    }

// ------------------- Manage Supplier ----------------------
    public function managesupplier()
    {
        $supplier = $this->AdminModel->GetAllSupplier()->result();
        $allsupplier = array();
        foreach ($supplier as $s) 
        {
            $supplier_id = $s->supplier_id;
            $str = (object)$this->AdminModel->GetAllPurchase1(null,$supplier_id)->result();

            $total_remain = 0;
            $total_pay = 0;

            foreach ($str as $d) 
            {
                $total_remain += $d->remain_amount;
                $total_pay += $d->pay_amount;
            }

            $s->total_remain_amount = $total_remain;
            $s->total_pay_amount = $total_pay;

            array_push($allsupplier,$s);
        }
        $data["managesupplier"] = $allsupplier;
        
        $data['AllCountry'] = $this->AdminModel->GetAllCountry()->result();
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/supplier',$data);
        $this->load->view('Admin/footer');
    }

    public function supplierInsert()
    {
        $supplier_id = $_REQUEST['supplier_id'];
        $supplier_name = $_REQUEST['supplier_name'];
        $supplier_mobile = $_REQUEST['supplier_mobile'];
        $supplier_address = $_REQUEST['supplier_address'];
        $supplier_gstno = $_REQUEST['supplier_gstno'];
        $country_id = $_REQUEST['country_id'];
        $state_id = $_REQUEST['state_id'];
        $city_id = $_REQUEST['city_id'];
        $pincode = $_REQUEST['pincode'];

        $data = array( 'supplier_name' => $supplier_name,
                       'supplier_mobile' => $supplier_mobile,
                       'supplier_address' => $supplier_address,
                       'supplier_gstno' => $supplier_gstno,
                       'country_id' => $country_id,
                       'state_id' => $state_id,
                       'city_id' => $city_id,
                       'pincode' => $pincode );

        if($supplier_id > 0)
        {        
            $res = $this->AdminModel->UpdateSupplier($data,$supplier_id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "Supplier Updated Succesfully....";
                redirect(base_url("index.php/Admin/managesupplier"));
                //echo 3;
            }   
            else
            {
                $_SESSION['ErrSucc'] = "Supplier Not able to update.....";
                //echo 4;
                redirect(base_url("index.php/Admin/managesupplier"));
            } 
        }
        else
        {
            $res1 = $this->AdminModel->InsertSupplier($data);
            if($res1 > 0)
            {
                $_SESSION['ErrSucc'] = "Supplier Added Succesfully....";
                //echo 1;
                redirect(base_url("index.php/Admin/managesupplier"));
            }   
            else
            {
                //echo 2;
                $_SESSION['ErrSucc'] = "Supplier Not able to add.....";
                redirect(base_url("index.php/Admin/managesupplier"));
            } 
        }
    }

    public function EditSupplier()
    {   
        $supplier_id = '';

        if(isset($_REQUEST['supplier_id']))
        {
            $supplier_id = $_REQUEST['supplier_id'];
        }        

        if($supplier_id !='')
        {
            $res = $this->AdminModel->GetAllSupplier($supplier_id)->row();
            
            if($res != null)
            {
                echo $res->supplier_id.','.$res->supplier_name.','.$res->supplier_mobile.','.$res->supplier_address.','.$res->supplier_gstno.','.$res->country_id.','.$res->state_id.','.$res->city_id.','.$res->pincode;
            }
            else
            {
                echo '0';
            }
        }
        else
        {
            echo '0';
        }
    }

    public function DeleteSupplier()
    {
        $supplier_id = $_REQUEST['supplier_id'];

        $res = $this->AdminModel->DeleteSupplier($supplier_id);
        if($res > 0)
        {
            $_SESSION['ErrSucc'] = "Supplier Delete Succesfully....";
            echo 1;
        }
        else
        {
            $_SESSION['ErrSucc'] = "Supplier Not Found....";
            echo 0;
        }
    }

// ------------------- Manage Product -----------------------
    public function manageproduct()
    {
        $data["manageproduct"] = $this->AdminModel->GetAllProduct()->result();

        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/listproduct',$data);
        $this->load->view('Admin/footer');
    }

    public function addnewproduct()
    {
        $data["managecategory"] = $this->AdminModel->GetAllCategory()->result();
        $data["managebrand"] = $this->AdminModel->GetAllBrand()->result();
        $data["managetax"] = $this->AdminModel->GetAllTax()->result();

        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/addnewproduct',$data);
        $this->load->view('Admin/footer');
    }

    public function productInsert()
    {
        $Object = array();
        $Object = json_decode(file_get_contents('php://input'),true);

        foreach ($Object['result1'] as $obj1) 
        {
            $product_id = $obj1['product_id'];
            $product_name = $obj1['product_name'];
            $display_name = $obj1['display_name'];
            $product_desc = $obj1['product_desc'];
            $hsncode = $obj1['hsncode'];
            $category_id = $obj1['category_id'];
            $brand_id = $obj1['brand_id'];
            $purchase_tax = $obj1['purchase_tax'];
            $sale_tax = $obj1['sale_tax'];
            /*$type_of_discount = $obj1['type_of_discount'];
            $discount = $obj1['discount'];
            $tax_inclusion = $obj1['tax_inclusion'];*/
            //$product_varient = $obj1['product_varient'];
        }

        $varient_name = array();
        $barcode = array();
        /* $purchase_price = array();
        $customer_price = array();*/
        //$min_stock = array();

        foreach ($Object['result2'] as $obj2) 
        {
            $varient_name = $obj2['varient_name'];
            $barcode = $obj2['barcode'];
            /*$purchase_price = $obj2['purchase_price'];
            $customer_price = $obj2['customer_price'];*/
            /*$min_stock = $obj2['min_stock'];*/
        }

        //print_r($varient_name);die;
        $data = array( 'product_name' => $product_name,
                       'display_name' => $display_name,
                       'product_desc' => $product_desc,
                       'hsncode' => $hsncode,
                       'category_id' => $category_id,
                       'brand_id' => $brand_id,
                       'purchase_tax' => $purchase_tax,
                       'sale_tax' => $sale_tax
                       /*'type_of_discount' => $type_of_discount,
                       'discount' => $discount,
                       'tax_inclusion' => $tax_inclusion,*/
                       //'product_varient' => $product_varient 
                    );

        $productDetail = array();

        if($product_id == 0)
        {
            //Transaction
            $this->db->trans_start(); 
            $res1 = $this->AdminModel->InsertProduct($data);
            if($res1 > 0)
            {
                $res2 = $this->AdminModel->GetProductId($product_name)->row();
                //print_r($res2);die;
                if($res2 != null)
                {
                    $product_id = $res2->product_id;
                    
                    for($i = 0; $i < count($varient_name); $i++)
                    {
                        $detail = array('varient_name' => $varient_name[$i],
                                        'barcode' => $barcode[$i],
                                        /*'purchase_price' => $purchase_price[$i],
                                        'customer_price' => $customer_price[$i],*/
                                        /*'min_stock' => $min_stock[$i],*/
                                        'product_id' => $product_id );
                        array_push($productDetail, $detail); 
                    }
                    $res3 = $this->AdminModel->InsertProductDetail($productDetail);
                    if($res3 > 0)
                    {
                        $this->db->trans_complete();
                        $_SESSION['ErrSucc'] = "Product Created Successfully";
                    }  
                    else
                    {
                        $this->db->trans_complete();
                        $_SESSION['ErrSucc'] = "Problem Occured Product Detail Try Again";
                    } 
                }
                else
                {
                    $this->db->trans_complete();
                    $_SESSION['ErrSucc'] = "Problem Occured Get Product Id Try Again";
                }
            }   
            else
            {
                //echo 2;
                $this->db->trans_complete();
                $_SESSION['ErrSucc'] = "Product Not able to add.....";
               //redirect(base_url("index.php/Admin/manageproduct"));
            } 

            if ($this->db->trans_status() == FALSE)
            {
                $this->db->trans_rollback();
                echo 2;
            }
            else
            {
                $this->db->trans_commit();
                echo 1;
            }            
        }
        else
        {
            //Transaction  
            $this->db->trans_start();

            $res = $this->AdminModel->UpdateProduct($data,$product_id);
            
            if($res >= 0)
            {
                $res2 = $this->AdminModel->DeleteProductDetail($product_id);
                if($res2 > 0)
                {
                    for($i = 0; $i < count($varient_name); $i++)
                    {
                        $detail = array('varient_name' => $varient_name[$i],
                                        'barcode' => $barcode[$i],
                                        /*'purchase_price' => $purchase_price[$i],
                                        'customer_price' => $customer_price[$i],*/
                                        /*'min_stock' => $min_stock[$i],*/
                                        'product_id' => $product_id );
                        array_push($productDetail, $detail);  
                    }

                    $res3 = $this->AdminModel->InsertProductDetail($productDetail);
                    if($res3 > 0)
                    {
                        $this->db->trans_complete();
                        $_SESSION['ErrSucc'] = "Product Detail Updated Successfully";
                    }  
                    else{
                        $this->db->trans_complete();
                        $_SESSION['ErrSucc'] = "Problem Occured Product Detail Not Update Try Again";
                    } 
                }
                else
                {
                    $this->db->trans_complete();
                    $_SESSION['ErrSucc'] = "Problem Occured Delete Old Product Detail Try Again";
                }
            }
            else
            {
                $this->db->trans_complete();
                $_SESSION['ErrSucc'] = "Problem Occured Update Product Try Again";
            }

            if ($this->db->trans_status() == FALSE)
            {
                $this->db->trans_rollback();
                echo 4;
            }
            else
            {
                $this->db->trans_commit();
                echo 3;
            }
        }
    }

    public function EditProduct($product_id = null)
    {
        if($product_id !='' && $product_id != null)
        {
            $data["product"] = $this->AdminModel->GetAllProduct($product_id)->row();
            $data["productdetail"] = $this->AdminModel->GetAllProductDetail($product_id)->result();
            $data["managecategory"] = $this->AdminModel->GetAllCategory()->result();
            $data["managebrand"] = $this->AdminModel->GetAllBrand()->result();
            $data["managetax"] = $this->AdminModel->GetAllTax()->result();            
            
            $this->load->view('Admin/header');
            $this->load->view('Admin/aside');
            $this->load->view('Admin/addnewproduct',$data);
            $this->load->view('Admin/footer');
        }
        else
        {
            echo '0';
        }
    }

    public function DeleteProduct()
    {
        $product_id = $_REQUEST['product_id'];

        //$this->db->trans_start();
        $str = $this->AdminModel->DeleteProductDetail($product_id);
        if($str > 0)
        {
            $res = $this->AdminModel->DeleteProduct($product_id);
            if($res > 0)
            {
                $this->db->trans_complete();
                $_SESSION['ErrSucc'] = "Product Delete Succesfully....";
            }
            else
            {
                $this->db->trans_complete();
                $_SESSION['ErrSucc'] = "Product Not Delete....";
            }
        }
        else
        {
            $this->db->trans_complete();
            $_SESSION['ErrSucc'] = "Product Detail Not Delete ....";
        }

        if ($this->db->trans_status() == FALSE)
        {
            $this->db->trans_rollback();
            echo 2;
        }
        else
        {
            $this->db->trans_commit();
            echo 1;
        }
    }

// ------------------- Manage Subadmin ----------------------
    public function managesubadmin()
    {
        $data["managesubadmin"] = $this->AdminModel->GetAllsubadmin()->result();
        
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/subadmin',$data);
        $this->load->view('Admin/footer');
    }

    public function fetchsubadmin()
    {
        $subadmin_username = $_REQUEST["subadmin_username"];
        
        $data = $this->AdminModel->GetAllSubadmin(null, $subadmin_username)->row();
        if($data != null)
        {
            echo 1;
        }
        else
        {
            echo 2;
        }
    }

    public function subadminInsert()
    {
        $subadmin_id = $_REQUEST['subadmin_id'];
        $subadmin_name = $_REQUEST['subadmin_name'];
        $subadmin_mobile = $_REQUEST['subadmin_mobile'];
        $subadmin_address = $_REQUEST['subadmin_address'];
        $subadmin_email = $_REQUEST['subadmin_email'];
        $subadmin_username = $_REQUEST['subadmin_username'];
        $subadmin_password = $_REQUEST['subadmin_password'];

        $data = array( 'subadmin_name' => $subadmin_name, 
                       'subadmin_mobile' => $subadmin_mobile,
                       'subadmin_email' => $subadmin_email,
                       'subadmin_address' => $subadmin_address,
                       'subadmin_username' => $subadmin_username,
                       'subadmin_password' => $subadmin_password
                    );

        if($subadmin_id > 0)
        {        
            $res = $this->AdminModel->UpdateSubadmin($data,$subadmin_id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "Subadmin Updated Succesfully....";
                redirect(base_url("index.php/Admin/managesubadmin"));
            }   
            else
            {
                $_SESSION['ErrSucc'] = "Subadmin not able to update.....";
                redirect(base_url("index.php/Admin/managesubadmin"));
            } 
        }
        else
        {
            $res1 = $this->AdminModel->InsertSubadmin($data);
            if($res1 > 0)
            {
                $_SESSION['ErrSucc'] = "Subadmin Added Succesfully....";
                redirect(base_url("index.php/Admin/managesubadmin"));
            }   
            else
            {
                //echo 2;
                $_SESSION['ErrSucc'] = "Subadmin not able to add.....";
                redirect(base_url("index.php/Admin/managesubadmin"));
            } 
        }
    }

    public function EditSubadmin()
    {   
        $subadmin_id = '';
        $mobile = '';

        if(isset($_REQUEST['subadmin_id']))
        {
            $subadmin_id = $_REQUEST['subadmin_id'];
        }
        

        if($subadmin_id !='')
        {
            $res = $this->AdminModel->GetAllSubadmin($subadmin_id)->row();
            //print_r($res);die;
            if($res != null)
            {
                echo $res->subadmin_id.','.$res->subadmin_name.','.$res->subadmin_mobile.','.$res->subadmin_username.','.$res->subadmin_password.','.$res->subadmin_address.','.$res->subadmin_email;
            }
            else
            {
                echo '0';
            }
        }
        else
        {
            echo '0';
        }
    }

    public function DeleteSubadmin()
    {
        $subadmin_id = $_REQUEST['subadmin_id'];

        $res = $this-> AdminModel->DeleteSubadmin($subadmin_id);
        if($res>0)
        {
            $_SESSION['ErrSucc'] = "Subadmin Delete Succesfully....";
            echo 1;
        }
        else
        {
            $_SESSION['ErrSucc'] = "Subadmin Not Found....";
            echo 0;
        }
    }

// ------------------- Manage Purchase ----------------------
    public function managepurchase()
    {
        $data["managepurchase"] = $this->AdminModel->GetAllPurchase1()->result();

        //print_r($data["managesupplier"]);die;
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/listpurchase',$data);
        $this->load->view('Admin/footer');
    }
    
    public function getpurchase()
    {
        $purchase_id = $_REQUEST["purchase_id"];
        $data = $this->AdminModel->GetAllPurchase1($purchase_id)->row();
        
        echo $data->purchase_id."^".$data->supplier_name."^".$data->bill_no."^".$data->remain_amount;
    }

    public function SupplierPayment()
    {
        $remain_amount = $_REQUEST["remain_amount"];
        $pay_amount = $_REQUEST["pay_amount"];
        $purchase_id = $_REQUEST["purchase_id"];

        $total_remain = $remain_amount - $pay_amount;
        $data = array('remain_amount' => $total_remain,
                      'pay_amount' => $pay_amount
                     );

        $res1 = $this->AdminModel->UpdatePurchase($data,$purchase_id);
        if($res1 > 0)
        {
            $_SESSION['ErrSucc'] = "Purchase Update Succesfully....";
            //redirect(base_url("index.php/Admin/managepaymentterm"));
            echo 1;
        }   
        else
        {
            $_SESSION['ErrSucc'] = "Purchase not able to update.....";
            //redirect(base_url("index.php/Admin/managepaymentterm"));
            echo 2;
        } 
    }

    public function printpurchase($purchase_id = null,$shop_id = null)
    {
        $data["shop"] = $this->AdminModel->GetAllShop($shop_id)->row();

        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        if($purchase_id != null)
        {
            $data["purchase"] = $this->AdminModel->GetAllPurchase1($purchase_id)->row();
            $data["purchasedetail"] = $this->AdminModel->GetPurchaseDetail($purchase_id)->result();
            
            $this->load->view('Admin/printpurchase',$data);
        }
        else
        {
            redirect(base_url("index.php/Admin/managepurchase"));
        }
        $this->load->view('Admin/footer');
    }

    public function getpurchasedetail($purchase_id = null)
    {
        if($purchase_id =='' && $purchase_id == null)
        {
            redirect(base_url("index.php/Admin/managepurchase"));
        }
        else
        {
            $data["purchasedetail"] = $this->AdminModel->GetPurchaseDetail($purchase_id)->result();
            $this->load->view('Admin/header');
            $this->load->view('Admin/aside');
            $this->load->view('Admin/listpurchasedetail',$data);
            $this->load->view('Admin/footer');
        }
    }

    public function fetchsupplier()
    {
        $managesupplier = $this->AdminModel->GetAllSupplier()->result();
        foreach ($managesupplier as $supplier) 
        {
            echo $supplier->supplier_id."^".$supplier->supplier_name."~";
        }
    }

    
    
    public function transferphone(){


        $data["productdetail"] = $this->AdminModel->GetAllProduct1()->result();
        $data["manageshop"] = $this->AdminModel->GetAllShop()->result();
        $data["transferhone"] = $this->AdminModel->Gettransferphone()->result();
        

        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/transferphone',$data);
        $this->load->view('Admin/footer');
    }

    public function insertphone(){

        $data=$this->input->post();
        $this->load->model('AdminModel');
                   if( $this->AdminModel->transferphoneinsert($data)){
                    return redirect('Admin/transferphone');
                   }else{
                    $this->session->set_flashdata('feedback',"Failed to Transfer Phone , Please Try Again.");
                        $this->session->set_flashdata('feedback_class','alert-danger');                
                      }
                      
    }

    public function EditPhone($transfer_id)
    {
        $this->load->helper('form');

      

            $data["manageshop"] = $this->AdminModel->GetAllShop()->result();
            $data["manageproduct"] = $this->AdminModel->GetAllProduct2()->result();
            $data["transferphone"] = $this->AdminModel->Gettransferphone2($transfer_id)->result();

            
            $this->load->view('Admin/header');
            $this->load->view('Admin/aside');
            $this->load->view('Admin/Edittranferphone',$data,$transfer_id);
            $this->load->view('Admin/footer');
        

    }
 
    public function Updatephone($transfer_id)
    {
        $data = $this->input->post();
        $this->load->model('AdminModel');
        $this->AdminModel->update_phone($data,$transfer_id);
        redirect('Admin/transferphone');
    }

    public function addtranferphone(){

        $this->load->helper('form');


        $data["manageshop"] = $this->AdminModel->GetAllShop()->result();
        $data["manageproduct"] = $this->AdminModel->GetAllProduct2()->result();

        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');                                                                                                               
        $this->load->view('Admin/addtranferphone',$data);
        $this->load->view('Admin/footer');
    }
    public function addnewpurchase()
    {
        
        $data["managesupplier"] = $this->AdminModel->GetAllSupplier()->result();
        $data["manageshop"] = $this->AdminModel->GetAllShop()->result();
        $data["manageproduct"] = $this->AdminModel->GetAllProduct()->result();
        $data['AllCountry'] = $this->AdminModel->GetAllCountry()->result();

        $referanceNo = 0;
        $lastReferance = $this->AdminModel->lastPurchase()->row(); 
        
        if($lastReferance =='') 
        {
            $referanceNo = 1; 
        }
        else
        {
            $referanceNo = $lastReferance->referance_no+1;
        }

        //$invoiceString = date('Y|m')."|"."MS - ".$referanceNo;
        $data['ReferanceDetail'] = (object)array( 'ReferanceNo' => $referanceNo
                                                /*'InvoiceString' => $invoiceString*/);

        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/addnewpurchase',$data);
        $this->load->view('Admin/footer');
    }

    public function fetchsupplierdetail()
    {
        $supplier_id = $_REQUEST["supplier_id"];
        $data = $this->AdminModel->GetAllSupplier($supplier_id)->row();
        
        echo $data->supplier_id."^".$data->supplier_gstno."^".$data->supplier_address;
    }

    public function fetchvarient()
    {
        $product_id = $_REQUEST["pid"];
        $data = $this->AdminModel->GetVarient($product_id)->result();
        foreach ($data as $d) 
        {
            echo $d->product_detail_id."^".$d->varient_name."~";
        }
    }

    public function fetchotherdetail()
    {
        $product_detail_id = $_REQUEST["pid"];
        $data = $this->AdminModel->GetVarient1($product_detail_id)->row();
        //print_r($data);die;
        echo $data->product_detail_id."^".$data->barcode."^".$data->purchase_tax."^".$data->sale_tax."^".$data->purchase_price."^".$data->sale_price."^".$data->product_id."^".$data->category_digit."^".$data->tax_rate;
    }

    public function fetchotherdetail1()
    {
        $pid = "";
        if(isset($_REQUEST["pid"]))
        {
            $pid = $_REQUEST["pid"];
        }

        $serial_no[] = "";
        if(isset($_REQUEST["serial_no"]))
        {
            $serial_no = $_REQUEST["serial_no"];
        }
        $data = $this->AdminModel->GetAllProduct1($pid,$serial_no)->row();    

        $r_no = "";
        $serialno[] = $data->serial_no;
        $shop_id = $data->shop_id;
        $product_detail_id = $data->product_detail_id;

        $allsale = $this->AdminModel->GetAllSale()->result();  
        foreach ($allsale as $sale) 
        {
            $sale_ser_no[] = $sale->serial_no;
        }
        $r_no = $_REQUEST["serial_no"];
        /*if(isset($sale_ser_no))
        {
            $result = array_diff($serialno,$sale_ser_no);
            $r_no = implode(',',$result);
           // $lent = count($r_no); 
            //print_r($lent); exit;
          
        }
        else
        {
            $r_no = $data->serial_no;
        }*/
       // print_r($r_no); exit;

        $invoiceNo = 0;
        $lastInvoice = $this->AdminModel->lastInvoice($shop_id);

       // print_r($lastInvoice); exit;
        if($shop_id == 1)
        {
            if($lastInvoice == 0 || $lastInvoice == '') 
            {     $invoiceNo = "SA - 1";            }
            else
            {     $inc = $lastInvoice + 1;
                  $invoiceNo = "SA - ".$inc;        }
        }
        else if($shop_id == 2)
        {
            if($lastInvoice == 0 || $lastInvoice == '') 
            {     $invoiceNo = "SB - 1";            }
            else
            {     $inc = $lastInvoice + 1;
                  $invoiceNo = "SB - ".$inc;        }
        }
        else if($shop_id == 3)
        {
            if($lastInvoice == 0 || $lastInvoice == '') 
            {     $invoiceNo = "SC - 1";            }
            else
            {     $inc = $lastInvoice + 1;
                  $invoiceNo = "SC - ".$inc;        }
        }   
         else if($shop_id == 4)
        {
            if($lastInvoice == 0 || $lastInvoice == '') 
            {     $invoiceNo = "Sd - 1";            }
            else
            {     $inc = $lastInvoice + 1;
                  $invoiceNo = "Sd - ".$inc;        }
        }   
        else
        {
            $invoiceNo = "";
        }         

        $invoiceString = $invoiceNo;
        
        if($r_no != null && $r_no !='')
        {
            echo $data->product_detail_id."^".$data->sale_tax."^".$data->purchase_price."^".$data->sale_price."^".$data->product_id."^".$data->tax_rate."^".$r_no."^".$shop_id."^".$invoiceNo."^".$invoiceString."^".$data->product_name."^".$data->varient_name;
        }
        else
        {
            echo 0;
        }

    }

    public function purchaseInsert()
    {
        $Object = array();
        $Object = json_decode(file_get_contents('php://input'),true);

        foreach ($Object['result1'] as $obj1) 
        {
            $purchase_id = $obj1['purchase_id'];
            $supplier_id = $obj1['supplier_id'];
            $shop_id = $obj1['shop_id'];
            $bill = $obj1['bill_no'];
            $bill_date = $obj1['bill_date'];
            $referance_no = $obj1['referance_no'];
            $due_date = $obj1['due_date'];
            $sub_total = $obj1['sub_total'];
            $total_tax = $obj1['total_tax'];
            $round_off = $obj1['round_off'];
            $total_amt = $obj1['total_amt'];
        }
        
        $product_id = array();

        foreach ($Object['result2'] as $obj2) 
        {
            $product_id[] = $obj2['product_id'];
            $varientname[] = $obj2['varientname'];
            $serial_no[] = $obj2['serial_no'];
            $qty[] = $obj2['qty'];
            $org_pp[] = $obj2['org_pp'];
            $purchase_price[] = $obj2['purchase_price'];
            $sale_price[] = $obj2['sale_price'];
            $tax_id[] = $obj2['tax_id'];
            $tax_amt[] = $obj2['tax_amt'];
            $total[] = $obj2['total'];
        }

        $bill_no = str_replace(" ","",$bill);    

        $data = array( 'supplier_id' => $supplier_id,
                       'shop_id' => $shop_id,
                       'bill_no' => $bill_no,
                       'bill_date' => $bill_date,
                       'referance_no' => $referance_no,
                       'due_date' => $due_date,
                       'sub_total' => $sub_total,
                       'total_tax' => $total_tax,
                       'round_off' => $round_off,
                       'total_amt' => $total_amt,
                       'remain_amount'=> $total_amt );
        $purchaseDetail = array();

        if($purchase_id == 0)
        {
            //Transaction
            $this->db->trans_start(); 
            $res1 = $this->AdminModel->InsertPurchase($data);
            if($res1 > 0)
            {
                $res2 = $this->AdminModel->GetPurchaseId($bill_no)->row();
               
                if($res2 != null)
                {
                    $purchase_id = $res2->purchase_id;
                    
                    for($i = 0; $i < count($product_id); $i++)
                    {
                        $detail = array('product_id' => $product_id[$i],
                                        'product_detail_id' => $varientname[$i],
                                        //'actul_shop' => $actul_shop[$i],
                                        'serial_no' => $serial_no[$i],
                                        'qty' => $qty[$i],
                                        'stock' => $qty[$i],
                                        'org_pp' => $org_pp[$i],
                                        'purchase_price' => $purchase_price[$i],
                                        'sale_price' => $sale_price[$i],
                                        'tax_id' => $tax_id[$i],
                                        'total' => $total[$i],
                                        'tax_amt' => $tax_amt[$i],
                                        'purchase_id' => $purchase_id );
                        array_push($purchaseDetail, $detail); 
                    }
                    $res3 = $this->AdminModel->InsertPurchaseDetail($purchaseDetail);
                    if($res3 > 0)
                    {
                        $this->db->trans_complete();
                        $_SESSION['ErrSucc'] = "Purchase Created Successfully";
                     // redirect(base_url("index.php/Admin/listpurchase.php"));
                      //return redirect('Admin/dashboard');
                     return redirect('Admin/managepurchase');
                     
                    }  
                    else
                    {
                        $this->db->trans_complete();
                        $_SESSION['ErrSucc'] = "Problem Occured Purchase Detail Try Again";
                    } 

                    /*$stockData = "";
                    $str1 = "";

                    for($i = 0; $i < count($varientname); $i++)
                    {
                        $stockData = (object)array( 'product_detail_id' => $varientname[$i],
                                                    'serial_no' => $serial_no[$i],
                                                    'qty' => $qty[$i] );
                        $str1 = $this->AdminModel->CreditStock($stockData);
                    }
                    
                    if($str1 > 0)
                    {
                        $this->db->trans_complete();
                        $_SESSION['ErrSucc'] = "Stock Managed Successfully";
                    }  
                    else
                    {
                        $this->db->trans_complete();
                        $_SESSION['ErrSucc'] = "Problem Occured sale Detail Try Again";
                    }*/
                }
                else
                {
                    $this->db->trans_complete();
                    $_SESSION['ErrSucc'] = "Problem Occured Get purchase Id Try Again";
                }
            }   
            else
            {
                //echo 2;
                $_SESSION['ErrSucc'] = "Purchase Not able to add.....";
              //  redirect(base_url("index.php/Admin/managepurchase"));
            //  return redirect('Admin/managepurchase');
            
            } 

            if ($this->db->trans_status() == FALSE)
            {
                $this->db->trans_rollback();
                echo 2;
            }
            else
            {
                $this->db->trans_commit();
                echo 1;
            }            
        }
        else
        {
            //Transaction  
            $this->db->trans_start();

            $res = $this->AdminModel->UpdatePurchase($data,$purchase_id);
            if($res > 0)
            {
                $res2 = $this->AdminModel->DeletePurchaseDetail($purchase_id);
                if($res2 > 0)
                {
                    for($i = 0; $i < count($product_id); $i++)
                    {
                        $detail = array('product_id' => $product_id[$i],
                                        'product_detail_id' => $varientname[$i],                                        
                                       // 'actul_shop' => $actul_shop[$i],                                        
                                        'serial_no' => $serial_no[$i],
                                        'qty' => $qty[$i],
                                        'stock' => $qty[$i],
                                        'org_pp' => $org_pp[$i],
                                        'purchase_price' => $purchase_price[$i],
                                        'sale_price' => $sale_price[$i],
                                        'tax_id' => $tax_id[$i],
                                        //'tax_amt' => $tax_amt[$i],
                                        'total' => $total[$i],
                                        'purchase_id' => $purchase_id );

                        array_push($purchaseDetail, $detail);  
                    }

                    $res3 = $this->AdminModel->InsertPurchaseDetail($purchaseDetail);
                    if($res3 > 0)
                    {
                        $this->db->trans_complete();
                        $_SESSION['ErrSucc'] = "Purchase Detail Updated Successfully";
                        
                     return redirect('Admin/managepurchase');


                    }  
                    else{
                        $this->db->trans_complete();
                        $_SESSION['ErrSucc'] = "Problem Occured purchase Detail Not Update Try Again";
                    } 
                }
                else
                {
                    $this->db->trans_complete();
                    $_SESSION['ErrSucc'] = "Problem Occured Delete Old Purchase Detail Try Again";
                }
            }
            else
            {
                $this->db->trans_complete();
                $_SESSION['ErrSucc'] = "Problem Occured Update purchase Try Again";
            }

            if ($this->db->trans_status() == FALSE)
            {
                $this->db->trans_rollback();
                echo 4;
            }
            else
            {
                $this->db->trans_commit();
                echo 3;
            }
        }
    }

    public function EditPurchase()
    {
        $purchase_id = '';

        if(isset($_REQUEST['purchase_id']))
        {
            $purchase_id = $_REQUEST['purchase_id'];
        }        

        if($purchase_id !='')
        {
            $res = $this->AdminModel->GetAllPurchase($purchase_id)->row();
            
            if($res != null)
            {
                echo $res->purchase_id.','.$res->supplier_id.','.$res->shop_id.','.$res->shop_name.','.$res->bill_no.','.$res->referance_no.','.$res->bill_date.','.$res->due_date.','.$res->sub_total.','.$res->round_off.','.$res->total_amt;
            }
            else
            {
                echo '0';
            }
        }
        else
        {
            echo '0';
        }
    }

    public function DeletePurchase()
    {
        $purchase_id = $_REQUEST['purchase_id'];

        $this->db->trans_start();
        $str = $this->AdminModel->GetPurchaseDetail($purchase_id)->result();
        
        if($str > 0)
        {
            $product_detail_id = "";
            $serial_no = "";
            $qty = "";

            $query = "";
            foreach ($str as $s) 
            {
                $product_detail_id = $s->product_detail_id;
                $serial_no = $s->serial_no;
                $qty = $s->qty;
                $stockData = (object)array( 'product_detail_id' => $product_detail_id,
                                            'serial_no' => $serial_no,
                                            'qty' => $qty );   
                $query = $this->AdminModel->DebitStock($stockData);
            }

            if($query > 0)
            {
                $res = $this->AdminModel->DeletePurchaseDetail($purchase_id);
                if($res > 0)
                {
                    $res1 = $this->AdminModel->DeletePurchase($purchase_id);
                    if($res1)
                    {
                        $this->db->trans_complete();
                        $_SESSION['ErrSucc'] = "Purchase Delete Succesfully....";
                        //echo 1;
                    }
                    else
                    {   
                        $this->db->trans_complete();
                        $_SESSION['ErrSucc'] = "Purchase Not Found....";
                        //echo 0;
                    }
                }
                else
                {
                    $this->db->trans_complete();
                    $_SESSION['ErrSucc'] = "Purchase Detail Not Found....";
                    //echo 0;
                }
            }
            else
            {
                $this->db->trans_complete();
                $_SESSION['ErrSucc'] = "Qty Not Credit Found....";
            }
        }
        else
        {
            $this->db->trans_complete();
            $_SESSION['ErrSucc'] = "Sale Not Found....";
        }

        if ($this->db->trans_status() == FALSE)
        {
            $this->db->trans_rollback();
            echo 2;
        }
        else
        {
            $this->db->trans_commit();
            echo 1;
        }

        /*$res = $this->AdminModel->DeletePurchase($purchase_id);
        if($res > 0)
        {
            $_SESSION['ErrSucc'] = "Purchase Delete Succesfully....";
            echo 1;
        }
        else
        {
            $_SESSION['ErrSucc'] = "Purchase Not Found....";
            echo 0;
        }*/
    }

// ------------------- Manage Sale --------------------------
    public function managesale()
    {
        $emp_id = "";
        if(isset($_SESSION["employee_id"]))
        {
            $emp_id = $_SESSION["employee_id"];
        }

        $data["managesale"] = $this->AdminModel->GetAllSale(null,$emp_id)->result();
        $data["managesupplier"] = $this->AdminModel->GetAllSupplier()->result();
        //print_r($data["managesale"]);die;
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/listsale',$data);
        $this->load->view('Admin/footer');
    }

    public function fetchcustomerdetail()
    {
        $customer_id = $_REQUEST["customer_id"];
        $data = $this->AdminModel->GetAllCustomer($customer_id)->row();
        
        echo $data->customer_id."^".$data->customer_name."^".$data->customer_mobile."^".$data->customer_address;
    }

    public function fetchserialdetail()
    {
        $product_detail_id = $_REQUEST["pid"];
        $ser_no = $_REQUEST["serial_no"];
        
        $res = $this->AdminModel->GetPurchaseVarient($product_detail_id,$ser_no)->row();
        
        $serialno = "";
        $shop_id = "";
        $product_detail_id = "";
        if(isset($res))
        {
            $serialno = $res->serial_no;
            $shop_id = $res->shop_id;
            $product_detail_id = $res->product_detail_id;
        }

        $invoiceNo = 0;
        $lastInvoice = $this->AdminModel->lastInvoice($shop_id);
        
        if($shop_id == 1)
        {
            if($lastInvoice == 0 || $lastInvoice == '') 
            {     $invoiceNo = "S - 1";            }
            else
            {     $inc = $lastInvoice + 1;
                  $invoiceNo = "S - ".$inc;        }
        }
        else if($shop_id == 2)
        {
            if($lastInvoice == 0 || $lastInvoice == '') 
            {     $invoiceNo = "SM - 1";            }
            else
            {     $inc = $lastInvoice + 1;
                  $invoiceNo = "SM - ".$inc;        }
        }
        else if($shop_id == 3)
        {
            if($lastInvoice == 0 || $lastInvoice == '') 
            {     $invoiceNo = "SMM - 1";            }
            else
            {     $inc = $lastInvoice + 1;
                  $invoiceNo = "SMM - ".$inc;        }
        } 
        else if($shop_id == 4)
        {
            if($lastInvoice == 0 || $lastInvoice == '') 
            {     $invoiceNo = "SMMM - 1";            }
            else
            {     $inc = $lastInvoice + 1;
                  $invoiceNo = "SMMM - ".$inc;        }
        }   
        else
        {
            $invoiceNo = "";
        }         

        $invoiceString = date('Y|m')."|".$invoiceNo;

        echo $product_detail_id."^".$serialno."^".$shop_id."^".$invoiceNo."^".$invoiceString;
    }

    public function addnewsale()
    {
        $data["manageproduct"] = $this->AdminModel->GetAllProduct2()->result();

        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/addnewsale',$data);
        $this->load->view('Admin/footer');
    }

    /*public function fetchproduct()
    {
        $product_detail_id = $_REQUEST['pid'];
        $manageproduct = $this->AdminModel->GetAllProduct1($product_detail_id)->result();
        foreach ($manageproduct as $pd) 
        {
            echo $pd->serial_no."~";
        }
    }*/

    public function fetchproduct()
    {
        $product_detail_id = $_REQUEST['pid'];
        $res = $this->AdminModel->GetAllProduct3($product_detail_id)->row();
        $allsale = $this->AdminModel->GetAllSale()->result();

        $r_no = "";
        $s_no = explode(',',$res->serial_no);
        $ss_no = array();
        
        foreach ($s_no as  $value) 
        {
            $ss_no[]= $value;
        }

        foreach ($allsale as $sale) 
        {
            $sale_ser_no[] = $sale->serial_no;
        }
        //print_r($sale_ser_no); exit;

        if(isset($sale_ser_no))
        {
            $result = array_diff($ss_no, $sale_ser_no);
            $r_no = implode(',',$result);
        }
        else
        {
            $r_no = $res->serial_no;
        }

        echo $r_no;
    }

    //---------AUTO COMPLETE FUNCTION ----------
    public function autocomplete()
    {
        //get search term
        $searchTerm = $_GET['query'];
        $qry="SELECT * FROM `product_master` as `a` LEFT JOIN `product_detail_master` as `b` on (`b`.`product_id` = `a`.`product_id`) WHERE `product_name` LIKE '%".$searchTerm."%' OR `varient_name` LIKE '%".$searchTerm."%' OR `barcode` LIKE '%".$searchTerm."%' ORDER BY product_name ASC";
        $data = [];
        $data = $this->AdminModel->autocomplete($qry); 
        //return json data
        echo json_encode($data);
    }
    //---------AUTO COMPLETE FUNCTION ----------

    public function fetchcpaymentterm()
    {
        $managepaymentterm = $this->AdminModel->GetAllPaymentterm()->result();
        
        foreach ($managepaymentterm as $paymentterm) 
        {
            echo $paymentterm->payment_term_id."^".$paymentterm->payment_term_name."~";
        }
    }

    public function fetchcustomer()
    {
        $managecustomer = $this->AdminModel->GetAllCustomer()->result();
        
        foreach ($managecustomer as $customer) 
        {
            echo $customer->customer_id."^".$customer->customer_name."~";
        }
    }

    /*public function printallsale1()
    {
        $fromdate = $_REQUEST["sale_from_date"];
        $todate = $_REQUEST["sale_to_date"];

        $data["saleinvoice"] = $this->AdminModel->GetAllSale1(null,$fromdate,$todate)->result();
        //print_r($data["saleinvoice"]);die;
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/printsale1',$data);
        $this->load->view('Admin/footer');
    }

    public function printallsale()
    {
        $str = $this->AdminModel->GetAllSale()->result();

        $saleid = array();
        $shopid = array();
        foreach ($str as $s) 
        {
            $saleid = $s->sale_id;
            $shopid = $s->shop_id;
            $this->printsale($saleid,$shopid);
        }
    }*/

    public function printsale($sale_id = null,$shop_id = null)
    {
        $data["shop"] = $this->AdminModel->GetAllShop($shop_id)->row();
       // print_r($data);  exit;

        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        if($sale_id != null)
        {
            $data["sale"] = $this->AdminModel->GetAllSale($sale_id)->row();
                     
            $data["saledetail"] = $this->AdminModel->GetSaleDetail($sale_id)->result();
            
            $this->load->view('Admin/printsale',$data);
        }
        else
        {
            redirect(base_url("index.php/Admin/manageinvoice"));
        }
        $this->load->view('Admin/footer');
    }

    public function printsale1()
    {
        $shop_id = $_REQUEST["shopid"];
        $sale_id = $_REQUEST["saleid"];
        $data["shop"] = $this->AdminModel->GetAllShop($shop_id)->row();

        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        if($sale_id != null)
        {
            $data["sale"] = $this->AdminModel->GetAllSale($sale_id)->row();
            $data["saledetail"] = $this->AdminModel->GetSaleDetail($sale_id)->result();
            
            $this->load->view('Admin/printsale',$data);
        }
        else
        {
            redirect(base_url("index.php/Admin/manageinvoice"));
        }
        $this->load->view('Admin/footer');
    }

    public function saleInsert()
    {
        $user_id = 0;
        if(isset($_SESSION['employee_id']))
        {
            $user_id = $_SESSION['employee_id'];
        }
        else
        {
            $user_id = 0;
        }

        $Object = array();
        $Object = json_decode(file_get_contents('php://input'),true);

        foreach ($Object['result1'] as $obj1) 
        {
            $sale_id = $obj1['sale_id'];
            $customer_id = $obj1['customer_id'];
            $invoice_no = $obj1['invoice_no'];
            $invoice_string = $obj1['invoice_string'];
            $payment_term_id = $obj1['payment_term_id'];
            $invoice_date = $obj1['invoice_date'];
            $inv_subtotal = $obj1['inv_subtotal'];
            $inv_roundoff = $obj1['inv_roundoff'];
            $inv_totalamt = $obj1['inv_totalamt'];
        }
        
        $product_id = array();

        foreach ($Object['result2'] as $obj2) 
        {
            $product_id[] = $obj2['product_id'];
            $product_detail_id[] = $obj2['product_detail_id'];
            $serial_no[] = $obj2['serial_no'];
            $shop_id[] = $obj2['shop_id'];
            $qty[] = $obj2['qty'];
            $price[] = $obj2['price'];
            $discount[] = $obj2['discount'];
            $tax_id[] = $obj2['tax_id'];
            $tax_amt[] = $obj2['tax_amt'];
            $total[] = $obj2['total'];
        }

        //print_r($varient_name);die;

        $data = array( 'customer_id' => $customer_id,
                       'invoice_no' => $invoice_no,
                       'invoice_string' => $invoice_string,
                       'payment_term_id' => $payment_term_id,
                       'invoice_date' => $invoice_date,
                       'inv_subtotal' => $inv_subtotal,
                       'inv_roundoff' => $inv_roundoff,
                       'inv_totalamt' => $inv_totalamt,
                       'user_status' => $user_id );

        $saleDetail = array();

        if($sale_id == 0)
        {       
            //Transaction
            $saleid="";
            $sale="";
            $this->db->trans_start(); 
            $res1 = $this->AdminModel->InsertSale($data);
            if($res1 > 0)
            {
                $res2 = $this->AdminModel->GetSaleId($invoice_no)->row();
                $sale_id = $res2->sale_id;
                if($res2 != null)
                {
                    for($i = 0; $i < count($product_id); $i++)
                    {
                        $detail = array('product_id' => $product_id[$i],
                                        'product_detail_id' => $product_detail_id[$i],
                                        'serial_no' => $serial_no[$i],
                                        'shop_id' => $shop_id[$i],
                                        'qty' => $qty[$i],
                                        'price' => $price[$i],
                                        'discount' => $discount[$i],
                                        'tax_id' => $tax_id[$i],
                                        'tax_amt' => $tax_amt[$i],
                                        'total' => $total[$i],
                                        'sale_id' => $sale_id );

                        array_push($saleDetail, $detail); 

                    }

                    $res3 = $this->AdminModel->InsertSaleDetail($saleDetail);
                    if($res3 > 0)
                    {
                        $this->db->trans_complete();
                        $_SESSION['ErrSucc'] = "Sale Created Successfully";
                redirect(base_url("index.php/Admin/printsale/".$sale_id."/".$shop_id[0]));


                    }  
                    else
                    {
                        $this->db->trans_complete();
                        $_SESSION['ErrSucc'] = "Problem Occured sale Detail Try Again";
                    } 

                    $stockData = "";
                    $str1 = "";
                    for($i = 0; $i < count($product_id); $i++)
                    {
                        $stockData = (object)array( 'product_detail_id' => $product_detail_id[$i],
                                                    'serial_no' => $serial_no[$i],
                                                    'qty' => $qty[$i] );
                        $str1 = $this->AdminModel->DebitStock($stockData);
                    }

                    if($str1 > 0)
                    {
                        $this->db->trans_complete();
                        $_SESSION['ErrSucc'] = "Stock Managed Successfully";
                    }  
                    else
                    {
                        $this->db->trans_complete();
                        $_SESSION['ErrSucc'] = "Problem Occured sale Detail Try Again";
                    } 
                }
                else
                {
                    $this->db->trans_complete();
                    $_SESSION['ErrSucc'] = "Problem Occured Get sale Id Try Again";
                }
            }   
            else
            {
                //echo 2;
                $_SESSION['ErrSucc'] = "Sale Not able to add.....";
                redirect(base_url("index.php/Admin/managesale"));
            } 

            if ($this->db->trans_status() == FALSE)
            {
                $this->db->trans_rollback();
                echo 2;
            }
            else
            {
                $this->db->trans_commit();
                $sale = $saleid;
                $shop = implode("",$shop_id);
                echo $shop.','.$sale.','.'1';
            }            
        }
        else
        {
            //Transaction  
            $this->db->trans_start();

            $res = $this->AdminModel->UpdateSale($data,$sale_id);
            if($res > 0)
            {
                $res2 = $this->AdminModel->DeleteSaleDetail($sale_id);
                if($res2 > 0)
                {
                    for($i = 0; $i < count($product_id); $i++)
                    {
                        $detail = array('product_id' => $product_id[$i],
                                        'product_detail_id' => $product_detail_id[$i],
                                        'serial_no' => $serial_no[$i],
                                        'shop_id' => $shop_id[$i],
                                        'qty' => $qty[$i],
                                        'price' => $price[$i],
                                        'discount' => $discount[$i],
                                        'tax_id' => $tax_id[$i],
                                        'tax_amt' => $tax_amt[$i],
                                        'total' => $total[$i],
                                        'sale_id' => $sale_id );

                        array_push($saleDetail, $detail);  
                    }

                    $res3 = $this->AdminModel->InsertSaleDetail($saleDetail);
                    if($res3 > 0)
                    {
                        $this->db->trans_complete();
                        $_SESSION['ErrSucc'] = "Sale Detail Updated Successfully";
                    }  
                    else{
                        $this->db->trans_complete();
                        $_SESSION['ErrSucc'] = "Problem Occured Sale Detail Not Update Try Again";
                    } 
                }
                else
                {
                    $this->db->trans_complete();
                    $_SESSION['ErrSucc'] = "Problem Occured Delete Old Sale Detail Try Again";
                }
            }
            else
            {
                $this->db->trans_complete();
                $_SESSION['ErrSucc'] = "Problem Occured Update Sale Try Again";
            }

            if ($this->db->trans_status() == FALSE)
            {
                $this->db->trans_rollback();
                echo 4;
            }
            else
            {
                $this->db->trans_commit();
                echo 3;
            }
        }
    }



    

    public function EditSale($sale_id = null)
    {
        /*if($sale_id != null)
        {
            $data["sale"] = $this->AdminModel->GetAllSale($sale_id)->row();
            $data["saledetail"] = $this->AdminModel->GetSaleDetail($sale_id)->result();   
            //print_r($data["saledetail"]);die;
            //$data['allcustomer'] = $this->AdminModel->GetAllCustomer()->result();

            $this->load->view('Admin/header');
            $this->load->view('Admin/aside');
            $this->load->view('Admin/addnewsale',$data);
            $this->load->view('Admin/footer');
        }
        else
        {
            redirect(base_url("index.php/Admin/managesale"));
        }*/
        $sale_id = '';

        if(isset($_REQUEST['sale_id']))
        {
            $sale_id = $_REQUEST['sale_id'];
        }        

        if($sale_id !='')
        {
            $res = $this->AdminModel->GetAllSale($sale_id)->row();
            
            if($res != null)
            {
                echo $res->sale_id.','.$res->supplier_id.','.$res->bill_no.','.$res->bill_date.','.$res->sub_total.','.$res->round_off.','.$res->total_amt;
            }
            else
            {
                echo '0';
            }
        }
        else
        {
            echo '0';
        }
    }

    public function DeleteSale()
    {
        $sale_id = $_REQUEST['sale_id'];

        //Transaction
        $this->db->trans_start();
        $str = $this->AdminModel->GetSaleDetail($sale_id)->result();
        
        if($str > 0)
        {
            $product_detail_id = "";
            $serial_no = "";
            $qty = "";

            $query = "";
            foreach ($str as $s) 
            {
                $product_detail_id = $s->product_detail_id;
                $serial_no = $s->serial_no;
                $qty = $s->qty;
                $stockData = (object)array( 'product_detail_id' => $product_detail_id,
                                            'serial_no' => $serial_no,
                                            'qty' => $qty );   
                $query = $this->AdminModel->CreditStock($stockData);
            }

            if($query > 0)
            {
                $res = $this->AdminModel->DeleteSaleDetail($sale_id);
                if($res > 0)
                {
                    $res1 = $this->AdminModel->DeleteSale($sale_id);
                    if($res1)
                    {
                        $this->db->trans_complete();
                        $_SESSION['ErrSucc'] = "Sale Delete Succesfully....";
                        //echo 1;
                    }
                    else
                    {   
                        $this->db->trans_complete();
                        $_SESSION['ErrSucc'] = "Sale Not Found....";
                        //echo 0;
                    }
                }
                else
                {
                    $this->db->trans_complete();
                    $_SESSION['ErrSucc'] = "Sale Detail Not Found....";
                    //echo 0;
                }
            }
            else
            {
                $this->db->trans_complete();
                $_SESSION['ErrSucc'] = "Qty Not Credit Found....";
            }
        }
        else
        {
            $this->db->trans_complete();
            $_SESSION['ErrSucc'] = "Sale Not Found....";
        }

        if ($this->db->trans_status() == FALSE)
        {
            $this->db->trans_rollback();
            echo 2;
        }
        else
        {
            $this->db->trans_commit();
            echo 1;
        }        
    }

// ------------------- Manage Shop --------------------------
    public function manageshop()
    {
        $data["manageshop"] = $this->AdminModel->GetAllShop()->result();

        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/shop',$data);
        $this->load->view('Admin/footer');
    }

    public function shopInsert()
    {
        $shop_id = $_REQUEST['shop_id'];
        $shop_name = $_REQUEST['shop_name'];
        $shop_address = $_REQUEST['shop_address'];
        $shop_phone = $_REQUEST['shop_phone'];
        $shop_gst = $_REQUEST['shop_gst'];

        $images = $_FILES['uploadimages']['name']; 
        $images_tmp = $_FILES['uploadimages']['tmp_name']; 
        $url="assetsadmin/images/shop/".$images;
        move_uploaded_file($images_tmp,$url);


        $data = array( 'shop_name' => $shop_name,
                       'shop_address' => $shop_address,
                       'shop_phone' => $shop_phone,
                       'shop_gst' => $shop_gst,
                       'shop_logo' => $images );
        $data1 = "";

        if($shop_id > 0)
        {        
            if($images == "" )
            {
                $data1 = array('shop_name' => $shop_name,
                              'shop_address' => $shop_address,
                              'shop_phone' => $shop_phone,
                              'shop_gst' => $shop_gst );
            }
            else
            {
                $data1 = $data;
            }

            $res = $this->AdminModel->UpdateShop($data1,$shop_id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "Shop Updated Succesfully....";
                redirect(base_url("index.php/Admin/manageshop"));
                //echo 3;
            }   
            else
            {
                $_SESSION['ErrSucc'] = "Shop Not able to update.....";
                //echo 4;
                redirect(base_url("index.php/Admin/manageshop"));
            } 
        }
        else
        {
            $res1 = $this->AdminModel->InsertShop($data);
            if($res1 > 0)
            {
                $_SESSION['ErrSucc'] = "Shop Added Succesfully....";
                //echo 1;
                redirect(base_url("index.php/Admin/manageshop"));
            }   
            else
            {
                //echo 2;
                $_SESSION['ErrSucc'] = "Shop Not able to add.....";
                redirect(base_url("index.php/Admin/manageshop"));
            } 
        }
    }

    public function EditShop()
    {
        $shop_id = '';

        if(isset($_REQUEST['shop_id']))
        {
            $shop_id = $_REQUEST['shop_id'];
        }        

        if($shop_id !='')
        {
            $res = $this->AdminModel->GetAllShop($shop_id)->row();
            
            if($res != null)
            {
                echo $res->shop_id.'^'.$res->shop_name.'^'.$res->shop_address.'^'.$res->shop_phone.'^'.$res->shop_gst.'^'.$res->shop_logo;
            }
            else
            {
                echo '0';
            }
        }
        else
        {
            echo '0';
        }
    }

    public function DeleteShop()
    {
        $shop_id = $_REQUEST['shop_id'];

        $res = $this->AdminModel->DeleteShop($shop_id);
        if($res > 0)
        {
            $_SESSION['ErrSucc'] = "Shop Delete Succesfully....";
            echo 1;
        }
        else
        {
            $_SESSION['ErrSucc'] = "Shop Not Found....";
            echo 0;
        }
    }

//-------------------  Purchase Report ----------------------
    public function purchasereport()
    {
        $data["manageproduct"] = $this->AdminModel->GetAllProduct()->result();
        $data["managebrand"] = $this->AdminModel->GetAllBrand()->result();
        $data["managecategory"] = $this->AdminModel->GetAllCategory()->result();
        //$data["Allemireport"] = $this->AdminModel->GetAllEmiReport()->result();
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/purchasereport',$data); 
        $this->load->view('Admin/footer');
    }

    public function fetchpurchasedata()
    {
        $fromdate = $_REQUEST['fromdate'];
        $todate = $_REQUEST['todate'];
        $product_id = $_REQUEST['product_id'];
        $category_id = $_REQUEST['category_id'];
        $brand_id = $_REQUEST['brand_id'];
        $str = $this->AdminModel->GetAllPurchase(null,$fromdate,$todate,$product_id,$category_id,$brand_id)->result();
        
        $data = array();

        $str1 = "";
        $str2 = "";
        if(isset($str))
        {   
            $cnt = 1;
            foreach ($str as $purchase) 
            {   
                $bill_dt = date("d-m-Y",strtotime($purchase->bill_date));
                
                $sub_array = array();  

                $sub_array[] = $cnt++;
                $sub_array[] = $purchase->supplier_name;
                $sub_array[] = $purchase->bill_no;
                $sub_array[] = $bill_dt;
                $sub_array[] = $purchase->category_name;
                $sub_array[] = $purchase->brand_name;
                $sub_array[] = $purchase->product_name;
                $sub_array[] = $purchase->varient_name;
                $sub_array[] = $purchase->qty;
                $sub_array[] = $purchase->purchase_price;
                $sub_array[] = $purchase->tax_id;
                $sub_array[] = $purchase->total;
                
                $data[] = $sub_array; 
            }
            $output = array( 
                             "data" => $data,
                            );  
            echo json_encode($output);  
        }
    }

//-------------------  Sale Report --------------------------
    public function salereport()
    {
        $data["manageproduct"] = $this->AdminModel->GetAllProduct()->result();
        $data["managebrand"] = $this->AdminModel->GetAllBrand()->result();
        $data["managecategory"] = $this->AdminModel->GetAllCategory()->result();
        //$data["Allemireport"] = $this->AdminModel->GetAllEmiReport()->result();
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/salereport',$data); 
        $this->load->view('Admin/footer');
    }

    public function fetchsaledata()
    {
        $fromdate = $_REQUEST['fromdate'];
        $todate = $_REQUEST['todate'];
        $product_id = $_REQUEST['product_id'];
        $category_id = $_REQUEST['category_id'];
        $brand_id = $_REQUEST['brand_id'];
        
        $str = $this->AdminModel->GetAllSale(null,null,$fromdate,$todate,$product_id,$category_id,$brand_id)->result();
        
        $data = array();

        $str1 = "";
        $str2 = "";
        if(isset($str))
        {   
            $cnt = 1;
            foreach ($str as $sale) 
            {   
                $invoice_dt = date("d-m-Y",strtotime($sale->invoice_date));
                
                $sub_array = array();  

                $sub_array[] = $cnt++;
                $sub_array[] = $sale->customer_name;
                $sub_array[] = $sale->invoice_string;
                $sub_array[] = $invoice_dt;
                $sub_array[] = $sale->category_name;
                $sub_array[] = $sale->brand_name;
                $sub_array[] = $sale->product_name;
                $sub_array[] = $sale->price;
                $sub_array[] = $sale->tax_id;
                /*$sub_array[] = $sale->tax_amt;*/
                $sub_array[] = $sale->total;

                $data[] = $sub_array; 
            }
            $output = array( 
                             "data" => $data,
                            );  
            echo json_encode($output);  
        }
    }

//// ------------------------------------------------------------ Gym Management --------------------------------------------------------------------//

    public function award()
    {
        $data["managemember"] = $this->AdminModel->GetAllEmployee()->result();
       // $data["manageplan"] = $this->AdminModel->GetAllPlan()->result();
        
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/addaward',$data); 
        $this->load->view('Admin/footer');
    }
    public function listaward(){
        $data["allaward"] = $this->AdminModel->GetAllaward()->result();
      //  $data["manageplan"] = $this->AdminModel->GetAllPlan()->result();
        
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/listaward',$data); 
        $this->load->view('Admin/footer');

    }
    public function awardInsert()
    {
        $id = $_REQUEST['id'];
        $a_name = $_REQUEST['a_name'];
        $Description = $_REQUEST['Description'];
        $gift = $_REQUEST['gift'];
        $employee_id = $_REQUEST['employee_id'];
        $Award_by = $_REQUEST['Award_by'];
        $given_date = $_REQUEST['given_date'];
       

            $data = array( 'a_name' => $a_name,
                           'Description' => $Description,
                           'gift' => $gift,
                           'employee_id' => $employee_id,
                            'Award_by' =>$Award_by,
                            'given_date' =>$given_date,
                           
                         );
            if($id > 0)
            {        
                $res = $this->AdminModel->Updateaward($data,$id);
                if($res > 0)
                {
                    $_SESSION['ErrSucc'] = "Award Updated Succesfully....";
                    redirect(base_url("index.php/Admin/listaward"));
                    //echo 3;
                }   
                else
                {
                    $_SESSION['ErrSucc'] = "Award Not able to update.....";
                    //echo 4;
                    redirect(base_url("index.php/Admin/listaward"));
                } 
            }
            else
            {
                $res1 = $this->AdminModel->Insertaward($data);
                if($res1 > 0)
                {
                    $_SESSION['ErrSucc'] = "Award Added Succesfully....";
                    //echo 1;
                    redirect(base_url("index.php/Admin/listaward"));
                }   
                else
                {
                    //echo 2;
                    $_SESSION['ErrSucc'] = "Award Not able to add.....";
                    redirect(base_url("index.php/Admin/Member"));
                } 
            }
        }
        public function Editmember()
        {   
            $member_id = '';
    
            if(isset($_REQUEST['member_id']))
            {
                $member_id = $_REQUEST['member_id'];
            }        
    
            if($member_id !='')
            {
                $res = $this->AdminModel->GetAllMember($member_id)->row();
                
                if($res != null)
                {
                    echo $res->member_id.','.$res->m_name.','.$res->due_rate.','.$res->pay_rate;
                }
                else
                {
                    echo '0';
                }
            }
            else
            {
                echo '0';
            }
        }

        public function memberPayment()
        {
            $member_id = $_REQUEST["member_id"];
            $m_name = $_REQUEST["m_name"];
            $due_rate = $_REQUEST["due_rate"];
            $pay_rate = $_REQUEST["pay_rate"];
    
            $data = array('m_name' => $m_name,
                          'due_rate' => $due_rate,
                          'pay_rate' => $pay_rate
                         );
    
            $res1 = $this->AdminModel->UpdateMember($data,$member_id);
            if($res1 > 0)
            {
                $_SESSION['ErrSucc'] = "Member Update Succesfully....";
                //redirect(base_url("index.php/Admin/managepaymentterm"));
                echo 1;
            }   
            else
            {
                $_SESSION['ErrSucc'] = "Purchase not able to update.....";
                //redirect(base_url("index.php/Admin/managepaymentterm"));
                echo 2;
            } 
        }
        public function Deleteaward()
        {
            $id = $_REQUEST['id'];
    
            $res = $this->AdminModel->Deleteaward($id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "Award Delete Succesfully....";
                echo 1;
            }
            else
            {
                $_SESSION['ErrSucc'] = "Award Not Found....";
                echo 0;
            }
        }

    public function department()
    {        
        $data["manageplan"] = $this->AdminModel->GetAlldepartment()->result();
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/adddepartment',$data); 
        $this->load->view('Admin/footer');
    }
    public function Listdepartment()
    {        
        $data["Department"] = $this->AdminModel->GetAlldepartment()->result();
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/Listdepartment',$data); 
        $this->load->view('Admin/footer');
    }
    public function departmentInsert()
    {
        $Department_id = $_REQUEST['Department_id'];
        $Department_name = $_REQUEST['Department_name'];
       
            $data = array( 'Department_name' => $Department_name,
                          
                         );
   // print_r($data);
            if($Department_id > 0)
            {        
                $res = $this->AdminModel->Updatedepartment($data,$Department_id);
                if($res > 0)
                {
                    $_SESSION['ErrSucc'] = "Department Updated Succesfully....";
                    redirect(base_url("index.php/Admin/Listdepartment"));
                    //echo 3;
                }   
                else
                {
                    $_SESSION['ErrSucc'] = "Department Not able to update.....";
                    //echo 4;
                    redirect(base_url("index.php/Admin/Listdepartment"));
                } 
            }
            else
            {
                $res1 = $this->AdminModel->Insertdepartment($data);
                if($res1 > 0)
                {
                    $_SESSION['ErrSucc'] = "Department Added Succesfully....";
                    //echo 1;
                    redirect(base_url("index.php/Admin/Listdepartment"));
                }   
                else
                {
                    //echo 2;
                    $_SESSION['ErrSucc'] = "Department Not able to add.....";
                    redirect(base_url("index.php/Admin/Listdepartment"));
                } 
            }
        }
    
       
    
        public function Deletedepartment()
        {
            $Department_id = $_REQUEST['Department_id'];
    
            $res = $this->AdminModel->Deletedepartment($Department_id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "Department Delete Succesfully....";
                echo 1;
            }
            else
            {
                $_SESSION['ErrSucc'] = "Department Not Found....";
                echo 0;
            }
        }

        public function payment(){
          $data["managemember"] = $this->AdminModel->GetAllMember()->result();
      //  $data["manageplan"] = $this->AdminModel->GetAllPlan()->result();
        
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/payment',$data); 
        $this->load->view('Admin/footer');
        }
        public function printmember($member_id = null)
        {
            $data["member"] = $this->AdminModel->GetAllMember($member_id)->row();
    
            $this->load->view('Admin/header');
            $this->load->view('Admin/aside');
            $this->load->view('Admin/printmember',$data); 
            $this->load->view('Admin/footer');
        }
        public function attendance(){
            $data["managemember"] = $this->AdminModel->GetAllMember()->result();
            $data["attendance"] = $this->AdminModel->GetAllattendance()->result();
            
            $this->load->view('Admin/header');
            $this->load->view('Admin/aside');
            $this->load->view('Admin/attendance',$data); 
            $this->load->view('Admin/footer');
        }

        public function attendanceInsert(){

            $attendance_id = $_REQUEST['attendance_id'];
            $name = $_REQUEST['name'];
            $in_date = $_REQUEST['in_date'];
           
                $data = array( 'name' => $name,
                               'in_date' => $in_date
                               
                             );
       // print_r($data);
                if($attendance_id > 0)
                {        
                    $res = $this->AdminModel->Updateattendance($data,$attendance_id);
                    if($res > 0)
                    {
                        $_SESSION['ErrSucc'] = "attendance Updated Succesfully....";
                        redirect(base_url("index.php/Admin/attendance"));
                        //echo 3;
                    }   
                    else
                    {
                        $_SESSION['ErrSucc'] = "attendance Not able to update.....";
                        //echo 4;
                        redirect(base_url("index.php/Admin/attendance"));
                    } 
                }
                else
                {
                    $res1 = $this->AdminModel->Insertattendance($data);
                    if($res1 > 0)
                    {
                        $_SESSION['ErrSucc'] = "attendance Added Succesfully....";
                        //echo 1;
                        redirect(base_url("index.php/Admin/attendance"));
                    }   
                    else
                    {
                        //echo 2;
                        $_SESSION['ErrSucc'] = "attendance Not able to add.....";
                        redirect(base_url("index.php/Admin/attendance"));
                    } 
                }
        
            }
            public function Deleteattendance() {
            $attendance_id = $_REQUEST['attendance_id'];
    
            $res = $this->AdminModel->Deleteattendance($attendance_id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "attendance Delete Succesfully....";
                echo 1;
            }
            else
            {
                $_SESSION['ErrSucc'] = "attendance Not Found....";
                echo 0;
            }

        } 
        public function memberreport()
        {
            $data["managemember"] = $this->AdminModel->GetAllMember()->result();
            $data["attendance"] = $this->AdminModel->GetAllattendance()->result();
            //$data["Allemireport"] = $this->AdminModel->GetAllEmiReport()->result();
            $this->load->view('Admin/header');
            $this->load->view('Admin/aside');
            $this->load->view('Admin/memberreport',$data); 
            $this->load->view('Admin/footer');
        }
    
        public function fetchAttendancedata()
        {
            $fromdate = $_REQUEST['fromdate'];
            $todate = $_REQUEST['todate'];
            $member_id = $_REQUEST['member_id'];
           
            print_r($member_id);
            $str = $this->AdminModel->GetAllmemberreport($fromdate,$todate,$member_id)->result();
            
            $data = array();
    
            if(isset($str))
            {   
                $cnt = 1;
                foreach ($str as $purchase) 
                {   
                    
                    $sub_array = array();  
    
                    $sub_array[] = $cnt++;
                    $sub_array[] = $purchase->m_name;
                    $sub_array[] = $purchase->email;
                    $sub_array[] = $purchase->number;
                    $sub_array[] = $purchase->name;
                    $sub_array[] = $purchase->rate;
                    $sub_array[] = $purchase->due_rate;
                    $data[] = $sub_array; 
                }
                $output = array( 
                                 "data" => $data,
                                );  
                   //print_r($data);

                echo json_encode($output);  
            }
        }
    
        // ------------------- Manage Employee ----------------------
        public function attendancetrainer(){
           $data["managemember"] = $this->AdminModel->GetAllEmployee()->result();
            $data["attendance"] = $this->AdminModel->GetAllattendancetrainer()->result();
            
            $this->load->view('Admin/header');
            $this->load->view('Admin/aside');
            $this->load->view('Admin/attendancetrainer',$data); 
            $this->load->view('Admin/footer');
        }

        public function TrainerattendanceInsert(){

            $trainerattendance_id = $_REQUEST['trainerattendance_id'];
            $name = $_REQUEST['name'];
            $in_date = $_REQUEST['in_date'];
            $out_date = $_REQUEST['out_date'];
           
                $data = array( 'name' => $name,
                               'in_date' => $in_date,
                               'out_date' => $out_date
                               
                             );
       // print_r($data);
                if($trainerattendance_id > 0)
                {        
                    $res = $this->AdminModel->UpdateattendanceTrainer($data,$trainerattendance_id);
                    if($res > 0)
                    {
                        $_SESSION['ErrSucc'] = "attendance Updated Succesfully....";
                        redirect(base_url("index.php/Admin/attendancetrainer"));
                        //echo 3;
                    }   
                    else
                    {
                        $_SESSION['ErrSucc'] = "attendance Not able to update.....";
                        //echo 4;
                        redirect(base_url("index.php/Admin/attendancetrainer"));
                    } 
                }
                else
                {
                    $res1 = $this->AdminModel->InsertattendanceTrainer($data);
                    if($res1 > 0)
                    {
                        $_SESSION['ErrSucc'] = "attendance Added Succesfully....";
                        //echo 1;
                        redirect(base_url("index.php/Admin/attendancetrainer"));
                    }   
                    else
                    {
                        //echo 2;
                        $_SESSION['ErrSucc'] = "attendance Not able to add.....";
                        redirect(base_url("index.php/Admin/attendancetrainer"));
                    } 
                }
        
            }
            public function DeleteattendanceTrainer()
           {
            $trainerattendance_id = $_REQUEST['trainerattendance_id'];
            
    
            $res = $this->AdminModel->Deleteattendance($trainerattendance_id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "plan Delete Succesfully....";
                echo 1;
            }
            else
            {
                $_SESSION['ErrSucc'] = "plan Not Found....";
                echo 0;
            }

        } 
        public function manageemployee()
    {
      //  $data["manageshop"] = $this->AdminModel->GetAllMember()->result();
        $data["manageemployee"] = $this->AdminModel->GetAllEmployee()->result();
        
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/employee',$data);
        $this->load->view('Admin/footer');
    }

    public function fetchemployee()
    {
        $employee_username = $_REQUEST["employee_username"];
        //print_r($employee_username);die;
        $data = $this->AdminModel->GetAllEmployee(null, $employee_username)->row();
        if($data != null)
        {
            echo 1;
        }
        else
        {
            echo 2;
        }
    }

    public function employeeInsert()
    {
        $employee_id = $_REQUEST['employee_id'];
        $employee_name = $_REQUEST['employee_name'];
        $employee_mobile = $_REQUEST['employee_mobile'];
        $employee_address = $_REQUEST['employee_address'];
        $employee_email = $_REQUEST['employee_email'];
        $employee_username = $_REQUEST['employee_username'];
        $employee_password = $_REQUEST['employee_password'];

        $data = array( 'employee_name' => $employee_name, 
                       'employee_mobile' => $employee_mobile,
                       'employee_email' => $employee_email,
                       'employee_address' => $employee_address,
                       'employee_username' => $employee_username,
                       'employee_password' => $employee_password
                    );

        if($employee_id > 0)
        {        
            $res = $this->AdminModel->UpdateEmployee($data,$employee_id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "Employee Updated Succesfully....";
                redirect(base_url("index.php/Admin/manageemployee"));
            }   
            else
            {
                $_SESSION['ErrSucc'] = "Employee not able to update.....";
                redirect(base_url("index.php/Admin/manageemployee"));
            } 
        }
        else
        {
            $res1 = $this->AdminModel->InsertEmployee($data);
            if($res1 > 0)
            {
                $_SESSION['ErrSucc'] = "Employee Added Succesfully....";
                redirect(base_url("index.php/Admin/manageemployee"));
            }   
            else
            {
                //echo 2;
                $_SESSION['ErrSucc'] = "Employee not able to add.....";
                redirect(base_url("index.php/Admin/manageemployee"));
            } 
        }
    }

    public function EditEmployee()
    {   
        $employee_id = '';
        $mobile = '';

        if(isset($_REQUEST['employee_id']))
        {
            $employee_id = $_REQUEST['employee_id'];
        }
        

        if($employee_id !='')
        {
            $res = $this->AdminModel->GetAllEmployee($employee_id)->row();
            //print_r($res);die;
            if($res != null)
            {
                echo $res->employee_id.', '.$res->shop_id.', '.$res->employee_name.', '.$res->employee_username.', '.$res->employee_password.','.$res->employee_mobile.','.$res->employee_address.','.$res->employee_email;
            }
            else
            {
                echo '0';
            }
        }
        else
        {
            echo '0';
        }
    }

   

    public function DeleteEmployee()
    {
        $employee_id = $_REQUEST['employee_id'];

        $res = $this-> AdminModel->Deleteemployee($employee_id);
        if($res>0)
        {
            $_SESSION['ErrSucc'] = "Employee Delete Succesfully....";
            echo 1;
        }
        else
        {
            $_SESSION['ErrSucc'] = "Employee Not Found....";
            echo 0;
        }
    }

    public function inquiry()
    {
        $data["manageemployee"] = $this->AdminModel->GetAllattinquiry()->result();
        
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/inquiry',$data);
        $this->load->view('Admin/footer');
    }

   
    public function inquiryInsert()
    {
        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $mobile = $_REQUEST['mobile'];
        $address = $_REQUEST['address'];
        
        $data = array( 'name' => $name, 
                      'email' => $email,
                       'mobile' => $mobile,
                       'address' => $address,
                      
                    );

        if($id > 0)
        {        
            $res = $this->AdminModel->Updateinquiry($data,$id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "inquiry Updated Succesfully....";
                redirect(base_url("index.php/Admin/inquiry"));
            }   
            else
            {
                $_SESSION['ErrSucc'] = "inquiry not able to update.....";
                redirect(base_url("index.php/Admin/inquiry"));
            } 
        }
        else
        {
            $res1 = $this->AdminModel->Insertinquiry($data);
            if($res1 > 0)
            {
                $_SESSION['ErrSucc'] = "inquiry Added Succesfully....";
                redirect(base_url("index.php/Admin/inquiry"));
            }   
            else
            {
                //echo 2;
                $_SESSION['ErrSucc'] = "inquiry not able to add.....";
                redirect(base_url("index.php/Admin/inquiry"));
            } 
        }
    }


   
    public function Deleteinquiry()
    {
        $id = $_REQUEST['id'];

        $res = $this-> AdminModel->Deleteinquiry($id);
        if($res>0)
        {
            $_SESSION['ErrSucc'] = "inquiry Delete Succesfully....";
            echo 1;
        }
        else
        {
            $_SESSION['ErrSucc'] = "inquiry Not Found....";
            echo 0;
        }
    }

    public function holiday()
    {

        $data["holiday"] = $this->AdminModel->GetAllholiday()->result();
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/holiday',$data);
        $this->load->view('Admin/footer');

    }

    public function holidayinsert()
    {
        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $start_date = $_REQUEST['start_date'];
        $end_date = $_REQUEST['end_date'];

        // $images = $_FILES['uploadimages']['name']; 
        // $images_tmp = $_FILES['uploadimages']['tmp_name']; 
        // $url = "assetsadmin/images/file/".$images;
        // move_uploaded_file($images_tmp,$url);
        
        $data = array( 'name' => $name, 
                    'start_date' => $start_date,
                       'end_date' => $end_date,
                    );

        if($id > 0)
        {        
            $res = $this->AdminModel->Updateholiday($data,$id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "holiday Updated Succesfully....";
                redirect(base_url("index.php/Admin/holiday"));
            }   
            else
            {
                $_SESSION['ErrSucc'] = "holiday not able to update.....";
                redirect(base_url("index.php/Admin/holiday"));
            } 
        }
        else
        {
            $res1 = $this->AdminModel->Insertholiday($data);
            if($res1 > 0)
            {
                $_SESSION['ErrSucc'] = "holiday Added Succesfully....";
                redirect(base_url("index.php/Admin/holiday"));
            }   
            else
            {
                //echo 2;
                $_SESSION['ErrSucc'] = "holiday not able to add.....";
                redirect(base_url("index.php/Admin/holiday"));
            } 
        }
    }
   
    public function Deleteholiday()
    {
        $id = $_REQUEST['id'];

        $res = $this-> AdminModel->Deleteholiday($id);
        if($res>0)
        {
            $_SESSION['ErrSucc'] = "holiday Delete Succesfully....";
            echo 1;
        }
        else
        {
            $_SESSION['ErrSucc'] = "holiday Not Found....";
            echo 0;
        }
    }


    public function leavetype(){

        $data["leave"] = $this->AdminModel->GetAllleavetype()->result();
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/leavetype',$data);
        $this->load->view('Admin/footer');
    }
    public function leavetypeinsert()
    {
        $leave_id = $_REQUEST['leave_id'];
        $name = $_REQUEST['name'];
        $number = $_REQUEST['number'];

        // $images = $_FILES['uploadimages']['name']; 
        // $images_tmp = $_FILES['uploadimages']['tmp_name']; 
        // $url = "assetsadmin/images/file/".$images;
        // move_uploaded_file($images_tmp,$url);
        
        $data = array( 'name' => $name, 
                    'number' => $number,
                    );

        if($leave_id > 0)
        {        
            $res = $this->AdminModel->Updateleavetype($data,$leave_id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "leavetype Updated Succesfully....";
                redirect(base_url("index.php/Admin/leavetype"));
            }   
            else
            {
                $_SESSION['ErrSucc'] = "leavetype not able to update.....";
                redirect(base_url("index.php/Admin/leavetype"));
            } 
        }
        else
        {
            $res1 = $this->AdminModel->Insertleavetype($data);
            if($res1 > 0)
            {
                $_SESSION['ErrSucc'] = "leavetype Added Succesfully....";
                redirect(base_url("index.php/Admin/leavetype"));
            }   
            else
            {
                //echo 2;
                $_SESSION['ErrSucc'] = "leavetype not able to add.....";
                redirect(base_url("index.php/Admin/leavetype"));
            } 
        }
    }
   
    public function Deleteleavetype()
    {
        $leave_id = $_REQUEST['leave_id'];

        $res = $this-> AdminModel->Deleteleavetype($leave_id);
        if($res>0)
        {
            $_SESSION['ErrSucc'] = "leavetype Delete Succesfully....";
            echo 1;
        }
        else
        {
            $_SESSION['ErrSucc'] = "leavetype Not Found....";
            echo 0;
        }
    }

    public function addleave(){

        $data["leave"] = $this->AdminModel->GetAllleavetype()->result();
        $data["manageemployee"] = $this->AdminModel->GetAllEmployee()->result();
       
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/addleave',$data);
        $this->load->view('Admin/footer');
   } 
   
   public function listaddleave(){

    $data["leave"] = $this->AdminModel->GetAlladdleave()->result();
   
    $this->load->view('Admin/header');
    $this->load->view('Admin/aside');
    $this->load->view('Admin/listaddleave',$data);
    $this->load->view('Admin/footer');
}  
   public function addleaveinsert()
    {
        $addleave_id = $_REQUEST['addleave_id'];
        $employee_id = $_REQUEST['employee_id'];
        $leave_id = $_REQUEST['leave_id'];
        $start_date = $_REQUEST['start_date'];
        $end_date = $_REQUEST['end_date'];
        $Approved = $_REQUEST['Approved'];
        $given_date = $_REQUEST['given_date'];
        $Reason = $_REQUEST['Reason'];

        // $images = $_FILES['uploadimages']['name']; 
        // $images_tmp = $_FILES['uploadimages']['tmp_name']; 
        // $url = "assetsadmin/images/file/".$images;
        // move_uploaded_file($images_tmp,$url);
        
        $data = array( 'employee_id' => $employee_id, 
                    'leave_id' => $leave_id,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'Approved' => $Approved,
                    'given_date' => $given_date,
                    'Reason' => $Reason,
                    );

        if($addleave_id > 0)
        {        
            $res = $this->AdminModel->Updateaddleave($data,$addleave_id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "leave Application Updated Succesfully....";
                redirect(base_url("index.php/Admin/listaddleave"));
            }   
            else
            {
                $_SESSION['ErrSucc'] = "leave Application not able to update.....";
                redirect(base_url("index.php/Admin/listaddleave"));
            } 
        }
        else
        {
            $res1 = $this->AdminModel->Insertaddleave($data);
            if($res1 > 0)
            {
                $_SESSION['ErrSucc'] = "leave Application Added Succesfully....";
                redirect(base_url("index.php/Admin/listaddleave"));
            }   
            else
            {
                //echo 2;
                $_SESSION['ErrSucc'] = "leave Application not able to add.....";
                redirect(base_url("index.php/Admin/listaddleave"));
            } 
        }
    }

    public function Deleteaddleave()
    {
        $addleave_id = $_REQUEST['addleave_id'];

        $res = $this-> AdminModel->Deleteaddleave($addleave_id);
        if($res>0)
        {
            $_SESSION['ErrSucc'] = "leave Application Delete Succesfully....";
            echo 1;
        }
        else
        {
            $_SESSION['ErrSucc'] = "leave Application Not Found....";
            echo 0;
        }
    }

    public function addCandidate(){

        $data["leave"] = $this->AdminModel->GetAlladdleave()->result();
       
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/addCandidate',$data);
        $this->load->view('Admin/footer');
    }  

    public function listCandidate(){

        $data["leave"] = $this->AdminModel->GetAllCandidate()->result();
       
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/listCandidate',$data);
        $this->load->view('Admin/footer');
    }  
    public function Candidateinsert()
    {
        $Candidate_id = $_REQUEST['Candidate_id'];
        $Candidate_name = $_REQUEST['Candidate_name'];
        $email = $_REQUEST['email'];
        $number = $_REQUEST['number'];
        $Address = $_REQUEST['Address'];
        $Degree = $_REQUEST['Degree'];
        $University = $_REQUEST['University'];
        $CGPA = $_REQUEST['CGPA'];
        $Year = $_REQUEST['Year'];
        $C_name = $_REQUEST['C_name'];
        $Duties = $_REQUEST['Duties'];
        $experience = $_REQUEST['experience'];
        $CTC = $_REQUEST['CTC'];

        // $images = $_FILES['uploadimages']['name']; 
        // $images_tmp = $_FILES['uploadimages']['tmp_name']; 
        // $url = "assetsadmin/images/file/".$images;
        // move_uploaded_file($images_tmp,$url);
        
        $data = array( 'Candidate_name' => $Candidate_name, 
                    'email' => $email,
                    'number' => $number,
                    'Address' => $Address,
                    'Degree' => $Degree,
                    'University' => $University,
                    'CGPA' => $CGPA,
                    'Year' => $Year,
                    'C_name' => $C_name,
                    'Duties' => $Duties,
                    'experience' => $experience,
                    'CTC' => $CTC,
                    );

        if($Candidate_id > 0)
        {        
            $res = $this->AdminModel->UpdateCandidate($data,$Candidate_id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = "Candidate Updated Succesfully....";
                redirect(base_url("index.php/Admin/listCandidate"));
            }   
            else
            {
                $_SESSION['ErrSucc'] = "Candidate not able to update.....";
                redirect(base_url("index.php/Admin/listCandidate"));
            } 
        }
        else
        {
            $res1 = $this->AdminModel->InsertCandidate($data);
            if($res1 > 0)
            {
                $_SESSION['ErrSucc'] = "Candidate Added Succesfully....";
                redirect(base_url("index.php/Admin/listCandidate"));
            }   
            else
            {
                //echo 2;
                $_SESSION['ErrSucc'] = "Candidatenot able to add.....";
                redirect(base_url("index.php/Admin/listCandidate"));
            } 
        }
    }

    public function DeleteCandidate()
    {
        $Candidate_id = $_REQUEST['Candidate_id'];

        $res = $this-> AdminModel->DeleteCandidate($Candidate_id);
        if($res>0)
        {
            $_SESSION['ErrSucc'] = "Candidate  Delete Succesfully....";
            echo 1;
        }
        else
        {
            $_SESSION['ErrSucc'] = "Candidate  Not Found....";
            echo 0;
        }
    }

    public function Shortlist(){

        $data["leave"] = $this->AdminModel->GetAllCandidate()->result();
        $data["Department"] = $this->AdminModel->GetAlldepartment()->result();
        $data["Shortlist"] = $this->AdminModel->GetAllShortlist()->result();
       
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/Shortlist',$data);
        $this->load->view('Admin/footer');
    } 
    public function Shortlistinsert()
    {
        $Shortlist_id = $_REQUEST['Shortlist_id'];
        $Candidate_id = $_REQUEST['Candidate_id'];
        $Department_id = $_REQUEST['Department_id'];
        $start_date = $_REQUEST['start_date'];
        $end_date = $_REQUEST['end_date'];

        
        $data = array( 'Candidate_id' => $Candidate_id, 
                    'Department_id' => $Department_id,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    
                    );

        if($Shortlist_id > 0)
        {        
            $res = $this->AdminModel->UpdateShortlist($data,$Shortlist_id);
            if($res > 0)
            {
                $_SESSION['ErrSucc'] = " Shortlist Candidate Updated Succesfully....";
                redirect(base_url("index.php/Admin/Shortlist"));
            }   
            else
            {
                $_SESSION['ErrSucc'] = " Shortlist Candidate not able to update.....";
                redirect(base_url("index.php/Admin/Shortlist"));
            } 
        }
        else
        {
            $res1 = $this->AdminModel->InsertShortlist($data);
            if($res1 > 0)
            {
                $_SESSION['ErrSucc'] = " Shortlist Candidate Added Succesfully....";
                redirect(base_url("index.php/Admin/Shortlist"));
            }   
            else
            {
                //echo 2;
                $_SESSION['ErrSucc'] = "Shortlist  Candidatenot able to add.....";
                redirect(base_url("index.php/Admin/Shortlist"));
            } 
        }
    }

    public function DeleteShortlist()
    {
        $Shortlist_id = $_REQUEST['Shortlist_id'];

        $res = $this-> AdminModel->DeleteShortlist($Shortlist_id);
        if($res>0)
        {
            $_SESSION['ErrSucc'] = " Shortlist  Candidate  Delete Succesfully....";
            echo 1;
        }
        else
        {
            $_SESSION['ErrSucc'] = "Shortlist Candidate  Not Found....";
            echo 0;
        }
    }
}
