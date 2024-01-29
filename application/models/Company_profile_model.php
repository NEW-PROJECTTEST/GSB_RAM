<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Company_profile_model extends CI_Model
{
    /**
     * This function is used to add new CompanyProfile to system
     */
    function addCompanyProfileToDb($compnayInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_company_profile', $compnayInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

      /**
     * This function is used to update the company information
     */
    
    function updateCompanyProfile($compnayInfo,$row_id)
    {
        $this->db->where('row_id',$row_id);
        $this->db->update('tbl_company_profile',$compnayInfo);
        return TRUE;
    }
       /**
     * This function is used get companyInfo
     */
    function getcompanyInfo($company_id)
    {
        // $this->db->select('row_id,company_id,company_name,company_logo,cgst,sgst,igst,utgst,company_pan_number,founder_name,company_address,company_contact_number_one,company_contact_number_two,company_gst_number,company_website_url,company_email,total_employee,is_deleted');
        $this->db->from('tbl_company_profile as company');
        $this->db->where('company.company_id', $company_id);
        $this->db->where('company.is_deleted', 0);
        $query = $this->db->get();
        return $query->row();
    }
     
    /**
     *  This function is used to get the feedback listing  count
     */
    function feedbackListingCount($searchText = '',$filter='')
    {
        $this->db->select('feedback.row_id,feedback.call_log_id,feedback.ratings,feedback.comments,employee.employee_name,customer.customer_name');
        $this->db->from('tbl_customer_feedback as feedback');
        $this->db->from('tbl_phone_call_logs as call_log','call_log.row_id = feedback.call_log_id','left');
        $this->db->join('tbl_users as employee', 'employee.employee_id = call_log.employee_id','left');
        $this->db->join('tbl_customer as customer', 'customer.customer_id = call_log.customer_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(employee.employee_name  LIKE '%".$searchText."%'
            OR  customer.customer_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['employee_name'])){
            $likeCriteria = "(employee.employee_name  LIKE '%".$filter['employee_name']."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['customer_name'])){
            $likeCriteria = "(customer.customer_name  LIKE '%".$filter['customer_name']."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['call_log_id'])){
            $this->db->where('feedback.call_log_id', $filter['call_log_id']);
        }
        if(!empty($filter['ratings'])){
            $this->db->where('feedback.ratings', $filter['ratings']);
        }
        $this->db->where('feedback.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * This function is used to get the feedback listing 
     */
    function feedbackListing($searchText = '',$filter='',$page,$segment)
    {
        $this->db->select('feedback.row_id,feedback.call_log_id,feedback.ratings,feedback.comments,employee.employee_name,customer.customer_name');
        $this->db->from('tbl_customer_feedback as feedback');
        $this->db->from('tbl_phone_call_logs as call_log','call_log.row_id = feedback.call_log_id','left');
        $this->db->join('tbl_users as employee', 'employee.employee_id = call_log.employee_id','left');
        $this->db->join('tbl_customer as customer', 'customer.customer_id = call_log.customer_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(employee.employee_name  LIKE '%".$searchText."%'
            OR  customer.customer_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['employee_name'])){
            $likeCriteria = "(employee.employee_name  LIKE '%".$filter['employee_name']."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['customer_name'])){
            $likeCriteria = "(customer.customer_name  LIKE '%".$filter['customer_name']."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['call_log_id'])){
            $this->db->where('feedback.call_log_id', $filter['call_log_id']);
        }
        if(!empty($filter['ratings'])){
            $this->db->where('feedback.ratings', $filter['ratings']);
        }
        $this->db->where('feedback.is_deleted', 0);
        $this->db->order_by('feedback.row_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
}