<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class OwnVehicle extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('own_vehicle_model');
        $this->load->model('lease_vehicle_model');
        $this->load->model('fuel_model');
        $this->load->library('excel');
        $this->isLoggedIn();   
    }
  
    function OwnVehicleListing()
    {
        redirect('OwnSelfVehicleListing');
    }
    /**
     * This function is used to load the OwnVehicle list
     */
    // function OwnVehicleListing()
    // {
    //     if($this->isAdmin() == TRUE)
    //     {
    //         $this->loadThis();
    //     } else {      
    //         $vehicle_number = $this->security->xss_clean($this->input->post('vehicle_number'));  
    //         $vehicle_condition = $this->security->xss_clean($this->input->post('vehicle_condition'));
    //         $insurance_date = $this->security->xss_clean($this->input->post('insurance_date'));
    //         $karnataka_permit_date = $this->security->xss_clean($this->input->post('karnataka_permit_date'));
    //         $last_service_date = $this->security->xss_clean($this->input->post('last_service_date'));
    //         $vehicle_type = $this->security->xss_clean($this->input->post('vehicle_type'));
    //         $data['vehicle_number'] = $vehicle_number;
    //         $data['vehicle_type'] = $vehicle_type;
    //         $filter['vehicle_number'] = $vehicle_number;
    //         $filter['vehicle_type'] = $vehicle_type;
    //         $data['getAllPumpInfo'] = $this->fuel_model->getAllPumpInfo($this->company_id);

    //         if(!empty($insurance_date)){
    //             $data['insurance_date'] = date('d-m-Y',strtotime($insurance_date));
    //             $filter['insurance_date'] = date('Y-m-d',strtotime($insurance_date));
    //         } else{
    //             $data['insurance_date'] = $insurance_date;
    //             $filter['insurance_date'] = $insurance_date;
    //         }

    //         if(!empty($karnataka_permit_date)){
    //             $data['karnataka_permit_date'] = date('d-m-Y',strtotime($karnataka_permit_date));
    //             $filter['karnataka_permit_date'] = date('Y-m-d',strtotime($karnataka_permit_date));
    //         } else{
    //             $data['karnataka_permit_date'] = $karnataka_permit_date;
    //             $filter['karnataka_permit_date'] = $karnataka_permit_date;
    //         }

    //         if(!empty($last_service_date)){
    //             $data['last_service_date'] = date('d-m-Y',strtotime($last_service_date));
    //             $filter['last_service_date'] = date('Y-m-d',strtotime($last_service_date));
    //         } else{
    //             $data['last_service_date'] = $last_service_date;
    //             $filter['last_service_date'] = $last_service_date;
    //         }
    //         $data['ownVehicles'] = $this->own_vehicle_model->getAllOwnVehicle($this->company_id);
    //         $data['fuelDetails'] = $this->own_vehicle_model->getFuelDetailsForTripAdd($this->company_id);
           
    //         $searchText = $this->security->xss_clean($this->input->post('searchText'));
    //         $data['searchText'] = $searchText;
    //         $this->load->library('pagination');
    //         $count = $this->own_vehicle_model->OwnVehicleListingCount($searchText,$filter,$this->company_id);
    //         $data['count'] =  $count;
	// 		$returns = $this->paginationCompress ("OwnVehicleListing/", $count, 100 );
    //         $data['OwnVehicleRecords'] = $this->own_vehicle_model->OwnVehicleListing($searchText,$filter,$this->company_id, $returns["page"], $returns["segment"]);
    //         $this->global['pageTitle'] = $this->company_name.' :Own Vehicle Details ';
    //         $this->loadViews("own_vehicle/ownVehicle", $this->global, $data, NULL);
    //     }
    // }
    function OwnOtherVehicleListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      
            $vehicle_number = $this->security->xss_clean($this->input->post('vehicle_number'));  
            $vehicle_condition = $this->security->xss_clean($this->input->post('vehicle_condition'));
            $insurance_date = $this->security->xss_clean($this->input->post('insurance_date'));
            $karnataka_permit_date = $this->security->xss_clean($this->input->post('karnataka_permit_date'));
            $last_service_date = $this->security->xss_clean($this->input->post('last_service_date'));
            // $vehicle_type = $this->security->xss_clean($this->input->post('vehicle_type'));
            $vehicle_type = 'OTHER';
            $data['vehicle_number'] = $vehicle_number;
            $data['vehicle_type'] = $vehicle_type;
            $filter['vehicle_number'] = $vehicle_number;
            $filter['vehicle_type'] = $vehicle_type;
            $data['getAllPumpInfo'] = $this->fuel_model->getAllPumpInfo($this->company_id);

            if(!empty($insurance_date)){
                $data['insurance_date'] = date('d-m-Y',strtotime($insurance_date));
                $filter['insurance_date'] = date('Y-m-d',strtotime($insurance_date));
            } else{
                $data['insurance_date'] = $insurance_date;
                $filter['insurance_date'] = $insurance_date;
            }

            if(!empty($karnataka_permit_date)){
                $data['karnataka_permit_date'] = date('d-m-Y',strtotime($karnataka_permit_date));
                $filter['karnataka_permit_date'] = date('Y-m-d',strtotime($karnataka_permit_date));
            } else{
                $data['karnataka_permit_date'] = $karnataka_permit_date;
                $filter['karnataka_permit_date'] = $karnataka_permit_date;
            }

            if(!empty($last_service_date)){
                $data['last_service_date'] = date('d-m-Y',strtotime($last_service_date));
                $filter['last_service_date'] = date('Y-m-d',strtotime($last_service_date));
            } else{
                $data['last_service_date'] = $last_service_date;
                $filter['last_service_date'] = $last_service_date;
            }
            $data['ownVehicles'] = $this->own_vehicle_model->getAllOwnVehicle($this->company_id);
            $data['fuelDetails'] = $this->own_vehicle_model->getFuelDetailsForTripAdd($this->company_id);
           
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->own_vehicle_model->OwnVehicleListingCount($searchText,$filter,$this->company_id);
            $data['count'] =  $count;
			$returns = $this->paginationCompress ("OwnOtherVehicleListing/", $count, 100 );
            $data['OwnVehicleRecords'] = $this->own_vehicle_model->OwnVehicleListing($searchText,$filter,$this->company_id, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = $this->company_name.' :Own Other Vehicle Details ';
            $this->loadViews("own_vehicle/ownVehicle", $this->global, $data, NULL);
        }
    }
    function OwnSelfVehicleListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      
            $vehicle_number = $this->security->xss_clean($this->input->post('vehicle_number'));  
            $vehicle_condition = $this->security->xss_clean($this->input->post('vehicle_condition'));
            $insurance_date = $this->security->xss_clean($this->input->post('insurance_date'));
            $karnataka_permit_date = $this->security->xss_clean($this->input->post('karnataka_permit_date'));
            $last_service_date = $this->security->xss_clean($this->input->post('last_service_date'));
            // $vehicle_type = $this->security->xss_clean($this->input->post('vehicle_type'));
            $vehicle_type = 'SELF';
            $data['vehicle_number'] = $vehicle_number;
            $data['vehicle_type'] = $vehicle_type;
            $filter['vehicle_number'] = $vehicle_number;
            $filter['vehicle_type'] = $vehicle_type;
            $data['getAllPumpInfo'] = $this->fuel_model->getAllPumpInfo($this->company_id);

            if(!empty($insurance_date)){
                $data['insurance_date'] = date('d-m-Y',strtotime($insurance_date));
                $filter['insurance_date'] = date('Y-m-d',strtotime($insurance_date));
            } else{
                $data['insurance_date'] = $insurance_date;
                $filter['insurance_date'] = $insurance_date;
            }

            if(!empty($karnataka_permit_date)){
                $data['karnataka_permit_date'] = date('d-m-Y',strtotime($karnataka_permit_date));
                $filter['karnataka_permit_date'] = date('Y-m-d',strtotime($karnataka_permit_date));
            } else{
                $data['karnataka_permit_date'] = $karnataka_permit_date;
                $filter['karnataka_permit_date'] = $karnataka_permit_date;
            }

            if(!empty($last_service_date)){
                $data['last_service_date'] = date('d-m-Y',strtotime($last_service_date));
                $filter['last_service_date'] = date('Y-m-d',strtotime($last_service_date));
            } else{
                $data['last_service_date'] = $last_service_date;
                $filter['last_service_date'] = $last_service_date;
            }
            $data['ownVehicles'] = $this->own_vehicle_model->getAllOwnVehicle($this->company_id);
            $data['fuelDetails'] = $this->own_vehicle_model->getFuelDetailsForTripAdd($this->company_id);
           
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->own_vehicle_model->OwnVehicleListingCount($searchText,$filter,$this->company_id);
            $data['count'] =  $count;
			$returns = $this->paginationCompress ("OwnSelfVehicleListing/", $count, 100 );
            $data['OwnVehicleRecords'] = $this->own_vehicle_model->OwnVehicleListing($searchText,$filter,$this->company_id, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = $this->company_name.' :Own Self Vehicle Details ';
            $this->loadViews("own_vehicle/ownVehicle", $this->global, $data, NULL);
        }
    }

    
    /**
     * This function is used to load the add new form
     */
    function addOwnVehiclePageView()
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = $this->company_name.' : Add  Own Vehicle ';
            $this->loadViews("own_vehicle/addOwnVehicle", $this->global, NULL, NULL);
        }
    }

    /**
     * This function is used to add new OwnVehicle to the system
     */
    function addOwnVehicle()
    {
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('vehicle_number','Vehicle Number','trim|required');
            // $this->form_validation->set_rules('fc_date','FC Date','required');
            // $this->form_validation->set_rules('road_tax_date','Road tax Date','required');
            // $this->form_validation->set_rules('insurance_date','Insurance Date','required');
            // $this->form_validation->set_rules('karnataka_permit_date','karnataka permit Date','required');
            // $this->form_validation->set_rules('national_permit_date','National permit Date','required');
            // $this->form_validation->set_rules('emission_date','Emission  Date','required');
            if($this->form_validation->run() == FALSE) {
                $this->addOwnVehiclePageView();
            } else {
                $vehicle_number = $this->input->post('vehicle_number');
                $fc_date = $this->input->post('fc_date');
                if(empty($fc_date)){
                    $fc_date = "NULL";
                } else{
                    $fc_date = date('Y-m-d',strtotime($fc_date));
                }
                $road_tax_date = $this->input->post('road_tax_date');
                if(empty($road_tax_date)){
                    $road_tax_date = "NULL";
                } else{
                    $road_tax_date = date('Y-m-d',strtotime($road_tax_date));
                }
                $insurance_date = $this->input->post('insurance_date');
                if(empty($insurance_date)){
                    $insurance_date = "NULL";
                } else{
                    $insurance_date = date('Y-m-d',strtotime($insurance_date));
                }
                $karnataka_permit_date = $this->input->post('karnataka_permit_date');
                if(empty($karnataka_permit_date)){
                    $karnataka_permit_date = "NULL";
                } else{
                    $karnataka_permit_date = date('Y-m-d',strtotime($karnataka_permit_date));
                }
                $national_permit_date = $this->input->post('national_permit_date');
                if(empty($national_permit_date)){
                    $national_permit_date = "NULL";
                } else{
                    $national_permit_date = date('Y-m-d',strtotime($national_permit_date));
                }
                $emission_date = $this->input->post('emission_date');
                if(empty($emission_date)){
                    $emission_date = "NULL";
                } else{
                    $emission_date = date('Y-m-d',strtotime($emission_date));
                }
                $last_service_date = $this->input->post('last_service_date');
                if(empty($last_service_date)){
                    $last_service_date = "NULL";
                } else{
                    $last_service_date = date('Y-m-d',strtotime($last_service_date));
                }
                $vehicle_condition = $this->input->post('vehicle_condition');
                $vehicle_type = $this->input->post('vehicle_type');
                $ownVehicleInfo = array('vehicle_type'=>$vehicle_type,'vehicle_number'=>$vehicle_number,'road_tax_date'=>$road_tax_date,'fc_date'=>$fc_date,'insurance_date'=>$insurance_date,'karnataka_permit_date'=>$karnataka_permit_date,'national_permit_date'=>$national_permit_date,'emission_date'=>$emission_date,'last_service_date'=>$last_service_date,
                'vehicle_condition'=>$vehicle_condition, 'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->own_vehicle_model->addOwnVehicle($ownVehicleInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Own Vehicle created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Own Vehicle creation failed');
                }
                redirect('addOwnVehiclePageView');
            }
        }
    }

    /**
     * This function is used load OwnVehicle edit information
     */
    function editOwnVehiclePageView($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            if($row_id == null){
                redirect('OwnVehicleListing');
            }
          
            $data['ownVehicleInfo'] = $this->own_vehicle_model->getOwnVehicleInfoById($row_id);
            $data['wheelRecord'] = $this->own_vehicle_model->getAllWheelInfo($this->company_id,$data['ownVehicleInfo']->vehicle_number);
            $this->global['pageTitle'] = $this->company_name.' : Edit Own Vehicle ';
            $this->loadViews("own_vehicle/editOwnVehicle", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to edit the OwnVehicle information
     */
    function updateOwnVehicle()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else { 
            $row_id = $this->input->post('row_id');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('vehicle_number','Vehicle Number','trim|required');
            // $this->form_validation->set_rules('fc_date','FC Date','required');
            // $this->form_validation->set_rules('road_tax_date','Road tax Date','required');
            // $this->form_validation->set_rules('insurance_date','Insurance Date','required');
            // $this->form_validation->set_rules('karnataka_permit_date','karnataka permit Date','required');
            // $this->form_validation->set_rules('national_permit_date','National permit Date','required');
            // $this->form_validation->set_rules('emission_date','Emission  Date','required');
            if($this->form_validation->run() == FALSE)
            {
                $this->editOwnVehiclePageView($row_id);
            }else {
                $vehicle_number = $this->input->post('vehicle_number');
                $fc_date = $this->input->post('fc_date');
                if(empty($fc_date)){
                    $fc_date = "NULL";
                } else{
                    $fc_date = date('Y-m-d',strtotime($fc_date));
                }
                $road_tax_date = $this->input->post('road_tax_date');
                if(empty($road_tax_date)){
                    $road_tax_date = "NULL";
                } else{
                    $road_tax_date = date('Y-m-d',strtotime($road_tax_date));
                }
                $insurance_date = $this->input->post('insurance_date');
                if(empty($insurance_date)){
                    $insurance_date = "NULL";
                } else{
                    $insurance_date = date('Y-m-d',strtotime($insurance_date));
                }
                $karnataka_permit_date = $this->input->post('karnataka_permit_date');
                if(empty($karnataka_permit_date)){
                    $karnataka_permit_date = "NULL";
                } else{
                    $karnataka_permit_date = date('Y-m-d',strtotime($karnataka_permit_date));
                }
                $national_permit_date = $this->input->post('national_permit_date');
                if(empty($national_permit_date)){
                    $national_permit_date = "NULL";
                } else{
                    $national_permit_date = date('Y-m-d',strtotime($national_permit_date));
                }
                $emission_date = $this->input->post('emission_date');
                if(empty($emission_date)){
                    $emission_date = "NULL";
                } else{
                    $emission_date = date('Y-m-d',strtotime($emission_date));
                }
                $last_service_date = $this->input->post('last_service_date');
                if(empty($last_service_date)){
                    $last_service_date = "NULL";
                } else{
                    $last_service_date = date('Y-m-d',strtotime($last_service_date));
                }
                $vehicle_condition = $this->input->post('vehicle_condition');
                $vehicle_type = $this->input->post('vehicle_type');
                $ownVehicleInfo = array('vehicle_type'=>$vehicle_type,'vehicle_number'=>$vehicle_number,'road_tax_date'=>$road_tax_date,'fc_date'=>$fc_date,'insurance_date'=>$insurance_date,'karnataka_permit_date'=>$karnataka_permit_date,'national_permit_date'=>$national_permit_date,'emission_date'=>$emission_date,'last_service_date'=>$last_service_date,
                'vehicle_condition'=>$vehicle_condition, 'company_id'=>$this->company_id,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->own_vehicle_model->updateOwnVehicle($ownVehicleInfo,$row_id);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Own Vehicle updated successfully');
                }
                else{
                    $this->session->set_flashdata('error', 'Own Vehicle update failed');
                }
                redirect('editOwnVehiclePageView/'.$row_id);
            }
        }
    }

/**
     * This function is used to delete the OwnVehicle using row_id
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteOwnVehicle()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $ownVehicleInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->own_vehicle_model->deleteOwnVehicle($row_id,$ownVehicleInfo);
            $fuelInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result2 = $this->own_vehicle_model->deleteOwnVehicleFuel($row_id,$fuelInfo);
            $tripInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result3 = $this->own_vehicle_model->deleteOwnVehicleTrip($row_id,$tripInfo);
            $wheelInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result4 = $this->own_vehicle_model->deleteOwnVehicleWheel($row_id,$wheelInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }

    /**
     * This function is used to delete the Fuel using row_id
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteFuel()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            
            $fuelInfoOld = $this->own_vehicle_model->getOwnVichFuelInfoById($row_id);
            $fuelAccountInfo = $this->fuel_model->getFuelAccountInfoById($fuelInfoOld->fuel_account_row_id);
            $new_account_balance = $fuelAccountInfo->account_balance - $fuelInfoOld->fuel_amount;
            $newFuelAccountInfo = array(
                'account_balance'=>$new_account_balance,
                'created_by'=>$this->employee_id, 
                'created_date_time'=>date('Y-m-d H:i:s'));
            $this->fuel_model->updateFuelAccount($newFuelAccountInfo,$fuelInfoOld->fuel_account_row_id);
            
            $expensesInfo = array(
                'is_deleted'=>1,
                'created_by'=>$this->employee_id, 
                'created_date_time'=>date('Y-m-d H:i:s'));
            $this->fuel_model->updateFuelExpensesOwnVich($expensesInfo,$row_id);
            $fuelInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->own_vehicle_model->deleteFuel($row_id,$fuelInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }

    /**
     * This function is used to delete the Service using row_id
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteTrip()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $tripInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->own_vehicle_model->deleteTrip($row_id,$tripInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }

      /**
     * This function is used to delete the Service using row_id
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteWheel()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $wheelInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->own_vehicle_model->deleteWheel($row_id,$wheelInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }
    /**
     * View OwnVehicle details based on row_id
     *
     */
    public function viewOwnVehicle($row_id = null)
    {
        if ($this->isAdmin() == true ) {
            $this->loadThis();
        } else {
            if ($row_id == null) {
                redirect('OwnVehicleListing');
            }
            $data['ownVehicleInfo'] = $this->own_vehicle_model->getOwnVehicleInfoById($row_id);
            $data['fuelRecord'] = $this->own_vehicle_model->fuelListing($this->company_id,$data['ownVehicleInfo']->vehicle_number);
            $data['tripRecord'] = $this->own_vehicle_model->tripListing($this->company_id,$data['ownVehicleInfo']->vehicle_number);
            $data['wheelRecord'] = $this->own_vehicle_model->getAllWheelInfo($this->company_id,$data['ownVehicleInfo']->vehicle_number);
            $this->global['pageTitle'] = $this->company_name.': View Own Vehicle';
            $this->loadViews("own_vehicle/viewOwnVehicle", $this->global, $data, null);
        }
    } 

  /**
     * This function is used to add Fuel to own vehicle 
     */
    function addFuel()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {
                $vehicle_number = $this->input->post('vehicle_number');
                $ownVehicleRow_Id = $this->input->post('ownVehicleRow_Id');
                $fuel_date = $this->input->post('fuel_date');
                $fuel_amount = $this->input->post('fuel_amount');
                $liter = $this->input->post('liter');
                $fuel_type = $this->input->post('fuel_type');
                $fuel_account_row_id = $this->input->post('diesel_pump');
                $fuelInfo = array('vehicle_number'=>$vehicle_number,
                'fuel_type' => $fuel_type,
                'ownVehicleRow_Id'=>$ownVehicleRow_Id,'fuel_date'=>date('y-m-d',strtotime($fuel_date)),
                'fuel_amount'=>$fuel_amount,'fuel_account_row_id'=>$fuel_account_row_id,'liter'=>$liter,
                'vehicle_type'=>'Own','company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->own_vehicle_model->addFuel($fuelInfo);
                if($result > 0){
                    $fuelAccountInfo = $this->fuel_model->getFuelAccountInfoById($fuel_account_row_id);
                    if($fuelAccountInfo->account_balance < 0){
                        $new_account_balance = $fuelAccountInfo->account_balance - $fuel_amount;
                    }else{
                        $new_account_balance = $fuelAccountInfo->account_balance + $fuel_amount;
                    }
                    
                    $newFuelAccountInfo = array(
                        'account_balance'=>$new_account_balance,
                        'created_by'=>$this->employee_id, 
                        'created_date_time'=>date('Y-m-d H:i:s'));
                     $this->fuel_model->updateFuelAccount($newFuelAccountInfo,$fuel_account_row_id);
                     $fuelExpensesInfo = array(
                        'debit'=>$fuel_amount,
                        'fuel_account_row_id'=>$fuel_account_row_id,
                        'cash_date'=>date('Y-m-d',strtotime($fuel_date)),
                        'transaction_type'=>'Cash', 
                        'company_id'=>$this->company_id,
                        'vehicle_no' => $vehicle_number,
                        'vehicle_type' => 'Own',
                        'fuel_info_row_id' =>$result,
                        'created_by'=>$this->employee_id, 
                        'created_date_time'=>date('Y-m-d H:i:s')
                    );
                    $this->fuel_model->addFuelExpenses($fuelExpensesInfo);
                    $this->session->set_flashdata('success', 'Fuel Details Added successfully');
                } else{
                    $this->session->set_flashdata('error', 'Fuel Details Add failed');
                }
                redirect('OwnVehicleListing');    
          }
    }

   /**
     * This function is used to add service to own vehicle 
     */
    function addTrip()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else
            {
                $vehicle_number = $this->input->post('vehicle_number');
                $own_vehicle_rowid = $this->input->post('own_vehicle_rowid');
                $fuel_rowid = $this->input->post('fuel_rowid');
                $service_date = $this->input->post('service_date');
                $place = $this->input->post('place');
                $total_trip = $this->input->post('total_trip');
                $trip_amount = $this->input->post('trip_amount');
                $comments = $this->input->post('comments');
                $tripInfo = array('vehicle_number'=>$vehicle_number,'own_vehicle_rowid'=>$own_vehicle_rowid,'fuel_rowid'=>$fuel_rowid,'service_date'=>date('y-m-d',strtotime($service_date)),'comments'=>$comments,
                'place'=>$place,'total_trip'=>$total_trip,'trip_amount'=>$trip_amount, 'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->own_vehicle_model->addTrip($tripInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'Service Details Added successfully');
                } else{
                    $this->session->set_flashdata('error', 'Service Details Add failed');
                }
                redirect('OwnVehicleListing');    
          }
    }
      /**
     * This function is used to add Fuel to own vehicle 
     */
    function addWheelInfo()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else
            {
                $own_vehicle_rowid = $this->input->post('own_vehicle_rowid');
                $vehicle_number = $this->input->post('wheel_vehicle_number');
                $wheel_number = $this->input->post('wheel_number');
                $wheel_type = $this->input->post('wheel_type');
                $wheel_position = $this->input->post('wheel_position');
                $comments = $this->input->post('comments');
                $wheelInfo = array('vehicle_number'=>$vehicle_number,'own_vehicle_rowid'=>$own_vehicle_rowid,'wheel_number'=>$wheel_number,'wheel_type'=>$wheel_type,'wheel_position'=>$wheel_position,'comments'=>$comments,
                 'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->own_vehicle_model->addWheelInfo($wheelInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'Wheel Details Added successfully');
                } else{
                    $this->session->set_flashdata('error', 'Wheel Details Add failed');
                }
                redirect('editOwnVehiclePageView/'.$own_vehicle_rowid);
          }
    }

 
 // Own Vehicle  Report
 function downloadOwnVehicleReport(){
    //print page setup
 $this->excel->setActiveSheetIndex(0);
 $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToPage(true);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);    
 $vehicle_number = $this->input->post('vehicle_number');
 $vehicleInfo = $this->own_vehicle_model->getOwnVehicleReport($vehicle_number);
 $styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
 $this->excel->setActiveSheetIndex(0);
 //name the worksheet
 $this->excel->getActiveSheet()->setTitle('Karavali worksheet');
 //set Title content with some text
 $headerStyle = array(
     'font'  => array(
         'bold' => true,
         'color' => array('rgb' => '17202A'),
         'size'  => 20,
         'name' => 'Verdana'
     ));
     $OutlineStyle = array(
         'borders' => array(
           'outline' => array(
             'style' => PHPExcel_Style_Border::BORDER_THIN
           )
         )
       );
           
         $this->excel->getActiveSheet()->mergeCells('A1:I1');
         $this->excel->getActiveSheet()->setCellValue('A1', "KARAVALI TRANSPORT ");
         $this->excel->getActiveSheet()->mergeCells('A2:I2');
         $this->excel->getActiveSheet()->setCellValue('A2', "OWN VEHICLE REPORT");
         $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
         $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
         $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->getStyle('A1:I2')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->getStyle('A3:I3')->applyFromArray($OutlineStyle);
           $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
           $this->excel->getActiveSheet()->mergeCells('A3:I3');
           $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
           $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->setCellValue('A3', "Vehicle : ".$vehicle_number);
         //   //font bold and text bold
           $this->excel->getActiveSheet()->getStyle('A4:I4')->getFont()->setBold(true);
          //horizontal and vertical alignment
       $this->excel->getActiveSheet()->getStyle('A4:I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $this->excel->getActiveSheet()->getStyle('A4:I4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
           //set width for cell
           $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
           $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
           $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
           $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(18);
           $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
           $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
           $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(18);
           $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(18);
           $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(18);
         //   //report Header
           $this->cellColor('A4:I4', 'D5DBDB');
           $this->excel->getActiveSheet()->getStyle('A4')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->getStyle('A4:I4')->applyFromArray($OutlineStyle);
           $this->excel->getActiveSheet()->setCellValue('A4', "Vehicle Number");
           $this->excel->getActiveSheet()->setCellValue('B4', "FC Date");
           $this->excel->getActiveSheet()->setCellValue('C4', "Road Tax Date");
           $this->excel->getActiveSheet()->setCellValue('D4', "Insurance Date");
           $this->excel->getActiveSheet()->setCellValue('E4', "KA Permit Date");
           $this->excel->getActiveSheet()->setCellValue('F4', "National Permit Date");
           $this->excel->getActiveSheet()->setCellValue('G4', "Emission Date");
           $this->excel->getActiveSheet()->setCellValue('H4', "Last service Date");
           $this->excel->getActiveSheet()->setCellValue('I4', "Vehicle Condition");
         $excel_row = 5;
      
         if(!empty($vehicleInfo))
         {
          foreach($vehicleInfo as $record)
           {
             //set row height for cell
                 //horizontal and vertical alignment
       
             $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':I' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':I' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
             $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
             $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, $record->vehicle_number);
             if($record->fc_date == '0000-00-00'){
                $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,""); 
            }else {
                $this->excel->getActiveSheet()->setCellValue('B'.$excel_row, date('d-m-Y',strtotime($record->fc_date)));
            }
            if($record->road_tax_date == '0000-00-00'){
                $this->excel->getActiveSheet()->setCellValue('C'.$excel_row,""); 
            }else {
             $this->excel->getActiveSheet()->setCellValue('C'.$excel_row, date('d-m-Y',strtotime($record->road_tax_date)));
            }
            if($record->insurance_date == '0000-00-00'){
                $this->excel->getActiveSheet()->setCellValue('D'.$excel_row,""); 
            }else {
             $this->excel->getActiveSheet()->setCellValue('D'.$excel_row, date('d-m-Y',strtotime($record->insurance_date)));
            }
            if($record->karnataka_permit_date == '0000-00-00'){
                $this->excel->getActiveSheet()->setCellValue('E'.$excel_row,""); 
            }else {
             $this->excel->getActiveSheet()->setCellValue('E'.$excel_row, date('d-m-Y',strtotime($record->karnataka_permit_date)));
            }
            if($record->national_permit_date == '0000-00-00'){
                $this->excel->getActiveSheet()->setCellValue('F'.$excel_row,""); 
            }else {
             $this->excel->getActiveSheet()->setCellValue('F'.$excel_row, date('d-m-Y',strtotime($record->national_permit_date)));
            }
            if($record->emission_date == '0000-00-00'){
                $this->excel->getActiveSheet()->setCellValue('G'.$excel_row,""); 
            }else {
             $this->excel->getActiveSheet()->setCellValue('G'.$excel_row, date('d-m-Y',strtotime($record->emission_date)));
             }
             if($record->last_service_date == '0000-00-00'){
                $this->excel->getActiveSheet()->setCellValue('H'.$excel_row,""); 
            }else {
             $this->excel->getActiveSheet()->setCellValue('H'.$excel_row, date('d-m-Y',strtotime($record->last_service_date)));
            }

             $this->excel->getActiveSheet()->setCellValue('I'.$excel_row, $record->vehicle_condition);
          
          
             $this->excel->getActiveSheet()->getStyle('A5:I'.$excel_row)->applyFromArray($OutlineStyle);
             $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:J'.$excel_row);
             $this->excel->getActiveSheet()->getStyle('A1:I'.$excel_row)->applyFromArray($styleArray);
             $excel_row++;
           }
         }

     $filename='just_some_random_name.xls'; //save our workbook as this file name
     header('Content-Type: application/vnd.ms-excel'); //mime type
     header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
     header('Cache-Control: max-age=0'); //no cache          
     //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
     //if you want to save it as .XLSX Excel 2007 format
     $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
     ob_start();
     $objWriter->save("php://output");
     $xlsData = ob_get_contents();
     ob_end_clean();

     $response =  array(
         'op' => 'ok',
         'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
     );

 die(json_encode($response));
 }
 public function cellColor($cells,$color){
     return $this->excel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
         'type' => PHPExcel_Style_Fill::FILL_SOLID,
         'startcolor' => array(
              'rgb' => $color
         )
     ));
     }

 // Fuel Report
 function downloadFuelReport(){
    //print page setup
 $this->excel->setActiveSheetIndex(0);
 $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToPage(true);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);    
 $fromDate = $this->input->post('from_date');
 $toDate = $this->input->post('to_date');
 $vehicle_number = $this->input->post('vehicle_number');
 $fuelInfo = $this->own_vehicle_model->getFuelReport($fromDate,$toDate,$vehicle_number);
 $styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
 $this->excel->setActiveSheetIndex(0);
 //name the worksheet
 $this->excel->getActiveSheet()->setTitle('Karavali worksheet');
 //set Title content with some text
 $headerStyle = array(
     'font'  => array(
         'bold' => true,
         'color' => array('rgb' => '17202A'),
         'size'  => 20,
         'name' => 'Verdana'
     ));
     $OutlineStyle = array(
         'borders' => array(
           'outline' => array(
             'style' => PHPExcel_Style_Border::BORDER_THIN
           )
         )
       );
           
         $this->excel->getActiveSheet()->mergeCells('A1:D1');
         $this->excel->getActiveSheet()->setCellValue('A1', "KARAVALI TRANSPORT ");
         $this->excel->getActiveSheet()->mergeCells('A2:D2');
         $this->excel->getActiveSheet()->setCellValue('A2', "FUEL REPORT");
         $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
         $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
         $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->getStyle('A1:D2')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->getStyle('A3:D3')->applyFromArray($OutlineStyle);
           $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
           $this->excel->getActiveSheet()->mergeCells('A3:D3');
           $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
           $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->setCellValue('A3', "Date From : ".$fromDate. " To : " .$toDate);
         //   //font bold and text bold
           $this->excel->getActiveSheet()->getStyle('A4:D4')->getFont()->setBold(true);
          //horizontal and vertical alignment
       $this->excel->getActiveSheet()->getStyle('A4:D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $this->excel->getActiveSheet()->getStyle('A4:D4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
           //set width for cell
           $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
           $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
           $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
           $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
         
         //   //report Header
           $this->cellColor('A4:D4', 'D5DBDB');
           $this->excel->getActiveSheet()->getStyle('A4')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->getStyle('A4:D4')->applyFromArray($OutlineStyle);
           $this->excel->getActiveSheet()->setCellValue('A4', "Date");
           $this->excel->getActiveSheet()->setCellValue('B4', "Vehicle Number");
           $this->excel->getActiveSheet()->setCellValue('C4', "Liter");
           $this->excel->getActiveSheet()->setCellValue('D4', "Amount");
         $excel_row = 5;
      
         if(!empty($fuelInfo))
         {
          foreach($fuelInfo as $record)
           {
             //set row height for cell
                 //horizontal and vertical alignment
       
             $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':D' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':D' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
             $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
             $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, date('d-m-Y',strtotime($record->fuel_date)));
             $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->vehicle_number);
             $this->excel->getActiveSheet()->setCellValue('C'.$excel_row, $record->liter);
             $this->excel->getActiveSheet()->setCellValue('D'.$excel_row, $record->fuel_amount);
             $this->excel->getActiveSheet()->getStyle('A5:D'.$excel_row)->applyFromArray($OutlineStyle);
             $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:D'.$excel_row);
             $this->excel->getActiveSheet()->getStyle('A1:D'.$excel_row)->applyFromArray($styleArray);
             $excel_row++;
           }
         }
         
     $filename='just_some_random_name.xls'; //save our workbook as this file name
     header('Content-Type: application/vnd.ms-excel'); //mime type
     header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
     header('Cache-Control: max-age=0'); //no cache          
     //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
     //if you want to save it as .XLSX Excel 2007 format
     $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
     ob_start();
     $objWriter->save("php://output");
     $xlsData = ob_get_contents();
     ob_end_clean();

     $response =  array(
         'op' => 'ok',
         'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
     );

 die(json_encode($response));
 }



 // Trip Report
 function downloadTripReport(){
    //print page setup
 $this->excel->setActiveSheetIndex(0);
 $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToPage(true);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);    
 $fromDate = $this->input->post('from_date');
 $toDate = $this->input->post('to_date');
 $vehicle_number = $this->input->post('vehicle_number');
 $serviceInfo = $this->own_vehicle_model->getTripReport($fromDate,$toDate,$vehicle_number);
 $styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
 $this->excel->setActiveSheetIndex(0);
 //name the worksheet
 $this->excel->getActiveSheet()->setTitle('Karavali worksheet');
 //set Title content with some text
 $headerStyle = array(
     'font'  => array(
         'bold' => true,
         'color' => array('rgb' => '17202A'),
         'size'  => 20,
         'name' => 'Verdana'
     ));
     $OutlineStyle = array(
         'borders' => array(
           'outline' => array(
             'style' => PHPExcel_Style_Border::BORDER_THIN
           )
         )
       );
           
         $this->excel->getActiveSheet()->mergeCells('A1:E1');
         $this->excel->getActiveSheet()->setCellValue('A1', "KARAVALI TRANSPORT ");
         $this->excel->getActiveSheet()->mergeCells('A2:E2');
         $this->excel->getActiveSheet()->setCellValue('A2', "TRIP REPORT");
         $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
         $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
         $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->getStyle('A1:E2')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($OutlineStyle);
           $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
           $this->excel->getActiveSheet()->mergeCells('A3:E3');
           $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
           $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->setCellValue('A3', "Date From : ".$fromDate. " To : " .$toDate);
         //   //font bold and text bold
           $this->excel->getActiveSheet()->getStyle('A4:E4')->getFont()->setBold(true);
          //horizontal and vertical alignment
       $this->excel->getActiveSheet()->getStyle('A4:E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $this->excel->getActiveSheet()->getStyle('A4:E4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
           //set width for cell
           $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
           $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
           $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
           $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
           $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(18);
           $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
         
         //   //report Header
           $this->cellColor('A4:E4', 'D5DBDB');
           $this->excel->getActiveSheet()->getStyle('A4')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->getStyle('A4:E4')->applyFromArray($OutlineStyle);
           $this->excel->getActiveSheet()->setCellValue('A4', "Date");
           $this->excel->getActiveSheet()->setCellValue('B4', "Vehicle Number");
           $this->excel->getActiveSheet()->setCellValue('C4', "Place/Distance");
           $this->excel->getActiveSheet()->setCellValue('D4', "Total Trip");
           $this->excel->getActiveSheet()->setCellValue('E4', "Comments");
         $excel_row = 5;
      
         if(!empty($serviceInfo))
         {
          foreach($serviceInfo as $record)
           {
             //set row height for cell
                 //horizontal and vertical alignment
       
             $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':E' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':E' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
             $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
             $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, date('d-m-Y',strtotime($record->service_date)));
             $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->vehicle_number);
             $this->excel->getActiveSheet()->setCellValue('C'.$excel_row, $record->place);
             $this->excel->getActiveSheet()->setCellValue('D'.$excel_row,$record->total_trip);
             $this->excel->getActiveSheet()->setCellValue('E'.$excel_row, $record->comments);
             $this->excel->getActiveSheet()->getStyle('A5:E'.$excel_row)->applyFromArray($OutlineStyle);
             $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:F'.$excel_row);
             $this->excel->getActiveSheet()->getStyle('A1:E'.$excel_row)->applyFromArray($styleArray);
             $excel_row++;
           }
         }
         
     $filename='just_some_random_name.xls'; //save our workbook as this file name
     header('Content-Type: application/vnd.ms-excel'); //mime type
     header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
     header('Cache-Control: max-age=0'); //no cache          
     //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
     //if you want to save it as .XLSX Excel 2007 format
     $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
     ob_start();
     $objWriter->save("php://output");
     $xlsData = ob_get_contents();
     ob_end_clean();

     $response =  array(
         'op' => 'ok',
         'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
     );

 die(json_encode($response));
 }



 // Trip Report
 function downloadFuelTripReport(){
    //print page setup
 $this->excel->setActiveSheetIndex(0);
 $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToPage(true);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);    
 $fromDate = $this->input->post('from_date');
 $toDate = $this->input->post('to_date');
 $transporter_name = $this->input->post('transporter_name');
 $vehicle_type = $this->input->post('vehicle_type');
 $lease_vehicle_number = $this->input->post('lease_vehicle_number');
 $own_vehicle_number = $this->input->post('own_vehicle_number');
 $diesel_pump = $this->input->post('diesel_pump');

 $filter['fromDate'] = $fromDate;
 $filter['toDate'] = $toDate;
 $filter['transporter_name'] = $transporter_name;
 $filter['vehicle_type'] = $vehicle_type;
 $filter['lease_vehicle_number'] = $lease_vehicle_number;
 $filter['own_vehicle_number'] = $own_vehicle_number;
 $filter['diesel_pump'] = $diesel_pump;

 //fuel info of own/lease 
 $fuelInfo = $this->own_vehicle_model->getOwnLeaseFuelInfo($filter);
 $styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
 $this->excel->setActiveSheetIndex(0);
 //name the worksheet
 $this->excel->getActiveSheet()->setTitle('Karavali worksheet');
 //set Title content with some text
 $headerStyle = array(
     'font'  => array(
         'bold' => true,
         'color' => array('rgb' => '17202A'),
         'size'  => 20,
         'name' => 'Verdana'
     ));
     $OutlineStyle = array(
         'borders' => array(
           'outline' => array(
             'style' => PHPExcel_Style_Border::BORDER_THIN
           )
         )
       );
       if($vehicle_type == 'Own') {    
       $this->excel->getActiveSheet()->mergeCells('A1:H1');
       $this->excel->getActiveSheet()->setCellValue('A1', "KARAVALI TRANSPORT ");
       $this->excel->getActiveSheet()->mergeCells('A2:H2');
       $this->excel->getActiveSheet()->setCellValue('A2',"OWN VEHICLE FUEL/TRIP REPORT");
       $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
       $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
       $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
       $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
       $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $this->excel->getActiveSheet()->getStyle('A1:H2')->applyFromArray($OutlineStyle);
       $this->excel->getActiveSheet()->getStyle('A3:H3')->applyFromArray($OutlineStyle);
       $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $this->excel->getActiveSheet()->mergeCells('A3:H3');
       $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
       $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
       $this->excel->getActiveSheet()->setCellValue('A3', "Date From : ".$fromDate. " To : " .$toDate);
       $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setSize(12);
         $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->getStyle('E4')->getFont()->setSize(12);
         $this->excel->getActiveSheet()->getStyle('E4')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->mergeCells('A4:D4');
         $this->excel->getActiveSheet()->mergeCells('E4:H4');
         $this->excel->getActiveSheet()->getStyle('A4:D5')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->getStyle('E4:H5')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->setCellValue('A4', "Vehicle Type  : ".$vehicle_type);
         $this->excel->getActiveSheet()->setCellValue('E4', "Vehicle Number  : ".$own_vehicle_number);
         $this->excel->getActiveSheet()->mergeCells('A5:D5');
         $this->excel->getActiveSheet()->mergeCells('E5:H5');
         $this->excel->getActiveSheet()->getStyle('A5')->getFont()->setSize(12);
         $this->excel->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->getStyle('E5')->getFont()->setSize(12);
         $this->excel->getActiveSheet()->getStyle('E5')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->setCellValue('A5', "Diesel Filled ");
         $this->excel->getActiveSheet()->setCellValue('E5', "Diesel Utilized(TRIP REPORT) ");
       //   //font bold and text bold
        //horizontal and vertical alignment
        $this->excel->getActiveSheet()->getStyle('A6:H6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A6:H6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A5:D5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A5:D5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('E5:H5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('E5:H5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A6:H6')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('A6:H6')->getFont()->setBold(true);
            //set width for cell
           $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
           $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
           $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
           $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
           $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(18);
           $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(18);
           $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(18);
           $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(18);
         
         //   //report Header
           $this->cellColor('A5:H6', 'D5DBDB');
           $this->excel->getActiveSheet()->getStyle('A6')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->getStyle('A6:H6')->applyFromArray($OutlineStyle);
           $this->excel->getActiveSheet()->setCellValue('A6', "Date");
           $this->excel->getActiveSheet()->setCellValue('B6', "Litre");
           $this->excel->getActiveSheet()->setCellValue('C6', "Amount");
           $this->excel->getActiveSheet()->setCellValue('D6', "Pump");
           $this->excel->getActiveSheet()->setCellValue('E6', "Date");
           $this->excel->getActiveSheet()->setCellValue('F6', "Distance/Place");
           $this->excel->getActiveSheet()->setCellValue('G6', "Total Trip");
           $this->excel->getActiveSheet()->setCellValue('H6', "Trip Amount");
          
           $excel_row = 7;
           if(!empty($fuelInfo))
           {
            foreach($fuelInfo as $record)
             {
               //set row height for cell
             //horizontal and vertical alignment
               $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':H' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
               $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':H' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
               $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
               $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, date('d-m-Y',strtotime($record->fuel_date)));
               $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->liter);
               $this->excel->getActiveSheet()->setCellValue('C'.$excel_row, $record->fuel_amount);
               $this->excel->getActiveSheet()->setCellValue('D'.$excel_row,$record->fuel_account_name);
               $this->excel->getActiveSheet()->getStyle('A5:H'.$excel_row)->applyFromArray($OutlineStyle);
               $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:H'.$excel_row);
               $this->excel->getActiveSheet()->getStyle('A1:H'.$excel_row)->applyFromArray($styleArray);
               $tripInfo = $this->own_vehicle_model->getTripInformation($record->row_id);
                if(!empty($tripInfo))
                {
                 foreach($tripInfo as $record)
                  {
                    $this->excel->getActiveSheet()->getStyle('E'.$excel_row. ':H' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $this->excel->getActiveSheet()->getStyle('E'.$excel_row. ':H' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
                    $this->excel->getActiveSheet()->setCellValue('E'.$excel_row, date('d-m-Y',strtotime($record->service_date)));
                    $this->excel->getActiveSheet()->setCellValue('F'.$excel_row,$record->place);
                    $this->excel->getActiveSheet()->setCellValue('G'.$excel_row, $record->total_trip);
                    $this->excel->getActiveSheet()->setCellValue('H'.$excel_row, $record->trip_amount);
                    $this->excel->getActiveSheet()->getStyle('A5:H'.$excel_row)->applyFromArray($OutlineStyle);
                    $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:H'.$excel_row);
                    $this->excel->getActiveSheet()->getStyle('A1:H'.$excel_row)->applyFromArray($styleArray);
                    $excel_row++;
                  }
                }
                
            }
            
             }
           

        } else {
            $this->excel->getActiveSheet()->mergeCells('A1:E1');
            $this->excel->getActiveSheet()->setCellValue('A1', "KARAVALI TRANSPORT ");
            $this->excel->getActiveSheet()->mergeCells('A2:E2');
            $this->excel->getActiveSheet()->setCellValue('A2', "LEASE VEHICLE FUEL REPORT");
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
            $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('A1:E2')->applyFromArray($OutlineStyle);
            $this->excel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($OutlineStyle);
            $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->mergeCells('A3:E3');
            $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
            $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->setCellValue('A3', "Date From : ".$fromDate. " To : " .$toDate);
            $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setSize(12);
              $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
              $this->excel->getActiveSheet()->getStyle('D4')->getFont()->setSize(12);
              $this->excel->getActiveSheet()->getStyle('D4')->getFont()->setBold(true);
              $this->excel->getActiveSheet()->mergeCells('A4:C4');
              $this->excel->getActiveSheet()->mergeCells('D4:E4');
              $this->excel->getActiveSheet()->getStyle('A4:C4')->applyFromArray($OutlineStyle);
              $this->excel->getActiveSheet()->getStyle('D4:E4')->applyFromArray($OutlineStyle);
              $this->excel->getActiveSheet()->setCellValue('A4', "Vehicle Type  : ".$vehicle_type);
              $this->excel->getActiveSheet()->setCellValue('D4', "Vehicle Number  : ".$lease_vehicle_number);
         
         $this->excel->getActiveSheet()->getStyle('A5:E5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->getStyle('A5:E5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
             //set width for cell 
             $this->excel->getActiveSheet()->getStyle('A5:E5')->getFont()->setSize(12);
             $this->excel->getActiveSheet()->getStyle('A5:E5')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(18);
          
          //   //report Header
            $this->cellColor('A5:E5', 'D5DBDB');
            $this->excel->getActiveSheet()->getStyle('A5')->applyFromArray($OutlineStyle);
          $this->excel->getActiveSheet()->getStyle('A5:E5')->applyFromArray($OutlineStyle);
            $this->excel->getActiveSheet()->setCellValue('A5', "Date");
            $this->excel->getActiveSheet()->setCellValue('B5', "Vehicle Number");
            $this->excel->getActiveSheet()->setCellValue('C5', "Trnasporter Name");
            $this->excel->getActiveSheet()->setCellValue('D5', "Pump");
            $this->excel->getActiveSheet()->setCellValue('E5', "Amount");
          $excel_row = 6;
       
          if(!empty($fuelInfo))
          {
           foreach($fuelInfo as $record)
            {
              //set row height for cell
             //horizontal and vertical alignment
             if($record->fuel_amount != '0.00') {
              $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':E' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
              $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':E' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
              $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
              $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, date('d-m-Y',strtotime($record->fuel_date)));
              $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->vehicle_number);
              $this->excel->getActiveSheet()->setCellValue('C'.$excel_row, $record->transporter_name);
              $this->excel->getActiveSheet()->setCellValue('D'.$excel_row,$record->diesel_pump);
              $this->excel->getActiveSheet()->setCellValue('E'.$excel_row,$record->fuel_amount);
              $this->excel->getActiveSheet()->getStyle('A5:E'.$excel_row)->applyFromArray($OutlineStyle);
              $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:D'.$excel_row);
              $this->excel->getActiveSheet()->getStyle('A5:E'.$excel_row)->applyFromArray($styleArray);
              $excel_row++;
             }
             
            }
          }
        }
         
 
 
     $filename='just_some_random_name.xls'; //save our workbook as this file name
     header('Content-Type: application/vnd.ms-excel'); //mime type
     header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
     header('Cache-Control: max-age=0'); //no cache          
     //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
     //if you want to save it as .XLSX Excel 2007 format
     $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
     ob_start();
     $objWriter->save("php://output");
     $xlsData = ob_get_contents();
     ob_end_clean();

     $response =  array(
         'op' => 'ok',
         'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
     );

 die(json_encode($response));
 }

