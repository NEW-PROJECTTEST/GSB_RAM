<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Devotee_model extends CI_Model
{
    function getCommitteeTypeInfo($company_id)
    {
    
        $this->db->from('tbl_committetype as committee'); 
        $this->db->where('committee.company_id',$company_id);
        $this->db->where('committee.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;  
  }

  function getTypeNameById($row_id){
    //$this->db->select('committee.row_id,committee.type');
    $this->db->from('tbl_committetype as committee');
    $this->db->where_in('committee.row_id', $row_id);
    $this->db->where('committee.is_deleted', 0);
    $query = $this->db->get();
    return $query->result();
}

    /**
     * This function is used to get the devotee listing count
     */
    function devoteeListingCount($searchText = '',$filter='',$company_id)
    {
        $this->db->from('tbl_devotee as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.devotee_address  LIKE '%".$searchText."%'
            OR  BaseTbl.devotee_name  LIKE '%".$searchText."%'
            OR  BaseTbl.contact_number  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['devotee_name'])){
            $likeCriteria = "(BaseTbl.devotee_name  LIKE '%".$filter['devotee_name']."%')";
            $this->db->where($likeCriteria);
        }
        // if(!empty($filter['row_id'])){
        //     $this->db->where('BaseTbl.row_id', $filter['row_id']);
        // }
        if(!empty($filter['contact_number'])){
            $this->db->where('BaseTbl.contact_number', $filter['contact_number']);
        }
        // if(!empty($filter['devotee_address'])){
        //     $this->db->where('BaseTbl.devotee_address', $filter['devotee_address']);
        // }
         if(!empty($filter['devotee_address'])){
            $likeCriteria = "(BaseTbl.devotee_address  LIKE '%".$filter['devotee_address']."%')";
            $this->db->where($likeCriteria);
        }

        if(!empty($filter['post_status_f'])){
            $this->db->where('BaseTbl.post_status', $filter['post_status_f']);
        }

        $this->db->where('BaseTbl.company_id',$company_id);
        $this->db->where('BaseTbl.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * This function is used to get the devotee listing count
     */
    function devoteeListing($searchText = '',$filter='',$company_id, $page, $segment)
    {
        $this->db->select('BaseTbl.row_id,BaseTbl.devotee_id, BaseTbl.devotee_address,BaseTbl.post_status,BaseTbl.devotee_name, BaseTbl.contact_number,BaseTbl.company_id');
        $this->db->from('tbl_devotee as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.devotee_address  LIKE '%".$searchText."%'
                            OR  BaseTbl.devotee_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.contact_number  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['devotee_name'])){
            $likeCriteria = "(BaseTbl.devotee_name  LIKE '%".$filter['devotee_name']."%')";
            $this->db->where($likeCriteria);
        }
        // if(!empty($filter['row_id'])){
        //     $this->db->where('BaseTbl.row_id', $filter['row_id']);
        // }
        if(!empty($filter['contact_number'])){
            $this->db->where('BaseTbl.contact_number', $filter['contact_number']);
        }
        if(!empty($filter['post_status_f'])){
            $this->db->where('BaseTbl.post_status', $filter['post_status_f']);
        }
        // if(!empty($filter['devotee_address'])){
        //     $this->db->where('BaseTbl.devotee_address', $filter['devotee_address']);
        // }
          if(!empty($filter['devotee_address'])){
            $likeCriteria = "(BaseTbl.devotee_address  LIKE '%".$filter['devotee_address']."%')";
            $this->db->where($likeCriteria);
        }

        $this->db->where('BaseTbl.company_id',$company_id);
        $this->db->where('BaseTbl.is_deleted', 0);
        $this->db->order_by('BaseTbl.row_id', 'ASEC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
     /**
     * This function is used to check whether  id is already exist or not
     */
    // function checkDevoteeIDExists($devotee_id, $row_id = 0)
    // {
    //     $this->db->select("devotee_id");
    //     $this->db->from("tbl_devotee");
    //     $this->db->where("devotee_id", $devotee_id);   
    //     $this->db->where("is_deleted", 0);
    //     if($row_id != 0){
    //         $this->db->where("row_id !=", $row_id);
    //     } 
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    
    /**
     * This function is used to add new devotee to system
     */
    function addDevotee($devoteeInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_devotee', $devoteeInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
      /**
     * This function is used to update the devotee information
     */
    function updateDevotee($devoteeInfo, $row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_devotee', $devoteeInfo);
        return TRUE;
    }

    /**
     * This function is used to delete the devotee information
     */
    function deleteDevotee($row_id, $devoteeInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_devotee', $devoteeInfo);
        return $this->db->affected_rows();
    }

     /* get devotee information by row_id*/
     function getDevoteeInfoByEmpId($row_id)
     {
     
         $this->db->select('BaseTbl.row_id,BaseTbl.post_status, BaseTbl.email,BaseTbl.devotee_id, BaseTbl.devotee_name, BaseTbl.contact_number, BaseTbl.gender, BaseTbl.dob,BaseTbl.alternative_contact_number, BaseTbl.devotee_address, BaseTbl.profile_image');
         $this->db->from('tbl_devotee as BaseTbl'); 
         $this->db->where('BaseTbl.row_id', $row_id);
         $this->db->where('BaseTbl.is_deleted', 0);
         $query = $this->db->get();
         return $query->row();
     }
   

     /**
     * This function is used to get all devotees based on company_id
     */
    function getDevoteeInfo($company_id){
        $this->db->from('tbl_devotee as devotee');
        $this->db->where('devotee.company_id', $company_id);
        $this->db->where('devotee.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

     /**
     *   devotee Count
     */
    function totalDevotees($company_id)
    {
        $this->db->from('tbl_devotee as devotee');
        $this->db->where('devotee.company_id', $company_id);
        $this->db->where('devotee.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

   /* get devotee information by row_id for profile page*/
      function getDevoteeInfoById($row_id)
      {
         $this->db->select('BaseTbl.row_id, BaseTbl.email, BaseTbl.devotee_name, BaseTbl.contact_number, BaseTbl.gender, BaseTbl.dob,BaseTbl.alternative_contact_number, BaseTbl.devotee_address, BaseTbl.profile_image');
         $this->db->from('tbl_devotee as BaseTbl'); 
         $this->db->where('BaseTbl.row_id', $row_id);
         $this->db->where('BaseTbl.is_deleted', 0);
         $query = $this->db->get();
         return $query->row();
      }

      function devoteeInfo($company_id)
      {
          $this->db->select('BaseTbl.row_id, BaseTbl.email, BaseTbl.devotee_name, BaseTbl.contact_number,BaseTbl.company_id');
          $this->db->from('tbl_devotee as BaseTbl');
          
          $this->db->where('BaseTbl.company_id',$company_id);
          $this->db->where('BaseTbl.is_deleted', 0);
          $this->db->order_by('BaseTbl.row_id', 'DESC');
          $query = $this->db->get();
          $result = $query->result();        
          return $result;
      }

      function devoteeInfoForReport($filter,$company_id)
    {
        $this->db->select('BaseTbl.row_id, BaseTbl.devotee_name, BaseTbl.devotee_id, BaseTbl.email, BaseTbl.gender, BaseTbl.contact_number, BaseTbl.devotee_address, BaseTbl.company_id');
        $this->db->from('tbl_devotee as BaseTbl');

        if(!empty($filter['post_status'])){
            $this->db->where('BaseTbl.post_status', $filter['post_status']);
        }
    
        $this->db->where('BaseTbl.company_id',$company_id);
        $this->db->where('BaseTbl.is_deleted', 0);
        $this->db->order_by('BaseTbl.row_id', 'ASEC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function addDevoteeInfo($devoteeInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_devotee_info', $devoteeInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
    
    

    function allDevoteeInfo($company_id)
    {
        $this->db->select('BaseTbl.row_id,BaseTbl.devotee_id, BaseTbl.devotee_address,BaseTbl.post_status,BaseTbl.devotee_name, BaseTbl.contact_number,BaseTbl.company_id');
        $this->db->from('tbl_devotee as BaseTbl');


        $this->db->where('BaseTbl.company_id',$company_id);
        $this->db->where('BaseTbl.is_deleted', 0);
        $this->db->order_by('BaseTbl.row_id', 'ASEC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    
}

  