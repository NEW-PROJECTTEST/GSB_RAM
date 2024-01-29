<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Event_model extends CI_Model
{
  
    /**
     * This function is used to get the Event listing 
     */
    

    function eventList($company_id)
    {
        $this->db->select('event.row_id,event.event_id,event.event_date,events.events');
        $this->db->from('tbl_event_info as event');
        $this->db->join('tbl_events as events','events.row_id=event.event_id','left');
        $this->db->where('event.company_id',$company_id);
        $this->db->where('event.is_deleted', 0);
        // $this->db->order_by('event.row_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to add new Event to system
     */
    function addEvents($eventInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_event_info', $eventInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }


    
    // /**
    //  * This function is used to update the Event information
    //  */
    function updateEvent($eventInfo,$row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_event_info', $eventInfo);
        return TRUE;
    }
    
    // // /**
    // //  * This function is used to delete the committee information
    // //  */
    // // function deleteCommittee($row_id,$committeeInfo)
    // // {
    // //     $this->db->where('row_id', $row_id);
    // //     $this->db->update('tbl_committee_info', $committeeInfo);
    // //     return $this->db->affected_rows();
    // // }

    //  /**
    //  * This function is used to get  committee information by row_id
    //  */

    function getEventDetails($row_id)
    {
        $this->db->select('event.row_id,event.event_id,event.event_date,events.events');
        $this->db->from('tbl_event_info as event');
        $this->db->join('tbl_events as events','events.row_id=event.event_id','left');
        $this->db->where('event.row_id', $row_id);
        $this->db->where('event.is_deleted', 0);
        $query = $this->db->get();      
        return $query->row();
    }

    // /**
    //  * This function is used to get  all committees
    //  */
    // function getAllCommittee($company_id){
    //     $this->db->from('tbl_committee_info as committee');
    //     $this->db->where('committee.company_id', $company_id);
    //     $this->db->where('committee.is_deleted', 0);
    //     $query = $this->db->get();
    //     $result = $query->result();        
    //     return $result;
    // }

    //   /**
    //  *  Own committee Count
    //  */
    // function totalCommittee($company_id)
    // {
    //     $this->db->from('tbl_committee_info as committee');
    //     $this->db->where('committee.company_id', $company_id);
    //     $this->db->where('committee.is_deleted', 0);
    //     $query = $this->db->get();
    //     return $query->num_rows();
    // }

    function getEventInfo($company_id)
    { 
        $this->db->from('tbl_events as event');
        $this->db->where('event.is_deleted', 0);
        $this->db->where('event.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
  }

  function deleteEvent($row_id,$eventsInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_event_info', $eventsInfo);
        return $this->db->affected_rows();
    }

//   function getRoleNameById($row_id){
//     $this->db->select('committee.row_id,committee.role');
//     $this->db->from('tbl_committee_role as committee');
//     $this->db->where('committee.row_id', $row_id);
//     $this->db->where('committee.is_deleted', 0);
//     $query = $this->db->get();
//     return $query->row();

    
// }

// function committeeInfoForReport($company_id)
// {
//     $this->db->select('committee.row_id,committee.committee_name,committee.committee_address,committee.email,committee.contact_number_one, committee.contact_number_two,committee.role,committee.profile_image');
//     $this->db->from('tbl_committee_info as committee');
//     $this->db->where('committee.company_id',$company_id);
//     $this->db->where('committee.is_deleted', 0);
//     $this->db->order_by('committee.row_id', 'DESC');
//     $query = $this->db->get();
//     $result = $query->result();        
//     return $result;
// }

// function getTypeNameById($row_id){
//     $this->db->select('committee.row_id,committee.type');
//     $this->db->from('tbl_committetype as committee');
//     $this->db->where('committee.row_id', $row_id);
//     $this->db->where('committee.is_deleted', 0);
//     $query = $this->db->get();
//     return $query->row();
// }
// function getCommitteeTypeInfo($company_id)
//     {
//         $this->db->from('tbl_committetype as comitee');
//         $this->db->where('comitee.is_deleted', 0);
//         $this->db->where('comitee.company_id',$company_id);
//         $query = $this->db->get();
//         return $query->result();
//   }

}

  