<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Family extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('family_model');
        $this->load->model('devotee_model');
        $this->load->model('committee_model');
        $this->load->model('setting_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the family
     */
    
    /**
     * This function is used to load the  family list
     */
    function familyListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      
            // $family_id = $this->security->xss_clean($this->input->post('family_id'));  
            $family_name = $this->security->xss_clean($this->input->post('family_name'));
            $contact_number = $this->security->xss_clean($this->input->post('contact_number'));
            $email = $this->security->xss_clean($this->input->post('email'));
            // $data['family_id'] = $family_id;
            $data['devotee_name'] = $family_name;
            $data['contact_number'] = $contact_number;
            $data['email'] = $email;
            // $filter['family_id'] = $family_id;
            $filter['devotee_name'] = $family_name;
            $filter['contact_number'] = $contact_number;
            $filter['email'] = $email;
           
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->family_model->familyListingCount($searchText,$filter,$this->company_id);
            $data['count'] =  $count;
			$returns = $this->paginationCompress ( "familyListing/", $count, 100 );
            $data['familyRecords'] = $this->family_model->familyListing($searchText,$filter,$this->company_id, $returns["page"], $returns["segment"]);
            $data['subscription_year'] =$this->family_model->getDepriciationYear($this->company_id);
            $data['devoteeInfo'] = $this->devotee_model->getDevoteeInfo($this->company_id);
            $data['committeeInfo'] = $this->committee_model->getAllCommittee($this->company_id);
            $data['relationInfo'] = $this->setting_model->getAllRelationshipInfo($this->company_id);
            $data['subscriptionInfo'] = $this->setting_model->getAllSubscriptionInfo($this->company_id);
            $this->global['pageTitle'] = $this->company_name.' :family Details ';
            $this->loadViews("family/viewFamily", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to add new  Family to the system
     */
    function addFamily()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('family_head_id','Devotee','trim|required|max_length[128]');
            // $this->form_validation->set_rules('subscription_amount','Amount','required');
            
            if($this->form_validation->run() == FALSE)
            {
                redirect('familyListing');
            } else {
                
                // $family_id = $this->security->xss_clean($this->input->post('family_id'));
                $family_head = $this->security->xss_clean($this->input->post('family_head_id'));
                // $subscription_amount = $this->input->post('subscription_amount');
                // $previous_mosque = $this->security->xss_clean($this->input->post('previous_mosque'));
                // $committee_referer = $this->input->post('committee_referer');

                $family_member = $this->input->post('familyMember');
                $relation = $this->input->post('relation');

                $familyInfo = array('devotee_id'=>$family_head,
                            // 'subscription_amt_id'=>$subscription_amount,
                            // 'previous_mosque'=>$previous_mosque,
                            // 'referer_committee_id'=>$committee_referer,
                            'company_id'=>$this->company_id,
                            'created_by'=>$this->employee_id, 
                            'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->family_model->addFamily($familyInfo);

                for($i=0;$i<count($family_member);$i++){
                    log_message('debug','i='.$i.'fm='.$family_member[$i]);
                    log_message('debug','i='.$i.'rl='.$relation[$i]);
                    $familyHeadInfo = array(
                    'family_id'=>$family_head,
                    'relation_id'=>$relation[$i],   
                    'updated_by'=>$this->employee_id, 
                    'updated_date_time'=>date('Y-m-d H:i:s'));
                    $result = $this->family_model->updateFamilyHead($familyHeadInfo,$family_member[$i]);
                }

                if($result > 0){
                    for($i=0;$i<count($family_member);$i++){
                        // log_message('debug','i='.$i.'fm='.$family_member[$i]);
                        // log_message('debug','i='.$i.'rl='.$relation[$i]);
                        $familyHeadInfo = array(
                        'family_id'=>$family_head,
                        'relation_id'=>$relation[$i],   
                        'updated_by'=>$this->employee_id, 
                        'updated_date_time'=>date('Y-m-d H:i:s'));
                        $result = $this->family_model->updateFamilyHead($familyHeadInfo,$family_member[$i]);
                    }
                    if($result){
                        $this->session->set_flashdata('success', 'New family created successfully');
                    }else{
                        $this->session->set_flashdata('error', 'Family info update to devotee failed');
                    }
                } else {
                    $this->session->set_flashdata('error', 'family creation failed');
                }
                redirect('familyListing');
            }
        }
    }

    /**
     * This function is used load family edit form
     */
    function editFamilyPageView($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            if($row_id == null){
                redirect('familyListing');
            }
            $data['familyInfo'] = $this->family_model->getFamilyInfoByEmpId($row_id);
            $data['devoteeInfo'] = $this->devotee_model->getDevoteeInfo($this->company_id);
            $data['committeeInfo'] = $this->committee_model->getAllCommittee($this->company_id);
            $data['familyMemberInfo'] = $this->family_model->getFamilyMembers($data['familyInfo']->family_head_id);
            $data['relationInfo'] = $this->setting_model->getAllRelationshipInfo($this->company_id);
            $data['subscriptionInfo'] = $this->setting_model->getAllSubscriptionInfo($this->company_id);
            // log_message('debug','ffm='.print_r($data['familyMemberInfo'],true));
            $this->global['pageTitle'] = $this->company_name.' : Edit family ';
            $this->loadViews("family/editFamily", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the Family information
     */
    function updateFamily()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {
            // $Family_id = $this->input->post('Family_id');
            $this->load->library('form_validation');
            $row_id = $this->input->post('row_id');
            $this->form_validation->set_rules('family_head_id','Devotee','required');
            // $this->form_validation->set_rules('subscription_amount','Amount','required');
            
            $family_member = $this->input->post('familyMember');
            $relation = $this->input->post('relation');

            if($this->form_validation->run() == FALSE)
            {
                redirect('familyListing');
            } else {
                
                // $family_id = $this->security->xss_clean($this->input->post('family_id'));
                $family_head = $this->security->xss_clean($this->input->post('family_head_id'));
                // $subscription_amount = $this->input->post('subscription_amount');
                // $previous_mosque = $this->security->xss_clean($this->input->post('previous_mosque'));
                // $committee_referer = $this->input->post('committee_referer');
                $familyInfo = array('devotee_id'=>$family_head,
                            // 'subscription_amt_id'=>$subscription_amount,
                            // 'previous_mosque'=>$previous_mosque,
                            // 'referer_committee_id'=>$committee_referer,
                            'company_id'=>$this->company_id,
                            'updated_by'=>$this->employee_id, 
                            'updated_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->family_model->updateFamily($familyInfo,$row_id);
                if($result){
                    $removeFamily =array(
                        'family_id'=>0,
                        'relation_id'=>0, 
                    );
                    $this->family_model->removeFamilyHead($removeFamily,$family_head);
                    for($i=0;$i<count($family_member);$i++){
                        log_message('debug','i='.$i.'fm='.$family_member[$i]);
                        log_message('debug','i='.$i.'rl='.$relation[$i]);
                        $familyHeadInfo = array(
                        'family_id'=>$family_head,
                        'relation_id'=>$relation[$i],   
                        'updated_by'=>$this->employee_id, 
                        'updated_date_time'=>date('Y-m-d H:i:s'));
                        $result = $this->family_model->updateFamilyHead($familyHeadInfo,$family_member[$i]);
                    }
                    if($result){
                        $this->session->set_flashdata('success', 'Family updated successfully');
                    }else{
                        $this->session->set_flashdata('error', 'Family info update to devotee failed');
                    }
                } else {
                    $this->session->set_flashdata('error', 'family update failed');
                }
                redirect('editFamilyPageView/'.$row_id);
            }
        }
    }


    /**
     * This function is used to check whether Family id already exist or not
     */
    public function checkFamilyIDExists()
    {
        $family_id = $this->input->post("family_id");
        $row_id = $this->input->post("row_id");
        if (empty($row_id)) {
            $result = $this->family_model->checkFamilyIDExists($family_id);
        } else {
            $result = $this->family_model->checkFamilyIDExists($family_id, $row_id);
        }
        if (empty($result)) {echo ("true");} else {echo ("false");}
    }
  
  /**
     * This function is used to delete the family using family_id
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteFamily()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $family_id = $this->input->post('family_id');
            
            $family_head = $this->family_model->getFamilyHeadId($family_id);
            $removeFamily =array(
                'family_id'=>0,
                'relation_id'=>0, 
            );
            $this->family_model->removeFamilyHead($removeFamily,$family_head);

            $familyInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->family_model->deleteFamily($family_id,$familyInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }

    
    
}


?>