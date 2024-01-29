<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Family_model extends CI_Model
{
    /**
     * This function is used to get the Family listing count
     */
    function familyListingCount($searchText = '',$filter='',$company_id)
    {
        $this->db->from('tbl_family_info as BaseTbl');
        $this->db->join('tbl_devotee as devoteTbl','devoteTbl.row_id = BaseTbl.row_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(devoteTbl.devotee_name LIKE '%".$searchText."%'
                            OR  devoteTbl.contact_number  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['devotee_name'])){
            $likeCriteria = "(devoteTbl.devotee_name  LIKE '%".$filter['devotee_name']."%')";
            $this->db->where($likeCriteria);
        }
        // if(!empty($filter['row_id'])){
        //     $this->db->where('BaseTbl.row_id', $filter['row_id']);
        // }
        if(!empty($filter['contact_number'])){
            $this->db->where('devoteTbl.contact_number', $filter['contact_number']);
        }
        // if(!empty($filter['email'])){
        //     $this->db->where('BaseTbl.email', $filter['email']);
        // }

        $this->db->where('BaseTbl.company_id',$company_id);
        $this->db->where('BaseTbl.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * This function is used to get the family listing count
     */
    function familyListing($searchText = '',$filter='',$company_id, $page, $segment)
    {
        $this->db->select('BaseTbl.row_id,devoteTbl.devotee_name,devoteTbl.devotee_address,devoteTbl.contact_number,BaseTbl.subscription_amt_id,sub.amount');
        $this->db->from('tbl_family_info as BaseTbl');
        $this->db->join('tbl_devotee as devoteTbl','devoteTbl.row_id = BaseTbl.devotee_id','left');
        $this->db->join('tbl_subscription_amount as sub','sub.row_id = BaseTbl.subscription_amt_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(devoteTbl.devotee_name LIKE '%".$searchText."%'
                            OR  devoteTbl.contact_number  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['devotee_name'])){
            $likeCriteria = "(devoteTbl.devotee_name  LIKE '%".$filter['devotee_name']."%')";
            $this->db->where($likeCriteria);
        }
        // if(!empty($filter['row_id'])){
        //     $this->db->where('BaseTbl.row_id', $filter['row_id']);
        // }
        if(!empty($filter['contact_number'])){
            $this->db->where('devoteTbl.contact_number', $filter['contact_number']);
        }
        // if(!empty($filter['email'])){
        //     $this->db->where('BaseTbl.email', $filter['email']);
        // }

        $this->db->where('BaseTbl.company_id',$company_id);
        $this->db->where('BaseTbl.is_deleted', 0);
        $this->db->order_by('BaseTbl.row_id', 'ACES');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
     /**
     * This function is used to check whether  id is already exist or not
     */
    // function checkfamilyIDExists($family_id, $row_id = 0)
    // {
    //     $this->db->select("family_id");
    //     $this->db->from("tbl_family_info");
    //     $this->db->where("family_id", $family_id);   
    //     $this->db->where("is_deleted", 0);
    //     if($row_id != 0){
    //         $this->db->where("row_id !=", $row_id);
    //     } 
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    
    /**
     * This function is used to add new family to system
     */
    function addFamily($familyInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_family_info', $familyInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
      /**
     * This function is used to update the family information
     */
    function updateFamily($familyInfo, $row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_family_info', $familyInfo);
        return TRUE;
    }

    /**
     * This function is used to delete the family information
     */
    function deleteFamily($row_id, $familyInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_family_info', $familyInfo);
        return $this->db->affected_rows();
    }

     /* get family information by row_id*/
     function getFamilyInfoByEmpId($row_id)
     {
        $this->db->select('BaseTbl.row_id,devoteTbl.row_id as devotee_id,devoteTbl.devotee_name,devoteTbl.contact_number,BaseTbl.subscription_amt_id,sub.amount,comit.row_id as committee_id,comit.committee_name,BaseTbl.previous_mosque,BaseTbl.devotee_id as family_head_id');
        $this->db->from('tbl_family_info as BaseTbl');
        $this->db->join('tbl_devotee as devoteTbl','devoteTbl.row_id = BaseTbl.devotee_id','left');
        $this->db->join('tbl_committee_info as comit','comit.row_id = BaseTbl.referer_committee_id','left');
        $this->db->join('tbl_subscription_amount as sub','sub.row_id = BaseTbl.subscription_amt_id','left');
        $this->db->where('BaseTbl.row_id', $row_id);
        $this->db->where('BaseTbl.is_deleted', 0);
        // $this->db->where('BaseTbl.company_id',$company_id);
        $query = $this->db->get();
        return $query->row();
     }
   

     /**
     * This function is used to get all familys based on company_id
     */
    function getFamilyInfo($company_id){
        $this->db->select('family.row_id,devt.devotee_name');
        $this->db->from('tbl_family_info as family');
        $this->db->join('tbl_devotee as devt','devt.row_id = family.devotee_id');
        $this->db->where('family.company_id', $company_id);
        $this->db->where('family.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

     /**
     *   family Count
     */
    function totalFamilys($company_id)
    {
        $this->db->from('tbl_family_info as family');
        $this->db->where('family.company_id', $company_id);
        $this->db->where('family.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

   /* get family information by row_id for profile page*/
      function getFamilyInfoById($row_id)
      {
         $this->db->select('BaseTbl.row_id, BaseTbl.email, BaseTbl.family_name, BaseTbl.contact_number, BaseTbl.gender, BaseTbl.dob,BaseTbl.alternative_contact_number, BaseTbl.family_address, BaseTbl.profile_image');
         $this->db->from('tbl_family_info as BaseTbl'); 
         $this->db->where('BaseTbl.row_id', $row_id);
         $this->db->where('BaseTbl.is_deleted', 0);
         $query = $this->db->get();
         return $query->row();
      }

    function updateFamilyHead($familyHeadInfo,$devote_id){
        $this->db->where('row_id', $devote_id);
        $this->db->update('tbl_devotee', $familyHeadInfo);
        return TRUE;
    }

    function getFamilyMembers($family_id){
        $this->db->select('devt.devotee_name,devt.row_id,devt.relation_id,rel.relation_name');
        $this->db->from('tbl_devotee as devt');
        $this->db->join('tbl_relation as rel','rel.row_id = devt.relation_id','left');
        $this->db->where('devt.family_id',$family_id);
        $this->db->where('devt.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function removeFamilyHead($removeFamily,$family_id){
        $this->db->where('family_id', $family_id);
        $this->db->update('tbl_devotee', $removeFamily);
        return TRUE;
    }
    
    function getFamilyHeadId($family_id){
        $this->db->select('devotee_id');
        $this->db->from('tbl_family_info');
        $this->db->where('row_id', $family_id);
        $query = $this->db->get();
        $result = $query->row();        
        return $result->devotee_id;
    }

    function getSubscriptionAmtByFamId($family_id){
        $this->db->select('sub.amount as amount');
        $this->db->from('tbl_family_info as fam');
        $this->db->join('tbl_subscription_amount sub','sub.row_id = fam.subscription_amt_id','left');
        $this->db->where('fam.row_id', $family_id);
        $query = $this->db->get();
        $result = $query->row();        
        return $result->amount;
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

  