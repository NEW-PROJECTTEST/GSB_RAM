<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Billing_model extends CI_Model
{
    public function billListing(){
        $this->db->select_sum('paid.paid_amount');
        $this->db->select('paid.bill_row_id,bill.row_id,bill.date,party.party_name,bill.bill_no,bill.ref_no,bill.product,bill.total_amount');
        $this->db->from('tbl_billing_info as bill');
        $this->db->join('tbl_party_info as party','party.row_id = bill.party_row_id','left');
        $this->db->join('tbl_bill_amount_paid_info as paid','paid.bill_row_id = bill.row_id','left');
        $this->db->where('bill.is_deleted', 0);
        $this->db->group_by('bill.row_id');
        $this->db->order_by('bill.row_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function addBillToDB($billInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_billing_info', $billInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function addBillDetailToDB($billDetailInfo){
        $this->db->trans_start();
        $this->db->insert('tbl_billing_details_info', $billDetailInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function updateBill($row_id,$billInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_billing_info', $billInfo);
        return TRUE;
    }

    function getBillInfoById($row_id){
        $this->db->select('bill.row_id,bill.date,bill.party_row_id,party.party_name,party.party_address,party.party_gst,party.party_state_code,bill.bill_no,bill.ref_no,bill.product,bill.total_amount');
        $this->db->from('tbl_billing_info as bill');
        $this->db->join('tbl_party_info as party','party.row_id = bill.party_row_id','left');
        $this->db->where('bill.row_id',$row_id);
        $this->db->where('bill.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->row();        
        return $result;
    }
    

    function getBillDetailsById($row_id){
        //$this->db->select('bill.row_id,bill.date,party.party_name,bill.bill_no,bill.ref_no,bill.product');
        $this->db->from('tbl_billing_details_info as bill');
        $this->db->where('bill.bill_row_id',$row_id);
        $this->db->where('bill.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function deleteBillDetails($row_id){
        $this->db->where('bill_row_id',$row_id);
        $this->db->delete('tbl_billing_details_info');
        return true;
    }

    function addBillPayment($payInfo){
        $this->db->trans_start();
        $this->db->insert('tbl_bill_amount_paid_info', $payInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function getBillInfoByPartyId($row_id){
        $this->db->select('bill.row_id,bill.date,bill.bill_no,bill.ref_no,bill.product,bill.total_amount');
        $this->db->from('tbl_billing_info as bill');
        //$this->db->join('tbl_party_info as party','party.row_id = bill.party_row_id','left');
        $this->db->where('bill.party_row_id',$row_id);
        $this->db->where('bill.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function getBillPaidInfoByPartyId($row_id){
        $this->db->select('paid.trans_date,paid.paid_amount,paid.payment_type,bill.bill_no');
        $this->db->from('tbl_bill_amount_paid_info as paid');
        $this->db->join('tbl_billing_info as bill','bill.row_id = paid.bill_row_id','left');
        $this->db->where('bill.party_row_id',$row_id);
        $this->db->where('bill.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function getBillTotalByPartyId($row_id){
        $this->db->select_sum('total_amount');
        $this->db->from('tbl_billing_info as bill');
        $this->db->where('bill.party_row_id',$row_id);
        $this->db->where('bill.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->row();        
        return $result->total_amount;
    }

    function getBillPaidTotalByPartyId($row_id){
        $this->db->select_sum('paid_amount');
        $this->db->from('tbl_bill_amount_paid_info as paid');
        $this->db->join('tbl_billing_info as bill','bill.row_id = paid.bill_row_id','left');
        $this->db->where('bill.party_row_id',$row_id);
        $this->db->where('bill.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->row();        
        return $result->paid_amount;
    }
}