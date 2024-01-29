<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class CashBook  extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cash_book_model');
        $this->load->model('bank_model');
        $this->load->library('excel');
        $this->isLoggedIn();   
    }
  
    /**
     * This function is used to load the CashAccount list
     */
    function cashBookListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      
            $debit = $this->security->xss_clean($this->input->post('debit'));  
            $credit = $this->security->xss_clean($this->input->post('credit'));
            $created_date = $this->security->xss_clean($this->input->post('created_date'));  
            $transaction_type = $this->security->xss_clean($this->input->post('transaction_type'));
            $data['debit'] = $debit;
            $data['credit'] = $credit;
            $data['transaction_type'] = $transaction_type;
            $filter['debit'] = $debit;
            $filter['credit'] = $credit;
            $filter['transaction_type'] = $transaction_type;
            if(!empty($created_date)){
              $data['created_date'] = date('d-m-Y',strtotime($created_date));
              $filter['created_date'] = date('Y-m-d',strtotime($created_date));
          } else{
              $data['created_date'] = $created_date;
              $filter['created_date'] = $created_date;
          }
            // $searchText = $this->security->xss_clean($this->input->post('searchText'));
            // $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->cash_book_model->cashBookListingCount($filter,$this->company_id);
            $data['count'] =  $count;
		      	$returns = $this->paginationCompress("cashBookListing/", $count, 100 );
            $data['cashBookRecords'] = $this->cash_book_model->cashBookListing($filter,$this->company_id, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = $this->company_name.' :Cash Book Details ';
            $this->loadViews("cash_book/cashBook", $this->global, $data, NULL);
        }
    }

