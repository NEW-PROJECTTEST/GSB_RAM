<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Party extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('party_model');
        $this->load->model('billing_model','bill');
        $this->isLoggedIn();   
    }
    
    /**
     * This function is used to load the party list
     */
    function partyListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      
          
            $this->global['pageTitle'] = $this->company_name.' :Party Details ';
            $this->loadViews("party/party", $this->global, NULL, NULL);
        }
    }
    function getPartyDetails()
    {
      $draw = intval($this->input->post("draw"));
      $start = intval($this->input->post("start"));
      $length = intval($this->input->post("length"));
        $data_array_new = [];
        $data_array = $this->party_model->partyListing($this->company_id);
       
        foreach($data_array as $r) {
            // $viewButton ='<a class="btn  btn-sm btn-primary" href="'.site_url('viewParty/'.$r->row_id).'"title="View"><i class="fa fa-eye"></i></a>';
            if($this->role == ROLE_ADMIN ) {
             $editButton = '<a class="btn  btn-sm btn-info" href="'.site_url('editPartyPageView/'.$r->row_id).'"title="Edit"><i class="fas fa-edit"></i></i></a>';
             $deleteButton = '<a class="btn btn-sm btn-danger deleteParty" data-row_id='.$r->row_id.' href="#" title="Delete"><i class="fas fa-trash"></i></a>';
            }else{
                $editButton='';
                $deleteButton='' ;
            }
            // $billTotal = $this->bill->getBillTotalByPartyId($r->row_id);
            // $paidBillTotal = $this->bill->getBillPaidTotalByPartyId($r->row_id);
            // $pending_bal = $billTotal - $paidBillTotal;
            $data_array_new[] = array(
                 $r->party_name,
                //  $r->email,
                 $r->contact_number_one,
                //  number_format($pending_bal,2),    
                
                 $editButton.' '.$deleteButton
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
     * This function is used to add new party to the system
     */
    function addParty()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
                $party_name = ucwords(strtolower($this->security->xss_clean($this->input->post('party_name'))));
                $party_address =  $this->security->xss_clean($this->input->post('party_address'));
                $email = strtolower($this->security->xss_clean( $this->security->xss_clean($this->input->post('email'))));
                $contact_number_one = $this->security->xss_clean($this->input->post('contact_number_one'));
                $contact_number_two = $this->security->xss_clean($this->input->post('contact_number_two'));
                // $gst =$this->security->xss_clean($this->input->post('gst'));
                // $state_code =$this->security->xss_clean($this->input->post('state_code'));
                $partyInfo = array('party_name'=>$party_name,'party_address'=>$party_address,'email'=>$email,
               'contact_number_one'=>$contact_number_one,'contact_number_two'=>$contact_number_two,           
                'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->party_model->addParty($partyInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New party created successfully');
                } else{
                    $this->session->set_flashdata('error', 'party creation failed');
                }
                
                redirect('partyListing');
            }
        
    }

    /**
     * This function is used load party edit information
     */
    function editPartyPageView($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            if($row_id == null){
                redirect('partyListing');
            }
            $data['partyInfo'] = $this->party_model->getPartyInfoById($row_id);
            $this->global['pageTitle'] = $this->company_name.' : Edit party ';
            $this->loadViews("party/editParty", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to edit the party information
     */
    function updateParty()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else { 
            $row_id = $this->input->post('row_id');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('party_name','party Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('party_address','party Address','required');
            $this->form_validation->set_rules('contact_number_one','Contact Number','required|max_length[10]');
            if($this->form_validation->run() == FALSE)
            {
                $this->editpartyPageView($row_id);
            }else {
                $party_name = ucwords(strtolower($this->security->xss_clean($this->input->post('party_name'))));
                $party_address = $this->input->post('party_address');
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $contact_number_one =$this->input->post('contact_number_one');
                $contact_number_two =$this->input->post('contact_number_two');
                // $gst =$this->input->post('gst');
                // $state_code =$this->input->post('state_code');
                $partyInfo = array('party_name'=>$party_name,'party_address'=>$party_address,'email'=>$email,
               'contact_number_one'=>$contact_number_one,'contact_number_two'=>$contact_number_two,          
                'company_id'=>$this->company_id,'updated_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->party_model->updateParty($partyInfo,$row_id);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New party updated successfully');
                }
                else{
                    $this->session->set_flashdata('error', 'party update failed');
                }
                redirect('editPartyPageView/'.$row_id);
            }
        }
    }

/**
     * This function is used to delete the party using row_id
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteParty()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $partyInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->party_model->deleteParty($row_id,$partyInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }
    /**
     * View party details based on party_id
     *
     */
    public function viewParty($row_id = null)
    {
        if ($this->isAdmin() == true ) {
            $this->loadThis();
        } else {
            if ($row_id == null) {
                redirect('partyListing');
            }
            $data['partyInfo'] = $this->party_model->getPartyInfoById($row_id);
            $data['partyBillInfo'] = $this->bill->getBillInfoByPartyId($row_id);
            $data['billPaidInfo'] = $this->bill->getBillPaidInfoByPartyId($row_id);
            $this->global['pageTitle'] = $this->company_name.': View party';
            $this->loadViews("party/viewParty", $this->global, $data, null);
        }
    } 

    // function partyBalPendingListing()
    // {
    //     if($this->isAdmin() == TRUE)
    //     {
    //         $this->loadThis();
    //     } else {      
          
    //         $this->global['pageTitle'] = $this->company_name.' :Party Details ';
    //         $this->loadViews("party/pendingBalance", $this->global, NULL, NULL);
    //     }
    // }

    // function getPendingBalPartyDetails()
    // {
    //   $draw = intval($this->input->post("draw"));
    //   $start = intval($this->input->post("start"));
    //   $length = intval($this->input->post("length"));
    //     $data_array_new = [];
    //     $data_array = $this->party_model->partyListing($this->company_id);
       
    //     foreach($data_array as $r) {
    //         $viewButton ='<a class="btn  btn-sm btn-primary" href="'.site_url('viewParty/'.$r->row_id).'"title="View"><i class="fa fa-eye"></i></a>';
    //         if($this->role == ROLE_ADMIN ) {
    //          $editButton = '<a class="btn  btn-sm btn-info" href="'.site_url('editPartyPageView/'.$r->row_id).'"title="Edit"><i class="fas fa-edit"></i></i></a>';
    //          $deleteButton = '<a class="btn btn-sm btn-danger deleteParty" data-row_id='.$r->row_id.' href="#" title="Delete"><i class="fas fa-trash"></i></a>';
    //         }else{
    //             $editButton='';
    //             $deleteButton='' ;
    //         }
    //         $billTotal = $this->bill->getBillTotalByPartyId($r->row_id);
    //         $paidBillTotal = $this->bill->getBillPaidTotalByPartyId($r->row_id);
    //         $pending_bal = $billTotal - $paidBillTotal;
    //         if($pending_bal>0){
    //             $data_array_new[] = array(
    //                 $r->party_name,
    //                //  $r->email,
    //                 $r->contact_number_one,
    //                 number_format($pending_bal,2),    
                   
    //                 $editButton.' '. $viewButton.' '.$deleteButton
    //            );
    //         }
            
    //    }
   
    //    $count = count($data_array);
    //     $result = array(
    //          "draw" => $draw,
    //           "recordsTotal" => $count,
    //           "recordsFiltered" => $count,
    //           "data" => $data_array_new
    //      );
    //     echo json_encode($result);
    //     exit();
    // }
   
}

?>