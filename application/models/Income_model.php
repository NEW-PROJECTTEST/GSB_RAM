<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Income_model extends CI_Model
{
    function addIncome($incomeInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_income_info', $incomeInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function incomeListing($company_id)
    {
        $this->db->select('income.row_id,income.income_name,income.income_type_id,devotee.devotee_name,income.committee_id,income.devoote_id,committee.committee_name,income.income_by,income.income_date,income.amount,income.comment,type.income_type');
        $this->db->from('tbl_income_info as income');
         $this->db->join('tbl_income_type as type','type.row_id=income.income_type_id','left');
         $this->db->join('tbl_committee_info as committee','committee.row_id=income.committee_id','left');
         $this->db->join('tbl_devotee as devotee','devotee.row_id=income.devoote_id','left');
        $this->db->where('income.company_id',$company_id);
        $this->db->where('income.is_deleted', 0);
        $this->db->order_by('income.row_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function deleteSubscription($row_id,$incomeInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_income_info', $incomeInfo);
        return $this->db->affected_rows();
    }

    function updateIncome($incomeInfo,$row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_income_info', $incomeInfo);
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

 
 function updateDevoteeId($rowid,$devoteeArray)
 {
 
     $this->db->where('row_id',$rowid);
     $this->db->update('tbl_income_info', $devoteeArray);
     $query = $this->db->get();
     return TRUE;  
}


function updateCommitteeId($rowid,$committeeArray)
{

    $this->db->where('row_id',$rowid);
    $this->db->update('tbl_income_info', $committeeArray);
    $query = $this->db->get();
    return TRUE;  
}

function getIncomeInfoById($row_id,$company_id)
{
    $this->db->select('income.row_id,income.income_name,income.income_type_id,devotee.devotee_name,income.committee_id,income.devoote_id,committee.committee_name,income.income_by,income.income_date,income.amount,income.comment,type.income_type');
    $this->db->from('tbl_income_info as income');
     $this->db->join('tbl_income_type as type','type.row_id=income.income_type_id','left');
     $this->db->join('tbl_committee_info as committee','committee.row_id=income.committee_id','left');
     $this->db->join('tbl_devotee as devotee','devotee.row_id=income.devoote_id','left');
     $this->db->where('income.row_id',$row_id);
    $this->db->where('income.company_id',$company_id);
    $this->db->where('income.is_deleted', 0);
    $this->db->order_by('income.row_id', 'DESC');
    $query = $this->db->get();
        return $query->row();
}

}