//Over all Cash Book  Report
function downloadOverallCashBookReport(){
//print page setup
 $this->excel->setActiveSheetIndex(0);
 $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToPage(true);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);    
 $fromDate = $this->input->post('from_date');
 $toDate = $this->input->post('to_date');
 $transaction_type = $this->input->post('transaction_type');
 $cashBookInfo = $this->cash_book_model->getCashBookReport($fromDate,$toDate,$transaction_type);
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
          $credit_sum = 0;
          $debit_sum = 0;
         $this->excel->getActiveSheet()->mergeCells('A1:I1');
         $this->excel->getActiveSheet()->setCellValue('A1', "KARAVALI TRANSPORT ");
         $this->excel->getActiveSheet()->mergeCells('A2:I2');
         $this->excel->getActiveSheet()->setCellValue('A2', "CASH BOOK REPORT");
         $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
         $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
         $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->getStyle('A1:I2')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->getStyle('A3:I3')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->mergeCells('A3:I3');
         $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
           $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->setCellValue('A3', "Date From : ".$fromDate. " To : " .$toDate);
           $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setSize(12);
           $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->getStyle('E4')->getFont()->setSize(12);
           $this->excel->getActiveSheet()->getStyle('E4')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->mergeCells('A4:D4');
           $this->excel->getActiveSheet()->mergeCells('E4:I4');
           $this->excel->getActiveSheet()->setCellValue('A4', "Today Date  : ".date('d-m-Y'));
           $this->excel->getActiveSheet()->setCellValue('E4', "Transaction Type  : ".$transaction_type);

         //   //font bold and text bold
           $this->excel->getActiveSheet()->getStyle('A5:I5')->getFont()->setBold(true);
          //horizontal and vertical alignment
       $this->excel->getActiveSheet()->getStyle('A5:I5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $this->excel->getActiveSheet()->getStyle('A5:I5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
           //set width for cell
           $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
           $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
           $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
           $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
           $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
           $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
           $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
           $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
           $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
          ;
         //   //report Header
           $this->cellColor('A5:I5', 'D5DBDB');
           $this->excel->getActiveSheet()->getStyle('A5')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->getStyle('A5:I5')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->setCellValue('A5', "Date");
         $this->excel->getActiveSheet()->setCellValue('B5', "Transporter/Name of the Person");
         $this->excel->getActiveSheet()->setCellValue('C5', "Vehicle Number");
         $this->excel->getActiveSheet()->setCellValue('D5', "Loded  Date");
         $this->excel->getActiveSheet()->setCellValue('E5', "Destination");
         $this->excel->getActiveSheet()->setCellValue('F5', "Unloading");
         $this->excel->getActiveSheet()->setCellValue('G5', "Transaction Type");
         $this->excel->getActiveSheet()->setCellValue('H5', " Debit(Cash Received) ");
         $this->excel->getActiveSheet()->setCellValue('I5', " Credit(Expenses) ");
         $excel_row = 6;
         if(!empty($cashBookInfo))
         {
          foreach($cashBookInfo as $record)
           {
            $credit_sum += $record->credit;
            $debit_sum += $record->debit;
             $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':I' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':I' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
             $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
             if(!empty($record->transport_rowid)){
              $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, date('Y-m-d',strtotime($record->created_date_time)));
             $this->excel->getActiveSheet()->setCellValue('B'.$excel_row, $record->transporter_name);
             $this->excel->getActiveSheet()->setCellValue('C'.$excel_row, $record->vehicle_number);
             $this->excel->getActiveSheet()->setCellValue('D'.$excel_row, $record->date);
             $this->excel->getActiveSheet()->setCellValue('E'.$excel_row, $record->destination);
             $this->excel->getActiveSheet()->setCellValue('F'.$excel_row, $record->unloading_charge);
             $this->excel->getActiveSheet()->setCellValue('G'.$excel_row, $record->transaction_type);
             $this->excel->getActiveSheet()->setCellValue('H'.$excel_row,' ');
             $this->excel->getActiveSheet()->setCellValue('I'.$excel_row, $record->credit);
           
           } else if(!empty($record->cash_details_rowid)){
            $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, date('Y-m-d',strtotime($record->created_date_time)));
            $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,' ');
            $this->excel->getActiveSheet()->setCellValue('C'.$excel_row,' ');
            $this->excel->getActiveSheet()->setCellValue('D'.$excel_row, $record->cash_date);
            $this->excel->getActiveSheet()->setCellValue('E'.$excel_row,' ');
            $this->excel->getActiveSheet()->setCellValue('F'.$excel_row,' ');
            $this->excel->getActiveSheet()->setCellValue('G'.$excel_row, $record->transaction_type);
            $this->excel->getActiveSheet()->setCellValue('H'.$excel_row, $record->debit);
            $this->excel->getActiveSheet()->setCellValue('I'.$excel_row,' ');
           }else {
            $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, date('Y-m-d',strtotime($record->created_date_time)));
            $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,' ');
            $this->excel->getActiveSheet()->setCellValue('C'.$excel_row,' ');
            $this->excel->getActiveSheet()->setCellValue('D'.$excel_row, $record->cash_ledger_date);
            $this->excel->getActiveSheet()->setCellValue('E'.$excel_row,' ');
            $this->excel->getActiveSheet()->setCellValue('F'.$excel_row,' ');
            $this->excel->getActiveSheet()->setCellValue('G'.$excel_row, $record->transaction_type);
            $this->excel->getActiveSheet()->setCellValue('H'.$excel_row,' ');
            $this->excel->getActiveSheet()->setCellValue('I'.$excel_row, $record->credit);
           }
             $this->excel->getActiveSheet()->getStyle('A6:I'.$excel_row)->applyFromArray($OutlineStyle);
             $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:I'.$excel_row);
             $this->excel->getActiveSheet()->getStyle('A1:I'.$excel_row)->applyFromArray($styleArray);
             $excel_row++;
           }

           $this->excel->getActiveSheet()->getStyle('A6:I'.$excel_row)->applyFromArray($OutlineStyle);
           $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:I'.$excel_row);
           $this->excel->getActiveSheet()->getStyle('A1:I'.$excel_row)->applyFromArray($styleArray);
           $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':I' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
           $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':I' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
           $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':I' .$excel_row)->getFont()->setBold(true);
           $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':I' .$excel_row)->getFont()->setSize(12);
           $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
           $this->excel->getActiveSheet()->setCellValue('H'.$excel_row, $debit_sum);
           $this->excel->getActiveSheet()->setCellValue('I'.$excel_row, $credit_sum);
         }
          
     log_message('debug','array is'.print_r($cashBookInfo,true));
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


