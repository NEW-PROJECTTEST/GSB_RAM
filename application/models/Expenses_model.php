<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Expenses_model extends CI_Model
{
    /**
     * This function is used to get the devotee listing count
     */
    function expensesListingCount($searchText = '',$filter='',$company_id)
    {
        $this->db->from('tbl_expenses as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.account_type  LIKE '%".$searchText."%'
            OR  BaseTbl.expense_type  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['account_type'])){
            $likeCriteria = "(BaseTbl.account_type  LIKE '%".$filter['account_type']."%')";
            $this->db->where($likeCriteria);
        }
        // if(!empty($filter['row_id'])){
        //     $this->db->where('BaseTbl.row_id', $filter['row_id']);
        // }
        if(!empty($filter['expense_type'])){
            $this->db->where('BaseTbl.expense_type', $filter['expense_type']);
        }
       
        $this->db->where('BaseTbl.company_id',$company_id);
        $this->db->where('BaseTbl.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * This function is used to get the devotee listing count
     */
    function expensesListing($searchText = '',$filter='',$company_id, $page, $segment)
    {
        $this->db->select('BaseTbl.row_id, BaseTbl.account_type, BaseTbl.amount, BaseTbl.comments,
        BaseTbl.expense_type,BaseTbl.expense_type,BaseTbl.event_type,BaseTbl.committee_name,BaseTbl.expense_date');
        $this->db->from('tbl_expenses as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.account_type  LIKE '%".$searchText."%'
            OR  BaseTbl.expense_type  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['account_type'])){
            $likeCriteria = "(BaseTbl.account_type  LIKE '%".$filter['account_type']."%')";
            $this->db->where($likeCriteria);
        }
        // if(!empty($filter['row_id'])){
        //     $this->db->where('BaseTbl.row_id', $filter['row_id']);
        // }
        if(!empty($filter['expense_type'])){
            $this->db->where('BaseTbl.expense_type', $filter['expense_type']);
        }

        $this->db->where('BaseTbl.company_id',$company_id);
        $this->db->where('BaseTbl.is_deleted', 0);
        $this->db->order_by('BaseTbl.row_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
     /**
     * This function is used to check whether  id is already exist or not
     */
    // function checkDevoteeIDExists($devotee_id, $row_id = 0)
    // {
    //     $this->db->select("devotee_id");
    //     $this->db->from("tbl_devotee");
    //     $this->db->where("devotee_id", $devotee_id);   
    //     $this->db->where("is_deleted", 0);
    //     if($row_id != 0){
    //         $this->db->where("row_id !=", $row_id);
    //     } 
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    
    /**
     * This function is used to add new devotee to system
     */
    function addExpenses($expensesInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_expenses', $expensesInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
      /**
     * This function is used to update the devotee information
     */
    function updateExpense($expensesInfo, $row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_expenses', $expensesInfo);
        return TRUE;
    }

    /**
     * This function is used to delete the devotee information
     */
    function deleteExpense($expense_id, $expensesInfo)
    {
        $this->db->where('row_id', $expense_id);
        $this->db->update('tbl_expenses', $expensesInfo);
        return $this->db->affected_rows();
    }

     /* get devotee information by row_id*/
     function getExpenseInfoById($row_id)
     {
     
         $this->db->select('BaseTbl.row_id,BaseTbl.expense_date,BaseTbl.year,BaseTbl.type_of_expense,BaseTbl.committee_id,BaseTbl.committee_name,BaseTbl.event_type, BaseTbl.account_type, BaseTbl.amount, BaseTbl.invoice_no, BaseTbl.expense_type, BaseTbl.comments,BaseTbl.party_id,party.party_name,bank.row_id as bank_id,bank.bank_name,cash.row_id as cash_id,cash.cash_account_name');
         $this->db->join('tbl_party_info as party','party.row_id = BaseTbl.party_id','left');
         $this->db->join('tbl_bank_info as bank','bank.row_id = BaseTbl.bank_row_id','left');
         $this->db->join('tbl_cash_account as cash','cash.row_id = BaseTbl.cash_row_id','left');
         $this->db->from('tbl_expenses as BaseTbl'); 
         $this->db->where('BaseTbl.row_id', $row_id);
         $this->db->where('BaseTbl.is_deleted', 0);
         $query = $this->db->get();
         return $query->row();
     }
   

     /**
     * This function is used to get all devotees based on company_id
     */
    function getDevoteeInfo($company_id){
        $this->db->from('tbl_devotee as devotee');
        $this->db->where('devotee.company_id', $company_id);
        $this->db->where('devotee.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

     /**
     *   devotee Count
     */
    function totalDevotees($company_id)
    {
        $this->db->from('tbl_devotee as devotee');
        $this->db->where('devotee.company_id', $company_id);
        $this->db->where('devotee.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

   /* get devotee information by row_id for profile page*/
      function getDevoteeInfoById($row_id)
      {
         $this->db->select('BaseTbl.row_id, BaseTbl.email, BaseTbl.devotee_name, BaseTbl.contact_number, BaseTbl.gender, BaseTbl.dob,BaseTbl.alternative_contact_number, BaseTbl.devotee_address, BaseTbl.profile_image');
         $this->db->from('tbl_devotee as BaseTbl'); 
         $this->db->where('BaseTbl.row_id', $row_id);
         $this->db->where('BaseTbl.is_deleted', 0);
         $query = $this->db->get();
         return $query->row();
      }

      function getPartyInfo($company_id)
     {
     
         $this->db->from('tbl_party_info as party'); 
         $this->db->where('party.company_id',$company_id);
         $this->db->where('party.is_deleted', 0);
         $query = $this->db->get();
         $result = $query->result();        
         return $result;  
   }


   function getexpensesInfoForReport($filter='',$company_id)
   {
       $this->db->select('BaseTbl.row_id,BaseTbl.event_type,BaseTbl.year, BaseTbl.account_type, 
       BaseTbl.expense_date, BaseTbl.amount, BaseTbl.comments,BaseTbl.expense_type,BaseTbl.expense_type,BaseTbl.committee_name,
       BaseTbl.committee_id');
       $this->db->from('tbl_expenses as BaseTbl');
    //    if(!empty($searchText)) {
    //        $likeCriteria = "(BaseTbl.account_type  LIKE '%".$searchText."%'
    //        OR  BaseTbl.expense_type  LIKE '%".$searchText."%')";
    //        $this->db->where($likeCriteria);
    //    }
    //    if(!empty($filter['account_type'])){
    //        $likeCriteria = "(BaseTbl.account_type  LIKE '%".$filter['account_type']."%')";
    //        $this->db->where($likeCriteria);
    //    }
    //    // if(!empty($filter['row_id'])){
    //    //     $this->db->where('BaseTbl.row_id', $filter['row_id']);
    //    // }

    // log_message('debug','HHH'.print_r($filter,true));
       if(!empty($filter['event_type'])){
           $this->db->where('BaseTbl.event_type', $filter['event_type']);
       }

    //    if(!empty($filter['type_of_expense'])){
    //     $this->db->where('BaseTbl.type_of_expense', $filter['type_of_expense']);
    // }
    if(!empty($filter['committee_id'])){
        $this->db->where('BaseTbl.committee_name', $filter['committee_id']);
    }
       if(!empty($filter['year'])){
        $this->db->where('BaseTbl.year', $filter['year']);
    }

    if(!empty($filter['expense_fromDate'])) {
        $this->db->where('BaseTbl.expense_date >=', $filter['expense_fromDate']);
    }

    if(!empty($filter['expense_toDate'])) {
            $this->db->where('BaseTbl.expense_date <=', $filter['expense_toDate']);
        }

       $this->db->where('BaseTbl.company_id',$company_id);
       $this->db->where('BaseTbl.is_deleted', 0);
       $this->db->order_by('BaseTbl.row_id', 'DESC');
       $query = $this->db->get();
       $result = $query->result();        
       return $result;
   }


   function addDocument($certificateInfo){
    $this->db->trans_start();
    $this->db->insert('tbl_attachment_document_details', $certificateInfo);
    $insert_id = $this->db->insert_id(); 
    $this->db->trans_complete();
    return $insert_id; 
}


       function getAttachmentDocumentInfo($expense_id){
         $this->db->from('tbl_attachment_document_details as doc'); 
         $this->db->where('doc.expense_row_id',$expense_id);
         $this->db->where('doc.is_deleted', 0);
         $query = $this->db->get();
         $result = $query->result();        
         return $result;  
     }

     function getAttachmentByName($doc_name, $expense_row_id) {
        $this->db->where('doc_name', $doc_name);
        $this->db->where('expense_row_id', $expense_row_id);
        return $this->db->get('tbl_attachment_document_details')->row();
    }

    function updateDocument($row_id, $certificateInfo, $doc_name) {
        $this->db->where('expense_row_id', $row_id);
        $this->db->where('doc_name', $doc_name);
        $this->db->update('tbl_attachment_document_details', $certificateInfo);
        return $this->db->affected_rows();
    }
    
    function checkDocumentInfoExists($row_id, $doc_name) {
        $this->db->from('tbl_attachment_document_details');
        $this->db->where('doc_name', $doc_name);
        $this->db->where('expense_row_id', $row_id);
        $this->db->where("is_deleted", 0);
        $query = $this->db->get();
        return $query->num_rows(); // Return the number of rows directly
    }
    




}

  