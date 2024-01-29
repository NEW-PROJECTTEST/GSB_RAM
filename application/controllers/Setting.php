<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Setting extends BaseController {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('setting_model','settings');
        $this->isLoggedIn();
    }
    public function viewSettings() {
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {  
            $data['commiteeInfo'] = $this->settings->getAllComiteeInfo($this->company_id);
            $data['assetInfo'] = $this->settings->getAllAssetInfo($this->company_id);
            $data['relationshipInfo'] = $this->settings->getAllRelationshipInfo($this->company_id);
            $data['yearInfo'] = $this->settings->getAllYearInfo($this->company_id);
            $data['subscriptionInfo'] = $this->settings->getAllSubscriptionInfo($this->company_id);
            $data['incomeTypeInfo'] = $this->settings->getIncomeType($this->company_id);
            $data['gothraInfo'] = $this->settings->getAllGothraInfo($this->company_id);
            $data['nakshathraInfo'] = $this->settings->getAllNakshathraInfo($this->company_id);
            $data['masaInfo'] = $this->settings->getAllMasaInfo($this->company_id);
            $data['tithiInfo'] = $this->settings->getAllTithiInfo($this->company_id);
            $data['rashiInfo'] = $this->settings->getAllRashiInfo($this->company_id);
            $data['committetypeInfo'] = $this->settings->getAllCommittetypeInfo($this->company_id);
            $data['EventtypeInfo'] = $this->settings->getAllEventtypeInfo($this->company_id);
            $data['occationInfo'] = $this->settings->getAllOccationInfo($this->company_id);
            $data['pakshaInfo'] = $this->settings->getAllPakshaInfo($this->company_id);
            $data['expenseNameInfo'] = $this->settings->getAllExpenseNameInfo($this->company_id);
            $data['purposeInfo'] = $this->settings->getAllPurposeInfo($this->company_id);
            $data['donationTypeInfo'] = $this->settings->getAllDonationTypeInfo($this->company_id);

            $this->global['pageTitle'] = $this->company_name.' : Settings';
            $this->loadViews("settings/settingsDashboard", $this->global, $data,null);  
        }
    }

    public function addRelationInfo() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $relation =$this->security->xss_clean($this->input->post('relation'));
           
                $relationInfo = array('company_id'=>$this->company_id,'relation_name'=>$relation);
                $result = $this->settings->addRelation($relationInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Relation created successfully');
                } else{
                    $this->session->set_flashdata('error', 'Relation creation failed');
                }
            redirect('settings');
        }
    }

   
    public function addCommitteeRole() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $committee =$this->security->xss_clean($this->input->post('committee'));
            $committeeRole = array('role'=>$committee,'company_id'=>$this->company_id);
            $result = $this->settings->addCommitteeRole($committeeRole);
            if($result > 0){
                $this->session->set_flashdata('success', 'New Committee Role created successfully');
            } else{
                $this->session->set_flashdata('error', 'Commitee Role creation failed');
            }
            redirect('settings');
        }
        
    }

     
    public function addAsset() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $asset =$this->security->xss_clean($this->input->post('asset'));
            $assetInfo = array('asset_type'=>$asset,'company_id'=>$this->company_id);
            $result = $this->settings->addAsset($assetInfo);
            if($result > 0){
                $this->session->set_flashdata('success', 'New Asset created successfully');
            } else{
                $this->session->set_flashdata('error', 'Asset creation failed');
            }
            redirect('settings');
        }
    }

    public function addyear() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $year =$this->security->xss_clean($this->input->post('year'));
            $yearInfo = array('year'=>$year,'company_id'=>$this->company_id);
            $result = $this->settings->addYear($yearInfo);
            if($result > 0){
                $this->session->set_flashdata('success', 'New Year created successfully');
            } else{
                $this->session->set_flashdata('error', 'Year creation failed');
            }
            redirect('settings');
        }
    }

    public function addSubscriptionAmount() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $subscription =$this->security->xss_clean($this->input->post('subscription'));
            $subscriptionInfo = array('amount'=>$subscription,'company_id'=>$this->company_id);
            $result = $this->settings->addSubscriptionAmount($subscriptionInfo);
            if($result > 0){
                $this->session->set_flashdata('success', 'New Subscription created successfully');
            } else{
                $this->session->set_flashdata('error', 'Subscription creation failed');
            }
            redirect('settings');
        }
    }

    public function addIncomeType() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $type =$this->security->xss_clean($this->input->post('income_type'));
           
                $incomeInfo = array('company_id'=>$this->company_id,'income_type'=>$type);
                $result = $this->settings->addIncomeType($incomeInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Income Type created successfully');
                } else{
                    $this->session->set_flashdata('error', 'Income Type creation failed');
                }
            redirect('settings');
        }
    }

    public function addGothra() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $gothra =$this->security->xss_clean($this->input->post('gothra'));
            $gothraRole = array('gothra'=>$gothra,'company_id'=>$this->company_id);
            $result = $this->settings->addGothra($gothraRole);
            if($result > 0){
                $this->session->set_flashdata('success', 'New Gothra Added successfully');
            } else{
                $this->session->set_flashdata('error', 'Failed');
            }
            redirect('settings');
        }
        
    }

    public function addNakshathra() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $nakshathra =$this->security->xss_clean($this->input->post('nakshathra'));
           
                $nakshathraRole = array('company_id'=>$this->company_id,'nakshathra'=>$nakshathra);
                $result = $this->settings->addNakshathra($nakshathraRole);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Nakshathra Added successfully');
                } else{
                    $this->session->set_flashdata('error', 'Failed');
                }
            redirect('settings');
        }
    }

     
    public function addMasa() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $masa =$this->security->xss_clean($this->input->post('masa'));
            $masaRole = array('masa'=>$masa,'company_id'=>$this->company_id);
            $result = $this->settings->addMasa($masaRole);
            if($result > 0){
                $this->session->set_flashdata('success', 'New Masa Added successfully');
            } else{
                $this->session->set_flashdata('error', 'Failed');
            }
            redirect('settings');
        }
    }

    public function addTithi() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $tithi =$this->security->xss_clean($this->input->post('tithi'));
            $tithiRole = array('tithi'=>$tithi,'company_id'=>$this->company_id);
            $result = $this->settings->addTithi($tithiRole);
            if($result > 0){
                $this->session->set_flashdata('success', 'New Tithi Added successfully');
            } else{
                $this->session->set_flashdata('error', 'Failed');
            }
            redirect('settings');
        }
    }

    public function addRashi() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $rashi =$this->security->xss_clean($this->input->post('rashi'));
            $rashiRole = array('rashi'=>$rashi,'company_id'=>$this->company_id);
            $result = $this->settings->addRashi($rashiRole);
            if($result > 0){
                $this->session->set_flashdata('success', 'New Rashi Added successfully');
            } else{
                $this->session->set_flashdata('error', 'Failed');
            }
            redirect('settings');
        }
    }
    
    public function addCommittetype() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $committetype =$this->security->xss_clean($this->input->post('committetype'));
            $year =$this->security->xss_clean($this->input->post('year'));
            $committetypeRole = array('type'=>$committetype,'year' =>$year,'company_id'=>$this->company_id);
            $result = $this->settings->addCommittetype($committetypeRole);
            if($result > 0){
                $this->session->set_flashdata('success', 'New committetype Added successfully');
            } else{
                $this->session->set_flashdata('error', 'Failed');
            }
            redirect('settings');
        }
    }

    public function addEvents() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $events =$this->security->xss_clean($this->input->post('events'));
            $eventtypeRole = array('events'=>$events,'company_id'=>$this->company_id);
            $result = $this->settings->addEventtype($eventtypeRole);
            if($result > 0){
                $this->session->set_flashdata('success', 'New Event Added successfully');
            } else{
                $this->session->set_flashdata('error', 'Failed');
            }
            redirect('settings');
        }
    }

    public function deleteRole(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $committeeRoleInfo = array('is_deleted' => 1);
            $result = $this->settings->updateRole($committeeRoleInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }

    public function deleteRelation(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $relationInfo = array('is_deleted' => 1);
            $result = $this->settings->updateRelation($relationInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }

    public function deleteAsset(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $assetInfo = array('is_deleted' => 1);
            $result = $this->settings->updateAsset($assetInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }

    public function deleteYearInfo(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $yearInfo = array('is_deleted' => 1);
            $result = $this->settings->updateYear($yearInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }


    public function deleteSubscriptionInfo(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $subscriptionInfo = array('is_deleted' => 1);
            $result = $this->settings->updateSubscription($subscriptionInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }

    public function deleteIncomeType(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $typeInfo = array('is_deleted' => 1);
            $result = $this->settings->updateIncomeType($typeInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }

    public function deleteGothra(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $gothraRoleInfo = array('is_deleted' => 1);
            $result = $this->settings->updateGothra($gothraRoleInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }

    public function deleteNakshathra(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $nakshathraRoleInfo = array('is_deleted' => 1);
            $result = $this->settings->updateNakshathra($nakshathraRoleInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }

    public function deleteMasa(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $masaRoleInfo = array('is_deleted' => 1);
            $result = $this->settings->updateMasa($masaRoleInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }

    public function deleteTithi(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $tithiRoleInfo = array('is_deleted' => 1);
            $result = $this->settings->updateTithi($tithiRoleInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }


    public function deleteRashi(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $rashiRoleInfo = array('is_deleted' => 1);
            $result = $this->settings->updateRashi($rashiRoleInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }
    
    public function deleteCommittetype(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $committetypeRoleInfo = array('is_deleted' => 1);
            $result = $this->settings->updateCommittetype($committetypeRoleInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }

    public function deleteEventtype(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $eventtypeRoleInfo = array('is_deleted' => 1);
            $result = $this->settings->updateEventtype($eventtypeRoleInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }

    public function addOccation() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $occation =$this->security->xss_clean($this->input->post('occation'));
            $occationRole = array('occation'=>$occation,'company_id'=>$this->company_id);
            $result = $this->settings->addOccation($occationRole);
            if($result > 0){
                $this->session->set_flashdata('success', 'New Occation Added successfully');
            } else{
                $this->session->set_flashdata('error', 'Failed');
            }
            redirect('settings');
        }
    }


    public function deleteOccation(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $occationInfo = array('is_deleted' => 1);
            $result = $this->settings->updateOccation($occationInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }

    public function deletePaksha(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $pakshaInfo = array('is_deleted' => 1);
            $result = $this->settings->updatepaksha($pakshaInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }

    

    public function addPaksha() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $paksha =$this->security->xss_clean($this->input->post('paksha'));
            $pakshaRole = array('paksha'=>$paksha,'company_id'=>$this->company_id);
            $result = $this->settings->addPaksha($pakshaRole);
            if($result > 0){
                $this->session->set_flashdata('success', 'New Paksha Added successfully');
            } else{
                $this->session->set_flashdata('error', 'Failed');
            }
            redirect('settings');
        }
    }


    public function addExpenseName() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $expense_name =$this->security->xss_clean($this->input->post('expense_name'));
            $expenseInfo = array('expense_name'=>$expense_name,'company_id'=>$this->company_id);
            $result = $this->settings->addExpenseName($expenseInfo);
            if($result > 0){
                $this->session->set_flashdata('success', 'New Expense Name Added successfully');
            } else{
                $this->session->set_flashdata('error', 'Failed');
            }
            redirect('settings');
        }
    }


    public function deleteExpenseName(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $expenseInfo = array('is_deleted' => 1);
            $result = $this->settings->updateExpenseName($expenseInfo, $row_id);
            if ($result == true) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        } 
    }



    public function addPurpose() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $purpose_name =$this->security->xss_clean($this->input->post('purpose_name'));
            $purposeInfo = array('purpose_name'=>$purpose_name,'company_id'=>$this->company_id);
            $result = $this->settings->addPurpose($purposeInfo);
            if($result > 0){
                $this->session->set_flashdata('success', 'New Purpose Added Successfully');
            } else{
                $this->session->set_flashdata('error', 'Failed');
            }
            redirect('settings');
        }
    }



    public function updateNakshathra(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $nakshathra = $this->input->post('nakshatra_update');
            $nakshatraInfo = array('nakshathra' => $nakshathra);
            $result = $this->settings->updateNakshatraName($nakshatraInfo, $row_id);
            if($result > 0){
                $this->session->set_flashdata('success', 'Nakshatra Updated Successfully');
            } else{
                $this->session->set_flashdata('error', 'Failed');
            }
            redirect('settings');       
         } 
    }


    
    public function updateGothra(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $gothra = $this->input->post('gothra_update');
            $gothraInfo = array('gothra' => $gothra);
            $result = $this->settings->updateGothra($gothraInfo, $row_id);
            if($result > 0){
                $this->session->set_flashdata('success', 'Gothra Updated Successfully');
            } else{
                $this->session->set_flashdata('error', 'Failed');
            }
            redirect('settings');       
         } 
    }


    public function updateMasa(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $masa = $this->input->post('masa_update');
            $masaInfo = array('masa' => $masa);
            $result = $this->settings->updateMasa($masaInfo, $row_id);
            if($result > 0){
                $this->session->set_flashdata('success', 'Masa Updated Successfully');
            } else{
                $this->session->set_flashdata('error', 'Failed');
            }
            redirect('settings');       
         } 
    }


    public function updateRashi(){
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {   
            $row_id = $this->input->post('row_id');
            $rashi = $this->input->post('rashi_update');
            $rashiInfo = array('rashi' => $rashi);
            $result = $this->settings->updateRashi($rashiInfo, $row_id);
            if($result > 0){
                $this->session->set_flashdata('success', 'Rashi Updated Successfully');
            } else{
                $this->session->set_flashdata('error', 'Failed');
            }
            redirect('settings');
         } 
    }


    public function addDonationType() {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $donation_name =$this->security->xss_clean($this->input->post('donation_name'));
            $donationInfo = array('donation_type'=>$donation_name,'company_id'=>$this->company_id);
            $result = $this->settings->addDonationType($donationInfo);
            if($result > 0){
                $this->session->set_flashdata('success', 'New Donation Type Added Successfully');
            } else{
                $this->session->set_flashdata('error', 'Failed');
            }
            redirect('settings');
        }
    }


}