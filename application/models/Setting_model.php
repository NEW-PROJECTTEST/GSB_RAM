<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends CI_Model
{


    public function getAllComiteeInfo($company_id) {
        $this->db->from('tbl_committee_role as comitee');
        $this->db->where('comitee.is_deleted', 0);
        $this->db->where('comitee.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllAssetInfo($company_id) {
        $this->db->from('tbl_asset_type as asset');
        $this->db->where('asset.is_deleted', 0);
        $this->db->where('asset.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllRelationshipInfo($company_id) {
        $this->db->from('tbl_relation as relation');
        $this->db->where('relation.is_deleted', 0);
        $this->db->where('relation.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllYearInfo($company_id) {
        $this->db->from('tbl_year as year');
        $this->db->where('year.is_deleted', 0);
        $this->db->where('year.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllSubscriptionInfo($company_id) {
        $this->db->from('tbl_subscription_amount as amount');
        $this->db->where('amount.is_deleted', 0);
        $this->db->where('amount.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
    }

    
    public function getSubscriptionAmountById($row_id,$company_id) {
        $this->db->from('tbl_subscription_amount as amount');
        $this->db->where('amount.is_deleted', 0);
        $this->db->where('amount.row_id',$row_id);
        $this->db->where('amount.company_id',$company_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getIncomeType($company_id) {
        $this->db->from('tbl_income_type as income');
        $this->db->where('income.is_deleted', 0);
        $this->db->where('income.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllGothraInfo($company_id) {
        $this->db->from('tbl_gothra as gothra');
        $this->db->where('gothra.is_deleted', 0);
        $this->db->where('gothra.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllMasaInfo($company_id) {
        $this->db->from('tbl_masa as masa');
        $this->db->where('masa.is_deleted', 0);
        $this->db->where('masa.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllNakshathraInfo($company_id) {
        $this->db->from('tbl_nakshathra as nakshathra');
        $this->db->where('nakshathra.is_deleted', 0);
        $this->db->where('nakshathra.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllTithiInfo($company_id) {
        $this->db->from('tbl_tithi as tithi');
        $this->db->where('tithi.is_deleted', 0);
        $this->db->where('tithi.company_id',$company_id);
        $this->db->order_by('tithi.priority');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllRashiInfo($company_id) {
        $this->db->from('tbl_rashi as rashi');
        $this->db->where('rashi.is_deleted', 0);
        $this->db->where('rashi.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllCommittetypeInfo($company_id) {
        $this->db->from('tbl_committetype as comitee');
        $this->db->where('comitee.is_deleted', 0);
        $this->db->where('comitee.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getAllEventtypeInfo($company_id) {
        $this->db->from('tbl_events as event');
        $this->db->where('event.is_deleted', 0);
        $this->db->where('event.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
    }


    public function addCommitteeRole($committeeRole) {
        $this->db->trans_start();
        $this->db->insert('tbl_committee_role', $committeeRole);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    
    public function addRelation($relationInfo) {
        $this->db->trans_start();
        $this->db->insert('tbl_relation', $relationInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

  
    public function addAsset($assetInfo) {
        $this->db->trans_start();
        $this->db->insert('tbl_asset_type', $assetInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function addYear($yearInfo) {
        $this->db->trans_start();
        $this->db->insert('tbl_year', $yearInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function addSubscriptionAmount($subscriptionInfo) {
        $this->db->trans_start();
        $this->db->insert('tbl_subscription_amount', $subscriptionInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function addIncomeType($typeInfo) {
        $this->db->trans_start();
        $this->db->insert('tbl_income_type', $typeInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function addGothra($gothraRole) {
        $this->db->trans_start();
        $this->db->insert('tbl_gothra', $gothraRole);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function addNakshathra($nakshathraRole) {
        $this->db->trans_start();
        $this->db->insert('tbl_nakshathra', $nakshathraRole);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

  
    public function addMasa($masaRole) {
        $this->db->trans_start();
        $this->db->insert('tbl_masa', $masaRole);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function addTithi($tithiRole) {
        $this->db->trans_start();
        $this->db->insert('tbl_tithi', $tithiRole);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function addRashi($rashiRole) {
        $this->db->trans_start();
        $this->db->insert('tbl_rashi', $rashiRole);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function addCommittetype($committetypeRole) {
        $this->db->trans_start();
        $this->db->insert('tbl_committetype', $committetypeRole);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function addEventtype($eventtypeRole) {
        $this->db->trans_start();
        $this->db->insert('tbl_events', $eventtypeRole);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }


    public function updateRole($committeeRoleInfo, $row_id) {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_committee_role', $committeeRoleInfo);
        return TRUE;
    }

    public function updateRelation($relationInfo, $row_id) {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_relation', $relationInfo);
        return TRUE;
    }

    public function updateAsset($assetInfo, $row_id) {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_asset_type', $assetInfo);
        return TRUE;
    }

    public function updateSubscription($subscriptionInfo, $row_id) {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_subscription_amount', $subscriptionInfo);
        return TRUE;
    }

    public function updateIncomeType($typeInfo, $row_id) {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_income_type', $typeInfo);
        return TRUE;
    }

    public function updateGothra($gothraRoleInfo, $row_id) {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_gothra', $gothraRoleInfo);
        return TRUE;
    }

    public function updateNakshathra($nakshathraRoleInfo, $row_id) {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_nakshathra', $nakshathraRoleInfo);
        return TRUE;
    }

    public function updateMasa($masaRoleInfo, $row_id) {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_masa', $masaRoleInfo);
        return TRUE;
    }

    public function updateTithi($tithiRoleInfo, $row_id) {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_tithi', $tithiRoleInfo);
        return TRUE;
    }

    public function updateRashi($rashiRoleInfo, $row_id) {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_rashi', $rashiRoleInfo);
        return TRUE;
    }

    public function updateCommittetype($committetypeRoleInfo, $row_id) {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_committetype', $committetypeRoleInfo);
        return TRUE;
    }

    public function updateEventtype($eventtypeRoleInfo, $row_id) {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_events', $eventtypeRoleInfo);
        return TRUE;
    }

    public function addOccation($occation) {
        $this->db->trans_start();
        $this->db->insert('tbl_occation', $occation);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function getAllOccationInfo($company_id) {
        $this->db->from('tbl_occation as occation');
        $this->db->where('occation.is_deleted', 0);
        $this->db->where('occation.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function updateOccation($rashiRoleInfo, $row_id) {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_occation', $rashiRoleInfo);
        return TRUE;
    }

    public function updatePaksha($rashiRoleInfo, $row_id) {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_paksha', $rashiRoleInfo);
        return TRUE;
    }

    public function addPaksha($paksha) {
        $this->db->trans_start();
        $this->db->insert('tbl_paksha', $paksha);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function getAllPakshaInfo($company_id) {
        $this->db->from('tbl_paksha as paksha');
        $this->db->where('paksha.is_deleted', 0);
        $this->db->where('paksha.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
    }

    
    public function addExpenseName($expenseInfo) {
        $this->db->trans_start();
        $this->db->insert('tbl_expense_name', $expenseInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function getAllExpenseNameInfo($company_id) {
        $this->db->from('tbl_expense_name as expense');
        $this->db->where('expense.is_deleted', 0);
        $this->db->where('expense.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
    }


    
    public function updateExpenseName($eventtypeRoleInfo, $row_id) {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_expense_name', $eventtypeRoleInfo);
        return TRUE;
    }


    public function addPurpose($seva) {
        $this->db->trans_start();
        $this->db->insert('tbl_purpose', $seva);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }


    public function getAllPurposeInfo($company_id) {
        $this->db->from('tbl_purpose as purpose');
        $this->db->where('purpose.is_deleted', 0);
        $this->db->where('purpose.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
    }

     
    public function updateNakshatraName($nakshatraInfo, $row_id) {
        $this->db->where('row_id', $row_id);
        $this->db->update('tbl_nakshathra', $nakshatraInfo);
        return TRUE;
    }



    public function addDonationType($donation) {
        $this->db->trans_start();
        $this->db->insert('tbl_donation_type', $donation);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function getAllDonationTypeInfo($company_id) {
        $this->db->from('tbl_donation_type as type');
        $this->db->where('type.is_deleted', 0);
        $this->db->where('type.company_id',$company_id);
        $query = $this->db->get();
        return $query->result();
    }

}