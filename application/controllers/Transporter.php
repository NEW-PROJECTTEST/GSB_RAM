<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Transporter  extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transporter_model');
        $this->isLoggedIn();   
    }
  
    /**
     * This function is used to load the Transporter list
     */
    function transporterListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      
            $this->global['pageTitle'] = $this->company_name.' :Transporter Details ';
            $this->loadViews("transporter/transporter", $this->global, NULL, NULL);
        }
    }


    function getTransporterDetails()
    {
      $draw = intval($this->input->post("draw"));
      $start = intval($this->input->post("start"));
      $length = intval($this->input->post("length"));
        $data_array_new = [];
        $data_array = $this->transporter_model->transporterListing($this->company_id);
        foreach($data_array as $r) {
            $viewButton ='<a class="btn  btn-sm btn-primary" href="'.site_url('viewTransporter/'.$r->row_id).'"title="View"><i class="fa fa-eye"></i></a>';
            if($this->role == ROLE_ADMIN ) {
             $editButton ='<a class="btn  btn-sm btn-info" href="'.site_url('editTransporterPageView/'.$r->row_id).'"title="Edit"><i class="fas fa-edit"></i></i></a>';
             $deleteButton = '<a class="btn btn-sm btn-danger deleteTransporter" data-row_id='.$r->row_id.' href="#" title="Delete"><i class="fas fa-trash"></i></a>';
            }else{
                $deleteButton='' ;
                $editButton='';
            }
            $data_array_new[] = array(
                 $r->transporter_name,
                 $r->contact_number,
                 $r->firm_name,
                 $r->transporter_address,
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
    /**
     * This function is used to load the add new form
     */
    function addTransporterPageView()
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = $this->company_name.' : Add  Transporter ';
            $this->loadViews("transporter/addTransporter", $this->global, NULL, NULL);
        }
    }

    /**
     * This function is used to add new Transporter to the system
     */
    function addTransporter()
    {
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('transporter_name','Transporter Name','required');
            $this->form_validation->set_rules('transporter_address','Transporter Address','required');
            $this->form_validation->set_rules('transporter_account_number','Account Number','required');
            $this->form_validation->set_rules('contact_number','Contact Number','required');
            if($this->form_validation->run() == FALSE) {
                $this->addTransporterPageView();
            } else {
                $transporter_name = ucwords(strtolower($this->security->xss_clean($this->input->post('transporter_name'))));
                $transporter_address = $this->input->post('transporter_address');
                $contact_number = $this->input->post('contact_number');
               // $firm_name = $this->input->post('firm_name');
                $transporter_account_number = $this->input->post('transporter_account_number');
                $email = $this->input->post('email');
                $comments = $this->input->post('comments');
                $transporterInfo = array( 'transporter_name'=>$transporter_name, 'transporter_address'=>$transporter_address,'contact_number'=>$contact_number,'email'=>$email,
                'comments'=>$comments, 'transporter_account_number'=>$transporter_account_number, 'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->transporter_model->addTransporter($transporterInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Transporter created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Transporter creation failed');
                }
                redirect('addTransporterPageView');
            }
        }
    }

    /**
     * This function is used load Transporter edit information
     */
    function editTransporterPageView($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            if($row_id == null){
                redirect('transporterListing');
            }
            $data['transporterInfo'] = $this->transporter_model->getTransporterInfoById($row_id);
            $this->global['pageTitle'] = $this->company_name.' : Edit Transporter ';
            $this->loadViews("transporter/editTransporter", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to edit the Transporter information
     */
    function updateTransporter()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else { 
            $row_id = $this->input->post('row_id');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('transporter_name','Transporter Name','required');
            $this->form_validation->set_rules('transporter_address','Transporter Address','required');
            $this->form_validation->set_rules('transporter_account_number','Account Number','required');
            $this->form_validation->set_rules('contact_number','Contact Number','required');
            if($this->form_validation->run() == FALSE)
            {
                $this->editTransporterPageView($row_id);
            }else {
                $email = $this->input->post('email');
                $transporter_name = ucwords(strtolower($this->security->xss_clean($this->input->post('transporter_name'))));
                $transporter_address = $this->input->post('transporter_address');
                $contact_number = $this->input->post('contact_number');
                $contact_number_two = $this->input->post('contact_number_two');
                $firm_name = $this->input->post('firm_name');
                $email = $this->input->post('email');
                $comments = $this->input->post('comments');
                $transporter_account_number = $this->input->post('transporter_account_number');
                $transporterInfo = array('firm_name'=>$firm_name, 'transporter_name'=>$transporter_name, 'transporter_address'=>$transporter_address,
                'contact_number'=>$contact_number,'email'=>$email,'comments'=>$comments, 'transporter_account_number'=>$transporter_account_number,'company_id'=>$this->company_id,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->transporter_model->updateTransporter($transporterInfo,$row_id);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Transporter updated successfully');
                }
                else{
                    $this->session->set_flashdata('error', 'Transporter update failed');
                }
                redirect('editTransporterPageView/'.$row_id);
            }
        }
    }

/**
     * This function is used to delete the Transporter using row_id
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteTransporter()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $transporterInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->transporter_model->deleteTransporter($row_id,$transporterInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }
    /**
     * View Transporter details based on row_id
     *
     */
    public function viewTransporter($row_id = null)
    {
        if ($this->isAdmin() == true ) {
            $this->loadThis();
        } else {
            if ($row_id == null) {
                redirect('transporterListing');
            }
            $data['transporterInfo'] = $this->transporter_model->getTransporterInfoById($row_id);
            $this->global['pageTitle'] = $this->company_name.': View Transporter';
            $this->loadViews("transporter/viewTransporter", $this->global, $data, null);
        }
    } 

   


}

?>