<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Employee_model extends CI_Model
{
    /**
     * This function is used to get the employee listing count
     */
    function employeeListingCount($searchText = '',$filter='',$company_id)
    {
        $this->db->select('BaseTbl.row_id,BaseTbl.employee_id, BaseTbl.email, BaseTbl.employee_name, BaseTbl.contact_number, Role.role,BaseTbl.company_id');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.role_id = BaseTbl.role_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
            OR  BaseTbl.employee_name  LIKE '%".$searchText."%'
            OR  BaseTbl.contact_number  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['employee_name'])){
            $likeCriteria = "(BaseTbl.employee_name  LIKE '%".$filter['employee_name']."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['employee_id'])){
            $this->db->where('BaseTbl.employee_id', $filter['employee_id']);
        }
        if(!empty($filter['contact_number'])){
            $this->db->where('BaseTbl.contact_number', $filter['contact_number']);
        }
        if(!empty($filter['email'])){
            $this->db->where('BaseTbl.email', $filter['email']);
        }
        if(!empty($filter['role'])){
            $this->db->where('Role.role', $filter['role']);
        }
        $this->db->where('BaseTbl.company_id',$company_id);
        $this->db->where('BaseTbl.is_deleted', 0);
        $this->db->where('BaseTbl.role_id !=', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * This function is used to get the employee listing count
     */
    function employeeListing($searchText = '',$filter='',$company_id, $page, $segment)
    {
        $this->db->select('BaseTbl.row_id,BaseTbl.employee_id, BaseTbl.email, BaseTbl.employee_name, BaseTbl.contact_number, Role.role,BaseTbl.company_id');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.role_id = BaseTbl.role_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.employee_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.contact_number  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['employee_name'])){
            $likeCriteria = "(BaseTbl.employee_name  LIKE '%".$filter['employee_name']."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['employee_id'])){
            $this->db->where('BaseTbl.employee_id', $filter['employee_id']);
        }
        if(!empty($filter['contact_number'])){
            $this->db->where('BaseTbl.contact_number', $filter['contact_number']);
        }
        if(!empty($filter['email'])){
            $this->db->where('BaseTbl.email', $filter['email']);
        }
        if(!empty($filter['role'])){
            $this->db->where('Role.role', $filter['role']);
        }
        $this->db->where('BaseTbl.company_id',$company_id);
        $this->db->where('BaseTbl.is_deleted', 0);
        $this->db->where('BaseTbl.role_id !=', 1);
        $this->db->order_by('BaseTbl.row_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to get the employee roles information
     */
    function getUserRoles()
    {
        $this->db->select('role_id, role');
        $this->db->from('tbl_roles as role');
        $this->db->where('role.role_id !=', 1);
        $query = $this->db->get();
        return $query->result();
    }

   
    

     /**
     * This function is used to check whether  id is already exist or not
     */
    function checkEmployeeIDExists($employee_id, $row_id = 0)
    {
        $this->db->select("employee_id");
        $this->db->from("tbl_users");
        $this->db->where("employee_id", $employee_id);   
        $this->db->where("is_deleted", 0);
        if($row_id != 0){
            $this->db->where("row_id !=", $row_id);
        } 
        $query = $this->db->get();
        return $query->result();
    }

    
    /**
     * This function is used to add new employee to system
     */
    function addEmployee($employeeInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_users', $employeeInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
      /**
     * This function is used to update the employee information
     */
    function updateEmployee($employeeInfo, $row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_users', $employeeInfo);
        return TRUE;
    }

    /**
     * This function is used to delete the employee information
     */
    function deleteEmployee($employee_id, $employeeInfo)
    {
        $this->db->where('employee_id', $employee_id);
        $this->db->update('tbl_users', $employeeInfo);
        return $this->db->affected_rows();
    }

     /* get employee information by employee_id*/
     function getEmployeeInfoByEmpId($employee_id)
     {
     
         $this->db->select('BaseTbl.row_id,BaseTbl.employee_id, BaseTbl.email, BaseTbl.employee_name, BaseTbl.contact_number, BaseTbl.password, BaseTbl.gender, BaseTbl.dob,BaseTbl.alternative_contact_number, BaseTbl.employee_address, BaseTbl.role_id, BaseTbl.profile_image,Role.role');
         $this->db->from('tbl_users as BaseTbl'); 
         $this->db->join('tbl_roles as Role', 'Role.role_id = BaseTbl.role_id');
         $this->db->where('BaseTbl.employee_id', $employee_id);
         $this->db->where('BaseTbl.is_deleted', 0);
         $query = $this->db->get();
         return $query->row();
     }
    /**
     * This function is used to match employee password for change password
     */
    function matchOldPassword($employee_id, $oldPassword)
    {
        $this->db->select('employee_id, password');
        $this->db->where('employee_id', $employee_id);        
        $this->db->where('is_deleted', 0);
        $query = $this->db->get('tbl_users');
        $user = $query->result();
        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    
    /**
     * This function is used to change users password
     */
    function changePassword($employee_id, $userInfo)
    {
        $this->db->where('employee_id', $employee_id);
        $this->db->where('is_deleted', 0);
        $this->db->update('tbl_users', $userInfo);
        return $this->db->affected_rows();
    }

     /**
     * This function is used to get all employees based on company_id
     */
    function getemployeeInfo($company_id){
        $this->db->from('tbl_users as user');
        $this->db->join('tbl_roles as Role', 'Role.role_Id = user.role_Id');
        $this->db->where('user.role_Id !=', 1);
        $this->db->where('user.company_id', $company_id);
        $this->db->where('user.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    /**
     * This function used to get employee information by using  role
     */

    function getUserInfoByRole($role)
    {
        $this->db->select('employee.employee_id, employee.email, employee.employee_name');
        $this->db->from('tbl_users as employee');
        $this->db->where('employee.role_id', $role);
        $this->db->where('employee.role_id !=', 1);
        $this->db->where('employee.is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

     /**
     *   Employee Count
     */
    function totalEmployees($company_id)
    {
        $this->db->from('tbl_users as employee');
        $this->db->where('employee.role_id !=', 1);
        $this->db->where('employee.company_id', $company_id);
        $this->db->where('employee.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

   /* get employee information by employee_id for profile page*/
      function getEmployeeInfoById($employee_id)
      {
         $this->db->select('BaseTbl.row_id,BaseTbl.employee_id, BaseTbl.email, BaseTbl.employee_name, BaseTbl.contact_number, BaseTbl.password, BaseTbl.gender, BaseTbl.dob,BaseTbl.alternative_contact_number, BaseTbl.employee_address, BaseTbl.role_id, BaseTbl.profile_image,Role.role');
         $this->db->from('tbl_users as BaseTbl'); 
         $this->db->join('tbl_roles as Role', 'Role.role_id = BaseTbl.role_id');
         $this->db->where('BaseTbl.employee_id', $employee_id);
         $this->db->where('BaseTbl.is_deleted', 0);
         $query = $this->db->get();
         return $query->row();
      }
      function notification($company_id,$date)
      {
          $this->db->select('dp.row_id,dp.event_id,dp.tithi_id,dp.nakshathra_id,dp.masa_id,dp.rashi_id,dp.gothra_id,dp.date');
          $this->db->from('tbl_daily_details as dp');
          $this->db->where('dp.date', $date);
          $this->db->where('dp.company_id', $company_id);
          $this->db->where('dp.is_deleted', 0);
        //   $query = $this->db->get();
        //   $result = $query->result();
        //   return $result;
        $query = $this->db->get();
        return $query->row();
      }

      function notifications($company_id,$rashi,$date,$event,$tithi,$nakshathra,$masa,$gothra)
      {
          $this->db->select('dp.row_id,dp.devotee_id,devotee.devotee_name,dp.event_type,dp.date,dp.event_id,dp.tithi_id,dp.nakshathra_id,dp.masa_id,dp.rashi_id,dp.gothra_id');
          $this->db->from('tbl_dailypooja_management_info as dp');
          
         $this->db->join('tbl_devotee as devotee', 'devotee.row_id = dp.devotee_id');
        //   $this->db->where_in('dp.rashi_id',$rashi);
        //   $this->db->or_where_in('dp.date',$date);
          $this->db->or_where_in('dp.event_id',$event);
          $this->db->or_where_in('dp.tithi_id',$tithi);
          $this->db->or_where_in('dp.nakshathra_id',$nakshathra);
          $this->db->or_where_in('dp.masa_id',$masa);
          $this->db->or_where_in('dp.gothra_id',$gothra);
          $this->db->where_in('dp.company_id', $company_id);
          $this->db->where_in('dp.is_deleted', 0);
          $query = $this->db->get();
          $result = $query->result();
          return $result;        
      }


      function getYearlyPoojaInfo($company_id,$date)
      {
          $this->db->select('dp.row_id,dp.devotee_id,devotee.devotee_name,dp.event_type,dp.date,dp.event_id,dp.tithi_id,dp.nakshathra_id,dp.masa_id,dp.rashi_id,dp.gothra_id');
          $this->db->from('tbl_dailypooja_management_info as dp');
          
         $this->db->join('tbl_devotee as devotee', 'devotee.row_id = dp.devotee_id');
      
          $this->db->where('dp.date',$date);
          $this->db->where('dp.company_id', $company_id);
          $this->db->where('dp.is_deleted', 0);
          $this->db->where('dp.event_type', 'Date');
          $query = $this->db->get();
          $result = $query->result();
          return $result;        
      }

      function daypanchanga($company_id,$date)
      {
        $this->db->select('dp.row_id,events.events,paksha.paksha,dp.event_id,dp.tithi_id,dp.nakshathra_id,dp.masa_id,dp.rashi_id,dp.gothra_id,dp.date,tithi.tithi,nakshathra.nakshathra,masa.masa,rashi.rashi,gothra.gothra');
        $this->db->from('tbl_daily_details as dp');
        $this->db->join('tbl_events as events','events.row_id=dp.event_id','left');
        $this->db->join('tbl_tithi as tithi','tithi.row_id=dp.tithi_id','left');
        $this->db->join('tbl_nakshathra as nakshathra','nakshathra.row_id=dp.nakshathra_id','left');
        $this->db->join('tbl_masa as masa','masa.row_id=dp.masa_id','left');
        $this->db->join('tbl_rashi as rashi','rashi.row_id=dp.rashi_id','left');
        $this->db->join('tbl_gothra as gothra','gothra.row_id=dp.gothra_id','left');
        $this->db->join('tbl_paksha as paksha','paksha.row_id=dp.paksha_id','left');
          $this->db->where('dp.date', $date);
          $this->db->where('dp.company_id', $company_id);
          $this->db->where('dp.is_deleted', 0);
          $query = $this->db->get();
          $result = $query->result();
          return $result;
        // $query = $this->db->get();
        // return $query->row();
      }
      
}

  