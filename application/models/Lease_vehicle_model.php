<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Lease_vehicle_model extends CI_Model
{
    /**
     * This function is used to get the LeaseVehicle listing count
     */
    function LeaseVehicleListingCount($searchText = '',$filter='',$company_id)
    {
        $this->db->select('LeaseVehicle.row_id,LeaseVehicle.vehicle_number,transporter.transporter_name,LeaseVehicle.contact_number_one, LeaseVehicle.contact_number_two, LeaseVehicle.email,LeaseVehicle.vehicle_condition,LeaseVehicle.transporter_rowid');
        $this->db->from('tbl_lease_vehicle_info as LeaseVehicle');
        $this->db->join('tbl_transporter as transporter', 'transporter.row_id = LeaseVehicle.transporter_rowid','left');
        if(!empty($searchText)) {
            $likeCriteria = "(LeaseVehicle.vehicle_number  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['vehicle_number'])){
            $this->db->where('LeaseVehicle.vehicle_number', $filter['vehicle_number']);
        }
        if(!empty($filter['vehicle_condition'])){
            $this->db->where('LeaseVehicle.vehicle_condition', $filter['vehicle_condition']);
        }
        if(!empty($filter['transporter_name'])){
            
            $likeCriteria = "(transporter.transporter_name  LIKE '%".$filter['transporter_name']."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['contact_number_one'])){
            $this->db->where('LeaseVehicle.contact_number_one', $filter['contact_number_one']);
        }
        $this->db->where('LeaseVehicle.company_id',$company_id);
        $this->db->where('LeaseVehicle.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * This function is used to get the LeaseVehicle listing 
     */
    function LeaseVehicleListing($searchText = '',$filter='',$company_id, $page, $segment)
    {
        $this->db->select('LeaseVehicle.row_id,LeaseVehicle.vehicle_number,LeaseVehicle.rc_number,LeaseVehicle.pan_number,
        transporter.transporter_name,LeaseVehicle.contact_number_one, LeaseVehicle.contact_number_two, LeaseVehicle.email,LeaseVehicle.vehicle_condition,LeaseVehicle.transporter_rowid');
        $this->db->from('tbl_lease_vehicle_info as LeaseVehicle');
        $this->db->join('tbl_transporter as transporter', 'transporter.row_id = LeaseVehicle.transporter_rowid','left');
        if(!empty($searchText)) {
            $likeCriteria = "(LeaseVehicle.vehicle_number  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['vehicle_number'])){
            $this->db->where('LeaseVehicle.vehicle_number', $filter['vehicle_number']);
        }
        if(!empty($filter['vehicle_condition'])){
            $this->db->where('LeaseVehicle.vehicle_condition', $filter['vehicle_condition']);
        }
        if(!empty($filter['transporter_name'])){
            
            $likeCriteria = "(transporter.transporter_name  LIKE '%".$filter['transporter_name']."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['contact_number_one'])){
            $this->db->where('LeaseVehicle.contact_number_one', $filter['contact_number_one']);
        }
        $this->db->where('LeaseVehicle.company_id',$company_id);
        $this->db->where('LeaseVehicle.is_deleted', 0);
        $this->db->order_by('LeaseVehicle.row_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to add new LeaseVehicle to system
     */
    function addLeaseVehicle($leaseVehicleInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_lease_vehicle_info', $leaseVehicleInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }


    /**
     * This function is used to update the LeaseVehicle information
     */
    function updateLeaseVehicle($leaseVehicleInfo,$row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_lease_vehicle_info', $leaseVehicleInfo);
        return TRUE;
    }
    
    /**
     * This function is used to delete the LeaseVehicle information
     */
    function deleteLeaseVehicle($row_id,$leaseVehicleInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_lease_vehicle_info', $leaseVehicleInfo);
        return $this->db->affected_rows();
    }

     /**
     * This function is used to get  LeaseVehicle information by row_id
     */
    function getLeaseVehicleInfoById($row_id){
        $this->db->select('LeaseVehicle.row_id,LeaseVehicle.vehicle_number,LeaseVehicle.rc_number,LeaseVehicle.pan_number,
        transporter.transporter_name,LeaseVehicle.contact_number_one, LeaseVehicle.contact_number_two, LeaseVehicle.email,LeaseVehicle.vehicle_condition,LeaseVehicle.transporter_rowid');
        $this->db->from('tbl_lease_vehicle_info as LeaseVehicle');
        $this->db->join('tbl_transporter as transporter','transporter.row_id = LeaseVehicle.transporter_rowid','left');
        $this->db->where('LeaseVehicle.row_id', $row_id);
        $this->db->where('LeaseVehicle.is_deleted', 0);
        $query = $this->db->get();
        return $query->row();
    }

      /**
     * This function is used to get  all Lease Vehicle
     */
    function getAllLeaseVehicles($company_id){
        $this->db->from('tbl_lease_vehicle_info as LeaseVehicle');
        $this->db->where('LeaseVehicle.company_id', $company_id);
        $this->db->where('LeaseVehicle.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
     /**
     *  Lease Vehicle Count
     */
    function totalLeaseVehicle($company_id)
    {
        $this->db->from('tbl_lease_vehicle_info as LeaseVehicle');
        $this->db->where('LeaseVehicle.company_id', $company_id);
        $this->db->where('LeaseVehicle.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function  getLeaseVehicleReport($transporter_name,$vehicle_number){
        $this->db->select('lease.row_id,lease.vehicle_number,transporter.transporter_name,transporter.contact_number,transporter.email,transporter.transporter_address,transporter.comments,transporter.transporter_account_number,lease.contact_number_one, lease.contact_number_two, lease.email,lease.vehicle_condition,lease.transporter_rowid');
        $this->db->from('tbl_lease_vehicle_info as lease');
        $this->db->join('tbl_transporter as transporter','transporter.row_id = lease.transporter_rowid','left');
        if ($transporter_name  == 'ALL' ) {
            $this->db->where('lease.is_deleted', 0);
        } else {
            $this->db->where('lease.is_deleted', 0);
            $this->db->where('transporter.transporter_name', $transporter_name);
        }  
        if($vehicle_number  == 'ALL' )
        {
        $this->db->where('lease.is_deleted', 0);
        } else  {
            $this->db->where('lease.is_deleted', 0);
            $this->db->where('lease.vehicle_number', $vehicle_number);
        }  
       
        $query = $this->db->get();
        return $query->result();
     }

}

  