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
                    redirect(base_url("index.php/Admin/dashboard")); 
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
        $TodaySale = (object)$this->AdminModel->TotalSale($todaydate)->result();
        $todayamt = 0;
        foreach ($TodaySale as $sale) 
        {   $todayamt += $sale->inv_totalamt;       }
        $data["TodaySale"] = $todayamt;

        $TotalSale = (object)$this->AdminModel->TotalSale()->result();
        $totalamt = 0;
        foreach ($TotalSale as $sale) 
        {   $totalamt += $sale->inv_totalamt;       }
        $data["TotalSale"] = $totalamt;

        //----------------------Product Wise Sale-------------------
        //----------------------Today data--------------------------
        $prodamt = 0;
        $prod_name = "";
        $var_name = "";
        $inv_date = "";
        $inv_no = "";

        $todayprodSale = (object)$this->AdminModel->ProductWiseSale($todaydate)->result();
        $todaypws = array();

        foreach ($todayprodSale as $sale) 
        {
            $prodamt = $sale->inv_totalamt;
            $prod_name = $sale->product_name;
            $var_name = $sale->varient_name;
            $inv_date = $sale->invoice_date;
            $inv_no = $sale->invoice_string;

            $sale->inv_totalamt = $prodamt;
            $sale->product_name = $prod_name;
            $sale->varient_name = $var_name;
            $sale->invoice_date = $inv_date;
            $sale->invoice_string = $inv_no;

            array_push($todaypws,$sale);
        }
        $data["todayprod_sale"] = $todaypws;

        //----------------------Total data--------------------------
        $totalprodSale = (object)$this->AdminModel->ProductWiseSale()->result();
        $totalpws = array();

        foreach ($totalprodSale as $sale) 
        {
            $prodamt = $sale->inv_totalamt;
            $prod_name = $sale->product_name;
            $var_name = $sale->varient_name;
            $inv_date = $sale->invoice_date;
            $inv_no = $sale->invoice_string;

            $sale->inv_totalamt = $prodamt;
            $sale->product_name = $prod_name;
            $sale->varient_name = $var_name;
            $sale->invoice_date = $inv_date;
            $sale->invoice_string = $inv_no;

            array_push($totalpws,$sale);
        }
        $data["totalprod_sale"] = $totalpws;

        //----------------------Product Wise Stock------------------
        //----------------------Total no of stock-------------------
        $prodStock = (object)$this->AdminModel->GetAllPurchase()->result();
        $pwstock = array();

        foreach ($prodStock as $stock) 
        {
            $prod_name = $stock->product_name;
            $var_name = $stock->varient_name;
            $qty = $stock->qty;
            //$pprice = $stock->purchase_price;

            $stock->product_name = $prod_name;
            $stock->varient_name = $var_name;
            $stock->min_stock = $qty;
            //$stock->purchase_price = $pprice;

            array_push($pwstock,$stock);
        }
        $data["prod_stock"] = $pwstock;

        //----------------------Total stock value -------------------
        $prodstockvalue = (object)$this->AdminModel->GetAllPurchase()->result();
        $pwstockvalue = array();

        foreach ($prodstockvalue as $stockvalue) 
        {
            $prod_name = $stockvalue->product_name;
            $var_name = $stockvalue->varient_name;
            $qty = $stockvalue->qty;
            $pprice = $stockvalue->purchase_price;

            $stockvalue->product_name = $prod_name;
            $stockvalue->varient_name = $var_name;
            $stockvalue->min_stock = $qty;
            $stockvalue->purchase_price = $pprice;

            array_push($pwstockvalue,$stockvalue);
        }
        $data["prod_stock_value"] = $pwstockvalue;

        //print_r($data["prod_sale"]);die;
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/index',$data);
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