// Wheel  Report
function downloadWheelReport(){
    //print page setup
 $this->excel->setActiveSheetIndex(0);
 $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
 $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToPage(true);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
 $this->excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);    
 $vehicle_number = $this->input->post('vehicle_number');
 $wheelInfo = $this->own_vehicle_model->getWheelReport($vehicle_number);
 $styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
 $this->excel->setActiveSheetIndex(0);
 //name the worksheet
 $this->excel->getActiveSheet()->setTitle('Karavali worksheet');
 //set Title content with some text
 $headerStyle = array(
     'font'  => array(
         'bold' => true,
         'color' => array('rgb' => '17202A'),
         'size'  => 20,
         'name' => 'Verdana'
     ));
     $OutlineStyle = array(
         'borders' => array(
           'outline' => array(
             'style' => PHPExcel_Style_Border::BORDER_THIN
           )
         )
       );
           
         $this->excel->getActiveSheet()->mergeCells('A1:E1');
         $this->excel->getActiveSheet()->setCellValue('A1', "KARAVALI TRANSPORT ");
         $this->excel->getActiveSheet()->mergeCells('A2:E2');
         $this->excel->getActiveSheet()->setCellValue('A2', "WHEEL REPORT");
         $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
         $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
         $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
         $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $this->excel->getActiveSheet()->getStyle('A1:E2')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($OutlineStyle);
           $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
           $this->excel->getActiveSheet()->mergeCells('A3:E3');
           $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
           $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
           $this->excel->getActiveSheet()->setCellValue('A3', "Vehicle : ".$vehicle_number);
         //   //font bold and text bold
           $this->excel->getActiveSheet()->getStyle('A4:E4')->getFont()->setBold(true);
          //horizontal and vertical alignment
       $this->excel->getActiveSheet()->getStyle('A4:E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $this->excel->getActiveSheet()->getStyle('A4:E4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
           //set width for cell
           $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
           $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
           $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
           $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
           $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
         //   //report Header
           $this->cellColor('A4:E4', 'D5DBDB');
           $this->excel->getActiveSheet()->getStyle('A4')->applyFromArray($OutlineStyle);
         $this->excel->getActiveSheet()->getStyle('A4:E4')->applyFromArray($OutlineStyle);
           $this->excel->getActiveSheet()->setCellValue('A4', "Vehicle Number");
           $this->excel->getActiveSheet()->setCellValue('B4', "Wheel Number");
           $this->excel->getActiveSheet()->setCellValue('C4', "Wheel Type");
           $this->excel->getActiveSheet()->setCellValue('D4', "Wheel Position");
           $this->excel->getActiveSheet()->setCellValue('E4', "Description");
          
         $excel_row = 5;
      
         if(!empty($wheelInfo))
         {
          foreach($wheelInfo as $record)
           {
             //set row height for cell
                 //horizontal and vertical alignment
       
             $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':E' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
             $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':E' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
             $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
             $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, $record->vehicle_number);
             $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->wheel_number);
             $this->excel->getActiveSheet()->setCellValue('C'.$excel_row, $record->wheel_type);
             $this->excel->getActiveSheet()->setCellValue('D'.$excel_row,$record->wheel_position);
             $this->excel->getActiveSheet()->setCellValue('E'.$excel_row, $record->comments);
          
             $this->excel->getActiveSheet()->getStyle('A5:E'.$excel_row)->applyFromArray($OutlineStyle);
             $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:J'.$excel_row);
             $this->excel->getActiveSheet()->getStyle('A1:E'.$excel_row)->applyFromArray($styleArray);
             $excel_row++;
           }
         }
         
     $filename='just_some_random_name.xls'; //save our workbook as this file name
     header('Content-Type: application/vnd.ms-excel'); //mime type
     header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
     header('Cache-Control: max-age=0'); //no cache          
     //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
     //if you want to save it as .XLSX Excel 2007 format
     $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
     ob_start();
     $objWriter->save("php://output");
     $xlsData = ob_get_contents();
     ob_end_clean();

     $response =  array(
         'op' => 'ok',
         'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
     );

 die(json_encode($response));
 }
}

?>