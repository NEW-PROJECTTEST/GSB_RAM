<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Cash_ledger_model extends CI_Model
{
    
    
    /**
     * This function is used to get the CashLedger listing 
     */
    function cashLedgerListing($company_id)
    {
        $this->db->select('cashLedger.row_id,party.party_name,cashLedger.party_rowid,cashLedger.reason,cashLedger.cash_amount,cashLedger.cash_ledger_date,cashLedger.cash_account_rowid,cash.cash_account_name');
        $this->db->from('tbl_cash_ledger as cashLedger');
        $this->db->join('tbl_party_info as party', 'party.row_id = cashLedger.party_rowid','left');
        $this->db->join('tbl_cash_account as cash', 'cash.row_id = cashLedger.cash_account_rowid','left');
        $this->db->where('cashLedger.company_id',$company_id);
        $this->db->where('cashLedger.is_deleted', 0);
        $this->db->order_by('cashLedger.row_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to add new CashLedger to system
     */
    function addCashLedger($cashLedgerInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_cash_ledger', $cashLedgerInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    /**
     * This function is used to update the CashLedger information
     */
    function updateCashLedger($cashLedgerInfo,$row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_cash_ledger', $cashLedgerInfo);
        return TRUE;
    }
    
    /**
     * This function is used to delete the CashLedger information
     */
    function deleteCashLedger($row_id,$cashLedgerInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_cash_ledger', $cashLedgerInfo);
        return $this->db->affected_rows();
    }

     /**
     * This function is used to get  CashLedger information by row_id
     */
    function getCashLedgerInfoById($row_id){
        $this->db->select('cashLedger.row_id,party.party_name,cashLedger.party_rowid,cashLedger.reason,cashLedger.cash_amount,cashLedger.cash_ledger_date,cashLedger.cash_account_rowid,cash.cash_account_name');
        $this->db->from('tbl_cash_ledger as cashLedger');
        $this->db->join('tbl_party_info as party', 'party.row_id = cashLedger.party_rowid','left');
        $this->db->join('tbl_cash_account as cash', 'cash.row_id = cashLedger.cash_account_rowid','left');
        $this->db->where('cashLedger.row_id', $row_id);
        $this->db->where('cashLedger.is_deleted', 0);
        $query = $this->db->get();
        return $query->row();
    }

    
     /**
     * This function is used to get the today Cash Legger
     */

    function getTodayCashLedger()
    {
        $this->db->from('tbl_cash_ledger as cashLedger');
        $this->db->where('cashLedger.is_deleted', 0);
        $this->db->where('cashLedger.cash_ledger_date',date('Y-m-d'));
        $query = $this->db->get();
        return $query->num_rows();
    }

    function  getCashLedgerReport($fromDate,$toDate){
        $this->db->select('cashLedger.row_id,party.party_name,cashLedger.party_rowid,cashLedger.reason,cashLedger.cash_amount,cashLedger.cash_ledger_date,cashLedger.cash_account_rowid,,cash.cash_account_name');
        $this->db->from('tbl_cash_ledger as cashLedger');
        $this->db->join('tbl_party_info as party', 'party.row_id = cashLedger.party_rowid','left');
        $this->db->join('tbl_cash_account as cash', 'cash.row_id = cashLedger.cash_account_rowid','left');
        $from = "DATE_FORMAT(cashLedger.cash_ledger_date, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
        $this->db->where($from);
        $to = "DATE_FORMAT(cashLedger.cash_ledger_date, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
        $this->db->where($to);
        $this->db->where('cashLedger.is_deleted', 0);
        $query = $this->db->get();
        return $query->result();
    }

}

  