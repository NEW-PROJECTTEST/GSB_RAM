<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
    }
    
    /**
     * This function used to check the user is logged in or not
     */
    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->load->view('users/login');
        } else {
            redirect('/dashboard');
        }
    }
    
    
    /**
     * This function used to logged in user
     */
    public function loginMe()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Email', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }else {
            $username = strtolower($this->security->xss_clean($this->input->post('username')));
            $password = $this->input->post('password');
            $result = $this->login_model->loginMe($username, $password);
            if(!empty($result))
            {
                $lastLogin = $this->login_model->lastLoginInfo($result->employee_id);
                $sessionArray = array('employee_id'=>$result->employee_id, 
                                        'role'=>$result->role_id,
                                        'roleText'=>$result->role,
                                        'employee_name'=>$result->employee_name,
                                        'contact_number'=>$result->contact_number,
                                        'lastLogin'=> $lastLogin->createdDtm,
                                         'company_id'=>$result->company_id,
                                         'company_logo'=>$result->company_logo,
                                         'profile_image'=>$result->profile_image,
                                         'company_name'=>$result->company_name,
                                         'isLoggedIn' => TRUE
                                );
                $this->session->set_userdata($sessionArray);
                unset($sessionArray['employee_id'], $sessionArray['isLoggedIn'], $sessionArray['lastLogin']);

                $loginInfo = array("employee_id"=>$result->employee_id, "sessionData" => json_encode($sessionArray), "machineIp"=>$_SERVER['REMOTE_ADDR'], "userAgent"=>getBrowserAgent(), "agentString"=>$this->agent->agent_string(), "platform"=>$this->agent->platform());
                $this->login_model->lastLogin($loginInfo);
                redirect('/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Email or password mismatch');
                $this->index();
            }
       }
    }

    /**
     * This function used to load forgot password view
     */
    public function forgotPassword()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->load->view('users/forgotPassword');
        } else {
            redirect('/dashboard');
        }
    }
    
    /**
     * This function used to generate reset password request link
     */
    function resetPasswordUser()
    {
        // $status = '';
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email','Email Id','trim|required|valid_email');   
        if($this->form_validation->run() == FALSE)
        {
            $this->forgotPassword();
        } else  {
            $email = strtolower($this->security->xss_clean($this->input->post('login_email')));
            log_message('error','email:'.$email);
            if($this->login_model->checkEmailExist($email))
            {
                $encoded_email = urlencode($email);
                
                $this->load->helper('string');
                $data['email'] = $email;
                $data['activation_id'] = random_string('alnum',15);
                $data['createdDtm'] = date('Y-m-d H:i:s');
                $data['agent'] = getBrowserAgent();
                $data['client_ip'] = $this->input->ip_address();
                
                $save = $this->login_model->resetPasswordUser($data);                
                
                if($save)
                {
                    $data1['reset_link'] = base_url() . "resetPasswordConfirmUser/" . $data['activation_id'] . "/" . $encoded_email;
                    $studentInfo = $this->login_model->getCustomerInfoByEmail($email);

                    if(!empty($userInfo)){
                        $data1["name"] = $studentInfo->name;
                        $data1["email"] = $studentInfo->email;
                        $data1["message"] = "Reset Your Password";
                    }

                    $sendStatus = resetPasswordEmail($data1);

                    if($sendStatus){
                        $status = "send";
                        setFlashData($status, "Reset password link sent successfully, please check mails.");
                    } else {
                        $status = "notsend";
                        setFlashData($status, "Email has been failed, try again.");
                    }
                }
                else
                {
                    $status = 'unable';
                    setFlashData($status, "It seems an error while sending your details, try again.");
                }
            }
            else
            {
                $status = 'invalid';
                setFlashData($status, "This email is not registered with us.");
            }
            redirect('users/forgotPassword');
        }
    }

    /**
     * This function used to reset the password 
     * @param string $activation_id : This is unique id
     * @param string $email : This is user email
     */
    function resetPasswordConfirmUser($activation_id, $email)
    {
        // Get email and activation code from URL values at index 3-4
        $email = urldecode($email);
        
        // Check activation id in database
        $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);
        
        $data['email'] = $email;
        $data['activation_code'] = $activation_id;
        
        if ($is_correct == 1)
        {
            $this->load->view('newPassword', $data);
        }
        else
        {
            redirect('users/login');
        }
    }
    
    /**
     * This function used to create new password for user
     */
    function createPasswordUser()
    {
        $status = '';
        $message = '';
        $email = strtolower($this->input->post("email"));
        $activation_id = $this->input->post("activation_code");
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->resetPasswordConfirmUser($activation_id, urlencode($email));
        }
        else
        {
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');
            
            // Check activation id in database
            $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);
            
            if($is_correct == 1)
            {                
                $this->login_model->createPasswordUser($email, $password);
                
                $status = 'success';
                $message = 'Password reset successfully';
            } else
            {
                $status = 'error';
                $message = 'Password reset failed';
            }
            
            setFlashData($status, $message);

            redirect("users/login");
        }
    }

    /**
     * This function used to generate feedback request link
     */
    function feedback($row_id)
    {
                $encoded_call_log_id = urlencode($row_id);
                $this->load->helper('string');
                $feedBackInfo = $this->feedback_model->checkLinkOpenStatus($row_id);
                if(!empty($feedBackInfo))
                {
                    $data['call_log_id'] = $row_id;
                    $data['activation_id'] = $feedBackInfo->activation_id;
                    $data['createdDtm'] = $feedBackInfo->createdDtm;
                    $data['agent'] =  $feedBackInfo->agent;
                    $data['client_ip'] = $feedBackInfo->client_ip;
                    $save = $this->feedback_model->updateFeedBackLink($data,$feedBackInfo->call_log_id);
                } else {
                    $data['call_log_id'] = $row_id;
                    $data['activation_id'] = random_string('alnum',15);
                    $data['createdDtm'] = date('Y-m-d H:i:s');
                    $data['agent'] = getBrowserAgent();
                    $data['client_ip'] = $this->input->ip_address();
                    $save = $this->feedback_model->feedBackLink($data);   
                }
                            
                if($save)
                {
                      $data1['reset_link'] = base_url() . "userFeedbackConfirm/" . $data['activation_id'] . "/" . $encoded_call_log_id;
                      $data['callLogInfo'] = $this->call_log_model->getCallLogInfoById($row_id);
                      log_message('debug','link'.$data1['reset_link']);
                    $sendStatus = resetPasswordEmail($data1);
                    if(true){
                        $status = "send";
                        setFlashData($status, "Feedback link sent successfully");
                    } else {
                        $status = "notsend";
                        setFlashData($status, "Feedback has been failed, try again.");
                    }
                }
                else {
                    $status = 'unable';
                    setFlashData($status, "It seems an error while sending, try again.");
                }
            redirect('callLogListing');
      
        }
}

?>