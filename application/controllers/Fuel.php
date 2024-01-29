<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Fuel extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('fuel_model');
        $this->load->model('cash_book_model');
        $this->load->model('cash_account_model');
        
        $this->load->model('bank_model');
        $this->load->library('excel');
        $this->isLoggedIn();   
    }
    function fuelAccountListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {  
            $data['cashAccount'] = $this->cash_account_model->getAllCashAccounts($this->company_id);
            $data['bank'] = $this->bank_model->getAllBank($this->company_id);
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $filter = array();
            $count = $this->fuel_model->fuelAccountListingCount($searchText,$filter,$this->company_id);
            $data['count'] =  $count;
			$returns = $this->paginationCompress ("fuelAccountListing/", $count, 100 );
            $data['fuelAccountRecords'] = $this->fuel_model->fuelAccountListing($searchText,$filter,$this->company_id, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = $this->company_name.' :Fuel Account Details ';
            $this->loadViews("fuel_account/fuel_account", $this->global, $data, NULL);
        }
    }

    function addFuelAccount()
    {
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {
                $fuel_account_type = $this->security->xss_clean($this->input->post('fuel_account_type'));
                $fuel_account_name = ucwords(strtolower($this->security->xss_clean($this->input->post('fuel_account_name'))));
                $account_opening_bal = $this->security->xss_clean($this->input->post('account_opening_bal'));
                $fuelAccountInfo = array('account_balance'=>$account_opening_bal,'fuel_account_type'=>$fuel_account_type, 'fuel_account_name'=>$fuel_account_name, 
                'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->fuel_model->addNewFuelAccount($fuelAccountInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Fuel Account created successfully');
                    $fuelCashInfo = array(
                        'cash_date'=>date('Y-m-d'), 
                        'cash_type'=>'Cash',
                        'cash_amount'=>$account_opening_bal,
                        'cash_row_id'=>NULL, 
                        'comments'=>"Opening Balance", 
                        'fuel_account_rowid'=>$result, 
                        'company_id'=>$this->company_id,
                        'created_by'=>$this->employee_id,
                        'created_date_time'=>date('Y-m-d H:i:s'));
                        $fuel_cash_info_row_id = $this->fuel_model->addFuelCashDetails($fuelCashInfo);
                        $fuelExpensesInfo = array(
                            'debit'=>$account_opening_bal,
                            'fuel_account_row_id'=>$result,
                            'cash_date'=>date('Y-m-d'),
                            'transaction_type'=>"Cash", 
                            'fuel_cash_info_row_id'=>$fuel_cash_info_row_id, 
                            'bank_account_row_id' => NULL,
                            'cash_account_row_id' => NULL,
                            'company_id'=>$this->company_id,
                            'created_by'=>$this->employee_id, 
                            'created_date_time'=>date('Y-m-d H:i:s')
                        );
                        $this->fuel_model->addFuelExpenses($fuelExpensesInfo);
                } else {
                    $this->session->set_flashdata('error', 'Fuel Account creation failed');
                }
                redirect('fuelAccountListing');
            
        }
    }
 /**
     * This function is used load CashAccount edit information
     */
    function editFuelAccountPageView($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            if($row_id == null){
                redirect('cashAccountListing');
            }
            $data['fuelAccountInfo'] = $this->fuel_model->getFuelAccountInfoById($row_id);
            $this->global['pageTitle'] = $this->company_name.' : Edit Fuel Account ';
            $this->loadViews("fuel_account/editFuelAccount", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to edit the CashAccount information
     */
    function updateFuelAccount()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else { 
            $row_id = $this->input->post('row_id');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('fuel_account_type','Account Type','trim|required');
            $this->form_validation->set_rules('fuel_account_name','Account Name','required');
            if($this->form_validation->run() == FALSE)
            {
                $this->editCashAccountPageView($row_id);
            }else {
                $fuel_account_type = $this->security->xss_clean($this->input->post('fuel_account_type'));
                $fuel_account_name = ucwords(strtolower($this->security->xss_clean($this->input->post('fuel_account_name'))));
                $cashAccountInfo = array('fuel_account_type'=>$fuel_account_type, 'fuel_account_name'=>$fuel_account_name, 
               'company_id'=>$this->company_id,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->fuel_model->updateFuelAccount($cashAccountInfo,$row_id);
                if($result > 0){
                    $this->session->set_flashdata('success', 'Fuel Account updated successfully');
                }
                else{
                    $this->session->set_flashdata('error', 'Fuel Account update failed');
                }
                redirect('editFuelAccountPageView/'.$row_id);
            }
        }
    }

/**
     * This function is used to delete the CashAccount using row_id
     * @return boolean $result : TRUE / FALSE
     */ 
    public function deleteFuelAccount()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $cashAccountInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->fuel_model->updateFuelAccount($cashAccountInfo,$row_id);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }

    /**
     * View CashAccount details based on row_id
     *
     */
    public function viewFuelAccount($row_id = null)
    {
        if ($this->isAdmin() == true ) {
            $this->loadThis();
        } else {
            if ($row_id == null) {
                redirect('fuelAccountListing');
            }
            $data['fuelAccountInfo'] = $this->fuel_model->getFuelAccountInfoById($row_id);
            $data['fuelCashRecords'] = $this->fuel_model->getFuelCashDetails($row_id);
            $data['openingRowId'] = $this->fuel_model->getFuelInfoOpeningBalanceRowId($row_id);
            $data['row_id'] = $row_id;
            $this->global['pageTitle'] = $this->company_name.': View Fuel Account';
            $this->loadViews("fuel_account/viewFuelAccount", $this->global, $data, null);
        }
    } 

    /**
     * This function is used to add new Cash Details to the system
     */
    function addCashToFuelAccount()
    {
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {
                $cash_date = $this->security->xss_clean($this->input->post('cash_date'));
                $cash_amount = $this->security->xss_clean($this->input->post('cash_amount'));

                $comments = $this->security->xss_clean($this->input->post('comments'));
                $tran_type = $this->security->xss_clean($this->input->post('tran_type'));
                $fuel_account_rowid =$this->security->xss_clean($this->input->post('fuel_account_rowid'));
                $data['fuelAccountInfo'] = $this->fuel_model->getFuelAccountInfoById($fuel_account_rowid);
             
                if($tran_type == 'Cash'){
                    $bank_rowid = NULL;
                    $cash_row_id = $this->security->xss_clean($this->input->post('cash_row_id'));
                    $fuelCashInfo = array(
                    'cash_date'=>date('y-m-d',strtotime($cash_date)), 
                    'cash_type'=>'Cash',
                    'cash_amount'=>$cash_amount,
                    'cash_row_id'=>$cash_row_id, 
                    'comments'=>$comments, 
                    'fuel_account_rowid'=>$fuel_account_rowid, 
                    'company_id'=>$this->company_id,
                    'created_by'=>$this->employee_id,
                    'created_date_time'=>date('Y-m-d H:i:s'));
                   
                }else{
                    $cash_row_id = NULL;
                    $bank_rowid = $this->security->xss_clean($this->input->post('bank_row_id'));
                    $fuelCashInfo = array('cash_date'=>date('y-m-d',strtotime($cash_date)), 
                    'cash_type'=>'Bank', 
                    'cash_amount'=>$cash_amount, 
                    'bank_row_id'=>$bank_rowid, 
                    'comments'=>$comments, 
                    'fuel_account_rowid'=>$fuel_account_rowid, 
                    'company_id'=>$this->company_id,
                    'created_by'=>$this->employee_id, 
                    'created_date_time'=>date('Y-m-d H:i:s'));
                }
                $result = $this->fuel_model->addFuelCashDetails($fuelCashInfo);
                if($result > 0){
                    // if($data['fuelAccountInfo']->account_balance < 0){
                    //     $account_balance_result =  $data['fuelAccountInfo']->account_balance + $cash_amount;
                    // }else{
                        
                    // }
                    
                    //START adding bank transaction to table
                    if($tran_type == 'Bank'){
                        $acc_type = $this->bank_model->getBankInfoById($bank_rowid);
                        $acc_name = $this->fuel_model->getFuelAccountInfoById($fuel_account_rowid);
                        if($acc_type->account_type=='O/D Account'){
                            $transInfo = array(
                                'trans_date'=>date('Y-m-d',strtotime($cash_date)),
                                'bank_name'=>$acc_type->bank_name,
                                'trans_type'=>'CREDIT',
                                'amount'=>$cash_amount,
                                // 'particular'=>'Add Cash to fuel Account - '.$acc_name->fuel_account_name,
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
                                // 'particular'=>'Add Cash to fuel Account - '.$acc_name->fuel_account_name,
                                'particular' => $comments,
                                'is_required' => 1,
                                'created_by'=>$this->employee_id, 
                                'created_date_time'=>date('Y-m-d H:i:s'));
                        }
                        $result = $this->bank_model->addBankTransaction($transInfo);
                    }
                    //END adding bank transaction to table


                    $account_balance_result =  $data['fuelAccountInfo']->account_balance - $cash_amount;

                     $fuelAccountInfo = array('account_balance'=>$account_balance_result,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                     $result_updated = $this->fuel_model->updateFuelAccount($fuelAccountInfo,$fuel_account_rowid);

                     if($tran_type == 'Cash'){
                        $data['cashAccountInfo'] = $this->cash_account_model->getCashAccountInfoById($cash_row_id);
                        if($data['cashAccountInfo']->account_balance < 0){
                            $account_balance_result =  $data['cashAccountInfo']->account_balance + $cash_amount;
                        }else{
                            $account_balance_result =  $data['cashAccountInfo']->account_balance - $cash_amount;
                        }
                       
                        $cashAccountInfo = array(
                            'account_balance'=>$account_balance_result,
                            'updated_by'=>$this->employee_id, 
                            'updated_date_time'=>date('Y-m-d H:i:s')
                            );
                        $cash_account_result = $this->cash_account_model->updateCashAccount($cashAccountInfo,$cash_row_id);

                        $cashExpensesInfo = array(
                            'credit'=>$cash_amount,
                            'cash_date'=>date('Y-m-d',strtotime($cash_date)),
                            'transaction_type'=>$tran_type, 
                            'fuel_cash_info_row_id'=>$result,
                            'comments'=>$comments,
                            'cash_account_rowid' => $cash_row_id,
                            'company_id'=>$this->company_id,
                            'created_by'=>$this->employee_id, 
                            'created_date_time'=>date('Y-m-d H:i:s')
                        );
                }else{
                    $cashExpensesInfo = array(
                        'credit'=>$cash_amount,
                        'cash_date'=>date('Y-m-d',strtotime($cash_date)),
                        'transaction_type'=>$tran_type, 
                        'fuel_cash_info_row_id'=>$result,
                        'comments'=>$comments,
                        'bank_account_row_id' => $bank_rowid,
                        'company_id'=>$this->company_id,
                        'created_by'=>$this->employee_id, 
                        'created_date_time'=>date('Y-m-d H:i:s')
                    );
                }
                    $cash_expense_result = $this->cash_book_model->addCashExpenses($cashExpensesInfo);
                     $fuelExpensesInfo = array(
                        'credit'=>$cash_amount,
                        'fuel_account_row_id'=>$fuel_account_rowid,
                        'cash_date'=>date('Y-m-d',strtotime($cash_date)),
                        'transaction_type'=>$tran_type, 
                        'fuel_cash_info_row_id'=>$result, 
                        'bank_account_row_id' => $bank_rowid,
                        'cash_account_row_id' => $cash_row_id,
                        'company_id'=>$this->company_id,
                        'created_by'=>$this->employee_id, 
                        'created_date_time'=>date('Y-m-d H:i:s')
                    );
                    $this->fuel_model->addFuelExpenses($fuelExpensesInfo);
                     $this->session->set_flashdata('success', 'New Fuel Cash Details added successfully');
                } else {
                    $this->session->set_flashdata('error', 'Fuel Cash Details add failed');
                }
                redirect('fuelAccountListing');
        }
    }

    function fuelBookListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      
            $debit = $this->security->xss_clean($this->input->post('debit'));  
            $credit = $this->security->xss_clean($this->input->post('credit'));
            $created_date = $this->security->xss_clean($this->input->post('created_date'));  
            $transaction_type = $this->security->xss_clean($this->input->post('transaction_type'));
            $fuel_name = $this->security->xss_clean($this->input->post('fuel_name'));

            
            $data['debit'] = $debit;
            $data['credit'] = $credit;
            $data['transaction_type'] = $transaction_type;
            $filter['debit'] = $debit;
            $filter['credit'] = $credit;
            
            $data['fuel_name'] = $fuel_name;
            $filter['fuel_name'] = $fuel_name;

            $filter['transaction_type'] = $transaction_type;
            if(!empty($created_date)){
              $data['created_date'] = date('d-m-Y',strtotime($created_date));
              $filter['created_date'] = date('Y-m-d',strtotime($created_date));
          } else {
              $data['created_date'] = $created_date;
              $filter['created_date'] = $created_date;
          }
            // $searchText = $this->security->xss_clean($this->input->post('searchText'));
            // $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->fuel_model->fuelBookListingCount($filter,$this->company_id);
            $data['count'] =  $count;
		    $returns = $this->paginationCompress("cashBookListing/", $count, 100 );
            $data['fuelBookRecords'] = $this->fuel_model->fuelBookListing($filter,$this->company_id, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = $this->company_name.' :Fuel Book Details ';
            $this->loadViews("fuel_account/fuel_book", $this->global, $data, NULL);
        }
    }
 
public function deleteFuelAccountCashInfo(){
    if ($this->isAdmin() == true) {
        echo (json_encode(array('status' => 'access')));
    } else {
        $row_id = $this->input->post('row_id');
        $fuel_id = $this->input->post('fuel_id');
       // log_message('debug','ewdhgwdyguw='.$fuel_id);
        $getFuelCreditedInfo = $this->fuel_model->getFuelCreditedInfo($row_id, 'Cash');
       // $fuelCashDetailsInfo = $this->fuel_model->getFuelCashDetailsRow($row_id);
        $fuelAccount = $this->fuel_model->getFuelAccountInfoById($fuel_id);
        if(!empty($getFuelCreditedInfo)){

            $cashAccountInfo = $this->cash_account_model->getCashAccountInfoById($getFuelCreditedInfo->cash_account_rowid);
            $cash_balance = $cashAccountInfo->account_balance + $getFuelCreditedInfo->credit;
            $cashAccountInfo = array('account_balance'=>$cash_balance,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
            $this->cash_account_model->updateCashAccount($cashAccountInfo,$getFuelCreditedInfo->cash_account_rowid);
           
            $cashBookInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $this->cash_book_model->updateCashExpById($getFuelCreditedInfo->row_id,$cashBookInfo);
            $this->fuel_model->updateFuelCashInfoRowId($cashBookInfo, $getFuelCreditedInfo->fuel_cash_info_row_id);
           
            
             //update fuel account info
            //  log_message('debug','fuel_balaceff='.$fuel_id);
             $account_balance_result = $fuelAccount->account_balance + $getFuelCreditedInfo->credit;
             //log_message('debug','credit_balace='.$getFuelCreditedInfo->credit);
             $fuelAccountInfo = array('account_balance'=>$account_balance_result,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
             $this->fuel_model->updateFuelAccount($fuelAccountInfo,$fuelAccount->row_id);
        }
        $getFuelCreditedInfoBank = $this->fuel_model->getFuelCreditedInfo($row_id, 'Bank');
        if(!empty($getFuelCreditedInfoBank)){
            $cashBookInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $this->cash_book_model->updateCashExpById($getFuelCreditedInfoBank->row_id,$cashBookInfo);
            $this->fuel_model->updateFuelCashInfoRowId($cashBookInfo, $getFuelCreditedInfoBank->fuel_cash_info_row_id);
           
            //update fuel account info
            $account_balance_result = $fuelAccount->account_balance + $getFuelCreditedInfoBank->credit;
            $fuelAccountInfo = array('account_balance'=>$account_balance_result,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
            $this->fuel_model->updateFuelAccount($fuelAccountInfo,$fuelAccount->row_id);
    
        }

     

        $fuelCashAccountInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
       
        $result = $this->fuel_model->updateFuelCashInfo($fuelCashAccountInfo,$row_id);

        if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
    }
}
    // Cash Book  Report
function fuelAccountReport() {
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
    $this->excel->getActiveSheet()->getPageSetup()->setFitToPage(true);
    $this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
    $this->excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);    
    $fromDate = $this->input->post('from_date');
    $toDate = $this->input->post('to_date');
    $vehicle_number = $this->input->post('vehicle_number_fuel_report');
    $diesel_pump = $this->input->post('diesel_pump_fuel_report');
    $vehicle_type = $this->input->post('vehicle_type_fuel_book');
 
    $db_start_date = $this->fuel_model->getStartDate();
    $start_date = date('Y-m-d', strtotime($db_start_date->cash_date));
   // log_message('debug','date==='.$diesel_pump);
    //to get end date
    $end_date = date('Y-m-d', strtotime('-1 day', strtotime($fromDate)));
  
    // $end_date = date('Y-m-d', strtotime('-1 day'));
  
     //debit sum
    $sumOfDebit = $this->fuel_model->getsumOfDebit($start_date, $end_date,$diesel_pump);
   // log_message('debug','date==='.$sumOfDebit);
    //credit sum
    $sumOfCredit = $this->fuel_model->getSumOfCredit($start_date, $end_date,$diesel_pump);
  
    //opening balance
    $opening_balance = $sumOfDebit -  $sumOfCredit;
   

    $styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
    $this->excel->setActiveSheetIndex(0);
    //name the worksheet
    $this->excel->getActiveSheet()->setTitle('Karvali');
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
            $this->excel->getActiveSheet()->setCellValue('A1', "KARAVALI TRANSPORT");
            $this->excel->getActiveSheet()->mergeCells('A2:F2');
            $this->excel->getActiveSheet()->setCellValue('A2', "FUEL BOOK REPORT");
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
            //font bold and text bold
              $this->excel->getActiveSheet()->getStyle('A4:F4')->getFont()->setBold(true);
            //horizontal and vertical alignment
            $this->excel->getActiveSheet()->getStyle('A4:F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('A4:F4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                //set width for cell
                $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
                $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
                $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
                $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
                $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
              
               ;
              //   //report Header
              $this->cellColor('A4:F4', 'D5DBDB');
              $this->excel->getActiveSheet()->getStyle('A4')->applyFromArray($OutlineStyle);
              $this->excel->getActiveSheet()->getStyle('A4:F4')->applyFromArray($OutlineStyle);
              $this->excel->getActiveSheet()->setCellValue('A4', "Date");
              $this->excel->getActiveSheet()->setCellValue('B4', "Pump Name");
              $this->excel->getActiveSheet()->setCellValue('C4', "Vehicle Number");
              $this->excel->getActiveSheet()->setCellValue('D4', "Cash Type");
              $this->excel->getActiveSheet()->setCellValue('E4', "Debit");
              $this->excel->getActiveSheet()->setCellValue('F4', "Credit");
             
              $excel_row = 5;
              $credit_balance_total = 0;
              //add opening balance to balance sheet
              $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
              $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
              $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(17);
            
             
              $cash_debit_info = 0;
              $cash_credit_info = 0;
              $cash_debit_info += $opening_balance;
            
              $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
              $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
              $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);

              $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, 'OB');
              $this->excel->getActiveSheet()->setCellValue('B'.$excel_row, "Opening Balance");
              $this->excel->getActiveSheet()->setCellValue('C'.$excel_row, 'OB');
              $this->excel->getActiveSheet()->setCellValue('D'.$excel_row, "");
              $this->excel->getActiveSheet()->setCellValue('E'.$excel_row, $opening_balance);
              $this->excel->getActiveSheet()->setCellValue('F'.$excel_row, "");
              $this->excel->getActiveSheet()->getStyle('A5:F'.$excel_row)->applyFromArray($OutlineStyle);
              $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:F'.$excel_row);
              $this->excel->getActiveSheet()->getStyle('A1:F'.$excel_row)->applyFromArray($styleArray);
              $excel_row++;
              $fuelExpInfo = $this->fuel_model->getFuelExpensesInfoReport($fromDate,$toDate,$vehicle_number,$diesel_pump,$vehicle_type);
              if(!empty($fuelExpInfo))
              {
               foreach($fuelExpInfo as $fuelExp)
                {
                  $cash_debit_info += $fuelExp->debit;
                  $cash_credit_info +=  $fuelExp->credit;
                  $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                  $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                  $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);

                  $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, date('d-m-Y',strtotime($fuelExp->cash_date)));
                  $this->excel->getActiveSheet()->setCellValue('B'.$excel_row, $fuelExp->fuel_account_name);
                  $this->excel->getActiveSheet()->setCellValue('C'.$excel_row, $fuelExp->vehicle_no);
                  $this->excel->getActiveSheet()->setCellValue('D'.$excel_row, $fuelExp->transaction_type);
                  $this->excel->getActiveSheet()->setCellValue('E'.$excel_row, $fuelExp->debit);
                  $this->excel->getActiveSheet()->setCellValue('F'.$excel_row, $fuelExp->credit);
                  $this->excel->getActiveSheet()->getStyle('A5:F'.$excel_row)->applyFromArray($OutlineStyle);
                  $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:F'.$excel_row);
                  $this->excel->getActiveSheet()->getStyle('A1:F'.$excel_row)->applyFromArray($styleArray);
                  $excel_row++;
                }
              }
  
              $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
              $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
              $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
            
              $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, "");
              $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,"Total");
              $this->excel->getActiveSheet()->setCellValue('C'.$excel_row, "");
              $this->excel->getActiveSheet()->setCellValue('D'.$excel_row,"");
              $this->excel->getActiveSheet()->setCellValue('E'.$excel_row,  $cash_debit_info);
              $this->excel->getActiveSheet()->setCellValue('F'.$excel_row,  $cash_credit_info);
              $this->excel->getActiveSheet()->getStyle('A5:F'.$excel_row)->applyFromArray($OutlineStyle);
              $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:F'.$excel_row);
              $this->excel->getActiveSheet()->getStyle('A1:F'.$excel_row)->applyFromArray($styleArray);
              $excel_row++;

            $total_fuel_balance = $cash_debit_info - $cash_credit_info;
            
            $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
          
            $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, "");
            $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,"Pump Balance Pending");
            $this->excel->getActiveSheet()->setCellValue('C'.$excel_row, "");
            $this->excel->getActiveSheet()->setCellValue('D'.$excel_row,"");
            $this->excel->getActiveSheet()->setCellValue('E'.$excel_row,"");
            $this->excel->getActiveSheet()->setCellValue('F'.$excel_row, $total_fuel_balance);
            $this->excel->getActiveSheet()->getStyle('A5:F'.$excel_row)->applyFromArray($OutlineStyle);
            $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:F'.$excel_row);
            $this->excel->getActiveSheet()->getStyle('A1:F'.$excel_row)->applyFromArray($styleArray);
           
          
   
            
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