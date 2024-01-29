<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Subscription extends BaseController {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('subscription_model','subscription');
        $this->load->model('family_model','family');
        $this->isLoggedIn();
    }
    
    public function addSubscription() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $family_id =$this->security->xss_clean($this->input->post('family_id'));
            $amount = $this->security->xss_clean($this->input->post('subscription_amount'));
            $month = $this->security->xss_clean($this->input->post('subscription_month'));
            $year = $this->security->xss_clean($this->input->post('subscription_year'));
            
            $subInfo = array(
                        'family_id'=>$family_id,
                        'amount'=>$amount,
                        'month'=>$month,
                        'year'=>$year,
                        'company_id'=>$this->company_id,
                        'created_by'=>$this->employee_id,
                        'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->subscription->addSubscription($subInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'Subscription Added successfully');
                } else{
                    $this->session->set_flashdata('error', 'Subsciprion failed');
                }
            redirect('familyListing');
        }
    }

    function addSubscriptionByFamilyID(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $family_id =$this->security->xss_clean($this->input->post('family_id'));
            $amount = $this->security->xss_clean($this->input->post('subscription_amount'));
            $month = $this->security->xss_clean($this->input->post('subscription_month'));
            $year = $this->security->xss_clean($this->input->post('subscription_year'));
            
            $subInfo = array(
                        'family_id'=>$family_id,
                        'amount'=>$amount,
                        'month'=>$month,
                        'year'=>$year,
                        'company_id'=>$this->company_id,
                        'created_by'=>$this->employee_id,
                        'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->subscription->addSubscription($subInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'Subscription Added successfully');
                } else{
                    $this->session->set_flashdata('error', 'Subsciprion failed');
                }
            redirect('subscriptionListing');
        }
    }

    function subscriptionListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      
            $data['familyInfo'] = $this->family->getFamilyInfo($this->company_id);
            $data['subscription_year'] =$this->subscription->getDepriciationYear($this->company_id);
            $this->global['pageTitle'] = $this->company_name.' :Subscription Details ';
            $this->loadViews("subscription/viewSubscription", $this->global, $data, NULL);
        }
    }

    function getSubscriptionInfo()
    {
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $data_array_new = [];
        $data_array = $this->subscription->subscriptionListing($this->company_id);
       
        foreach($data_array as $r) {
            // if($this->role == ROLE_ADMIN ) {
             $editButton = '<a class="btn  btn-sm btn-info"  href="#" onclick="openModel('.$r->row_id.','.$r->amount.','.$r->year_id.',\''.$r->month.'\')" title="Edit"><i class="fas fa-edit"></i></i></a>';
             $deleteButton = '<a class="btn btn-sm btn-danger deleteSubscription" data-row_id='.$r->row_id.' href="#" title="Delete"><i class="fas fa-trash"></i></a>';
            // }else{
            //     $editButton='';
            //     $deleteButton='' ;
            // }
            $data_array_new[] = array(
                $r->devotee_name,
                $r->month,
                $r->year,    
                $r->amount,
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

    public function deleteSubscription()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $subscriptionInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->subscription->deleteSubscription($row_id,$subscriptionInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }

    public function updateSubscription() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $row_id =$this->security->xss_clean($this->input->post('row_id'));
            $amount = $this->security->xss_clean($this->input->post('subscription_amount'));
            $month = $this->security->xss_clean($this->input->post('subscription_month'));
            $year = $this->security->xss_clean($this->input->post('subscription_year'));
            
            $subInfo = array(
                        'amount'=>$amount,
                        'month'=>$month,
                        'year'=>$year,
                        'updated_by'=>$this->employee_id,
                        'updated_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->subscription->UpdateSubscription($subInfo,$row_id);
                if($result){
                    $this->session->set_flashdata('success', 'Subscription Updated successfully');
                } else{
                    $this->session->set_flashdata('error', 'Subscription update failed');
                }
            redirect('subscriptionListing');
        }
    }

    function getSubscriptionAmtByFamId(){
        if ($this->isAdmin() == true ) {
            $this->loadThis();
        } else {
            $fam_id = $this->input->post('family_id');
            $data['sub_amt'] = $this->family->getSubscriptionAmtByFamId($fam_id);
            header('Content-type: text/plain');
            header('Content-type: application/json'); 
            echo json_encode($data);
            exit(0);
        }
    }
}