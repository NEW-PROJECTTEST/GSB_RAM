<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class DailyPooja_model extends CI_Model
{
  
    /**
     * This function is used to get the Event listing 
     */
    

    function poojaList($company_id)
    {
        $this->db->select('dailypooja.row_id,devotee.devotee_address,dailypooja.devotee_id,dailypooja.event_type,devotee.devotee_name,dailypooja.month');
        $this->db->from('tbl_dailypooja_management_info as dailypooja');
        $this->db->join('tbl_devotee as devotee','devotee.row_id=dailypooja.devotee_id','left');
        $this->db->where('dailypooja.event_type', 'Date');
        $this->db->where('dailypooja.company_id',$company_id);
        $this->db->where('dailypooja.is_deleted', 0);
        $this->db->order_by('dailypooja.row_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function poojaListCount($company_id)
    {
        $this->db->select('dailypooja.row_id,dailypooja.devotee_id,dailypooja.event_type,devotee.devotee_name,dailypooja.month');
        $this->db->from('tbl_dailypooja_management_info as dailypooja');
        $this->db->join('tbl_devotee as devotee','devotee.row_id=dailypooja.devotee_id','left');
        $this->db->where('dailypooja.event_type', 'Date');
        $this->db->where('dailypooja.company_id',$company_id);
        $this->db->where('dailypooja.is_deleted', 0);
        $this->db->order_by('dailypooja.row_id', 'DESC');
        $query = $this->db->get();
        $result = $query->num_rows();        
        return $result;
    }

    
    function PanchangaPoojaList($company_id)
    {
        $this->db->select('dailypooja.row_id,dailypooja.devotee_id,masa.masa,dailypooja.event_type,devotee.devotee_name,dailypooja.month');
        $this->db->from('tbl_dailypooja_management_info as dailypooja');
        $this->db->join('tbl_devotee as devotee','devotee.row_id = dailypooja.devotee_id','left');
        $this->db->join('tbl_masa as masa','masa.row_id = dailypooja.masa_id','left');
        $this->db->where('dailypooja.event_type', 'Panchanga');
        $this->db->where('dailypooja.company_id',$company_id);
        $this->db->where('dailypooja.is_deleted', 0);
        $this->db->order_by('dailypooja.row_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
    function PanchangaPoojaCount($company_id)
    {
        $this->db->select('dailypooja.row_id,dailypooja.devotee_id,masa.masa,dailypooja.event_type,devotee.devotee_name,dailypooja.month');
        $this->db->from('tbl_dailypooja_management_info as dailypooja');
        $this->db->join('tbl_devotee as devotee','devotee.row_id = dailypooja.devotee_id','left');
        $this->db->join('tbl_masa as masa','masa.row_id = dailypooja.masa_id','left');
        $this->db->where('dailypooja.event_type', 'Panchanga');
        $this->db->where('dailypooja.company_id',$company_id);
        $this->db->where('dailypooja.is_deleted', 0);
        $this->db->order_by('dailypooja.row_id', 'DESC');
        $query = $this->db->get();
        $result = $query->num_rows();        
        return $result;
    }

    /**
     * This function is used to add new Event to system
     */
    function addPooja($eventInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_dailypooja_management_info', $eventInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }


    
    // /**
    //  * This function is used to update the Event information
    //  */
    function updateDailyPooja($eventInfo,$row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_dailypooja_management_info', $eventInfo);
        return TRUE;
    }
    
    

    //  /**
    //  * This function is used to get  committee information by row_id
    //  */

    function getDPDetails($row_id)
    {
        $this->db->select('dailypooja.row_id,devotee.devotee_address,dailypooja.month,dailypooja.remarks,devotee.contact_number,dailypooja.created_date_time,dailypooja.amount,occation.occation,paksha.paksha,dailypooja.paksha_id,dailypooja.occation_id,dailypooja.devotee_id,dailypooja.event_type,dailypooja.event_id,dailypooja.tithi_id,dailypooja.nakshathra_id,dailypooja.masa_id,dailypooja.rashi_id,dailypooja.gothra_id,dailypooja.date,devotee.devotee_name,events.events,tithi.tithi,nakshathra.nakshathra,masa.masa,rashi.rashi,gothra.gothra');
        $this->db->from('tbl_dailypooja_management_info as dailypooja');
        $this->db->join('tbl_devotee as devotee','devotee.row_id=dailypooja.devotee_id','left');
        $this->db->join('tbl_events as events','events.row_id=dailypooja.event_id','left');
        $this->db->join('tbl_tithi as tithi','tithi.row_id=dailypooja.tithi_id','left');
        $this->db->join('tbl_nakshathra as nakshathra','nakshathra.row_id=dailypooja.nakshathra_id','left');
        $this->db->join('tbl_masa as masa','masa.row_id=dailypooja.masa_id','left');
        $this->db->join('tbl_rashi as rashi','rashi.row_id=dailypooja.rashi_id','left');
        $this->db->join('tbl_gothra as gothra','gothra.row_id=dailypooja.gothra_id','left');
        $this->db->join('tbl_paksha as paksha','paksha.row_id=dailypooja.paksha_id','left');
        $this->db->join('tbl_occation as occation','occation.row_id=dailypooja.occation_id','left');
        $this->db->where('dailypooja.row_id', $row_id);
        $this->db->where('dailypooja.is_deleted', 0);
        $query = $this->db->get();      
        return $query->row();
    }    


    function getDPDetailsForReport($filter)
    {
        $this->db->select('dailypooja.row_id,dailypooja.remarks,dailypooja.created_date_time,dailypooja.amount,occation.occation,paksha.paksha,dailypooja.paksha_id,dailypooja.occation_id,dailypooja.devotee_id,dailypooja.event_type,dailypooja.event_id,dailypooja.tithi_id,dailypooja.nakshathra_id,dailypooja.masa_id,dailypooja.rashi_id,dailypooja.gothra_id,dailypooja.date,devotee.devotee_name,events.events,tithi.tithi,nakshathra.nakshathra,masa.masa,rashi.rashi,gothra.gothra');
        $this->db->from('tbl_dailypooja_management_info as dailypooja');
        $this->db->join('tbl_devotee as devotee','devotee.row_id=dailypooja.devotee_id','left');
        $this->db->join('tbl_events as events','events.row_id=dailypooja.event_id','left');
        $this->db->join('tbl_tithi as tithi','tithi.row_id=dailypooja.tithi_id','left');
        $this->db->join('tbl_nakshathra as nakshathra','nakshathra.row_id=dailypooja.nakshathra_id','left');
        $this->db->join('tbl_masa as masa','masa.row_id=dailypooja.masa_id','left');
        $this->db->join('tbl_rashi as rashi','rashi.row_id=dailypooja.rashi_id','left');
        $this->db->join('tbl_gothra as gothra','gothra.row_id=dailypooja.gothra_id','left');
        $this->db->join('tbl_paksha as paksha','paksha.row_id=dailypooja.paksha_id','left');
        $this->db->join('tbl_occation as occation','occation.row_id=dailypooja.occation_id','left');
        if(!empty($filter['pooja_fromDate'])){
            $this->db->where('dailypooja.created_date_time>=', $filter['pooja_fromDate']);
        }

        if(!empty($filter['pooja_toDate'])){
            $this->db->where('dailypooja.created_date_time<=', $filter['pooja_toDate']);
        }
        $this->db->where('dailypooja.event_type', 'Date');
        $this->db->where('dailypooja.is_deleted', 0);
        $query = $this->db->get();      
        return $query->result();
    }  



    function getPanchangaDetailsForReport($filter)
    {
        $this->db->select('dailypooja.row_id,dailypooja.remarks,dailypooja.created_date_time,dailypooja.amount,occation.occation,paksha.paksha,dailypooja.paksha_id,dailypooja.occation_id,dailypooja.devotee_id,dailypooja.event_type,dailypooja.event_id,dailypooja.tithi_id,dailypooja.nakshathra_id,dailypooja.masa_id,dailypooja.rashi_id,dailypooja.gothra_id,dailypooja.date,devotee.devotee_name,events.events,tithi.tithi,nakshathra.nakshathra,masa.masa,rashi.rashi,gothra.gothra');
        $this->db->from('tbl_dailypooja_management_info as dailypooja');
        $this->db->join('tbl_devotee as devotee','devotee.row_id=dailypooja.devotee_id','left');
        $this->db->join('tbl_events as events','events.row_id=dailypooja.event_id','left');
        $this->db->join('tbl_tithi as tithi','tithi.row_id=dailypooja.tithi_id','left');
        $this->db->join('tbl_nakshathra as nakshathra','nakshathra.row_id=dailypooja.nakshathra_id','left');
        $this->db->join('tbl_masa as masa','masa.row_id=dailypooja.masa_id','left');
        $this->db->join('tbl_rashi as rashi','rashi.row_id=dailypooja.rashi_id','left');
        $this->db->join('tbl_gothra as gothra','gothra.row_id=dailypooja.gothra_id','left');
        $this->db->join('tbl_paksha as paksha','paksha.row_id=dailypooja.paksha_id','left');
        $this->db->join('tbl_occation as occation','occation.row_id=dailypooja.occation_id','left');
        if(!empty($filter['pooja_fromDate'])){
            $this->db->where('dailypooja.created_date_time>=', $filter['pooja_fromDate']);
        }

        if(!empty($filter['pooja_toDate'])){
            $this->db->where('dailypooja.created_date_time<=', $filter['pooja_toDate']);
        }

        if(!empty($filter['masa_id'])){
            $this->db->where('dailypooja.masa_id', $filter['masa_id']);
        }

        if(!empty($filter['tithi_id'])){
            $this->db->where('dailypooja.tithi_id', $filter['tithi_id']);
        }

        $this->db->where('dailypooja.event_type', 'Panchanga');
        $this->db->where('dailypooja.is_deleted', 0);
        $this->db->order_by('dailypooja.row_id', 'ASC');
        $query = $this->db->get();      
        return $query->result();
    } 



    function getDailyPoojaInfo($company_id)
    { 
        $this->db->from('tbl_devotee as devotee');
        $this->db->where('devotee.is_deleted', 0);
        $this->db->where('devotee.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
  }

  function getEventInfo($company_id)
    { 
        $this->db->from('tbl_events as event');
        $this->db->where('event.is_deleted', 0);
        $this->db->where('event.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
  }

  function getTithiInfo($company_id)
    { 
        $this->db->from('tbl_tithi as tithi');
        $this->db->where('tithi.is_deleted', 0);
        $this->db->where('tithi.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
  }

  function getNakshathraInfo($company_id)
    { 
        $this->db->from('tbl_nakshathra as nakshathra');
        $this->db->where('nakshathra.is_deleted', 0);
        $this->db->where('nakshathra.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
  }

  function getMasaInfo($company_id)
    { 
        $this->db->from('tbl_masa as masa');
        $this->db->where('masa.is_deleted', 0);
        $this->db->where('masa.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
  }

  function getRashiInfo($company_id)
    { 
        $this->db->from('tbl_rashi as rashi');
        $this->db->where('rashi.is_deleted', 0);
        $this->db->where('rashi.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
  }

  function getGothraInfo($company_id)
    { 
        $this->db->from('tbl_gothra as gothra');
        $this->db->where('gothra.is_deleted', 0);
        $this->db->where('gothra.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
  }


  function deleteDailyPooja($row_id,$eventsInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_dailypooja_management_info', $eventsInfo);
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





function getDPDetailsMonthForReport($month,$filter)
{
    $this->db->select('dailypooja.row_id,dailypooja.remarks,dailypooja.created_date_time,dailypooja.amount,occation.occation,paksha.paksha,dailypooja.paksha_id,dailypooja.occation_id,dailypooja.devotee_id,dailypooja.event_type,dailypooja.event_id,dailypooja.tithi_id,dailypooja.nakshathra_id,dailypooja.masa_id,dailypooja.rashi_id,dailypooja.gothra_id,dailypooja.date,devotee.devotee_name,events.events,tithi.tithi,nakshathra.nakshathra,masa.masa,rashi.rashi,gothra.gothra');
    $this->db->from('tbl_dailypooja_management_info as dailypooja');
    $this->db->join('tbl_devotee as devotee','devotee.row_id=dailypooja.devotee_id','left');
    $this->db->join('tbl_events as events','events.row_id=dailypooja.event_id','left');
    $this->db->join('tbl_tithi as tithi','tithi.row_id=dailypooja.tithi_id','left');
    $this->db->join('tbl_nakshathra as nakshathra','nakshathra.row_id=dailypooja.nakshathra_id','left');
    $this->db->join('tbl_masa as masa','masa.row_id=dailypooja.masa_id','left');
    $this->db->join('tbl_rashi as rashi','rashi.row_id=dailypooja.rashi_id','left');
    $this->db->join('tbl_gothra as gothra','gothra.row_id=dailypooja.gothra_id','left');
    $this->db->join('tbl_paksha as paksha','paksha.row_id=dailypooja.paksha_id','left');
    $this->db->join('tbl_occation as occation','occation.row_id=dailypooja.occation_id','left');
    if(!empty($month)){
        $this->db->where('dailypooja.month', $month);
        // $this->db->where('dailypooja.date<=', $date);
    }
    if(!empty($filter['month_date'])){
        $this->db->where('dailypooja.date', $filter['month_date']);
        // $this->db->where('dailypooja.date<=', $date);
    }
    $this->db->where('dailypooja.event_type', 'Date');
    $this->db->where('dailypooja.is_deleted', 0);
    $this->db->order_by('dailypooja.date', 'ASC');
    $query = $this->db->get();      
    return $query->result();
} 




function donationListingCount($filter='',$company_id)
{
    $this->db->from('tbl_donation_info as BaseTbl');
    // $this->db->join('tbl_seva_details as seva','seva.seva_row_id=BaseTbl.row_id','left');
    // $this->db->join('tbl_seva as seva_base','seva_base.row_id=seva.seva_name_row_id','left');

    if(!empty($filter['devotee_name'])){
        $likeCriteria = "(BaseTbl.devotee_name  LIKE '%".$filter['devotee_name']."%')";
        $this->db->where($likeCriteria);
    }

    if(!empty($filter['collected_by_f'])){
        $likeCriteria = "(BaseTbl.name  LIKE '%".$filter['collected_by_f']."%')";
        $this->db->where($likeCriteria);
    }

    if(!empty($filter['seva_name_f'])){
        $likeCriteria = "(BaseTbl.seva_name  LIKE '%".$filter['seva_name_f']."%')";
        $this->db->where($likeCriteria);
    }

    if(!empty($filter['amount'])){
        $this->db->where('BaseTbl.amount', $filter['amount']);
    }
    if(!empty($filter['payment_type_filter'])){
        $this->db->where('BaseTbl.payment_type', $filter['payment_type_filter']);
    }

    if(!empty($filter['donation_type'])){
        $this->db->where('BaseTbl.donation_type', $filter['donation_type']);
    }

    $this->db->where('BaseTbl.company_id',$company_id);
    $this->db->where('BaseTbl.is_deleted', 0);
    $this->db->order_by('BaseTbl.row_id', 'desc');
    $query = $this->db->get();
    return $query->num_rows();
}




function donationListing($filter='',$company_id, $page, $segment)
{
    $this->db->from('tbl_donation_info as BaseTbl');
    // $this->db->join('tbl_seva_details as seva','seva.seva_row_id=BaseTbl.row_id','left');
    // $this->db->join('tbl_seva as seva_base','seva_base.row_id=seva.seva_name_row_id','left');
    if(!empty($filter['devotee_name'])){
        $likeCriteria = "(BaseTbl.devotee_name  LIKE '%".$filter['devotee_name']."%')";
        $this->db->where($likeCriteria);
    }

    if(!empty($filter['collected_by_f'])){
        $likeCriteria = "(BaseTbl.name  LIKE '%".$filter['collected_by_f']."%')";
        $this->db->where($likeCriteria);
    }

    if(!empty($filter['amount'])){
        $this->db->where('BaseTbl.amount', $filter['amount']);
    }

    // if(!empty($filter['collected_by_f'])){
    //     $this->db->where('BaseTbl.name', $filter['collected_by_f']);
    // }

    if(!empty($filter['seva_name_f'])){
        $likeCriteria = "(BaseTbl.seva_name  LIKE '%".$filter['seva_name_f']."%')";
        $this->db->where($likeCriteria);
    }

    if(!empty($filter['payment_type_filter'])){
        $this->db->where('BaseTbl.payment_type', $filter['payment_type_filter']);
    }

    if(!empty($filter['donation_type'])){
        $this->db->where('BaseTbl.donation_type', $filter['donation_type']);
    }

    $this->db->where('BaseTbl.company_id',$company_id);
    $this->db->where('BaseTbl.is_deleted', 0);
    $this->db->order_by('BaseTbl.row_id', 'desc');
    $this->db->limit($page, $segment);
    $query = $this->db->get();
    $result = $query->result();        
    return $result;
}



public function updateDonationDetail($donationInfo, $row_id) {
    $this->db->where('row_id', $row_id);
    $this->db->update('tbl_donation_info', $donationInfo);
    return TRUE;
}

public function updatePurposeDetail($donationInfo, $row_id) {
    $this->db->where('row_id', $row_id);
    $this->db->update('tbl_purpose', $donationInfo);
    return TRUE;
}
public function updateIncomeDetail($incomeInfo, $row_id) {
    $this->db->where('donation_id', $row_id);
    $this->db->update('tbl_income_info', $incomeInfo);
    return TRUE;
}


function getdonationInfoById($row_id)
{
    $this->db->select('BaseTbl.row_id,BaseTbl.created_date_time,BaseTbl.type_of_donation,BaseTbl.seva_amount,BaseTbl.donation_type,BaseTbl.email,BaseTbl.committee_id,BaseTbl.payment_type,BaseTbl.date,BaseTbl.purpose,BaseTbl.amount,BaseTbl.name,BaseTbl.address,purpose.purpose_name,BaseTbl.devotee_name,BaseTbl.reference_number,BaseTbl.mobile_number,BaseTbl.note,BaseTbl.seva_name,BaseTbl.seva_id,commi.type');
    $this->db->from('tbl_donation_info as BaseTbl');
    $this->db->join('tbl_purpose as purpose','purpose.row_id=BaseTbl.purpose','left');
    $this->db->join('tbl_committetype as commi','commi.row_id=BaseTbl.committee_id','left');
    $this->db->where('BaseTbl.row_id',$row_id);
    $this->db->where('BaseTbl.is_deleted', 0);
    $query = $this->db->get();
    $result = $query->row();        
    return $result;
}

function addDonationInfoToDB($donationInfo)
{
    $this->db->trans_start();
    $this->db->insert('tbl_donation_info', $donationInfo);
    $insert_id = $this->db->insert_id();
    $this->db->trans_complete();
    return $insert_id;
}



function donationInfoForReport($filter='',$company_id)
{
    $this->db->select('BaseTbl.row_id,BaseTbl.date,BaseTbl.amount,BaseTbl.devotee_name,BaseTbl.name,BaseTbl.donation_type,
    BaseTbl.seva_name,BaseTbl.type_of_donation,purpose.purpose_name,BaseTbl.email,BaseTbl.note,BaseTbl.address');
    $this->db->from('tbl_donation_info as BaseTbl');
    $this->db->join('tbl_purpose as purpose','purpose.row_id = BaseTbl.purpose','left');
    // $this->db->join('tbl_seva as seva_base','seva_base.row_id=seva.seva_name_row_id','left');
    if(!empty($filter['devotee_name'])){
        $likeCriteria = "(BaseTbl.name  LIKE '%".$filter['devotee_name']."%')";
        $this->db->where($likeCriteria);
    }

    if(!empty($filter['amount'])){
        $this->db->where('BaseTbl.amount', $filter['amount']);
    }

    if(!empty($filter['collected_by'])){
        $this->db->where('BaseTbl.name', $filter['collected_by']);
    }

    if(!empty($filter['payment_type_filter'])){
        $this->db->where('BaseTbl.payment_type', $filter['payment_type_filter']);
    }


    if(!empty($filter['donation_fromDate'])) {
      $this->db->where('BaseTbl.date >=', $filter['donation_fromDate']);
    }

    if(!empty($filter['donation_toDate'])) {
      $this->db->where('BaseTbl.date <=', $filter['donation_toDate']);
    }

    if(!empty($filter['purpose'])){
        $this->db->where('purpose.row_id', $filter['purpose']);
    }

    if(!empty($filter['donation_type'])){
        $this->db->where('BaseTbl.donation_type', $filter['donation_type']);
    }

    
    if(!empty($filter['type_of_donation'])){
        $this->db->where('BaseTbl.type_of_donation', $filter['type_of_donation']);
    }

    $this->db->where('BaseTbl.company_id',$company_id);
    $this->db->where('BaseTbl.is_deleted', 0);
    $this->db->order_by('BaseTbl.row_id', 'ASC');
    $query = $this->db->get();
    $result = $query->result();        
    return $result;
}




function sevaListingCount($filter='',$company_id)
{
    $this->db->from('tbl_seva_type as BaseTbl');
    // $this->db->join('tbl_seva_details as seva','seva.seva_row_id=BaseTbl.row_id','left');
    // $this->db->join('tbl_seva as seva_base','seva_base.row_id=seva.seva_name_row_id','left');

    if(!empty($filter['seva_name'])){
        $likeCriteria = "(BaseTbl.seva_name  LIKE '%".$filter['seva_name']."%')";
        $this->db->where($likeCriteria);
    }

    if(!empty($filter['amount'])){
        $this->db->where('BaseTbl.amount', $filter['amount']);
    }

    $this->db->where('BaseTbl.company_id',$company_id);
    $this->db->where('BaseTbl.is_deleted', 0);
    $this->db->order_by('BaseTbl.row_id', 'desc');
    $query = $this->db->get();
    return $query->num_rows();
}




function sevaListing($filter='',$company_id, $page, $segment)
{
    $this->db->from('tbl_seva_type as BaseTbl');
    // $this->db->join('tbl_seva_details as seva','seva.seva_row_id=BaseTbl.row_id','left');
    // $this->db->join('tbl_seva as seva_base','seva_base.row_id=seva.seva_name_row_id','left');
    if(!empty($filter['seva_name'])){
        $likeCriteria = "(BaseTbl.seva_name  LIKE '%".$filter['seva_name']."%')";
        $this->db->where($likeCriteria);
    }

    if(!empty($filter['amount'])){
        $this->db->where('BaseTbl.amount', $filter['amount']);
    }

    $this->db->where('BaseTbl.company_id',$company_id);
    $this->db->where('BaseTbl.is_deleted', 0);
    $this->db->order_by('BaseTbl.row_id', 'desc');
    $this->db->limit($page, $segment);
    $query = $this->db->get();
    $result = $query->result();        
    return $result;
}


function addSevaInfoToDB($donationInfo)
{
    $this->db->trans_start();
    $this->db->insert('tbl_seva_type', $donationInfo);
    $insert_id = $this->db->insert_id();
    $this->db->trans_complete();
    return $insert_id;
}


public function updateSevaDetail($sevaInfo, $row_id) {
    $this->db->where('row_id', $row_id);
    $this->db->update('tbl_seva_type', $sevaInfo);
    return TRUE;
}

function getSevaInfoById($row_id)
{
    $this->db->from('tbl_seva_type as BaseTbl');
  
    $this->db->where('BaseTbl.row_id',$row_id);
    $this->db->where('BaseTbl.is_deleted', 0);
    $query = $this->db->get();
    $result = $query->row();        
    return $result;
}

function getAllSevaInfo($row_id)
{
    $this->db->from('tbl_seva_type as BaseTbl');
  
    $this->db->where('BaseTbl.is_deleted', 0);
    $query = $this->db->get();
    $result = $query->result();        
    return $result;
}

public function updateDonationTypeDetail($donationInfo, $row_id) {
    $this->db->where('row_id', $row_id);
    $this->db->update('tbl_donation_type', $donationInfo);
    return TRUE;
}


}

  