// ------------------- Manage Employee ----------------------
    public function manageemployee()
    {
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
                echo $res->employee_id.','.$res->employee_name.','.$res->employee_mobile.','.$res->employee_username.','.$res->employee_password.','.$res->employee_address.','.$res->employee_email;
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

    /*public function Findemployee()
    {   
        $employee_id = '';
        $employee_type = '';
        $mobile = '';

        if(isset($_REQUEST['employee_id']))
        {
            $employee_id = $_REQUEST['employee_id'];
        }
        if(isset($_REQUEST['employee_type']))
        {
            $employee_type = $_REQUEST['employee_type'];
        }        
       
        if($employee_id !='' || $employee_type != '' )
        {
            $res = $this->AdminModel->GetAllemployee($employee_id,$employee_type)->result();
            //print_r($res);die;
            foreach ($res as $employee) 
            {            
                echo $employee->employee_id.','.$employee->employee_name.','.$employee->mobile.','.$employee->address.','.$employee->gst.','.$employee->city.','.$employee->employee_balance.','.$employee->employee_type."~";
            }
        }
        else
        {
            echo '0';
        }
    }*/

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
                        'customer_email'=>$customer_email,
                        'customer_address'=>$customer_address
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
        $data["managesupplier"] = $this->AdminModel->GetAllSupplier()->result();
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

        $this->db->trans_start();
        $str = $this->AdminModel->DeleteProductDetail($product_id)->result();
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

    public function fetchsupplier()
    {
        $managesupplier = $this->AdminModel->GetAllSupplier()->result();
        foreach ($managesupplier as $supplier) 
        {
            echo $supplier->supplier_id."^".$supplier->supplier_name."~";
        }
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
        $product_detail_id = "";
        if(isset($_REQUEST["pid"]))
        {
            $product_detail_id = $_REQUEST["pid"];
        }

        $serial_no = "";
        if(isset($_REQUEST["serial_no"]))
        {
            $serial_no = $_REQUEST["serial_no"];
        }

        $data = $this->AdminModel->GetAllProduct1($product_detail_id,$serial_no)->row();
        //print_r($data);die;
        echo $data->product_detail_id."^".$data->sale_tax."^".$data->purchase_price."^".$data->sale_price."^".$data->product_id."^".$data->tax_rate;
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
            $bill_no = $obj1['bill_no'];
            $bill_date = $obj1['bill_date'];
            $referance_no = $obj1['referance_no'];
            $due_date = $obj1['due_date'];
            $sub_total = $obj1['sub_total'];
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
            $purchase_price[] = $obj2['purchase_price'];
            $sale_price[] = $obj2['sale_price'];
            $tax_id[] = $obj2['tax_id'];
            $tax_amt[] = $obj2['tax_amt'];
            $total[] = $obj2['total'];
        }

        //print_r($varient_name);die;

        $data = array( 'supplier_id' => $supplier_id,
                       'shop_id' => $shop_id,
                       'bill_no' => $bill_no,
                       'bill_date' => $bill_date,
                       'referance_no' => $referance_no,
                       'due_date' => $due_date,
                       'sub_total' => $sub_total,
                       'round_off' => $round_off,
                       'total_amt' => $total_amt );

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
                                        'serial_no' => $serial_no[$i],
                                        'qty' => $qty[$i],
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
                    }  
                    else
                    {
                        $this->db->trans_complete();
                        $_SESSION['ErrSucc'] = "Problem Occured Purchase Detail Try Again";
                    } 

                    $stockData = "";
                    $str1 = "";

                    for($i = 0; $i < count($varientname); $i++)
                    {
                        $stockData = (object)array( 'product_detail_id' => $varientname[$i],
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
                    }
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
                redirect(base_url("index.php/Admin/managepurchase"));
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
                                        'serial_no' => $serial_no[$i],
                                        'qty' => $qty[$i],
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
                echo $res->purchase_id.','.$res->supplier_id.','.$res->shop_id.','.$res->bill_no.','.$res->referance_no.','.$res->bill_date.','.$res->due_date.','.$res->sub_total.','.$res->round_off.','.$res->total_amt;
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
            $product_detail_id = array();
            $qty = array();

            $query = "";
            foreach ($str as $s) 
            {
                $product_detail_id = $s->product_detail_id;
                $qty = $s->qty;
                $stockData = (object)array( 'product_detail_id' => $product_detail_id,
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
        $data["managesale"] = $this->AdminModel->GetAllSale()->result();
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
        
        $sr[] = $ser_no;
        $res = $this->AdminModel->GetPurchaseVarient($product_detail_id,$ser_no)->row();
        $str = $this->AdminModel->GetSaleVarient($product_detail_id)->result();
        
        $serialno = "";
        $shop_id = "";
        $product_detail_id = "";
        if(isset($res))
        {
            $serialno = $res->serial_no;
            $shop_id = $res->shop_id;
            $product_detail_id = $res->product_detail_id;
        }

        /*$sr_no = "";
        $p_sr_no = explode(',',$serialno);
        $s_no = array();

        foreach ($p_sr_no as $key => $value) 
        {
            $s_no[]= $value;
        }
       
        //$pay_date = array();
        foreach ($str as $salestr) 
        {
            $s_sr_no[] = $salestr->serial_no;
        }

        if(isset($s_sr_no))
        {    
            $result = array_diff($p_sr_no, $s_sr_no);

            if($ser_no =='')
            { 
                $sr_no = implode(',',$result);
            }
            else
            {
                $result1 = array_intersect($result, $sr);
                //$result1 = array_diff($result, $sr);
                //$res = array_diff($result,$result1);
                $sr_no = implode(',',$result1);
            }
            
        }
        else
        {
            $sr_no = $serialno;
        }*/

        //$shop_id = $res->shop_id;
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
        else
        {
            $invoiceNo = "";
        } 
        

        $invoiceString = date('Y|m')."|".$invoiceNo;

        echo $product_detail_id."^".$serialno."^".$shop_id."^".$invoiceNo."^".$invoiceString;
    }

    public function addnewsale()
    {
        $data["manageproduct"] = $this->AdminModel->GetAllProduct1()->result();

        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/addnewsale',$data);
        $this->load->view('Admin/footer');
    }

    public function fetchproduct()
    {
        $product_detail_id = $_REQUEST['pid'];
        $manageproduct = $this->AdminModel->GetAllProduct2($product_detail_id)->result();
        foreach ($manageproduct as $pd) 
        {
            echo $pd->serial_no."~";
        }
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
        //$customer_status = 1;
        if(isset($_SESSION['employee_id']))
        {
            $user_id = $_SESSION['employee_id'];
            //$customer_status = 1;
        }
        else
        {
            $user_id = 0;
            //$customer_status = 2;
        }

        $Object = array();
        $Object = json_decode(file_get_contents('php://input'),true);

        foreach ($Object['result1'] as $obj1) 
        {
            $sale_id = $obj1['sale_id'];
            $customer_id = $obj1['customer_id'];
            $invoice_no = $obj1['invoice_no'];
            $invoice_string = $obj1['invoice_string'];
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
                $saleid = $sale_id;
                $_SESSION['shopid'] = $shop_id;
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
            $product_detail_id = array();
            $qty = array();

            $query = "";
            foreach ($str as $s) 
            {
                $product_detail_id = $s->product_detail_id;
                $qty = $s->qty;
                $stockData = (object)array( 'product_detail_id' => $product_detail_id,
                                            'qty' => $qty );   
                $query = $this->AdminModel->CreditStock($stockData);
            }
            
            /*for($i = 0; $i < count($str); $i++)
            {
                $stockData = (object)array( 'product_detail_id' => $str->product_detail_id[$i],
                                            'qty' => $str->qty[$i] );
                $query = $this->AdminModel->CreditStock($stockData);
            }*/

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

        $data = array( 'shop_name' => $shop_name,
                       'shop_address' => $shop_address,
                       'shop_phone' => $shop_phone,
                       'shop_gst' => $shop_gst );

        if($shop_id > 0)
        {        
            $res = $this->AdminModel->UpdateShop($data,$shop_id);
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
                echo $res->shop_id.','.$res->shop_name.','.$res->shop_address.','.$res->shop_phone.','.$res->shop_gst;
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
      /*  $data["manageproduct"] = $this->AdminModel->GetAllProduct()->result();
        $data["managebrand"] = $this->AdminModel->GetAllBrand()->result();
        $data["managecategory"] = $this->AdminModel->GetAllCategory()->result();*/
        //$data["Allemireport"] = $this->AdminModel->GetAllEmiReport()->result();
        $this->load->view('Admin/header');
        $this->load->view('Admin/aside');
        $this->load->view('Admin/purchasereport'); 
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
        
        $str = $this->AdminModel->GetAllSale(null,$fromdate,$todate,$product_id,$category_id,$brand_id)->result();
        
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

}
