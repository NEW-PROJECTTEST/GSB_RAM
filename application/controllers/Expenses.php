<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Expenses extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('expenses_model');
        $this->load->model('bank_model');
        $this->load->model('cash_account_model');
        $this->load->model('setting_model');
        $this->load->model('committee_model');
        $this->load->model('Event_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the devotee
     */
    
    /**
     * This function is used to load the  devotee list
     */
    function expenseListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      
            // $devotee_id = $this->security->xss_clean($this->input->post('devotee_id'));  
            $account_type = $this->security->xss_clean($this->input->post('account_type'));
            $expense_type = $this->security->xss_clean($this->input->post('expense_type'));
            $event_type = $this->security->xss_clean($this->input->post('event_type'));
            // $data['devotee_id'] = $devotee_id;
            $data['account_type'] = $account_type;
            $data['expense_type'] = $expense_type;
            $data['event_type'] = $event_type;
            // $filter['devotee_id'] = $devotee_id;
            $filter['account_type'] = $account_type;
            $filter['expense_type'] = $expense_type;
            $filter['event_type'] = $event_type;
           
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->expenses_model->expensesListingCount($searchText,$filter,$this->company_id);
            $data['count'] =  $count;
			$returns = $this->paginationCompress ( "expenseListing/", $count, 100 );
            $data['partyInfo'] =$this->expenses_model->getPartyInfo($this->company_id);
            $data['bank'] = $this->bank_model->getAllBank($this->company_id);
            $data['cashAccount'] = $this->cash_account_model->getAllCashAccounts($this->company_id);
            $data['expenseNameInfo'] = $this->setting_model->getAllExpenseNameInfo($this->company_id);
            $data['committeeInfo'] = $this->setting_model->getAllCommittetypeInfo($this->company_id);
            $data['eventInfo'] =$this->Event_model->getEventInfo($this->company_id); 
            $data['expensesRecords'] = $this->expenses_model->expensesListing($searchText,$filter,$this->company_id, $returns["page"], $returns["segment"]);
            $data['expenses_model'] = $this->expenses_model;
            $this->global['pageTitle'] = $this->company_name.' :expense Details ';
            $this->loadViews("expenses/expenses", $this->global, $data, NULL);
        }
    }


    /**
     * This function is used to add new  devotee to the system
     */
    function addExpenses()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else {
                // $devotee_id = $this->security->xss_clean($this->input->post('devotee_id'));
                $account_type = $this->security->xss_clean($this->input->post('account_type'));
                $expense_amount = $this->input->post('expense_amount');
                $invoice_no = $this->input->post('invoice_no');
                $expense_type = $this->input->post('expense_type');
                $comments = $this->input->post('comments');
                $party_id = $this->input->post('party');
                $bank_row_id = $this->input->post('bank_row_id');
                $cash_row_id = $this->input->post('cash_row_id');
                $type_of_expense = $this->input->post('type_of_expense');
                $committee_name = $this->input->post('committee_name');
                $event_type = $this->input->post('event_type');
                $year = $this->input->post('year');
                $documentName = $this->security->xss_clean($this->input->post('documentName'));


                if(!empty($committee_name)){
                $committee_info = $this->committee_model->getCommitteeTypeById($committee_name);
                $com_name = $committee_info->type;
                }else{
                    $com_name = '';
                }


                    $expensesInfo = array('account_type'=>$account_type,'year' =>date('Y',strtotime($year)),'event_type'=>$event_type,'committee_name'=>$com_name,'type_of_expense'=>$type_of_expense,'committee_id'=> $committee_name,'amount'=>$expense_amount,'invoice_no'=>$invoice_no,'comments'=>$comments,'party_id'=>$party_id,
                    'expense_type'=>$expense_type,'cash_row_id'=>$cash_row_id,'bank_row_id'=>$bank_row_id,'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'),'expense_date'=>date('Y-m-d',strtotime($year)));
                         
                $result = $this->expenses_model->addExpenses($expensesInfo);

                $uploadPath = 'upload/attachment/'.$result.'/';
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
    
                $config=['upload_path' => $uploadPath,
                'allowed_types' => 'jpg|png|jpeg|pdf','max_size' => '2024','overwrite' => TRUE, ];
                $this->load->library('upload', $config);
                $files = $_FILES;
                $ImgCount = count($_FILES['userfile']['name']);
                for($i = 0; $i < $ImgCount; $i++){
                    if(!empty($_FILES['userfile']['name'][$i])){
                        $config['file_name'] = $documentName[$i]; 
                        $_FILES['file']['name']       = $files['userfile']['name'][$i];
                        $_FILES['file']['type']       = $files['userfile']['type'][$i];
                        $_FILES['file']['tmp_name']   = $files['userfile']['tmp_name'][$i];
                        $_FILES['file']['error']      = $files['userfile']['error'][$i];
                        $_FILES['file']['size']       = $files['userfile']['size'][$i];
                        if($_FILES['file']['size'] >  505000) {
                            $this->session->set_flashdata('error', 'File size should be less than 500KB');
                            redirect('expenseListing');  
                        } else{
                            $this->upload->initialize($config);
                            if($this->upload->do_upload('file')){
                                $imageData = $this->upload->data();
                                $uploadImgData[$i] = $uploadPath.$imageData['file_name'];
                            }
                        }
                    }
                }

                for($j=0;$j<count($documentName);$j++){
                    if(!empty($uploadImgData[$j])){
                        $certificateInfo = array(
                            'doc_name' => $documentName[$j],
                            'doc_path'=> $uploadImgData[$j], 
                            'expense_row_id' => $result,
                            'created_by' => $this->employee_id, 
                            'created_date_time' => date('Y-m-d H:i:s'));

                            $this->expenses_model->addDocument($certificateInfo);

                        // $isExist = $this->student_model->checkDocumentInfoExists($this->student_row_id,$documentName[$j]);
                        // if($isExist > 0){
                        //     $certificateInfo['updated_by'] = $this->student_row_id;
                        //     $certificateInfo['updated_date_time'] = date('Y-m-d H:i:s');
                        //     $result = $this->student_model->updateDocument($this->student_row_id,$certificateInfo,$documentName[$j]); 
                        // }else{
                        //     $result = $this->student_model->addDocument($certificateInfo);
                        // }
                    }
                }

                if($result > 0){
                    $this->session->set_flashdata('success', 'New Expenses created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Expenses creation failed');
                }
                redirect('expenseListing');
            
        }
    }

    /**
     * This function is used load devotee edit form
     */
    function editExpensePageView($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            if($row_id == null){
                redirect('expenseListing');
            }
            $data['expenseInfo'] = $this->expenses_model->getExpenseInfoById($row_id);
            $data['partyInfo'] =$this->expenses_model->getPartyInfo($this->company_id);
            $data['bank'] = $this->bank_model->getAllBank($this->company_id);
            $data['cashAccount'] = $this->cash_account_model->getAllCashAccounts($this->company_id);
            $data['expenseNameInfo'] = $this->setting_model->getAllExpenseNameInfo($this->company_id);
            $data['committeeInfo'] = $this->setting_model->getAllCommittetypeInfo($this->company_id);
            $data['eventInfo'] =$this->Event_model->getEventInfo($this->company_id); 
            $this->global['pageTitle'] = $this->company_name.' : Edit expenses ';
            $this->loadViews("expenses/editExpenses", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the devotee information
     */
    function updateExpense()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {
            // $devotee_id = $this->input->post('devotee_id');
            $row_id = $this->input->post('row_id');
            $account_type = $this->security->xss_clean($this->input->post('account_type'));
            $expense_amount = $this->input->post('expense_amount');
            $invoice_no = $this->input->post('invoice_no');
            $expense_type = $this->input->post('expense_type');
            $party_id = $this->input->post('party');
            $comments = $this->input->post('comments');
            $bank_row_id = $this->input->post('bank_row_id');
            $cash_row_id = $this->input->post('cash_row_id');
            $type_of_expense = $this->input->post('type_of_expense');
            $committee_name = $this->input->post('committee_name');
            $event_type = $this->input->post('event_type');
            $year = $this->input->post('year');

            if(!empty($committee_name)){
                $committee_info = $this->committee_model->getCommitteeTypeById($committee_name);
                $com_name = $committee_info->type;
                }else{
                    $com_name = '';
                }

                $expensesInfo = array('account_type'=>$account_type,'year'=>date('Y',strtotime($year)),'event_type'=>$event_type,'committee_name'=>$com_name,'type_of_expense'=>$type_of_expense,'committee_id'=> $committee_name,'amount'=>$expense_amount,'invoice_no'=>$invoice_no,'comments'=>$comments,'party_id'=>$party_id,
                'expense_type'=>$expense_type,'cash_row_id'=>$cash_row_id,'bank_row_id'=>$bank_row_id,'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'),'expense_date'=>date('Y-m-d',strtotime($year)));
                    
                $result = $this->expenses_model->updateExpense($expensesInfo,$row_id);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Expense updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'expense update failed');
                }
                redirect('editExpensePageView/'.$row_id);
            
        }
    }


    
   
  
  /**
     * This function is used to delete the devotee using devotee_id
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteExpense()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $expense_id = $this->input->post('expense_id');
            $expensesInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->expenses_model->deleteExpense($expense_id,$expensesInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }

    
    
}


?>