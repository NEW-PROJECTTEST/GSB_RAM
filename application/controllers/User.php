<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class User extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('excel');
        $this->isLoggedIn();   
    }
    
    /**
     * Page not found : error 404
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }

    /**
     * This function used to show login history
     * @param number $userId : This is user id
     */
    function loginHistoy($userId = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $userId = ($userId == NULL ? 0 : $userId);

            $searchText = $this->input->post('searchText');
            $fromDate = $this->input->post('fromDate');
            $toDate = $this->input->post('toDate');

            $data["userInfo"] = $this->user_model->getUserInfoById($userId);

            $data['searchText'] = $searchText;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->loginHistoryCount($userId, $searchText, $fromDate, $toDate);

            $returns = $this->paginationCompress ( "login-history/".$userId."/", $count, 10, 3);

            $data['userRecords'] = $this->user_model->loginHistory($userId, $searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'CodeInsect : User Login History';
            
            $this->loadViews("loginHistory", $this->global, $data, NULL);
        }        
    }

  
public function downloadUserLoginReport(){
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
    $this->excel->getActiveSheet()->getPageSetup()->setFitToPage(true);
    $this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
    $this->excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);    
    $fromDate = $this->input->post('from_date');
    $toDate = $this->input->post('to_date');
    // $transporter_name = $this->input->post('transporter_name');
    // $party_name = $this->input->post('party_name');
    // $bank_name = $this->input->post('bank_name');
   
    // $bankInfo = $this->cash_book_model->getBankReport($fromDate,$toDate,$transporter_name,$party_name,$bank_name);
    // $bank_Info =$this->bank_model->getBankInformation($bank_name);
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
            $this->excel->getActiveSheet()->setCellValue('A2', "USER LOGIN REPORT");
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
            $this->excel->getActiveSheet()->setCellValue('A5', "Employee ID");
            $this->excel->getActiveSheet()->setCellValue('B5', "Name");
            $this->excel->getActiveSheet()->setCellValue('C5', "Login Date & Time");
            $this->excel->getActiveSheet()->setCellValue('D5', "Browser Info");
            $this->excel->getActiveSheet()->setCellValue('E5', "Operating Sys");
            
            $excel_row = 6;
           $userInfo = $this->user_model->loginHistory($fromDate, $toDate);
          if(!empty($userInfo))
          {
           foreach($userInfo as $record)
            {
              $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
              $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':F' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
              $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
              $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, $record->employee_id);
              $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->employee_name);
              $this->excel->getActiveSheet()->setCellValue('C'.$excel_row, $record->createdDtm);
              $this->excel->getActiveSheet()->setCellValue('D'.$excel_row,$record->userAgent);
              $this->excel->getActiveSheet()->setCellValue('E'.$excel_row,$record->platform);
           
              $this->excel->getActiveSheet()->getStyle('A6:F'.$excel_row)->applyFromArray($OutlineStyle);
              $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:F'.$excel_row);
              $this->excel->getActiveSheet()->getStyle('A1:F'.$excel_row)->applyFromArray($styleArray);
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