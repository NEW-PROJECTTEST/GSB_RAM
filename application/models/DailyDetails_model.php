<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class DailyDetails_model extends CI_Model
{
  
    

    function dailyDetailsList($company_id)
    {
        $this->db->select('event.row_id,event.date,paksha.paksha,event.event_id,event.tithi_id,event.nakshathra_id,event.masa_id,event.rashi_id,event.gothra_id,events.events,tithi.tithi,nakshathra.nakshathra,masa.masa,rashi.rashi,gothra.gothra');
        $this->db->from('tbl_daily_details as event');
        $this->db->join('tbl_events as events','events.row_id=event.event_id','left');
        $this->db->join('tbl_tithi as tithi','tithi.row_id=event.tithi_id','left');
        $this->db->join('tbl_nakshathra as nakshathra','nakshathra.row_id=event.nakshathra_id','left');
        $this->db->join('tbl_masa as masa','masa.row_id=event.masa_id','left');
        $this->db->join('tbl_rashi as rashi','rashi.row_id=event.rashi_id','left');
        $this->db->join('tbl_gothra as gothra','gothra.row_id=event.gothra_id','left');
        $this->db->join('tbl_paksha as paksha','paksha.row_id=event.paksha_id','left');
        $this->db->where('event.company_id',$company_id);
        $this->db->where('event.is_deleted', 0);
        // $this->db->order_by('event.row_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
  
  function deleteDailyDetails($row_id,$DailyInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_daily_details', $DailyInfo);
        return $this->db->affected_rows();
    }


function addDetails($dailyInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_daily_details', $dailyInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function updateDailyDetails($dailyInfo,$row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_daily_details', $dailyInfo);
        return TRUE;
    }

    function getDPDetails($row_id)
    {
        $this->db->select('dailypooja.row_id,paksha.paksha,dailypooja.paksha_id,dailypooja.event_id,dailypooja.tithi_id,dailypooja.nakshathra_id,dailypooja.masa_id,dailypooja.rashi_id,dailypooja.gothra_id,dailypooja.date,events.events,tithi.tithi,nakshathra.nakshathra,masa.masa,rashi.rashi,gothra.gothra');
        $this->db->from('tbl_daily_details as dailypooja');
        // $this->db->join('tbl_devotee as devotee','devotee.row_id=dailypooja.devotee_id','left');
        $this->db->join('tbl_events as events','events.row_id=dailypooja.event_id','left');
        $this->db->join('tbl_tithi as tithi','tithi.row_id=dailypooja.tithi_id','left');
        $this->db->join('tbl_nakshathra as nakshathra','nakshathra.row_id=dailypooja.nakshathra_id','left');
        $this->db->join('tbl_masa as masa','masa.row_id=dailypooja.masa_id','left');
        $this->db->join('tbl_rashi as rashi','rashi.row_id=dailypooja.rashi_id','left');
        $this->db->join('tbl_gothra as gothra','gothra.row_id=dailypooja.gothra_id','left');
        $this->db->join('tbl_paksha as paksha','paksha.row_id=dailypooja.paksha_id','left');
        $this->db->where('dailypooja.row_id', $row_id);
        $this->db->where('dailypooja.is_deleted', 0);
        $query = $this->db->get();      
        return $query->row();
    }    

}