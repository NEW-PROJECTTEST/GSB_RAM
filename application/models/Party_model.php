<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Party_model extends CI_Model
{
  
    /**
     * This function is used to get the party listing 
     */
    function partyListing($company_id)
    {
        $this->db->select('party.row_id,party.party_name,party.party_address,party.email,party.contact_number_one, party.contact_number_two');
        $this->db->from('tbl_party_info as party');
        $this->db->where('party.company_id',$company_id);
        $this->db->where('party.is_deleted', 0);
        $this->db->order_by('party.row_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to add new party to system
     */
    function addParty($partyInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_party_info', $partyInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }


    
    /**
     * This function is used to update the party information
     */
    function updateParty($partyInfo,$row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_party_info', $partyInfo);
        return TRUE;
    }
    
    /**
     * This function is used to delete the party information
     */
    function deleteParty($row_id,$partyInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_party_info', $partyInfo);
        return $this->db->affected_rows();
    }

     /**
     * This function is used to get  party information by row_id
     */
    function getPartyInfoById($row_id){
        $this->db->select('party.row_id,party.party_name,party.party_address,party.email,party.contact_number_one, party.contact_number_two');
        $this->db->from('tbl_party_info as party');
        $this->db->where('party.row_id', $row_id);
        $this->db->where('party.is_deleted', 0);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * This function is used to get  all partys
     */
    function getAllParty($company_id){
        $this->db->from('tbl_party_info as party');
        $this->db->where('party.company_id', $company_id);
        $this->db->where('party.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

      /**
     *  Own Party Count
     */
    function totalParty($company_id)
    {
        $this->db->from('tbl_party_info as party');
        $this->db->where('party.company_id', $company_id);
        $this->db->where('party.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    

}

  