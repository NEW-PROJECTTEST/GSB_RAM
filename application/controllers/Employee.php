<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Employee extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('lease_vehicle_model');
        // $this->load->model('cash_ledger_model');
        // $this->load->model('transport_model');
        $this->load->model('employee_model');
        $this->load->model('devotee_model');
        $this->load->model('committee_model');
        $this->load->model('bank_model');
        $this->load->model('asset_model');
        $this->load->model('party_model');
        $this->load->model('DailyPooja_model');
        $this->load->model('setting_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the employee
     */
    public function index()
    {
        $dateInfo = date('Y-m-d');
        $data['totalEmployee'] = $this->employee_model->totalEmployees($this->company_id);
        // $data['totalLeaseVehicle'] = $this->lease_vehicle_model->totalLeaseVehicle($this->company_id);
        // $data['totalOwnVehicleSELF'] = $this->own_vehicle_model->totalOwnVehicleSELF($this->company_id);
        // $data['totalOwnVehicleOTHER'] = $this->own_vehicle_model->totalOwnVehicleOTHER($this->company_id);
        $data['totalBank'] = $this->bank_model->totalBank($this->company_id);
        $data['totalCommittee'] = $this->committee_model->totalCommittee($this->company_id);
        // $data['totalFuelAmount'] = $this->own_vehicle_model->getFuelAmountInfo($this->company_id);
        // $data['totalFuel'] = $this->own_vehicle_model->getFuelInfo($this->company_id);
        // $data['todayCashLedger'] = $this->cash_ledger_model->getTodayCashLedger();
        // $data['todayTransportedVehicle'] = $this->transport_model->getTodayTransportedVehicle();
        $data['totalDevotees'] = $this->devotee_model->totalDevotees($this->company_id);
        $data['totalAsset'] = $this->asset_model->totalAssets($this->company_id);
        $data['totalParty'] = $this->party_model->totalParty($this->company_id);
        $data['notificationMsg'] = $this->employee_model->notification($this->company_id,$dateInfo);
        $data['eventInfo'] =$this->DailyPooja_model->getEventInfo($this->company_id); 
        $data['tithiInfo'] =$this->DailyPooja_model->getTithiInfo($this->company_id); 
        $data['nakshathraInfo'] =$this->DailyPooja_model->getNakshathraInfo($this->company_id);
        $data['masaInfo'] =$this->DailyPooja_model->getMasaInfo($this->company_id);  
        $data['rashiInfo'] =$this->DailyPooja_model->getRashiInfo($this->company_id); 
        $data['gothraInfo'] =$this->DailyPooja_model->getGothraInfo($this->company_id); 
        $data['daypanchanga'] = $this->employee_model->daypanchanga($this->company_id,$dateInfo);
        $data['pakshaInfo'] = $this->setting_model->getAllPakshaInfo($this->company_id);

        // $poojadetails = $data['notificationMsg'];
        // log_message('debug',"sample=".print_r($poojadetails,true));
        
        
         if(!empty($data['notificationMsg'])){
         $data['notificationMessage'] = $this->employee_model->notifications($this->company_id,$data['notificationMsg']->rashi_id,$data['notificationMsg']->date,$data['notificationMsg']->event_id,$data['notificationMsg']->tithi_id,$data['notificationMsg']->nakshathra_id,$data['notificationMsg']->masa_id,$data['notificationMsg']->gothra_id);

        }
        $today_date = date('d-m');

        $data['yearlyPoojaInfo'] = $this->employee_model->getYearlyPoojaInfo($this->company_id,$today_date);

        
        
        // if(!empty($data['notificationMsg'])){
        //     for($i=0; $i< count($poojadetails); $i++){
        //     $data['notificationMessage'] = $this->employee_model->notifications($this->company_id,$poojadetails[$i]->rashi_id,$poojadetails[$i]->date,$poojadetails[$i]->event_id,$poojadetails[$i]->tithi_id,$poojadetails[$i]->nakshathra_id,$poojadetails[$i]->masa_id,$poojadetails[$i]->gothra_id);
        //     log_message('debug',"sample1=".print_r($data['notificationMessage'],true));

        //     // $dailydetail = array(
        //     //     'company_id'=>$this->company_id,
        //     //     'rashi_id'=>$poojadetails[$i]->rashi_id,   
        //     //     'date'=>$poojadetails[$i]->date, 
        //     //     'event_id'=>$poojadetails[$i]->event_id,
        //     //     'tithi_id'=>$poojadetails[$i]->tithi_id,
        //     //     'nakshathra_id'=>$poojadetails[$i]->nakshathra_id,
        //     //     'masa_id'=>$poojadetails[$i]->masa_id,
        //     //     'gothra_id'=>$poojadetails[$i]->gothra_id);
        //     //     $data['notificationMessage'] = $this->employee_model->notifications($dailydetail);
        //         // $result = $this->family_model->updateFamilyHead($familyHeadInfo,$family_member[$i]);
           

        // }

        // }

        $insurance ='insurance';
        $road_tax ='road_tax';
        $fc ='fc';
        $ka ='ka';
        $na ='na';
        $emission ='emission';
        // $this->global['notificationMsg'] = $this->employee_model->notification($this->company_id,$dateInfo);

        // $this->global['insuranceNotification'] = $this->own_vehicle_model->getVehicleNotification($this->company_id,$insurance);
        // $this->global['roadTaxNotification'] = $this->own_vehicle_model->getVehicleNotification($this->company_id,$road_tax);
        // $this->global['fcNotification'] = $this->own_vehicle_model->getVehicleNotification($this->company_id,$fc);
        // $this->global['karnatakaPermitNotification'] = $this->own_vehicle_model->getVehicleNotification($this->company_id,$ka);
        // $this->global['nationalPermitNotification'] = $this->own_vehicle_model->getVehicleNotification($this->company_id,$na);
        // $this->global['emissionNotification'] = $this->own_vehicle_model->getVehicleNotification($this->company_id,$emission);
        $this->global['pageTitle'] = $this->company_name.' : Dashboard ';
        $this->loadViews("dashboard", $this->global, $data , NULL);
    }
    
    /**
     * This function is used to load the  employee list
     */
    function employeeListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      
            $employee_id = $this->security->xss_clean($this->input->post('employee_id'));  
            $employee_name = $this->security->xss_clean($this->input->post('employee_name'));
            $contact_number = $this->security->xss_clean($this->input->post('contact_number'));
            $role = $this->security->xss_clean($this->input->post('role'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $data['employee_id'] = $employee_id;
            $data['employee_name'] = $employee_name;
            $data['contact_number'] = $contact_number;
            $data['role'] = $role;
            $data['email'] = $email;
            $filter['employee_id'] = $employee_id;
            $filter['employee_name'] = $employee_name;
            $filter['contact_number'] = $contact_number;
            $filter['role'] = $role;
            $filter['email'] = $email;
           
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->employee_model->employeeListingCount($searchText,$filter,$this->company_id);
            $data['count'] =  $count;
			$returns = $this->paginationCompress ( "employeeListing/", $count, 100 );
            $data['employeeRecords'] = $this->employee_model->employeeListing($searchText,$filter,$this->company_id, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = $this->company_name.' :Employee Details ';
            $this->loadViews("employee/employee", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addEmployeePageView()
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $data['roles'] = $this->employee_model->getUserRoles();
            $this->global['pageTitle'] = $this->company_name.' : Add New Employee ';
            $this->loadViews("employee/addNewEmployee", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to add new  employee to the system
     */
    function addEmployee()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('employee_id','Employee ID','required');
            $this->form_validation->set_rules('employee_name','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('dob','Dob','required');
            $this->form_validation->set_rules('gender','Gender','required');
            $this->form_validation->set_rules('contact_number','Contact Number','required|min_length[10]');
            $this->form_validation->set_rules('role_id','Role','required');
            $this->form_validation->set_rules('employee_address','Address','required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addEmployeePageView();
            } else {
                $config=['upload_path' => './upload/',
                'allowed_types' => 'gif|jpg|png|jpeg','max_size' => '102400','max_width' => '5000','max_height' => '5000','overwrite' => TRUE,];
                $this->load->library('upload', $config);
               if($this->upload->do_upload()) {
                   $post=$this->input->post();
                   $data=$this->upload->data();
                   $profile_image=base_url("upload/".$data['new_name'].$data['file_ext']);
                   $post['profile_image']=$profile_image;
                   $profile_image=base_url("upload/".$data['raw_name'].$data['file_ext']);
               }
                $employee_id = $this->security->xss_clean($this->input->post('employee_id'));
                $employee_name = ucwords(strtolower($this->security->xss_clean($this->input->post('employee_name'))));
                $dob = $this->input->post('dob');
                $gender = $this->input->post('gender');
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $contact_number = $this->input->post('contact_number');
                $alternative_contact_number = $this->input->post('alternative_contact_number');
                $password ='karavali@123';
                $role_id = $this->input->post('role_id');
                $employee_address = $this->security->xss_clean($this->input->post('employee_address'));
                if(!empty($profile_image)){
                    $employeeInfo = array('employee_id'=>$employee_id,'employee_name'=>$employee_name,'dob'=>date('y-m-d',strtotime($dob)),'gender'=>$gender,'email'=>$email,
                    'contact_number'=>$contact_number,'alternative_contact_number'=>$alternative_contact_number,'password'=>getHashedPassword($password), 'profile_image'=>$profile_image,
                    'role_id'=>$role_id,'email'=>$email,'employee_address'=>$employee_address, 'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                    } else {
                        $employeeInfo = array('employee_id'=>$employee_id,'employee_name'=>$employee_name,'dob'=>date('y-m-d',strtotime($dob)),'gender'=>$gender,'email'=>$email,
                        'contact_number'=>$contact_number,'alternative_contact_number'=>$alternative_contact_number,'password'=>getHashedPassword($password),
                        'role_id'=>$role_id,'email'=>$email,'employee_address'=>$employee_address, 'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                    }
                $result = $this->employee_model->addEmployee($employeeInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Employee created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Employee creation failed');
                }
                redirect('addEmployeePageView');
            }
        }
    }

    /**
     * This function is used load employee edit form
     */
    function editEmployeePageView($employee_id = NULL)
    {
        if($this->isAdmin() == TRUE || $employee_id == 1) {
            $this->loadThis();
        } else {
            if($employee_id == null){
                redirect('employeeListing');
            }
            $data['roles'] = $this->employee_model->getUserRoles();
            $data['employeeInfo'] = $this->employee_model->getEmployeeInfoByEmpId($employee_id);
            $this->global['pageTitle'] = $this->company_name.' : Edit Employee ';
            $this->loadViews("employee/editEmployee", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the employee information
     */
    function updateEmployee()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {
            $employee_id = $this->input->post('employee_id');
            $this->load->library('form_validation');
            $row_id = $this->input->post('row_id');
            $this->form_validation->set_rules('employee_id','Employee ID','required');
            $this->form_validation->set_rules('employee_name','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('dob','Dob','required');
            $this->form_validation->set_rules('gender','Gender','required');
            $this->form_validation->set_rules('email','Email','trim|valid_email|max_length[128]');
            $this->form_validation->set_rules('contact_number','Contact Number','required|min_length[10]');
            $this->form_validation->set_rules('role_id','Role','required');
            $this->form_validation->set_rules('employee_address','Address','required');
            if($this->form_validation->run() == FALSE) {
                $this->editEmployeePageView($employee_id);
            } else {
                $config=['upload_path' => './upload/',
                'allowed_types' => 'gif|jpg|png|jpeg','max_size' => '102400','max_width' => '5000','max_height' => '5000','overwrite' => TRUE,];
                $this->load->library('upload', $config);
               if($this->upload->do_upload()) {
                   $post=$this->input->post();
                   $data=$this->upload->data();
                   $profile_image=base_url("upload/".$data['new_name'].$data['file_ext']);
                   $post['profile_image']=$profile_image;
                   $profile_image=base_url("upload/".$data['raw_name'].$data['file_ext']);
               }
                $employee_name = ucwords(strtolower($this->security->xss_clean($this->input->post('employee_name'))));
                $dob = $this->input->post('dob');
                $gender = $this->input->post('gender');
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $contact_number = $this->input->post('contact_number');
                $alternative_contact_number = $this->input->post('alternative_contact_number');
                $password = $this->input->post('password');
                $role_id = $this->input->post('role_id');
              
                $employee_address = $this->security->xss_clean($this->input->post('employee_address'));
                $employeeInfo = array();
                 if(!empty($profile_image) && !empty($password) ){
                    $employeeInfo = array('employee_id'=>$employee_id,'employee_name'=>$employee_name,'dob'=>date('y-m-d',strtotime($dob)),'gender'=>$gender,'email'=>$email,
                    'contact_number'=>$contact_number,'alternative_contact_number'=>$alternative_contact_number,'profile_image'=>$profile_image,'password'=>getHashedPassword($password),
                    'role_id'=>$role_id,'email'=>$email,'employee_address'=>$employee_address, 'company_id'=>$this->company_id,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                    } else if(!empty($password) ){
                        $employeeInfo = array('employee_id'=>$employee_id,'employee_name'=>$employee_name,'dob'=>date('y-m-d',strtotime($dob)),'gender'=>$gender,'email'=>$email,
                        'contact_number'=>$contact_number,'alternative_contact_number'=>$alternative_contact_number,'password'=>getHashedPassword($password),
                        'role_id'=>$role_id,'email'=>$email,'employee_address'=>$employee_address, 'company_id'=>$this->company_id,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));  
                    } else if(!empty($profile_image) ){
                        $employeeInfo = array('employee_id'=>$employee_id,'employee_name'=>$employee_name,'dob'=>date('y-m-d',strtotime($dob)),'gender'=>$gender,'email'=>$email,
                        'contact_number'=>$contact_number,'alternative_contact_number'=>$alternative_contact_number,'profile_image'=>$profile_image,
                        'role_id'=>$role_id,'email'=>$email,'employee_address'=>$employee_address, 'company_id'=>$this->company_id,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                    } else {
                        $employeeInfo = array('employee_id'=>$employee_id,'employee_name'=>$employee_name,'dob'=>date('y-m-d',strtotime($dob)),'gender'=>$gender,'email'=>$email,
                        'contact_number'=>$contact_number,'alternative_contact_number'=>$alternative_contact_number,
                        'role_id'=>$role_id,'email'=>$email,'employee_address'=>$employee_address, 'company_id'=>$this->company_id,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                    }
                $result = $this->employee_model->updateEmployee($employeeInfo,$row_id);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Employee updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Employee update failed');
                }
                redirect('editEmployeePageView/'.$employee_id);
            }
        }
    }


    /**
     * This function is used to check whether employee id already exist or not
     */
    public function checkEmployeeIDExists()
    {
        $employee_id = $this->input->post("employee_id");
        $row_id = $this->input->post("row_id");
        if (empty($row_id)) {
            $result = $this->employee_model->checkEmployeeIDExists($employee_id);
        } else {
            $result = $this->employee_model->checkEmployeeIDExists($employee_id, $row_id);
        }
        if (empty($result)) {echo ("true");} else {echo ("false");}
    }
  
  /**
     * This function is used to delete the employee using employee_id
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteEmployee()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $employee_id = $this->input->post('employee_id');
            $employeeInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->employee_model->deleteEmployee($employee_id,$employeeInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }

    /**
     * This function is used to show users profile
     */
    public function profile($active = "details")
    {
        $data['employeeInfo'] = $this->employee_model->getEmployeeInfoById($this->employee_id);
        $data["active"] = $active;
        $this->global['pageTitle'] = $active == "details" ? $this->company_name.' : My Profile' : $this->company_name.' : Change Password';
        $this->loadViews("employee/viewProfile", $this->global, $data, null);
    }
    
    /**
     * This function is used to change the password of the employee
    
     */
    function changePassword($active = "changepass"){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('password','New password','required');
        $this->form_validation->set_rules('cpassword','Confirm new password','required|matches[password]');
        
        if($this->form_validation->run() == FALSE) {
            $this->profile($active);
        }else {
            $oldPassword = $this->input->post('oldPassword');
            $password = $this->input->post('password');
            $resultPas = $this->employee_model->matchOldPassword($this->employee_id, $oldPassword);
            if(empty($resultPas)) {
                $this->session->set_flashdata('nomatch', 'Your old password is not correct');
                redirect('profile/'.$active);
            } else{
                $usersData = array('password'=>getHashedPassword($password), 'updated_by'=>$this->employee_id,
                                'updated_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->employee_model->changePassword($this->employee_id, $usersData);
                if($result > 0) { 
                    $this->session->set_flashdata('success', 'Password updation successful'); 
                }else { 
                    $this->session->set_flashdata('error', 'Password updation failed'); 
                }
                redirect('profile/'.$active);
            }
        }
    }
}


?>