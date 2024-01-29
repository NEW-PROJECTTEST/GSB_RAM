<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Transport_model extends CI_Model
{
    /**
     * This function is used to get the transport listing count
     */
    function transportListingCount($searchText = '',$filter='',$company_id)
    {
        // $this->db->select('transport.row_id,transport.date,transport.invoice_number,transport.vehicle_number,transport.LR_no,
        // party.party_name,transport.party_rowid,transport.bank_rowid,bank.bank_name,transporter.transporter_name,transport.bags, transport.mt, transport.destination,transport.rate, transport.amount , transport.cash_account_rowid, transport.diesel_pump,transport.diesel_amount,transport.discount_amount, transport.loading_charge, transport.unloading_charge, transport.ponch_amount, transport.roro,  transport.party_amount, transport.narration, transport.ponch_pending,transport.cash_amount');
        $this->db->from('tbl_transport_details_karavali as transport');
        // $this->db->join('tbl_bank_info as bank', 'bank.row_id = transport.bank_rowid','left');
        $this->db->join('tbl_party_info as party', 'party.row_id = transport.party_rowid','left');
        // $this->db->join('tbl_lease_vehicle_info as lease', 'lease.vehicle_number = transport.vehicle_number','left');
        $this->db->join('tbl_transporter as transporter', 'transporter.row_id = transport.transporter_rowid','left');
        if(!empty($searchText)) {
            $likeCriteria = "(transport.vehicle_number  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['vehicle_number'])){
            $this->db->where('transport.vehicle_number', $filter['vehicle_number']);
        }
        if(!empty($filter['date'])){
            $this->db->where('transport.date', $filter['date']);
        }
        if(!empty($filter['transporter_name'])){
            $likeCriteria = "(transporter.transporter_name  LIKE '%".$filter['transporter_name']."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['party_name'])){
            $likeCriteria = "(party.party_name  LIKE '%".$filter['party_name']."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['ponch_amount'])){
            $this->db->where('transport.ponch_amount', $filter['ponch_amount']);
        }
        if($filter['ponch']==="clear"){
            $this->db->where('transport.ponch_pending','No');
        }else if($filter['ponch']==="pending"){
            $this->db->where('transport.ponch_pending','Yes');
        }
        $this->db->where('transport.company_id',$company_id);
        $this->db->where('transport.is_deleted', 0);
        // $this->db->where('lease.is_deleted', 0);
        $this->db->where('transporter.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * This function is used to get the transport listing 
     */
    function transportListing($searchText = '',$filter='',$company_id, $page, $segment)
    {
        // $this->db->select('transport.row_id,transport.date,transport.invoice_number,transport.vehicle_number,transport.LR_no,
        // party.party_name,transport.party_rowid,transport.bank_rowid,bank.bank_name,transporter.transporter_name,transport.bags, transport.mt, transport.destination,transport.rate, transport.amount , transport.cash_account_rowid, transport.diesel_pump,transport.diesel_amount,transport.discount_amount, transport.loading_charge, transport.unloading_charge, transport.ponch_amount, transport.roro,  transport.party_amount, transport.narration, transport.ponch_pending,transport.cash_amount');
        $this->db->select('transport.row_id,transport.date,transport.vehicle_number,transporter.transporter_name,transport.ponch_amount,party.party_name,transport.ponch_pending');
        $this->db->from('tbl_transport_details_karavali as transport');
        // $this->db->join('tbl_bank_info as bank', 'bank.row_id = transport.bank_rowid','left');
        $this->db->join('tbl_party_info as party', 'party.row_id = transport.party_rowid','left');
        // $this->db->join('tbl_lease_vehicle_info as lease', 'lease.vehicle_number = transport.vehicle_number','left');
        $this->db->join('tbl_transporter as transporter', 'transporter.row_id = transport.transporter_rowid','left');
        if(!empty($searchText)) {
            $likeCriteria = "(transport.vehicle_number  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['date'])){
            $this->db->where('transport.date', $filter['date']);
        }
        if(!empty($filter['vehicle_number'])){
            $this->db->where('transport.vehicle_number', $filter['vehicle_number']);
        }
        if(!empty($filter['transporter_name'])){
            $likeCriteria = "(transporter.transporter_name  LIKE '%".$filter['transporter_name']."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['party_name'])){
            $likeCriteria = "(party.party_name  LIKE '%".$filter['party_name']."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['ponch_amount'])){
            $this->db->where('transport.ponch_amount', $filter['ponch_amount']);
        }
        if($filter['ponch']=="clear"){
            $this->db->where('transport.ponch_pending','No');
        }else if($filter['ponch']=="pending"){
            $this->db->where('transport.ponch_pending','Yes');
        }
        $this->db->where('transport.company_id',$company_id);
        $this->db->where('transport.is_deleted', 0);
        // $this->db->where('lease.is_deleted', 0);
        $this->db->where('transporter.is_deleted', 0);
        $this->db->order_by('transport.row_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
       
        $result = $query->result();  
        // log_message('debug','transport array'.print_r($result,true));  
        // log_message('debug','transport array'.print_r($query,true));      
        return $result;
    }
    
    /**
     * This function is used to add new transport to system
     */
    function addTransport($transportInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_transport_details_karavali', $transportInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }


    
    /**
     * This function is used to update the transport information
     */
    function updateTransport($transportInfo,$row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_transport_details_karavali', $transportInfo);
        return TRUE;
    }
     /**
     * This function is used to update the ponch clear information
     */
    function updatePonchClear($ponchInfo,$row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_transport_details_karavali', $ponchInfo);
        return TRUE;
    }

    function addNewPonchClearInfo($ponchInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_ponch_cleared_info', $ponchInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function updatePonchClearTable($ponchInfo,$row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_ponch_cleared_info', $ponchInfo);
        return TRUE;
    }


    //overall credit sum
    function getSumOfPonchClear($transport_id, $type) {
        $this->db->select_sum('amount');
        $this->db->where('tbl_ponch_cleared_info.type',$type);
        $this->db->where('tbl_ponch_cleared_info.transport_row_id',$transport_id);
        $this->db->where('tbl_ponch_cleared_info.is_deleted', 0); 
        $result = $this->db->get('tbl_ponch_cleared_info')->row(); 
        return $result->amount;
       }
    
    /**
     * This function is used to delete the transport information
     */
    function deleteTransport($row_id,$transportInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_transport_details_karavali', $transportInfo);
        return $this->db->affected_rows();
    }

     /**
     * This function is used to get  transport information by transport_id
     */
    function getTransportInfoById($row_id){
        $this->db->select('transport.firm_name, transport.transporter_rowid, transporter.transporter_name,fuel.fuel_account_name, transport.fuel_account_row_id,
        transport.row_id,transport.date,transport.invoice_number,transport.vehicle_number,transport.LR_no,
        party.party_name,transport.party_rowid,transport.bank_rowid,bank.bank_name,
        ,transport.bags, transport.mt, transport.destination,transport.rate, transport.amount ,
         transport.cash_account_rowid, cash.cash_account_name,transport.diesel_pump,transport.diesel_amount,transport.discount_amount,transport.diesel_date, transport.loading_charge, 
         transport.unloading_charge, transport.halt_charge, transport.ponch_amount, transport.roro,  transport.party_amount, transport.narration,
         transport.ponch_date, transport.ponch_clear_amount_by_bank, transport.ponch_clear_bank_account,transport.ponch_clear_amount_by_cash, transport.ponch_clear_amount_by_fuel,transport.ponch_clear_cash_account,transport.ponch_clear_fuel_account, transport.ponch_pending,transport.cash_amount');
        $this->db->from('tbl_transport_details_karavali as transport');
        $this->db->join('tbl_bank_info as bank', 'bank.row_id = transport.bank_rowid','left');
        $this->db->join('tbl_party_info as party', 'party.row_id = transport.party_rowid','left');
         $this->db->join('tbl_fuel_account as fuel', 'fuel.row_id = transport.fuel_account_row_id','left');
         $this->db->join('tbl_transporter as transporter', 'transporter.row_id = transport.transporter_rowid','left');
        $this->db->join('tbl_cash_account as cash', 'cash.row_id = transport.cash_account_rowid','left');
        $this->db->where('transport.row_id', $row_id);
        $this->db->where('transport.is_deleted', 0);
        $query = $this->db->get();
        return $query->row();
    }

    function getPonchInfoByTransport($row_id){
        $this->db->select('ponch.row_id,ponch.date,ponch.type,ponch.amount,cash.comments,bank.bank_name');
        $this->db->from('tbl_ponch_cleared_info as ponch');
        $this->db->join('tbl_cash_expenses as cash', 'cash.ponch_cleared_row_id = ponch.row_id','left');
        $this->db->join('tbl_bank_info as bank', 'bank.row_id = cash.bank_account_row_id','left');
        
        $this->db->where('ponch.transport_row_id', $row_id);
        $this->db->where('ponch.is_deleted', 0);
        //$this->db->group_by('ponch.row_id'); 
        $query = $this->db->get();
        return $query->result();
    }

    function getPonchInfoById($row_id){
        $this->db->from('tbl_ponch_cleared_info as ponch');
        $this->db->where('ponch.row_id', $row_id);
        $this->db->where('ponch.is_deleted', 0);
        $query = $this->db->get();
        return $query->row();
    }

    function updatePonchClearInfo($ponchInfo,$row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_ponch_cleared_info', $ponchInfo);
        return TRUE;
    }

     /**
     * This function is used to get the today Transported Vehicle
     */

    function getTodayTransportedVehicle()
    {
        $this->db->from('tbl_transport_details_karavali as transport');
        $this->db->where('transport.is_deleted', 0);
        $this->db->where('transport.date',date('Y-m-d'));
        $query = $this->db->get();
        return $query->num_rows();
    
    }

    function getTransportNEFTInfo($transport_row_id)
    {
        $this->db->select('SUM(bank.amount) as amt,bank.date,neft.bank_name');
        $this->db->from('tbl_ponch_cleared_info as bank');
        $this->db->join('tbl_bank_info as neft', 'neft.row_id = bank.bank_account_row_id','left');
        $this->db->where('bank.is_deleted', 0);
        $this->db->where('bank.type','Bank');
        $this->db->where('bank.transport_row_id',$transport_row_id);
        $query = $this->db->get();
        return $query->row();
    
    }
        function  getTransporterReport($filter){
            $this->db->select('transport.firm_name, fuel.fuel_account_name,transport.row_id,transport.date,transport.invoice_number,transport.vehicle_number,transport.LR_no,
            party.party_name,transport.party_rowid,transport.bank_rowid,bank.bank_name, transporter.transporter_name
            ,transport.bags, transport.mt, transport.destination,transport.rate, transport.amount ,
            transport.cash_account_rowid, cash.cash_account_name,transport.diesel_pump,transport.diesel_amount,transport.discount_amount,transport.diesel_date, transport.loading_charge, 
            transport.unloading_charge, transport.ponch_amount, transport.roro,  transport.party_amount, transport.narration,
            transport.ponch_date, transport.ponch_clear_amount_by_bank, transport.ponch_clear_bank_account,transport.ponch_clear_amount_by_cash, transport.ponch_clear_cash_account, transport.ponch_pending,transport.cash_amount');
            $this->db->from('tbl_transport_details_karavali as transport');
            $this->db->join('tbl_transporter as transporter', 'transporter.row_id = transport.transporter_rowid','left');
            $this->db->join('tbl_lease_vehicle_info as lease', 'lease.vehicle_number = transport.vehicle_number','left');
            $this->db->join('tbl_fuel_account as fuel', 'fuel.row_id = transport.fuel_account_row_id','left');
            $this->db->join('tbl_cash_account as cash', 'cash.row_id = transport.cash_account_rowid','left');
            
            $this->db->join('tbl_bank_info as bank', 'bank.row_id = transport.bank_rowid','left');
            $this->db->join('tbl_party_info as party', 'party.row_id = transport.party_rowid','left');
            if($filter['vehicle_number']  != 'ALL' )
            {
                $from = "DATE_FORMAT(transport.date, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($filter['fromDate']))."'";
                $this->db->where($from);
                $to = "DATE_FORMAT(transport.date, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($filter['toDate']))."'";
                $this->db->where($to);
                $this->db->where('transport.vehicle_number', $filter['vehicle_number']);

            } 
            if ($filter['party_name']  != 'ALL' ) {
                $from = "DATE_FORMAT(transport.date, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($filter['fromDate']))."'";
                $this->db->where($from);
                $to = "DATE_FORMAT(transport.date, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($filter['toDate']))."'";
                $this->db->where($to);
                $this->db->where('party.party_name', $filter['party_name']);

            } 

            if ($filter['transporter_name']  != 'ALL' ) {
                $from = "DATE_FORMAT(transport.date, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($filter['fromDate']))."'";
                $this->db->where($from);
                $to = "DATE_FORMAT(transport.date, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($filter['toDate']))."'";
                $this->db->where($to);
                $this->db->where('transporter.transporter_name', $filter['transporter_name']);

            } 

            if ($filter['ponch_pending']  == 'Yes' ) {
                $from = "DATE_FORMAT(transport.date, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($filter['fromDate']))."'";
                $this->db->where($from);
                $to = "DATE_FORMAT(transport.date, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($filter['toDate']))."'";
                $this->db->where($to);
                $this->db->where('transport.ponch_pending', $filter['ponch_pending']);

            } else if ($filter['ponch_pending']  == 'No' ) {
                $from = "DATE_FORMAT(transport.date, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($filter['fromDate']))."'";
                $this->db->where($from);
                $to = "DATE_FORMAT(transport.date, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($filter['toDate']))."'";
                $this->db->where($to);
                $this->db->where('transport.ponch_pending', $filter['ponch_pending']);
            }
            else {
                $from = "DATE_FORMAT(transport.date, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($filter['fromDate']))."'";
                $this->db->where($from);
                $to = "DATE_FORMAT(transport.date, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($filter['toDate']))."'";
                $this->db->where($to);
            }  
            $this->db->group_by('transport.row_id'); 
            $this->db->order_by('transport.row_id', 'desc'); 
            $this->db->where('transport.is_deleted', 0);
            $query = $this->db->get();
            return $query->result();
     }
}

  