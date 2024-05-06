<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require_once 'vendor/autoload.php';


class DailyPooja extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DailyPooja_model');
        $this->load->model('setting_model');
        $this->load->model('income_model');
        $this->load->model('committee_model');
        $this->load->model('setting_model','settings');

        $this->isLoggedIn();   
    }
    
    /**
     * This function is used to load the committee list
     */
    function DailyPoojaListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {   
            $data['poojaInfo'] =$this->DailyPooja_model->getDailyPoojaInfo($this->company_id); 
            $data['eventInfo'] =$this->DailyPooja_model->getEventInfo($this->company_id); 
            $data['tithiInfo'] =$this->DailyPooja_model->getTithiInfo($this->company_id); 
            $data['nakshathraInfo'] =$this->DailyPooja_model->getNakshathraInfo($this->company_id);
            $data['masaInfo'] =$this->DailyPooja_model->getMasaInfo($this->company_id);  
            $data['rashiInfo'] =$this->DailyPooja_model->getRashiInfo($this->company_id); 
            $data['gothraInfo'] =$this->DailyPooja_model->getGothraInfo($this->company_id); 
            $data['occationInfo'] = $this->setting_model->getAllOccationInfo($this->company_id);
            $data['pakshaInfo'] = $this->setting_model->getAllPakshaInfo($this->company_id);
            $data['subscriptionInfo'] = $this->setting_model->getAllSubscriptionInfo($this->company_id);
            $data['datePoojaCount'] = $this->DailyPooja_model->poojaListCount($this->company_id);

            // $data['committeeTypeInfo'] =$this->Event_model->getCommitteeTypeInfo($this->company_id);  
            $this->global['pageTitle'] = $this->company_name.' :DailyPooja Details ';
            $this->loadViews("DailyPooja/dailyPooja", $this->global, $data, NULL);
        }
    }


    function getDailyPoojaDetails()
    {
      $draw = intval($this->input->post("draw"));
      $start = intval($this->input->post("start"));
      $length = intval($this->input->post("length"));
        $data_array_new = [];
        $data_array = $this->DailyPooja_model->poojaList($this->company_id);
        
       
        foreach($data_array as $r) {
            $viewButton ='<a class="btn  btn-sm btn-primary" href="'.site_url('viewDailyPooja/'.$r->row_id).'"title="View"><i class="fa fa-eye"></i></a>';
             if($this->role == ROLE_ADMIN ) {
             $editButton = '<a class="btn  btn-sm btn-info" href="'.site_url('editDailyPooja/'.$r->row_id).'"title="Edit"><i class="fas fa-edit"></i></i></a>';
             $deleteButton = '<a class="btn btn-sm btn-danger deleteDailyPooja" data-row_id='.$r->row_id.' href="#" title="Delete"><i class="fas fa-trash"></i></a>';
             $recieptButton = '<a href="'.site_url('puFeePaymentReceiptPrint/'.$r->row_id).'" target="_blank">Receipt</a>';
            }else{
                $editButton='';
                $deleteButton='' ;
            }

            $data_array_new[] = array(
                // $r->date,
                 $r->devotee_name,
                 $r->event_type,
                 $r->month,
                 $viewButton.' '.$editButton.' '.$deleteButton.' '.$recieptButton
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
     * This function is used to add new committee to the system
     */
    function addDailyPooja()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {

                $devotee_id = $this->security->xss_clean($this->input->post('devotee_id'));
                $event_type = $this->security->xss_clean($this->input->post('event_type'));
                $datedp = $this->security->xss_clean($this->input->post('date'));
                if(!empty( $datedp)){
                $dateinfo = date('d-m',strtotime($datedp));
                }else{
                    $dateinfo = '';  
                    $datedp = date('d-m-Y');
                }
                if(date('m',strtotime($datedp)) == 1){
                    $month = 'JANUARY';
                }else if(date('m',strtotime($datedp)) == 2){
                    $month = 'FEBRUARY'; 
                }else if(date('m',strtotime($datedp)) == 3){
                    $month = 'MARCH'; 
                }else if(date('m',strtotime($datedp)) == 4){
                    $month = 'APRIL'; 
                }else if(date('m',strtotime($datedp)) == 5){
                    $month = 'MAY'; 
                }else if(date('m',strtotime($datedp)) == 6){
                    $month = 'JUNE'; 
                }else if(date('m',strtotime($datedp)) == 7){
                    $month = 'JULY'; 
                }else if(date('m',strtotime($datedp)) == 8){
                    $month = 'AUGUST'; 
                }else if(date('m',strtotime($datedp)) == 9){
                    $month = 'SEPTEMBER'; 
                }else if(date('m',strtotime($datedp)) == 10){
                    $month = 'OCTOBER'; 
                }else if(date('m',strtotime($datedp)) == 11){
                    $month = 'NOVEMBER'; 
                }else if(date('m',strtotime($datedp)) == 12){
                    $month = 'DECEMBER'; 
                }
                $eventdp = $this->security->xss_clean($this->input->post('event_id'));
                $tithidp = $this->security->xss_clean($this->input->post('tithi_id'));
                $nakshathradp = $this->security->xss_clean($this->input->post('nakshathra_id'));
                $masadp = $this->security->xss_clean($this->input->post('masa_id'));
                $rashidp = $this->security->xss_clean($this->input->post('rashi_id'));
                $gothradp = $this->security->xss_clean($this->input->post('gothra_id'));
                $occation_id = $this->security->xss_clean($this->input->post('occation_id'));
                $paksha_id = $this->security->xss_clean($this->input->post('paksha_id'));
                $amount = $this->security->xss_clean($this->input->post('amount'));
                $remarks = $this->security->xss_clean($this->input->post('remarks'));
                // if($event_type=='Date'){
                //     $eventdp='0'; $tithidp='0'; $nakshathradp='0'; $masadp='0'; $rashidp='0'; $gothradp='0'; }
                // if($event_type=='Event'){
                //     $dateinfo='0'; $tithidp='0'; $nakshathradp='0'; $masadp='0'; $rashidp='0'; $gothradp='0'; }
                // if($event_type=='Tithi'){
                //     $dateinfo='0'; $eventdp='0'; $nakshathradp='0'; $masadp='0'; $rashidp='0'; $gothradp='0'; }
                // if($event_type=='Nakshathra'){
                //     $dateinfo='0'; $eventdp='0'; $tithidp='0'; $masadp='0'; $rashidp='0'; $gothradp='0'; }
                // if($event_type=='Masa'){
                //     $dateinfo='0'; $eventdp='0'; $tithidp='0'; $nakshathradp='0'; $rashidp='0'; $gothradp='0'; }
                // if($event_type=='Rashi'){
                //     $dateinfo='0'; $eventdp='0'; $tithidp='0'; $nakshathradp='0'; $masadp='0'; $gothradp='0'; }
                // if($event_type=='Gothra'){
                //     $dateinfo='0'; $eventdp='0'; $tithidp='0'; $nakshathradp='0'; $masadp='0'; $rashidp='0'; }
                                                   

                $eventInfo = array('devotee_id'=>$devotee_id,
                'event_type'=>$event_type,
                'date'=>$dateinfo,
                'event_id'=>$eventdp,
                'paksha_id' =>$paksha_id,
                'occation_id' =>$occation_id,
                'tithi_id'=>$tithidp,
                'nakshathra_id'=>$nakshathradp,
                'masa_id'=>$masadp,
                'rashi_id'=>$rashidp,
                'gothra_id'=>$gothradp,
                'amount'  =>$amount,
                'remarks' =>$remarks,
                'month' =>$month,
                'created_by'=>$this->company_id,
                'created_date_time' =>date('Y-m-d H:i:s'),
                'company_id'=>$this->company_id);

                $result = $this->DailyPooja_model->addPooja($eventInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Pooja added successfully');
                } else{
                    $this->session->set_flashdata('error', 'Pooja creation failed');
                }
                if($event_type == 'Panchanga'){
                redirect('PanchangaPoojaListing');
                }else{
                redirect('DailyPoojaListing');  
                }
            }
    }

    function editDailyPooja($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            if($row_id == null){
                redirect('eventListing');
            }
            $data['dpInfo'] = $this->DailyPooja_model->getDPDetails($row_id);
            $data['poojaInfo'] =$this->DailyPooja_model->getDailyPoojaInfo($this->company_id); 
            $data['eventInfo'] =$this->DailyPooja_model->getEventInfo($this->company_id); 
            $data['tithiInfo'] =$this->DailyPooja_model->getTithiInfo($this->company_id); 
            $data['nakshathraInfo'] =$this->DailyPooja_model->getNakshathraInfo($this->company_id);
            $data['masaInfo'] =$this->DailyPooja_model->getMasaInfo($this->company_id);  
            $data['rashiInfo'] =$this->DailyPooja_model->getRashiInfo($this->company_id); 
            $data['gothraInfo'] =$this->DailyPooja_model->getGothraInfo($this->company_id); 
            $data['occationInfo'] = $this->setting_model->getAllOccationInfo($this->company_id);
            $data['pakshaInfo'] = $this->setting_model->getAllPakshaInfo($this->company_id);
            $data['subscriptionInfo'] = $this->setting_model->getAllSubscriptionInfo($this->company_id);
            $this->global['pageTitle'] = $this->company_name.' : Edit DailyPooja ';
            $this->loadViews("DailyPooja/editDailyPooja", $this->global, $data, NULL);
        }
    }

    function updateDailyPooja()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else { 
            $row_id = $this->input->post('row_id');
           

            // $event_id = $this->security->xss_clean($this->input->post('events'));
            // $event_date = $this->security->xss_clean($this->input->post('event_date'));
                $devotee_id = $this->security->xss_clean($this->input->post('devotee_id'));
                $event_type = $this->security->xss_clean($this->input->post('event_type'));
                $datedp = $this->security->xss_clean($this->input->post('date'));
                // $dateinfo = date('Y-m-d',strtotime($datedp));
                $eventdp = $this->security->xss_clean($this->input->post('event_id'));
                $tithidp = $this->security->xss_clean($this->input->post('tithi_id'));
                $nakshathradp = $this->security->xss_clean($this->input->post('nakshathra_id'));
                $masadp = $this->security->xss_clean($this->input->post('masa_id'));
                $rashidp = $this->security->xss_clean($this->input->post('rashi_id'));
                $gothradp = $this->security->xss_clean($this->input->post('gothra_id'));
                $paksha_id = $this->security->xss_clean($this->input->post('paksha_id'));
                $occation_id = $this->security->xss_clean($this->input->post('occation_id'));
                $amount = $this->security->xss_clean($this->input->post('amount'));
                $remarks = $this->security->xss_clean($this->input->post('remarks'));
                $pooja_type = $this->security->xss_clean($this->input->post('pooja_type'));

                if(!empty( $datedp)){
                    $dateinfo = date('d-m',strtotime($datedp));
                    }else{
                        $dateinfo = '';  
                        $datedp = date('d-m-Y');
                    }
                    if(date('m',strtotime($datedp)) == 1){
                        $month = 'JANUARY';
                    }else if(date('m',strtotime($datedp)) == 2){
                        $month = 'FEBRUARY'; 
                    }else if(date('m',strtotime($datedp)) == 3){
                        $month = 'MARCH'; 
                    }else if(date('m',strtotime($datedp)) == 4){
                        $month = 'APRIL'; 
                    }else if(date('m',strtotime($datedp)) == 5){
                        $month = 'MAY'; 
                    }else if(date('m',strtotime($datedp)) == 6){
                        $month = 'JUNE'; 
                    }else if(date('m',strtotime($datedp)) == 7){
                        $month = 'JULY'; 
                    }else if(date('m',strtotime($datedp)) == 8){
                        $month = 'AUGUST'; 
                    }else if(date('m',strtotime($datedp)) == 9){
                        $month = 'SEPTEMBER'; 
                    }else if(date('m',strtotime($datedp)) == 10){
                        $month = 'OCTOBER'; 
                    }else if(date('m',strtotime($datedp)) == 11){
                        $month = 'NOVEMBER'; 
                    }else if(date('m',strtotime($datedp)) == 12){
                        $month = 'DECEMBER'; 
                    }
                // if($event_type=='Date'){
                //     $eventdp='0'; $tithidp='0'; $nakshathradp='0'; $masadp='0'; $rashidp='0'; $gothradp='0'; }
                // if($event_type=='Event'){
                //     $dateinfo='0'; $tithidp='0'; $nakshathradp='0'; $masadp='0'; $rashidp='0'; $gothradp='0'; }
                // if($event_type=='Tithi'){
                //     $dateinfo='0'; $eventdp='0'; $nakshathradp='0'; $masadp='0'; $rashidp='0'; $gothradp='0'; }
                // if($event_type=='Nakshathra'){
                //     $dateinfo='0'; $eventdp='0'; $tithidp='0'; $masadp='0'; $rashidp='0'; $gothradp='0'; }
                // if($event_type=='Masa'){
                //     $dateinfo='0'; $eventdp='0'; $tithidp='0'; $nakshathradp='0'; $rashidp='0'; $gothradp='0'; }
                // if($event_type=='Rashi'){
                //     $dateinfo='0'; $eventdp='0'; $tithidp='0'; $nakshathradp='0'; $masadp='0'; $gothradp='0'; }
                // if($event_type=='Gothra'){
                //     $dateinfo='0'; $eventdp='0'; $tithidp='0'; $nakshathradp='0'; $masadp='0'; $rashidp='0'; }
                   
                $eventInfo = array('devotee_id'=>$devotee_id,
                'event_type'=>$event_type,
                'date'=>$dateinfo,
                'month' =>$month,
                'event_id'=>$eventdp,
                'tithi_id'=>$tithidp,
                'nakshathra_id'=>$nakshathradp,
                'amount'  =>$amount,
                'masa_id'=>$masadp,
                'rashi_id'=>$rashidp,
                'gothra_id'=>$gothradp,
                'occation_id' =>$occation_id,
                'paksha_id' =>$paksha_id,
                 'remarks'  =>$remarks,
                'updated_date_time' =>date('Y-m-d H:i:s'),
                'updated_by' =>$this->company_id,
                'company_id'=>$this->company_id);
               
                $result = $this->DailyPooja_model->updateDailyPooja($eventInfo,$row_id);

                if($result > 0){
                    $this->session->set_flashdata('success', 'Daily Pooja updated successfully');
                }
                else{
                    $this->session->set_flashdata('error', 'Daily Pooja update failed');
                }
                if($pooja_type == 'DATE'){
                redirect('editDailyPooja/'.$row_id);
                }else{
                    redirect('editPanchangaPooja/'.$row_id); 
                }
            }
      
    }

    public function deleteDailyPooja()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $eventsInfo = array('is_deleted' => 1);
            $result = $this->DailyPooja_model->deleteDailyPooja($row_id,$eventsInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }
   
    public function viewDailyPooja($row_id = null)
    {
        if ($this->isAdmin() == true ) {
            $this->loadThis();
        } else {
            if ($row_id == null) {
                redirect('DailyPoojaListing');
            }
            $data['dpInfo'] = $this->DailyPooja_model->getDPDetails($row_id);
            // $data['committeeBillInfo'] = $this->bill->getBillInfoByCommitteeId($row_id);
            // $data['billPaidInfo'] = $this->bill->getBillPaidInfoByCommitteeId($row_id);
            $this->global['pageTitle'] = $this->company_name.': View Daily Pooja';
            $this->loadViews("dailyDetails/viewDailyDetails", $this->global, $data, null);
        }
    } 

    public function viewPanchangaPooja($row_id = null)
    {
        if ($this->isAdmin() == true ) {
            $this->loadThis();
        } else {
            if ($row_id == null) {
                redirect('DailyPoojaListing');
            }
            $data['dpInfo'] = $this->DailyPooja_model->getDPDetails($row_id);
            // $data['committeeBillInfo'] = $this->bill->getBillInfoByCommitteeId($row_id);
            // $data['billPaidInfo'] = $this->bill->getBillPaidInfoByCommitteeId($row_id);
            $this->global['pageTitle'] = $this->company_name.': View Daily Pooja';
            $this->loadViews("dailyDetails/viewPanchangaPoojaDetails", $this->global, $data, null);
        }
    } 



    
    public function feePaymentReceiptPrint($row_id = NULL){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            error_reporting(0); 
            $data['dpInfo'] = $this->DailyPooja_model->getDPDetails($row_id);
           $data['companyLogo'] = $this->company_logo;
                      
            $this->global['pageTitle'] = ''.TAB_TITLE.' : Pooja Receipt';
            // $this->loadViews("fees/feeReceiptPrint", $this->global, $data, null); 
            $mpdf = new \Mpdf\Mpdf(['tempDir' => sys_get_temp_dir().DIRECTORY_SEPARATOR.'mpdf','default_font' => 'timesnewroman','format' => 'A5']);
            $mpdf->autoScriptToLang = true;
            $mpdf->autoLangToFont = true;
                        $mpdf->AddPage('P','','','','',7,7,7,7,8,8);
            $mpdf->SetTitle('Pooja Receipt');

            $data['receipt_title_mgmt'] = EXCEL_TITLE;
            $html = $this->load->view('DailyPooja/dailyPoojaReciept',$data,true);
            $mpdf->WriteHTML($html);            
           
            $mpdf->Output('Pooja_Receipt.pdf', 'I'); 
        } 
    }

    public function panchangaReceiptPrint($row_id = NULL){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            error_reporting(0); 
            $data['dpInfo'] = $this->DailyPooja_model->getDPDetails($row_id);
           $data['companyLogo'] = $this->company_logo;
                      
            $this->global['pageTitle'] = ''.TAB_TITLE.' : Pooja Receipt';
            // $this->loadViews("fees/feeReceiptPrint", $this->global, $data, null); 
            $mpdf = new \Mpdf\Mpdf(['tempDir' => sys_get_temp_dir().DIRECTORY_SEPARATOR.'mpdf','default_font' => 'timesnewroman','format' => 'A5']);
            $mpdf->autoScriptToLang = true;
            $mpdf->autoLangToFont = true;
                        $mpdf->AddPage('P','','','','',7,7,7,7,8,8);
            $mpdf->SetTitle('Pooja Receipt');

            $data['receipt_title_mgmt'] = EXCEL_TITLE;
            $html = $this->load->view('DailyPooja/panchangaPoojaReciept',$data,true);
            $mpdf->WriteHTML($html);            
           
            $mpdf->Output('Pooja_Receipt.pdf', 'I'); 
        } 
    }




    function PanchangaPoojaListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {   
            $data['poojaInfo'] =$this->DailyPooja_model->getDailyPoojaInfo($this->company_id); 
            $data['eventInfo'] =$this->DailyPooja_model->getEventInfo($this->company_id); 
            $data['tithiInfo'] =$this->DailyPooja_model->getTithiInfo($this->company_id); 
            $data['nakshathraInfo'] =$this->DailyPooja_model->getNakshathraInfo($this->company_id);
            $data['masaInfo'] =$this->DailyPooja_model->getMasaInfo($this->company_id);  
            $data['rashiInfo'] =$this->DailyPooja_model->getRashiInfo($this->company_id); 
            $data['gothraInfo'] =$this->DailyPooja_model->getGothraInfo($this->company_id); 
            $data['occationInfo'] = $this->setting_model->getAllOccationInfo($this->company_id);
            $data['pakshaInfo'] = $this->setting_model->getAllPakshaInfo($this->company_id);
            $data['subscriptionInfo'] = $this->setting_model->getAllSubscriptionInfo($this->company_id);
            $data['panchangaPoojaCount'] = $this->DailyPooja_model->PanchangaPoojaCount($this->company_id);

            // $data['committeeTypeInfo'] =$this->Event_model->getCommitteeTypeInfo($this->company_id);  
            $this->global['pageTitle'] = $this->company_name.' :DailyPooja Details ';
            $this->loadViews("DailyPooja/panchangaPooja", $this->global, $data, NULL);
        }
    }



    function getPanchangaPoojaDetails()
    {
      $draw = intval($this->input->post("draw"));
      $start = intval($this->input->post("start"));
      $length = intval($this->input->post("length"));
        $data_array_new = [];
        $data_array = $this->DailyPooja_model->PanchangaPoojaList($this->company_id);
        
       
        foreach($data_array as $r) {
            $viewButton ='<a class="btn  btn-sm btn-primary" href="'.site_url('viewPanchangaPooja/'.$r->row_id).'"title="View"><i class="fa fa-eye"></i></a>';
             if($this->role == ROLE_ADMIN ) {
             $editButton = '<a class="btn  btn-sm btn-info" href="'.site_url('editPanchangaPooja/'.$r->row_id).'"title="Edit"><i class="fas fa-edit"></i></i></a>';
             $deleteButton = '<a class="btn btn-sm btn-danger deleteDailyPooja" data-row_id='.$r->row_id.' href="#" title="Delete"><i class="fas fa-trash"></i></a>';
             $recieptButton = '<a href="'.site_url('panchangaReceiptPrint/'.$r->row_id).'" target="_blank">Receipt</a>';
            }else{
                $editButton='';
                $deleteButton='' ;
            }

            $data_array_new[] = array(
                // $r->row_id,
                 $r->devotee_name,
                 $r->event_type,
                 $r->masa,
                 $viewButton.' '.$editButton.' '.$deleteButton.' '.$recieptButton
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


    function editPanchangaPooja($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            if($row_id == null){
                redirect('eventListing');
            }
            $data['dpInfo'] = $this->DailyPooja_model->getDPDetails($row_id);
            $data['poojaInfo'] =$this->DailyPooja_model->getDailyPoojaInfo($this->company_id); 
            $data['eventInfo'] =$this->DailyPooja_model->getEventInfo($this->company_id); 
            $data['tithiInfo'] =$this->DailyPooja_model->getTithiInfo($this->company_id); 
            $data['nakshathraInfo'] =$this->DailyPooja_model->getNakshathraInfo($this->company_id);
            $data['masaInfo'] =$this->DailyPooja_model->getMasaInfo($this->company_id);  
            $data['rashiInfo'] =$this->DailyPooja_model->getRashiInfo($this->company_id); 
            $data['gothraInfo'] =$this->DailyPooja_model->getGothraInfo($this->company_id); 
            $data['occationInfo'] = $this->setting_model->getAllOccationInfo($this->company_id);
            $data['pakshaInfo'] = $this->setting_model->getAllPakshaInfo($this->company_id);
            $data['subscriptionInfo'] = $this->setting_model->getAllSubscriptionInfo($this->company_id);
            $this->global['pageTitle'] = $this->company_name.' : Edit Panchanga Pooja ';
            $this->loadViews("DailyPooja/editPanchangaPooja", $this->global, $data, NULL);
        }
    }




     
    function donationListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      

            // $devotee_id = $this->security->xss_clean($this->input->post('devotee_id'));  
            $devotee_name = $this->security->xss_clean($this->input->post('devotee_name'));
            $amount = $this->security->xss_clean($this->input->post('amount'));
            $collected_by_f = $this->security->xss_clean($this->input->post('collected_by_f'));
            $date = $this->security->xss_clean($this->input->post('date'));
            $seva_name_f = $this->security->xss_clean($this->input->post('seva_name_f'));
            $payment_type_filter = $this->security->xss_clean($this->input->post('payment_type_filter'));
            $donation_type = $this->security->xss_clean($this->input->post('donation_type'));

            // $data['devotee_id'] = $devotee_id;
            $data['devotee_name'] = $devotee_name;
            $data['amount'] = $amount;
            $data['collected_by_f'] = $collected_by_f;
            // $data['date'] = $date;
            $data['seva_name_f'] = $seva_name_f;
            $data['payment_type_filter'] = $payment_type_filter;
            $data['donation_type'] = $donation_type;

            $filter['devotee_name'] = $devotee_name;
            $filter['amount'] = $amount;
            $filter['collected_by_f'] = $collected_by_f;
            // $filter['date'] = $date;
            $filter['seva_name_f'] = $seva_name_f;
            $filter['payment_type_filter'] = $payment_type_filter;
            $filter['donation_type'] = $donation_type;

            if(!empty($date)) {
                $data['date'] = date('d-m-Y',strtotime($date));
                $filter['date'] = date('Y-m-d',strtotime($date));
            } else {
                $data['date'] = "";
                $filter['date'] = "";
            }
            
            // $data['purposeInfo'] = $this->setting_model->getAllPurposeInfo($this->company_id);
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->DailyPooja_model->donationListingCount($filter,$this->company_id);
            $data['count'] =  $count;
			$returns = $this->paginationCompress ( "donationListing/", $count, 100 );
            $data['donationRecords'] = $this->DailyPooja_model->donationListing($filter,$this->company_id, $returns["page"], $returns["segment"]);
            $data['committeeInfo'] = $this->settings->getAllCommittetypeInfo($this->company_id);
            $data['purposeInfo'] = $this->settings->getAllPurposeInfo($this->company_id);
            $data['sevaInfo'] = $this->DailyPooja_model->getAllSevaInfo($this->company_id);
            $data['donationTypeInfo'] = $this->settings->getAllDonationTypeInfo($this->company_id);


            $this->global['pageTitle'] = $this->company_name.' :Donation Details ';
            $this->loadViews("DailyPooja/donation", $this->global, $data, NULL);
        }
    }



    public function addDonationDetails(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
             
                $in_date = $this->security->xss_clean($this->input->post('in_date'));
           
                $devotee_name = $this->security->xss_clean($this->input->post('devotee_name'));
                $amount = $this->security->xss_clean($this->input->post('amount'));
                // $quantity = $this->security->xss_clean($this->input->post('quantity'));
                $devotee_address = $this->security->xss_clean($this->input->post('devotee_address'));
                $purpose = $this->security->xss_clean($this->input->post('purpose'));    
                $payment_type = $this->security->xss_clean($this->input->post('payment_type'));    
                $seva_name = $this->security->xss_clean($this->input->post('seva_name'));    
                $committee_name = $this->security->xss_clean($this->input->post('committee_name')); 
                $mobile_number = $this->security->xss_clean($this->input->post('mobile_number')); 
                $reference_number = $this->security->xss_clean($this->input->post('reference_number')); 
                $note = $this->security->xss_clean($this->input->post('note')); 
                $email = $this->security->xss_clean($this->input->post('email')); 
                $donation_type = $this->security->xss_clean($this->input->post('donation_type'));
                $donation_amount = $this->security->xss_clean($this->input->post('donation_amount'));
                $type_of_donation = $this->security->xss_clean($this->input->post('type_of_donation'));


                $serialized_array = serialize($seva_name); 
                // $unserialized_array = unserialize($seva_name); 

                // var_dump($serialized_array); // gives back a string, perfectly for db saving!
                // var_dump($unserialized_array); // gives back the array again

                $seva_name_all = '';
                $seva_amount_all = '';
                $total_amount = 0;
                if(!empty($committee_name)){
                $committee_info = $this->committee_model->getCommitteeTypeById($committee_name);
                }
                if($donation_type == 'SEVA'){
                if(!empty($seva_name)){
                    foreach($seva_name as $seva){
                        if(!empty($seva)){
                    $seva_info = $this->DailyPooja_model->getSevaInfoById($seva);
                    $seva_name_all.= $seva_info->seva_name.',';
                    $seva_amount_all.= $seva_info->amount.',';
                    $total_amount+= $seva_info->amount;
                    }}
                }
              }else{
                $total_amount = $donation_amount;
              }
     
                // if($donation_from=='Devotee'){
                //     $name = $devotee_name;
                // }else{
                    $name = $committee_info->type;  
                // }
              
                $donationInfo = array(
                    'date'=>date('Y-m-d',strtotime($in_date)),
                    'name'=>$name,
                    'devotee_name' =>$devotee_name,
                    'committee_id'=>$committee_name,
                    'seva_id'    => $serialized_array,
                    'seva_name'    => $seva_name_all,
                    'seva_amount'  => $seva_amount_all,
                    'amount' =>  $total_amount,
                    // 'quantity' =>  $quantity,
                    'donation_type' =>$donation_type,
                    'address' => $devotee_address,
                    'purpose' =>$purpose,
                    'email'   => $email,
                    'note'    => $note,
                    'mobile_number' => $mobile_number,
                    'reference_number' => $reference_number,
                    'payment_type' =>$payment_type,
                    'type_of_donation' =>$type_of_donation,
                    'created_by'=> $this->company_id, 
                    'company_id'=> $this->company_id, 
                    'created_date_time'=>date('Y-m-d H:i:s'));

                  $return_id = $this->DailyPooja_model->addDonationInfoToDB($donationInfo);

                  $incomeInfo = array(
                    'income_date'=>date('Y-m-d',strtotime($in_date)),
                    'income_name'=> $donation_type,
                    'donation_id'    =>$return_id,
                    'amount' =>$total_amount,
                    'income_by' =>$devotee_name,
                    'payment_type' =>$payment_type,
                    'created_by'=> $this->company_id, 
                    'company_id'=> $this->company_id, 
                    'created_date_time'=>date('Y-m-d H:i:s'));

                  $this->income_model->addIncome($incomeInfo);

                    
                if($return_id > 0){

                    $this->session->set_flashdata('success', 'Donation added successfully');
                } else{
                    $this->session->set_flashdata('error', 'Donation adding failed');
                }   
                redirect('donationListing');
            
        }
    }


    public function deleteDonationDetail(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $sevaInfo = array('is_deleted' => 1);
            $result = $this->DailyPooja_model->updateDonationDetail($sevaInfo, $row_id);
             $this->DailyPooja_model->updateIncomeDetail($sevaInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }


    public function deletePurpose(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $sevaInfo = array('is_deleted' => 1);
            $result = $this->DailyPooja_model->updatePurposeDetail($sevaInfo, $row_id);
             $this->DailyPooja_model->updateIncomeDetail($sevaInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }
    public function donationReceiptPrint($row_id = NULL){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            error_reporting(0); 
            $data['donationInfo'] = $this->DailyPooja_model->getdonationInfoById($row_id);
            $data['companyLogo'] = $this->company_logo;
            $seva_name = $data['donationInfo']->seva_name;
            $seva_amount = $data['donationInfo']->seva_amount;

            $str_arr = preg_split ("/\,/", $seva_name); 
            $data['seva_name'] = $str_arr;

            $str_amount = preg_split ("/\,/", $seva_amount); 
            $data['seva_amount'] = $str_amount;
                      
            $this->global['pageTitle'] = ''.TAB_TITLE.' : Donation Receipt';
            // $this->loadViews("fees/feeReceiptPrint", $this->global, $data, null); 
            $mpdf = new \Mpdf\Mpdf(['tempDir' => sys_get_temp_dir().DIRECTORY_SEPARATOR.'mpdf','default_font' => 'timesnewroman','format' => 'A5']);
            // $mpdf->SetWatermarkImage(
            //     'assets/dist/img/bharathi_logo.png',
            //     0.2,
            //     array(110,100),
            //     array(45,35),
            // );
            $mpdf->showWatermarkImage = true;
            $mpdf->autoScriptToLang = true;
            $mpdf->autoLangToFont = true;
                        $mpdf->AddPage('P','','','','',7,7,7,7,8,8);
            $mpdf->SetTitle('Donation Receipt');

            $data['receipt_title_mgmt'] = EXCEL_TITLE;
            $html = $this->load->view('DailyPooja/donationReceipt',$data,true);
            $mpdf->WriteHTML($html);            
           
            $mpdf->Output('Donation_Receipt.pdf', 'I'); 
        } 
    }


    function sevaListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      

            $seva_name = $this->security->xss_clean($this->input->post('seva_name'));
            $amount = $this->security->xss_clean($this->input->post('amount'));

            $data['seva_name'] = $seva_name;
            $data['amount'] = $amount;

            $filter['seva_name'] = $seva_name;
            $filter['amount'] = $amount;
            
            $this->load->library('pagination');
            $count = $this->DailyPooja_model->sevaListingCount($filter,$this->company_id);
            $data['count'] =  $count;
			$returns = $this->paginationCompress ( "sevaListing/", $count, 100 );
            $data['sevaInfo'] = $this->DailyPooja_model->sevaListing($filter,$this->company_id, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = $this->company_name.' :Seva Details ';
            $this->loadViews("DailyPooja/seva", $this->global, $data, NULL);
        }
    }




    public function addSevaDetails(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
             
           
                $seva_name = $this->security->xss_clean($this->input->post('seva_name'));
                $amount = $this->security->xss_clean($this->input->post('amount')); 

              
                $sevaInfo = array(
                    'seva_name'=>$seva_name,
                    'amount' =>$amount,
                    'created_by'=> $this->company_id, 
                    'company_id'=> $this->company_id, 
                    'created_date'=>date('Y-m-d'));

                  $return_id = $this->DailyPooja_model->addSevaInfoToDB($sevaInfo);
                    
                if($return_id > 0){

                    $this->session->set_flashdata('success', 'Seva added successfully');
                } else{
                    $this->session->set_flashdata('error', 'Seva adding failed');
                }   
                redirect('sevaListing');
            
        }
    }




    public function deleteSevaDetail(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $sevaInfo = array('is_deleted' => 1);
            $result = $this->DailyPooja_model->updateSevaDetail($sevaInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }



    function editSevaDetail($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            if($row_id == null){
                redirect('eventListing');
            }
            $data['sevaInfo'] = $this->DailyPooja_model->getSevaInfoById($row_id);

      
            $this->global['pageTitle'] = $this->company_name.' : Edit Seva Info ';
            $this->loadViews("DailyPooja/editSevaInfo", $this->global, $data, NULL);
        }
    }



    public function updateSevaDetails(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
             
           
                $seva_name = $this->security->xss_clean($this->input->post('seva_name'));
                $amount = $this->security->xss_clean($this->input->post('amount')); 
                $row_id = $this->security->xss_clean($this->input->post('row_id')); 

              
                $sevaInfo = array(
                    'seva_name'=>$seva_name,
                    'amount' =>$amount,
                    'updated_by'=> $this->company_id, 
                    'company_id'=> $this->company_id, 
                    'updated_date'=>date('Y-m-d'));

                  $return_id = $this->DailyPooja_model->updateSevaDetail($sevaInfo,$row_id);
                    
                if($return_id > 0){

                    $this->session->set_flashdata('success', 'Seva Updated successfully');
                } else{
                    $this->session->set_flashdata('error', 'Seva Updation failed');
                }   
                redirect('editSevaPageView/'.$row_id);

            
        }
    }


    function editDonationView($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            if($row_id == null){
                redirect('donationListing');
            }
            $data['donationInfo'] = $this->DailyPooja_model->getdonationInfoById($row_id);
            $data['committeeInfo'] = $this->settings->getAllCommittetypeInfo($this->company_id);
            $data['purposeInfo'] = $this->settings->getAllPurposeInfo($this->company_id);
            $data['sevaInfo'] = $this->DailyPooja_model->getAllSevaInfo($this->company_id);
            $data['donationTypeInfo'] = $this->settings->getAllDonationTypeInfo($this->company_id);
            $data['sevaIdArray'] = unserialize($data['donationInfo']->seva_id);
      
            $this->global['pageTitle'] = $this->company_name.' : Edit Donation Info ';
            $this->loadViews("DailyPooja/editDonationInfo", $this->global, $data, NULL);
        }
    }




    public function updateDonationDetails(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
             
                $in_date = $this->security->xss_clean($this->input->post('in_date'));
           
                $devotee_name = $this->security->xss_clean($this->input->post('devotee_name'));
                $amount = $this->security->xss_clean($this->input->post('amount'));
                // $quantity = $this->security->xss_clean($this->input->post('quantity'));
                $devotee_address = $this->security->xss_clean($this->input->post('devotee_address'));
                $purpose = $this->security->xss_clean($this->input->post('purpose'));    
                $payment_type = $this->security->xss_clean($this->input->post('payment_type'));    
                $seva_name = $this->security->xss_clean($this->input->post('seva_name'));    
                $committee_name = $this->security->xss_clean($this->input->post('committee_name')); 
                $mobile_number = $this->security->xss_clean($this->input->post('mobile_number')); 
                $reference_number = $this->security->xss_clean($this->input->post('reference_number')); 
                $note = $this->security->xss_clean($this->input->post('note')); 
                $email = $this->security->xss_clean($this->input->post('email')); 
                $donation_type = $this->security->xss_clean($this->input->post('donation_type')); 
                $donation_amount = $this->security->xss_clean($this->input->post('donation_amount')); 
                $type_of_donation = $this->security->xss_clean($this->input->post('type_of_donation')); 

                $serialized_array = serialize($seva_name); 

                $row_id = $this->security->xss_clean($this->input->post('row_id')); 
                $seva_name_all = '';
                $seva_amount_all = '';
                $total_amount = 0;

                if(!empty($committee_name)){
                $committee_info = $this->committee_model->getCommitteeTypeById($committee_name);
                }

                    if($donation_type == 'SEVA'){
                        if(!empty($seva_name)){
                            foreach($seva_name as $seva){
                                if(!empty($seva)){
                            $seva_info = $this->DailyPooja_model->getSevaInfoById($seva);
                            $seva_name_all.= $seva_info->seva_name.',';
                            $seva_amount_all.= $seva_info->amount.',';
                            $total_amount+= $seva_info->amount;
                            }
                            }
                        }
                      }else{
                        $total_amount = $donation_amount;
                      }
     
                // if($donation_from=='Devotee'){
                //     $name = $devotee_name;
                // }else{
                    $name = $committee_info->type;  
                // }
              
                $donationInfo = array(
                    'date'=>date('Y-m-d',strtotime($in_date)),
                    'name'=>$name,
                    'devotee_name' =>$devotee_name,
                    'committee_id'=>$committee_name,
                    'seva_id'    => $serialized_array,
                    'seva_name'    => $seva_name_all,
                    'seva_amount'    => $seva_amount_all,
                    'amount' =>  $total_amount,
                    // 'quantity' =>  $quantity,
                    'type_of_donation' => $type_of_donation,
                    'donation_type' =>$donation_type,
                    'address' => $devotee_address,
                    'purpose' =>$purpose,
                    'email'   => $email,
                    'note'    => $note,
                    'mobile_number' => $mobile_number,
                    'reference_number' => $reference_number,
                    'payment_type' =>$payment_type,
                    'updated_by'=> $this->company_id, 
                    'company_id'=> $this->company_id, 
                    'updated_date_time'=>date('Y-m-d H:i:s'));

                  $return_id = $this->DailyPooja_model->updateDonationDetail($donationInfo,$row_id);

                  $incomeInfo = array(
                    'income_date'=>date('Y-m-d',strtotime($in_date)),
                    'income_name'=> $donation_type,
                    // 'donation_id'    =>$return_id,
                    'amount' => $total_amount,
                    'income_by' =>$devotee_name,
                    'payment_type' =>$payment_type,
                    'created_by'=> $this->company_id, 
                    'company_id'=> $this->company_id, 
                    'created_date_time'=>date('Y-m-d H:i:s'));

                  $this->DailyPooja_model->updateIncomeDetail($incomeInfo,$row_id);

                    
                if($return_id > 0){

                    $this->session->set_flashdata('success', 'Donation Updated successfully');
                } else{
                    $this->session->set_flashdata('error', 'Donation Updation failed');
                }   
                redirect('editDonationView/'.$row_id);
            
        }
    }




    function getSevaInfoByDonationId()
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $donation_id = $this->security->xss_clean($this->input->post('donation_id')); 
            $donationInfo = $this->DailyPooja_model->getdonationInfoById($donation_id);
            $data['sevaIdArray'] = unserialize($donationInfo->seva_id);
            echo json_encode($data);
            exit(0);

        }
    }


    public function deleteDonationType(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $donationInfo = array('is_deleted' => 1);
            $result = $this->DailyPooja_model->updateDonationTypeDetail($donationInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }

}

?>