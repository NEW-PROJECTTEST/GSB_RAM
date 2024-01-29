<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class LeaseVehicle  extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('lease_vehicle_model');
        $this->load->model('transporter_model');
        $this->load->library('excel');
        $this->isLoggedIn();   
    }
  
    /**
     * This function is used to load the LeaseVehicle list
     */
    function LeaseVehicleListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      
            $vehicle_number = $this->security->xss_clean($this->input->post('vehicle_number'));  
            $vehicle_condition = $this->security->xss_clean($this->input->post('vehicle_condition'));
            $contact_number_one = $this->security->xss_clean($this->input->post('contact_number_one'));
            $transporter_name = $this->security->xss_clean($this->input->post('transporter_name'));
            $rc_number = $this->security->xss_clean($this->input->post('rc_number'));
            $pan_number = $this->security->xss_clean($this->input->post('pan_number'));
            $data['vehicle_number'] = $vehicle_number;
            $data['vehicle_condition'] = $vehicle_condition;
            $data['contact_number_one'] = $contact_number_one;
            $data['transporter_name'] = $transporter_name;
            $data['pan_number'] = $pan_number;
            $data['rc_number'] = $rc_number;
            
            $filter['pan_number'] = $pan_number;
            $filter['rc_number'] = $rc_number;
            $filter['vehicle_number'] = $vehicle_number;
            $filter['vehicle_condition'] = $vehicle_condition;
            $filter['contact_number_one'] = $contact_number_one;
            $filter['transporter_name'] = $transporter_name;
            $data['transporters'] = $this->transporter_model->getAllTransporters($this->company_id);
            $data['vehicles'] = $this->lease_vehicle_model->getAllLeaseVehicles($this->company_id);
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->lease_vehicle_model->LeaseVehicleListingCount($searchText,$filter,$this->company_id);
            $data['count'] =  $count;
			$returns = $this->paginationCompress ("LeaseVehicleListing/", $count, 100 );
            $data['LeaseVehicleRecords'] = $this->lease_vehicle_model->LeaseVehicleListing($searchText,$filter,$this->company_id, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = $this->company_name.' :Lease Vehicle Details ';
            $this->loadViews("lease_vehicle/leaseVehicle", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addLeaseVehiclePageView()
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $data['transporters'] = $this->transporter_model->getAllTransporters($this->company_id);
            $this->global['pageTitle'] = $this->company_name.' : Add  Lease Vehicle ';
            $this->loadViews("lease_vehicle/addLeaseVehicle", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to add new LeaseVehicle to the system
     */
    function addLeaseVehicle()
    {
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('vehicle_number','Vehicle Number','trim|required');
            $this->form_validation->set_rules('transporter_rowid','Transporter Name','required');
            $this->form_validation->set_rules('contact_number_one','Contact Number','required');
            if($this->form_validation->run() == FALSE) {
                $this->addLeaseVehiclePageView();
            } else {
                $vehicle_number = $this->input->post('vehicle_number');
                $transporter_rowid = ucwords(strtolower($this->security->xss_clean($this->input->post('transporter_rowid'))));
                $contact_number_one = $this->input->post('contact_number_one');
                $contact_number_two = $this->input->post('contact_number_two');

                $pan_number = $this->input->post('pan_number');
                $rc_number = $this->input->post('rc_number');
                $email = $this->input->post('email');
                $vehicle_condition = $this->input->post('vehicle_condition');
                $leaseVehicleInfo = array('rc_number'=>$rc_number,'pan_number'=>$pan_number,'vehicle_number'=>$vehicle_number, 'transporter_rowid'=>$transporter_rowid, 
                'contact_number_one'=>$contact_number_one,'contact_number_two'=>$contact_number_two,'email'=>$email,
                'vehicle_condition'=>$vehicle_condition, 'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->lease_vehicle_model->addLeaseVehicle($leaseVehicleInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Lease Vehicle created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Lease Vehicle creation failed');
                }
                redirect('addLeaseVehiclePageView');
            }
        }
    }

    /**
     * This function is used load LeaseVehicle edit information
     */
    function editLeaseVehiclePageView($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            if($row_id == null){
                redirect('LeaseVehicleListing');
            }
            $data['leaseVehicleInfo'] = $this->lease_vehicle_model->getLeaseVehicleInfoById($row_id);
            $data['transporters'] = $this->transporter_model->getAllTransporters($this->company_id);
            $this->global['pageTitle'] = $this->company_name.' : Edit Lease Vehicle ';
            $this->loadViews("lease_vehicle/editLeaseVehicle", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to edit the LeaseVehicle information
     */
    function updateLeaseVehicle()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else { 
            $row_id = $this->input->post('row_id');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('vehicle_number','Vehicle Number','trim|required');
            $this->form_validation->set_rules('transporter_rowid','Transporter Name','required');
            $this->form_validation->set_rules('contact_number_one','Contact Number','required');
            if($this->form_validation->run() == FALSE)
            {
                $this->editLeaseVehiclePageView($row_id);
            }else {
                $vehicle_number = $this->input->post('vehicle_number');
                $transporter_rowid = ucwords(strtolower($this->security->xss_clean($this->input->post('transporter_rowid'))));
                $contact_number_one = $this->input->post('contact_number_one');
                $contact_number_two = $this->input->post('contact_number_two');
                $pan_number = $this->input->post('pan_number');
                $rc_number = $this->input->post('rc_number');
                $email = $this->input->post('email');
                $vehicle_condition = $this->input->post('vehicle_condition');
                $leaseVehicleInfo = array('rc_number'=>$rc_number,'pan_number'=>$pan_number,'vehicle_number'=>$vehicle_number, 'transporter_rowid'=>$transporter_rowid, 
                'contact_number_one'=>$contact_number_one,'contact_number_two'=>$contact_number_two,'email'=>$email,
                'vehicle_condition'=>$vehicle_condition, 'company_id'=>$this->company_id,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->lease_vehicle_model->updateLeaseVehicle($leaseVehicleInfo,$row_id);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Lease Vehicle updated successfully');
                }
                else{
                    $this->session->set_flashdata('error', 'Lease Vehicle update failed');
                }
                redirect('editLeaseVehiclePageView/'.$row_id);
            }
        }
    }

/**
     * This function is used to delete the LeaseVehicle using row_id
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteLeaseVehicle()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $LeaseVehicleInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->lease_vehicle_model->deleteLeaseVehicle($row_id,$LeaseVehicleInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }
    /**
     * View LeaseVehicle details based on row_id
     *
     */
    public function viewLeaseVehicle($row_id = null)
    {
        if ($this->isAdmin() == true ) {
            $this->loadThis();
        } else {
            if ($row_id == null) {
                redirect('LeaseVehicleListing');
            }
            $data['leaseVehicleInfo'] = $this->lease_vehicle_model->getLeaseVehicleInfoById($row_id);
            $this->global['pageTitle'] = $this->company_name.': View Lease Vehicle';
            $this->loadViews("lease_vehicle/viewLeaseVehicle", $this->global, $data, null);
        }
    } 

   
// Own Vehicle  Report
function downloadLeaseVehicleReport(){
//print page setup
 $this->excel->setActiveSheetIndex(0);
 $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToPage(true);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);    
 $fromDate = $this->input->post('from_date');
 $toDate = $this->input->post('to_date');
 $vehicle_number = $this->input->post('vehicle_number');
 $transporter_name = $this->input->post('transporter_name');
log_message('debug','transporter:'.$transporter_name);
 $vehicleInfo = $this->lease_vehicle_model->getLeaseVehicleReport($transporter_name,$vehicle_number);
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
           
         $this->excel->getActiveSheet()->mergeCells('A1:H1');
         $this->excel->getActiveSheet()->setCellValue('A1', "KARAVALI TRANSPORT ");
         $this->excel->getActiveSheet()->mergeCells('A2:H2');
         $this->excel->getActiveSheet()->setCellValue('A2', "LEASE VEHICLE REPORT");
         $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
         $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
         $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->getStyle('A1:H2')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->getStyle('A3:H3')->applyFromArray($OutlineStyle);
           $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
           $this->excel->getActiveSheet()->mergeCells('A3:H3');
           $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
           $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->setCellValue('A3', "Vehicle :" .$vehicle_number);
         //   //font bold and text bold
           $this->excel->getActiveSheet()->getStyle('A4:H4')->getFont()->setBold(true);
          //horizontal and vertical alignment
       $this->excel->getActiveSheet()->getStyle('A4:H4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $this->excel->getActiveSheet()->getStyle('A4:H4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
           //set width for cell
           $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
           $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
           $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
           $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
           $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
           $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
           $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
           $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
         //   //report Header
           $this->cellColor('A4:U4', 'D5DBDB');
           $this->excel->getActiveSheet()->getStyle('A4')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->getStyle('A4:H4')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->setCellValue('A4', "Vehicle Number");
         $this->excel->getActiveSheet()->setCellValue('B4', "vehicle Condition");
         $this->excel->getActiveSheet()->setCellValue('C4', "Transporter Name");
         $this->excel->getActiveSheet()->setCellValue('D4', "Email");
         $this->excel->getActiveSheet()->setCellValue('E4', "Contact Number");
         $this->excel->getActiveSheet()->setCellValue('F4', "Transporter Address");
         $this->excel->getActiveSheet()->setCellValue('G4', "Transporter Account Number");
         $this->excel->getActiveSheet()->setCellValue('H4', "Comments");
         
           
         
         $excel_row = 5;
      
         if(!empty($vehicleInfo))
         {
          foreach($vehicleInfo as $record)
           {
             //set row height for cell
                 //horizontal and vertical alignment
       
             $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':H' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':H' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
             $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
             $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, $record->vehicle_number);
             $this->excel->getActiveSheet()->setCellValue('B'.$excel_row, $record->vehicle_condition);
             $this->excel->getActiveSheet()->setCellValue('C'.$excel_row,$record->transporter_name);
             $this->excel->getActiveSheet()->setCellValue('D'.$excel_row, $record->email);
             $this->excel->getActiveSheet()->setCellValue('E'.$excel_row, $record->contact_number);
             $this->excel->getActiveSheet()->setCellValue('F'.$excel_row, $record->transporter_address);
             $this->excel->getActiveSheet()->setCellValue('G'.$excel_row, $record->transporter_account_number);
             $this->excel->getActiveSheet()->setCellValue('H'.$excel_row, $record->comments);
             $this->excel->getActiveSheet()->getStyle('A5:H'.$excel_row)->applyFromArray($OutlineStyle);
             $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:H'.$excel_row);
             $this->excel->getActiveSheet()->getStyle('A1:H'.$excel_row)->applyFromArray($styleArray);
             $excel_row++;
           }
         }
         
     log_message('debug','array is'.print_r($vehicleInfo,true));
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