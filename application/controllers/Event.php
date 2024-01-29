<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Event extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Event_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function is used to load the committee list
     */
    function eventListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {   
            $data['eventInfo'] =$this->Event_model->getEventInfo($this->company_id); 
            // $data['committeeTypeInfo'] =$this->Event_model->getCommitteeTypeInfo($this->company_id);  
            $this->global['pageTitle'] = $this->company_name.' :Event Details ';
            $this->loadViews("event/event", $this->global, $data, NULL);
        }
    }
    function getEventDetails()
    {
      $draw = intval($this->input->post("draw"));
      $start = intval($this->input->post("start"));
      $length = intval($this->input->post("length"));
        $data_array_new = [];
        $data_array = $this->Event_model->eventList($this->company_id);
        
       
        foreach($data_array as $r) {
            if($r->event_date=='1970-01-01'){$event_date='';} else { $event_date =date('d-m-Y',strtotime($r->event_date));}

             if($this->role == ROLE_ADMIN ) {
             $editButton = '<a class="btn  btn-sm btn-info" href="'.site_url('editEvent/'.$r->row_id).'"title="Edit"><i class="fas fa-edit"></i></i></a>';
             $deleteButton = '<a class="btn btn-sm btn-danger deleteEvent" data-row_id='.$r->row_id.' href="#" title="Delete"><i class="fas fa-trash"></i></a>';
            }else{
                $editButton='';
                $deleteButton='' ;
            }

            $data_array_new[] = array(
                $r->row_id,
                 $r->events,
                 $event_date,
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
    /**
     * This function is used to add new committee to the system
     */
    function addEventDate()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {

                $event_id = $this->security->xss_clean($this->input->post('events'));
                $event_date = $this->security->xss_clean($this->input->post('event_date'));
                $events_date = date('Y-m-d',strtotime($event_date));
                $eventInfo = array('event_id'=>$event_id,'event_date'=>$events_date,'company_id'=>$this->company_id);

                $result = $this->Event_model->addEvents($eventInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Event added successfully');
                } else{
                    $this->session->set_flashdata('error', 'Event creation failed');
                }
                redirect('eventListing');
            }
    }

    function editEvent($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {

            if($row_id == null){
                redirect('eventListing');
            }
            $data['event_Info'] = $this->Event_model->getEventDetails($row_id);
            $data['eventInfo'] =$this->Event_model->getEventInfo($this->company_id); 
            $this->global['pageTitle'] = $this->company_name.' : Edit event ';
            $this->loadViews("event/editEvent", $this->global, $data, NULL);
        }
    }

    function updateEvent()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else { 
            $row_id = $this->input->post('row_id');
           

            $event_id = $this->security->xss_clean($this->input->post('events'));
            $event_date = $this->security->xss_clean($this->input->post('event_date'));
            $events_date = date('Y-m-d',strtotime($event_date));

               
                $eventInfo = array('event_id'=>$event_id,'event_date'=>$events_date,'company_id'=>$this->company_id);

               
                $result = $this->Event_model->updateEvent($eventInfo,$row_id);

                if($result > 0){
                    $this->session->set_flashdata('success', 'Event updated successfully');
                }
                else{
                    $this->session->set_flashdata('error', 'Event update failed');
                }
                redirect('editEvent/'.$row_id);
            }
        // }
    }

    public function deleteEvent()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $eventsInfo = array('is_deleted' => 1);
            $result = $this->Event_model->deleteEvent($row_id,$eventsInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }
   
   
}

?>