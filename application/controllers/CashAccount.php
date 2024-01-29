<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class CashAccount  extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cash_book_model');
        $this->load->model('cash_account_model');
        $this->load->model('bank_model');
        $this->load->library('excel');
        $this->isLoggedIn();   
    }
  
    /**
     * This function is used to load the CashAccount list
     */
    function cashAccountListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {  
            $data['cashAccount'] = $this->cash_account_model->getAllCashAccounts($this->company_id);    
            $cash_account_name = $this->security->xss_clean($this->input->post('cash_account_name'));  
            $cash_account_type = $this->security->xss_clean($this->input->post('cash_account_type'));
            $account_balance = $this->security->xss_clean($this->input->post('account_balance'));
            $data['cash_account_name'] = $cash_account_name;
            $data['cash_account_type'] = $cash_account_type;
            $data['account_balance'] = $account_balance;
            $filter['cash_account_name'] = $cash_account_name;
            $filter['cash_account_type'] = $cash_account_type;
            $filter['account_balance'] = $account_balance;
            $data['bank'] = $this->bank_model->getAllBank($this->company_id);
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->cash_account_model->cashAccountListingCount($searchText,$filter,$this->company_id);
            $data['count'] =  $count;
			$returns = $this->paginationCompress ("cashAccountListing/", $count, 100 );
            $data['cashAccountRecords'] = $this->cash_account_model->cashAccountListing($searchText,$filter,$this->company_id, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = $this->company_name.' :Cash Account Details ';
            $this->loadViews("cash_account/cashAccount", $this->global, $data, NULL);
        }
    }


    /**
     * This function is used to add new CashAccount to the system
     */
    function addCashAccount()
    {
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {
                $cash_account_type = $this->security->xss_clean($this->input->post('cash_account_type'));
                $cash_account_name = ucwords(strtolower($this->security->xss_clean($this->input->post('cash_account_name'))));
                $cashAccountInfo = array('cash_account_type'=>$cash_account_type, 'cash_account_name'=>$cash_account_name, 
                'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->cash_account_model->addCashAccount($cashAccountInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Cash Account created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Cash Account creation failed');
                }
                redirect('cashAccountListing');
            
        }
    }

    /**
     * This function is used load CashAccount edit information
     */
    function editCashAccountPageView($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            if($row_id == null){
                redirect('cashAccountListing');
            }
            $data['cashAccountInfo'] = $this->cash_account_model->getCashAccountInfoById($row_id);
            $this->global['pageTitle'] = $this->company_name.' : Edit Cash Account ';
            $this->loadViews("cash_account/editCashAccount", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to edit the CashAccount information
     */
    function updateCashAccount()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else { 
            $row_id = $this->input->post('row_id');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('cash_account_type','Account Type','trim|required');
            $this->form_validation->set_rules('cash_account_name','Account Name','required');
            if($this->form_validation->run() == FALSE)
            {
                $this->editCashAccountPageView($row_id);
            }else {
                $cash_account_type = $this->security->xss_clean($this->input->post('cash_account_type'));
                $cash_account_name = ucwords(strtolower($this->security->xss_clean($this->input->post('cash_account_name'))));
                $cashAccountInfo = array('cash_account_type'=>$cash_account_type, 'cash_account_name'=>$cash_account_name, 
               'company_id'=>$this->company_id,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->cash_account_model->updateCashAccount($cashAccountInfo,$row_id);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Cash Account updated successfully');
                }
                else{
                    $this->session->set_flashdata('error', 'Cash Account update failed');
                }
                redirect('editCashAccountPageView/'.$row_id);
            }
        }
    }

/**
     * This function is used to delete the CashAccount using row_id
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteCashAccount()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $cashAccountInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->cash_account_model->deleteCashAccount($row_id,$cashAccountInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }

    /**
     * This function is used to delete the Cash Details
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteCashDetails()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
       //update account balance
        $data['cashDetailsInfo'] = $this->cash_account_model->getCashDetailsById($row_id);
       
        $data['cashAccountInfo'] = $this->cash_account_model->getCashAccountInfoById($data['cashDetailsInfo']->cash_account_rowid);
       
        $cash_balance = $data['cashAccountInfo']->account_balance - $data['cashDetailsInfo']->cash_amount;

        $cashAccountInfo = array('account_balance'=>$cash_balance,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
        $cash_account_result = $this->cash_account_model->updateCashAccount($cashAccountInfo,$data['cashDetailsInfo']->cash_account_rowid);
            //delete cash details
            $cashInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->cash_account_model->deleteCashDetails($row_id,$cashInfo);
            $cashBookInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result2 = $this->cash_book_model->deletecashDetailsBook($row_id,$cashBookInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }

    
    /**
     * View CashAccount details based on row_id
     *
     */
    public function viewCashAccount($row_id = null)
    {
        if ($this->isAdmin() == true ) {
            $this->loadThis();
        } else {
            if ($row_id == null) {
                redirect('CashAccountListing');
            }
            $data['cashAccountInfo'] = $this->cash_account_model->getCashAccountInfoById($row_id);
            $data['cashRecords'] = $this->cash_account_model->getCashDetails($row_id);
            $this->global['pageTitle'] = $this->company_name.': View Cash Account';
            $this->loadViews("cash_account/viewCashAccount", $this->global, $data, null);
        }
    } 

    /**
     * This function is used to add new Cash Details to the system
     */
    function addCashDetails()
    {
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {
                $cash_date = $this->security->xss_clean($this->input->post('cash_date'));
                $cash_amount = $this->security->xss_clean($this->input->post('cash_amount'));
                $bank_rowid = $this->security->xss_clean($this->input->post('bank_rowid'));
                $comments = $this->security->xss_clean($this->input->post('comments'));
                $cash_account_rowid =$this->security->xss_clean($this->input->post('cash_account_rowid'));
                $data['cashAccountInfo'] = $this->cash_account_model->getCashAccountInfoById($cash_account_rowid);
             

                $cashInfo = array('cash_date'=>date('y-m-d',strtotime($cash_date)), 'cash_amount'=>$cash_amount, 'bank_rowid'=>$bank_rowid, 'comments'=>$comments, 
                'cash_account_rowid'=>$cash_account_rowid, 'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->cash_account_model->addCashDetails($cashInfo);
                if($result > 0){

                    //START adding bank transaction to table
                        $acc_type = $this->bank_model->getBankInfoById($bank_rowid);
                        $acc_name = $this->cash_account_model->getCashAccountInfoById($cash_account_rowid);
                        if($acc_type->account_type=='O/D Account'){
                            $transInfo = array(
                                'trans_date'=>date('Y-m-d',strtotime($cash_date)),
                                'bank_name'=>$acc_type->bank_name,
                                'trans_type'=>'CREDIT',
                                'amount'=>$cash_amount,
                                // 'particular'=>'Add Cash to Cash Account - '.$acc_name->cash_account_name,
                                'particular' => $comments,
                                'is_required' => 1,
                                'created_by'=>$this->employee_id, 
                                'created_date_time'=>date('Y-m-d H:i:s'));
                        }else{
                            $transInfo = array(
                                'trans_date'=>date('Y-m-d',strtotime($cash_date)),
                                'bank_name'=>$acc_type->bank_name,
                                'trans_type'=>'DEBIT',
                                'amount'=>$cash_amount,
                                // 'particular'=>'Add Cash to Cash Account - '.$acc_name->cash_account_name,
                                'particular' => $comments,
                                'is_required' => 1,
                                'created_by'=>$this->employee_id, 
                                'created_date_time'=>date('Y-m-d H:i:s'));
                        }
                        $result = $this->bank_model->addBankTransaction($transInfo);
                    //END adding bank transaction to table
                

                     $account_balance_result =  $data['cashAccountInfo']->account_balance + $cash_amount;
                   //  log_message('debug','cash Account:'.$data['cashAccountInfo']->account_balance);
                     $cashAccountInfo = array('account_balance'=>$account_balance_result,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                     $cash_account_result = $this->cash_account_model->updateCashAccount($cashAccountInfo,$cash_account_rowid);
                     $cashInfo = array('debit'=>$cash_amount,
                     'cash_account_rowid'=>$cash_account_rowid,
                     'cash_date'=>date('Y-m-d',strtotime($cash_date)),
                     'transaction_type'=>'Bank', 
                     'cash_details_rowid'=>$result, 
                     'company_id'=>$this->company_id,
                     'bank_account_row_id' => $bank_rowid,
                     'comments' => $comments,
                     'created_by'=>$this->employee_id, 
                     'created_date_time'=>date('Y-m-d H:i:s'));
                     $cash_expense_result = $this->cash_book_model->addCashExpenses($cashInfo);
                    $this->session->set_flashdata('success', 'New Cash Details added successfully');
                } else {
                    $this->session->set_flashdata('error', 'Cash Details add failed');
                }
                redirect('cashAccountListing');
            
        }
    }

 /**
     * This function is used to load the transfer cash
     */
    function cashTransferPageView()
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $data['cashAccount'] = $this->cash_account_model->getAllCashAccounts($this->company_id);    
            $data['cashRecords'] = $this->cash_account_model->getCashTransferDetails();
            $this->global['pageTitle'] = $this->company_name.' : Cash Transfer ';
            $this->loadViews("cash_account/cashTransfer", $this->global,  $data, NULL);
        }
    }
        /**
     * This function is used to add new Cash Details to the system
     */
    function transferCashDetails()
    {
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } 
        else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('transfer_cash_amount','Amount','trim|required');
            $this->form_validation->set_rules('from_cash_account_rowid','From Account','required');
            $this->form_validation->set_rules('to_cash_account_rowid','To Account','required');
            if($this->form_validation->run() == FALSE) {
                $this->cashTransferPageView();
            } else {
                $transfer_cash_date = $this->security->xss_clean($this->input->post('transfer_cash_date'));
                $transfer_cash_amount = $this->security->xss_clean($this->input->post('transfer_cash_amount'));
                $from_cash_account_rowid = $this->security->xss_clean($this->input->post('from_cash_account_rowid'));
                $to_cash_account_rowid = $this->security->xss_clean($this->input->post('to_cash_account_rowid'));
                $comments = $this->security->xss_clean($this->input->post('comments'));

                
                if($from_cash_account_rowid == $to_cash_account_rowid)
                {
                    $this->session->set_flashdata('error', 'Select Different Cash Account');
                redirect('cashTransferPageView');
                } else {
                $data['fromCashAccountInfo'] = $this->cash_account_model->getCashAccountInfoById($from_cash_account_rowid);
                $data['toCashAccountInfo'] = $this->cash_account_model->getCashAccountInfoById($to_cash_account_rowid);
             
                $transferCashInfo = array('transfer_cash_date'=>date('y-m-d',strtotime($transfer_cash_date)),
                 'transfer_cash_amount'=>$transfer_cash_amount, 
                'from_cash_account_rowid'=>$from_cash_account_rowid,
                'comments'=>$comments, 
                'to_cash_account_rowid'=>$to_cash_account_rowid, 'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->cash_account_model->transferCashDetails($transferCashInfo);

                if($result > 0){
                     $from_account_balance =   $data['fromCashAccountInfo']->account_balance -  $transfer_cash_amount;
                     $cashAccountInfo = array('account_balance'=>$from_account_balance,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                     $cash_account_result1 = $this->cash_account_model->updateCashAccount($cashAccountInfo,$from_cash_account_rowid);
                    
                     $to_account_balance =   $data['toCashAccountInfo']->account_balance +  $transfer_cash_amount;
                     $cashAccountInfo = array('account_balance'=>$to_account_balance,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                     $cash_account_result2 = $this->cash_account_model->updateCashAccount($cashAccountInfo,$to_cash_account_rowid);
                     

                     $cashInfo = array('cash_date'=>date('y-m-d',strtotime($transfer_cash_date)), 
                     'cash_amount' => $transfer_cash_amount, 
                     'cash_transfer_row_id' => $result, 
                     'comments'=>$comments, 
                     'cash_account_rowid'=>$to_cash_account_rowid, 
                     'company_id'=>$this->company_id,
                     'created_by'=>$this->employee_id, 
                     'created_date_time'=>date('Y-m-d H:i:s'));
                     $result_info = $this->cash_account_model->addCashDetails($cashInfo);

                     if($result_info > 0){
                     $cashInfo = array('debit'=>$transfer_cash_amount,
                        'comments'=>$comments, 
                        'cash_transfer_rowid'=>$result,
                        'cash_account_rowid'=>$to_cash_account_rowid,
                        'cash_date'=>date('Y-m-d',strtotime($transfer_cash_date)),
                        'transaction_type'=>'Cash',  
                        'company_id'=>$this->company_id,
                        'created_by'=>$this->employee_id, 
                        'created_date_time'=>date('Y-m-d H:i:s'));
                     $cash_expense_result = $this->cash_book_model->addCashExpenses($cashInfo);

                     $cashInfo = array('credit'=>$transfer_cash_amount,
                     'comments'=>$comments, 
                     'cash_transfer_rowid'=>$result,
                     'cash_account_rowid'=>$from_cash_account_rowid,
                     'cash_date'=>date('Y-m-d',strtotime($transfer_cash_date)),
                     'transaction_type'=>'Cash',  
                     'company_id'=>$this->company_id,
                     'created_by'=>$this->employee_id, 
                     'created_date_time'=>date('Y-m-d H:i:s'));
                    $cash_expense_result = $this->cash_book_model->addCashExpenses($cashInfo);
                    $this->session->set_flashdata('success', 'Cash Transferred successfully');
                     }
                } else {
                    $this->session->set_flashdata('error', 'Cash Transfer  failed');
                }
                redirect('cashAccountListing');
            }
          }
        }
    }

         /**
     * This function is used to delete the Transfer Details
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteTransferDetails()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
        $row_id = $this->security->xss_clean($this->input->post('row_id'));
        //get cash transfer details
        $data['cashTransferInfo'] = $this->cash_account_model->getCashTransferInfoByID($row_id);
     
       //update account balance
       $data['fromCashAccountInfo'] = $this->cash_account_model->getCashAccountInfoById($data['cashTransferInfo']->from_cash_account_rowid);
       $data['toCashAccountInfo'] = $this->cash_account_model->getCashAccountInfoById($data['cashTransferInfo']->to_cash_account_rowid);
       $from_account_balance =   $data['fromCashAccountInfo']->account_balance +  $data['cashTransferInfo']->transfer_cash_amount;
      
       $cashAccountInfo = array('account_balance'=>$from_account_balance,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
       $cash_account_result1 = $this->cash_account_model->updateCashAccount($cashAccountInfo,$data['cashTransferInfo']->from_cash_account_rowid);
      
       $to_account_balance =   $data['toCashAccountInfo']->account_balance -  $data['cashTransferInfo']->transfer_cash_amount;
       $cashAccountInfo = array('account_balance'=>$to_account_balance,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
       $cash_account_result2 = $this->cash_account_model->updateCashAccount($cashAccountInfo,$data['cashTransferInfo']->to_cash_account_rowid);

       //delete cash transfer details
       $cashTransferInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
       $result = $this->cash_account_model->deleteTransferDetails($row_id,$cashTransferInfo);
      
       //delete cash book transfer details
       $cashBookInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
       $result2 = $this->cash_book_model->deleteCashTransferBook($row_id,$cashBookInfo);

       $cashInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
       $this->cash_account_model->deleteCashDetailsTransferInfo($row_id,$cashInfo);

       if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
           
           
        }
    }

// Cash Account  Report
function downloadCashAccountReport(){
//print page setup
 $this->excel->setActiveSheetIndex(0);
 $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToPage(true);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);    
 $fromDate = $this->input->post('from_date');
 $toDate = $this->input->post('to_date');
 $cash_account_rowid = $this->input->post('cash_account_rowid');

 $cashDetailsInfo = $this->cash_account_model->getCashAccountReport($fromDate,$toDate,$cash_account_rowid);

 $styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
 $this->excel->setActiveSheetIndex(0);
 //name the worksheet
 $this->excel->getActiveSheet()->setTitle('SJPUC worksheet');
 //set Title content with some text
 $headerStyle = array(
     'font'  => array(
         'bold' => true,
         'color' => array('rgb' => '17202A'),
         'size'  => 20,
         'name' => 'Verdana'
     ));
     $OutlineStyle = array(
         'borders' => array(
           'outline' => array(
             'style' => PHPExcel_Style_Border::BORDER_THIN
           )
         )
       );
           
         $this->excel->getActiveSheet()->mergeCells('A1:F1');
         $this->excel->getActiveSheet()->setCellValue('A1', "KARAVALI TRANSPORT ");
         $this->excel->getActiveSheet()->mergeCells('A2:F2');
         $this->excel->getActiveSheet()->setCellValue('A2', "CASH ACCOUNT REPORT");
         $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
         $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
         $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->getStyle('A1:F2')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->getStyle('A3:F3')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->mergeCells('A3:F3');
            $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
           $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->setCellValue('A3', "Date From : ".$fromDate. " To : " .$toDate);
         //   //font bold and text bold
           $this->excel->getActiveSheet()->getStyle('A4:F4')->getFont()->setBold(true);
          //horizontal and vertical alignment
       $this->excel->getActiveSheet()->getStyle('A4:F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $this->excel->getActiveSheet()->getStyle('A4:F4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
           //set width for cell
           $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(35);
           $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
           $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
           $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
           $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
           $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
         //   //report Header
           $this->cellColor('A4:F4', 'D5DBDB');
           $this->excel->getActiveSheet()->getStyle('A4')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->getStyle('A4:F4')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->setCellValue('A4', "Cash Account Name");
         $this->excel->getActiveSheet()->setCellValue('B4', "Account Type");
         $this->excel->getActiveSheet()->setCellValue('C4', "Date");
         $this->excel->getActiveSheet()->setCellValue('D4', "Amount");
         $this->excel->getActiveSheet()->setCellValue('E4', "Bank");
         $this->excel->getActiveSheet()->setCellValue('F4', "Description");
         $excel_row = 5;
      
         if(!empty($cashDetailsInfo))
         {
          foreach($cashDetailsInfo as $record)
           {
             //set row height for cell
                 //horizontal and vertical alignment
       
             $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
             $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
             $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, $record->cash_account_name);
             $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->cash_account_type);
             $this->excel->getActiveSheet()->setCellValue('C'.$excel_row, date('d-m-Y',strtotime($record->cash_date)));
             $this->excel->getActiveSheet()->setCellValue('D'.$excel_row, $record->cash_amount);
             $this->excel->getActiveSheet()->setCellValue('E'.$excel_row, $record->bank_name);
             $this->excel->getActiveSheet()->setCellValue('F'.$excel_row, $record->comments);
             $this->excel->getActiveSheet()->getStyle('A5:F'.$excel_row)->applyFromArray($OutlineStyle);
             $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:F'.$excel_row);
             $this->excel->getActiveSheet()->getStyle('A1:F'.$excel_row)->applyFromArray($styleArray);
             $excel_row++;
           }
         }
         
     log_message('debug','cash details is'.print_r($cashDetailsInfo,true));
     $filename='just_some_random_name.xls'; //save our workbook as this file name
     header('Content-Type: application/vnd.ms-excel'); //mime type
     header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
     header('Cache-Control: max-age=0'); //no cache          
     //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
     //if you want to save it as .XLSX Excel 2007 format
     $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
     ob_start();
     $objWriter->save("php://output");
     $xlsData = ob_get_contents();
     ob_end_clean();

     $response =  array(
         'op' => 'ok',
         'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
     );

 die(json_encode($response));
 }
 public function cellColor($cells,$color){
     return $this->excel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
         'type' => PHPExcel_Style_Fill::FILL_SOLID,
         'startcolor' => array(
              'rgb' => $color
         )
     ));
     }

}

?>