// Cash Bank Neft  Report
function downloadBankReport(){
  //print page setup
   $this->excel->setActiveSheetIndex(0);
   $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
   $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
   $this->excel->getActiveSheet()->getPageSetup()->setFitToPage(true);
   $this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
   $this->excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);    
   $fromDate = $this->input->post('from_date');
   $toDate = $this->input->post('to_date');
   $transporter_name = $this->input->post('transporter_name');
   $party_name = $this->input->post('party_name');
   $bank_name = $this->input->post('bank_name');
  
   $bankInfo = $this->cash_book_model->getBankReport($fromDate,$toDate,$transporter_name,$party_name,$bank_name);
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
           $this->excel->getActiveSheet()->mergeCells('A1:F1');
           $this->excel->getActiveSheet()->setCellValue('A1', "KARAVALI TRANSPORT ");
           $this->excel->getActiveSheet()->mergeCells('A2:F2');
           $this->excel->getActiveSheet()->setCellValue('A2', "BANK IMPS/NEFT REPORT");
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
           $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setSize(12);
           $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->getStyle('D4')->getFont()->setSize(12);
           $this->excel->getActiveSheet()->getStyle('D4')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->mergeCells('A4:C4');
           $this->excel->getActiveSheet()->mergeCells('D4:F4');
             if($bank_name != 'ALL')
             {
              $this->excel->getActiveSheet()->setCellValue('A4', "Bank Name : ".$bank_Info->bank_name);
              $this->excel->getActiveSheet()->setCellValue('D4', "Account Number  : ".$bank_Info->bank_account_number);
             }else {
              $this->excel->getActiveSheet()->setCellValue('A4', "Bank Name : "."ALL");
              $this->excel->getActiveSheet()->setCellValue('D4', "Account Number  : "."ALL");
            }
           //   //font bold and text bold
             $this->excel->getActiveSheet()->getStyle('A5:F5')->getFont()->setBold(true);
            //horizontal and vertical alignment
         $this->excel->getActiveSheet()->getStyle('A5:F5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->getStyle('A5:F5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
             //set width for cell
             $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
             $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
             $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
             $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
             $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
             $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
           
            ;
           //   //report Header
           $this->cellColor('A5:F5', 'D5DBDB');
           $this->excel->getActiveSheet()->getStyle('A5')->applyFromArray($OutlineStyle);
           $this->excel->getActiveSheet()->getStyle('A5:F5')->applyFromArray($OutlineStyle);
           $this->excel->getActiveSheet()->setCellValue('A5', "Date");
           $this->excel->getActiveSheet()->setCellValue('B5', "Transporter/Pump Name");
           $this->excel->getActiveSheet()->setCellValue('C5', "Party Name");
           $this->excel->getActiveSheet()->setCellValue('D5', "Vehicle Number");
           $this->excel->getActiveSheet()->setCellValue('E5', "Bank");
           $this->excel->getActiveSheet()->setCellValue('F5', "Amount");
           $excel_row = 6;
          
         if(!empty($bankInfo))
         {
          foreach($bankInfo as $record)
           {
             //set row height for cell
                 //horizontal and vertical alignment
             if(!empty($record->credit) && $record->credit > 0) {
             $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
             $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
             $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, date('d-m-Y',strtotime($record->cash_date)));
             if($record->transporter_name != ""){
              $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->transporter_name);
             }else if($record->fuel_account_name != ""){
              $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->fuel_account_name);
             } else {
              $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->comments);
             }
            
             $this->excel->getActiveSheet()->setCellValue('C'.$excel_row, $record->party_name);
             $this->excel->getActiveSheet()->setCellValue('D'.$excel_row,$record->vehicle_number);
             $this->excel->getActiveSheet()->setCellValue('E'.$excel_row,$record->bank_name);
             $this->excel->getActiveSheet()->setCellValue('F'.$excel_row, $record->credit);
             $this->excel->getActiveSheet()->getStyle('A6:F'.$excel_row)->applyFromArray($OutlineStyle);
             $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:F'.$excel_row);
             $this->excel->getActiveSheet()->getStyle('A1:F'.$excel_row)->applyFromArray($styleArray);
             $excel_row++;
             }

             if(!empty($record->debit) && $record->debit > 0) {
              $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
              $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
              $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
              $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, date('d-m-Y',strtotime($record->cash_date)));
              if($record->transporter_name != ""){
                $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->transporter_name);
               }else if($record->fuel_account_name != ""){
                $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->fuel_account_name);
               } else {
                $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->comments);
               }
             
              $this->excel->getActiveSheet()->setCellValue('C'.$excel_row, $record->party_name);
              $this->excel->getActiveSheet()->setCellValue('D'.$excel_row,$record->vehicle_number);
              $this->excel->getActiveSheet()->setCellValue('E'.$excel_row,$record->bank_name);
              $this->excel->getActiveSheet()->setCellValue('F'.$excel_row, $record->debit);
              $this->excel->getActiveSheet()->getStyle('A6:F'.$excel_row)->applyFromArray($OutlineStyle);
              $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:F'.$excel_row);
              $this->excel->getActiveSheet()->getStyle('A1:F'.$excel_row)->applyFromArray($styleArray);
              $excel_row++;
              }
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

