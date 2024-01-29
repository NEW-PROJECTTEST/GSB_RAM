<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Income extends BaseController {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('income_model','income');
        $this->load->model('setting_model','setting');
        $this->load->model('committee_model','committee');
        $this->load->model('devotee_model','devotee');
        $this->isLoggedIn();
    }
    
    public function addIncomeInfo() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $income_name =$this->security->xss_clean($this->input->post('income_name'));
            $income_type = $this->security->xss_clean($this->input->post('income_type'));
            $income_by = $this->security->xss_clean($this->input->post('income_by'));
            $income_date = $this->security->xss_clean($this->input->post('income_date'));
            $amount = $this->security->xss_clean($this->input->post('amount'));
            $comment = $this->security->xss_clean($this->input->post('comment'));
            $committee_rowid = $this->security->xss_clean($this->input->post('committee_rowid'));
            $devotee_rowid = $this->security->xss_clean($this->input->post('devotee_rowid'));
            $incomeDate =date('y-m-d',strtotime($income_date));

            $incomeInfo = array(
                        'income_name'=>$income_name,
                        'income_type_id'=>$income_type,
                        'income_by'=>$income_by,
                        'income_date'=>$incomeDate,
                        'amount'=>$amount,
                        'comment'=>$comment,
                        'committee_id'=>$committee_rowid,
                        'devoote_id'=>$devotee_rowid,
                        'company_id'=>$this->company_id,
                        'created_by'=>$this->employee_id,
                        'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->income->addIncome($incomeInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'Income Added successfully');
                } else{
                    $this->session->set_flashdata('error', 'Income failed');
                }
            redirect('incomeListing');
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

    function incomeListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      
            $data['committeInfo'] = $this->committee->committeeListing($this->company_id);
            $data['devoteeInfo'] = $this->devotee->devoteeInfo($this->company_id);
            $data['income_type'] =$this->setting->getIncomeType($this->company_id);
            $this->global['pageTitle'] = $this->company_name.' :Subscription Details ';
            $this->loadViews("income/viewIncome", $this->global, $data, NULL);
        }
    }

    function getIncomeInfo()
    {
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $data_array_new = [];
        $data_array = $this->income->incomeListing($this->company_id);
        $income_by='';
       
        foreach($data_array as $r) {
            // if($this->role == ROLE_ADMIN ) {
                if($r->income_date=='1970-01-01'){$income_date='';} else { $income_date =date('d-m-Y',strtotime($r->income_date));}
            if(!empty($r->committee_name)) {
                $income_by =  $r->committee_name;
            }

            if(!empty($r->devotee_name)) {


                $income_by = $r->devotee_name;
            }

            if($r->income_by== 'Other')
            {
                $income_by = $r->income_by;

            }
            
            $editButton = '<a class="btn  btn-sm btn-info" href="'.site_url('editIncomePageView/'.$r->row_id).'"title="Edit"><i class="fas fa-edit"></i></i></a>';
            $deleteButton = '<a class="btn btn-sm btn-danger deleteIncome" data-row_id='.$r->row_id.' href="#" title="Delete"><i class="fas fa-trash"></i></a>';
            // }else{
            //     $editButton='';
            //     $deleteButton='' ;
            // }
            

            $data_array_new[] = array(
                $r->income_name,
                $r->income_type,
                $income_by,
                $income_date,    
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

    public function deleteIncome()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $incomeInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->income->deleteSubscription($row_id,$incomeInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }

    function editIncomePageView($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            if($row_id == null){
                redirect('incomeListing');
            }
            $data['committeInfo'] = $this->committee->committeeListing($this->company_id);
            $data['devoteeInfo'] = $this->devotee->devoteeInfo($this->company_id);
            $data['income_type'] =$this->setting->getIncomeType($this->company_id);
            $data['incomeInfo'] = $this->income->getIncomeInfoById($row_id,$this->company_id);          
            $this->global['pageTitle'] = $this->company_name.' : Edit Income ';
            $this->loadViews("income/editIncome", $this->global, $data, NULL);
        }
    }

    public function updateIncome() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $row_id =$this->security->xss_clean($this->input->post('row_id'));
            $income_name =$this->security->xss_clean($this->input->post('income_name'));
            $income_type = $this->security->xss_clean($this->input->post('income_type'));
            $income_by = $this->security->xss_clean($this->input->post('income_by'));
            $income_date = $this->security->xss_clean($this->input->post('income_date'));
            $amount = $this->security->xss_clean($this->input->post('amount'));
            $comment = $this->security->xss_clean($this->input->post('comment'));
            $committee_rowid = $this->security->xss_clean($this->input->post('committee_rowid'));
            $devotee_rowid = $this->security->xss_clean($this->input->post('devotee_rowid'));
            log_message('debug','commiid='.$committee_rowid);
            log_message('debug','devoteeiid='.$devotee_rowid);
            $incomeDate =date('y-m-d',strtotime($income_date));
            log_message('debug','roww_idd='.$row_id);

            // if(!empty($committee_rowid))
            // {
            //     $devoteeArray =array('devoote_id' => 0);
            //     $this->income->updateDevoteeId($devoteeArray,$row_id);
            // }
            
            // if(!empty($devotee_rowid))
            // {
            //     $committeeArray =array('committee_id' => 0);
            //     $this->income->updateCommitteeId($committeeArray,$row_id);
            // }
            
            
            $incomeInfo = array(
                'income_name'=>$income_name,
                'income_type_id'=>$income_type,
                'income_by'=>$income_by,
                'income_date'=>$incomeDate,
                'amount'=>$amount,
                'comment'=>$comment,
                'committee_id'=>$committee_rowid,
                'devoote_id'=>$devotee_rowid,
                'company_id'=>$this->company_id,
                'created_by'=>$this->employee_id,
                'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->income->updateIncome($incomeInfo,$row_id);
                if($result){
                    $this->session->set_flashdata('success', 'Income Updated successfully');
                } else{
                    $this->session->set_flashdata('error', 'Income update failed');
                }
            redirect('editIncomePageView/'.$row_id);
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