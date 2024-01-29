<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
class CompanyProfile extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('employee_model');
        $this->load->model('company_profile_model');
        $this->isLoggedIn();   
    }
   
   /**
     * This function is used to add new Company Profile to the system
     */
    public function addCompanyProfile()
    {
        if ($this->isAdmin() == true) { 
            $this->loadThis();
        } else {
            $data['companyInfo'] = $this->company_profile_model->getcompanyInfo($this->company_id);
            $this->global['pageTitle'] = $this->company_name.' : Company Profile ';
            $this->loadViews("company_profile/companyProfile", $this->global,$data, null);
        }
    }
    
    /**
     * This function is used to add new Company Profile to the system
     */
    function addCompanyProfileToDb()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('company_name','Company Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('company_pan_number','Pan Number','trim|required');
            $this->form_validation->set_rules('founder_name','Founder Name','trim|required');
            $this->form_validation->set_rules('company_address','Address','trim|required');
            $this->form_validation->set_rules('company_contact_number_one','Company Contact Number','trim|required');
            $this->form_validation->set_rules('company_email','Company Email Address','trim|required');
            $this->form_validation->set_rules('total_employee','Total employee','trim|required');
            $this->form_validation->set_rules('company_website_url','Website Url','trim|required');
            if($this->form_validation->run() == FALSE) {
                $this->addCompanyProfile();
            } else {
                 $config=['upload_path' => './upload/',
                 'allowed_types' => 'gif|jpg|png|jpeg','max_size' => '102400','overwrite' => TRUE,];
                 $this->load->library('upload', $config);
                if($this->upload->do_upload()) {
                    $post=$this->input->post();
                    $data=$this->upload->data();
                    $company_logo=base_url("upload/".$data['new_name'].$data['file_ext']);
                    $post['company_logo']=$company_logo;
                    $company_logo=base_url("upload/".$data['raw_name'].$data['file_ext']);
                }
                $row_id =$this->input->post('row_id');
               function random_code($limit)
               {
                   return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
               }
                $row_id =$this->input->post('row_id');
                $six_digit = random_code(6);
                $company_id=strtoupper($six_digit);
                $company_name = ucwords(strtolower($this->security->xss_clean($this->input->post('company_name'))));
                $cgst = $this->security->xss_clean($this->input->post('cgst'));
                $sgst = $this->security->xss_clean($this->input->post('sgst'));
                $igst = $this->security->xss_clean($this->input->post('igst'));
                $utgst = $this->security->xss_clean($this->input->post('utgst'));
                $company_gst_number = $this->security->xss_clean($this->input->post('company_gst_number'));
                $company_contact_number_two = $this->security->xss_clean($this->input->post('company_contact_number_two'));
                $company_website_url = $this->security->xss_clean($this->input->post('company_website_url'));
                $company_pan_number = $this->security->xss_clean($this->input->post('company_pan_number'));
                $founder_name = $this->security->xss_clean($this->input->post('founder_name'));
                $company_address = $this->security->xss_clean($this->input->post('company_address'));
                $company_contact_number_one = $this->security->xss_clean($this->input->post('company_contact_number_one'));
                $company_email = strtolower($this->security->xss_clean($this->input->post('company_email')));
                $total_employee = $this->security->xss_clean($this->input->post('total_employee'));
                if($row_id == "") {
                if(!empty($company_logo)){
                $compnayInfo = array('company_id'=>$company_id,'company_name'=>$company_name,'cgst'=>$cgst,'sgst'=>$sgst,'igst'=>$igst,'utgst'=>$utgst,'company_pan_number'=>$company_pan_number,
                'founder_name'=>$founder_name,'company_logo'=>$company_logo,'company_address'=>$company_address,'company_contact_number_one'=>$company_contact_number_one, 'company_email'=>$company_email,'total_employee'=>$total_employee, 'company_gst_number'=>$company_gst_number,'company_website_url'=>$company_website_url,'company_contact_number_two'=>$company_contact_number_two,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                } else {
                    $compnayInfo = array('company_id'=>$company_id,'company_name'=>$company_name,'cgst'=>$cgst,'sgst'=>$sgst,'igst'=>$igst,'utgst'=>$utgst,'company_pan_number'=>$company_pan_number,
                'founder_name'=>$founder_name,'company_address'=>$company_address,'company_contact_number_one'=>$company_contact_number_one, 'company_email'=>$company_email,'total_employee'=>$total_employee,'company_gst_number'=>$company_gst_number,'company_website_url'=>$company_website_url,'company_contact_number_two'=>$company_contact_number_two,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                }
                $result = $this->company_profile_model->addCompanyProfileToDb($compnayInfo);
                if ($result > 0 ) {
                    $this->session->set_flashdata('success',  "Company Profile created successfully");
                } else {
                    $this->session->set_flashdata('error', "Company Profile Add failed");
                }
              } else{
                if(!empty($company_logo)){
                    $compnayInfo = array('company_name'=>$company_name,'cgst'=>$cgst,'sgst'=>$sgst,'igst'=>$igst,'utgst'=>$utgst,'company_pan_number'=>$company_pan_number,
                    'founder_name'=>$founder_name,'company_logo'=>$company_logo,'company_address'=>$company_address,'company_contact_number_one'=>$company_contact_number_one, 'company_email'=>$company_email,'total_employee'=>$total_employee, 'company_gst_number'=>$company_gst_number,'company_website_url'=>$company_website_url,'company_contact_number_two'=>$company_contact_number_two,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                    } else {
                        $compnayInfo = array('company_name'=>$company_name,'cgst'=>$cgst,'sgst'=>$sgst,'igst'=>$igst,'utgst'=>$utgst,'company_pan_number'=>$company_pan_number,
                    'founder_name'=>$founder_name,'company_address'=>$company_address,'company_contact_number_one'=>$company_contact_number_one, 'company_email'=>$company_email,'total_employee'=>$total_employee,'company_gst_number'=>$company_gst_number,'company_website_url'=>$company_website_url,'company_contact_number_two'=>$company_contact_number_two,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                    }
                $result = $this->company_profile_model->updateCompanyProfile($compnayInfo,$row_id);
                if($result == true) {
                    $this->session->set_flashdata('success', 'Company Profile  Updated Successfully');
                }
                else {
                    $this->session->set_flashdata('error', 'Company Profile Update failed');
                }

              }
                redirect('addCompanyProfile');
            }
        }
    }

    /**
     * This function is used to edit the Company profile information
     */
    function updateCompanyProfile()
    {
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('company_name','Company Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('company_pan_number','Pan Number','trim|required');
            $this->form_validation->set_rules('founder_name','Founder Name','trim|required');
            $this->form_validation->set_rules('company_address','Address','trim|required');
            $this->form_validation->set_rules('company_contact_number_one','Company Contact Number One','trim|required');
            $this->form_validation->set_rules('company_email','Company Email Address','trim|required');
            $this->form_validation->set_rules('total_employee','Total employee','trim|required');
            if($this->form_validation->run() == FALSE) {
                $this->addCompanyProfile();
            } else {
                 $config=['upload_path' => './upload/',
                 'allowed_types' => 'gif|jpg|png|jpeg','max_size' => '102400','max_width' => '5000','max_height' => '5000','overwrite' => TRUE,];
                 $this->load->library('upload', $config);
                if($this->upload->do_upload()) {
                    $post=$this->input->post();
                    $data=$this->upload->data();
                    $company_logo=base_url("upload/".$data['new_name'].$data['file_ext']);
                    $post['company_logo']=$company_logo;
                    $company_logo=base_url("upload/".$data['raw_name'].$data['file_ext']);
                }
                log_message('error','profiles image'. $company_logo);
                $row_id =$this->input->post('row_id');
                $company_name = ucwords(strtolower($this->security->xss_clean($this->input->post('company_name'))));
                $cgst = $this->security->xss_clean($this->input->post('cgst'));
                $sgst = $this->security->xss_clean($this->input->post('sgst'));
                $igst = $this->security->xss_clean($this->input->post('igst'));
                $utgst = $this->security->xss_clean($this->input->post('utgst'));
                $company_gst_number = $this->security->xss_clean($this->input->post('company_gst_number'));
                $company_contact_number_two = $this->security->xss_clean($this->input->post('company_contact_number_two'));
                $company_website_url = $this->security->xss_clean($this->input->post('company_website_url'));
                $company_pan_number = $this->security->xss_clean($this->input->post('company_pan_number'));
                $founder_name = $this->security->xss_clean($this->input->post('founder_name'));
                $company_address = $this->security->xss_clean($this->input->post('company_address'));
                $company_contact_number_one = $this->security->xss_clean($this->input->post('company_contact_number_one'));
                $company_email = strtolower($this->security->xss_clean($this->input->post('company_email')));
                $total_employee = $this->security->xss_clean($this->input->post('total_employee'));
                $compnayInfo = array();
                $this->global ['company_name'] = $company_name; 
                if(!empty($company_logo)){
                    $compnayInfo = array('company_name'=>$company_name,'cgst'=>$cgst,'sgst'=>$sgst,'igst'=>$igst,'utgst'=>$utgst,'company_pan_number'=>$company_pan_number,
                    'founder_name'=>$founder_name,'company_logo'=>$company_logo,'company_address'=>$company_address,'company_contact_number_one'=>$company_contact_number_one, 'company_email'=>$company_email,'total_employee'=>$total_employee, 'company_gst_number'=>$company_gst_number,'company_website_url'=>$company_website_url,'company_contact_number_two'=>$company_contact_number_two,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                    } else {
                        $compnayInfo = array('company_name'=>$company_name,'cgst'=>$cgst,'sgst'=>$sgst,'igst'=>$igst,'utgst'=>$utgst,'company_pan_number'=>$company_pan_number,
                    'founder_name'=>$founder_name,'company_address'=>$company_address,'company_contact_number_one'=>$company_contact_number_one, 'company_email'=>$company_email,'total_employee'=>$total_employee,'company_gst_number'=>$company_gst_number,'company_website_url'=>$company_website_url,'company_contact_number_two'=>$company_contact_number_two,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                    }
                $result = $this->company_profile_model->updateCompanyProfile($compnayInfo,$row_id);
                if($result == true) {
                    $this->session->set_flashdata('success', 'Company Profile  Updated Successfully');
                } else {
                    $this->session->set_flashdata('error', 'Company Profile Update failed');
                }
                redirect('addCompanyProfile');
            }
        }
    }


}

?>