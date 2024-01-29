<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Devotee extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('devotee_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the devotee
     */
    
    /**
     * This function is used to load the  devotee list
     */
    function devoteeListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      

            // $devotee_id = $this->security->xss_clean($this->input->post('devotee_id'));  
            $devotee_name = $this->security->xss_clean($this->input->post('devotee_name'));
            $contact_number = $this->security->xss_clean($this->input->post('contact_number'));
            $devotee_address = $this->security->xss_clean($this->input->post('devotee_address'));
            $post_status_f = $this->security->xss_clean($this->input->post('post_status_f'));
            // $data['devotee_id'] = $devotee_id;
            $data['devotee_name'] = $devotee_name;
            $data['contact_number'] = $contact_number;
            $data['devotee_address'] = $devotee_address;
            $data['post_status_f'] = $post_status_f;
            // $filter['devotee_id'] = $devotee_id;
            $filter['devotee_name'] = $devotee_name;
            $filter['contact_number'] = $contact_number;
            $filter['devotee_address'] = $devotee_address;
            $filter['post_status_f'] = $post_status_f;

            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->devotee_model->devoteeListingCount($searchText,$filter,$this->company_id);
            $data['count'] =  $count;
			$returns = $this->paginationCompress ( "devoteeListing/", $count, 100 );
            $data['devoteeRecords'] = $this->devotee_model->devoteeListing($searchText,$filter,$this->company_id, $returns["page"], $returns["segment"]);
            $data['allDevoteeInfo'] = $this->devotee_model->allDevoteeInfo($this->company_id);

            $data['committeeTypeInfo'] = $this->devotee_model->getCommitteeTypeInfo($this->company_id);  
            $this->global['pageTitle'] = $this->company_name.' :devotee Details ';
            $this->loadViews("devotee/devotee", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addDevoteePageView()
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $data="";        
            $this->global['pageTitle'] = $this->company_name.' : Add New devotee ';
            $this->loadViews("devotee/addNewDevotee", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to add new  devotee to the system
     */
    function addDevotee()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else {
            $this->load->library('form_validation');
            // $this->form_validation->set_rules('devotee_id','devotee ID','required');
            $this->form_validation->set_rules('devotee_name','Full Name','trim|required|max_length[128]');
            // $this->form_validation->set_rules('dob','Dob','required');
            $this->form_validation->set_rules('gender','Gender','required');
            $this->form_validation->set_rules('contact_number','Contact Number','required|min_length[10]');
            $this->form_validation->set_rules('devotee_address','Address','required');
            
            if($this->form_validation->run() == FALSE)
            {
                redirect('devoteeListing');
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
                // $devotee_id = $this->security->xss_clean($this->input->post('devotee_id'));
                $devotee_name = ucwords(strtolower($this->security->xss_clean($this->input->post('devotee_name'))));
                $dob = $this->input->post('dob');
                $gender = $this->input->post('gender');
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $contact_number = $this->input->post('contact_number');
                $alternative_contact_number = $this->input->post('alternative_contact_number');
                $post_status = $this->input->post('post_status');
                // 'languages_known' => $this->input->post('hidden_languages_known'),
                $devotee_address = $this->security->xss_clean($this->input->post('devotee_address'));
                if(!empty($profile_image)){
                    $devoteeInfo = array('devotee_name'=>$devotee_name,'dob'=>date('Y-m-d',strtotime($dob)),'gender'=>$gender,'email'=>$email,
                    'contact_number'=>$contact_number,'alternative_contact_number'=>$alternative_contact_number,'profile_image'=>$profile_image,
                    'email'=>$email,'post_status'=>$post_status,'devotee_address'=>$devotee_address, 'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                    } else {
                        $devoteeInfo = array('devotee_name'=>$devotee_name,'dob'=>date('Y-m-d',strtotime($dob)),'gender'=>$gender,'email'=>$email,
                        'contact_number'=>$contact_number,'alternative_contact_number'=>$alternative_contact_number,
                        'email'=>$email,'post_status'=>$post_status,'devotee_address'=>$devotee_address, 'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                    }
                $return = $this->devotee_model->addDevotee($devoteeInfo);
                log_message('debug','dateofbirth'.print_r($devoteeInfo,true));
                $devotee_id = 'SRM'.sprintf('%05d',$return);
                $devoteeId = array('devotee_id'=>$devotee_id);
                $result = $this->devotee_model->updateDevotee($devoteeId,$return);


                // for($i=0; $i< count($type_id); $i++){
                //     log_message('debug','$my_Id='.$resulttype);
                //     $devoteeTypeInfo= array('devotee_id'=>$resulttype,
                //     'committee_id'=>$type_id[$i],
                // );
                // $result=$this->devotee_model->addDevoteeInfo($devoteeTypeInfo);
                // }
                if($result > 0){
                    $this->session->set_flashdata('success', 'New devotee created successfully');
                } else {
                    $this->session->set_flashdata('error', 'devotee creation failed');
                }
                redirect('devoteeListing');
            }
        }
    }

    /**
     * This function is used load devotee edit form
     */
    function editDevoteePageView($row_id = NULL)
    {
        if($this->isAdmin() == TRUE || $row_id == 1) {
            $this->loadThis();
        } else {
            if($row_id == null){
                redirect('devoteeListing');
            }
            $data['devoteeInfo'] = $this->devotee_model->getDevoteeInfoByEmpId($row_id);
            $data['committeeTypeInfo'] =$this->devotee_model->getCommitteeTypeInfo($this->company_id);  

            $this->global['pageTitle'] = $this->company_name.' : Edit devotee ';
            $this->loadViews("devotee/editDevotee", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the devotee information
     */
    function updateDevotee()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {
            // $devotee_id = $this->input->post('devotee_id');
            $this->load->library('form_validation');
            $row_id = $this->input->post('row_id');
            // $this->form_validation->set_rules('devotee_id','devotee ID','required');
            $this->form_validation->set_rules('devotee_name','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('dob','Dob','required');
            $this->form_validation->set_rules('gender','Gender','required');
            // $this->form_validation->set_rules('email','Email','trim|valid_email|max_length[128]');
            $this->form_validation->set_rules('contact_number','Contact Number','required|min_length[10]');
            $this->form_validation->set_rules('devotee_address','Address','required');
            if($this->form_validation->run() == FALSE) {
                $this->editDevoteePageView($row_id);
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
                $devotee_name = ucwords(strtolower($this->security->xss_clean($this->input->post('devotee_name'))));
                $dob = $this->input->post('dob');
                $gender = $this->input->post('gender');
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $contact_number = $this->input->post('contact_number');
                $alternative_contact_number = $this->input->post('alternative_contact_number');
                $post_status = $this->input->post('post_status');
 
                // $devotee_id = $this->security->xss_clean($this->input->post('devote_id'));


                $devotee_address = $this->security->xss_clean($this->input->post('devotee_address'));
                $devoteeInfo = array();
                 if(!empty($profile_image)){
                    $devoteeInfo = array('devotee_name'=>$devotee_name,'dob'=>date('Y-m-d',strtotime($dob)),'gender'=>$gender,'email'=>$email,
                    'contact_number'=>$contact_number,'alternative_contact_number'=>$alternative_contact_number,'profile_image'=>$profile_image,
                    'email'=>$email,'post_status'=>$post_status,'devotee_address'=>$devotee_address, 'company_id'=>$this->company_id,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                    }else {
                        $devoteeInfo = array('devotee_name'=>$devotee_name,'dob'=>date('Y-m-d',strtotime($dob)),'gender'=>$gender,'email'=>$email,
                        'contact_number'=>$contact_number,'alternative_contact_number'=>$alternative_contact_number,
                        'email'=>$email,'post_status'=>$post_status,'devotee_address'=>$devotee_address, 'company_id'=>$this->company_id,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                    }
                $result = $this->devotee_model->updateDevotee($devoteeInfo,$row_id);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New devotee updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'devotee update failed');
                }
                redirect('editDevoteePageView/'.$row_id);
            }
        }
    }


    /**
     * This function is used to check whether devotee id already exist or not
     */
    // public function checkDevoteeIDExists()
    // {
    //     $devotee_id = $this->input->post("devotee_id");
    //     $row_id = $this->input->post("row_id");
    //     if (empty($row_id)) {
    //         $result = $this->devotee_model->checkDevoteeIDExists($devotee_id);
    //     } else {
    //         $result = $this->devotee_model->checkDevoteeIDExists($devotee_id, $row_id);
    //     }
    //     if (empty($result)) {echo ("true");} else {echo ("false");}
    // }
  
  /**
     * This function is used to delete the devotee using devotee_id
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteDevotee()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $devotee_id = $this->input->post('devotee_id');
            $devoteeInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->devotee_model->deleteDevotee($devotee_id,$devoteeInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }

    
    
}


?>