<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function customerListingCount($searchText = '',$filter='',$company_id)
    {
       $this->db->from('tbl_customer as customer');
        if(!empty($searchText)) {
            $likeCriteria = "(customer.customer_code  LIKE '%".$searchText."%'
            OR  customer.customer_name  LIKE '%".$searchText."%'
            OR  customer.contact_number  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['customer_name'])){
            $likeCriteria = "(customer.customer_name  LIKE '%".$filter['customer_name']."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['customer_type'])){
            $likeCriteria = "(customer.customer_type  LIKE '%".$filter['customer_type']."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['contact_number'])){
            $this->db->where('customer.contact_number', $filter['contact_number']);
        }
        if(!empty($filter['email'])){
            $this->db->where('customer.email', $filter['email']);
        }
        if(!empty($filter['customer_address'])){
            $likeCriteria = "(customer.customer_address  LIKE '%".$filter['customer_address']."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('customer.company_id',$company_id);
        $this->db->where('customer.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function customerListing($searchText = '',$filter='',$company_id, $page, $segment)
    {
       $this->db->from('tbl_customer as customer');
        if(!empty($searchText)) {
            $likeCriteria = "(customer.email  LIKE '%".$searchText."%'
            OR  customer.customer_name  LIKE '%".$searchText."%'
            OR  customer.contact_number  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['customer_name'])){
            $likeCriteria = "(customer.customer_name  LIKE '%".$filter['customer_name']."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['customer_type'])){
            $likeCriteria = "(customer.customer_type  LIKE '%".$filter['customer_type']."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['contact_number'])){
            $this->db->where('customer.contact_number', $filter['contact_number']);
        }
        if(!empty($filter['email'])){
            $this->db->where('customer.email', $filter['email']);
        }
        if(!empty($filter['customer_address'])){
            $likeCriteria = "(customer.customer_address  LIKE '%".$filter['customer_address']."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('customer.company_id',$company_id);
        $this->db->where('customer.is_deleted', 0);
        $this->db->order_by('customer.customer_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
     /* get customer information*/
     function getcustomerInfoById($customer_id)
     {
       $this->db->from('tbl_customer as customer');
        // $this->db->join('tbl_users as user', 'user.employee_id = customer.assigned_employee_id');
        $this->db->where('customer.customer_id', $customer_id);
        $this->db->where('customer.is_deleted', 0);
        $query = $this->db->get();
        return $query->row();
     }
 
    /**
     * This function is used to add new customer to system
     * @return number $insert_id : This is last inserted id
     */
    function addcustomer($customerInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_customer', $customerInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
      /**
     * This function is used to update the customer information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function updateCustomer($customerInfo,$customer_id)
    {
        $this->db->where('customer_id', $customer_id);
        $this->db->update('tbl_customer', $customerInfo);
        return TRUE;
    }
    

    /**
     * This function is used to delete the customer information
     * @param number $userId : This is customer_id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteCustomer($customer_id,$customerInfo)
    {
        $this->db->where('customer_id', $customer_id);
        $this->db->update('tbl_customer', $customerInfo);
        return $this->db->affected_rows();
    }

    /**
     * This function is used to change users password
     * @param number $userId : This is user id
     * @param array $userInfo : This is user updation info
     */
    function changePassword($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', $userInfo);
        return $this->db->affected_rows();
    }

      /**
     * This function used to get customer_id
     */
   
    function  getAllCustomer()
    {
        $this->db->from('tbl_customer as customer');
        $this->db->where('customer.is_deleted', 0);
        $query = $this->db->get();
        return $query->result();
    }

     /**
     *   Customer Count
     */

    function totalCustomers()
    {
        $this->db->from('tbl_customer as customer');
        $this->db->where('customer.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }
  

    function createIdent($identInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_product_indent_info', $identInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }


    public function getIdentInfo(){
        $this->db->select('ident.row_id,
                ident.date,
                ident.contract_number,
                ident.customer_id,
                ident.product_code,
                cust.customer_name,
                cust.customer_code');
        $this->db->from('tbl_product_indent_info as ident');
        $this->db->join('tbl_customer as cust', 'cust.customer_id = ident.customer_id','left');
      
        $this->db->where('ident.is_deleted', 0);
        $this->db->order_by('ident.row_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    public function getIdentInfoById($ident_id){
        $this->db->select('ident.row_id,
        ident.date,
        ident.product_code,
        ident.contract_number,
        ident.customer_id,
        ident.qty_unit,
        ident.destination_km,
        ident.lr_number,
        ident.tank_truck_number,
        ident.shipping_bill_no,
        ident.container_no,
        ident.driver_name,
        ident.dl_num_validity,
        ident.cleaner_name,
        ident.fitness_cert_valid_date,
        cust.customer_name,
        cust.customer_code');
        $this->db->from('tbl_product_indent_info as ident');
        $this->db->join('tbl_customer as cust', 'cust.customer_id = ident.customer_id','left');

        $this->db->where('ident.is_deleted', 0);
        $this->db->where('ident.row_id', $ident_id);
        $this->db->order_by('ident.row_id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function updateIndent($row_id, $indentInfo){
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_product_indent_info', $indentInfo);
        return TRUE;
    }
}

  