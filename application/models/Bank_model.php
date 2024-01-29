<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Bank_model extends CI_Model
{
   
    /**
     * This function is used to get the bank listing 
     */
    function bankListing($company_id)
    {
        $this->db->select('bank.row_id,bank.bank_name,bank.branch_name, bank.IFSC_code, bank.account_type,bank.bank_contact,bank.bank_account_number');
        $this->db->from('tbl_bank_info as bank');
       
        $this->db->where('bank.company_id',$company_id);
        $this->db->where('bank.is_deleted', 0);
        $this->db->order_by('bank.row_id', 'DESC');
        
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
    

    /**
     * This function is used to add new bank to system
     */
    function addBank($bankInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_bank_info', $bankInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }


    
    /**
     * This function is used to update the bank information
     */
    function updateBank($bankInfo,$row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_bank_info', $bankInfo);
        return TRUE;
    }
    
    /**
     * This function is used to delete the bank information
     */
    function deleteBank($row_id,$bankInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_bank_info', $bankInfo);
        return $this->db->affected_rows();
    }

     /**
     * This function is used to get  bank information by row_id
     */
    function getBankInfoById($row_id){
        $this->db->select('bank.row_id,bank.bank_name,bank.branch_name, bank.IFSC_code, bank.account_type,bank.bank_contact,bank.bank_account_number');
        $this->db->from('tbl_bank_info as bank');
        if($row_id != 'ALL'){
        $this->db->where('bank.row_id', $row_id);
        }
        $this->db->where('bank.is_deleted', 0);
        $query = $this->db->get();
        return $query->row();
    }


     /**
     * This function is used to get  bank information by row_id
     */
    function getBankInformation($bank_name){
        $this->db->select('bank.row_id,bank.bank_name,bank.branch_name, bank.IFSC_code, bank.account_type,bank.bank_contact,bank.bank_account_number');
        $this->db->from('tbl_bank_info as bank');
        if($bank_name != 'ALL'){
        $this->db->where('bank.row_id', $bank_name);
        }
        $this->db->where('bank.is_deleted', 0);
        $query = $this->db->get();
        return $query->row();
    }


    // function getBankInformation($bank_name){
    //     $this->db->select('bank.row_id,bank.bank_name,bank.branch_name,bank.IFSC_code, bank.account_type,bank.bank_contact,bank.bank_account_number');
    //     $this->db->from('tbl_bank_info as bank');

    //     $this->db->where('bank.row_id', $row_id);
    //     $this->db->where('bank.is_deleted', 0);
    //     $query = $this->db->get();
    //     return $query->row();
    // }

      /**
     * This function is used to get  all banks
     */
    function getAllBank($company_id){
        $this->db->from('tbl_bank_info as bank');
        $this->db->where('bank.company_id', $company_id);
        $this->db->where('bank.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

      /**
     * This function is used to get  bank counts
     */
    function totalBank($company_id){
        $this->db->from('tbl_bank_info as bank');
        $this->db->where('bank.company_id', $company_id);
        $this->db->where('bank.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * Bank Transaction Functions
     */

    function addBankTransaction($transInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_bank_transaction_info', $transInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function bankTransactionListing($company_id)
    {
        $this->db->select('bank.row_id,bank.trans_date,bank.bank_name, bank.particular, bank.trans_type,bank.amount,bank.is_required');
        $this->db->from('tbl_bank_transaction_info as bank');
       
        //$this->db->where('bank.company_id',$company_id);
        $this->db->where('bank.is_deleted', 0);
        $this->db->order_by('bank.row_id', 'DESC');
        
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function getBankTransactionInfoById($row_id){
        $this->db->select('bank.row_id,bank.trans_date,bank.bank_name,bank.particular, bank.trans_type, bank.amount');
        $this->db->from('tbl_bank_transaction_info as bank');
        $this->db->where('bank.row_id', $row_id);
        $this->db->where('bank.is_deleted', 0);
        $query = $this->db->get();
        return $query->row();
    }

    function updateBankTransaction($transInfo,$row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_bank_transaction_info', $transInfo);
        return TRUE;
    }

    function getBankTransactionReport($fromDate,$toDate,$bank_name){
        $this->db->select('trans.trans_date,trans.bank_name,trans.particular,trans.trans_type,trans.amount');
        $this->db->from('tbl_bank_transaction_info as trans');
        // $this->db->join('tbl_transport_details_karavali as transport', 'transport.row_id = cash_book.transport_rowid','left');
        // $this->db->join('tbl_lease_vehicle_info as lease', 'lease.vehicle_number = transport.vehicle_number','left');
        // $this->db->join('tbl_transporter as transporter', 'transporter.row_id = lease.transporter_rowid','left');
        // $this->db->join('tbl_bank_info as bank', 'bank.row_id = cash_book.bank_account_row_id','left');
        // $this->db->join('tbl_party_info as party', 'party.row_id = transport.party_rowid','left');
        // $this->db->join('tbl_fuel_cash_info as finfo', 'cash_book.fuel_cash_info_row_id = finfo.row_id','left');
        // $this->db->join('tbl_fuel_account as fuel', 'finfo.fuel_account_rowid = fuel.row_id','left');
      

        $this->db->where('trans.trans_date>=', date('Y-m-d',strtotime($fromDate)));
        $this->db->where('trans.trans_date<=', date('Y-m-d',strtotime($toDate)));

        if($bank_name != 'ALL'){
            $this->db->where('trans.bank_name', $bank_name);
        }
        // if($party_name != 'ALL'){
        //     $this->db->where('party.row_id', $party_name);
        // }
        // $this->db->where('cash_book.transaction_type', 'Bank');
        $this->db->where('trans.is_deleted', 0);
       
        // $this->db->group_by('cash_book.row_id'); 
        $this->db->order_by('trans.trans_date', 'desc'); 
        $query = $this->db->get();
        return $query->result();
    }

    function deleteTransaction($row_id,$transInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_bank_transaction_info', $transInfo);
        return $this->db->affected_rows();
    }

    function getStartDate($bank_name)
    {
        if($bank_name != 'ALL'){
            $this->db->where('bank_name', $bank_name);   
        }
        $this->db->where('is_deleted', 0); 
        $this->db->order_by("row_id", "asc");
        $this->db->limit(1);
        $query = $this->db->get('tbl_bank_transaction_info');
        return $query->row();
    }

    //overall credit sum
    function getSumOfCredit($start_date, $end_date, $bank_name) {
        $this->db->select_sum('amount');
        $this->db->where('tbl_bank_transaction_info.trans_date >=', $start_date);
        $this->db->where('tbl_bank_transaction_info.trans_date <=', $end_date);
        if($bank_name != 'ALL'){
            $this->db->where('tbl_bank_transaction_info.bank_name', $bank_name);
        }
        $this->db->where('tbl_bank_transaction_info.trans_type','CREDIT');
        $this->db->where('tbl_bank_transaction_info.is_deleted', 0); 
        $result = $this->db->get('tbl_bank_transaction_info')->row(); 
        return $result->amount;
    }
    
     
     //overall debit sum
    function getSumOfDebit($start_date, $end_date,$bank_name){
        $this->db->select_sum('amount');
        $this->db->where('tbl_bank_transaction_info.trans_date >=', $start_date);
        $this->db->where('tbl_bank_transaction_info.trans_date <=', $end_date);
        if($bank_name != 'ALL'){
            $this->db->where('tbl_bank_transaction_info.bank_name', $bank_name);
        }
        $this->db->where('tbl_bank_transaction_info.trans_type','DEBIT');
        $this->db->where('tbl_bank_transaction_info.is_deleted', 0); 
        $result = $this->db->get('tbl_bank_transaction_info')->row(); 
        return $result->amount;
    }

    // function bankInfoForReport($filter,$company_id)
    // {
    //    // $this->db->select('BaseTbl.row_id, BaseTbl.bank_name, BaseTbl.particular, BaseTbl.amount, BaseTbl.company_id');
    //     $this->db->from('tbl_bank_transaction_info as BaseTbl');
    
        
    //     $this->db->where('BaseTbl.company_id',$company_id);
    //     $this->db->where('BaseTbl.is_deleted', 0);
    //     $this->db->order_by('BaseTbl.row_id', 'ASEC');
    //     $query = $this->db->get();
    //     $result = $query->result();        
    //     return $result;
    // }

    function bankInfoForReport()
    {
        // $this->db->select('bank.row_id, bank.bank_name, bank.particular, bank.amount, bank.company_id');
        // $this->db->from('tbl_bank_transaction_info as bank');
    
         $this->db->from('tbl_bank_transaction_info');
         $this->db->where('is_deleted', 0);
        // $this->db->where('bank.company_id',$company_id);
        // $this->db->where('bank.is_deleted', 0);
        // $this->db->order_by('bank.row_id', 'ASEC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
}

  ?>