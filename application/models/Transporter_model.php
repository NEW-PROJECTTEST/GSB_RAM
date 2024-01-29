<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Transporter_model extends CI_Model
{
  
    /**
     * This function is used to get the transporter listing 
     */
    function transporterListing($company_id)
    {
        $this->db->select('transporter.firm_name,transporter.row_id,transporter.transporter_name,transporter.transporter_address,transporter.contact_number, transporter.email,transporter.comments');
        $this->db->from(' tbl_transporter as transporter');
        $this->db->where('transporter.company_id',$company_id);
        $this->db->where('transporter.is_deleted', 0);
        $this->db->order_by('transporter.row_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
    

    /**
     * This function is used to add new transporter to system
     */
    function addTransporter($transporterInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_transporter', $transporterInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }


    
    /**
     * This function is used to update the transporter information
     */
    function updateTransporter($transporterInfo,$row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update(' tbl_transporter', $transporterInfo);
        return TRUE;
    }
    
    /**
     * This function is used to delete the transporter information
     */
    function deleteTransporter($row_id,$transporterInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update(' tbl_transporter', $transporterInfo);
        return $this->db->affected_rows();
    }

     /** 
     * This function is used to get  transporter information by row_id
     */
    function getTransporterInfoById($row_id){
        $this->db->select('transporter.firm_name,transporter.row_id,transporter.transporter_name,transporter.transporter_address,transporter.contact_number, transporter.email,transporter.transporter_account_number,transporter.comments');
        $this->db->from(' tbl_transporter as transporter');
        $this->db->where('transporter.row_id', $row_id);
        $this->db->where('transporter.is_deleted', 0);
        $query = $this->db->get();
        return $query->row();
    }

      /**
     * This function is used to get  all Transporters
     */
    function getAllTransporters($company_id){
        $this->db->from('tbl_transporter as transporter');
        $this->db->where('transporter.company_id', $company_id);
        $this->db->where('transporter.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
     /**
     *  Lease Transporters Count
     */
    function totaltransporter($company_id)
    {
        $this->db->from('tbl_transporter as transporter');
        $this->db->where('transporter.company_id', $company_id);
        $this->db->where('transporter.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    

}

  