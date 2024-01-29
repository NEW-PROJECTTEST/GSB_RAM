<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Asset_model extends CI_Model
{
    /**
     * This function is used to get the devotee listing count
     */
    function assetListingCount($searchText = '',$filter='',$company_id)
    {
        $this->db->from('tbl_asset_info as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.asset_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['asset_name'])){
            $likeCriteria = "(BaseTbl.asset_name  LIKE '%".$filter['asset_name']."%')";
            $this->db->where($likeCriteria);
        }
        // if(!empty($filter['row_id'])){
        //     $this->db->where('BaseTbl.row_id', $filter['row_id']);
        // }
        if(!empty($filter['purchase_date'])){
            $this->db->where('BaseTbl.purchase_date', $filter['purchase_date']);
        }
        
        $this->db->where('BaseTbl.company_id',$company_id);
        $this->db->where('BaseTbl.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * This function is used to get the devotee listing count
     */
    function assetListing($searchText = '',$filter='',$company_id, $page, $segment)
    {
        $this->db->select('BaseTbl.row_id, BaseTbl.asset_name, BaseTbl.invoice_no, BaseTbl.purchase_date,BaseTbl.company_id,BaseTbl.purchase_amount,BaseTbl.asset_id');
        $this->db->from('tbl_asset_info as BaseTbl');
        // $this->db->join('tbl_depriciation as dep', 'dep.asset_id = BaseTbl.row_id');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.asset_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($filter['asset_name'])){
            $likeCriteria = "(BaseTbl.asset_name  LIKE '%".$filter['asset_name']."%')";
            $this->db->where($likeCriteria);
        }
        // if(!empty($filter['row_id'])){
        //     $this->db->where('BaseTbl.row_id', $filter['row_id']);
        // }
        if(!empty($filter['purchase_date'])){
            $this->db->where('BaseTbl.purchase_date', $filter['purchase_date']);
        }
       

        $this->db->where('BaseTbl.company_id',$company_id);
        $this->db->where('BaseTbl.is_deleted', 0);
        $this->db->order_by('BaseTbl.row_id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    
     /**
     * This function is used to check whether  id is already exist or not
     */
    // function checkDevoteeIDExists($devotee_id, $row_id = 0)
    // {
    //     $this->db->select("devotee_id");
    //     $this->db->from("tbl_devotee");
    //     $this->db->where("devotee_id", $devotee_id);   
    //     $this->db->where("is_deleted", 0);
    //     if($row_id != 0){
    //         $this->db->where("row_id !=", $row_id);
    //     } 
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    
    /**
     * This function is used to add new devotee to system
     */
    function addAsset($assetInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_asset_info', $assetInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
      /**
     * This function is used to update the devotee information
     */
    function updateAsset($assetInfo, $row_id)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_asset_info', $assetInfo);
        return TRUE;
    }

    /**
     * This function is used to delete the devotee information
     */
    function deleteAsset($row_id, $assetInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_asset_info', $assetInfo);
        return $this->db->affected_rows();
    }

    function deleteDepreciation($row_id, $depreciationInfo)
    {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_depriciation', $depreciationInfo);
        return $this->db->affected_rows();
    }

     /* get devotee information by row_id*/
     function getAssetInfoByEmpId($row_id)
     {
     
        $this->db->select('BaseTbl.row_id, BaseTbl.asset_name, BaseTbl.invoice_no, BaseTbl.purchase_date,BaseTbl.company_id,BaseTbl.purchase_amount,BaseTbl.asset_id,asset.asset_type');
        $this->db->join('tbl_asset_type as asset','asset.row_id = BaseTbl.asset_id','left');
        $this->db->from('tbl_asset_info as BaseTbl'); 
         $this->db->where('BaseTbl.row_id', $row_id);
         $this->db->where('BaseTbl.is_deleted', 0);
         $query = $this->db->get();
         return $query->row();
     }

     function getDepreciationInfoById($row_id)
     {
     
        $this->db->select('BaseTbl.row_id, BaseTbl.depriciation_amount,BaseTbl.year_id,year.year');
        $this->db->join('tbl_year as year','year.row_id = BaseTbl.year_id','left');
         $this->db->from('tbl_depriciation as BaseTbl'); 
         $this->db->where('BaseTbl.asset_id', $row_id);
         $this->db->where('BaseTbl.is_deleted', 0);
         $query = $this->db->get();
         $result = $query->result();        
         return $result;  
          }

     function getDepreciationYearById($row_id)
     {
     
        $this->db->select('BaseTbl.row_id,BaseTbl.year');
         $this->db->from('tbl_year as BaseTbl'); 
         $this->db->where('BaseTbl.row_id', $row_id);
         $this->db->where('BaseTbl.is_deleted', 0);
         $query = $this->db->get();
         return $query->row();
     }

     function getAssetType($company_id)
     {
     
         $this->db->from('tbl_asset_type as asset'); 
         $this->db->where('asset.company_id',$company_id);
         $this->db->where('asset.is_deleted', 0);
         $query = $this->db->get();
         $result = $query->result();        
         return $result;  
   }

   function getDepriciationYear($company_id)
   {
   
       $this->db->from('tbl_year as year'); 
       $this->db->where('year.company_id',$company_id);
       $this->db->where('year.is_deleted', 0);
       $query = $this->db->get();
       $result = $query->result();        
       return $result;  
 }

   
   function getAssetNameById($asset_id)
   {
   
       $this->db->from('tbl_asset_type as asset'); 
       $this->db->where('asset.row_id',$asset_id);
       $this->db->where('asset.is_deleted', 0);
       $query = $this->db->get();
       return $query->row(); 
 }


 function addDepreciation($depreciationInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_depriciation', $depreciationInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function checkDepreciationExists($asset_id)
    {
    
        $this->db->from('tbl_depriciation as dep'); 
        $this->db->where('dep.asset_id', $asset_id);
        $this->db->where('dep.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function updateDepreciation($depreciationInfo,$asset_id)
    {
        $this->db->where('asset_id', $asset_id);
        $this->db->where('is_deleted',0);
        $this->db->update('tbl_depriciation', $depreciationInfo);
        return $this->db->affected_rows();
    }

    function getDepreciationAmountByAsset($row_id){
        $this->db->select_min('depriciation_amount');
        $this->db->from('tbl_depriciation');
        $this->db->where('asset_id',$row_id);
        $this->db->where('is_deleted',0);
        $query = $this->db->get();
        $result = $query->row();        
        return $result->depriciation_amount;
    }

    function totalAssets($company_id)
    {
        $this->db->from('tbl_asset_info as assets');
        $this->db->where('assets.company_id', $company_id);
        $this->db->where('assets.is_deleted', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function assetInfoForReport($filter,$company_id)
    {
        $this->db->select('BaseTbl.row_id, BaseTbl.asset_name, BaseTbl.invoice_no, BaseTbl.purchase_date,BaseTbl.company_id,BaseTbl.purchase_amount,BaseTbl.asset_id');
        $this->db->from('tbl_asset_info as BaseTbl');
        //  $this->db->join('tbl_depriciation as dep', 'dep.asset_id = BaseTbl.row_id');
        
        
        // if(!empty($filter['row_id'])){
        //     $this->db->where('BaseTbl.row_id', $filter['row_id']);
        // }
        

        if(!empty($filter['purchase_fromDate']) && !empty($filter['purchase_toDate'])) {
                 $this->db->where('BaseTbl.purchase_date >=', $filter['purchase_fromDate']);
                 $this->db->where('BaseTbl.purchase_date <=', $filter['purchase_toDate']);
             }
       

        $this->db->where('BaseTbl.company_id',$company_id);
        $this->db->where('BaseTbl.is_deleted', 0);
        $this->db->order_by('BaseTbl.row_id', 'ASEC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
     
}

  