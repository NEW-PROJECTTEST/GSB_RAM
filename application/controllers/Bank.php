<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Bank extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bank_model');
        $this->load->library('excel');

        $this->isLoggedIn();   
    }
    
 /**
     * This function is used to load the bank list
     */
    function bankListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      
          
            $this->global['pageTitle'] = $this->company_name.' :Bank Details ';
            $this->loadViews("bank/bank", $this->global, NULL, NULL);
        }
    }
   
    function getBankDetails()
    {
      $draw = intval($this->input->post("draw"));
      $start = intval($this->input->post("start"));
      $length = intval($this->input->post("length"));
        $data_array_new = [];
        $data_array = $this->bank_model->bankListing($this->company_id);
        log_message('debug',base_url());
        foreach($data_array as $r) {
            $viewButton ='<a class="btn  btn-sm btn-primary" href="'.site_url('viewBank/'.$r->row_id).'"title="View"><i class="fa fa-eye"></i></a>';
            if($this->role == ROLE_ADMIN ) {
             $editButton ='<a class="btn  btn-sm btn-info" href="'.site_url('editBankPageView/'.$r->row_id).'"title="Edit"><i class="fas fa-edit"></i></i></a>';
             $deleteButton = '<a class="btn btn-sm btn-danger deleteBank" data-row_id='.$r->row_id.' href="#" title="Delete"><i class="fas fa-trash"></i></a>';
            }else{
                $deleteButton='' ;
                $editButton='';
            }
            $data_array_new[] = array(
                 $r->bank_name,
                 $r->branch_name,
                 $r->bank_contact,
                 $r->IFSC_code,
                 $r->account_type,
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
     * This function is used to add new bank to the system
     */
    function addBank()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
                $bank_name = ucwords(strtolower($this->security->xss_clean($this->input->post('bank_name'))));
                $bank_account_number = $this->security->xss_clean($this->input->post('bank_account_number'));
                $account_type = $this->security->xss_clean($this->input->post('account_type'));
                $branch_name = $this->security->xss_clean($this->input->post('branch_name'));
                $IFSC_code =$this->security->xss_clean($this->input->post('IFSC_code'));
                $bank_contact =$this->security->xss_clean($this->input->post('bank_contact'));
                $bankInfo = array('bank_name'=>$bank_name,'bank_account_number'=>$bank_account_number,'account_type'=>$account_type,'branch_name'=>$branch_name,'IFSC_code'=>$IFSC_code,
                'bank_contact'=>$bank_contact, 'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->bank_model->addBank($bankInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Bank created successfully');
                } else{
                    $this->session->set_flashdata('error', 'Bank creation failed');
                }
                
                redirect('bankListing');
            }
        
    }

    /**
     * This function is used load bank edit information
     */
    function editBankPageView($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            if($row_id == null){
                redirect('bankListing');
            }
            $data['bankInfo'] = $this->bank_model->getBankInfoById($row_id);
            $this->global['pageTitle'] = $this->company_name.' : Edit bank ';
            $this->loadViews("bank/editBank", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to edit the bank information
     */
    function updateBank()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else { 
            $row_id = $this->input->post('row_id');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('bank_name','Bank Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('branch_name','Branch Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('bank_account_number','Account Number','trim|required');
            $this->form_validation->set_rules('account_type','Bank Address','required');
            $this->form_validation->set_rules('bank_contact','Contact Number','required|max_length[10]');
            $this->form_validation->set_rules('IFSC_code','IFSC','required');
            if($this->form_validation->run() == FALSE)
            {
                $this->editBankPageView($row_id);
            }else {
                $bank_name = ucwords(strtolower($this->security->xss_clean($this->input->post('bank_name'))));
                $account_type = $this->security->xss_clean($this->input->post('account_type'));
                $branch_name = $this->security->xss_clean($this->input->post('branch_name'));
                $bank_account_number = $this->security->xss_clean($this->input->post('bank_account_number'));
                $IFSC_code =$this->security->xss_clean($this->input->post('IFSC_code'));
                $bank_contact =$this->security->xss_clean($this->input->post('bank_contact'));
                $bankInfo = array('bank_name'=>$bank_name,'account_type'=>$account_type,'bank_account_number'=>$bank_account_number,'branch_name'=>$branch_name,'IFSC_code'=>$IFSC_code,
                'bank_contact'=>$bank_contact,'company_id'=>$this->company_id,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->bank_model->updateBank($bankInfo,$row_id);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New bank updated successfully');
                }
                else{
                    $this->session->set_flashdata('error', 'bank update failed');
                }
                redirect('editBankPageView/'.$row_id);
            }
        }
    }

/**
     * This function is used to delete the bank using row_id
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteBank()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $bankInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->bank_model->deleteBank($row_id,$bankInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }
    /**
     * View bank details based on bank_id
     *
     */
    public function viewBank($row_id = null)
    {
        if ($this->isAdmin() == true ) {
            $this->loadThis();
        } else {
            if ($row_id == null) {
                redirect('bankListing');
            }
            $data['bankInfo'] = $this->bank_model->getBankInfoById($row_id);
            $this->global['pageTitle'] = $this->company_name.': View bank';
            $this->loadViews("bank/viewBank", $this->global, $data, null);
        }
    } 


    /**
     * Bank Transaction Functions
     */
    public function bankTransactionListing(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      
            $data['bankInfo'] = $this->bank_model->getAllBank($this->company_id);
            $this->global['pageTitle'] = $this->company_name.' :Bank Details ';
            $this->loadViews("bank/bankTransactions", $this->global, $data, NULL);
        }
    }

    public function addBankTransaction(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
                $trans_date = $this->security->xss_clean($this->input->post('trans_date'));
                $bank_name = $this->security->xss_clean($this->input->post('bank_name'));
                $particular = $this->security->xss_clean($this->input->post('particular'));
                $transaction_type = $this->security->xss_clean($this->input->post('transaction_type'));
                $amount = $this->security->xss_clean($this->input->post('amount'));
                $transInfo = array(
                    'trans_date'=>date('Y-m-d',strtotime($trans_date)),
                    'bank_name'=>$bank_name,
                    'trans_type'=>$transaction_type,
                    'amount'=>$amount,
                    'particular'=>$particular,
                    'created_by'=>$this->employee_id, 
                    'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->bank_model->addBankTransaction($transInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'Bank Transaction added successfully');
                } else{
                    $this->session->set_flashdata('error', 'Transaction adding failed');
                }
                
                redirect('bankTransactionListing');
            }
    }

    function getBankTransactionDetails()
    {
      $draw = intval($this->input->post("draw"));
      $start = intval($this->input->post("start"));
      $length = intval($this->input->post("length"));
        $data_array_new = [];
        $data_array = $this->bank_model->bankTransactionListing($this->company_id);

        foreach($data_array as $r) {
            $editButton ='<a class="btn  btn-sm btn-info" href="'.site_url('editBankTransaction/'.$r->row_id).'"title="Edit"><i class="fas fa-edit"></i></i></a>';
            //if($r->is_required == 0 ) {
                $deleteButton = '<a class="btn btn-sm btn-danger deleteTransaction" data-row_id='.$r->row_id.' href="#" title="Delete"><i class="fas fa-trash"></i></a>';
            // }else{
            //     $deleteButton= '' ;
            // }
            if($r->trans_type=="DEBIT"){
                $data_array_new[] = array(
                    date('d-m-Y',strtotime($r->trans_date)),
                    $r->bank_name,
                    $r->particular,
                    $r->amount,
                    '0',
                    $editButton.' '.$deleteButton
                );
            }else{
                $data_array_new[] = array(
                    date('d-m-Y',strtotime($r->trans_date)),
                    $r->bank_name,
                    $r->particular,
                    '0',
                    $r->amount,
                    $editButton.' '.$deleteButton
                );
            }
            
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
    
    function downloadBankTransactionReport(){
        //print page setup
         $this->excel->setActiveSheetIndex(0);
         $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
         $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
         $this->excel->getActiveSheet()->getPageSetup()->setFitToPage(true);
         $this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
         $this->excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);    
         $fromDate = $this->input->post('from_date');
         $toDate = $this->input->post('to_date');
         $bank_name = $this->input->post('bank_name');

        //to get db start date
        $db_start_date = $this->bank_model->getStartDate($bank_name);
        $start_date = date('Y-m-d', strtotime($db_start_date->trans_date));
        
        //to get end date
        $end_date = date('Y-m-d', strtotime('-1 day', strtotime($fromDate)));
        

        //debit sum
        $sumOfDebit = $this->bank_model->getSumOfDebit($start_date, $end_date, $bank_name);
        //credit sum
        $sumOfCredit = $this->bank_model->getSumOfCredit($start_date, $end_date,$bank_name);
        //opening balance
        $opening_balance = $sumOfDebit - $sumOfCredit;
        //log_message('debug','opnbal=='.$opening_balance);

         $bankInfo = $this->bank_model->getBankTransactionReport($fromDate,$toDate,$bank_name);
         $bank_Info =$this->bank_model->getBankInformation($bank_name);
         $styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
         $this->excel->setActiveSheetIndex(0);
         //name the worksheet
         $this->excel->getActiveSheet()->setTitle('Karavali worksheet');
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
                 $this->excel->getActiveSheet()->mergeCells('A1:D1');
                 $this->excel->getActiveSheet()->setCellValue('A1', "KARAVALI TRANSPORT ");
                 $this->excel->getActiveSheet()->mergeCells('A2:D2');
                 $this->excel->getActiveSheet()->setCellValue('A2', "BANK TRANSACTION REPORT");
                 $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
                 $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
                 $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                 $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
                 $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 $this->excel->getActiveSheet()->getStyle('A1:D2')->applyFromArray($OutlineStyle);
                 $this->excel->getActiveSheet()->getStyle('A3:D3')->applyFromArray($OutlineStyle);
                 $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 $this->excel->getActiveSheet()->mergeCells('A3:D3');
                 $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
                 $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
                 $this->excel->getActiveSheet()->setCellValue('A3', "Date From : ".$fromDate. " To : " .$toDate);
                 $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setSize(12);
                 $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
                 $this->excel->getActiveSheet()->getStyle('C4')->getFont()->setSize(12);
                 $this->excel->getActiveSheet()->getStyle('C4')->getFont()->setBold(true);
                 $this->excel->getActiveSheet()->mergeCells('A4:C4');
                 $this->excel->getActiveSheet()->mergeCells('C4:D4');
                   if($bank_name != 'ALL')
                   {
                    $this->excel->getActiveSheet()->setCellValue('A4', "Bank Name : ".$bank_name);
                    // $this->excel->getActiveSheet()->setCellValue('D4', "Account Number  : ".$bank_Info->bank_account_number);
                   }else {
                    $this->excel->getActiveSheet()->setCellValue('A4', "Bank Name : "."ALL");
                    // $this->excel->getActiveSheet()->setCellValue('D4', "Account Number  : "."ALL");
                  }
                 //   //font bold and text bold
                   $this->excel->getActiveSheet()->getStyle('A5:D5')->getFont()->setBold(true);
                  //horizontal and vertical alignment
               $this->excel->getActiveSheet()->getStyle('A5:D5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
               $this->excel->getActiveSheet()->getStyle('A5:D5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                   //set width for cell
                   $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                   $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
                   $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
                   $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
                //    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
                //    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
                 
                  ;
                 //   //report Header
                //  $this->cellColor('A5:F5', 'D5DBDB');
                 $this->excel->getActiveSheet()->getStyle('A5')->applyFromArray($OutlineStyle);
                 $this->excel->getActiveSheet()->getStyle('A5:D5')->applyFromArray($OutlineStyle);
                 $this->excel->getActiveSheet()->setCellValue('A5', "Date");
                //  $this->excel->getActiveSheet()->setCellValue('B5', "Bank Name");
                 $this->excel->getActiveSheet()->setCellValue('B5', "Particular");
                 $this->excel->getActiveSheet()->setCellValue('C5', "Debit");
                //  $this->excel->getActiveSheet()->setCellValue('E5', "Bank");
                 $this->excel->getActiveSheet()->setCellValue('D5', "Credit");
                 $excel_row = 7;
                 $this->excel->getActiveSheet()->setCellValue('A6', date('d-m-Y',strtotime($fromDate)));
                //  $this->excel->getActiveSheet()->setCellValue('B6', $bank_name);
                $this->excel->getActiveSheet()->setCellValue('B6','Opening Balance');
                $this->excel->getActiveSheet()->setCellValue('C6', $opening_balance);
                //$this->excel->getActiveSheet()->setCellValue('E6'.$excel_row,$record->amount);
                
                $debit_amount = 0;
                $credit_amount = 0;

               if(!empty($bankInfo))
               {
                foreach($bankInfo as $record)
                {
                   //set row height for cell
                       //horizontal and vertical alignment
                //    if(!empty($record->credit) && $record->credit > 0) {
                //    $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //    $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                //    $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
                //    $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, date('d-m-Y',strtotime($record->cash_date)));
                //    if($record->transporter_name != ""){
                //     $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->transporter_name);
                //    }else if($record->fuel_account_name != ""){
                //     $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->fuel_account_name);
                //    } else {
                //     $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->comments);
                //    }
                    $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, date('d-m-Y',strtotime($record->trans_date)));
                    // $this->excel->getActiveSheet()->setCellValue('B'.$excel_row, $record->bank_name);
                    
                   $this->excel->getActiveSheet()->setCellValue('B'.$excel_row, $record->particular);
                   if($record->trans_type=="DEBIT"){
                        $debit_amount += $record->amount;
                        $this->excel->getActiveSheet()->setCellValue('C'.$excel_row,$record->amount);
                   }else{
                        $credit_amount += $record->amount;
                        $this->excel->getActiveSheet()->setCellValue('D'.$excel_row,$record->amount);
                   }
                   
                //    $this->excel->getActiveSheet()->setCellValue('F'.$excel_row, $record->credit);
                   $this->excel->getActiveSheet()->getStyle('A6:D'.$excel_row)->applyFromArray($OutlineStyle);
                   $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:D'.$excel_row);
                   $this->excel->getActiveSheet()->getStyle('A1:D'.$excel_row)->applyFromArray($styleArray);
                   $excel_row++;
                   }
                   

                   //closing balance
                    $total_debit_balance = $debit_amount + $opening_balance;
                    $closing_balance_total = $total_debit_balance - $credit_amount;

                    $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, "");
                    // $this->excel->getActiveSheet()->setCellValue('B'.$excel_row, "");
                    $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,'Closing Balance');
                    $this->excel->getActiveSheet()->setCellValue('D'.$excel_row, $closing_balance_total);

                    //Total
                    $excel_row +=1;
                    $credit_total_value = $credit_amount + $closing_balance_total; 

                    $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, "");
                    // $this->excel->getActiveSheet()->setCellValue('B'.$excel_row, "");
                    $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,'Total');
                    $this->excel->getActiveSheet()->setCellValue('C'.$excel_row, $total_debit_balance);
                    $this->excel->getActiveSheet()->setCellValue('D'.$excel_row, $credit_total_value);
                    $this->excel->getActiveSheet()->getStyle('A6:D'.$excel_row)->applyFromArray($OutlineStyle);
                    $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:D'.$excel_row);
                    $this->excel->getActiveSheet()->getStyle('A1:D'.$excel_row)->applyFromArray($styleArray);
                //$this->excel->getActiveSheet()->setCellValue('E6'.$excel_row,$record->amount);
                //    if(!empty($record->debit) && $record->debit > 0) {
                //     $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':E' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //     $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':E' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                //     $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
                //     $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, date('d-m-Y',strtotime($record->cash_date)));
                //     if($record->transporter_name != ""){
                //       $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->transporter_name);
                //      }else if($record->fuel_account_name != ""){
                //       $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->fuel_account_name);
                //      } else {
                //       $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->comments);
                //      }
                   
                //     $this->excel->getActiveSheet()->setCellValue('C'.$excel_row, $record->party_name);
                //     $this->excel->getActiveSheet()->setCellValue('D'.$excel_row,$record->vehicle_number);
                //     $this->excel->getActiveSheet()->setCellValue('E'.$excel_row,$record->bank_name);
                //     $this->excel->getActiveSheet()->setCellValue('F'.$excel_row, $record->debit);
                //     $this->excel->getActiveSheet()->getStyle('A6:F'.$excel_row)->applyFromArray($OutlineStyle);
                //     $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:F'.$excel_row);
                //     $this->excel->getActiveSheet()->getStyle('A1:F'.$excel_row)->applyFromArray($styleArray);
                //     $excel_row++;
                //     }
                //  }
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

    public function deleteTransaction()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $transInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->bank_model->deleteTransaction($row_id,$transInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }

    function editBankTransaction($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            if($row_id == null){
                redirect('bankTransactionListing');
            }
            $data['bankInfo'] = $this->bank_model->getAllBank($this->company_id);
            $data['transInfo'] = $this->bank_model->getBankTransactionInfoById($row_id);
            $this->global['pageTitle'] = $this->company_name.' : Edit bank ';
            $this->loadViews("bank/editBankTransaction", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to edit the bank information
     */
    function updateBankTransaction()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else { 
            $row_id = $this->input->post('row_id');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('bank_name','Bank Name','required');
            $this->form_validation->set_rules('transaction_type','Transaction Type','required');
            $this->form_validation->set_rules('amount','Amount','required');
            $this->form_validation->set_rules('trans_date','Date','required');
            if($this->form_validation->run() == FALSE)
            {
                $this->editBankTransaction($row_id);
            }else {
                $trans_date = $this->security->xss_clean($this->input->post('trans_date'));
                $bank_name = $this->security->xss_clean($this->input->post('bank_name'));
                $particular = $this->security->xss_clean($this->input->post('particular'));
                $transaction_type = $this->security->xss_clean($this->input->post('transaction_type'));
                $amount = $this->security->xss_clean($this->input->post('amount'));
                $transInfo = array(
                    'trans_date'=>date('Y-m-d',strtotime($trans_date)),
                    'bank_name'=>$bank_name,
                    'trans_type'=>$transaction_type,
                    'amount'=>$amount,
                    'particular'=>$particular,
                    'updated_by'=>$this->employee_id, 
                    'updated_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->bank_model->updateBankTransaction($transInfo,$row_id);
                if($result > 0){
                    $this->session->set_flashdata('success', 'Transaction updated successfully');
                }
                else{
                    $this->session->set_flashdata('error', 'Transaction update failed');
                }
                redirect('editBankTransaction/'.$row_id);
            }
        }
    }
}

?>