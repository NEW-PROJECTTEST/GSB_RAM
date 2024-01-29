<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Cash_book_model extends CI_Model
{
    /**
     * This function is used to get the cashAccount listing count
     */
    function cashBookListingCount($filter='',$company_id)
    {
        $this->db->select('
        cashBook.row_id,cashBook.debit,cashBook.credit,cashBook.transaction_type,cashBook.created_date_time,cashBook.cash_date,cashBook.bank_date');
        $this->db->from('tbl_cash_expenses as cashBook');
       
        $created_date = date('Y-m-d',strtotime('cashBook.created_date_time'));
        if(!empty($filter['debit'])){
            $this->db->where('cashBook.debit', $filter['debit']);
        }
        if(!empty($filter['credit'])){
            $this->db->where('cashBook.credit', $filter['credit']);
        }
        if(!empty($filter['transaction_type'])){
            $this->db->where('cashBook.transaction_type', $filter['transaction_type']);
        }
        if(!empty($filter['created_date'])){
            $this->db->where('cashBook.cash_date',$filter['created_date']);
        }
      
        // $this->db->where('cashBook.credit !=','0.00');
        $this->db->where('cashBook.company_id',$company_id);
        $this->db->where('cashBook.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * This function is used to get the cashAccount listing 
     */
    function cashBookListing($filter='',$company_id, $page, $segment)
    {
        $this->db->select('
        cashBook.comments,
        cashBook.row_id,
        cashBook.debit,
        cashBook.credit,
        cashBook.transaction_type,
        cashBook.created_date_time,cashBook.cash_date,cashBook.bank_date');
        $this->db->from('tbl_cash_expenses as cashBook');
       
        $created_date = date('Y-m-d',strtotime('cashBook.created_date_time'));
        if(!empty($filter['debit'])){
            $this->db->where('cashBook.debit', $filter['debit']);
        }
        if(!empty($filter['credit'])){
            $this->db->where('cashBook.credit', $filter['credit']);
        }
        if(!empty($filter['transaction_type'])){
            $this->db->where('cashBook.transaction_type', $filter['transaction_type']);
        }
        if(!empty($filter['created_date'])){
            $this->db->where('cashBook.cash_date',$filter['created_date']);
        }
      
        
        $this->db->where('cashBook.company_id',$company_id);
        // $this->db->where('cashBook.credit !=', '0.00');
        $this->db->where('cashBook.is_deleted', 0);
        $this->db->order_by('cashBook.row_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
    function  getCashBookReport($fromDate,$toDate,$transaction_type){
        $this->db->select('cash_book.row_id,cash_book.transport_rowid,cash_book.cash_details_rowid,cash_book.cashLedger_rowid,cash_book.transaction_type,cash_book.created_date_time,
        cash_book.debit,cash_book.credit,transport.narration,transport.unloading_charge,transport.vehicle_number,transport.date,transport.destination,
        cash_details.cash_date,cash_details.comments,cash_ledger.cash_ledger_date,cash_ledger.reason,transporter.transporter_name');
        $this->db->from('tbl_cash_expenses as cash_book');
        $this->db->join('tbl_transport_details_karavali as transport', 'transport.row_id = cash_book.transport_rowid','left');
        $this->db->join('tbl_cash_details as cash_details', 'cash_details.row_id = cash_book.cash_details_rowid','left');
        $this->db->join(' tbl_cash_ledger as cash_ledger', 'cash_ledger.row_id = cash_book.cashLedger_rowid','left');
        $this->db->join('tbl_lease_vehicle_info as lease', 'lease.vehicle_number = transport.vehicle_number','left');
        $this->db->join('tbl_transporter as transporter', 'transporter.row_id = lease.transporter_rowid','left');
        if ($transaction_type  == 'Bank'){
            $from = "DATE_FORMAT(cash_book.created_date_time, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($from);
            $to = "DATE_FORMAT(cash_book.created_date_time, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($to);
            $this->db->where('cash_book.transaction_type', $transaction_type);
        } else if ($transaction_type  == 'All') {
            $from = "DATE_FORMAT(cash_book.created_date_time, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($from);
            $to = "DATE_FORMAT(cash_book.created_date_time, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($to);
        } else {
            $from = "DATE_FORMAT(cash_book.created_date_time, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($from);
            $to = "DATE_FORMAT(cash_book.created_date_time, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($to);
            $this->db->where('cash_book.transaction_type', $transaction_type);
        }  
        $this->db->where('cash_book.is_deleted', 0);
        $query = $this->db->get();
        return $query->result();
     }

    function getBankReport($fromDate,$toDate,$transporter_name,$party_name,$bank_name){
        $this->db->select('
        cash_book.cash_date,
        cash_book.row_id,
        cash_book.transport_rowid,
        cash_book.transaction_type,
        cash_book.created_date_time,
        cash_book.debit,
        cash_book.credit,
        cash_book.comments,
        transporter.transporter_name,
        transport.vehicle_number,
        transport.date,party.party_name,
        bank.bank_name,
        cash_book.fuel_cash_info_row_id,
        fuel.fuel_account_name');
        $this->db->from('tbl_cash_expenses as cash_book');
        $this->db->join('tbl_transport_details_karavali as transport', 'transport.row_id = cash_book.transport_rowid','left');
        $this->db->join('tbl_lease_vehicle_info as lease', 'lease.vehicle_number = transport.vehicle_number','left');
        $this->db->join('tbl_transporter as transporter', 'transporter.row_id = lease.transporter_rowid','left');
        $this->db->join('tbl_bank_info as bank', 'bank.row_id = cash_book.bank_account_row_id','left');
        $this->db->join('tbl_party_info as party', 'party.row_id = transport.party_rowid','left');
        $this->db->join('tbl_fuel_cash_info as finfo', 'cash_book.fuel_cash_info_row_id = finfo.row_id','left');
        $this->db->join('tbl_fuel_account as fuel', 'finfo.fuel_account_rowid = fuel.row_id','left');
      

        $this->db->where('cash_book.cash_date>=', date('Y-m-d',strtotime($fromDate)));
        $this->db->where('cash_book.cash_date<=', date('Y-m-d',strtotime($toDate)));

        if($transporter_name != 'ALL'){
        $this->db->where('transporter.row_id', $transporter_name);
        }
        if($bank_name != 'ALL'){
            $this->db->where('bank.row_id', $bank_name);
        }
        if($party_name != 'ALL'){
            $this->db->where('party.row_id', $party_name);
        }
        $this->db->where('cash_book.transaction_type', 'Bank');
        $this->db->where('cash_book.is_deleted', 0);
       
        $this->db->group_by('cash_book.row_id'); 
        $this->db->order_by('cash_book.cash_date', 'desc'); 
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * This function is used to add new cash expenses Details
     */
    function addCashExpenses($cashInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_cash_expenses', $cashInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
    /**
     * This function is used to update the cash expenses Details
     */
    function updateCashExpenses($cashInfo,$row_id,$trans_type)
    {
        $this->db->where('transport_rowid', $row_id);
        $this->db->where('transaction_type', $trans_type);
        $this->db->update('tbl_cash_expenses', $cashInfo);
        return TRUE;
    }
    /**
     * This function is used to update the cash expenses Details
     */
    function updateCashLedgerExpences($cashInfo,$row_id)
    {
        $this->db->where('cashLedger_rowid', $row_id);
        $this->db->update('tbl_cash_expenses', $cashInfo);
        return TRUE;
    }
     /**
     * This function is used to delete cash expenses Details
     */
    function deletecashBook($row_id,$cashBookInfo)
    {
        $this->db->where('cashLedger_rowid', $row_id);
        $this->db->update('tbl_cash_expenses', $cashBookInfo);
        return $this->db->affected_rows();
    }

    function deletecashDetailsBook($row_id,$cashBookInfo)
    {
        $this->db->where('cash_details_rowid', $row_id);
        $this->db->update('tbl_cash_expenses', $cashBookInfo);
        return $this->db->affected_rows();
    }
    function  deleteCashTransferBook($row_id,$cashBookInfo)
    {
        $this->db->where('cash_transfer_rowid', $row_id);
        $this->db->update('tbl_cash_expenses', $cashBookInfo);
        return $this->db->affected_rows();
    }


    function deleteTransportBook($row_id,$cashBookInfo)
    {
        $this->db->where('transport_rowid', $row_id);
        $this->db->update('tbl_cash_expenses', $cashBookInfo);
        return $this->db->affected_rows();
    }

    function getStartDate($cash_account_rowid)
    {
        if($cash_account_rowid != 'ALL'){
            $this->db->where('cash_account_rowid', $cash_account_rowid);   
        }
        $this->db->where('is_deleted', 0); 
        $this->db->order_by("row_id", "asc");
        $this->db->limit(1);
        $query = $this->db->get('tbl_cash_details');
        return $query->row();

    }

 //overall credit sum
    function getSumOfCredit($start_date, $end_date,$cash_account_rowid) {
    $this->db->select_sum('credit');
    $this->db->where('tbl_cash_expenses.cash_date >=', $start_date);
   
    $this->db->where('tbl_cash_expenses.cash_date <=', $end_date);
    //$this->db->where('tbl_cash_expenses.transaction_type','Cash');
    if($cash_account_rowid != 'All'){
        $this->db->where('tbl_cash_expenses.cash_account_rowid', $cash_account_rowid);
        }
    $this->db->where('tbl_cash_expenses.is_deleted', 0); 
    $result = $this->db->get('tbl_cash_expenses')->row(); 
    return $result->credit;
   }

 
 //overall debit sum
    function getsumOfDebit($start_date, $end_date,$cash_account_rowid){
    $this->db->select_sum('debit');
    $this->db->where('tbl_cash_expenses.cash_date >=', $start_date);
    $this->db->where('tbl_cash_expenses.cash_date <=', $end_date);
    //$this->db->where('tbl_cash_expenses.transaction_type','Cash');
    if($cash_account_rowid != 'All'){
        $this->db->where('tbl_cash_expenses.cash_account_rowid', $cash_account_rowid);
        }
    $this->db->where('tbl_cash_expenses.is_deleted', 0); 
    $result = $this->db->get('tbl_cash_expenses')->row(); 
    return $result->debit;
   }


  //cashLedger Info

    function getCashLedgerCashBookInfo($fromDate,$toDate,$cash_account_rowid){
        $this->db->select('cash_book.row_id,cash_book.cash_date,cash_book.cash_account_rowid,cash_book.cashLedger_rowid,cash_book.transaction_type,cash_book.created_date_time,
        cash_book.credit,party.party_name, cash_ledger.cash_ledger_date, cash_account.cash_account_name,cash_ledger.reason');
        $this->db->from('tbl_cash_expenses as cash_book');
        $this->db->join('tbl_cash_ledger as cash_ledger', 'cash_ledger.row_id = cash_book.cashLedger_rowid');
       
        $this->db->join('tbl_cash_account as cash_account', 'cash_account.row_id = cash_book.cash_account_rowid','left');

        $this->db->join('tbl_party_info as party', 'party.row_id = cash_ledger.party_rowid','left');

        $this->db->where('cash_book.cash_date >=', date('Y-m-d',strtotime($fromDate)));
        $this->db->where('cash_book.cash_date <=', date('Y-m-d',strtotime($toDate)));

        if($cash_account_rowid != 'All'){
            $this->db->where('cash_book.cash_account_rowid', $cash_account_rowid);
            }
        
        $this->db->where('cash_book.cashLedger_rowid !=', "");
        $this->db->where('cash_book.credit !=', "");
        $this->db->where('cash_book.transaction_type', 'Cash');
        $this->db->where('cash_book.is_deleted', 0);
        $query = $this->db->get();
        return $query->result();

    }
    


    // transport Info
    function getTransportCashBookInfo($fromDate,$toDate,$cash_account_rowid){
        $this->db->select('cash_book.comments, cash_book.row_id,cash_book.cash_date,cash_book.cash_account_rowid,cash_book.cashLedger_rowid,cash_book.transaction_type,cash_book.created_date_time,
        transport.vehicle_number, cash_book.credit,transport.date,party.party_name,cash_account.cash_account_name, transport.narration');
        $this->db->from('tbl_cash_expenses as cash_book');
        $this->db->join('tbl_transport_details_karavali as transport', 'transport.row_id = cash_book.transport_rowid');
       
        //to get transporter name
        //$this->db->join('tbl_lease_vehicle_info as lease', 'lease.vehicle_number = transport.vehicle_number','left');
        //$this->db->join('tbl_transporter as transporter', 'transporter.row_id = cash_book.transporter_rowid','left');

        //to get cash account name
        $this->db->join('tbl_cash_account as cash_account', 'cash_account.row_id = cash_book.cash_account_rowid','left');

        //to ge party name
        $this->db->join('tbl_party_info as party', 'party.row_id = transport.party_rowid','left');

        $this->db->where('cash_book.cash_date >=', date('Y-m-d',strtotime($fromDate)));
        $this->db->where('cash_book.cash_date <=', date('Y-m-d',strtotime($toDate)));

        if($cash_account_rowid != 'All'){
            $this->db->where('cash_book.cash_account_rowid', $cash_account_rowid);
            }
        
        $this->db->where('cash_book.credit !=', "");
        $this->db->where('cash_book.transaction_type','Cash');
        $this->db->where('cash_book.is_deleted', 0);
        $query = $this->db->get();
        return $query->result();
    }

      // transport Info
      function getFuelCashInfoDetails($fromDate,$toDate,$cash_account_rowid){
        $this->db->select('cash_book.cash_date as date, cash_book.comments, cash_book.row_id,cash_book.cash_account_rowid,cash_book.cashLedger_rowid,cash_book.transaction_type,cash_book.created_date_time,
        cash_book.credit,cash_account.cash_account_name');
        $this->db->from('tbl_cash_expenses as cash_book');
        $this->db->join('tbl_fuel_cash_info as fuel', 'fuel.row_id = cash_book.fuel_cash_info_row_id');
       
        //to get transporter name
        //$this->db->join('tbl_lease_vehicle_info as lease', 'lease.vehicle_number = transport.vehicle_number','left');
        //$this->db->join('tbl_transporter as transporter', 'transporter.row_id = cash_book.transporter_rowid','left');

        //to get cash account name
        $this->db->join('tbl_cash_account as cash_account', 'cash_account.row_id = cash_book.cash_account_rowid','left');

        //to ge party name
        //$this->db->join('tbl_party_info as party', 'party.row_id = transport.party_rowid','left');

        $this->db->where('cash_book.cash_date >=', date('Y-m-d',strtotime($fromDate)));
        $this->db->where('cash_book.cash_date <=', date('Y-m-d',strtotime($toDate)));

        if($cash_account_rowid != 'All'){
            $this->db->where('cash_book.cash_account_rowid', $cash_account_rowid);
        }
        
        $this->db->where('cash_book.credit !=', "");
        $this->db->where('cash_book.transaction_type','Cash');
        $this->db->where('cash_book.is_deleted', 0);
        $query = $this->db->get();
        return $query->result();
    }


  // transport Info
  function getCashTransportInfoForReport($fromDate,$toDate,$cash_account_rowid){
    $this->db->select('cash_book.row_id,cash_book.cash_date,cash_book.cash_account_rowid,cash_book.cashLedger_rowid,cash_book.transaction_type,cash_book.created_date_time,
    transport.vehicle_number, cash_book.credit,cash_account.cash_account_name');
    $this->db->from('tbl_cash_expenses as cash_book');
    $this->db->join('tbl_cash_account_transfer_info as transfer', 'transfer.row_id = cash_book.cash_transfer_rowid');
   
    //to get transporter name
    //$this->db->join('tbl_lease_vehicle_info as lease', 'lease.vehicle_number = transport.vehicle_number','left');
    //$this->db->join('tbl_transporter as transporter', 'transporter.row_id = cash_book.transporter_rowid','left');

    //to get cash account name
    $this->db->join('tbl_cash_account as cash_account', 'cash_account.row_id = cash_book.cash_account_rowid','left');

    $this->db->where('cash_book.cash_date >=', date('Y-m-d',strtotime($fromDate)));
    $this->db->where('cash_book.cash_date <=', date('Y-m-d',strtotime($toDate)));

    if($cash_account_rowid != 'All'){
        $this->db->where('cash_book.cash_account_rowid', $cash_account_rowid);
        }
    
    $this->db->where('cash_book.credit !=', "");
    $this->db->where('cash_book.transaction_type','Cash');
    $this->db->where('cash_book.is_deleted', 0);
    $query = $this->db->get();
    return $query->result();
}


    //debit info
    function getTotalCashDebitInfo($fromDate,$toDate,$cash_account_rowid){
        $this->db->select('cash_book.row_id,cash_book.created_date_time,cash_book.cash_date,cash_book.cash_account_rowid,
        cash_book.debit,cash_account.cash_account_name, cash_details.comments, cash_book.comments as debit_comments');
        $this->db->from('tbl_cash_expenses as cash_book');
        $this->db->join('tbl_cash_details as cash_details', 'cash_details.row_id = cash_book.cash_details_rowid','left');
        $this->db->join('tbl_cash_account as cash_account', 'cash_account.row_id = cash_book.cash_account_rowid','left');
        $this->db->where('cash_book.debit !=', "");
       // $this->db->where('cash_book.transaction_type', 'Bank');
        $this->db->where('cash_book.cash_date >=', date('Y-m-d',strtotime($fromDate)));
        $this->db->where('cash_book.cash_date <=', date('Y-m-d',strtotime($toDate)));
        if($cash_account_rowid != 'All'){
            $this->db->where('cash_book.cash_account_rowid', $cash_account_rowid);
            }
    
        $this->db->where('cash_book.is_deleted', 0);
        $this->db->order_by('cash_book.cash_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

        //debit info
        function getTotalCashCreditInfoTransfer($fromDate,$toDate,$cash_account_rowid){
            $this->db->select('cash_book.row_id,cash_book.created_date_time,cash_book.cash_date,cash_book.cash_account_rowid,
            cash_book.credit,cash_account.cash_account_name, cash_book.comments as debit_comments');
            $this->db->from('tbl_cash_expenses as cash_book');
            $this->db->join('tbl_cash_account as cash_account', 'cash_account.row_id = cash_book.cash_account_rowid','left');
            $this->db->join('tbl_cash_account_transfer_info as transfer', 'transfer.row_id = cash_book.cash_transfer_rowid','left');
            $this->db->where('cash_book.credit !=', "");
           // $this->db->where('cash_book.transaction_type', 'Bank');
            $this->db->where('cash_book.cash_date >=', date('Y-m-d',strtotime($fromDate)));
            $this->db->where('cash_book.cash_date <=', date('Y-m-d',strtotime($toDate)));
            if($cash_account_rowid != 'All'){
                $this->db->where('cash_book.cash_account_rowid', $cash_account_rowid);
                }
        
            $this->db->where('cash_book.is_deleted', 0);
            $this->db->where('transfer.is_deleted', 0);
            $query = $this->db->get();
            return $query->result();
        }

    // function getCashTransferCashBookInfo($fromDate,$toDate,$cash_account_rowid){
    //     $this->db->select('transfer.row_id,transfer.transfer_cash_date,cash_book.cash_account_rowid,
    //     cash_book.credit,cash_book.cash_date,cash_account.cash_account_name');
    //     $this->db->from('tbl_cash_account_transfer_info as transfer');
    //     $this->db->join('tbl_cash_account as cash_account', 'cash_account.row_id = transfer.to_cash_account_rowid');
    //     $this->db->where('transfer.transfer_cash_date >=', date('Y-m-d',strtotime($fromDate)));
    //     $this->db->where('transfer.transfer_cash_date <=', date('Y-m-d',strtotime($toDate)));
    //     if($cash_account_rowid != 'All'){
    //         $this->db->where('cash_book.cash_account_rowid', $cash_account_rowid);
    //         }
        
    //     $this->db->where('cash_book.credit !=', "");
    //     $this->db->where('cash_book.transaction_type','Cash');
    //     $this->db->where('cash_book.is_deleted', 0);
    //     $query = $this->db->get();
    //     return $query->result();
    // }
    function getCashTransferCashBookInfo($fromDate,$toDate,$cash_account_rowid){
        $this->db->select('transfer.row_id,transfer.transfer_cash_date,cash_book.cash_account_rowid,
        cash_book.credit,cash_book.cash_date,cash_account.cash_account_name');
        $this->db->from('tbl_cash_account_transfer_info as transfer');
        $this->db->join('tbl_cash_account as cash_account', 'cash_account.row_id = transfer.to_cash_account_rowid');
        $this->db->where('transfer.transfer_cash_date >=', date('Y-m-d',strtotime($fromDate)));
        $this->db->where('transfer.transfer_cash_date <=', date('Y-m-d',strtotime($toDate)));
        if($cash_account_rowid != 'All'){
            $this->db->where('cash_book.cash_account_rowid', $cash_account_rowid);
            }
        
        $this->db->where('cash_book.credit !=', "");
        $this->db->where('cash_book.transaction_type','Cash');
        $this->db->where('cash_book.is_deleted', 0);
        $query = $this->db->get();
        return $query->result();
    }
    //to get cashbook info of  cash ledger
    function getCashbookInfo($row_id){ 
        // $this->db->select('cash_book.row_id,cash_book.cashLedger_rowid,cash_book.transaction_type,cash_book.created_date_time,
        // cash_book.credit');
        $this->db->from('tbl_cash_expenses as cash_book');
        $this->db->where('cash_book.cashLedger_rowid', $row_id);  
        $this->db->where('cash_book.is_deleted', 0);
        $query = $this->db->get();
        return $query->row();
    }

    function getCashbookInfoOfTransport($row_id,$trans_type){
        $this->db->from('tbl_cash_expenses as cash_book');
        $this->db->where('cash_book.transport_rowid', $row_id);  
        $this->db->where('cash_book.transaction_type', $trans_type);  
        $this->db->where('cash_book.is_deleted', 0);
        $query = $this->db->get();
        return $query->result();
    }

function getFirstAddedTransportCashInfo($transport_rowid, $type){
    $this->db->select("*");
    $this->db->from("tbl_cash_expenses");
    $this->db->limit(1);
    $this->db->where('transaction_type', $type);
    $this->db->where('transport_rowid', $transport_rowid);
    $this->db->where('is_deleted', 0);
    $this->db->order_by('row_id',"ASC");
    $query = $this->db->get();
    return $query->row();
}


function updateCashExpByRowId($row_id,$cashBookInfo)
{
    $this->db->where('row_id', $row_id);
    $this->db->update('tbl_cash_expenses', $cashBookInfo);
    return $this->db->affected_rows();
}

function updateCashExpById($row_id,$cashBookInfo)
{
    $this->db->where('row_id', $row_id);
    $this->db->update('tbl_cash_expenses', $cashBookInfo);
    return $this->db->affected_rows();
}
    //    //debit sum based on cash account
//    function getsumOfDebitByAccountId($start_date, $end_date,$cash_account_rowid){
//     $this->db->select_sum('debit');
//     $from = "DATE_FORMAT(tbl_cash_expenses.cash_date, '%Y-%m-%d' ) >= '".$start_date."'";
//     $this->db->where($from);
//     $to = "DATE_FORMAT(tbl_cash_expenses.cash_date, '%Y-%m-%d' ) <= '".$end_date."'";
//     $this->db->where($to);
//     $this->db->where('tbl_cash_expenses.is_deleted', 0); 
//     $this->db->where('tbl_cash_expenses.cash_account_rowid', $cash_account_rowid);
//     $result = $this->db->get('tbl_cash_expenses')->row(); 
//     return $result->debit;

//    }
//    //sum of cash ledger credit 
//    function getSumOfCreditByCashLedger($start_date, $end_date,$cash_account_rowid){
//     $this->db->select_sum('credit');
//     $from = "DATE_FORMAT(tbl_cash_expenses.cash_date, '%Y-%m-%d' ) >= '".$start_date."'";
//     $this->db->where($from);
//     $to = "DATE_FORMAT(tbl_cash_expenses.cash_date, '%Y-%m-%d' ) <= '".$end_date."'";
//     $this->db->where($to);
//     $this->db->where('tbl_cash_expenses.transaction_type','Cash');
//     $this->db->where('tbl_cash_expenses.cash_account_rowid', $cash_account_rowid);
//     $this->db->where('tbl_cash_expenses.is_deleted', 0); 
//     $result = $this->db->get('tbl_cash_expenses')->row(); 
//     return $result->credit;
//    }


//    //sum of transport credit 
//    function getSumOfCreditByTransport($start_date, $end_date,$cash_account_rowid){
//     $this->db->select_sum('credit');
//     $from = "DATE_FORMAT(tbl_cash_expenses.cash_date, '%Y-%m-%d' ) >= '".$start_date."'";
//     $this->db->where($from);
//     $to = "DATE_FORMAT(tbl_cash_expenses.cash_date, '%Y-%m-%d' ) <= '".$end_date."'";
//     $this->db->where($to);
//     $this->db->where('tbl_cash_expenses.transaction_type','Cash');
//     $this->db->where('tbl_cash_expenses.cash_account_rowid', $cash_account_rowid);
//     $this->db->where('tbl_cash_expenses.is_deleted', 0); 
//     $result = $this->db->get('tbl_cash_expenses')->row(); 
//     return $result->credit;
//    }


function updatePonchInfoOfCashExp($ponch_row_id,$cashBookInfo)
{
    $this->db->where('ponch_cleared_row_id', $ponch_row_id);
    $this->db->update('tbl_cash_expenses', $cashBookInfo);
    return $this->db->affected_rows();
}
}

  