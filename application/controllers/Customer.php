<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Customer extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('customer_model');
        $this->load->model('employee_model');
      
        $this->isLoggedIn();   
    }
    
    /**
     * This function is used to load the customer list
     */
    function customerListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {      
            $customer_name = $this->security->xss_clean($this->input->post('customer_name'));
            $code = $this->security->xss_clean($this->input->post('code'));
            $contact_number = $this->security->xss_clean($this->input->post('contact_number'));
            $customer_address = $this->security->xss_clean($this->input->post('customer_address'));
            $email = $this->security->xss_clean($this->input->post('email'));
           
            $data['customer_name'] = $customer_name;
            $data['code'] = $code;
            $data['contact_number'] = $contact_number;
            $data['customer_address'] = $customer_address;
            $data['email'] = $email;
           
            $filter['customer_name'] = $customer_name;
            $filter['code'] = $code;
            $filter['contact_number'] = $contact_number;
            $filter['customer_address'] = $customer_address;
            $filter['email'] = $email;
           
            $data['serviceEngineers'] = $this->employee_model->getUserInfoByRole('3');
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->customer_model->customerListingCount($searchText,$filter,$this->company_id);
            $data['count'] =  $count;
			$returns = $this->paginationCompress ( "customerListing/", $count, 10 );
            $data['customerRecords'] = $this->customer_model->customerListing($searchText,$filter,$this->company_id, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = $this->company_name.' :Customer Details ';
            $this->loadViews("customer/customer", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addCustomerPageView()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data['employeeInfo'] = $this->employee_model->getemployeeInfo($this->company_id);
            $this->global['pageTitle'] = $this->company_name.' : Add New Customer ';
            $this->loadViews("customer/addNewCustomer", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to add new customer to the system
     */
    function addCustomer()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('customer_name','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('contact_number','Contact Number','required|min_length[10]');
            $this->form_validation->set_rules('code','Customer Code','required');
            $this->form_validation->set_rules('customer_address','Address','required');
            if($this->form_validation->run() == FALSE) {
                $this->addCustomerPageView();
            }
            else {
    
                $customer_name = ucwords(strtolower($this->security->xss_clean($this->input->post('customer_name'))));
                $code = $this->input->post('code');
                 $contact_number = $this->input->post('contact_number');
         
                $customer_address = $this->security->xss_clean($this->input->post('customer_address'));
                $customerInfo = array('customer_code'=>$code,
                'customer_name'=>$customer_name,
                'contact_number'=>$contact_number,
                'customer_address'=>$customer_address, 
                'company_id'=>$this->company_id,
                'created_by'=>$this->employee_id,
                'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->customer_model->addcustomer($customerInfo);
                if($result > 0) {
                    $this->session->set_flashdata('success', 'New Customer added successfully');
                }
                else{
                    $this->session->set_flashdata('error', 'Customer creation failed');
                }
                
                redirect('addCustomerPageView');
            }
        }
    }
    /**
     * This function is used load customer edit information
     * @param number $userId : Optional : This is user id
     */
    function editCustomerPageView($customer_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        }
        else {
            if($customer_id == null){
                redirect('customerListing');
            }
            
            $data['customerInfo'] = $this->customer_model->getcustomerInfoById($customer_id);
            $this->global['pageTitle'] = $this->company_name.' : Edit Customer ';
            $this->loadViews("customer/editCustomer", $this->global, $data, NULL);
        }
    }

    
    /**
     * This function is used to edit the user information
     */
    function updateCustomer()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $customer_id = $this->input->post('customer_id');
            log_message('debug','adfhwfhew=='.$customer_id);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('customer_name','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('contact_number','Contact Number','required|min_length[10]');
            $this->form_validation->set_rules('code','Customer Code','required');
            $this->form_validation->set_rules('customer_address','Address','required');
            if($this->form_validation->run() == FALSE) {
                $this->editCustomerPageView($customer_id);
            }
            else {
                $customer_name = ucwords(strtolower($this->security->xss_clean($this->input->post('customer_name'))));
                $code = $this->input->post('code');
           
                $contact_number = $this->input->post('contact_number');
          
                $customer_address = $this->security->xss_clean($this->input->post('customer_address'));
                $customerInfo = array('customer_code'=>$code,
                'customer_name'=>$customer_name,
                'contact_number'=>$contact_number,
                'customer_address'=>$customer_address, 
                'company_id'=>$this->company_id,
                'created_by'=>$this->employee_id,
                'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->customer_model->updateCustomer($customerInfo,$customer_id);
                if($result > 0) {
                    $this->session->set_flashdata('success', 'Customer Updated successfully');
                }
                else{
                    $this->session->set_flashdata('error', 'Customer Update failed');
                }
                
                redirect('editCustomerPageView/'.$customer_id);
            }
        }
    }
  
/**
     * This function is used to delete the customer using customer_id
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteCustomer()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $customer_id = $this->input->post('customer_id');
            $customerInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->customer_model->deleteCustomer($customer_id,$customerInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }

      /**
     * View customer details based on row_id
     *
     */
    public function viewCustomer($customer_id = null)
    {
        if ($this->isAdmin() == true || $customer_id == 1) {
            $this->loadThis();
        } else {
            if ($customer_id == null) {
                redirect('customerListing');
            }
            $data['customerInfo'] = $this->customer_model->getcustomerInfoById($customer_id);
            $this->global['pageTitle'] = $this->company_name.' : View customer ';
            $this->loadViews("customer/viewCustomer", $this->global, $data, null);
        }
    } 


    

    public function generateIndent()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
             $customer_id = $this->input->post('customer_id');
              $date = $this->security->xss_clean($this->input->post('date'));
              $contract_number = $this->security->xss_clean($this->input->post('contract_number'));
              $product_code = $this->security->xss_clean($this->input->post('product_code'));
              $qty_unit = $this->security->xss_clean($this->input->post('qty_unit'));
              $dest_km = $this->security->xss_clean($this->input->post('dest_km'));
              $lr_num = $this->security->xss_clean($this->input->post('lr_num'));
              $tank_truck = $this->security->xss_clean($this->input->post('tank_truck'));
              $shipping_bill_no = $this->security->xss_clean($this->input->post('shipping_bill_no'));
              $container_no = $this->security->xss_clean($this->input->post('container_no'));
              $driver_name = $this->security->xss_clean($this->input->post('driver_name'));
              $dl_validity = $this->security->xss_clean($this->input->post('dl_validity'));
              $cleaner_name = $this->security->xss_clean($this->input->post('cleaner_name'));
              $fitness_certificate = $this->security->xss_clean($this->input->post('fitness_certificate'));
                if(empty($fitness_certificate)){
                   $fitness_certificate = NULL; 
                }else{
                    $fitness_certificate =  date('Y-m-d',strtotime($fitness_certificate));
                }
              $identInfo = array(
                'customer_id'=>$customer_id,
                'contract_number'=>$contract_number,
                'date'=>date('Y-m-d',strtotime($date)),
                'product_code'=>$product_code, 
                'qty_unit'=>$qty_unit,
                'destination_km'=>$dest_km,
                'lr_number'=>$lr_num, 
                'tank_truck_number'=>$tank_truck,
                'shipping_bill_no' => $shipping_bill_no,
                'container_no' => $container_no,
                'driver_name'=>$driver_name,
                'dl_num_validity'=>$dl_validity, 
                'cleaner_name'=>$cleaner_name,
                'fitness_cert_valid_date'=>$fitness_certificate,
                
                'created_by'=>$this->employee_id,
                'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->customer_model->createIdent($identInfo);
                if($result > 0) {
                    $this->session->set_flashdata('success', $result.' - Ident Created successfully');
                }
                else{
                    $this->session->set_flashdata('error', 'Ident failed');
                }
                redirect('customerListing');
                
           // }
        }
    }


    function viewIdent()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      
          
            $this->global['pageTitle'] = $this->company_name.' :Party Details ';
            $this->loadViews("customer/identView", $this->global, NULL, NULL);
        }
    }


    function viewIdentData()
    {
      $draw = intval($this->input->post("draw"));
      $start = intval($this->input->post("start"));
      $length = intval($this->input->post("length"));
        $data_array_new = [];
        $data_array = $this->customer_model->getIdentInfo();
       
        foreach($data_array as $r) {
            $viewButton ='<a target="_blank" class="btn  btn-sm btn-primary" href="'.site_url('viewSingleIdent/'.$r->row_id).'"title="View"><i class="fa fa-eye"></i></a>';
            $editButton = '<a target="_blank" class="btn  btn-sm btn-info" href="'.site_url('editIndentInfo/'.$r->row_id).'"title="Edit"><i class="fas fa-edit"></i></i></a>';
            $deleteButton = '<a class="btn btn-sm btn-danger deleteIndent" data-row_id='.$r->row_id.' href="#" title="Delete"><i class="fas fa-trash"></i></a>';
            
            $data_array_new[] = array(
                 $r->row_id,
                 date('d-m-Y',strtotime($r->date)),
                 $r->contract_number,
                 $r->customer_code,
                 $editButton.' '. $viewButton.' '.$deleteButton
            );
       }
   
       $count = count($data_array);
        $result = array(
             "draw" => $draw,
              "recordsTotal" => $count,
              "recordsFiltered" => $count,
              "data" => $data_array_new
         );
   echo json_encode($result);
   exit();
    }


    public function viewSingleIdent($ident_id = null)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            if ($ident_id == null) {
                redirect('viewIdent');
            }
            $data['identInfo'] = $this->customer_model->getIdentInfoById($ident_id);
            $this->global['pageTitle'] = $this->company_name.' : View Ident';
            $this->loadViews("customer/viewSingleIdent", $this->global, $data, null);
        }
    }
    
    public function editIndentInfo($ident_id = null){
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            if ($ident_id == null) {
                redirect('viewIdent');
            }
            $data['custInfo'] = $this->customer_model->getAllCustomer();
            $data['identInfo'] = $this->customer_model->getIdentInfoById($ident_id);
            $this->global['pageTitle'] = $this->company_name.' : View Ident';
            $this->loadViews("customer/editSingleIndent", $this->global, $data, null);
        }
    }
    public function updateIndent(){
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $row_id =  $this->input->post('row_id');
            $customer_id = $this->input->post('customer_id');
            $date = $this->security->xss_clean($this->input->post('date'));
            $contract_number = $this->security->xss_clean($this->input->post('contract_number'));
            $product_code = $this->security->xss_clean($this->input->post('product_code'));
            $qty_unit = $this->security->xss_clean($this->input->post('qty_unit'));
            $dest_km = $this->security->xss_clean($this->input->post('dest_km'));
            $lr_num = $this->security->xss_clean($this->input->post('lr_num'));
            $tank_truck = $this->security->xss_clean($this->input->post('tank_truck'));
            $shipping_bill_no = $this->security->xss_clean($this->input->post('shipping_bill_no'));
            $container_no = $this->security->xss_clean($this->input->post('container_no'));
            $driver_name = $this->security->xss_clean($this->input->post('driver_name'));
            $dl_validity = $this->security->xss_clean($this->input->post('dl_validity'));
            $cleaner_name = $this->security->xss_clean($this->input->post('cleaner_name'));
            $fitness_certificate = $this->security->xss_clean($this->input->post('fitness_certificate'));
            if(empty($fitness_certificate)){
                $fitness_certificate = NULL; 
             }else{
                 $fitness_certificate =  date('Y-m-d',strtotime($fitness_certificate));
             }
            $indentInfo = array(
              'customer_id'=>$customer_id,
              'contract_number'=>$contract_number,
              'date'=>date('Y-m-d',strtotime($date)),
              'product_code'=>$product_code, 
              'qty_unit'=>$qty_unit,
              'destination_km'=>$dest_km,
              'lr_number'=>$lr_num, 
              'tank_truck_number'=>$tank_truck,
              'shipping_bill_no' => $shipping_bill_no,
              'container_no' => $container_no,
              'driver_name'=>$driver_name,
              'dl_num_validity'=>$dl_validity, 
              'cleaner_name'=>$cleaner_name,
              'fitness_cert_valid_date'=> $fitness_certificate,
              
              'updated_by'=>$this->employee_id,
              'updated_date_time'=>date('Y-m-d H:i:s'));
              $result = $this->customer_model->updateIndent($row_id, $indentInfo);
              if($result > 0) {
                  $this->session->set_flashdata('success', $result.' - Indent Updated successfully');
              }
              else{
                  $this->session->set_flashdata('error', 'Indent Update failed');
              }
              redirect('editIndentInfo/'.$row_id);
        }
       
    }

    public function deleteIndent()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $indentInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->customer_model->updateIndent($row_id,$indentInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }
}



?>