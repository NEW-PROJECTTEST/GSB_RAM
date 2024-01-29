<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class DailyDetails extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DailyDetails_model');
        $this->load->model('DailyPooja_model');
        $this->load->model('setting_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function is used to load the committee list
     */
    function dailyDetailsListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {   
            // $data['eventInfo'] =$this->DailyDetails_model->getDailyInfo($this->company_id); 
        $data['eventInfo'] =$this->DailyPooja_model->getEventInfo($this->company_id); 
        $data['tithiInfo'] =$this->DailyPooja_model->getTithiInfo($this->company_id); 
        $data['nakshathraInfo'] =$this->DailyPooja_model->getNakshathraInfo($this->company_id);
        $data['masaInfo'] =$this->DailyPooja_model->getMasaInfo($this->company_id);  
        $data['rashiInfo'] =$this->DailyPooja_model->getRashiInfo($this->company_id); 
        $data['gothraInfo'] =$this->DailyPooja_model->getGothraInfo($this->company_id); 
        $data['pakshaInfo'] = $this->setting_model->getAllPakshaInfo($this->company_id);
            // $data[''] = "";
            // $data['committeeTypeInfo'] =$this->Event_model->getCommitteeTypeInfo($this->company_id);  
            $this->global['pageTitle'] = $this->company_name.' :Daily Details ';
            $this->loadViews("dailyDetails/dailyDetails", $this->global, $data, NULL);
        }
    }
    function getDailyDetails()
    {
      $draw = intval($this->input->post("draw"));
      $start = intval($this->input->post("start"));
      $length = intval($this->input->post("length"));
        $data_array_new = [];
        $data_array = $this->DailyDetails_model->dailyDetailsList($this->company_id);
        
       log_message('debug',"sample=".print_r($data_array,true));
        foreach($data_array as $r) {
             if($this->role == ROLE_ADMIN ) {
                if($r->date=='1970-01-01'){$date='';} else { $date =date('d-m-Y',strtotime($r->date));}

             $editButton = '<a class="btn  btn-sm btn-info" href="'.site_url('editDailyDetails/'.$r->row_id).'"title="Edit"><i class="fas fa-edit"></i></i></a>';
             $deleteButton = '<a class="btn btn-sm btn-danger deleteDailyDetails" data-row_id='.$r->row_id.' href="#" title="Delete"><i class="fas fa-trash"></i></a>';
            }else{
                $editButton='';
                $deleteButton='' ;
            }

            $data_array_new[] = array(
                $date,
                 $r->nakshathra,
                 $r->paksha,
                 $r->tithi,
                 $editButton.' '.$deleteButton
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



    function addDailyDetails(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {

                $datedp = $this->security->xss_clean($this->input->post('date'));
                $panchangadate = date('Y-m-d',strtotime($datedp));
                $eventdp = $this->security->xss_clean($this->input->post('event_id'));
                $tithidp = $this->security->xss_clean($this->input->post('tithi_id'));
                $nakshathradp = $this->security->xss_clean($this->input->post('nakshathra_id'));
                $masadp = $this->security->xss_clean($this->input->post('masa_id'));
                $rashidp = $this->security->xss_clean($this->input->post('rashi_id'));
                $gothradp = $this->security->xss_clean($this->input->post('gothra_id'));
                $paksha_id = $this->security->xss_clean($this->input->post('paksha_id'));                                      

                $dailyInfo = array(
                'date'=>$panchangadate,
                'event_id'=>$eventdp,
                'tithi_id'=>$tithidp,
                'nakshathra_id'=>$nakshathradp,
                'masa_id'=>$masadp,
                'rashi_id'=>$rashidp,
                'gothra_id'=>$gothradp,
                'paksha_id'=>$paksha_id,
                'company_id'=>$this->company_id
            );

                $result = $this->DailyDetails_model->addDetails($dailyInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New details added successfully');
                } else{
                    $this->session->set_flashdata('error', 'Details creation failed');
                }
                redirect('dailyDetailsListing');
            }
    }

    function addDetails(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {

                $datedp = $this->security->xss_clean($this->input->post('date'));
                $panchangadate = date('Y-m-d',strtotime($datedp));

                $eventdp = $this->security->xss_clean($this->input->post('event_id'));
                $tithidp = $this->security->xss_clean($this->input->post('tithi_id'));
                $nakshathradp = $this->security->xss_clean($this->input->post('nakshathra_id'));
                $masadp = $this->security->xss_clean($this->input->post('masa_id'));
                $rashidp = $this->security->xss_clean($this->input->post('rashi_id'));
                $gothradp = $this->security->xss_clean($this->input->post('gothra_id'));
                $paksha_id = $this->security->xss_clean($this->input->post('paksha_id'));                           

                $dailyInfo = array(
                'date'=>$panchangadate,
                'event_id'=>$eventdp,
                'tithi_id'=>$tithidp,
                'nakshathra_id'=>$nakshathradp,
                'masa_id'=>$masadp,
                'rashi_id'=>$rashidp,
                'paksha_id' =>$paksha_id,
                'gothra_id'=>$gothradp,
                'company_id'=>$this->company_id
            );

                $result = $this->DailyDetails_model->addDetails($dailyInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New details added successfully');
                } else{
                    $this->session->set_flashdata('error', 'Details creation failed');
                }
                redirect('Employeeindex');
            }
    }
  

    function editDailyDetails($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            if($row_id == null){
                redirect('eventListing');
            }
            $data['Details'] =$this->DailyDetails_model->getDPDetails($row_id); 
            $data['eventInfo'] =$this->DailyPooja_model->getEventInfo($this->company_id); 
            $data['tithiInfo'] =$this->DailyPooja_model->getTithiInfo($this->company_id); 
            $data['nakshathraInfo'] =$this->DailyPooja_model->getNakshathraInfo($this->company_id);
            $data['masaInfo'] =$this->DailyPooja_model->getMasaInfo($this->company_id);  
            $data['rashiInfo'] =$this->DailyPooja_model->getRashiInfo($this->company_id); 
            $data['gothraInfo'] =$this->DailyPooja_model->getGothraInfo($this->company_id); 
            $data['pakshaInfo'] = $this->setting_model->getAllPakshaInfo($this->company_id);
            $this->global['pageTitle'] = $this->company_name.' : Edit Daily Details ';
            $this->loadViews("dailyDetails/editDailyDetails", $this->global, $data, NULL);
        }
    }

    function updateDailyDetails()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else { 
            $row_id = $this->input->post('row_id');
           
            $datedp = $this->security->xss_clean($this->input->post('date'));
            $panchangadate = date('Y-m-d',strtotime($datedp));
            $eventdp = $this->security->xss_clean($this->input->post('event_id'));
            $tithidp = $this->security->xss_clean($this->input->post('tithi_id'));
            $nakshathradp = $this->security->xss_clean($this->input->post('nakshathra_id'));
            $masadp = $this->security->xss_clean($this->input->post('masa_id'));
            $rashidp = $this->security->xss_clean($this->input->post('rashi_id'));
            $gothradp = $this->security->xss_clean($this->input->post('gothra_id'));
            $paksha_id = $this->security->xss_clean($this->input->post('paksha_id'));
            // $event_id = $this->security->xss_clean($this->input->post('events'));
            // $event_date = $this->security->xss_clean($this->input->post('event_date'));
            $dailyInfo = array(
                // 'devotee_id'=>$devotee_id,
                // 'event_type'=>$event_type,
                'date'=>$panchangadate,
                'event_id'=>$eventdp,
                'tithi_id'=>$tithidp,
                'nakshathra_id'=>$nakshathradp,
                'masa_id'=>$masadp,
                'rashi_id'=>$rashidp,
                'paksha_id' =>$paksha_id,
                'gothra_id'=>$gothradp,
                'company_id'=>$this->company_id
            );
               

               
            $result = $this->DailyDetails_model->updateDailyDetails($dailyInfo,$row_id);

                if($result > 0){
                    $this->session->set_flashdata('success', 'Details updated successfully');
                }
                else{
                    $this->session->set_flashdata('error', 'Details update failed');
                }
                redirect('editDailyDetails/'.$row_id);
            }
        // }
    }

    public function deleteDailyDetails()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $DailyInfo = array('is_deleted' => 1);
            $result = $this->DailyDetails_model->deleteDailyDetails($row_id,$DailyInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }
   
   
}

?>