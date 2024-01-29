<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Cash_account_model extends CI_Model
{
    /**
     * This function is used to get the cashAccount listing count
     */
    function cashAccountListingCount($searchText = '',$filter='',$company_id)
    {
        $this->db->select('cashAccount.row_id,cashAccount.cash_account_name,cashAccount.cash_account_type,cashAccount.account_balance');
        $this->db->from('tbl_cash_account as cashAccount');
        if(!empty($searchText)) {
            $likeCriteria = "(cashAccount.cash_account_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['cash_account_type'])){
            $this->db->where('cashAccount.cash_account_type', $filter['cash_account_type']);
        }
    
        if(!empty($filter['cash_account_name'])){
            
            $likeCriteria = "(cashAccount.cash_account_name  LIKE '%".$filter['cash_account_name']."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['account_balance'])){
            
            $likeCriteria = "(cashAccount.account_balance  LIKE '%".$filter['account_balance']."%')";
            $this->db->where($likeCriteria);
        }
     
        $this->db->where('cashAccount.company_id',$company_id);
        $this->db->where('cashAccount.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * This function is used to get the cashAccount listing 
     */
    function cashAccountListing($searchText = '',$filter='',$company_id, $page, $segment)
    {
        $this->db->select('cashAccount.row_id,cashAccount.cash_account_name,cashAccount.cash_account_type,cashAccount.account_balance');
        $this->db->from('tbl_cash_account as cashAccount');
        if(!empty($searchText)) {
            $likeCriteria = "(cashAccount.cash_account_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['cash_account_type'])){
            $this->db->where('cashAccount.cash_account_type', $filter['cash_account_type']);
        }
    
        if(!empty($filter['cash_account_name'])){
            
            $likeCriteria = "(cashAccount.cash_account_name  LIKE '%".$filter['cash_account_name']."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['account_balance'])){
            
            $likeCriteria = "(cashAccount.account_balance  LIKE '%".$filter['account_balance']."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('cashAccount.company_id',$company_id);
        $this->db->where('cashAccount.is_deleted', 0);
        $this->db->order_by('cashAccount.row_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to add new cashAccount to system
     */
    function addCashAccount($cashAccountInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_cash_account', $cashAccountInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    } 

      /**
     * This function is used to add new cash transfer details
     */
    function transferCashDetails($transferCashInfo){
        $this->db->trans_start();
        $this->db->insert('tbl_cash_account_transfer_info', $transferCashInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

 /**
     * This function is used to add new cash Details
     */
    function addCashDetails($cashInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_cash_details', $cashInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

 
    
    /**
     * This function is used to update the cashAccount information
     */
    function updateCashAccount($cashAccountInfo,$row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_cash_account',$cashAccountInfo);
        return TRUE;
    } 
    /**
     * This function is used to delete the cashAccount information
     */
    function deleteCashAccount($row_id,$cashAccountInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_cash_account', $cashAccountInfo);
        return $this->db->affected_rows();
    }

      /**
     * This function is used to delete the cash Transfer information
     */
    function  deleteTransferDetails($row_id,$cashTransferInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_cash_account_transfer_info', $cashTransferInfo);
        return $this->db->affected_rows();
    }
   

    
  /**
     * This function is used to delete the cash  information
     */
    function deleteCashDetails($row_id,$cashInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_cash_details', $cashInfo);
        return $this->db->affected_rows();
    }


    function deleteCashDetailsTransferInfo($transfer_row_id,$cashInfo)
    {
        $this->db->where('cash_transfer_row_id', $transfer_row_id);
        $this->db->update('tbl_cash_details', $cashInfo);
        return $this->db->affected_rows();
    }
    
     /**
     * This function is used to get  cash Account information by row_id
     */
    function getCashAccountInfoById($row_id){
        $this->db->select('cashAccount.row_id,cashAccount.cash_account_name,cashAccount.cash_account_type,cashAccount.account_balance');
        $this->db->from('tbl_cash_account as cashAccount');
        $this->db->where('cashAccount.row_id', $row_id);
        $this->db->where('cashAccount.is_deleted', 0);
        $query = $this->db->get();
        return $query->row();
    }

       /**
     * This function is used to get  cash Details information by row_id
     */
    function getCashDetailsById($row_id){
        $this->db->select('cash.row_id,cash.cash_date,cash.cash_amount,cash.bank_rowid,cash.cash_account_rowid');
        $this->db->from('tbl_cash_details as cash');
        $this->db->where('cash.row_id', $row_id);
        $this->db->where('cash.is_deleted', 0);
        $query = $this->db->get();
        return $query->row();
    }


      /**
     * This function is used to get  all Cash Accounts
     */
    function getAllCashAccounts($company_id){
        $this->db->from('tbl_cash_account as cash');
        $this->db->where('cash.company_id', $company_id);
        $this->db->where('cash.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
    
     /**
     * This function is used to get the cash details
     */
    function getCashDetails($row_id)
    {
        $this->db->select('cash.row_id,cash.cash_date,cash.cash_amount,cash.bank_rowid,cash.cash_account_rowid,bank.bank_name');
        $this->db->from('tbl_cash_details as cash');
        $this->db->join('tbl_bank_info as bank', 'bank.row_id = cash.bank_rowid','left');
        $this->db->where('cash.cash_account_rowid',$row_id);
        $this->db->where('cash.is_deleted', 0);
        $this->db->order_by('cash.row_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    /**
     * This function is used to get the cash transfer details
     */
    function getCashTransferDetails(){
        $this->db->select('
        cash.comments,
        cash.row_id,
        cash.transfer_cash_date,
        cash.transfer_cash_amount,
        cash.from_cash_account_rowid,
        cash.to_cash_account_rowid,
        cash_account_to.cash_account_name as to_cash_account,
        cash_account.cash_account_name');
        $this->db->from('tbl_cash_account_transfer_info as cash');
        $this->db->join('tbl_cash_account as cash_account', 'cash_account.row_id = cash.from_cash_account_rowid','left');
        $this->db->join('tbl_cash_account as cash_account_to', 'cash_account_to.row_id = cash.to_cash_account_rowid','left');
        $this->db->where('cash.is_deleted', 0);
        $this->db->order_by('cash.row_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    /**
     * This function is used to get the cash transfer details
     */
    function getCashTransferInfoByID($row_id){
        $this->db->select('cash.row_id,cash.transfer_cash_date,cash.transfer_cash_amount,cash.from_cash_account_rowid,cash.to_cash_account_rowid,cash_account.cash_account_name');
        $this->db->from('tbl_cash_account_transfer_info as cash');
        $this->db->join('tbl_cash_account as cash_account','cash_account.row_id = cash.from_cash_account_rowid','left');
        $this->db->where('cash.row_id', $row_id);
        $this->db->where('cash.is_deleted', 0);
        $this->db->order_by('cash.row_id', 'DESC');
        $query = $this->db->get();
        $result = $query->row();        
        return $result;
    }

    function getCashAccountReport($fromDate,$toDate,$cash_account_rowid){

       $this->db->select('cash.row_id,cash.cash_date,cash.cash_amount,cash.cash_account_rowid,cash_account.cash_account_name,cash_account.cash_account_type,cash_account.account_balance,cash.bank_rowid,cash.cash_account_rowid,cash.comments,bank.bank_name,cash_account.cash_account_name');
        $this->db->from('tbl_cash_details as cash');
        $this->db->join('tbl_bank_info as bank', 'bank.row_id = cash.bank_rowid','left');
        $this->db->join('tbl_cash_account as cash_account', 'cash_account.row_id = cash.cash_account_rowid','left');
        $from = "DATE_FORMAT(cash.cash_date, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
        $this->db->where($from);
        $to = "DATE_FORMAT(cash.cash_date, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
        $this->db->where($to);
        if($cash_account_rowid != 'All'){
            $this->db->where('cash.cash_account_rowid', $cash_account_rowid);
            }
        
        $this->db->where('cash.is_deleted', 0);
        $query = $this->db->get();
        return $query->result();
     }

   

}

  