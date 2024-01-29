<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Asset extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('asset_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the devotee
     */
    
    /**
     * This function is used to load the  devotee list
     */
    function assetListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {      
            // $devotee_id = $this->security->xss_clean($this->input->post('devotee_id'));  
            $asset_name = $this->security->xss_clean($this->input->post('asset_name'));
            $purchase_date = $this->security->xss_clean($this->input->post('purchase_date'));

            // $data['devotee_id'] = $devotee_id;
            $data['asset_name'] = $asset_name;
            $data['purchase_date'] = $purchase_date;
            // $filter['devotee_id'] = $devotee_id;
            $filter['asset_name'] = $asset_name;
            $filter['purchase_date'] = $purchase_date;

            if(!empty($purchase_date)){
                $filter['purchase_date'] = date('Y-m-d',strtotime($purchase_date));
                $data['purchase_date'] = date('d-m-Y',strtotime($purchase_date));
            }else{
                $data['purchase_date'] = '';
            }
           
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            $data['assetTypeInfo'] =$this->asset_model->getAssetType($this->company_id);
            $data['depriciationYearInfo'] =$this->asset_model->getDepriciationYear($this->company_id);
            $this->load->library('pagination');
            $count = $this->asset_model->assetListingCount($searchText,$filter,$this->company_id);
            $data['count'] =  $count;
            $data['model'] = $this->asset_model;
			$returns = $this->paginationCompress ( "assetListing/", $count, 100 );
            $data['assetRecords'] = $this->asset_model->assetListing($searchText,$filter,$this->company_id, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = $this->company_name.' :asset Details ';
            $this->loadViews("asset/asset", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
   

    /**
     * This function is used to add new  devotee to the system
     */
    function addAsset()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else {
            // $this->form_validation->set_rules('devotee_id','devotee ID','required');
            // $this->form_validation->set_rules('devotee_name','Full Name','trim|required|max_length[128]');
            // $this->form_validation->set_rules('dob','Dob','required');
            // $this->form_validation->set_rules('gender','Gender','required');
            // $this->form_validation->set_rules('contact_number','Contact Number','required|min_length[10]');
            // $this->form_validation->set_rules('devotee_address','Address','required');
        
                
                // $devotee_id = $this->security->xss_clean($this->input->post('devotee_id'));
                $asset_name = ucwords(strtolower($this->security->xss_clean($this->input->post('asset_name'))));
                $purchase_date = $this->input->post('purchase_date');
               $purchased_date= date('y-m-d',strtotime($purchase_date));
                log_message('debug','date='.$purchased_date);
                $purchase_amount = $this->input->post('purchase_amount');
                $invoice_no = $this->input->post('invoice_no');
                $asset_id= $this->input->post('asset_type');
                    $assetInfo = array('asset_name'=>$asset_name,'asset_id'=>$asset_id,'purchase_date'=>$purchased_date,'purchase_amount'=>$purchase_amount,
                    'invoice_no'=>$invoice_no, 'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                   
                $result = $this->asset_model->addAsset($assetInfo);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Asset created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Asset creation failed');
                }
                redirect('assetListing');
            
        }
    }

    /**
     * This function is used load devotee edit form
     */
    function editAssetView($row_id = NULL)
    {
        if($this->isAdmin() == TRUE) {
            $this->loadThis();
        } else {
            if($row_id == null){
                redirect('assetListing');
            }
            $data['assetTypeInfo'] =$this->asset_model->getAssetType($this->company_id);
            $data['assetInfo'] = $this->asset_model->getAssetInfoByEmpId($row_id);
            $data['depreciationInfo'] = $this->asset_model->getDepreciationInfoById($row_id);
            // $depreciationInfo = $this->asset_model->getDepreciationInfoById($row_id);
            $this->global['pageTitle'] = $this->company_name.' : Edit asset ';
            $this->loadViews("asset/editAsset", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the devotee information
     */
    function updateAsset()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {
            $row_id = $this->input->post('row_id');
            // $devotee_id = $this->input->post('devotee_id');
            
                $asset_name = ucwords(strtolower($this->security->xss_clean($this->input->post('asset_name'))));
                $purchase_date = $this->input->post('purchase_date');
                $purchase_amount = $this->input->post('purchase_amount');
                $invoice_no = $this->input->post('invoice_no');
                $asset_id= $this->input->post('asset_type');
                $assetInfo = array();

                $assetInfo = array('asset_name'=>$asset_name,'asset_id'=>$asset_id,'purchase_date'=>date('y-m-d',strtotime($purchase_date)),'purchase_amount'=>$purchase_amount,
                'invoice_no'=>$invoice_no, 'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s'));
                $result = $this->asset_model->updateAsset($assetInfo,$row_id);
                if($result > 0){
                    $this->session->set_flashdata('success', 'New Asset updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'asset update failed');
                }
                redirect('editAssetView/'.$row_id);
            }
        
    }

    
    /**
     * This function is used to check whether devotee id already exist or not
     */
   
  
  /**
     * This function is used to delete the devotee using devotee_id
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteAsset()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $asset_id = $this->input->post('row_id');
            log_message('debug','assetid='.  $asset_id );
            $assetInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->asset_model->deleteAsset($asset_id,$assetInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }

    public function deleteDepreciationInfo()
    {
        if ($this->isAdmin() == true) {
            echo (json_encode(array('status' => 'access')));
        } else {
            $depreciation_id = $this->input->post('row_id');
            log_message('debug','assetid='.  $depreciation_id );
            $depreciationInfo = array('is_deleted' => 1, 'updated_by' => $this->employee_id, 'updated_date_time' => date('Y-m-d H:i:s'));
            $result = $this->asset_model->deleteDepreciation($depreciation_id,$depreciationInfo);
            if ($result > 0) {echo (json_encode(array('status' => true)));} else {echo (json_encode(array('status' => false)));}
        }
    }

 
    function addDepriciation()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else {
            // $this->form_validation->set_rules('devotee_id','devotee ID','required');
            // $this->form_validation->set_rules('devotee_name','Full Name','trim|required|max_length[128]');
            // $this->form_validation->set_rules('dob','Dob','required');
            // $this->form_validation->set_rules('gender','Gender','required');
            // $this->form_validation->set_rules('contact_number','Contact Number','required|min_length[10]');
            // $this->form_validation->set_rules('devotee_address','Address','required');
        
                
                // $devotee_id = $this->security->xss_clean($this->input->post('devotee_id'));
            
                $depriciation_amount = $this->input->post('depriciation_amount');
                $depriciation_year = $this->input->post('depriciation_year');
                $asset_id= $this->input->post('asset_id');
                // $exist = $this->asset_model->checkDepreciationExists($asset_id);
                

                    // $depreciationInfo = array('depriciation_amount'=>$depriciation_amount,'asset_id'=>$asset_id,'year_id'=>$depriciation_year,
                    //  'company_id'=>$this->company_id,'updated_by'=>$this->employee_id, 'updated_date_time'=>date('Y-m-d H:i:s'));
                        
                    $depreciationInfo = array('depriciation_amount'=>$depriciation_amount,'asset_id'=>$asset_id,'year_id'=>$depriciation_year,
                     'company_id'=>$this->company_id,'created_by'=>$this->employee_id, 'created_date_time'=>date('Y-m-d H:i:s')); 
                     $result = $this->asset_model->addDepreciation($depreciationInfo);
                
                if($result > 0){
                    $this->session->set_flashdata('success', 'Depreciation Added successfully');
                } else {
                    $this->session->set_flashdata('error', 'Depreciation creation failed');
                }
                redirect('assetListing');
            
        }
    }
    
}


?>