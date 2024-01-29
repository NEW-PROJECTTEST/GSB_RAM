<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Billing  extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('billing_model','bill');
        $this->load->model('party_model','party');
        $this->load->model('bank_model');
        $this->isLoggedIn();   
    }

    public function billListing(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      
            $data['bank'] = $this->bank_model->getAllBank($this->company_id);
            $this->global['pageTitle'] = $this->company_name.' :Billing Details';
            $this->loadViews("billing/billListing", $this->global, $data, NULL);
        }
    }

    public function get_bill_list(){
        $draw = intval($this->input->post("draw"));
      $start = intval($this->input->post("start"));
      $length = intval($this->input->post("length"));
        $data_array_new = [];
        $data_array = $this->bill->billListing();
        
        foreach($data_array as $r) {
            $viewButton ='<a class="btn  btn-sm btn-primary" href="'.site_url('printBill/'.$r->row_id).'"title="View"><i class="fa fa-eye"></i></a>';
            $editButton = '<a class="btn  btn-sm btn-info" href="'.site_url('editBill/'.$r->row_id).'"title="Edit"><i class="fas fa-edit"></i></i></a>';
            $deleteButton = '<a class="btn btn-sm btn-danger deleteBill" data-row_id='.$r->row_id.' href="#" title="Delete"><i class="fas fa-trash"></i></a>';
            
            
            $balance = $r->total_amount - $r->paid_amount;
            if($balance>0){
                $pay = '<a class="btn btn-sm btn-warning text-white" href="" data-toggle="modal"
                data-target="#Modal2" onclick="openPayModal('.$r->row_id.')"><i
                class="fa fa-money "></i>Pay</a>';
            }else{
                $pay = '<span class="btn btn-sm btn-success">Paid</span>';
            }
            $data_array_new[] = array(
                date('d-m-Y',strtotime($r->date)),
                $r->party_name,
                $r->bill_no,
                $r->product,
                $r->total_amount,
                number_format($balance,2),
                $pay.' '.$viewButton.' '.$editButton.' '.$deleteButton
            );
        }

        $count = count($data_array);
        $result = array(
            "draw" => $draw,
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            "data" => $data_array_new
        );
        echo json_encode($result);
        exit();
    }

    public function addNewBill(){
        $data['partyInfo'] = $this->party->getAllParty($this->company_id);
        $this->global['pageTitle'] = $this->company_name.' :Add New Bill Details ';
        $this->loadViews("billing/newBill", $this->global, $data, NULL);
    }

    public function addBillToDB(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
                $party_row_id = $this->security->xss_clean($this->input->post('party_row_id'));
                $party_gst = $this->security->xss_clean($this->input->post('party_gst'));
                $party_state_code = $this->security->xss_clean($this->input->post('party_state_code'));
                $date = $this->security->xss_clean($this->input->post('date'));
                $bill_no = $this->security->xss_clean($this->input->post('bill_no'));
                $ref_no = $this->security->xss_clean($this->input->post('ref_no'));
                $product = $this->security->xss_clean($this->input->post('product'));
                $totalAmount = $this->security->xss_clean($this->input->post('totalAmount'));

                $trans_date = $this->security->xss_clean($this->input->post('trans_date'));
                $vehicle = $this->security->xss_clean($this->input->post('vehicle'));
                $lr = $this->security->xss_clean($this->input->post('lr'));
                $invoice = $this->security->xss_clean($this->input->post('invoice'));
                $destination = $this->security->xss_clean($this->input->post('destination'));
                $rate = $this->security->xss_clean($this->input->post('rate'));
                $qty = $this->security->xss_clean($this->input->post('qty'));
                $amount = $this->security->xss_clean($this->input->post('amount'));

                //log_message('debug','aa='.print_r($vehicle,true));

                $billInfo = array(
                    'date'=>date('Y-m-d',strtotime($date)),
                    'party_row_id'=>$party_row_id,
                    'party_gst'=>$party_gst,
                    'party_state_code'=>$party_state_code,
                    'bill_no'=>$bill_no,
                    'ref_no' => $ref_no,
                    'product' => $product,
                    'total_amount' => $totalAmount,
                    'created_by'=>$this->employee_id, 
                    'created_date_time'=>date('Y-m-d H:i:s'));
                $return_id = $this->bill->addBillToDB($billInfo);
                if($return_id > 0){
                    for($i=0;$i<count($trans_date);$i++){
                        $billDetailInfo = array(
                            'bill_row_id' => $return_id,
                            'trans_date' => date('Y-m-d',strtotime($trans_date[$i])),
                            'vehicle' => $vehicle[$i],
                            'lr' => $lr[$i], 
                            'invoice' => $invoice[$i],
                            'destination' => $destination[$i],
                            'rate' => $rate[$i],
                            'qty' => $qty[$i],
                            'amount' => $amount[$i],
                            'created_by'=>$this->employee_id, 
                            'created_date_time'=>date('Y-m-d H:i:s')
                        );
                        $result = $this->bill->addBillDetailToDB($billDetailInfo);
                    }
                } else{
                    $this->session->set_flashdata('error', 'Bill adding failed');
                }
                if($result > 0){
                    $this->session->set_flashdata('success', 'Bill added successfully');
                } else{
                    $this->session->set_flashdata('error', 'Bill adding failed');
                }   
                redirect('billListing');
            }
    }

    public function printBill($row_id){
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            if ($row_id == null) {
                redirect('billListing');
            }
            $data['billInfo'] = $this->bill->getBillInfoById($row_id);
            $data['billDetailInfo'] = $this->bill->getBillDetailsById($row_id);
            $this->global['pageTitle'] = $this->company_name.' :View Bill';
            $this->loadViews("billing/printBill", $this->global, $data, NULL);
        }
    }

    public function deleteBill()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $row_id = $this->input->post('row_id');
            $billInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->bill->updateBill($row_id,$billInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }

    //edit bill page
    function editBill($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            if($row_id == null){
                redirect('billListing');
            }
            $data['partyInfo'] = $this->party->getAllParty($this->company_id);
            $data['billInfo'] = $this->bill->getBillInfoById($row_id);
            $data['billDetailInfo'] = $this->bill->getBillDetailsById($row_id);
            $this->global['pageTitle'] = $this->company_name.' : Edit bill ';
            $this->loadViews("billing/editBill", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to change the bill information
     */
    function updateBill()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else { 
            $this->load->library('form_validation');
            $this->form_validation->set_rules('party_row_id','Party','trim|required|max_length[128]');
            $this->form_validation->set_rules('product','Product','trim|required|max_length[128]');
            $this->form_validation->set_rules('date','Date','trim|required');
            if($this->form_validation->run() == FALSE)
            {
                $this->editBill($row_id);
            }else {
                $row_id = $this->input->post('row_id');
                $party_row_id = $this->security->xss_clean($this->input->post('party_row_id'));
                $party_gst = $this->security->xss_clean($this->input->post('party_gst'));
                $party_state_code = $this->security->xss_clean($this->input->post('party_state_code'));
                $date = $this->security->xss_clean($this->input->post('date'));
                $bill_no = $this->security->xss_clean($this->input->post('bill_no'));
                $ref_no = $this->security->xss_clean($this->input->post('ref_no'));
                $product = $this->security->xss_clean($this->input->post('product'));
                $totalAmount = $this->security->xss_clean($this->input->post('totalAmount'));

                $trans_date = $this->security->xss_clean($this->input->post('trans_date'));
                $vehicle = $this->security->xss_clean($this->input->post('vehicle'));
                $lr = $this->security->xss_clean($this->input->post('lr'));
                $invoice = $this->security->xss_clean($this->input->post('invoice'));
                $destination = $this->security->xss_clean($this->input->post('destination'));
                $rate = $this->security->xss_clean($this->input->post('rate'));
                $qty = $this->security->xss_clean($this->input->post('qty'));
                $amount = $this->security->xss_clean($this->input->post('amount'));

                //log_message('debug','aa='.print_r($vehicle,true));

                $billInfo = array(
                    'date'=>date('Y-m-d',strtotime($date)),
                    'party_row_id'=>$party_row_id,
                    'party_gst'=>$party_gst,
                    'party_state_code'=>$party_state_code,
                    'bill_no'=>$bill_no,
                    'ref_no' => $ref_no,
                    'product' => $product,
                    'total_amount' => $totalAmount,
                    'updated_by'=>$this->employee_id, 
                    'updated_date_time'=>date('Y-m-d H:i:s'));
                $return = $this->bill->updateBill($row_id,$billInfo);
                if($return > 0){
                    $deleted = $this->bill->deleteBillDetails($row_id);
                    if($deleted){
                        for($i=0;$i<count($trans_date);$i++){
                            $billDetailInfo = array(
                                'bill_row_id' => $row_id,
                                'trans_date' => date('Y-m-d',strtotime($trans_date[$i])),
                                'vehicle' => $vehicle[$i],
                                'lr' => $lr[$i], 
                                'invoice' => $invoice[$i],
                                'destination' => $destination[$i],
                                'rate' => $rate[$i],
                                'qty' => $qty[$i],
                                'amount' => $amount[$i],
                                'updated_by'=>$this->employee_id, 
                                'updated_date_time'=>date('Y-m-d H:i:s')
                            );
                            $result = $this->bill->addBillDetailToDB($billDetailInfo);
                        }
                        $this->session->set_flashdata('success', 'Bill Details updated successfully');

                    }else{
                        $this->session->set_flashdata('error', 'Bill Details updation failed');
                    }
                }
                else{
                    $this->session->set_flashdata('error', 'Bill update failed');
                }
                redirect('editBill/'.$row_id);
            }
        }
    }

    function addBillPayment(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }  else {
            $bill_row_id = $this->security->xss_clean($this->input->post('billrowId'));
            $pay_date = $this->security->xss_clean($this->input->post('pay_date'));
            $pay_amount = $this->security->xss_clean($this->input->post('pay_amount'));
            $trans_type = $this->security->xss_clean($this->input->post('tran_type'));
            $bank_row_id = $this->security->xss_clean($this->input->post('bank_row_id'));

            $payInfo = array(
                'trans_date'=>date('Y-m-d',strtotime($pay_date)),
                'bill_row_id'=>$bill_row_id,
                'bank_row_id'=>$bank_row_id,
                'paid_amount'=>$pay_amount,
                'payment_type'=>$trans_type,
                'created_by'=>$this->employee_id, 
                'created_date_time'=>date('Y-m-d H:i:s'));
            $return_id = $this->bill->addBillPayment($payInfo);
            if($return_id > 0){
                if($trans_type=='Bank'){
                    $bankInfo = $this->bank_model->getBankInfoById($bank_row_id);
                    $billInfo = $this->bill->getBillInfoById($bill_row_id);
                    if($bankInfo->account_type=='O/D Account'){
                        $transInfo = array(
                            'trans_date'=>date('Y-m-d',strtotime($pay_date)),
                            'bank_name'=>$bankInfo->bank_name,
                            'trans_type'=>'CREDIT',
                            'amount'=>$pay_amount,
                            'particular'=>'Bill Payment- '.$billInfo->bill_no,
                            'is_required' => 1,
                            'created_by'=>$this->employee_id, 
                            'created_date_time'=>date('Y-m-d H:i:s'));
                    }else{
                        $transInfo = array(
                            'trans_date'=>date('Y-m-d',strtotime($pay_date)),
                            'bank_name'=>$bankInfo->bank_name,
                            'trans_type'=>'DEBIT',
                            'amount'=>$pay_amount,
                            'particular'=>'Bill Payment- '.$billInfo->bill_no,
                            'is_required' => 1,
                            'created_by'=>$this->employee_id, 
                            'created_date_time'=>date('Y-m-d H:i:s'));
                    }
                    $res=$this->bank_model->addBankTransaction($transInfo);
                }
                $this->session->set_flashdata('success', 'Bill Amount paid successfully');
            }else{
                $this->session->set_flashdata('error', 'Bill Amount pay failed');
            }
            redirect('billListing');
        }
    }

}