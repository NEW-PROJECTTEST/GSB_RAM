<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require FCPATH . '/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
class Transport extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transport_model');
        $this->load->model('transporter_model');
        $this->load->model('lease_vehicle_model');
        $this->load->model('party_model');
        $this->load->model('bank_model');
        $this->load->model('cash_account_model');
        $this->load->model('cash_book_model');
        $this->load->model('own_vehicle_model');
        $this->load->model('fuel_model');
        $this->load->library('excel');
        $this->isLoggedIn();   
    }
  
    /**
     * This function is used to load the Transport list
     */
    function transportListing(){
        redirect('clearPonchTransportListing');
    }
    // function transportListing()
    // {
    //     if($this->isAdmin() == TRUE)
    //     {
    //         $this->loadThis();
    //     } else {     
    //         $date = $this->security->xss_clean($this->input->post('date'));   
    //         $vehicle_number = $this->security->xss_clean($this->input->post('vehicle_number'));  
    //         $party_name = $this->security->xss_clean($this->input->post('party_name'));
    //         $ponch_amount = $this->security->xss_clean($this->input->post('ponch_amount'));
    //         $transporter_name = $this->security->xss_clean($this->input->post('transporter_name'));
           
    //         if(!empty($date)){
    //             $data['date'] = date('d-m-Y',strtotime($date));
    //             $filter['date'] = date('Y-m-d',strtotime($date));
    //         } else{
    //             $data['date'] = $date;
    //             $filter['date'] = $date;
    //         }
    //         $data['vehicle_number'] = $vehicle_number;
    //         $data['party_name'] = $party_name;
    //         $data['ponch_amount'] = $ponch_amount;
    //         $data['transporter_name'] = $transporter_name;
    //         $filter['vehicle_number'] = $vehicle_number;
    //         $filter['ponch_amount'] = $ponch_amount;
    //         $filter['transporter_name'] = $transporter_name;
    //         $filter['party_name'] = $party_name;
            
    //         $searchText = $this->security->xss_clean($this->input->post('searchText'));
    //         $data['searchText'] = $searchText;
    //         $data['vehicles'] = $this->lease_vehicle_model->getAllLeaseVehicles($this->company_id);
    //         $data['bank'] = $this->bank_model->getAllBank($this->company_id);
    //         $data['party'] = $this->party_model->getAllParty($this->company_id);
    //         $data['cashAccount'] = $this->cash_account_model->getAllCashAccounts($this->company_id);
    //         $data['transporters'] = $this->transporter_model->getAllTransporters($this->company_id);
    //         $this->load->library('pagination');
    //         $count = $this->transport_model->transportListingCount($searchText,$filter,$this->company_id);
    //         $data['count'] =  $count;
	// 		$returns = $this->paginationCompress ("transportListing/", $count, 100 );
    //         $data['transportRecords'] = $this->transport_model->transportListing($searchText,$filter,$this->company_id, $returns["page"], $returns["segment"]);
    //         $this->global['pageTitle'] = $this->company_name.' :Transport Details ';
    //         $this->loadViews("transport/transport", $this->global, $data, NULL);
    //     }
    // }
    function clearPonchTransportListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {     
            $date = $this->security->xss_clean($this->input->post('date'));   
            $vehicle_number = $this->security->xss_clean($this->input->post('vehicle_number'));  
            $party_name = $this->security->xss_clean($this->input->post('party_name'));
            $ponch_amount = $this->security->xss_clean($this->input->post('ponch_amount'));
            $transporter_name = $this->security->xss_clean($this->input->post('transporter_name'));
            $filter['ponch'] = "clear";
            $data['ponch'] = "Cleared";
            if(!empty($date)){
                $data['date'] = date('d-m-Y',strtotime($date));
                $filter['date'] = date('Y-m-d',strtotime($date));
            } else{
                $data['date'] = $date;
                $filter['date'] = $date;
            }
            $data['vehicle_number'] = $vehicle_number;
            $data['party_name'] = $party_name;
            $data['ponch_amount'] = $ponch_amount;
            $data['transporter_name'] = $transporter_name;
            $filter['vehicle_number'] = $vehicle_number;
            $filter['ponch_amount'] = $ponch_amount;
            $filter['transporter_name'] = $transporter_name;
            $filter['party_name'] = $party_name;
            
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            $data['vehicles'] = $this->lease_vehicle_model->getAllLeaseVehicles($this->company_id);
            $data['bank'] = $this->bank_model->getAllBank($this->company_id);
            $data['party'] = $this->party_model->getAllParty($this->company_id);
            $data['cashAccount'] = $this->cash_account_model->getAllCashAccounts($this->company_id);
            $data['transporters'] = $this->transporter_model->getAllTransporters($this->company_id);
            $this->load->library('pagination');
            $count = $this->transport_model->transportListingCount($searchText,$filter,$this->company_id);
            $data['count'] =  $count;
			$returns = $this->paginationCompress ("clearPonchTransportListing/", $count, 100 );
            $data['transportRecords'] = $this->transport_model->transportListing($searchText,$filter,$this->company_id, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = $this->company_name.' :Transport Details ';
            $this->loadViews("transport/transport", $this->global, $data, NULL);
        }
    }
    function pendingPonchTransportListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {     
            $date = $this->security->xss_clean($this->input->post('date'));   
            $vehicle_number = $this->security->xss_clean($this->input->post('vehicle_number'));  
            $party_name = $this->security->xss_clean($this->input->post('party_name'));
            $ponch_amount = $this->security->xss_clean($this->input->post('ponch_amount'));
            $transporter_name = $this->security->xss_clean($this->input->post('transporter_name'));
            $filter['ponch'] = "pending";
            $data['ponch'] = "Uncleared";
            if(!empty($date)){
                $data['date'] = date('d-m-Y',strtotime($date));
                $filter['date'] = date('Y-m-d',strtotime($date));
            } else{
                $data['date'] = $date;
                $filter['date'] = $date;
            }
            $data['vehicle_number'] = $vehicle_number;
            $data['party_name'] = $party_name;
            $data['ponch_amount'] = $ponch_amount;
            $data['transporter_name'] = $transporter_name;
            $filter['vehicle_number'] = $vehicle_number;
            $filter['ponch_amount'] = $ponch_amount;
            $filter['transporter_name'] = $transporter_name;
            $filter['party_name'] = $party_name;
            
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            $data['vehicles'] = $this->lease_vehicle_model->getAllLeaseVehicles($this->company_id);
            $data['bank'] = $this->bank_model->getAllBank($this->company_id);
            $data['party'] = $this->party_model->getAllParty($this->company_id);
            $data['cashAccount'] = $this->cash_account_model->getAllCashAccounts($this->company_id);
            $data['transporters'] = $this->transporter_model->getAllTransporters($this->company_id);
            $data['fuelAccount'] = $this->fuel_model->getAllPumpInfo($this->company_id);
            $this->load->library('pagination');
            $count = $this->transport_model->transportListingCount($searchText,$filter,$this->company_id);
            $data['count'] =  $count;
			$returns = $this->paginationCompress ("pendingPonchTransportListing/", $count, 100 );
            $data['transportRecords'] = $this->transport_model->transportListing($searchText,$filter,$this->company_id, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = $this->company_name.' :Transport Details ';
            $this->loadViews("transport/transport", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used to load the add new form
     */
    function addTransportPageView()
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            $data['vehicles'] = $this->lease_vehicle_model->getAllLeaseVehicles($this->company_id);
            $data['party'] = $this->party_model->getAllParty($this->company_id);
            $data['bank'] = $this->bank_model->getAllBank($this->company_id);
            $data['getAllPumpInfo'] = $this->fuel_model->getAllPumpInfo($this->company_id);
          
            $data['transporterInfo'] = $this->transporter_model->getAllTransporters($this->company_id);
            $data['cashAccount'] = $this->cash_account_model->getAllCashAccounts($this->company_id);
            $this->global['pageTitle'] = $this->company_name.' : Add Transport ';
            $this->loadViews("transport/addTransport", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to add new Transport to the system
     */
    function addTransport()
    {
        if($this->isAdmin() == TRUE){
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('vehicle_number','Vehicle Number','trim|required');
            $this->form_validation->set_rules('party_rowid','Party Name','required');
            $this->form_validation->set_rules('invoice_number','Invoice Number','required');
            $this->form_validation->set_rules('LR_no','LR No','required');
            $this->form_validation->set_rules('bags','Bags','required');
            $this->form_validation->set_rules('mt','mt','required');
            $this->form_validation->set_rules('destination','destination','required');
            $this->form_validation->set_rules('rate','rate','required');
            $this->form_validation->set_rules('amount','amount','required');
            $this->form_validation->set_rules('transporter_id','Transport Name','required');
            //$this->form_validation->set_rules('unloading_charge','unloading_charge','required');
            $this->form_validation->set_rules('ponch_amount','ponch_amount','required');
            // $this->form_validation->set_rules('roro','roro','required');
            // $this->form_validation->set_rules('narration','narration','required');
            $this->form_validation->set_rules('ponch_pending','ponch_pending','required');
            if($this->form_validation->run() == FALSE) {
                $this->addTransportPageView();
            } else {
                $transporter_id = $this->security->xss_clean($this->input->post('transporter_id'));
                $vehicle_number = $this->security->xss_clean($this->input->post('vehicle_number'));
                $date = $this->security->xss_clean($this->input->post('date'));
                $invoice_number = $this->security->xss_clean($this->input->post('invoice_number'));
                $LR_no = $this->security->xss_clean($this->input->post('LR_no'));
                $party_rowid = $this->security->xss_clean($this->input->post('party_rowid'));
                $bags = $this->security->xss_clean($this->input->post('bags'));
                $mt = $this->security->xss_clean($this->input->post('mt'));
                $destination = $this->security->xss_clean($this->input->post('destination'));
                $rate = $this->security->xss_clean($this->input->post('rate'));
                $amount = $this->security->xss_clean($this->input->post('amount'));
                $cash_account_rowid = $this->security->xss_clean($this->input->post('cash_account_rowid'));
                $data['cashAccountInfo'] = $this->cash_account_model->getCashAccountInfoById($cash_account_rowid);
                $cash_amount = $this->security->xss_clean($this->input->post('cash_amount'));
                $fuel_account_row_id = $this->security->xss_clean($this->input->post('diesel_pump'));
                $diesel_amount = $this->security->xss_clean($this->input->post('diesel_amount'));
                $diesel_date = $this->security->xss_clean($this->input->post('diesel_date'));
                $firm_name = $this->security->xss_clean($this->input->post('firm_name'));
                if(empty($diesel_date)){
                    $diesel_date = "NULL";
                } else{
                    $diesel_date = date('Y-m-d',strtotime($diesel_date));
                }
               

                $discount_amount = $this->security->xss_clean($this->input->post('discount_amount'));
                $loading_charge = $this->security->xss_clean($this->input->post('loading_charge'));
                $unloading_charge = $this->security->xss_clean($this->input->post('unloading_charge'));
                $halt_charge = $this->security->xss_clean($this->input->post('halt_charge'));
                $ponch_amount = $this->security->xss_clean($this->input->post('ponch_amount'));
                $roro = $this->security->xss_clean($this->input->post('roro'));
                $bank_rowid = $this->security->xss_clean($this->input->post('bank_rowid'));
                $party_amount = $this->security->xss_clean($this->input->post('party_amount'));
                $narration = $this->security->xss_clean($this->input->post('narration'));
                $ponch_pending = $this->security->xss_clean($this->input->post('ponch_pending'));
                // if($cash_amount > $data['cashAccountInfo']->account_balance)
                // {
                //     $this->session->set_flashdata('error', 'Insufficient Account Balance');
                // } else {
                $transportInfo = array('firm_name'=>$firm_name,'vehicle_number'=>$vehicle_number,'date'=>date('y-m-d',strtotime($date)), 'invoice_number'=>$invoice_number, 'transporter_rowid'=>$transporter_id,
                'LR_no'=>$LR_no,'party_rowid'=>$party_rowid,'bags'=>$bags,'mt'=>$mt, 'destination'=>$destination,'cash_amount'=>$cash_amount,'discount_amount'=>$discount_amount,
                'rate'=>$rate,'amount'=>$amount,'cash_account_rowid'=>$cash_account_rowid,'fuel_account_row_id'=>$fuel_account_row_id,'diesel_amount'=>$diesel_amount,'diesel_date'=>$diesel_date, 'loading_charge'=>$loading_charge,
                'unloading_charge'=>$unloading_charge,'halt_charge'=>$halt_charge,'ponch_amount'=>$ponch_amount,'roro'=>$roro,'bank_rowid'=>$bank_rowid, 
                'party_amount'=>$party_amount,'narration'=>$narration,'ponch_pending'=>$ponch_pending,'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->transport_model->addTransport($transportInfo);
                if($result > 0){

                    //START adding bank transaction to table
                    if(!empty($bank_rowid)){
                        $acc_type = $this->bank_model->getBankInfoById($bank_rowid);
                        $partyInfo = $this->party_model->getPartyInfoById($party_rowid);
                        if($acc_type->account_type=='O/D Account'){
                            $transInfo = array(
                                'trans_date'=>date('y-m-d',strtotime($date)),
                                'bank_name'=>$acc_type->bank_name,
                                'trans_type'=>'CREDIT',
                                'amount'=>$party_amount,
                                // 'particular'=>'Add Transport- '.$partyInfo->party_name.'('.$vehicle_number.')',
                                'particular' => $narration,
                                'is_required' => 1,
                                'created_by'=>$this->employee_id, 
                                'created_date_time'=>date('Y-m-d H:i:s'));
                        }else{
                            $transInfo = array(
                                'trans_date'=>date('Y-m-d',strtotime($date)),
                                'bank_name'=>$acc_type->bank_name,
                                'trans_type'=>'DEBIT',
                                'amount'=>$party_amount,
                                // 'particular'=>'Add Transport - '.$partyInfo->party_name.'('.$vehicle_number.')',
                                'particular' => $narration,
                                'is_required' => 1,
                                'created_by'=>$this->employee_id, 
                                'created_date_time'=>date('Y-m-d H:i:s'));
                        }
                        $result = $this->bank_model->addBankTransaction($transInfo);
                    }
                    //END adding bank transaction to table

                   //add amount to cash expenses table
                    $cashInfo = array('credit'=>$party_amount , 
                    'bank_account_row_id'=>$bank_rowid,'cash_date'=>date('Y-m-d',strtotime($date)),
                    'comments' => $narration, 'transaction_type'=>'Bank', 'transport_rowid'=>$result, 'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                    $result_bank = $this->cash_book_model->addCashExpenses($cashInfo);
                    
                    $cashInfo = array('credit'=>$cash_amount , 'comments' => $narration, 'cash_account_rowid'=>$cash_account_rowid, 'cash_date'=>date('Y-m-d',strtotime($date)),'transaction_type'=>'Cash', 'transport_rowid'=>$result, 'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                    $result_cash = $this->cash_book_model->addCashExpenses($cashInfo);
                   
                     //update account balance
                     if(!empty($data['cashAccountInfo'])){
                        $account_balance_result =  $data['cashAccountInfo']->account_balance - $cash_amount;
                        $cashAccountInfo = array('account_balance'=>$account_balance_result,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                        $cash_account_result = $this->cash_account_model->updateCashAccount($cashAccountInfo,$cash_account_rowid);
                     }
                    
                   // add fuel info
                  
                    if(!empty($fuel_account_row_id)){
                        $fuelInfo = array('vehicle_number'=>$vehicle_number,
                        'transport_rowid'=>$result,
                        'fuel_date'=>$diesel_date,
                        'fuel_amount'=>$diesel_amount,
                        'fuel_account_row_id'=>$fuel_account_row_id,
                        'vehicle_type'=>'Lease',
                        'company_id'=>$this->company_id,
                        'created_by'=>$this->employee_id,
                        'created_date_time'=>date('Y-m-d H:i:s'));
                        $fuel_result = $this->own_vehicle_model->addFuel($fuelInfo);

                        $fuelAccountInfo = $this->fuel_model->getFuelAccountInfoById($fuel_account_row_id);
                        $new_account_balance = $fuelAccountInfo->account_balance + $diesel_amount;
                        $fuelAccountInfo = array(
                            'account_balance'=>$new_account_balance,
                            'created_by'=>$this->employee_id, 
                            'created_date_time'=>date('Y-m-d H:i:s'));
                         $this->fuel_model->updateFuelAccount($fuelAccountInfo,$fuel_account_row_id);
                         $fuelExpensesInfo = array(
                            
                            'debit'=>$diesel_amount,
                            'fuel_account_row_id'=>$fuel_account_row_id,
                            'cash_date'=>$diesel_date,
                            'transaction_type'=>'Cash', 
                            'company_id'=>$this->company_id,
                            'vehicle_no' => $vehicle_number,
                            'vehicle_type' => 'Lease',
                            'transport_row_id' => $result,
                            'created_by'=>$this->employee_id, 
                            'created_date_time'=>date('Y-m-d H:i:s')
                        );
                        $this->fuel_model->addFuelExpenses($fuelExpensesInfo);
    
                    }
                    $this->session->set_flashdata('success', 'New Transport created successfully');
                  
                } 
                else {
                    $this->session->set_flashdata('error', 'Transport creation failed');
                }
          
                redirect('transportListing');
            }
        }
    }

    /**
     * This function is used load Transport edit information
     */
    function editTransportPageView($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            if($row_id == null){
                redirect('transportListing');
            }
            $data['vehicles'] = $this->lease_vehicle_model->getAllLeaseVehicles($this->company_id);
            $data['party'] = $this->party_model->getAllParty($this->company_id);
            $data['bank'] = $this->bank_model->getAllBank($this->company_id);
            $data['transportInfo'] = $this->transport_model->getTransportInfoById($row_id);
            $data['getAllPumpInfo'] = $this->fuel_model->getAllPumpInfo($this->company_id);
            $data['ponchClearedBankTotal'] = $this->transport_model->getSumOfPonchClear($row_id, 'Bank');
            $data['ponchClearedCashTotal'] = $this->transport_model->getSumOfPonchClear($row_id, 'Cash');
            $data['transporterInfo'] = $this->transporter_model->getAllTransporters($this->company_id);
            $data['cashAccount'] = $this->cash_account_model->getAllCashAccounts($this->company_id);
            $this->global['pageTitle'] = $this->company_name.' : Edit Transport';
            $this->loadViews("transport/editTransport", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to edit the Transport information
     */
    function updateTransport()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else { 
            $row_id = $this->input->post('row_id');
            $data['transportInfo'] = $this->transport_model->getTransportInfoById($row_id);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('vehicle_number','Vehicle Number','trim|required');
            $this->form_validation->set_rules('party_rowid','Party Name','required');
            $this->form_validation->set_rules('invoice_number','Invoice Number','required');
            $this->form_validation->set_rules('LR_no','LR No','required');
            $this->form_validation->set_rules('bags','Bags','required');
            $this->form_validation->set_rules('mt','mt','required');
            $this->form_validation->set_rules('destination','destination','required');
            $this->form_validation->set_rules('rate','rate','required');
            $this->form_validation->set_rules('amount','amount','required');
            // $this->form_validation->set_rules('loading_charge','loading_charge','required');
            // $this->form_validation->set_rules('unloading_charge','unloading_charge','required');
            $this->form_validation->set_rules('ponch_amount','ponch_amount','required');
            // $this->form_validation->set_rules('roro','roro','required');
            // $this->form_validation->set_rules('narration','narration','required');
            $this->form_validation->set_rules('ponch_pending','ponch_pending','required');
            if($this->form_validation->run() == FALSE)
            {
                $this->editTransportPageView($row_id);
            }else {
                $transporter_id = $this->security->xss_clean($this->input->post('transporter_id'));
                $vehicle_number = $this->security->xss_clean($this->input->post('vehicle_number'));
                $date = $this->security->xss_clean($this->input->post('date'));
                $invoice_number = $this->security->xss_clean($this->input->post('invoice_number'));
                $LR_no = $this->security->xss_clean($this->input->post('LR_no'));
                $party_rowid = $this->security->xss_clean($this->input->post('party_rowid'));
                $bags = $this->security->xss_clean($this->input->post('bags'));
                $mt = $this->security->xss_clean($this->input->post('mt'));
                $destination = $this->security->xss_clean($this->input->post('destination'));
                $rate = $this->security->xss_clean($this->input->post('rate'));
                $amount = $this->security->xss_clean($this->input->post('amount'));
                $cash_account_rowid = $this->security->xss_clean($this->input->post('cash_account_rowid'));
                $firm_name = $this->security->xss_clean($this->input->post('firm_name'));

                $cash_amount = $this->security->xss_clean($this->input->post('cash_amount'));
                $fuel_account_row_id = $this->security->xss_clean($this->input->post('diesel_pump'));
                $diesel_amount = $this->security->xss_clean($this->input->post('diesel_amount'));
                $diesel_date = $this->security->xss_clean($this->input->post('diesel_date'));
                if(empty($diesel_date)){
                    $diesel_date = "NULL";
                } else {
                    $diesel_date = date('Y-m-d',strtotime($diesel_date));
                }
                $discount_amount = $this->security->xss_clean($this->input->post('discount_amount'));
                $loading_charge = $this->security->xss_clean($this->input->post('loading_charge'));
                $unloading_charge = $this->security->xss_clean($this->input->post('unloading_charge'));
                $halt_charge = $this->security->xss_clean($this->input->post('halt_charge'));
                $ponch_amount = $this->security->xss_clean($this->input->post('ponch_amount'));
                $roro = $this->security->xss_clean($this->input->post('roro'));
                $bank_rowid = $this->security->xss_clean($this->input->post('bank_rowid'));
                $party_amount = $this->security->xss_clean($this->input->post('party_amount'));
                $narration = $this->security->xss_clean($this->input->post('narration'));
                $ponch_pending = $this->security->xss_clean($this->input->post('ponch_pending'));
                
               

                $transportInfo = array('vehicle_number'=>$vehicle_number,
                'date'=>date('y-m-d',strtotime($date)), 
                'firm_name'=>$firm_name,
                'invoice_number'=>$invoice_number, 
                'diesel_amount'=>$diesel_amount,
                'diesel_date'=>$diesel_date,
                'transporter_rowid'=>$transporter_id,
                'LR_no'=>$LR_no,
                'party_rowid'=>$party_rowid,'bags'=>$bags,'mt'=>$mt,
                'destination'=>$destination,'cash_amount'=>$cash_amount,
                'rate'=>$rate,'amount'=>$amount,
                'cash_account_rowid'=>$cash_account_rowid,
                'fuel_account_row_id'=>$fuel_account_row_id, 
                'loading_charge'=>$loading_charge,
                'unloading_charge'=>$unloading_charge,
                'halt_charge' => $halt_charge,
                'ponch_amount'=>$ponch_amount,
                'roro'=>$roro,
                'bank_rowid'=>$bank_rowid, 
                'party_amount'=>$party_amount,
                'narration'=>$narration,
                'ponch_pending'=>$ponch_pending,
                'company_id'=>$this->company_id,
                'updated_by'=>$this->employee_id, 
                'updated_date_time'=>date('Y-m-d H:i:s'));

                $result = $this->transport_model->updateTransport($transportInfo,$row_id);
                if($result > 0){
                   
                      
                     //  $result2 = $this->cash_book_model->deleteTransportBook($row_id,$cashBookInfo);
                     $type = 'Cash';
                     $firstRowInfoCash = $this->cash_book_model->getFirstAddedTransportCashInfo($row_id,$type);
                                $cashBookInfo = array(
                                    'comments'=>$narration,
                                    'cash_account_rowid'=>$cash_account_rowid,
                                    'cash_date'=>date('Y-m-d',strtotime($date)), 
                                    'credit'=>$cash_amount,
                                    'updated_by' => $this->employee_id, 
                                    'updated_date_time' => date('Y-m-d H:i:s'));
                            $this->cash_book_model->updateCashExpByRowId($firstRowInfoCash->row_id,$cashBookInfo);
                    $type = 'Bank';
                    $firstRowInfoBank = $this->cash_book_model->getFirstAddedTransportCashInfo($row_id,$type);
                    $bankBookInfo = array(
                        'bank_account_row_id'=>$bank_rowid,
                        'comments'=>$narration,
                        'cash_date'=>date('Y-m-d',strtotime($date)), 
                        'credit'=>$party_amount,
                        'updated_by' => $this->employee_id, 
                        'updated_date_time' => date('Y-m-d H:i:s'));
                    $this->cash_book_model->updateCashExpByRowId($firstRowInfoBank->row_id,$bankBookInfo);
                            //add amount to cash expenses table
                       
                    //     $cashInfo = array('bank_account_row_id'=>$bank_rowid, 
                    //         'credit'=>$party_amount , 
                    //         'cash_date'=>date('Y-m-d',strtotime($date)),
                    //         'transaction_type'=>'Bank', 
                    //         'transport_rowid'=>$row_id, 
                    //         'company_id'=>$this->company_id,
                    //         'created_by'=>$this->employee_id, 
                    //         'created_date_time'=>date('Y-m-d H:i:s'));
                    //   //  $result_bank = $this->cash_book_model->addCashExpenses($cashInfo);
                    
                    //     $cashInfo = array('credit'=>$cash_amount , 
                    //         'cash_account_rowid'=>$cash_account_rowid, 
                    //         'cash_date'=>date('Y-m-d',strtotime($date)),
                    //         'transaction_type'=>'Cash',
                    //         'transport_rowid'=>$row_id,
                    //         'company_id'=>$this->company_id,
                    //         'created_by'=>$this->employee_id, 
                    //         'created_date_time'=>date('Y-m-d H:i:s'));
                        //$result_cash = $this->cash_book_model->addCashExpenses($cashInfo);
                   
                        // update account balance
                        if($data['transportInfo']->cash_account_rowid == $cash_account_rowid){
                            //getting new cash account info
                            $data['cashAccountInfo'] = $this->cash_account_model->getCashAccountInfoById($cash_account_rowid);
                            if(!empty($data['cashAccountInfo'])){
                                $old_cash_balance = $data['cashAccountInfo']->account_balance + $data['transportInfo']->cash_amount;
                                $cash_balance = $old_cash_balance - $cash_amount;
                  
                                $cashAccountInfo = array('account_balance'=> $cash_balance,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                                $cash_account_result = $this->cash_account_model->updateCashAccount($cashAccountInfo,$cash_account_rowid);
                            }
                        }else{
                            //getting old cash account info
                            if(empty($data['transportInfo']->cash_account_rowid)){
                                $data['cashAccountInfo'] = $this->cash_account_model->getCashAccountInfoById($cash_account_rowid);
                                if(!empty($data['cashAccountInfo'])){
                                    $cash_balance = $data['cashAccountInfo']->account_balance - $cash_amount;
                                    
                                    $cashAccountInfo = array('account_balance'=> $cash_balance,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                                    $this->cash_account_model->updateCashAccount($cashAccountInfo,$cash_account_rowid);
                                }
                            }else{
                                $data['cashAccountInfo'] = $this->cash_account_model->getCashAccountInfoById($data['transportInfo']->cash_account_rowid);
                                if(!empty($data['cashAccountInfo'])){
                                    //updating old cash balance to changes account
                                    $old_cash_balance = $data['cashAccountInfo']->account_balance + $data['transportInfo']->cash_amount;
                                    $cashAccountInfo = array('account_balance'=> $old_cash_balance,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                                    $this->cash_account_model->updateCashAccount($cashAccountInfo,$data['transportInfo']->cash_account_rowid);
                                }

                                $data['cashAccountInfoNew'] = $this->cash_account_model->getCashAccountInfoById($cash_account_rowid);
                                if(!empty($data['cashAccountInfoNew'])){
                                    $cash_balance = $data['cashAccountInfoNew']->account_balance - $cash_amount;
                                    $cashAccountInfo = array('account_balance'=> $cash_balance,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                                    $this->cash_account_model->updateCashAccount($cashAccountInfo,$cash_account_rowid);
                                }
                            }
                 
                           
                         
                        }

                        
                        //update fuel info
                     
                        if(!empty($fuel_account_row_id)){
                            if(!empty($data['transportInfo']->fuel_account_row_id)){
                                $fuelInfo = array('vehicle_number'=>$vehicle_number,'transport_rowid'=>$row_id,'fuel_date'=>$diesel_date,'fuel_amount'=>$diesel_amount,'diesel_pump'=>$diesel_pump,
                                'vehicle_type'=>'Lease','company_id'=>$this->company_id,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                                $fuel_result = $this->own_vehicle_model->updateFuel($fuelInfo,$row_id);    
                                $fuelExpensesInfo = array(
                                    'debit'=>$diesel_amount,
                                    'fuel_account_row_id'=>$fuel_account_row_id,
                                    'cash_date'=>$diesel_date,
                                    'transaction_type'=>'Cash', 
                                    'company_id'=>$this->company_id,
                                    'vehicle_no' => $vehicle_number,
                                    'vehicle_type' => 'Lease',
                                    'updated_by'=>$this->employee_id, 
                                    'updated_date_time'=>date('Y-m-d H:i:s')
                                );
                                $this->fuel_model->updateFuelExpensesInTransport($fuelExpensesInfo, $row_id);
            
                            }else{
                                $fuelInfo = array('vehicle_number'=>$vehicle_number,
                                'transport_rowid'=>$row_id,
                                'fuel_date'=>$diesel_date,
                                'fuel_amount'=>$diesel_amount,
                                'fuel_account_row_id'=>$fuel_account_row_id,
                                'vehicle_type'=>'Lease',
                                'company_id'=>$this->company_id,
                                'created_by'=>$this->employee_id,
                                'created_date_time'=>date('Y-m-d H:i:s'));
                                $fuel_result = $this->own_vehicle_model->addFuel($fuelInfo);

                                $fuelExpensesInfo = array(
                                    'debit'=>$diesel_amount,
                                    'fuel_account_row_id'=>$fuel_account_row_id,
                                    'cash_date'=>$diesel_date,
                                    'transaction_type'=>'Cash', 
                                    'company_id'=>$this->company_id,
                                    'vehicle_no' => $vehicle_number,
                                    'vehicle_type' => 'Lease',
                                    'transport_row_id' => $result,
                                    'created_by'=>$this->employee_id, 
                                    'created_date_time'=>date('Y-m-d H:i:s')
                                );
                                $this->fuel_model->addFuelExpenses($fuelExpensesInfo);
                            }
                            
                          
                            if($fuel_account_row_id == $data['transportInfo']->fuel_account_row_id){
                                $fuelAccountInfo = $this->fuel_model->getFuelAccountInfoById($data['transportInfo']->fuel_account_row_id);
                            
                                $old_fuel_balance = $fuelAccountInfo->account_balance - $data['transportInfo']->diesel_amount;
                               
                                $new_account_balance = $old_fuel_balance + $diesel_amount;
                              
                                $fuelAccountInfo = array(
                                    'account_balance'=>$new_account_balance,
                                    'updated_by'=>$this->employee_id, 
                                    'updated_date_time'=>date('Y-m-d H:i:s'));
                                 $this->fuel_model->updateFuelAccount($fuelAccountInfo,$fuel_account_row_id);
                                
                            }else{
                                $fuelAccountInfo = $this->fuel_model->getFuelAccountInfoById($data['transportInfo']->fuel_account_row_id);
                                $old_fuel_balance = $fuelAccountInfo->account_balance - $data['transportInfo']->diesel_amount;
                              
                                $fuelAccountInfo = array(
                                    'account_balance'=>$old_fuel_balance,
                                    'updated_by'=>$this->employee_id, 
                                    'updated_date_time'=>date('Y-m-d H:i:s'));
                                 $this->fuel_model->updateFuelAccount($fuelAccountInfo,$data['transportInfo']->fuel_account_row_id);

                                $fuelAccountInfo_New = $this->fuel_model->getFuelAccountInfoById($fuel_account_row_id);
                                $newFuelBalance = $fuelAccountInfo_New->account_balance + $diesel_amount;
                                $fuelAccountInfoNewArray = array(
                                    'account_balance'=>$newFuelBalance,
                                    'updated_by'=>$this->employee_id, 
                                    'updated_date_time'=>date('Y-m-d H:i:s'));
                                 $this->fuel_model->updateFuelAccount($fuelAccountInfoNewArray,$fuel_account_row_id);
                                 
                            }
                            
                        }else{
                            if(!empty($data['transportInfo']->fuel_account_row_id)){
                                $fuelInfo = array('is_deleted'=>1,
                                'company_id'=>$this->company_id,
                                'updated_by'=>$this->employee_id, 
                                'updated_date_time'=>date('Y-m-d H:i:s'));
                                $fuel_result = $this->own_vehicle_model->updateFuel($fuelInfo,$row_id); 
                                
                                $fuelAccountInfo = $this->fuel_model->getFuelAccountInfoById($data['transportInfo']->fuel_account_row_id);
                                $old_fuel_balance = $fuelAccountInfo->account_balance - $data['transportInfo']->diesel_amount;
                              
                                $fuelAccountInfo = array(
                                    'account_balance'=>$old_fuel_balance,
                                    'updated_by'=>$this->employee_id, 
                                    'updated_date_time'=>date('Y-m-d H:i:s'));
                                 $this->fuel_model->updateFuelAccount($fuelAccountInfo,$data['transportInfo']->fuel_account_row_id);
                                 $fuelExpensesInfo = array('is_deleted'=>1,
                                    'company_id'=>$this->company_id,
                                    'updated_by'=>$this->employee_id, 
                                    'updated_date_time'=>date('Y-m-d H:i:s')
                                );
                                $this->fuel_model->updateFuelExpensesInTransport($fuelExpensesInfo, $row_id);
            
                            }
                        }
                    $this->session->set_flashdata('success', 'Transport updated successfully');
                }
                else{
                    $this->session->set_flashdata('error', 'Transport update failed');
                }
           
                redirect('editTransportPageView/'.$row_id);
            }
        }
    }

/**
     * This function is used to delete the Transport using row_id
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteTransport()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $transportInfo = $this->transport_model->getTransportInfoById($row_id);
            $trans_type = 'Cash';
            $data['cashBookInfo'] = $this->cash_book_model->getCashbookInfoOfTransport($row_id,$trans_type);

            foreach($data['cashBookInfo'] as $cashBook)
            {
                if(!empty($cashBook->cash_account_rowid)){
                    $data['cashAccountInfo'] = $this->cash_account_model->getCashAccountInfoById($cashBook->cash_account_rowid);
                    //update cash balance
                    $cash_balance = $data['cashAccountInfo']->account_balance + $cashBook->credit ;
                    $cashAccountInfo = array('account_balance'=>$cash_balance,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                    $cash_account_result = $this->cash_account_model->updateCashAccount($cashAccountInfo,$cashBook->cash_account_rowid);
               
                }
              
                // $cashInfo = array('debit'=>$cashBook->credit,'cash_account_rowid'=>$cashBook->cash_account_rowid,
                // 'cash_date'=>date('Y-m-d'),'transaction_type'=>'Cash', 
                // 'comments'=>'Cash Reverse Debited ID:'.$row_id.', Reason: Transport Deleted on'.date('d-m-Y'),
                // 'company_id'=>$this->company_id,
                // 'created_by'=>$this->employee_id, 
                // 'created_date_time'=>date('Y-m-d H:i:s'));
                // $cash_expense_result = $this->cash_book_model->addCashExpenses($cashInfo);
            }
            if(!empty($transportInfo->fuel_account_row_id)){
                $fuelAccountInfo = $this->fuel_model->getFuelAccountInfoById($transportInfo->fuel_account_row_id);
                $old_fuel_balance = $fuelAccountInfo->account_balance - $transportInfo->diesel_amount;
                $fuelAccountInfoNew = array(
                    'account_balance'=>$old_fuel_balance,
                    'updated_by'=>$this->employee_id, 
                    'updated_date_time'=>date('Y-m-d H:i:s'));
                $this->fuel_model->updateFuelAccount($fuelAccountInfoNew,$transportInfo->fuel_account_row_id);
                $fuelExpensesInfoNew = array(
                    'is_deleted' => '1',
                    'updated_by'=>$this->employee_id, 
                    'updated_date_time'=>date('Y-m-d H:i:s')
                );
                $this->fuel_model->updateFuelExpensesInTransport($fuelExpensesInfoNew, $row_id);

                
            //delete fuel
            $fuelInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result3 = $this->own_vehicle_model->deleteLeaseFuel($row_id,$fuelInfo);

            }
          
         
           //delete transport
            $transportInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->transport_model->deleteTransport($row_id,$transportInfo);
           
            //delete cashbook info
            $cashBookInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result2 = $this->cash_book_model->deleteTransportBook($row_id,$cashBookInfo);
         
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }
    /**
     * View Transport details based on Transport_id
     *
     */
    public function viewTransport($row_id = null)
    {
        if ($this->isAdmin() == true ) {
            $this->loadThis();
        } else {
            if ($row_id == null) {
                redirect('transportListing');
            }
            $data['transportInfo'] = $this->transport_model->getTransportInfoById($row_id);
            $data['ponchInfo'] = $this->transport_model->getPonchInfoByTransport($row_id);
            $this->global['pageTitle'] = $this->company_name.': View Transport';
            $this->loadViews("transport/viewTransport", $this->global, $data, null);
        }
    } 


    
    public function deletePochInfo()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $ponchInfo = $this->transport_model->getPonchInfoById($row_id);

            if($ponchInfo->type == 'Cash'){
                $data['cashAccountInfo'] = $this->cash_account_model->getCashAccountInfoById($ponchInfo->cash_account_row_id);
                $cash_balance = $data['cashAccountInfo']->account_balance + $ponchInfo->amount;
                $cashAccountInfo = array('account_balance'=>$cash_balance,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                $cash_account_result = $this->cash_account_model->updateCashAccount($cashAccountInfo,$ponchInfo->cash_account_row_id);
            }
            $expnessInfo = array(
                'is_deleted' => 1,
                'updated_by' => $this->employee_id, 
                'updated_date_time' => date('Y-m-d H:i:s')
            );

            $transportInfo = $this->transport_model->getTransportInfoById($ponchInfo->transport_row_id);

            $this->cash_book_model->updatePonchInfoOfCashExp($row_id, $expnessInfo);

           //update transport
            $ponch_amount_new = $transportInfo->ponch_amount + $ponchInfo->amount;
            $transportInfo = array(
            'ponch_amount' => $ponch_amount_new, 
            'updated_by' => $this->employee_id, 
            'ponch_pending' => 'Yes',
            'updated_date_time' => date('Y-m-d H:i:s'));
         
            $this->transport_model->deleteTransport($ponchInfo->transport_row_id,$transportInfo);
            $ponchInfoUpdate = array(
                'is_deleted' => 1,
            );
            $result = $this->transport_model->updatePonchClearInfo($ponchInfoUpdate,$row_id);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }
     /**
     * This function is used toupdate PonchClear details
     */
    function updatePonchClear()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else
            {
                $row_id = $this->security->xss_clean($this->input->post('row_id'));
                
                $data['transportInfo'] = $this->transport_model->getTransportInfoById($row_id);
                $ponch_amount = $this->security->xss_clean($this->input->post('ponch_amount'));
                $ponch_date = $this->security->xss_clean($this->input->post('ponch_date'));
                $comments = $this->security->xss_clean($this->input->post('comments'));
                $ponch_clear_amount_by_bank = $this->security->xss_clean($this->input->post('ponch_clear_amount_by_bank'));
                $ponch_clear_bank_account = $this->security->xss_clean($this->input->post('ponch_clear_bank_account'));
                $ponch_clear_amount_by_cash = $this->security->xss_clean($this->input->post('ponch_clear_amount_by_cash'));
                $ponch_clear_amount_by_fuel = $this->security->xss_clean($this->input->post('ponch_clear_amount_by_fuel'));
                $ponch_clear_cash_account = $this->security->xss_clean($this->input->post('ponch_clear_cash_account'));
                $ponch_clear_fuel_account = $this->security->xss_clean($this->input->post('ponch_clear_fuel_account'));
                $data['cashAccountInfo'] = $this->cash_account_model->getCashAccountInfoById($ponch_clear_cash_account);
                $data['fuelAccountInfo'] = $this->fuel_model->getFuelAccountInfoById($ponch_clear_fuel_account); 
                $ponch_clear_bank_result =  (int)$data['transportInfo']->ponch_amount - (int)$ponch_clear_amount_by_bank;
                $ponch_clear_cash_result = (int)$data['transportInfo']->ponch_amount - (int)$ponch_clear_amount_by_cash;
                $ponch_clear_fuel_result = (int)$data['transportInfo']->ponch_amount - (int)$ponch_clear_amount_by_fuel;
                $ponch_clear_cash_bank_result = (int)$data['transportInfo']->ponch_amount - ((int)$ponch_clear_amount_by_bank +(int)$ponch_clear_amount_by_cash +(int)$ponch_clear_amount_by_fuel);
                $ponch_pending = $this->security->xss_clean($this->input->post('ponch_pending'));
                if(!(empty($ponch_clear_amount_by_bank) && !(empty($ponch_clear_amount_by_cash))&& !(empty($ponch_clear_amount_by_fuel)))){
                    $ponch_clear_bank_amount = (int)$data['transportInfo']->ponch_clear_amount_by_bank + (int)$ponch_clear_amount_by_bank;
                    $ponch_clear_cash_amount = (int)$data['transportInfo']->ponch_clear_amount_by_cash + (int)$ponch_clear_amount_by_cash;
                    $ponch_clear_fuel_amount = (int)$data['transportInfo']->ponch_clear_amount_by_fuel + (int)$ponch_clear_amount_by_fuel;
                    $ponchInfo = array('ponch_clear_amount_by_bank'=>$ponch_clear_bank_amount,'ponch_clear_amount_by_cash'=>$ponch_clear_cash_amount,'ponch_clear_amount_by_fuel'=>$ponch_clear_fuel_amount,'ponch_clear_bank_account'=>$ponch_clear_bank_account,'ponch_clear_cash_account'=>$ponch_clear_cash_account,'ponch_clear_fuel_account'=>$ponch_clear_fuel_account,'ponch_date'=>date('y-m-d',strtotime($ponch_date)),'ponch_pending'=>$ponch_pending,'ponch_amount'=>$ponch_clear_cash_bank_result,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                }
                else if(!(empty($ponch_clear_amount_by_bank)))
                {
                    
                    $ponch_clear_bank_amount =$data['transportInfo']->ponch_clear_amount_by_bank + $ponch_clear_amount_by_bank;
                    $ponchInfo = array('ponch_clear_amount_by_bank'=>$ponch_clear_bank_amount,'ponch_clear_bank_account'=>$ponch_clear_bank_account,'ponch_date'=>date('y-m-d',strtotime($ponch_date)),'ponch_pending'=>$ponch_pending,'ponch_amount'=>$ponch_clear_bank_result,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                }
                else if(!(empty($ponch_clear_amount_by_cash)))
                {
                    $ponch_clear_cash_amount =$data['transportInfo']->ponch_clear_amount_by_cash + $ponch_clear_amount_by_cash;
                    $ponchInfo = array('ponch_clear_amount_by_cash'=>$ponch_clear_cash_amount,'ponch_clear_cash_account'=>$ponch_clear_cash_account,'ponch_date'=>date('y-m-d',strtotime($ponch_date)),'ponch_pending'=>$ponch_pending,'ponch_amount'=>$ponch_clear_cash_result,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                }
                else if(!(empty($ponch_clear_amount_by_fuel)))
                {
                    $ponch_clear_fuel_amount =$data['transportInfo']->ponch_clear_amount_by_fuel + $ponch_clear_amount_by_fuel;
                    $ponchInfo = array('ponch_clear_amount_by_fuel'=>$ponch_clear_fuel_amount,'ponch_clear_fuel_account'=>$ponch_clear_fuel_account,'ponch_date'=>date('y-m-d',strtotime($ponch_date)),'ponch_pending'=>$ponch_pending,'ponch_amount'=>$ponch_clear_fuel_result,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                }
                $result = $this->transport_model->updatePonchClear($ponchInfo,$row_id);
                if($result > 0){
                    if(!empty($ponch_clear_amount_by_bank))
                    {

                    //START adding bank transaction to table
                        $acc_type = $this->bank_model->getBankInfoById($ponch_clear_bank_account);
                        if($acc_type->account_type=='O/D Account'){
                            $transInfo = array(
                                'trans_date'=>date('y-m-d',strtotime($ponch_date)),
                                'bank_name'=>$acc_type->bank_name,
                                'trans_type'=>'CREDIT',
                                'amount'=>$ponch_clear_amount_by_bank,
                                'particular' => $comments,
                                //'particular'=>$data['transportInfo']->vehicle_number.'('.$data['transportInfo']->transporter_name.')',
                                'is_required' => 1,
                                'created_by'=>$this->employee_id, 
                                'created_date_time'=>date('Y-m-d H:i:s'));
                        }else{
                            $transInfo = array(
                                'trans_date'=>date('Y-m-d',strtotime($ponch_date)),
                                'bank_name'=>$acc_type->bank_name,
                                'trans_type'=>'DEBIT',
                                'amount'=>$ponch_clear_amount_by_bank,
                                //'particular'=>$data['transportInfo']->vehicle_number.'('.$data['transportInfo']->transporter_name.')',
                                'particular' => $comments,
                                'is_required' => 1,
                                'created_by'=>$this->employee_id, 
                                'created_date_time'=>date('Y-m-d H:i:s'));
                        }
                        $resultTrans = $this->bank_model->addBankTransaction($transInfo);
                    //END adding bank transaction to table

                        $ponchInfo = array(
                            'transport_row_id'=>$row_id,
                            'date'=>date('y-m-d',strtotime($ponch_date)),
                            'type'=>'Bank',
                            'amount'=>$ponch_clear_amount_by_bank,
                            'bank_account_row_id'=>$ponch_clear_bank_account, 
                        );
                        $row_id_returned = $this->transport_model->addNewPonchClearInfo($ponchInfo);
                    $cashInfo = array('credit'=> $ponch_clear_amount_by_bank, 
                    'bank_account_row_id'=>$ponch_clear_bank_account,
                    'cash_date'=>date('Y-m-d',strtotime($ponch_date)),
                    'transaction_type'=>'Bank',
                    'transport_rowid'=>$row_id, 
                    'comments' => $comments,
                    'company_id'=>$this->company_id,
                    'created_by'=>$this->employee_id, 
                    'ponch_cleared_row_id' => $row_id_returned,
                    'created_date_time'=>date('Y-m-d H:i:s'));
                    $result = $this->cash_book_model->addCashExpenses($cashInfo);
                    }
                    if(!empty($ponch_clear_amount_by_cash))
                    {
                        $ponchInfo = array(
                            'transport_row_id'=>$row_id,
                            'date'=>date('y-m-d',strtotime($ponch_date)),
                            'type'=>'Cash',
                            'amount'=>$ponch_clear_amount_by_cash,
                            'cash_account_row_id'=>$ponch_clear_cash_account, 
                        );
                        $row_id_returned = $this->transport_model->addNewPonchClearInfo($ponchInfo);
                        //update cash balance
                        $account_balance_result =  $data['cashAccountInfo']->account_balance - $ponch_clear_amount_by_cash;
                        $cashAccountInfo = array('account_balance'=>$account_balance_result,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                        $cash_account_result = $this->cash_account_model->updateCashAccount($cashAccountInfo,$ponch_clear_cash_account);
                        
                        $cashInfo = array('credit'=>$ponch_clear_amount_by_cash,
                         'cash_account_rowid'=>$ponch_clear_cash_account, 
                         'cash_date'=>date('Y-m-d',strtotime($ponch_date)),
                         'transaction_type'=>'Cash',
                          'transport_rowid'=>$row_id,
                          'comments' => $comments,
                          'company_id'=>$this->company_id,
                          'ponch_cleared_row_id' => $row_id_returned,
                          'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                        $result = $this->cash_book_model->addCashExpenses($cashInfo);
                    }


////
                    if(!empty($ponch_clear_amount_by_fuel))
                    {
                        $ponchInfo = array(
                            'transport_row_id'=>$row_id,
                            'date'=>date('y-m-d',strtotime($ponch_date)),
                            'type'=>'Fuel',
                            'amount'=>$ponch_clear_amount_by_fuel,
                            'fuel_account_row_id'=>$ponch_clear_fuel_account, 
                        );
                        $row_id_returned = $this->transport_model->addNewPonchClearInfo($ponchInfo);
                        //update fuel balance
                        $account_balance_result =  $data['fuelAccountInfo']->account_balance + $ponch_clear_amount_by_fuel;
                        $fuelAccountInfo = array('account_balance'=>$account_balance_result,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                        $fuel_account_result = $this->fuel_model->updateFuelAccount($fuelAccountInfo,$ponch_clear_fuel_account);
                    
                        $fuelExpensesInfo = array(
                            'credit'=>$ponch_clear_amount_by_fuel,
                            'fuel_account_row_id'=>$ponch_clear_fuel_account,
                            'cash_date'=>date('Y-m-d',strtotime($ponch_date)),
                            'transaction_type'=>'Ponch', 
                            'company_id'=>$this->company_id,
                            'created_by'=>$this->employee_id, 
                            'created_date_time'=>date('Y-m-d H:i:s')
                        );
                        $this->fuel_model->addFuelExpenses($fuelExpensesInfo);
                    }

                    $this->session->set_flashdata('success', 'Ponch Clear Details Updated successfully');
                } else{
                    $this->session->set_flashdata('error', 'Ponch Clear Update failed');
                }
                redirect('transportListing');    
          }
    }

    // Transport Report
    function downloadTransportReport(){
       //print page setup
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
    $this->excel->getActiveSheet()->getPageSetup()->setFitToPage(true);
    $this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
    $this->excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);    
    $fromDate = $this->input->post('from_date');
    $toDate = $this->input->post('to_date');
    $party_name = $this->input->post('party_name');
    $vehicle_number = $this->input->post('vehicle_number');
    $transporter_name = $this->input->post('transporter_name');
    $ponch_pending = $this->input->post('ponch_pending');

    $filter['fromDate'] = $fromDate;
    $filter['toDate'] = $toDate;
    $filter['party_name'] = $party_name;
    $filter['vehicle_number'] = $vehicle_number;
    $filter['transporter_name'] = $transporter_name;
    $filter['ponch_pending'] = $ponch_pending;
    
    $transporterInfo = $this->transport_model->getTransporterReport($filter);
    $styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
    $this->excel->setActiveSheetIndex(0);
    //name the worksheet
    $this->excel->getActiveSheet()->setTitle('KARAVALI worksheet');
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
              
            $this->excel->getActiveSheet()->mergeCells('A1:AD1');
            $this->excel->getActiveSheet()->setCellValue('A1', "KARAVALI TRANSPORT");
            $this->excel->getActiveSheet()->mergeCells('A2:AD2');
            $this->excel->getActiveSheet()->setCellValue('A2', "TRANSPORT REPORT");
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
            $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15);
            $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('A1:AD2')->applyFromArray($OutlineStyle);
            $this->excel->getActiveSheet()->getStyle('A3:AD3')->applyFromArray($OutlineStyle);
              $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
              $this->excel->getActiveSheet()->mergeCells('A3:AD3');
              $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
              $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
              $this->excel->getActiveSheet()->setCellValue('A3', "Date From : ".$fromDate. " To : " .$toDate);
            //   //font bold and text bold
              $this->excel->getActiveSheet()->getStyle('A4:AD4')->getFont()->setBold(true);
             //horizontal and vertical alignment
          $this->excel->getActiveSheet()->getStyle('A4:AD4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $this->excel->getActiveSheet()->getStyle('A4:AD4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
              //set width for cell
              $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
              $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
              $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
              $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
              $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
              $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
              $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
              $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
              $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
              $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
              $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
              $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
              $this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
              $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
              $this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
              $this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(10);
              $this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
              $this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(10);
              $this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(10);
              $this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(10);
              $this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
              $this->excel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
              $this->excel->getActiveSheet()->getColumnDimension('W')->setWidth(35);
              $this->excel->getActiveSheet()->getColumnDimension('X')->setWidth(35);
              $this->excel->getActiveSheet()->getColumnDimension('Y')->setWidth(35);
              $this->excel->getActiveSheet()->getColumnDimension('Z')->setWidth(35);
             
            //   //report Header
              $this->cellColor('A4:AD4', 'D5DBDB');
              $this->excel->getActiveSheet()->getStyle('A4')->applyFromArray($OutlineStyle);
            $this->excel->getActiveSheet()->getStyle('A4:AC4')->applyFromArray($OutlineStyle);
              $this->excel->getActiveSheet()->setCellValue('A4', "Date");
             
              $this->excel->getActiveSheet()->setCellValue('B4', "Firm Name");
              $this->excel->getActiveSheet()->setCellValue('C4', "LR No");
              $this->excel->getActiveSheet()->setCellValue('D4', "Invoice Number");
              $this->excel->getActiveSheet()->setCellValue('E4', "Transporter Name");
              $this->excel->getActiveSheet()->setCellValue('F4', "Vehicle Number");
              $this->excel->getActiveSheet()->setCellValue('G4', "Party Name");
              $this->excel->getActiveSheet()->setCellValue('H4', "Destination");
              $this->excel->getActiveSheet()->setCellValue('I4', "Bags");
              $this->excel->getActiveSheet()->setCellValue('J4', "MT");
              $this->excel->getActiveSheet()->setCellValue('K4', "Rate");
              $this->excel->getActiveSheet()->setCellValue('L4', "Total Amount");
              $this->excel->getActiveSheet()->setCellValue('M4', "Diesel Pump");
              $this->excel->getActiveSheet()->setCellValue('N4', "Diesel Amount");
              $this->excel->getActiveSheet()->setCellValue('O4', "Diesel Date");
            //   $this->excel->getActiveSheet()->setCellValue('O4', "Bank Account");
            //   $this->excel->getActiveSheet()->setCellValue('P4', "Bank amount to party");
            //   $this->excel->getActiveSheet()->setCellValue('Q4', "Cash Account");
            //   $this->excel->getActiveSheet()->setCellValue('R4', "Cash amount to party");
              $this->excel->getActiveSheet()->setCellValue('P4', "Loading Charge");

              $this->excel->getActiveSheet()->setCellValue('Q4', "NEFT Amt");
              $this->excel->getActiveSheet()->setCellValue('R4', "Date");
              $this->excel->getActiveSheet()->setCellValue('S4', "NEFT Name");

              $this->excel->getActiveSheet()->setCellValue('T4', "Ponch Amount");
           //   $this->excel->getActiveSheet()->setCellValue('U4', "Narration");
               $this->excel->getActiveSheet()->setCellValue('U4', "Ponch Cleared Date ");
            //   $this->excel->getActiveSheet()->setCellValue('Z4', "Ponch Cleared Amount By Bank");
            //   $this->excel->getActiveSheet()->setCellValue('AA4', "Ponch Cleared Bank Account");
            //   $this->excel->getActiveSheet()->setCellValue('AB4', "Ponch Cleared Amount By Cash");
            //   $this->excel->getActiveSheet()->setCellValue('AC4',"Ponch Cleared Cash Account");
              $this->excel->getActiveSheet()->setCellValue('V4',"ponch_pending");
            $excel_row = 5;
         
            if(!empty($transporterInfo))
            {
             foreach($transporterInfo as $record)
              {
                if($record->diesel_date == '0000-00-00'){
                    $diesel_date_new = "";
                }else{
                    $diesel_date_new = date('d-m-Y',strtotime($record->diesel_date));
                }

                if($record->ponch_date == '0000-00-00'){
                    $ponch_date = "";
                }else{
                    $ponch_date = date('d-m-Y',strtotime($record->ponch_date));
                }
                //set row height for cell
                //horizontal and vertical alignment
                $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':AD' .$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('A'.$excel_row. ':AD' .$excel_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $this->excel->getActiveSheet()->getRowDimension($excel_row)->setRowHeight(25);
                $this->excel->getActiveSheet()->setCellValue('A'.$excel_row, date('d-m-Y',strtotime($record->date)));
                $this->excel->getActiveSheet()->setCellValue('B'.$excel_row,$record->firm_name);
                $this->excel->getActiveSheet()->setCellValue('C'.$excel_row, $record->LR_no);
                $this->excel->getActiveSheet()->setCellValue('D'.$excel_row, $record->invoice_number);
                $this->excel->getActiveSheet()->setCellValue('E'.$excel_row, $record->transporter_name);
                $this->excel->getActiveSheet()->setCellValue('F'.$excel_row, $record->vehicle_number);
                
                $this->excel->getActiveSheet()->setCellValue('G'.$excel_row, $record->party_name);
                $this->excel->getActiveSheet()->setCellValue('H'.$excel_row, $record->destination);
                $this->excel->getActiveSheet()->setCellValue('I'.$excel_row, $record->bags);
                $this->excel->getActiveSheet()->setCellValue('J'.$excel_row, $record->mt);
                $this->excel->getActiveSheet()->setCellValue('K'.$excel_row, $record->rate);
                $this->excel->getActiveSheet()->setCellValue('L'.$excel_row, $record->amount);
                $this->excel->getActiveSheet()->setCellValue('M'.$excel_row, $record->fuel_account_name);
                $this->excel->getActiveSheet()->setCellValue('N'.$excel_row, $record->diesel_amount);
                $this->excel->getActiveSheet()->setCellValue('O'.$excel_row, $diesel_date_new);

                // $this->excel->getActiveSheet()->setCellValue('O'.$excel_row, $record->bank_name);
                // $this->excel->getActiveSheet()->setCellValue('P'.$excel_row, $record->party_amount);
                // $this->excel->getActiveSheet()->setCellValue('Q'.$excel_row, $record->cash_account_name);
                // $this->excel->getActiveSheet()->setCellValue('R'.$excel_row, $record->cash_amount);
                $this->excel->getActiveSheet()->setCellValue('P'.$excel_row, $record->loading_charge);
                
                $bankInfo = $this->transport_model->getTransportNEFTInfo($record->row_id);
                if(!empty($bankInfo)){
                    $this->excel->getActiveSheet()->setCellValue('Q'.$excel_row, $bankInfo->amt);               
                    $this->excel->getActiveSheet()->setCellValue('R'.$excel_row, $bankInfo->date);
                    $this->excel->getActiveSheet()->setCellValue('S'.$excel_row, $bankInfo->bank_name);    
                }
               
                $this->excel->getActiveSheet()->setCellValue('T'.$excel_row, $record->ponch_amount);
               // $this->excel->getActiveSheet()->setCellValue('U'.$excel_row, $record->narration);
                $this->excel->getActiveSheet()->setCellValue('U'.$excel_row, $ponch_date);

                // $this->excel->getActiveSheet()->setCellValue('Z'.$excel_row, $record->ponch_clear_amount_by_bank);
                // $this->excel->getActiveSheet()->setCellValue('AA'.$excel_row, $record->ponch_clear_bank_account);
                // $this->excel->getActiveSheet()->setCellValue('AB'.$excel_row, $record->ponch_clear_amount_by_cash);
                // $this->excel->getActiveSheet()->setCellValue('AC'.$excel_row, $record->ponch_clear_cash_account);
                $this->excel->getActiveSheet()->setCellValue('V'.$excel_row, $record->ponch_pending);
                $this->excel->getActiveSheet()->getStyle('A5:AD'.$excel_row)->applyFromArray($OutlineStyle);
                $this->excel->getActiveSheet()->getPageSetup()->setPrintArea('A1:AD'.$excel_row);
                $this->excel->getActiveSheet()->getStyle('A1:AD'.$excel_row)->applyFromArray($styleArray);
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

}
?>