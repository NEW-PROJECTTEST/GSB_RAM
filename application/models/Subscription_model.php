<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Subscription_model extends CI_Model
{
    function addSubscription($subInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_subscription', $subInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function subscriptionListing($company_id)
    {
        $this->db->select('subscription.row_id,subscription.month,subscription.amount,devotee.devotee_name,year.year,subscription.year as year_id');
        $this->db->from('tbl_subscription as subscription');
        $this->db->join('tbl_family_info as family','family.row_id=subscription.family_id');
        $this->db->join('tbl_year as year','year.row_id=subscription.year');
        $this->db->join('tbl_devotee as devotee','devotee.row_id=family.devotee_id');
        $this->db->where('subscription.company_id',$company_id);
        $this->db->where('subscription.is_deleted', 0);
        $this->db->order_by('subscription.row_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function deleteSubscription($row_id,$subscriptionInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_subscription', $subscriptionInfo);
        return $this->db->affected_rows();
    }

    function updateSubscription($subInfo,$row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_subscription', $subInfo);
        return TRUE;
    }

    function getDepriciationYear($company_id)
   {
   
       $this->db->from('tbl_year as year'); 
       $this->db->where('year.company_id',$company_id);
       $this->db->where('year.is_deleted', 0);
       $query = $this->db->get();
       $result = $query->result();        
       return $result;  
 }

}