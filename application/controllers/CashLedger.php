<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class CashLedger extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cash_ledger_model');
        $this->load->model('cash_book_model');
        $this->load->model('cash_account_model');
        $this->load->model('party_model');
        $this->load->model('bank_model');
        $this->load->library('excel');
        $this->isLoggedIn();   
    }
    
    /**
     * This function is used to load the CashLedger list
     */
    function cashLedgerListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      
            
            $data['party'] = $this->party_model->getAllParty($this->company_id);
            $data['cashAccount'] = $this->cash_account_model->getAllCashAccounts($this->company_id);
            $this->global['pageTitle'] = $this->company_name.' :CashLedger Details ';
            $this->loadViews("cash_ledger/cashLedger", $this->global, $data, NULL);
        }
    }
    function getCashLedgerDetails()
    {
      $draw = intval($this->input->post("draw"));
      $start = intval($this->input->post("start"));
      $length = intval($this->input->post("length"));
      $data_array_new = [];
      $data_array = $this->cash_ledger_model->cashLedgerListing($this->company_id);
       
        foreach($data_array as $r) {
            $viewButton ='<a class="btn  btn-sm btn-primary" href="'.site_url('viewCashLedger/'.$r->row_id).'"title="View"><i class="fa fa-eye"></i></a>';
            $editButton ='<a class="btn  btn-sm btn-info" href="'.site_url('editCashLedgerPageView/'.$r->row_id).'"title="Edit"><i class="fas fa-edit"></i></a>';
            if($this->role == ROLE_ADMIN || $this->role == ROLE_EMPLOYEE ) {
             $deleteButton = '<a class="btn btn-sm btn-danger deleteCashLedger" data-row_id='.$r->row_id.' href="#" title="Delete"><i class="fas fa-trash"></i></a>';
            }else{
                $deleteButton='' ;
                $editButton='';
            }
            $data_array_new[] = array(
                 $r->cash_ledger_date,
                 $r->party_name,
                 $r->reason,
                 $r->cash_amount,
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
     * This function is used load CashLedger edit information
     */
    function editCashLedgerPageView($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            if($row_id == null){
                redirect('cashLedgerListing');
            }
            $data['party'] = $this->party_model->getAllParty($this->company_id);
            $data['cashAccount'] = $this->cash_account_model->getAllCashAccounts($this->company_id);
            $data['cashLedgerInfo'] = $this->cash_ledger_model->getCashLedgerInfoById($row_id);
            $this->global['pageTitle'] = $this->company_name.' : Edit CashLedger ';
            $this->loadViews("cash_ledger/editCashLedger", $this->global, $data, NULL);
        }
    }
    

      /**
     * This function is used to add new CashLedger to the system
     */
    function addCashLedger()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
                $party_rowid = $this->security->xss_clean($this->input->post('party_rowid'));
                $cash_ledger_date = $this->security->xss_clean($this->input->post('cash_ledger_date'));
                $reason = $this->security->xss_clean($this->input->post('reason'));
                $cash_amount = $this->security->xss_clean($this->input->post('cash_amount'));
                $cash_account_rowid = $this->security->xss_clean($this->input->post('cash_account_rowid'));
                $data['cashAccountInfo'] = $this->cash_account_model->getCashAccountInfoById($cash_account_rowid);
                if($cash_amount > $data['cashAccountInfo']->account_balance)
                {
                    $this->session->set_flashdata('error', 'Insufficient Account Balance');
                } else {
                    $cashLedgerInfo = array('party_rowid'=>$party_rowid,'cash_account_rowid'=>$cash_account_rowid,'cash_ledger_date'=>date('y-m-d',strtotime($cash_ledger_date)),'reason'=>$reason,'cash_amount'=>$cash_amount,          
                    'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                     $result = $this->cash_ledger_model->addCashLedger($cashLedgerInfo);
                     if($result > 0){
                        $account_balance_result =  $data['cashAccountInfo']->account_balance - $cash_amount;
                        $cashAccountInfo = array('account_balance'=>$account_balance_result,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                        $cash_account_result = $this->cash_account_model->updateCashAccount($cashAccountInfo,$cash_account_rowid);
                        $cashInfo = array('credit'=>$cash_amount ,'cash_account_rowid'=>$cash_account_rowid,'cash_date'=>date('Y-m-d',strtotime($cash_ledger_date)),'transaction_type'=>'Cash', 'cashLedger_rowid'=>$result, 'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                        $result = $this->cash_book_model->addCashExpenses($cashInfo);
                        $this->session->set_flashdata('success', 'New Cash Ledger created successfully');
                    } else{
                        $this->session->set_flashdata('error', 'Cash Ledger creation failed');
                    }
                  
                }
                redirect('cashLedgerListing');
            }
        
    }

    // 
    /**
     * This function is used to edit the CashLedger information
     */
    function updateCashLedger()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else { 
            $row_id = $this->input->post('row_id');
            $data['cashLedgerInfo'] = $this->cash_ledger_model->getCashLedgerInfoById($row_id);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('party_rowid','Party Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('cash_amount','Amount','required'); 
            if($this->form_validation->run() == FALSE)
            {
                $this->editCashLedgerPageView($row_id);
            } else {
                $party_rowid = $this->security->xss_clean($this->input->post('party_rowid'));
                $cash_ledger_date = $this->security->xss_clean($this->input->post('cash_ledger_date'));
                $reason = $this->security->xss_clean($this->input->post('reason'));
                $cash_amount = $this->security->xss_clean($this->input->post('cash_amount'));
                $cash_account_rowid = $this->security->xss_clean($this->input->post('cash_account_rowid'));
                $data['cashAccountInfo'] = $this->cash_account_model->getCashAccountInfoById($cash_account_rowid);
                if($cash_amount > $data['cashAccountInfo']->account_balance)
                 {
                   $this->session->set_flashdata('error', 'Insufficient Account Balance');
                 } else{
                      $cashLedgerInfo = array('party_rowid'=>$party_rowid,'cash_ledger_date'=>date('y-m-d',strtotime($cash_ledger_date)),'reason'=>$reason,'cash_amount'=>$cash_amount,          
                     'company_id'=>$this->company_id,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                      $result = $this->cash_ledger_model->updateCashLedger($cashLedgerInfo,$row_id);
                      if($result > 0){
                        
                  // update account balance
                        $old_cash_balance = $data['cashAccountInfo']->account_balance + $data['cashLedgerInfo']->cash_amount;          
                        $cash_balance = $old_cash_balance - $cash_amount;
                        $cashAccountInfo = array('account_balance'=>$cash_balance,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                        $cash_account_result = $this->cash_account_model->updateCashAccount($cashAccountInfo,$cash_account_rowid);
                        $cashInfo = array('credit'=>$cash_amount ,'cash_account_rowid'=>$cash_account_rowid,'cash_date'=>date('Y-m-d',strtotime($cash_ledger_date)), 'company_id'=>$this->company_id,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                        $result = $this->cash_book_model->updateCashLedgerExpences($cashInfo,$row_id);
                        $this->session->set_flashdata('success', 'New Cash Ledger updated successfully'); 
                }
                else{
                    $this->session->set_flashdata('error', 'Cash Ledger creation failed');
                }
            }
            redirect('editCashLedgerPageView/'.$row_id);
        }
    }
    
}

/**
     * This function is used to delete the CashLedger using row_id
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteCashLedger()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $data['cashBookInfo'] = $this->cash_book_model->getCashbookInfo($row_id);

            $data['cashLedgerInfo'] = $this->cash_ledger_model->getCashLedgerInfoById($data['cashBookInfo']->cashLedger_rowid);
         
            $data['cashAccountInfo'] = $this->cash_account_model->getCashAccountInfoById($data['cashLedgerInfo']->cash_account_rowid);

            $cash_balance = $data['cashAccountInfo']->account_balance + $data['cashLedgerInfo']->cash_amount;

            $cashAccountInfo = array('account_balance'=>$cash_balance,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
            $cash_account_result = $this->cash_account_model->updateCashAccount($cashAccountInfo,$data['cashLedgerInfo']->cash_account_rowid);

            $cashLedgerInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->cash_ledger_model->deleteCashLedger($row_id,$cashLedgerInfo);

            $cashBookInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result2 = $this->cash_book_model->deletecashBook($row_id,$cashBookInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }
    /**
     * View CashLedger details based on row_id
     *
     */
    public function viewCashLedger($row_id = null)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            if ($row_id == null) {
                redirect('cashLedgerListing');
            }
            $data['cashLedgerInfo'] = $this->cash_ledger_model->getCashLedgerInfoById($row_id);
            $this->global['pageTitle'] = $this->company_name.': View Cash Ledger';
            $this->loadViews("cash_ledger/viewCashLedger", $this->global, $data, null);
        }
    } 
  
    // Cash Ledger  Report
function downloadCashLedgerReport(){
    //print page setup
 $this->excel->setActiveSheetIndex(0);
 $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToPage(true);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);    
 $fromDate = $this->input->post('from_date');
 $toDate = $this->input->post('to_date');
 $cashDetailsInfo = $this->cash_ledger_model->getCashLedgerReport($fromDate,$toDate);
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
           
         $this->excel->getActiveSheet()->mergeCells('A1:E1');
         $this->excel->getActiveSheet()->setCellValue('A1', "KARAVALI TRANSPORT ");
         $this->excel->getActiveSheet()->mergeCells('A2:E2');
         $this->excel->getActiveSheet()->setCellValue('A2', "CASH LEDGER REPORT");
         $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
         $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
         $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->getStyle('A1:E2')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($OutlineStyle);
           $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
           $this->excel->getActiveSheet()->mergeCells('A3:E3');
           $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
           $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->setCellValue('A3', "Date From : ".$fromDate. " To : " .$toDate);
         //   //font bold and text bold
           $this->excel->getActiveSheet()->getStyle('A4:E4')->getFont()->setBold(true);
          //horizontal and vertical alignment
       $this->excel->getActiveSheet()->getStyle('A4:E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $this->excel->getActiveSheet()->getStyle('A4:E4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
           //set width for cell
           $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
           $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
           $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
           $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
         
         //   //report Header
           $this->cellColor('A4:E4', 'D5DBDB');
           $this->excel->getActiveSheet()->getStyle('A4')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->getStyle('A4:E4')->applyFromArray($OutlineStyle);
           $this->excel->getActiveSheet()->setCellValue('A4', "Date");
           $this->excel->getActiveSheet()->setCellValue('B4', "Amount");
           $this->excel->getActiveSheet()->setCellValue('C4', "Cash Account");
           $this->excel->getActiveSheet()->setCellValue('D4', "Party");
           $this->excel->getActiveSheet()->setCellValue('E4', "Reason");
         $excel_row = 5;
      
         if(!empty($cashDetailsInfo))
         {
          foreach($cashDetailsInfo as $record)
           {
             //set row height for cell
             //horizontal and vertical alignment
             $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':E' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':E' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
             $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
             $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, date('d-m-Y',strtotime($record->cash_ledger_date)));
             $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->cash_amount);
             $this->excel->getActiveSheet()->setCellValue('C'.$excel_row,$record->cash_account_name);
             $this->excel->getActiveSheet()->setCellValue('D'.$excel_row, $record->party_name);
             $this->excel->getActiveSheet()->setCellValue('E'.$excel_row, $record->reason);
             $this->excel->getActiveSheet()->getStyle('A5:E'.$excel_row)->applyFromArray($OutlineStyle);
             $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:E'.$excel_row);
             $this->excel->getActiveSheet()->getStyle('A1:E'.$excel_row)->applyFromArray($styleArray);
             $excel_row++;
           }
         }
         

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