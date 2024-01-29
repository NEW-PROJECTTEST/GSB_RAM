<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Committee extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('committee_model');
        $this->load->model('billing_model','bill');
        $this->isLoggedIn();   
    }
    
    /**
     * This function is used to load the committee list
     */
    function committeeListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {   
            $data['committeeRoleInfo'] =$this->committee_model->getCommitteeRoleInfo($this->company_id); 
            $data['committeeTypeInfo'] =$this->committee_model->getCommitteeTypeInfo($this->company_id);  
       
            $this->global['pageTitle'] = $this->company_name.' :Committee Details ';
            $this->loadViews("committee/committee", $this->global, $data, NULL);
        }
    }
    function getCommitteeDetails()
    {
      $draw = intval($this->input->post("draw"));
      $start = intval($this->input->post("start"));
      $length = intval($this->input->post("length"));
        $data_array_new = [];
        $data_array = $this->committee_model->committeeListing($this->company_id);
        
       
        foreach($data_array as $r) {
            $viewButton ='<a class="btn  btn-sm btn-primary" href="'.site_url('viewCommittee/'.$r->row_id).'"title="View"><i class="fa fa-eye"></i></a>';
            if($this->role == ROLE_ADMIN ) {
             $editButton = '<a class="btn  btn-sm btn-info" href="'.site_url('editCommitteePageView/'.$r->row_id).'"title="Edit"><i class="fas fa-edit"></i></i></a>';
             $deleteButton = '<a class="btn btn-sm btn-danger deleteCommittee" data-row_id='.$r->row_id.' href="#" title="Delete"><i class="fas fa-trash"></i></a>';
            }else{
                $editButton='';
                $deleteButton='' ;
            }
            if(!empty($r->profile_image)){
               $profile_image= '<img src="'.$r->profile_image.'"
                                class="avatar rounded-circle img-thumbnail" width="100" height="100" id="uploadedImage1"
                                name="userfile" alt="Profile Image Not Uploaded">';
            }
            else {
            $profile_image='';
            }
            // $billTotal = $this->bill->getBillTotalBycommitteeId($r->row_id);
            // $paidBillTotal = $this->bill->getBillPaidTotalBycommitteeId($r->row_id);
            // $pending_bal = $billTotal - $paidBillTotal;
            $data_array_new[] = array(
                $profile_image,
                 $r->committee_name,
                //  $r->email,
                 $r->contact_number_one,
                //  number_format($pending_bal,2),    
                $r->role,
                $r->type,
                $r->year,
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
     * This function is used to add new committee to the system
     */
    function addCommittee()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
                $committee_name = ucwords(strtolower($this->security->xss_clean($this->input->post('committee_name'))));
                $committee_address =  $this->security->xss_clean($this->input->post('committee_address'));
                $email = strtolower($this->security->xss_clean( $this->security->xss_clean($this->input->post('email'))));
                $contact_number_one = $this->security->xss_clean($this->input->post('contact_number_one'));
                $contact_number_two = $this->security->xss_clean($this->input->post('contact_number_two'));
                $role_id =$this->security->xss_clean($this->input->post('role'));
                $year =$this->security->xss_clean($this->input->post('year'));
                // $role_info = $this->committee_model->getRoleNameById($role_id); 
                // $role_name = $role_info->role;
                $type_id =$this->security->xss_clean($this->input->post('type'));
                // $type_info = $this->committee_model->getTypeNameById($type_id); 
                // $type_name = $type_info->type;

                $config=['upload_path' => './upload/',
               'allowed_types' => 'gif|jpg|png|jpeg','max_size' => '102400','max_width' => '5000','max_height' => '5000','overwrite' => TRUE,];
               $this->load->library('upload', $config);
              if($this->upload->do_upload()) {
                 $post=$this->input->post();
                 $data=$this->upload->data();
                 $profile_image=base_url("upload/".$data['new_name'].$data['file_ext']);
                 $post['profile_image']=$profile_image;
                 $profile_image=base_url("upload/".$data['raw_name'].$data['file_ext']);
                }
                log_message('debug','profile='. $profile_image);

                // $state_code =$this->security->xss_clean($this->input->post('state_code'));
                if(!empty($profile_image)) {
                $committeeInfo = array('committee_name'=>$committee_name,'committee_address'=>$committee_address,'email'=>$email,
               'contact_number_one'=>$contact_number_one,'profile_image'=> $profile_image,'contact_number_two'=>$contact_number_two,'role_id'=>$role_id,           
               'type_id'=>$type_id,'year'=>$year,'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
        } else {
                $committeeInfo = array('committee_name'=>$committee_name,'committee_address'=>$committee_address,'email'=>$email,
                'contact_number_one'=>$contact_number_one,'contact_number_two'=>$contact_number_two,'role_id'=>$role_id,           
                'type_id'=>$type_id,'year'=>$year,'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
        }
                $result = $this->committee_model->addCommittee($committeeInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Committee created successfully');
                } else{
                    $this->session->set_flashdata('error', 'Committee creation failed');
                }
                
                redirect('committeeListing');
            }
            // 'type'=>$type_name,'type_id'=>$type_id,
    }

    /**
     * This function is used load committee edit information
     */
    function editCommitteePageView($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            if($row_id == null){
                redirect('committeeListing');
            }
            $data['committeeInfo'] = $this->committee_model->getCommitteeInfoById($row_id);
           
            $data['committeeRoleInfo'] =$this->committee_model->getCommitteeRoleInfo($this->company_id);   
            $data['committeeTypeInfo'] =$this->committee_model->getCommitteeTypeInfo($this->company_id);  
     
            $this->global['pageTitle'] = $this->company_name.' : Edit committee ';
            $this->loadViews("committee/editCommittee", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to edit the committee information
     */
    function updateCommittee()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else { 
            $row_id = $this->input->post('row_id');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('committee_name','committee Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('committee_address','committee Address','required');
            $this->form_validation->set_rules('contact_number_one','Contact Number','required|max_length[10]');
            if($this->form_validation->run() == FALSE)
            {
                $this->editCommitteePageView($row_id);
            }else {
                $config=['upload_path' => './upload/',
                'allowed_types' => 'gif|jpg|png|jpeg','max_size' => '102400','max_width' => '5000','max_height' => '5000','overwrite' => TRUE,];
                $this->load->library('upload', $config);
               if($this->upload->do_upload()) {
                   $post=$this->input->post();
                   $data=$this->upload->data();
                   $profile_image=base_url("upload/".$data['new_name'].$data['file_ext']);
                   $post['profile_image']=$profile_image;
                   $profile_image=base_url("upload/".$data['raw_name'].$data['file_ext']);
               }
                $committee_name = ucwords(strtolower($this->security->xss_clean($this->input->post('committee_name'))));
                $committee_address = $this->input->post('committee_address');
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $contact_number_one =$this->input->post('contact_number_one');
                $contact_number_two =$this->input->post('contact_number_two');
                $contact_number_two = $this->security->xss_clean($this->input->post('contact_number_two'));
                $role_id =$this->security->xss_clean($this->input->post('role'));
                $year =$this->security->xss_clean($this->input->post('year'));
                // $role_info = $this->committee_model->getRoleNameById($role_id); 
                // $role_name = $role_info->role;
                $type_id =$this->security->xss_clean($this->input->post('type'));
                // $type_info = $this->committee_model->getTypeNameById($type_id); 
                // $type_name = $type_info->type;
                log_message('debug','conn='.$contact_number_two);
                // $state_code =$this->input->post('state_code');
                if(!empty($profile_image)){
                $committeeInfo = array('committee_name'=>$committee_name,'committee_address'=>$committee_address,'email'=>$email,
               'contact_number_one'=>$contact_number_one,'contact_number_two'=>$contact_number_two,'profile_image'=>$profile_image ,'role_id'=>$role_id,           
               'type_id'=>$type_id,'year'=>$year,'company_id'=>$this->company_id,'updated_date_time'=>date('Y-m-d H:i:s'));
                 } else {
                $committeeInfo = array('committee_name'=>$committee_name,'committee_address'=>$committee_address,'email'=>$email,
                'contact_number_one'=>$contact_number_one,'contact_number_two'=>$contact_number_two,'role_id'=>$role_id,           
               'type_id'=>$type_id,'company_id'=>$this->company_id,'year'=>$year,'updated_date_time'=>date('Y-m-d H:i:s'));
                }
                $result = $this->committee_model->updateCommittee($committeeInfo,$row_id);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New committee updated successfully');
                }
                else{
                    $this->session->set_flashdata('error', 'committee update failed');
                }
                redirect('editCommitteePageView/'.$row_id);
            }
        }
    }

/**
     * This function is used to delete the committee using row_id
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteCommittee()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $committeeInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->committee_model->deleteCommittee($row_id,$committeeInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }
    /**
     * View committee details based on committee_id
     *
     */
    public function viewCommittee($row_id = null)
    {
        if ($this->isAdmin() == true ) {
            $this->loadThis();
        } else {
            if ($row_id == null) {
                redirect('committeeListing');
            }
            $data['committeeInfo'] = $this->committee_model->getCommitteeInfoById($row_id);
            // $data['committeeBillInfo'] = $this->bill->getBillInfoByCommitteeId($row_id);
            // $data['billPaidInfo'] = $this->bill->getBillPaidInfoByCommitteeId($row_id);
            $this->global['pageTitle'] = $this->company_name.': View committee';
            $this->loadViews("committee/viewCommittee", $this->global, $data, null);
        }
    } 

//     function partyBalPendingListing()
//     {
//         if($this->isAdmin() == TRUE)
//         {
//             $this->loadThis();
//         } else {      
          
//             $this->global['pageTitle'] = $this->company_name.' :Party Details ';
//             $this->loadViews("party/pendingBalance", $this->global, NULL, NULL);
//         }
//     }

//     function getPendingBalPartyDetails()
//     {
//       $draw = intval($this->input->post("draw"));
//       $start = intval($this->input->post("start"));
//       $length = intval($this->input->post("length"));
//         $data_array_new = [];
//         $data_array = $this->party_model->partyListing($this->company_id);
       
//         foreach($data_array as $r) {
//             $viewButton ='<a class="btn  btn-sm btn-primary" href="'.site_url('viewParty/'.$r->row_id).'"title="View"><i class="fa fa-eye"></i></a>';
//             if($this->role == ROLE_ADMIN ) {
//              $editButton = '<a class="btn  btn-sm btn-info" href="'.site_url('editPartyPageView/'.$r->row_id).'"title="Edit"><i class="fas fa-edit"></i></i></a>';
//              $deleteButton = '<a class="btn btn-sm btn-danger deleteParty" data-row_id='.$r->row_id.' href="#" title="Delete"><i class="fas fa-trash"></i></a>';
//             }else{
//                 $editButton='';
//                 $deleteButton='' ;
//             }
//             $billTotal = $this->bill->getBillTotalByPartyId($r->row_id);
//             $paidBillTotal = $this->bill->getBillPaidTotalByPartyId($r->row_id);
//             $pending_bal = $billTotal - $paidBillTotal;
//             if($pending_bal>0){
//                 $data_array_new[] = array(
//                     $r->party_name,
//                    //  $r->email,
//                     $r->contact_number_one,
//                     number_format($pending_bal,2),    
                   
//                     $editButton.' '. $viewButton.' '.$deleteButton
//                );
//             }
            
//        }
   
//        $count = count($data_array);
//         $result = array(
//              "draw" => $draw,
//               "recordsTotal" => $count,
//               "recordsFiltered" => $count,
//               "data" => $data_array_new
//          );
//    echo json_encode($result);
//    exit();
//     }
   
}

?>