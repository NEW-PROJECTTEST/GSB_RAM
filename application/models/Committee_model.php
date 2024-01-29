<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Committee_model extends CI_Model
{
  
    /**
     * This function is used to get the committee listing 
     */
    // function committeeListing($company_id)
    // {
    //     $this->db->select('committee.row_id,committee.committee_name,committee.committee_address,committee.email,committee.contact_number_one, committee.contact_number_two,committee.role,committee.type,committee.type_id,committee.profile_image');
    //     $this->db->from('tbl_committee_info as committee');
    //     $this->db->where('committee.company_id',$company_id);
    //     $this->db->where('committee.is_deleted', 0);
    //     $this->db->order_by('committee.row_id', 'DESC');
    //     $query = $this->db->get();
    //     $result = $query->result();        
    //     return $result;
    // }

    function committeeListing($company_id)
    {
        $this->db->select('committee.row_id,committee.year,committee.committee_name,committee.committee_address,committee.email,committee.contact_number_one, committee.contact_number_two,committee.role,committee.type_id,type.type,role.role,committee.profile_image');
        $this->db->from('tbl_committee_info as committee');
        $this->db->join('tbl_committee_role as role','role.row_id=committee.role_id','left');
        $this->db->join('tbl_committetype as type','type.row_id=committee.type_id','left');
        $this->db->where('committee.company_id',$company_id);
        $this->db->where('committee.is_deleted', 0);
        $this->db->order_by('committee.row_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function getCommitteeNameById($row_id)
    {
        $this->db->from('tbl_committee_info as committee');
        $this->db->where('committee.row_id',$row_id);
        $this->db->where('committee.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->row();        
        return $result;
    }

     function getCommitteeTypeById($row_id)
    {
        $this->db->from('tbl_committetype as committeetype');
        $this->db->where('committeetype.row_id',$row_id);
        $this->db->where('committeetype.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->row();        
        return $result;
    }
    
    /**
     * This function is used to add new committee to system
     */
    function addCommittee($committeeInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_committee_info', $committeeInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }


    
    /**
     * This function is used to update the committee information
     */
    function updateCommittee($committeeInfo,$row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_committee_info', $committeeInfo);
        return TRUE;
    }
    
    /**
     * This function is used to delete the committee information
     */
    function deleteCommittee($row_id,$committeeInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_committee_info', $committeeInfo);
        return $this->db->affected_rows();
    }

     /**
     * This function is used to get  committee information by row_id
     */
    function getCommitteeInfoById($row_id){
        $this->db->select('committee.row_id,committee.year,committee.committee_name,committee.committee_address,committee.email,committee.contact_number_one, committee.contact_number_two,committee.role_id,committee.type_id,comit.role,commit.type,committee.profile_image');
        $this->db->from('tbl_committee_info as committee');
        $this->db->join('tbl_committetype as commit','commit.row_id=committee.type_id','left');  
        $this->db->join('tbl_committee_role as comit','comit.row_id=committee.role_id','left');
        $this->db->where('committee.row_id', $row_id);
        $this->db->where('committee.is_deleted', 0);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * This function is used to get  all committees
     */
    function getAllCommittee($company_id){
        $this->db->from('tbl_committee_info as committee');
        $this->db->where('committee.company_id', $company_id);
        $this->db->where('committee.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

      /**
     *  Own committee Count
     */
    function totalCommittee($company_id)
    {
        $this->db->from('tbl_committee_info as committee');
        $this->db->where('committee.company_id', $company_id);
        $this->db->where('committee.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function getCommitteeRoleInfo($company_id)
    { 
        $this->db->from('tbl_committee_role as comitee');
        $this->db->where('comitee.is_deleted', 0);
        $this->db->where('comitee.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
  }

  function getRoleNameById($row_id){
    $this->db->select('committee.row_id,committee.role');
    $this->db->from('tbl_committee_role as committee');
    $this->db->where('committee.row_id', $row_id);
    $this->db->where('committee.is_deleted', 0);
    $query = $this->db->get();
    return $query->row();

    
}

function committeeInfoForReport($company_id)
{
    $this->db->select('committee.row_id,committee.year,committee.committee_name,committee.committee_address,committee.email,committee.contact_number_one, committee.contact_number_two,committee.role,committee.profile_image');
    $this->db->from('tbl_committee_info as committee');
    $this->db->where('committee.company_id',$company_id);
    $this->db->where('committee.is_deleted', 0);
    $this->db->order_by('committee.row_id', 'DESC');
    $query = $this->db->get();
    $result = $query->result();        
    return $result;
}

function getTypeNameById($row_id){
    $this->db->select('committee.row_id,committee.type');
    $this->db->from('tbl_committetype as committee');
    $this->db->where('committee.row_id', $row_id);
    $this->db->where('committee.is_deleted', 0);
    $query = $this->db->get();
    return $query->row();
}
function getCommitteeTypeInfo($company_id)
    {
        $this->db->from('tbl_committetype as comitee');
        $this->db->where('comitee.is_deleted', 0);
        $this->db->where('comitee.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
  }

}

  