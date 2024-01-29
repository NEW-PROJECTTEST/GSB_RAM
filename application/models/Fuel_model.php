<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Fuel_model extends CI_Model
{
    function fuelAccountListingCount($searchText = '',$filter='',$company_id)
    {
        $this->db->from('tbl_fuel_account as fuelAccount');
        $this->db->where('fuelAccount.company_id',$company_id);
        $this->db->where('fuelAccount.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * This function is used to get the fuelAccount listing 
     */
    function fuelAccountListing($searchText = '',$filter='',$company_id, $page, $segment)
    {
        $this->db->from('tbl_fuel_account as fuelAccount');
        $this->db->where('fuelAccount.company_id',$company_id);
        $this->db->where('fuelAccount.is_deleted', 0);
        $this->db->order_by('fuelAccount.row_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function addNewFuelAccount($fuelAccountInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_fuel_account', $fuelAccountInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function getFuelAccountInfoById($row_id){
        $this->db->from('tbl_fuel_account as fuelAccount');
        $this->db->where('fuelAccount.row_id', $row_id);
        $this->db->where('fuelAccount.is_deleted', 0);
        $query = $this->db->get();
        return $query->row();
    }
    function getFuelCashDetails($row_id){
        $this->db->from('tbl_fuel_cash_info as fuel');
        $this->db->where('fuel.fuel_account_rowid', $row_id);
        $this->db->where('fuel.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    
    function getFuelCashDetailsRow($row_id){
        $this->db->from('tbl_fuel_cash_info as fuel');
        $this->db->where('fuel.fuel_account_rowid', $row_id);
        $this->db->where('fuel.is_deleted', 0);
        $query = $this->db->get();
        return $query->row();
    }
    function updateFuelAccount($cashAccountInfo,$row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_fuel_account',$cashAccountInfo);
        return TRUE;
    } 

    function addFuelExpenses($fuelInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_fuel_expenses', $fuelInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function addFuelCashDetails($fuelInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_fuel_cash_info', $fuelInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function getAllPumpInfo($company_id)
    {
        $this->db->from('tbl_fuel_account as fuelAccount');
        $this->db->where('fuelAccount.company_id',$company_id);
        $this->db->where('fuelAccount.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function getPumpNameById($row_id)
    {
        $this->db->from('tbl_fuel_account as fuelAccount');
        $this->db->where('fuelAccount.row_id',$row_id);
        $this->db->where('fuelAccount.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->row();        
        return $result;
    }

    function updateFuelExpensesInTransport($fuelInfo,$row_id)
    {
        $this->db->where('transport_row_id', $row_id);
        $this->db->update('tbl_fuel_expenses',$fuelInfo);
        return TRUE;
    } 

    function updateFuelExpensesOwnVich($fuelInfo,$row_id)
    {
        $this->db->where('fuel_info_row_id', $row_id);
        $this->db->update('tbl_fuel_expenses',$fuelInfo);
        return TRUE;
    } 


    function fuelBookListingCount($filter='',$company_id)
    {
        $this->db->select('fuelExp.row_id,fuelExp.debit,fuelExp.credit,fuelExp.transaction_type,fuelExp.cash_date,fuel.fuel_account_name');
        $this->db->from('tbl_fuel_expenses as fuelExp');
        $this->db->join('tbl_fuel_account as fuel', 'fuel.row_id = fuelExp.fuel_account_row_id','left');
       
        if(!empty($filter['debit'])){
            $this->db->where('fuelExp.debit', $filter['debit']);
        }
        if(!empty($filter['credit'])){
            $this->db->where('fuelExp.credit', $filter['credit']);
        }
        if(!empty($filter['transaction_type'])){
            $this->db->where('fuelExp.transaction_type', $filter['transaction_type']);
        }
        if(!empty($filter['fuel_name'])){
            $likeCriteria = "(fuel.fuel_account_name  LIKE '%".$filter['fuel_name']."%')";
            $this->db->where($likeCriteria);
        }
      
        if(!empty($filter['created_date'])){
            $likeCriteria = "(fuelExp.created_date_time  LIKE '%".$filter['created_date']."%')";
            $this->db->where($likeCriteria);
        }
      
        // $this->db->where('fuelExp.credit !=','0.00');
        $this->db->where('fuelExp.company_id',$company_id);
        $this->db->where('fuelExp.is_deleted', 0);
        $this->db->where('fuel.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * This function is used to get the cashAccount listing 
     */
    function fuelBookListing($filter='',$company_id, $page, $segment)
    {
        $this->db->select('fuelExp.row_id,fuelExp.debit,fuelExp.credit,fuelExp.transaction_type,fuelExp.cash_date,fuel.fuel_account_name');
        $this->db->from('tbl_fuel_expenses as fuelExp');
        $this->db->join('tbl_fuel_account as fuel', 'fuel.row_id = fuelExp.fuel_account_row_id','left');
       
        if(!empty($filter['debit'])){
            $this->db->where('fuelExp.debit', $filter['debit']);
        }
        if(!empty($filter['credit'])){
            $this->db->where('fuelExp.credit', $filter['credit']);
        }
        if(!empty($filter['transaction_type'])){
            $this->db->where('fuelExp.transaction_type', $filter['transaction_type']);
        }
        if(!empty($filter['created_date'])){
            $likeCriteria = "(fuelExp.cash_date  LIKE '%".$filter['created_date']."%')";
            $this->db->where($likeCriteria);
        }
        
        if(!empty($filter['fuel_name'])){
            $likeCriteria = "(fuel.fuel_account_name  LIKE '%".$filter['fuel_name']."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('fuelExp.company_id',$company_id);
        $this->db->where('fuel.is_deleted', 0);
        $this->db->where('fuelExp.is_deleted', 0);
        $this->db->order_by('fuelExp.row_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function getFuelExpensesInfoReport($fromDate,$toDate,$vehicle_number,$diesel_pump,$vehicle_type){
        $this->db->select('fuelExp.row_id,
        fuelExp.vehicle_type,
        fuelExp.vehicle_no,
        fuelExp.debit,
        fuelExp.credit,
        fuelExp.transaction_type,
        fuelExp.cash_date,
        fuel.fuel_account_name');
        $this->db->from('tbl_fuel_expenses as fuelExp');
        $this->db->join('tbl_fuel_account as fuel', 'fuel.row_id = fuelExp.fuel_account_row_id','left');
       
        $this->db->where('fuelExp.cash_date >=', date('Y-m-d',strtotime($fromDate)));
        $this->db->where('fuelExp.cash_date <=', date('Y-m-d',strtotime($toDate)));
        if($vehicle_number != 'ALL'){
            $this->db->where('fuelExp.vehicle_no', $vehicle_number);
        }
    
        if($vehicle_type != 'ALL'){
            $type =  array($vehicle_type,'Cash');
            $this->db->where_in('fuelExp.vehicle_type',$type);
        }
        if($diesel_pump != 'ALL'){
            $this->db->where('fuelExp.fuel_account_row_id', $diesel_pump);
        }
       
        $this->db->where('fuel.is_deleted', 0);
        $this->db->where('fuelExp.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }



    //get start date of debit
    function getStartDate()
    {
        $this->db->order_by("row_id", "asc");
        $this->db->limit(1);
        $query = $this->db->get('tbl_fuel_expenses');
        return $query->row();

    }

    function getsumOfDebit($start_date, $end_date,$fuel_account_row_id){
        $this->db->select_sum('debit');
        //$from = "DATE_FORMAT(tbl_fuel_expenses.cash_date, '%Y-%m-%d' ) >= '".."'";
        $this->db->where('tbl_fuel_expenses.cash_date >=', $start_date);
       // $to = "DATE_FORMAT(tbl_fuel_expenses.cash_date, '%Y-%m-%d' ) <= '".$end_date."'";
       $this->db->where('tbl_fuel_expenses.cash_date <=', $end_date);
        if($fuel_account_row_id != 'ALL'){
            $this->db->where('tbl_fuel_expenses.fuel_account_row_id', $fuel_account_row_id);
            }
        $this->db->where('tbl_fuel_expenses.is_deleted', 0); 
        $result = $this->db->get('tbl_fuel_expenses')->row(); 
        return $result->debit;
       }

        //overall credit sum
    function getSumOfCredit($start_date, $end_date,$fuel_account_row_id) {
        $this->db->select_sum('credit');
        $from = "DATE_FORMAT(tbl_fuel_expenses.cash_date, '%Y-%m-%d' ) >= '".$start_date."'";
        $this->db->where($from);
        $to = "DATE_FORMAT(tbl_fuel_expenses.cash_date, '%Y-%m-%d' ) <= '".$end_date."'";
        $this->db->where($to);
       // $this->db->where('tbl_fuel_expenses.transaction_type','Cash');
        if($fuel_account_row_id != 'ALL'){
            $this->db->where('tbl_fuel_expenses.fuel_account_row_id', $fuel_account_row_id);
            }
        $this->db->where('tbl_fuel_expenses.is_deleted', 0); 
        $result = $this->db->get('tbl_fuel_expenses')->row(); 
        return $result->credit;
       }
          // transport Info
    function getFuelCreditedInfo($fuel_cash_info_row_id,$type){
        $this->db->from('tbl_cash_expenses as cash_book');
        $this->db->where('cash_book.fuel_cash_info_row_id', $fuel_cash_info_row_id);
        $this->db->where('cash_book.transaction_type',$type);
        $this->db->where('cash_book.is_deleted', 0);
        $query = $this->db->get();
        return $query->row();
    }

    function updateFuelCashInfo($cashAccountInfo,$row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_fuel_cash_info',$cashAccountInfo);
        return TRUE;
    } 

    function getFuelInfoOpeningBalanceRowId($fuel_account_id){
        $this->db->select("*");
        $this->db->from("tbl_fuel_cash_info");
        $this->db->limit(1);
        $this->db->where('fuel_account_rowid', $fuel_account_id);
        $this->db->where('is_deleted', 0);
        $this->db->order_by('row_id',"ASC");
        $query = $this->db->get();
        return $query->row();
    }

    
    function updateFuelCashInfoRowId($cashAccountInfo,$row_id)
    {
        $this->db->where('fuel_cash_info_row_id', $row_id);
        $this->db->update('tbl_fuel_expenses',$cashAccountInfo);
        return TRUE;
    } 
    
}