// Cash Book  Report
function cashBookReport() {
  $this->excel->setActiveSheetIndex(0);
  $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
  $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
  $this->excel->getActiveSheet()->getPageSetup()->setFitToPage(true);
  $this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
  $this->excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);    
  $fromDate = $this->input->post('from_date');
  $toDate = $this->input->post('to_date');
  $cash_account_rowid = $this->input->post('cash_account_rowid');
 
  //to get db start date of tbl_cash_expenses
  $db_start_date = $this->cash_book_model->getStartDate($cash_account_rowid);
  $start_date = date('Y-m-d', strtotime($db_start_date->cash_date));



  //to get end date
  $end_date = date('Y-m-d', strtotime('-1 day', strtotime($fromDate)));

  // $end_date = date('Y-m-d', strtotime('-1 day'));

   //debit sum
  $sumOfDebit = $this->cash_book_model->getsumOfDebit($start_date, $end_date, $cash_account_rowid);
  //log_message('debug','log_date=='.$sumOfDebit);
  //credit sum
  $sumOfCredit = $this->cash_book_model->getSumOfCredit($start_date, $end_date,$cash_account_rowid);

  //opening balance
  $opening_balance = $sumOfDebit - $sumOfCredit;
 
  $styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
  $this->excel->setActiveSheetIndex(0);
  //name the worksheet
  $this->excel->getActiveSheet()->setTitle('KARAVALI worksheet');
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
            
          $this->excel->getActiveSheet()->mergeCells('A1:G1');
          $this->excel->getActiveSheet()->setCellValue('A1', "KARAVALI TRANSPORT");
          $this->excel->getActiveSheet()->mergeCells('A2:G2');
          $this->excel->getActiveSheet()->setCellValue('A2', "CASH BOOK REPORT");
          $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
          $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
          $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
          $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
          $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $this->excel->getActiveSheet()->getStyle('A1:G2')->applyFromArray($OutlineStyle);
          $this->excel->getActiveSheet()->getStyle('A3:G3')->applyFromArray($OutlineStyle);
          $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $this->excel->getActiveSheet()->mergeCells('A3:G3');
          $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
          $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
          $this->excel->getActiveSheet()->setCellValue('A3', "Date From : ".$fromDate. " To : " .$toDate);
          //font bold and text bold
            $this->excel->getActiveSheet()->getStyle('A4:G4')->getFont()->setBold(true);
          //horizontal and vertical alignment
          $this->excel->getActiveSheet()->getStyle('A4:G4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $this->excel->getActiveSheet()->getStyle('A4:G4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
              //set width for cell
              $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
              $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
              $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
              $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
              $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
              $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
              $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
             
            //   //report Header
            $this->cellColor('A4:G4', 'D5DBDB');
            $this->excel->getActiveSheet()->getStyle('A4')->applyFromArray($OutlineStyle);
            $this->excel->getActiveSheet()->getStyle('A4:G4')->applyFromArray($OutlineStyle);
            $this->excel->getActiveSheet()->setCellValue('A4', "Date");
            $this->excel->getActiveSheet()->setCellValue('B4', "Description");
            $this->excel->getActiveSheet()->setCellValue('C4', "Cash A/C Name");
            $this->excel->getActiveSheet()->setCellValue('D4', "Vehicle Number");
            $this->excel->getActiveSheet()->setCellValue('E4', "Debit");
            $this->excel->getActiveSheet()->setCellValue('F4', "Credit");
           
            $excel_row = 5;
            $credit_balance_total = 0;
            $cashLedgerCashBookInfo = $this->cash_book_model->getCashLedgerCashBookInfo($fromDate,$toDate,$cash_account_rowid);
            $transportCashBookInfo = $this->cash_book_model->getTransportCashBookInfo($fromDate,$toDate,$cash_account_rowid);
            $cashTransferCreditInfo = $this->cash_book_model->getTotalCashCreditInfoTransfer($fromDate,$toDate,$cash_account_rowid);
           //add opening balance to balance sheet
            $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':G' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':G' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
          
            $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, date('d-m-Y',strtotime($fromDate)));
            $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,"Balance B/D");
            $this->excel->getActiveSheet()->setCellValue('C'.$excel_row,"");
            $this->excel->getActiveSheet()->setCellValue('D'.$excel_row, "");
            $this->excel->getActiveSheet()->setCellValue('E'.$excel_row,$opening_balance);
            $this->excel->getActiveSheet()->setCellValue('F'.$excel_row, "");
            $this->excel->getActiveSheet()->getStyle('A5:G'.$excel_row)->applyFromArray($OutlineStyle);
            $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:G'.$excel_row);
            $this->excel->getActiveSheet()->getStyle('A1:G'.$excel_row)->applyFromArray($styleArray);
            $excel_row++;
           
            $cash_debit_info = 0;
            $cashDebitInfo = $this->cash_book_model->getTotalCashDebitInfo($fromDate,$toDate,$cash_account_rowid);
            if(!empty($cashDebitInfo))
            {
             foreach($cashDebitInfo as $debit)
              {
                $cash_debit_info += $debit->debit;
                $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':G' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':G' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
              
                $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, date('d-m-Y',strtotime($debit->cash_date)));
              
                if(!empty($debit->comments)){
                  $this->excel->getActiveSheet()->setCellValue('B'.$excel_row, $debit->comments);
                }else{
                  $this->excel->getActiveSheet()->setCellValue('B'.$excel_row, $debit->debit_comments); 
                }
                $this->excel->getActiveSheet()->setCellValue('C'.$excel_row, $debit->cash_account_name);
                $this->excel->getActiveSheet()->setCellValue('D'.$excel_row, "");
              
                $this->excel->getActiveSheet()->setCellValue('E'.$excel_row,$debit->debit);
                $this->excel->getActiveSheet()->setCellValue('F'.$excel_row, "");
                $this->excel->getActiveSheet()->getStyle('A5:G'.$excel_row)->applyFromArray($OutlineStyle);
                $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:G'.$excel_row);
                $this->excel->getActiveSheet()->getStyle('A1:G'.$excel_row)->applyFromArray($styleArray);
                $excel_row++;
              }
            }


            if(!empty($cashTransferCreditInfo))
            {
             foreach($cashTransferCreditInfo as $record)
              {
                //set row height for cell
                $credit_balance_total += $record->credit;
                $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
              
                $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, date('d-m-Y',strtotime($record->cash_date)));
                $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,"Cash Transferred - (".$record->debit_comments.")");
                $this->excel->getActiveSheet()->setCellValue('C'.$excel_row,$record->cash_account_name);
                $this->excel->getActiveSheet()->setCellValue('D'.$excel_row, "");
             
                $this->excel->getActiveSheet()->setCellValue('E'.$excel_row,"");
                $this->excel->getActiveSheet()->setCellValue('F'.$excel_row, $record->credit);
                $this->excel->getActiveSheet()->getStyle('A5:G'.$excel_row)->applyFromArray($OutlineStyle);
                $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:G'.$excel_row);
                $this->excel->getActiveSheet()->getStyle('A1:G'.$excel_row)->applyFromArray($styleArray);
                $excel_row++;        
              }
            }

          if(!empty($cashLedgerCashBookInfo))
          {
           foreach($cashLedgerCashBookInfo as $record)
            {
              //set row height for cell
              $credit_balance_total += $record->credit;
              $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':G' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
              $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':G' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
              $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
            
              $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, date('d-m-Y',strtotime($record->cash_date)));
              $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->party_name.'('.$record->reason.')');
              $this->excel->getActiveSheet()->setCellValue('C'.$excel_row,$record->cash_account_name);
              $this->excel->getActiveSheet()->setCellValue('D'.$excel_row, "");
            
              $this->excel->getActiveSheet()->setCellValue('E'.$excel_row,"");
              $this->excel->getActiveSheet()->setCellValue('F'.$excel_row, $record->credit);
              $this->excel->getActiveSheet()->getStyle('A5:G'.$excel_row)->applyFromArray($OutlineStyle);
              $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:G'.$excel_row);
              $this->excel->getActiveSheet()->getStyle('A1:G'.$excel_row)->applyFromArray($styleArray);
              $excel_row++;        
            }
          }

          if(!empty($transportCashBookInfo))
          {
           foreach($transportCashBookInfo as $record)
            {
              //set row height for cell
              $credit_balance_total += $record->credit;
              $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':G' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
              $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':G' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
              $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
            
              $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, date('d-m-Y',strtotime($record->date)));
              if(!empty($record->comments)){
                $comments = $record->comments;
              }else{
                $comments = $record->narration;
              }
              $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$comments);
              $this->excel->getActiveSheet()->setCellValue('C'.$excel_row,$record->cash_account_name);
              $this->excel->getActiveSheet()->setCellValue('D'.$excel_row, $record->vehicle_number);
             
              $this->excel->getActiveSheet()->setCellValue('E'.$excel_row,"");
              $this->excel->getActiveSheet()->setCellValue('F'.$excel_row, $record->credit);
              $this->excel->getActiveSheet()->getStyle('A5:G'.$excel_row)->applyFromArray($OutlineStyle);
              $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:G'.$excel_row);
              $this->excel->getActiveSheet()->getStyle('A1:G'.$excel_row)->applyFromArray($styleArray);
              $excel_row++;
            }
          }
          $fuelCashInfo = $this->cash_book_model->getFuelCashInfoDetails($fromDate,$toDate,$cash_account_rowid);
          if(!empty($fuelCashInfo))
          {
           foreach($fuelCashInfo as $record)
            {
              //set row height for cell
              $credit_balance_total += $record->credit;
              $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':G' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
              $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':G' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
              $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
            
              $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, date('d-m-Y',strtotime($record->date)));
              if(!empty($record->comments)){
                $comments = $record->comments;
              }else{
                $comments = "For Fuel Account Credited";
              }
              $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$comments);
              $this->excel->getActiveSheet()->setCellValue('C'.$excel_row,$record->cash_account_name);
              $this->excel->getActiveSheet()->setCellValue('D'.$excel_row, "");
             
              $this->excel->getActiveSheet()->setCellValue('E'.$excel_row,"");
              $this->excel->getActiveSheet()->setCellValue('F'.$excel_row, $record->credit);
              $this->excel->getActiveSheet()->getStyle('A5:G'.$excel_row)->applyFromArray($OutlineStyle);
              $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:G'.$excel_row);
              $this->excel->getActiveSheet()->getStyle('A1:G'.$excel_row)->applyFromArray($styleArray);
              $excel_row++;
            }
          }

          $total_debit_balance = $cash_debit_info + $opening_balance;
          $closing_balance_total = $total_debit_balance - $credit_balance_total;
          $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':G' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':G' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
          $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
        
          $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, "");
          $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,"Closing C/D");
          $this->excel->getActiveSheet()->setCellValue('C'.$excel_row,"");
          $this->excel->getActiveSheet()->setCellValue('D'.$excel_row, "");
          
          $this->excel->getActiveSheet()->setCellValue('E'.$excel_row,"");
          $this->excel->getActiveSheet()->setCellValue('F'.$excel_row, $closing_balance_total);
          $this->excel->getActiveSheet()->getStyle('A5:G'.$excel_row)->applyFromArray($OutlineStyle);
          $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:G'.$excel_row);
          $this->excel->getActiveSheet()->getStyle('A1:G'.$excel_row)->applyFromArray($styleArray);
          $excel_row++;
          $credit_total_value = $credit_balance_total + $closing_balance_total; 
          //log_message('debug','credit_total==='.$credit_total_value);
          $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':G' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':G' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
          $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
        
          $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, "");
          $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,"Total");
          $this->excel->getActiveSheet()->setCellValue('C'.$excel_row, "");
          $this->excel->getActiveSheet()->setCellValue('D'.$excel_row, "");
        
          $this->excel->getActiveSheet()->setCellValue('E'.$excel_row, $total_debit_balance);
          $this->excel->getActiveSheet()->setCellValue('F'.$excel_row, $credit_total_value);
          $this->excel->getActiveSheet()->getStyle('A5:G'.$excel_row)->applyFromArray($OutlineStyle);
          $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:G'.$excel_row);
          $this->excel->getActiveSheet()->getStyle('A1:G'.$excel_row)->applyFromArray($styleArray);
        
 
          
          // log_message('debug','cash ledger:'.print_r($cashLedgerCashBookInfo,true));
          // log_message('debug','transport:'.print_r( $transportCashBookInfo,true));
          // log_message('debug','debit:'.print_r( $cashDebitInfo,true));
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