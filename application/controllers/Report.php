<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require_once 'vendor/autoload.php';

class Report extends BaseController
{
     /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('own_vehicle_model');
        // $this->load->model('cash_account_model');
        // $this->load->model('lease_vehicle_model');
        // $this->load->model('transporter_model');
        // $this->load->model('party_model');
        $this->load->model('Bank_model');
        $this->load->model('asset_model');
        $this->load->model('committee_model');
        $this->load->model('Devotee_model');
        $this->load->model('DailyPooja_model');
        $this->load->model('expenses_model');
        $this->load->model('Event_model');
        $this->load->model('setting_model','settings');

        $this->load->library('excel');
        $this->isLoggedIn();      
    }
   
    /**
     * View Overall report
    */
    public function report()
    {
     if ($this->isAdmin() == true ) {
         $this->loadThis();
     } else {
        //  $data['vehicles'] = $this->lease_vehicle_model->getAllLeaseVehicles($this->company_id);
        //  $data['ownVehicles'] = $this->own_vehicle_model->getAllOwnVehicles($this->company_id);
        //  $data['transporters'] = $this->transporter_model->getAllTransporters($this->company_id);
        //  $data['cashAccount'] = $this->cash_account_model->getAllCashAccounts($this->company_id);
        //  $data['getAllPumpInfo'] = $this->fuel_model->getAllPumpInfo($this->company_id);
        //  $data['party'] = $this->party_model->getAllParty($this->company_id);
        //  $data['bank'] = $this->Bank_model->getAllBank($this->company_id);
        $data['tithiInfo'] =$this->DailyPooja_model->getTithiInfo($this->company_id); 
        $data['masaInfo'] =$this->DailyPooja_model->getMasaInfo($this->company_id);  
        $data['eventInfo'] =$this->Event_model->getEventInfo($this->company_id); 
        $data['purposeInfo'] = $this->settings->getAllPurposeInfo($this->company_id);
        $data['committeeInfo'] = $this->settings->getAllCommittetypeInfo($this->company_id);
        $data['donationTypeInfo'] = $this->settings->getAllDonationTypeInfo($this->company_id);

        //  $data="";
         $this->global['pageTitle'] = $this->company_name.' : Report ';
         $this->loadViews("report/report", $this->global,$data,null);
        }
    }


    public function downloadAsset(){
        if ($this->isAdmin() == true ) {
            setcookie('isDownLoaded',1);  
            $this->loadThis();
        } else {
            $filter = array();
            $purchase_fromDate = $this->security->xss_clean($this->input->post('purchase_fromDate'));
            $purchase_toDate = $this->security->xss_clean($this->input->post('purchase_toDate'));
            $cellNameByStudentReport = array('G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
            $sheet = 0;
                $this->excel->setActiveSheetIndex($sheet);
                $this->excel->getActiveSheet()->setTitle($sheet);
                $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:N500');
                $this->excel->getActiveSheet()->setCellValue('A1', EXCEL_TITLE);
                $this->excel->getActiveSheet()->setCellValue('A2',"Asset Report");
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
                $this->excel->getActiveSheet()->mergeCells('A1:F1');
                $this->excel->getActiveSheet()->mergeCells('A2:F2');
                $this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A2:F2')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('A1:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
                $excel_row = 3;
                $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
                $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
                $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
                $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(28);
                
                $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
                $this->excel->getActiveSheet()->getStyle('A3:N3')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A3:N3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, 'SL No.');
                $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, 'Name');
                $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row, 'Invoice No');
                $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, 'Purchase Date');
                $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, 'Purchase Amount');
                $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, 'Depreciated Amount');
                $filter['report_type']= "Asset";
                // $filter['stream_name']= $stream[$sheet];
                if(!empty($purchase_fromDate)) {
                $filter['purchase_fromDate']= date('Y-m-d',strtotime($purchase_fromDate));
                }
                else{
                    $filter['purchase_fromDate'] = ''; 
                }
                if(!empty($purchase_toDate)) {
                $filter['purchase_toDate']=  date('Y-m-d',strtotime($purchase_toDate));
                }
                else{
                    $filter['purchase_toDate']= '';
                }


                $sl = 1;
                $excel_row = 4;
                $assetInfo = $this->asset_model->assetInfoForReport($filter,$this->company_id);
                    foreach($assetInfo as $asset){
                        if($asset->purchase_date=="1970-01-01")
                        {
                            $purchased_date = '';
                        }
                        else
                        {
                            $purchased_date = date('d-m-Y',strtotime($asset->purchase_date)) ; 
                        }
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, $sl++);
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, $asset->asset_name);
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row,$asset->invoice_no);
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, $purchased_date);
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, $asset->purchase_amount);
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, $this->asset_model->getDepreciationAmountByAsset($asset->row_id));
                        $this->excel->getActiveSheet()->getStyle('A'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $this->excel->getActiveSheet()->getStyle('C'.$excel_row.':F'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $excel_row++;
                    }
                    $this->excel->createSheet(); 
                // }
                
            }
            
            $filename ='Asset_Report_-'.date('d-m-Y').'.xls'; //save our workbook as this file name
            header('Content-Type: application/vnd.ms-excel'); //mime type
            header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
            header('Cache-Control: max-age=0'); //no cache
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            ob_start();
            setcookie('isDownLoaded',1);  
            $objWriter->save("php://output");
            
        }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function downloadDevotee(){
    if ($this->isAdmin() == true ) {
        setcookie('isDownLoaded',1);  
        $this->loadThis();
    } else {
        $filter = array();
        error_reporting(0);
        $purchase_fromDate = $this->security->xss_clean($this->input->post('purchase_fromDate'));
        $purchase_toDate = $this->security->xss_clean($this->input->post('purchase_toDate'));
        $post_status = $this->security->xss_clean($this->input->post('post_status'));
        $reportFormat = $this->security->xss_clean($this->input->post('reportFormat'));

        $cellNameByStudentReport = array('G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

        $filter['post_status']= $post_status;
        // $filter['stream_name']= $stream[$sheet];
        if(!empty($purchase_fromDate)) {
        $filter['purchase_fromDate']= date('Y-m-d',strtotime($purchase_fromDate));
        }
        else{
            $filter['purchase_fromDate'] = ''; 
        }
        if(!empty($purchase_toDate)) {
        $filter['purchase_toDate']=  date('Y-m-d',strtotime($purchase_toDate));
        }
        else{
            $filter['purchase_toDate']= '';
        }

        if($reportFormat == 'VIEW'){
            $data['dt_filter'] = $filter;
            $data['company_id'] = $this->company_id;
            $data['devotee_model'] = $this->Devotee_model;
            $this->global['pageTitle'] = ''.EXCEL_TITLE.' : DEVOTEE REPORT';
            $mpdf = new \Mpdf\Mpdf(['tempDir' => sys_get_temp_dir().DIRECTORY_SEPARATOR.'mpdf','default_font' => 'timesnewroman']);
            $mpdf->AddPage('P','','','','',10,10,10,10,8,8);
            $mpdf->SetTitle('DEVOTEE REPORT');
            $html = $this->load->view('report/devoteeView',$data,true);
            $mpdf->WriteHTML($html);
            $mpdf->Output('Devotee_Report.pdf', 'I');
        }else{
        $sheet = 0;
            $this->excel->setActiveSheetIndex($sheet);
            $this->excel->getActiveSheet()->setTitle($sheet);
            $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:N500');
            $this->excel->getActiveSheet()->setCellValue('A1', EXCEL_TITLE);
            $this->excel->getActiveSheet()->setCellValue('A2',"Devotee Report");
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
            $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
            $this->excel->getActiveSheet()->mergeCells('A1:F1');
            $this->excel->getActiveSheet()->mergeCells('A2:F2');
            $this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A2:F2')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('A1:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            
            $excel_row = 3;
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(28);
            
            $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
            $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(35);
            $this->excel->getActiveSheet()->getStyle('A3:N3')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A3:N3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, 'SL No.');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, 'Devotee name');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row, 'Devotee_id');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, 'Email');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, 'Gender');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, 'Contact number');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, 'Devotee address');
            
        

            $sl = 1;
            $excel_row = 4;
            $assetInfo = $this->Devotee_model->devoteeInfoForReport($filter,$this->company_id);
                foreach($assetInfo as $asset){
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, $sl++);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, $asset->devotee_name);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row,$asset->devotee_id);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, $asset->email);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, $asset->gender);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, $asset->contact_number);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, $asset->devotee_name.', '.$asset->devotee_address.' , PH: '.$asset->contact_number);

                    //$this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, $this->asset_model->getDepreciationAmountByAsset($asset->row_id));
                    $this->excel->getActiveSheet()->getStyle('A'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('C'.$excel_row.':F'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $excel_row++;
                }
                $this->excel->createSheet(); 
            // }
            
        
        
        $filename ='Devotee_Report_-'.date('d-m-Y').'.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        ob_start();
        setcookie('isDownLoaded',1);  
        $objWriter->save("php://output");
            }
    } 
    }

    public function downloadBank(){
        if ($this->isAdmin() == true ) {
            setcookie('isDownLoaded',1);  
            $this->loadThis();
        } else {
            $filter = array();
            $purchase_fromDate = $this->security->xss_clean($this->input->post('purchase_fromDate'));
            $purchase_toDate = $this->security->xss_clean($this->input->post('purchase_toDate'));
            $cellNameByStudentReport = array('G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
            $sheet = 0;
            $this->excel->setActiveSheetIndex($sheet);
            $this->excel->getActiveSheet()->setTitle($sheet);
            $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:N500');
            $this->excel->getActiveSheet()->setCellValue('A1', EXCEL_TITLE);
            $this->excel->getActiveSheet()->setCellValue('A2',"Bank transaction Report");
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
            $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
            $this->excel->getActiveSheet()->mergeCells('A1:F1');
            $this->excel->getActiveSheet()->mergeCells('A2:F2');
            $this->excel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A2:F2')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('A1:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            
            $excel_row = 3;
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(28);
            
            $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
            $this->excel->getActiveSheet()->getStyle('A3:N3')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A3:N3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, 'SL No.');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, 'Bank name');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row, 'Particular');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, 'Amount');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, 'Company id');
            $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, 'Transaction type');
            // $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, 'Devotee address');
            
            $filter['report_type']= "Asset";
            // $filter['stream_name']= $stream[$sheet];
            if(!empty($purchase_fromDate)) {
            $filter['purchase_fromDate']= date('Y-m-d',strtotime($purchase_fromDate));
            }
            else{
                $filter['purchase_fromDate'] = ''; 
            }
            if(!empty($purchase_toDate)) {
            $filter['purchase_toDate']=  date('Y-m-d',strtotime($purchase_toDate));
            }
            else{
                $filter['purchase_toDate']= '';
            }


            $sl = 1;
            $excel_row = 4;
            
            $bankTInfo = $this->Bank_model->bankInfoForReport();
                foreach($bankTInfo as $bank){
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, $sl++);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, $bank->bank_name);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row,$bank->particular);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, $bank->amount);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, $bank->company_id);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, $bank->trans_type);
                    // $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, $asset->devotee_address);

                    //$this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, $this->asset_model->getDepreciationAmountByAsset($asset->row_id));
                    $this->excel->getActiveSheet()->getStyle('A'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('C'.$excel_row.':F'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $excel_row++;
                }
                $this->excel->createSheet(); 
                // }
                
            }
            
            $filename ='Bank_transaction_Report_-'.date('d-m-Y').'.xls'; //save our workbook as this file name
            header('Content-Type: application/vnd.ms-excel'); //mime type
            header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
            header('Cache-Control: max-age=0'); //no cache
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            ob_start();
            setcookie('isDownLoaded',1);  
            $objWriter->save("php://output");
            
        }
    

    //////////////////////////////////////////////////////////////////////////////////////////////////////

        public function downloadCommitteeReport(){
            if ($this->isAdmin() == true ) {
                setcookie('isDownLoaded',1);  
                $this->loadThis();
            } else {
                $filter = array();
                $purchase_fromDate = $this->security->xss_clean($this->input->post('purchase_fromDate'));
                $purchase_toDate = $this->security->xss_clean($this->input->post('purchase_toDate'));
                $cellNameByStudentReport = array('G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
                $sheet = 0;
                    $this->excel->setActiveSheetIndex($sheet);
                    $this->excel->getActiveSheet()->setTitle($sheet);
                    $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:N500');
                    $this->excel->getActiveSheet()->setCellValue('A1', EXCEL_TITLE);
                    $this->excel->getActiveSheet()->setCellValue('A2',"Committee Report");
                    $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                    $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
                    $this->excel->getActiveSheet()->mergeCells('A1:H1');
                    $this->excel->getActiveSheet()->mergeCells('A2:H2');
                    $this->excel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('A2:H2')->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('A1:H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    $excel_row = 3;
                    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
                    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
                    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
                    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
                    
                    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
                    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(35);
                    $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
                    $this->excel->getActiveSheet()->getStyle('A3:H3')->getFont()->setBold(true);
                    $this->excel->getActiveSheet()->getStyle('A3:H3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, 'SL No.');
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, 'Name');
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row, 'Contact Number One');
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, 'Contact Number Two');
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, 'Role');
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, 'Address');
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, 'Email');
                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('H'.$excel_row, 'Year');

                    $filter['report_type']= "Asset";
                    // $filter['stream_name']= $stream[$sheet];
                   
    
                    $sl = 1;
                    $excel_row = 4;
                    $committeeInfo = $this->committee_model->committeeInfoForReport($this->company_id);
                        foreach($committeeInfo as $committee){
                        
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, $sl++);
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, $committee->committee_name);
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row,$committee->contact_number_one);
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, $committee->contact_number_two);
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, $committee->role);
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, $committee->committee_address);
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, $committee->email);
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('H'.$excel_row, $committee->year);
                            $this->excel->getActiveSheet()->getStyle('A'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $this->excel->getActiveSheet()->getStyle('C'.$excel_row.':E'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $this->excel->getActiveSheet()->getStyle('H'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $excel_row++;
                        }
                        $this->excel->createSheet(); 
                    // }
                    
                }
                
                $filename ='Committee_Report_-'.date('d-m-Y').'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                ob_start();
                setcookie('isDownLoaded',1);  
                $objWriter->save("php://output");
                
            }
    


            public function downloadDailyPoojaReport(){
                if ($this->isAdmin() == true ) {
                    setcookie('isDownLoaded',1);  
                    $this->loadThis();
                } else {
                    $filter = array();
                    $pooja_fromDate = $this->security->xss_clean($this->input->post('pooja_fromDate'));
                    $pooja_toDate = $this->security->xss_clean($this->input->post('pooja_toDate'));
                    if(!empty($pooja_fromDate)) {
                        $filter['pooja_fromDate']= date('Y-m-d',strtotime($pooja_fromDate));
                        }
                        else{
                            $filter['pooja_fromDate'] = ''; 
                        }
                        if(!empty($pooja_toDate)) {
                        $filter['pooja_toDate']=  date('Y-m-d',strtotime($pooja_toDate));
                        }

                    $cellNameByStudentReport = array('G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
                    $sheet = 0;
                        $this->excel->setActiveSheetIndex($sheet);
                        $this->excel->getActiveSheet()->setTitle($sheet);
                        $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:N500');
                        $this->excel->getActiveSheet()->setCellValue('A1', EXCEL_TITLE);
                        $this->excel->getActiveSheet()->setCellValue('A2',"Date Pooja Report");
                        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
                        $this->excel->getActiveSheet()->mergeCells('A1:J1');
                        $this->excel->getActiveSheet()->mergeCells('A2:J2');
                        $this->excel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->getStyle('A2:J2')->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->getStyle('A1:J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $this->excel->getActiveSheet()->getStyle('A1:J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        
                        $excel_row = 3;
                        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
                        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
                        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
                        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
                        
                        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
                        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
                        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
                        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
                        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(25);

                        $this->excel->getActiveSheet()->getStyle('A3:J3')->getFont()->setBold(true);
                        $this->excel->getActiveSheet()->getStyle('A3:J3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, 'SL No.');
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, 'Seva By');
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row, 'Event Type');
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, 'Date');
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, 'Nakshatra');
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, 'Rashi');
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, 'Gothra');
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('H'.$excel_row, 'Ocassion');
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('I'.$excel_row, 'Amount');
                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('J'.$excel_row, 'Remarks');
    
                        // $filter['report_type']= "Asset";
                        // $filter['stream_name']= $stream[$sheet];
                       
        
                        $sl = 1;
                        $excel_row = 4;
                        $dpInfo = $this->DailyPooja_model->getDPDetailsForReport($filter);
                        foreach($dpInfo as $dp){
                            if(empty($dp->date) || $dp->date == '1970-01-01'){
                              $event_date = '';
                            }else{
                                $event_date = $dp->date.'-'.date('Y');       
                            }
                            
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, $sl++);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, $dp->devotee_name);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row, $dp->event_type);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, $event_date);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, $dp->nakshathra);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, $dp->rashi);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, $dp->gothra);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('H'.$excel_row, $dp->occation);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('I'.$excel_row, $dp->amount);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('J'.$excel_row, $dp->remarks);
                                $this->excel->getActiveSheet()->getStyle('A'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                $this->excel->getActiveSheet()->getStyle('C'.$excel_row.':J'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                // $this->excel->getActiveSheet()->getStyle('H'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                $excel_row++;
                            }
                            $this->excel->createSheet(); 
                        // }
                        
                    }
                    
                    $filename ='Date_Pooja_Report_-'.date('d-m-Y').'.xls'; //save our workbook as this file name
                    header('Content-Type: application/vnd.ms-excel'); //mime type
                    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                    header('Cache-Control: max-age=0'); //no cache
                    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                    ob_start();
                    setcookie('isDownLoaded',1);  
                    $objWriter->save("php://output");
                    
                }






                public function downloadDailyPoojaMonthWiseReport(){
                    if ($this->isAdmin() == true ) {
                        setcookie('isDownLoaded',1);  
                        $this->loadThis();
                    } else {
                        $filter = array();
                        error_reporting(0);
                        $pooja_month = $this->security->xss_clean($this->input->post('pooja_month'));
                        $month_date = $this->security->xss_clean($this->input->post('month_date'));
                        $reportFormat = $this->security->xss_clean($this->input->post('reportFormat'));
                        if(!empty($month_date)) {
                            $filter['month_date']= date('d-m',strtotime($month_date));
                            }

                        // if($pooja_month == 'NOVEMBER'){
                        //     $pooja_date = '01-11';
                        // }else{
                        //     $pooja_date = '';  
                        // }

                        if($reportFormat == 'VIEW'){
                            $data['dt_filter'] = $filter;
                            $data['pooja_month'] = $pooja_month;
                            $data['company_id'] = $this->company_id;
                            $data['DailyPooja_model'] = $this->DailyPooja_model;
                            $this->global['pageTitle'] = ''.EXCEL_TITLE.' : YEARLY POOJA';
                            $mpdf = new \Mpdf\Mpdf(['tempDir' => sys_get_temp_dir().DIRECTORY_SEPARATOR.'mpdf','default_font' => 'timesnewroman','format' => [400, 160]]);
                            $mpdf->AddPage('P','','','','',10,10,10,10,8,8);
                            $mpdf->SetTitle('DAILY POOJA');
                            $html = $this->load->view('report/dailyPoojaView',$data,true);
                            $mpdf->WriteHTML($html);
                            $mpdf->Output('YearlyPooja_Report.pdf', 'I');
                        }else{
                           
                        $cellNameByStudentReport = array('G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
                        $sheet = 0;
                            $this->excel->setActiveSheetIndex($sheet);
                            $this->excel->getActiveSheet()->setTitle($sheet);
                            $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:N500');
                            $this->excel->getActiveSheet()->setCellValue('A1', EXCEL_TITLE);
                            $this->excel->getActiveSheet()->setCellValue('A2',"Date Pooja Month Wise Report");
                            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                            $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
                            $this->excel->getActiveSheet()->mergeCells('A1:L1');
                            $this->excel->getActiveSheet()->mergeCells('A2:L2');
                            $this->excel->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
                            $this->excel->getActiveSheet()->getStyle('A2:L2')->getFont()->setBold(true);
                            $this->excel->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $this->excel->getActiveSheet()->getStyle('A1:L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            
                            $excel_row = 3;
                            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
                            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
                            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
                            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
                            
                            $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
                            $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
                            $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
                            $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
                            $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
                            $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
                            $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(25);
    
                            $this->excel->getActiveSheet()->getStyle('A3:L3')->getFont()->setBold(true);
                            $this->excel->getActiveSheet()->getStyle('A3:L3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, 'SL No.');
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, 'Receipt No.');
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row, 'Seva By');
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, 'Pooja Type');
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, 'Date');
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, 'Nakshatra');
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, 'Rashi');
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('H'.$excel_row, 'Gothra');
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('I'.$excel_row, 'Ocassion');
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('J'.$excel_row, 'Remarks');
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('K'.$excel_row, 'Amount');
                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('L'.$excel_row, 'Created Date');
        
                            // $filter['report_type']= "Asset";
                            // $filter['stream_name']= $stream[$sheet];
                           
            
                            $sl = 1;
                            $excel_row = 4;
                            $dpInfo = $this->DailyPooja_model->getDPDetailsMonthForReport($pooja_month,$filter);
                            foreach($dpInfo as $dp){
                                if(empty($dp->date) || $dp->date == '1970-01-01'){
                                  $event_date = '';
                                }else{
                                    $event_date = $dp->date.'-'.date('Y');       
                                }
                                
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, $sl++);
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, $dp->row_id);
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row, $dp->devotee_name);
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, $dp->event_type);
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, $event_date);
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, $dp->nakshathra);
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, $dp->rashi);
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('H'.$excel_row, $dp->gothra);
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('I'.$excel_row, $dp->occation);
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('J'.$excel_row, $dp->remarks);
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('K'.$excel_row, $dp->amount);
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('L'.$excel_row, date('d-m-Y',strtotime($dp->created_date_time)));
                                    $this->excel->getActiveSheet()->getStyle('A'.$excel_row.':B'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    $this->excel->getActiveSheet()->getStyle('D'.$excel_row.':J'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    $this->excel->getActiveSheet()->getStyle('K'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    $this->excel->getActiveSheet()->getStyle('L'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    // $this->excel->getActiveSheet()->getStyle('H'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    $excel_row++;
                                }
                                $this->excel->createSheet(); 
                            // }
                            
                       
                        
                        $filename ='Date_Pooja_Report_'.date('d-m-Y').'.xls'; //save our workbook as this file name
                        header('Content-Type: application/vnd.ms-excel'); //mime type
                        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                        header('Cache-Control: max-age=0'); //no cache
                        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                        ob_start();
                        setcookie('isDownLoaded',1);  
                        $objWriter->save("php://output");
                    }
                 }
                        
                    }





                    public function downloadPanchangaPoojaReport(){
                        if ($this->isAdmin() == true ) {
                            setcookie('isDownLoaded',1);  
                            $this->loadThis();
                        } else {
                            $filter = array();
                            error_reporting(0);
                            $pooja_fromDate = $this->security->xss_clean($this->input->post('pooja_fromDate'));
                            $pooja_toDate = $this->security->xss_clean($this->input->post('pooja_toDate'));
                            $masa_id = $this->security->xss_clean($this->input->post('masa_id'));
                            $tithi_id = $this->security->xss_clean($this->input->post('tithi_id'));
                            $reportFormat = $this->security->xss_clean($this->input->post('reportFormat'));
                            $filter['tithi_id']=  $tithi_id;
                            $filter['masa_id']=  $masa_id;

                            if(!empty($pooja_fromDate)) {
                                $filter['pooja_fromDate']= date('Y-m-d',strtotime($pooja_fromDate));
                                }
                                else{
                                    $filter['pooja_fromDate'] = ''; 
                                }
                                if(!empty($pooja_toDate)) {
                                $filter['pooja_toDate']=  date('Y-m-d',strtotime($pooja_toDate));
                                }

                                if($reportFormat == 'VIEW'){
                                    $data['dt_filter'] = $filter;
                                    $data['company_id'] = $this->company_id;
                                    $data['DailyPooja_model'] = $this->DailyPooja_model;
                                    $this->global['pageTitle'] = ''.EXCEL_TITLE.' : DEVOTEE REPORT';
                                    $mpdf = new \Mpdf\Mpdf(['tempDir' => sys_get_temp_dir().DIRECTORY_SEPARATOR.'mpdf','default_font' => 'timesnewroman','format' => [400, 160]]);
                                    $mpdf->AddPage('P','','','','',10,10,10,10,8,8);
                                    $mpdf->SetTitle('PANCHANGA POOJA');
                                    $html = $this->load->view('report/panchangaView',$data,true);
                                    $mpdf->WriteHTML($html);
                                    $mpdf->Output('Panchanga_Report.pdf', 'I');
                                }else{
        
                                $cellNameByStudentReport = array('G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
                                $sheet = 0;
                                $this->excel->setActiveSheetIndex($sheet);
                                $this->excel->getActiveSheet()->setTitle($sheet);
                                $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:N500');
                                $this->excel->getActiveSheet()->setCellValue('A1', EXCEL_TITLE);
                                $this->excel->getActiveSheet()->setCellValue('A2',"Panchanga Pooja Report");
                                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                                $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
                                $this->excel->getActiveSheet()->mergeCells('A1:N1');
                                $this->excel->getActiveSheet()->mergeCells('A2:N2');
                                $this->excel->getActiveSheet()->getStyle('A1:N1')->getFont()->setBold(true);
                                $this->excel->getActiveSheet()->getStyle('A2:N2')->getFont()->setBold(true);
                                $this->excel->getActiveSheet()->getStyle('A1:N1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                $this->excel->getActiveSheet()->getStyle('A1:N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                
                                $excel_row = 3;
                                $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                                $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
                                $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
                                $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
                                $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
                                
                                $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
                                $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
                                $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
                                $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
                                $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
                                $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
                                $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
                                $this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
                                $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
        
                                $this->excel->getActiveSheet()->getStyle('A3:N3')->getFont()->setBold(true);
                                $this->excel->getActiveSheet()->getStyle('A3:N3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, 'SL No.');
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, 'Receipt No.');
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row, 'Seva By');
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, 'Pooja Type');
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, 'Tithi');
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, 'Nakshatra');
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, 'Masa');
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('H'.$excel_row, 'Rashi');
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('I'.$excel_row, 'Gothra');
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('J'.$excel_row, 'Paksha');
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('K'.$excel_row, 'Ocassion');
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('L'.$excel_row, 'Remarks');
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('M'.$excel_row, 'Amount');
                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('N'.$excel_row, 'Created Date');
            
                                // $filter['report_type']= "Asset";
                                // $filter['stream_name']= $stream[$sheet];
                               
                
                                $sl = 1;
                                $excel_row = 4;
                                $dpInfo = $this->DailyPooja_model->getPanchangaDetailsForReport($filter);
                                $total_amount=0;
                                foreach($dpInfo as $dp){
                                    $total_amount+= $dp->amount;
                                    
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, $sl++);
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, $dp->row_id);
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row, $dp->devotee_name);
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, $dp->event_type);
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, $dp->tithi);
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, $dp->nakshathra);
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, $dp->masa);
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('H'.$excel_row, $dp->rashi);
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('I'.$excel_row, $dp->gothra);
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('J'.$excel_row, $dp->paksha);
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('K'.$excel_row, $dp->occation);
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('L'.$excel_row, $dp->remarks);
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('M'.$excel_row, $dp->amount);
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('N'.$excel_row, date('d-m-Y',strtotime($dp->created_date_time)));
                                        $this->excel->getActiveSheet()->getStyle('A'.$excel_row.':B'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                        $this->excel->getActiveSheet()->getStyle('D'.$excel_row.':L'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                        $this->excel->getActiveSheet()->getStyle('M'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                        $this->excel->getActiveSheet()->getStyle('N'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                        // $this->excel->getActiveSheet()->getStyle('H'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                        $excel_row++;
                                    }
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('L'.$excel_row, 'TOTAL AMOUNT');
                                    $this->excel->getActiveSheet()->getStyle('L'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    $this->excel->getActiveSheet()->getStyle('L'.$excel_row)->getFont()->setBold(true);
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('M'.$excel_row, $total_amount);
                                    $this->excel->getActiveSheet()->getStyle('M'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    $this->excel->getActiveSheet()->getStyle('M'.$excel_row)->getFont()->setBold(true);
                                    $this->excel->createSheet(); 
                                // }
                                
                            
                            
                            $filename ='Panchanga_Pooja_Report_-'.date('d-m-Y').'.xls'; //save our workbook as this file name
                            header('Content-Type: application/vnd.ms-excel'); //mime type
                            header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                            header('Cache-Control: max-age=0'); //no cache
                            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                            ob_start();
                            setcookie('isDownLoaded',1);  
                            $objWriter->save("php://output");
                                }
                                
                         }
                        }





                        public function downloadExpenseReport(){
                            if ($this->isAdmin() == true ) {
                                setcookie('isDownLoaded',1);  
                                $this->loadThis();
                            } else {
                                $filter = array();
                                $expense_fromDate = $this->security->xss_clean($this->input->post('expense_fromDate'));
                                $expense_toDate = $this->security->xss_clean($this->input->post('expense_toDate'));
                                $event_type = $this->security->xss_clean($this->input->post('event_type'));
                                $committe_id = $this->security->xss_clean($this->input->post('committe_id'));
                              //  log_message('debug','test'.$committe_id);
                                $year = $this->security->xss_clean($this->input->post('year'));
            
                                $cellNameByStudentReport = array('G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
                                $sheet = 0;
                                    $this->excel->setActiveSheetIndex($sheet);
                                    $this->excel->getActiveSheet()->setTitle($sheet);
                                    $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:N500');
                                    $this->excel->getActiveSheet()->setCellValue('A1', EXCEL_TITLE);
                                    $this->excel->getActiveSheet()->setCellValue('A2',"Expense Report");
                                    $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                                    $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
                                    $this->excel->getActiveSheet()->mergeCells('A1:H1');
                                    $this->excel->getActiveSheet()->mergeCells('A2:H2');
                                    $this->excel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
                                    $this->excel->getActiveSheet()->getStyle('A2:H2')->getFont()->setBold(true);
                                    $this->excel->getActiveSheet()->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    $this->excel->getActiveSheet()->getStyle('A1:H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    
                                    $excel_row = 3;
                                    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                                    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
                                    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
                                    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
                                    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
                                    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
                                    $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
                                    $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
                                    
                                    $this->excel->getActiveSheet()->getStyle('A3:H3')->getFont()->setBold(true);
                                    $this->excel->getActiveSheet()->getStyle('A3:H3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, 'SL No.');
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, 'Expense Name');
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row, 'Payment Type');
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, 'Event Type');
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, 'Committee');
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, 'Amount');
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, 'Expense Date');
                                    $this->excel->setActiveSheetIndex($sheet)->setCellValue('H'.$excel_row, 'Notes');
                                    $filter['report_type']= "Asset";
                                    // $filter['stream_name']= $stream[$sheet];
                                    if(!empty($expense_fromDate)) {
                                    $filter['expense_fromDate']= date('Y-m-d',strtotime($expense_fromDate));
                                    }
                                    else{
                                        $filter['expense_fromDate'] = ''; 
                                    }
                                    if(!empty($expense_toDate)) {
                                    $filter['expense_toDate']=  date('Y-m-d',strtotime($expense_toDate));
                                    }
                                    else{
                                        $filter['expense_toDate']= '';
                                    }
                                    if($event_type == 'other'){
                                    $filter['type_of_expense']= 'Other';
                                    }else{
                                        $filter['event_type']= $event_type;  
                                    }
                                    $filter['committee_id']= $committe_id; 
                                    // $filter['year']= $year;

                    
                                    $sl = 1;
                                    $excel_row = 4;
                                    $total_amount = 0;
                                    $expenseInfo = $this->expenses_model->getexpensesInfoForReport($filter,$this->company_id);
                                        foreach($expenseInfo as $expense){
                                            $total_amount+= $expense->amount;
                                            if($expense->expense_date=="1970-01-01")
                                            {
                                                $expense_date = '';
                                            }
                                            else
                                            {
                                                $expense_date = date('d-m-Y',strtotime($expense->expense_date)) ; 
                                            }
                                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, $sl++);
                                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, $expense->expense_type);
                                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row,$expense->account_type);
                                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row,$expense->event_type);
                                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row,$expense->committee_name);
                                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, $expense->amount);
                                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, $expense_date);
                                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('H'.$excel_row, $expense->comments);

                                            $this->excel->getActiveSheet()->getStyle('A'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                            $this->excel->getActiveSheet()->getStyle('C'.$excel_row.':F'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                            $excel_row++;
                                        }
                                        $excel_row++;
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, 'TOTAL AMOUNT');
                                        $this->excel->getActiveSheet()->getStyle('E'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                        $this->excel->getActiveSheet()->getStyle('E'.$excel_row)->getFont()->setBold(true);
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, $total_amount);
                                        $this->excel->getActiveSheet()->getStyle('F'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                        $this->excel->getActiveSheet()->getStyle('F'.$excel_row)->getFont()->setBold(true);
                                        $this->excel->createSheet(); 
                                    // }
                                    
                                }
                                
                                $filename ='Expense_Report_'.date('d-m-Y').'.xls'; //save our workbook as this file name
                                header('Content-Type: application/vnd.ms-excel'); //mime type
                                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                                header('Cache-Control: max-age=0'); //no cache
                                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                                ob_start();
                                setcookie('isDownLoaded',1);  
                                $objWriter->save("php://output");
                                
                            }




                            public function downloadDonationReport(){
                                if ($this->isAdmin() == true ) {
                                    setcookie('isDownLoaded',1);  
                                    $this->loadThis();
                                } else {
                                    $filter = array();
                                    error_reporting(0);
                                    $donation_fromDate = $this->security->xss_clean($this->input->post('donation_fromDate'));
                                    $donation_toDate = $this->security->xss_clean($this->input->post('donation_toDate'));
                                    $purpose = $this->security->xss_clean($this->input->post('purpose'));
                                    $donation_type = $this->security->xss_clean($this->input->post('donation_type'));
                                    $collected_by = $this->security->xss_clean($this->input->post('collected_by'));
                                    $reportFormat = $this->security->xss_clean($this->input->post('reportFormat'));
                                    $type_of_donation = $this->security->xss_clean($this->input->post('type_of_donation'));
                            
                                    $filter['report_type']= "Asset";
                                    // $filter['stream_name']= $stream[$sheet];
                                    if(!empty($donation_fromDate)) {
                                    $filter['donation_fromDate']= date('Y-m-d',strtotime($donation_fromDate));
                                    }
                                    else{
                                        $filter['donation_fromDate'] = ''; 
                                    }
                                    if(!empty($donation_toDate)) {
                                    $filter['donation_toDate']=  date('Y-m-d',strtotime($donation_toDate));
                                    }
                                    else{
                                        $filter['donation_toDate']= '';
                                    }
                                    $filter['purpose']= $purpose;
                                    $filter['donation_type']= $donation_type;
                                    $filter['collected_by']= $collected_by;
                                    $filter['type_of_donation']= $type_of_donation;
                            
                                    if($reportFormat == 'VIEW'){
                                        $data['dt_filter'] = $filter;
                                        $data['company_id'] = $this->company_id;
                                        $data['DailyPooja_model'] = $this->DailyPooja_model;
                                        $this->global['pageTitle'] = ''.EXCEL_TITLE.' : DONATION REPORT';
                                        $mpdf = new \Mpdf\Mpdf(['tempDir' => sys_get_temp_dir().DIRECTORY_SEPARATOR.'mpdf','default_font' => 'timesnewroman','format' => [400, 160]]);
                                        $mpdf->AddPage('P','','','','',10,10,10,10,8,8);
                                        $mpdf->SetTitle('DONATION REPORT');
                                        $html = $this->load->view('report/donationView',$data,true);
                                        $mpdf->WriteHTML($html);
                                        $mpdf->Output('Donation_Report.pdf', 'I');
                                    }else{

                                    $cellNameByStudentReport = array('G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
                                    $sheet = 0;
                                        $this->excel->setActiveSheetIndex($sheet);
                                        $this->excel->getActiveSheet()->setTitle($sheet);
                                        $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:N500');
                                        $this->excel->getActiveSheet()->setCellValue('A1', EXCEL_TITLE);
                                        $this->excel->getActiveSheet()->setCellValue('A2',"Donation/ Seva Report");
                                        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                                        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
                                        $this->excel->getActiveSheet()->mergeCells('A1:G1');
                                        $this->excel->getActiveSheet()->mergeCells('A2:G2');
                                        $this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
                                        $this->excel->getActiveSheet()->getStyle('A2:G2')->getFont()->setBold(true);
                                        $this->excel->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                        $this->excel->getActiveSheet()->getStyle('A1:G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                        
                                        $excel_row = 3;
                                        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                                        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                                        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
                                        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
                                        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
                                        
                                        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
                                        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
                                        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
                                        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
                                        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
                                        $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(35);
                                        $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
                                        $this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(20);

                                        $this->excel->getActiveSheet()->getStyle('A3:N3')->getFont()->setBold(true);
                                        $this->excel->getActiveSheet()->getStyle('A3:N3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, 'SL No.');
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, 'Receipt No.');
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row, 'Date');
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, 'Name');
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, 'Email');
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, 'Address');
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, 'Note');
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('H'.$excel_row, 'Collected By');
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('I'.$excel_row, 'Type');
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('J'.$excel_row, 'Purpose');
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('K'.$excel_row, 'Seva');
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('L'.$excel_row, 'Donation Type');
                                        $this->excel->setActiveSheetIndex($sheet)->setCellValue('M'.$excel_row, 'Amount');
                                      
                            
                                        $sl = 1;
                                        $excel_row = 4;
                                        $total_amount = 0;
                                        $donationInfo = $this->DailyPooja_model->donationInfoForReport($filter,$this->company_id);
                                            foreach($donationInfo as $donation){
                                                $total_amount+= $donation->amount;
                                                if($donation->date=="1970-01-01")
                                                {
                                                    $donation_date = '';
                                                }
                                                else
                                                {
                                                    $donation_date = date('d-m-Y',strtotime($donation->date)); 
                                                }
                                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('A'.$excel_row, $sl++);
                                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('B'.$excel_row, $donation->row_id);
                                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('C'.$excel_row, $donation_date);
                                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, $donation->devotee_name);
                                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, $donation->email);
                                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('F'.$excel_row, $donation->address);
                                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('G'.$excel_row, $donation->note);
                                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('H'.$excel_row, $donation->name);
                                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('I'.$excel_row,$donation->donation_type);
                                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('J'.$excel_row,$donation->purpose_name);
                                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('K'.$excel_row,$donation->seva_name);
                                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('L'.$excel_row,$donation->type_of_donation);
                                                $this->excel->setActiveSheetIndex($sheet)->setCellValue('M'.$excel_row,$donation->amount);
                            
                                                $this->excel->getActiveSheet()->getStyle('A'.$excel_row.':C'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                                $this->excel->getActiveSheet()->getStyle('I'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                                $this->excel->getActiveSheet()->getStyle('J'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                                $this->excel->getActiveSheet()->getStyle('M'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                                $excel_row++;
                                            }
                                            $excel_row++;
                                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('D'.$excel_row, 'TOTAL AMOUNT');
                                            $this->excel->getActiveSheet()->getStyle('D'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                            $this->excel->getActiveSheet()->getStyle('D'.$excel_row)->getFont()->setBold(true);
                                            $this->excel->setActiveSheetIndex($sheet)->setCellValue('E'.$excel_row, $total_amount);
                                            $this->excel->getActiveSheet()->getStyle('E'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                                            $this->excel->getActiveSheet()->getStyle('E'.$excel_row)->getFont()->setBold(true);
                                            $this->excel->createSheet(); 
                                        // }
                                        
                                    
                                    
                                    $filename ='Donation_Report_-'.date('d-m-Y').'.xls'; //save our workbook as this file name
                                    header('Content-Type: application/vnd.ms-excel'); //mime type
                                    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                                    header('Cache-Control: max-age=0'); //no cache
                                    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                                    ob_start();
                                    setcookie('isDownLoaded',1);  
                                    $objWriter->save("php://output");
                                }
                                }
                                    
                                }


   
}

?>