<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Own_vehicle_model extends CI_Model
{
    /**
     * This function is used to get the OwnVehicle listing count
     */
    function OwnVehicleListingCount($searchText = '',$filter='',$company_id)
    {
        $this->db->select('OwnVehicle.row_id,OwnVehicle.vehicle_number,OwnVehicle.fc_date,OwnVehicle.road_tax_date,OwnVehicle.insurance_date, OwnVehicle.karnataka_permit_date, OwnVehicle.national_permit_date,OwnVehicle.emission_date, OwnVehicle.last_service_date , OwnVehicle.vehicle_condition');
        $this->db->from('tbl_own_vehicle_info as OwnVehicle');
        if(!empty($searchText)) {
            $likeCriteria = "(OwnVehicle.vehicle_number  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['vehicle_number'])){
            $this->db->where('OwnVehicle.vehicle_number', $filter['vehicle_number']);
        }
        if(!empty($filter['vehicle_type'])){
            $this->db->where('OwnVehicle.vehicle_type', $filter['vehicle_type']);
        }
        if(!empty($filter['insurance_date'])){
            $this->db->where('OwnVehicle.insurance_date', $filter['insurance_date']);
        }
        if(!empty($filter['karnataka_permit_date'])){
            $this->db->where('OwnVehicle.karnataka_permit_date', $filter['karnataka_permit_date']);
        }
        if(!empty($filter['last_service_date'])){
            $this->db->where('OwnVehicle.last_service_date', $filter['last_service_date']);
        }
        $this->db->where('OwnVehicle.company_id',$company_id);
        $this->db->where('OwnVehicle.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * This function is used to get the OwnVehicle listing 
     */
    function OwnVehicleListing($searchText = '',$filter='',$company_id, $page, $segment)
    {
        $this->db->select('OwnVehicle.row_id,OwnVehicle.vehicle_type,OwnVehicle.vehicle_number,OwnVehicle.fc_date,OwnVehicle.road_tax_date,OwnVehicle.insurance_date, OwnVehicle.karnataka_permit_date, OwnVehicle.national_permit_date,OwnVehicle.emission_date, OwnVehicle.last_service_date , OwnVehicle.vehicle_condition');
        $this->db->from('tbl_own_vehicle_info as OwnVehicle');
        if(!empty($searchText)) {
            $likeCriteria = "(OwnVehicle.vehicle_number  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['vehicle_number'])){
            $this->db->where('OwnVehicle.vehicle_number', $filter['vehicle_number']);
        }
        if(!empty($filter['vehicle_type'])){
            $this->db->where('OwnVehicle.vehicle_type', $filter['vehicle_type']);
        }
        if(!empty($filter['insurance_date'])){
            $this->db->where('OwnVehicle.insurance_date', $filter['insurance_date']);
        }
        if(!empty($filter['karnataka_permit_date'])){
            $this->db->where('OwnVehicle.karnataka_permit_date', $filter['karnataka_permit_date']);
        }
        if(!empty($filter['last_service_date'])){
            $this->db->where('OwnVehicle.last_service_date', $filter['last_service_date']);
        }
        $this->db->where('OwnVehicle.company_id',$company_id);
        $this->db->where('OwnVehicle.is_deleted', 0);
        $this->db->order_by('OwnVehicle.row_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

     /**
     * This function is used to get the fuelListing
     */
    function fuelListing($company_id,$vehicle_number)
    {
        $this->db->select('fuel.fuel_type, fuel.row_id,fuel.vehicle_number,fuel.fuel_date,fuel.liter,fuel.fuel_amount,fuel.diesel_pump,fuel.vehicle_type');
        $this->db->from('tbl_vehicle_fuel_info as fuel');
        $this->db->where('fuel.company_id',$company_id);
        $this->db->where('fuel.vehicle_number',$vehicle_number);
        $this->db->where('fuel.is_deleted', 0);
        $this->db->order_by('fuel.row_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    /**
     * This function is used to get the tripListing
     */
    function tripListing($company_id,$vehicle_number)
    {
        $this->db->select('service.row_id,service.vehicle_number,service.service_date,service.comments,service.place,service.total_trip,service.trip_amount,service.fuel_rowid');
        $this->db->from('tbl_own_vehicle_service_info as service');
        $this->db->where('service.company_id',$company_id);
        $this->db->where('service.vehicle_number',$vehicle_number);
        $this->db->where('service.is_deleted', 0);
        $this->db->order_by('service.row_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    

    /**
     * This function is used to add new OwnVehicle to system
     */
    function addOwnVehicle($ownVehicleInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_own_vehicle_info', $ownVehicleInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

 /**
     * This function is used to add Fuel Details
     */
    function addFuel($fuelInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_vehicle_fuel_info', $fuelInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
   
   /**
     * This function is used to add Service Details
     */
    function addTrip($tripInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_own_vehicle_service_info', $tripInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    } 
     /**
     * This function is used to add Service Details
     */
    function addWheelInfo($wheelInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_own_vehicle_wheel_info', $wheelInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    } 
    
    
    /**
     * This function is used to update the OwnVehicle information
     */
    function updateOwnVehicle($ownVehicleInfo,$row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_own_vehicle_info', $ownVehicleInfo);
        return TRUE;
    }
      /**
     * This function is used to update the OwnVehicle information
     */
    function updateFuel($fuelInfo,$row_id)
    {
        $this->db->where('transport_rowid', $row_id);
        $this->db->update('tbl_vehicle_fuel_info', $fuelInfo);
        return TRUE;
    }

    
    
    /**
     * This function is used to delete the OwnVehicle information
     */
    function deleteOwnVehicle($row_id,$OwnVehicleInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_own_vehicle_info', $OwnVehicleInfo);
        return $this->db->affected_rows();
    }

    /**
     * This function is used to delete the Fuel information
     */
    function deleteFuel($row_id,$fuelInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_vehicle_fuel_info', $fuelInfo);
        return $this->db->affected_rows();
    }

    function deleteLeaseFuel($row_id,$fuelInfo)
    {
        $this->db->where('transport_rowid', $row_id);
        $this->db->update('tbl_vehicle_fuel_info', $fuelInfo);
        return $this->db->affected_rows();
    }

    
    function deleteOwnVehicleFuel($row_id,$fuelInfo)
    {
        $this->db->where('ownVehicleRow_Id', $row_id);
        $this->db->update('tbl_vehicle_fuel_info', $fuelInfo);
        return $this->db->affected_rows();
    }

    function deleteOwnVehicleTrip($row_id,$tripInfo)
    {
        $this->db->where('own_vehicle_rowid', $row_id);
        $this->db->update('tbl_own_vehicle_service_info', $tripInfo);
        return $this->db->affected_rows();
    }
    function deleteOwnVehicleWheel($row_id,$wheelInfo)
    {
        $this->db->where('own_vehicle_rowid', $row_id);
        $this->db->update('tbl_own_vehicle_wheel_info', $wheelInfo);
        return $this->db->affected_rows();
    }

    
    /**
     * This function is used to delete the Service information
     */
    function deleteTrip($row_id,$tripInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_own_vehicle_service_info', $tripInfo);
        return $this->db->affected_rows();
    }
    /**
     * This function is used to delete the Wheel information
     */
    function deleteWheel($row_id,$wheelInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_own_vehicle_wheel_info', $wheelInfo);
        return $this->db->affected_rows();
    }


    
     /**
     * This function is used to get  OwnVehicle information by OwnVehicle_id
     */
    function getOwnVehicleInfoById($row_id){
        $this->db->select('OwnVehicle.row_id,OwnVehicle.vehicle_type,OwnVehicle.vehicle_number,OwnVehicle.fc_date,OwnVehicle.road_tax_date,OwnVehicle.insurance_date, OwnVehicle.karnataka_permit_date, OwnVehicle.national_permit_date,OwnVehicle.emission_date, OwnVehicle.last_service_date , OwnVehicle.vehicle_condition');
        $this->db->from('tbl_own_vehicle_info as OwnVehicle');
        $this->db->where('OwnVehicle.row_id', $row_id);
        $this->db->where('OwnVehicle.is_deleted', 0);
        $query = $this->db->get();
        return $query->row();
    }

      /**
     * This function is used to get  all OwnVehicles
     */
    function getOwnVehicleInfo($company_id){
        $this->db->from('tbl_own_vehicle_info as OwnVehicle');
        $this->db->where('OwnVehicle.company_id', $company_id);
        $this->db->where('OwnVehicle.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

 /**
     * This function is used to get  all fuel info
     */
    function getFuelDetails($company_id){
        $this->db->from('tbl_vehicle_fuel_info as fuel');
        $this->db->where('fuel.company_id', $company_id);
        $this->db->where('fuel.vehicle_type', 'Own');
        $this->db->where('fuel.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function getFuelDetailsForTripAdd($company_id){
        $this->db->from('tbl_vehicle_fuel_info as fuel');
        $this->db->where('fuel.company_id', $company_id);
        $this->db->where('fuel.vehicle_type', 'Own');
        $this->db->where('fuel.fuel_type', 'Diesel');
        $this->db->where('fuel.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
      /**
     *  Own Vehicle Count
     */
    function totalOwnVehicleOTHER($company_id)
    {
        $this->db->from('tbl_own_vehicle_info as OwnVehicle');
        $this->db->where('OwnVehicle.company_id', $company_id);
        $this->db->where('OwnVehicle.vehicle_type', 'OTHER');
        
        $this->db->where('OwnVehicle.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function totalOwnVehicleSELF($company_id)
    {
        $this->db->from('tbl_own_vehicle_info as OwnVehicle');
        $this->db->where('OwnVehicle.company_id', $company_id);
        $this->db->where('OwnVehicle.vehicle_type', 'SELF');
        
        $this->db->where('OwnVehicle.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }


      /**
     *  Own fuel amount Count
     */
    function getFuelAmountInfo($company_id)
    {
      
        $this->db->select_sum('fuel_amount');
        $this->db->where('tbl_vehicle_fuel_info.is_deleted', 0); 
        $result = $this->db->get('tbl_vehicle_fuel_info')->row(); 
        return $result->fuel_amount;
    }

    /**
     *  Own fuel  Count
     */
    function getFuelInfo($company_id)
    {
        $this->db->select_sum('liter');
        $this->db->where('tbl_vehicle_fuel_info.is_deleted', 0); 
        $result = $this->db->get('tbl_vehicle_fuel_info')->row(); 
        return $result->liter;
    }

         /**
     * This function is used to get  all Wheel info of own vehicle
     */
    function getAllWheelInfo($company_id,$vehicle_number){
        $this->db->from('tbl_own_vehicle_wheel_info as wheel');
        $this->db->where('wheel.company_id', $company_id);
        $this->db->where('wheel.vehicle_number', $vehicle_number);
        $this->db->where('wheel.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
    function  getOwnVehicleReport($vehicle_number){
        $this->db->select('OwnVehicle.vehicle_type, ownVehicle.row_id,ownVehicle.vehicle_number,ownVehicle.fc_date,ownVehicle.road_tax_date,ownVehicle.insurance_date, ownVehicle.karnataka_permit_date, ownVehicle.national_permit_date,ownVehicle.emission_date, ownVehicle.last_service_date , ownVehicle.vehicle_condition');
        $this->db->from('tbl_own_vehicle_info as ownVehicle');
       
        if($vehicle_number != 'ALL'){
            $this->db->where('ownVehicle.vehicle_number', $vehicle_number);
            } 
        $this->db->where('ownVehicle.is_deleted', 0);
        $query = $this->db->get();
        return $query->result();
     }

     function  getWheelReport($vehicle_number){
        $this->db->from('tbl_own_vehicle_wheel_info as wheel ');
       
        if($vehicle_number  == 'ALL' )
        {
        $this->db->where('wheel.is_deleted', 0);
       
        } else  {
            $this->db->where('wheel.is_deleted', 0);
            $this->db->where('wheel.vehicle_number', $vehicle_number);
           
        }  
        $query = $this->db->get();
        return $query->result();
     }

    

     function  getFuelReport($fromDate, $toDate,$vehicle_number){
        $this->db->from('tbl_vehicle_fuel_info as fuel');
        if($vehicle_number  == 'ALL' )
        {
            $from = "DATE_FORMAT(fuel.fuel_date, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($from);
            $to = "DATE_FORMAT(fuel.fuel_date, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($to);
           

        } else  {
            $from = "DATE_FORMAT(fuel.fuel_date, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($from);
            $to = "DATE_FORMAT(fuel.fuel_date, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($to);
            $this->db->where('fuel.vehicle_number', $vehicle_number);
        
        }  
        $this->db->where('fuel.is_deleted', 0);
        $query = $this->db->get();
        return $query->result();
     }

//to get lease and own vehicle fuel report
     function  getOwnLeaseFuelInfo($filter){
        if($filter['vehicle_type']  == 'Own')
        {
            $this->db->select('fuel_ac.fuel_account_name,fuel.row_id,fuel.ownVehicleRow_Id,fuel.transport_rowid,fuel.fuel_date,fuel.liter,fuel.fuel_amount,fuel.vehicle_number,fuel.diesel_pump,fuel.vehicle_type');
            $this->db->from('tbl_vehicle_fuel_info  as fuel');
            $this->db->join('tbl_fuel_account as fuel_ac', 'fuel.fuel_account_row_id = fuel_ac.row_id');
            $from = "DATE_FORMAT(fuel.fuel_date, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($filter['fromDate']))."'";
            $this->db->where($from);
            $to = "DATE_FORMAT(fuel.fuel_date, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($filter['toDate']))."'";
            $this->db->where($to);
            $this->db->where('fuel.vehicle_type', $filter['vehicle_type']);
            if($filter['own_vehicle_number'] != 'ALL'){
            $this->db->where('fuel.vehicle_number',$filter['own_vehicle_number']);
            }
            if($filter['diesel_pump'] != 'ALL'){
                $this->db->where('fuel_ac.row_id', $filter['diesel_pump']);
                }
            $this->db->where('fuel.is_deleted', 0);
        } else {
            $this->db->select('fuel.row_id,fuel.ownVehicleRow_Id,fuel.transport_rowid,fuel.fuel_date,fuel.liter,fuel.fuel_amount,fuel.vehicle_number,fuel.diesel_pump,fuel.vehicle_type,
            transporter.transporter_name');
            $this->db->from('tbl_vehicle_fuel_info  as fuel');
            $this->db->join('tbl_lease_vehicle_info as lease', 'lease.vehicle_number = fuel.vehicle_number','left');
            $this->db->join('tbl_transporter as transporter', 'transporter.row_id = lease.transporter_rowid','left');
            $from = "DATE_FORMAT(fuel.fuel_date, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($filter['fromDate']))."'";
            $this->db->where($from);
            $to = "DATE_FORMAT(fuel.fuel_date, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($filter['toDate']))."'";
            $this->db->where($to);
            $this->db->where('fuel.vehicle_type', $filter['vehicle_type']);
            if($filter['transporter_name'] != 'ALL'){
                $this->db->where('transporter.transporter_name', $filter['transporter_name']);
            }
            if($filter['lease_vehicle_number'] != 'ALL'){
            $this->db->where('fuel.vehicle_number', $filter['lease_vehicle_number']);
            }

            if($filter['diesel_pump'] != 'ALL'){
                $this->db->where('fuel.diesel_pump', $filter['diesel_pump']);
                }
                
            $this->db->where('fuel.is_deleted', 0);
        }  
        $this->db->order_by('fuel.fuel_date', 'DESC');
        $this->db->where('fuel.fuel_type', 'Diesel');
        $query = $this->db->get();
        return $query->result();
     }


     //to get own vehicle trip report
     function getTripInformation($fuel_rowid){
        $this->db->select('trip.own_vehicle_rowid,trip.vehicle_number,trip.service_date,trip.place,trip.total_trip,trip.trip_amount,trip.comments,trip.fuel_rowid');
        $this->db->from('tbl_own_vehicle_service_info  as trip');
        $this->db->where('trip.fuel_rowid', $fuel_rowid);
        $this->db->where('trip.is_deleted', 0);
        $query = $this->db->get();
        return $query->result();
     }


     function  getTripReport($fromDate,$toDate,$vehicle_number){
        $this->db->from('tbl_own_vehicle_service_info as service');
        if($vehicle_number  == 'ALL' )
        {
            $from = "DATE_FORMAT(service.service_date, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($from);
            $to = "DATE_FORMAT(service.service_date, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($to);
           

        } else  {
            $from = "DATE_FORMAT(service.service_date, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($from);
            $to = "DATE_FORMAT(service.service_date, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($to);
            $this->db->where('service.vehicle_number', $vehicle_number);
           
        }  
        $this->db->where('service.is_deleted', 0);
        $query = $this->db->get();
        return $query->result();
     }


     
      /**
     * This function is used to get  all Own Vehicle
     */
    function getAllOwnVehicle($company_id){
        $this->db->from('tbl_own_vehicle_info as ownVehicle');
        $this->db->where('ownVehicle.company_id', $company_id);
        $this->db->where('ownVehicle.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function getVehicleNotification($company_id,$type){
        $this->db->from('tbl_own_vehicle_info as ownVehicle');
        $todayDate=date('Y-m-d');
        $NewDate=date('Y-m-d', strtotime("+10 days"));
        if($type == 'insurance'){
             $this->db->where('ownVehicle.insurance_date BETWEEN "'.$todayDate. '" and "'. $NewDate.'"');
        }
        if($type == 'fc'){
            $this->db->where('ownVehicle.fc_date BETWEEN "'.$todayDate. '" and "'. $NewDate.'"');
        }
        if($type == 'road_tax'){
                $this->db->where('ownVehicle.road_tax_date BETWEEN "'.$todayDate. '" and "'. $NewDate.'"');
         }
         if($type == 'ka'){
            $this->db->where('ownVehicle.karnataka_permit_date BETWEEN "'.$todayDate. '" and "'. $NewDate.'"');
         }
         if($type == 'na'){
        $this->db->where('ownVehicle.national_permit_date BETWEEN "'.$todayDate. '" and "'. $NewDate.'"');
         }
         if($type == 'emission'){
            $this->db->where('ownVehicle.emission_date BETWEEN "'.$todayDate. '" and "'. $NewDate.'"');
         }
        $this->db->where('ownVehicle.company_id', $company_id);
        $this->db->where('ownVehicle.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    
    }

       /**
     * This function is used to get  all own Vehicle
     */
    function getAllOwnVehicles($company_id){
        $this->db->from('tbl_own_vehicle_info as ownVehicle');
        $this->db->where('ownVehicle.company_id', $company_id);
        $this->db->where('ownVehicle.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }


    // function  getOwnLeaseVehicleFuelReport($filter){
       
    //     if($filter['vehicle_type']  == 'Own' )
    //     {
    //         $this->db->select('fuel.ownVehicleRow_Id,fuel.transport_rowid,fuel.fuel_date,fuel.liter,fuel.fuel_amount,fuel.vehicle_number,fuel.diesel_pump,fuel.vehicle_type');
    //         $this->db->from('tbl_vehicle_fuel_info  as fuel');
    //         $from = "DATE_FORMAT(fuel.fuel_date, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($filter['fromDate']))."'";
    //         $this->db->where($from);
    //         $to = "DATE_FORMAT(fuel.fuel_date, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($filter['toDate']))."'";
    //         $this->db->where($to);
    //         $this->db->where('fuel.vehicle_type', $filter['vehicle_type']);
    //         if($filter['own_vehicle_number'] != 'ALL'){
    //         $this->db->where('fuel.vehicle_number',$filter['own_vehicle_number']);
    //         }
    //         if($filter['diesel_pump'] != 'ALL'){
    //             $this->db->where('fuel.diesel_pump', $filter['diesel_pump']);
    //             }
    //         $this->db->where('fuel.is_deleted', 0);
    //     } else {
    //         $this->db->select('fuel.ownVehicleRow_Id,fuel.transport_rowid,fuel.fuel_date,fuel.liter,fuel.fuel_amount,fuel.vehicle_number,fuel.diesel_pump,fuel.vehicle_type,
    //         transporter.transporter_name');
    //         $this->db->from('tbl_vehicle_fuel_info  as fuel');
    //         $this->db->join('tbl_lease_vehicle_info as lease', 'lease.vehicle_number = fuel.vehicle_number','left');
    //         $this->db->join('tbl_transporter as transporter', 'transporter.row_id = lease.transporter_rowid','left');
    //         $from = "DATE_FORMAT(fuel.fuel_date, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($filter['fromDate']))."'";
    //         $this->db->where($from);
    //         $to = "DATE_FORMAT(fuel.fuel_date, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($filter['toDate']))."'";
    //         $this->db->where($to);
    //         $this->db->where('fuel.vehicle_type', $filter['vehicle_type']);
    //         if($filter['transporter_name'] != 'ALL'){
    //             $this->db->where('transporter.transporter_name', $filter['transporter_name']);
    //         }
    //         if($filter['lease_vehicle_number'] != 'ALL'){
    //         $this->db->where('fuel.vehicle_number', $filter['lease_vehicle_number']);
    //         }

    //         if($filter['diesel_pump'] != 'ALL'){
    //             $this->db->where('fuel.diesel_pump', $filter['diesel_pump']);
    //             }
                
    //         $this->db->where('fuel.is_deleted', 0);
    //     }  
       
    //     $query = $this->db->get();
    //     return $query->result();
    //  }


    //  function getOwnVehicleTripInfo($fuel_date,$ownVehicleRow_Id){
    //     $this->db->select('trip.own_vehicle_rowid,trip.vehicle_number,trip.service_date,trip.place,trip.total_trip,trip.trip_amount,trip.comments');
    //     $this->db->from('tbl_own_vehicle_service_info  as trip');
    //     $this->db->where('trip.service_date', $fuel_date);
    //     $this->db->where('trip.own_vehicle_rowid', $ownVehicleRow_Id);
    //     $this->db->where('trip.is_deleted', 0);
    //     $query = $this->db->get();
    //     return $query->result();
    //  }


    

    function getOwnVichFuelInfoById($row_id)
    {
        $this->db->from('tbl_vehicle_fuel_info  as fuel');
        $this->db->where('fuel.row_id', $row_id); 
        $this->db->where('fuel.is_deleted', 0);
        $query = $this->db->get();
        return $query->row();
    }
}

  