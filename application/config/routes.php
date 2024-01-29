<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = "login";
$route['404_override'] = 'error_404';
$route['translate_uri_dashes'] = FALSE;


/*********** USER DEFINED ROUTES *******************/

$route['loginMe'] = 'login/loginMe';
$route['dashboard'] = 'employee';
$route['logout'] = 'user/logout';

// $route['returnAccessories'] = "user/loginHistoy";
// $route['login-history/(:num)'] = "user/loginHistoy/$1";
// $route['login-history/(:num)/(:num)'] = "user/loginHistoy/$1/$2";

//this route for forgot password
$route['forgotPassword'] = "login/forgotPassword";
$route['resetPasswordUser'] = "login/resetPasswordUser";
$route['resetPasswordConfirmUser'] = "login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "login/resetPasswordConfirmUser/$1";
$route['resetPasswordConfirmUser/(:any)/(:any)'] = "login/resetPasswordConfirmUser/$1/$2";
$route['createPasswordUser'] = "login/createPasswordUser";

//this is route for company profile
$route['addCompanyProfile'] = "companyProfile/addCompanyProfile"; 
$route['addCompanyProfileToDb'] = "companyProfile/addCompanyProfileToDb";
$route['updateCompanyProfile'] = "companyProfile/updateCompanyProfile"; 

//this is route for employee
$route['addEmployeePageView'] = "employee/addEmployeePageView"; 
$route['addEmployee'] = "employee/addEmployee"; 
$route['checkEmployeeIDExists'] = "employee/checkEmployeeIDExists";
$route['employeeListing'] = "employee/employeeListing";  
$route['employeeListing/(:num)'] = "employee/employeeListing/$1"; 
$route['editEmployeePageView'] = "employee/editEmployeePageView";  
$route['editEmployeePageView/(:any)'] = "employee/editEmployeePageView/$1"; 
$route['updateEmployee'] = "employee/updateEmployee"; 
$route['deleteEmployee'] = "employee/deleteEmployee";
$route['profile'] = "employee/profile";
$route['profile/(:any)'] = "employee/profile/$1";
$route['changePassword'] = "employee/changePassword";
$route['changePassword/(:any)'] = "employee/changePassword/$1";

//this route for bank
$route['bankListing'] = "bank/bankListing";  
$route['bankListing/(:num)'] = "bank/bankListing/$1";
$route['getBankDetails'] = "bank/getBankDetails"; 
$route['addBank'] = "bank/addBank";
$route['deleteBank'] = "bank/deleteBank"; 
$route['editBankPageView'] = "bank/editBankPageView";   
$route['editBankPageView/(:num)'] = "bank/editBankPageView/$1";
$route['updateBank'] = "bank/updateBank";
$route['viewBank/(:num)'] = "bank/viewBank/$1";
$route['bankTransactionListing']="bank/bankTransactionListing";
$route['addBankTransaction'] = "bank/addBankTransaction";
$route['getBankTransactionDetails'] = "bank/getBankTransactionDetails"; 
$route['downloadBankTransactionReport'] = "bank/downloadBankTransactionReport";
$route['deleteTransaction'] = "bank/deleteTransaction";
$route['editBankTransaction/(:num)'] = "bank/editBankTransaction/$1";
$route['updateBankTransaction'] = "bank/updateBankTransaction";



//this route for cash ledger
$route['cashLedgerListing'] = "cashLedger/cashLedgerListing";  
$route['cashLedgerListing/(:num)'] = "cashLedger/cashLedgerListing/$1"; 
$route['addCashLedger'] = "cashLedger/addCashLedger";
$route['deleteCashLedger'] = "cashLedger/deleteCashLedger"; 
$route['editCashLedgerPageView'] = "cashLedger/editCashLedgerPageView";   
$route['editCashLedgerPageView/(:num)'] = "cashLedger/editCashLedgerPageView/$1";
$route['updateCashLedger'] = "cashLedger/updateCashLedger";
$route['viewCashLedger/(:num)'] = "cashLedger/viewCashLedger/$1";
$route['getCashLedgerDetails'] = "cashLedger/getCashLedgerDetails"; 
$route['downloadCashLedgerReport'] = "cashLedger/downloadCashLedgerReport"; 


//this route for committee
$route['committeeListing'] = "committee/committeeListing";  
$route['committeeListing/(:num)'] = "committee/committeeListing/$1"; 
$route['addCommittee'] = "committee/addCommittee";
$route['deleteCommittee'] = "committee/deleteCommittee"; 
$route['editCommitteePageView'] = "committee/editCommitteePageView";   
$route['editCommitteePageView/(:num)'] = "committee/editCommitteePageView/$1";
$route['updateCommittee'] = "committee/updateCommittee";
$route['viewCommittee/(:num)'] = "committee/viewCommittee/$1";
$route['getCommitteeDetails'] = "committee/getCommitteeDetails";
// $route['committeeBalPendingListing'] = "committee/committeeBalPendingListing";
// $route['getPendingBalcommitteeDetails'] = "committee/getPendingBalcommitteeDetails";


//this route for Own Vehicle
$route['OwnVehicleListing'] = "ownVehicle/OwnVehicleListing"; 
$route['OwnVehicleListing/(:num)'] = "ownVehicle/OwnVehicleListing/$1"; 
$route['OwnOtherVehicleListing'] = "ownVehicle/OwnOtherVehicleListing"; 
$route['OwnOtherVehicleListing/(:num)'] = "ownVehicle/OwnOtherVehicleListing/$1"; 
$route['OwnSelfVehicleListing'] = "ownVehicle/OwnSelfVehicleListing"; 
$route['OwnSelfVehicleListing/(:num)'] = "ownVehicle/OwnSelfVehicleListing/$1"; 
$route['addOwnVehiclePageView'] = "ownVehicle/addOwnVehiclePageView";
$route['addOwnVehicle'] = "ownVehicle/addOwnVehicle";
$route['deleteOwnVehicle'] = "ownVehicle/deleteOwnVehicle"; 
$route['editOwnVehiclePageView'] = "ownVehicle/editOwnVehiclePageView";   
$route['editOwnVehiclePageView/(:num)'] = "ownVehicle/editOwnVehiclePageView/$1";
$route['updateOwnVehicle'] = "ownVehicle/updateOwnVehicle";
$route['viewOwnVehicle/(:num)'] = "ownVehicle/viewOwnVehicle/$1";
$route['addFuel'] = "ownVehicle/addFuel";
$route['addTrip'] = "ownVehicle/addTrip";
$route['deleteFuel'] = "ownVehicle/deleteFuel";
$route['deleteTrip'] = "ownVehicle/deleteTrip";
$route['addWheelInfo'] = "ownVehicle/addWheelInfo";
$route['deleteWheel'] = "ownVehicle/deleteWheel";
$route['downloadOwnVehicleReport'] = "ownVehicle/downloadOwnVehicleReport";
$route['downloadFuelReport'] = "ownVehicle/downloadFuelReport";
$route['downloadTripReport'] = "ownVehicle/downloadTripReport";
$route['downloadWheelReport'] = "ownVehicle/downloadWheelReport";
$route['downloadFuelTripReport'] = "ownVehicle/downloadFuelTripReport";





//this route for Lease Vehicle
$route['LeaseVehicleListing'] = "leaseVehicle/LeaseVehicleListing";  
$route['LeaseVehicleListing/(:num)'] = "leaseVehicle/LeaseVehicleListing/$1"; 
$route['addLeaseVehiclePageView'] = "leaseVehicle/addLeaseVehiclePageView";
$route['addLeaseVehicle'] = "leaseVehicle/addLeaseVehicle";
$route['deleteLeaseVehicle'] = "leaseVehicle/deleteLeaseVehicle"; 
$route['editLeaseVehiclePageView'] = "leaseVehicle/editLeaseVehiclePageView";   
$route['editLeaseVehiclePageView/(:num)'] = "leaseVehicle/editLeaseVehiclePageView/$1";
$route['updateLeaseVehicle'] = "leaseVehicle/updateLeaseVehicle";
$route['viewLeaseVehicle/(:num)'] = "leaseVehicle/viewLeaseVehicle/$1";
$route['downloadLeaseVehicleReport'] = "leaseVehicle/downloadLeaseVehicleReport";




//this route for Transport
$route['transportListing'] = "transport/transportListing";  
$route['transportListing/(:num)'] = "transport/transportListing/$1"; 
$route['clearPonchTransportListing'] = "transport/clearPonchTransportListing"; 
$route['clearPonchTransportListing/(:num)'] = "transport/clearPonchTransportListing/$1";  
$route['pendingPonchTransportListing'] = "transport/pendingPonchTransportListing";
$route['pendingPonchTransportListing/(:num)'] = "transport/pendingPonchTransportListing/$1";  
$route['addTransportPageView'] = "transport/addTransportPageView";
$route['addTransport'] = "transport/addTransport";
$route['deleteTransport'] = "transport/deleteTransport"; 
$route['editTransportPageView'] = "transport/editTransportPageView";   
$route['editTransportPageView/(:num)'] = "transport/editTransportPageView/$1";
$route['updateTransport'] = "transport/updateTransport";
$route['viewTransport/(:num)'] = "transport/viewTransport/$1";
$route['downloadTransportReport'] = 'transport/downloadTransportReport';
$route['updatePonchClear'] = "transport/updatePonchClear";
$route['deletePochInfo'] = "transport/deletePochInfo";



//this route for Transporter
$route['transporterListing'] = "transporter/transporterListing";  
$route['transporterListing/(:num)'] = "transporter/transporterListing/$1"; 
$route['addTransporterPageView'] = "transporter/addTransporterPageView";
$route['addTransporter'] = "transporter/addTransporter";
$route['deleteTransporter'] = "transporter/deleteTransporter"; 
$route['editTransporterPageView'] = "transporter/editTransporterPageView";   
$route['editTransporterPageView/(:num)'] = "transporter/editTransporterPageView/$1";
$route['updateTransporter'] = "transporter/updateTransporter";
$route['viewTransporter/(:num)'] = "transporter/viewTransporter/$1";
$route['getTransporterDetails'] = "transporter/getTransporterDetails";




//this route for Cash Account
$route['cashAccountListing'] = "cashAccount/cashAccountListing";  
$route['cashAccountListing/(:num)'] = "cashAccount/cashAccountListing/$1"; 
$route['addCashAccountPageView'] = "cashAccount/addCashAccountPageView";
$route['addCashAccount'] = "cashAccount/addCashAccount";
$route['deleteCashAccount'] = "cashAccount/deleteCashAccount"; 
$route['editCashAccountPageView'] = "cashAccount/editCashAccountPageView";   
$route['editCashAccountPageView/(:num)'] = "cashAccount/editCashAccountPageView/$1";
$route['updateCashAccount'] = "cashAccount/updateCashAccount";
$route['viewCashAccount/(:num)'] = "cashAccount/viewCashAccount/$1";
$route['downloadCashAccountReport'] = "cashAccount/downloadCashAccountReport";
$route['addCashDetails'] = "cashAccount/addCashDetails";
$route['deleteCashDetails'] = "cashAccount/deleteCashDetails"; 
$route['downloadCashAccountReport'] = "cashAccount/downloadCashAccountReport"; 
$route['cashTransferPageView'] = "cashAccount/cashTransferPageView";
$route['transferCashDetails'] = "cashAccount/transferCashDetails";
$route['deleteTransferDetails'] = "cashAccount/deleteTransferDetails";


//this route for Cash Book
$route['cashBookListing'] = "cashBook/cashBookListing";  
$route['cashBookListing/(:num)'] = "cashBook/cashBookListing/$1"; 
$route['downloadOverallCashBookReport'] = "cashBook/downloadOverallCashBookReport";
$route['downloadBankReport'] = "cashBook/downloadBankReport";
$route['cashBookReport'] = "cashBook/cashBookReport";

$route['report'] = "report/report";



//fuel account routes
$route['fuelAccountListing'] = "fuel/fuelAccountListing";
$route['fuelAccountListing/(:num)'] = "fuel/fuelAccountListing/$1"; 
$route['addFuelAccount'] = "fuel/addFuelAccount";

$route['addCashToFuelAccount'] = "fuel/addCashToFuelAccount";
$route['editFuelAccountPageView/(:num)'] = "fuel/editFuelAccountPageView/$1";
$route['updateFuelAccount'] = "fuel/updateFuelAccount";
$route['viewFuelAccount/(:num)'] = "fuel/viewFuelAccount/$1";
$route['deleteFuelAccount'] = "fuel/deleteFuelAccount";
$route['fuelBookListing/(:num)'] = "fuel/fuelBookListing/$1";
$route['fuelBookListing'] = "fuel/fuelBookListing";

$route['fuelAccountReport'] = "fuel/fuelAccountReport";
$route['deleteFuelAccountCashInfo'] = "fuel/deleteFuelAccountCashInfo";


//user login report
$route['downloadUserLoginReport'] = 'user/downloadUserLoginReport';


//this route for customer
$route['addCustomerPageView'] = "customer/addCustomerPageView";
$route['addCustomer'] = "customer/addCustomer";
$route['customerListing'] = "customer/customerListing";  
$route['customerListing/(:num)'] = "customer/customerListing/$1";
$route['editCustomerPageView'] = "customer/editCustomerPageView";
$route['editCustomerPageView/(:num)'] = "customer/editCustomerPageView/$1"; 
$route['updateCustomer'] = "customer/updateCustomer";
$route['deleteCustomer'] = "customer/deleteCustomer";
$route['viewCustomer/(:num)'] = "customer/viewCustomer/$1";

//indent generation
$route['generateIndent'] = "customer/generateIndent";
$route['viewIdent'] = "customer/viewIdent";
$route['viewIdentData'] = "customer/viewIdentData";
$route['viewSingleIdent/(:num)'] = "customer/viewSingleIdent/$1";

$route['editIndentInfo/(:num)'] = "customer/editIndentInfo/$1";
$route['updateIndent'] = "customer/updateIndent";
$route['deleteIndent'] = "customer/deleteIndent";

//billing 
$route['billListing'] = 'billing/billListing';
$route['get_bill_list'] = 'billing/get_bill_list';
$route['addNewBill'] = 'billing/addNewBill';
$route['addBillToDB'] = 'billing/addBillToDB';
$route['printBill/(:num)'] = 'billing/printBill/$1';
$route['deleteBill'] = 'billing/deleteBill';
$route['updateBill'] = 'billing/updateBill';
$route['editBill/(:num)'] = 'billing/editBill/$1';
$route['addBillPayment'] = 'billing/addBillPayment';

//devotee
$route['addDevoteePageView'] = "devotee/addDevoteePageView"; 
$route['addDevotee'] = "devotee/addDevotee"; 
$route['checkDevoteeIDExists'] = "devotee/checkDevoteeIDExists";
$route['devoteeListing'] = "devotee/devoteeListing";  
$route['devoteeListing/(:num)'] = "devotee/devoteeListing/$1"; 
$route['editDevoteePageView'] = "devotee/editDevoteePageView";  
$route['editDevoteePageView/(:any)'] = "devotee/editDevoteePageView/$1"; 
$route['updateDevotee'] = "devotee/updateDevotee"; 
$route['deleteDevotee'] = "devotee/deleteDevotee";

//family
 $route['addFamily'] = "family/addFamily"; 
$route['familyListing'] = "family/familyListing"; 
$route['editFamilyPageView/(:any)'] = "family/editFamilyPageView/$1"; 
$route['updateFamily'] = "family/updateFamily"; 
$route['deleteFamily'] = "family/deleteFamily";

//settings
$route['settings'] = "setting/viewSettings";
$route['addCommitteeRole'] = "setting/addCommitteeRole";
$route['addRelationInfo'] = "setting/addRelationInfo";
$route['addAsset'] = 'setting/addAsset';
$route['addyear'] = "setting/addyear";
$route['addSubscriptionAmount'] = "setting/addSubscriptionAmount";
$route['addIncomeType'] = "setting/addIncomeType";
$route['addGothra'] = 'setting/addGothra';
$route['addNakshathra'] = 'setting/addNakshathra';
$route['addMasa'] = 'setting/addMasa';
$route['addTithi'] = 'setting/addTithi';
$route['addRashi'] = 'setting/addRashi';
$route['addCommittetype'] ='setting/addCommittetype';
$route['addEvents'] = 'setting/addEvents';
$route['addExpenseName'] = 'setting/addExpenseName';

$route['addOccation'] = 'setting/addOccation';
$route['addPaksha'] = 'setting/addPaksha';

$route['deleteRole'] = "setting/deleteRole";
$route['deleteRelation'] = "setting/deleteRelation";
$route['deleteAsset'] = "setting/deleteAsset";
$route['deleteYearInfo'] = "setting/deleteYearInfo";
$route['deleteSubscriptionInfo'] = "setting/deleteSubscriptionInfo";
$route['deleteIncomeType'] = "setting/deleteIncomeType";
$route['deleteGothra'] = 'setting/deleteGothra';
$route['deleteNakshathra'] = 'setting/deleteNakshathra';
$route['deleteMasa'] = 'setting/deleteMasa';
$route['deleteTithi'] = 'setting/deleteTithi';
$route['deleteRashi'] = 'setting/deleteRashi';
$route['deleteCommittetype'] = 'setting/deleteCommittetype';
$route['deleteEventtype'] = 'setting/deleteEventtype';
$route['deleteOccation'] = 'setting/deleteOccation';
$route['deletePaksha'] = 'setting/deletePaksha';
$route['deleteExpenseName'] = 'setting/deleteExpenseName';


//Assets
$route['assetListing/(:num)'] = "asset/assetListing/$1"; 
$route['assetListing'] = "asset/assetListing";
$route['addAsset'] = "asset/addAsset";
$route['editAssetView'] = "asset/editAssetView";  
$route['editAssetView/(:any)'] = "asset/editAssetView/$1"; 
$route['updateAsset'] = "asset/updateAsset";
$route['deleteAssetInfo'] = "asset/deleteAsset";
$route['deleteDepreciationInfo'] = "asset/deleteDepreciationInfo";

$route['editFamilyPageView/(:any)'] = "family/editFamilyPageView/$1";  
$route['updateFamily'] = "family/updateFamily"; 
$route['deleteFamily'] = "family/deleteFamily";
$route['addDepriciation'] = "asset/addDepriciation";
$route['updateDepreciation'] = "asset/updateDepreciation";


//Expenses
$route['expenseListing/(:num)'] = "expenses/expenseListing/$1"; 
$route['expenseListing'] = "expenses/expenseListing";
$route['addExpenses'] = "expenses/addExpenses";
$route['updateExpense'] = "expenses/updateExpense";
$route['editExpensePageView'] = "expenses/editExpensePageView";  
$route['editExpensePageView/(:any)'] = "expenses/editExpensePageView/$1"; 
$route['deleteExpense'] = "expenses/deleteExpense";



//this route for party
$route['partyListing'] = "party/partyListing";  
$route['partyListing/(:num)'] = "party/partyListing/$1"; 
$route['addParty'] = "party/addParty";
$route['deleteParty'] = "party/deleteParty"; 
$route['editPartyPageView'] = "party/editPartyPageView";   
$route['editPartyPageView/(:num)'] = "party/editPartyPageView/$1";
$route['updateParty'] = "party/updateParty";
$route['viewParty/(:num)'] = "party/viewParty/$1";
$route['getPartyDetails'] = "party/getPartyDetails";

//subscription
$route['addSubscription'] = "subscription/addSubscription";
$route['addSubscriptionByFamilyID'] = "subscription/addSubscriptionByFamilyID";
$route['subscriptionListing'] = "subscription/subscriptionListing";
$route['getSubscriptionInfo'] = "subscription/getSubscriptionInfo";
$route['deleteSubscription'] = "subscription/deleteSubscription";
$route['updateSubscription'] = "subscription/updateSubscription";
$route['getSubscriptionAmtByFamId'] = "subscription/getSubscriptionAmtByFamId";

//reports
$route['downloadAssetReport'] = "report/downloadAsset";
$route['downloadCommitteeReport'] = "report/downloadCommitteeReport";
$route['downloadDevoteeReport'] = 'report/downloadDevotee';
$route['downloadBankTReport'] = 'report/downloadBank';
$route['downloadDailyPoojaReport'] = "report/downloadDailyPoojaReport";
$route['downloadDailyPoojaMonthWiseReport'] = "report/downloadDailyPoojaMonthWiseReport";
$route['downloadPanchangaPoojaReport'] = "report/downloadPanchangaPoojaReport";

//income
$route['getIncomeInfo'] = "income/getIncomeInfo";
$route['incomeListing'] = "income/incomeListing";
$route['addIncomeInfo'] = "income/addIncomeInfo";
$route['updateIncome'] = "income/updateIncome";
$route['deleteIncome'] = "income/deleteIncome";
$route['editIncomePageView/(:num)'] = "income/editIncomePageView/$1";



//Events
$route['eventListing'] = "Event/eventListing";  
$route['eventListing/(:num)'] = "Event/eventListing/$1"; 
$route['getEventDetails'] = "Event/getEventDetails";
$route['addEventDate'] = "Event/addEventDate";
$route['editEvent'] = "Event/editEvent";   
$route['editEvent/(:num)'] = "Event/editEvent/$1";
$route['updateEvent'] = "Event/updateEvent";
$route['deleteEvent'] = "Event/deleteEvent"; 



//DailyPooja
$route['DailyPoojaListing'] = "DailyPooja/DailyPoojaListing";  
$route['DailyPoojaDetails'] = "DailyPooja/getDailyPoojaDetails";
$route['addDailyPooja'] = "DailyPooja/addDailyPooja";
$route['editDailyPooja'] = "DailyPooja/editDailyPooja";   
$route['editDailyPooja/(:num)'] = "DailyPooja/editDailyPooja/$1";
$route['updateDailyPooja'] = "DailyPooja/updateDailyPooja";
$route['deleteDailyPooja'] = "DailyPooja/deleteDailyPooja";

$route['PanchangaPoojaListing'] = "DailyPooja/PanchangaPoojaListing";  
$route['PanchangaPoojaDetails'] = "DailyPooja/getPanchangaPoojaDetails";


$route['editPanchangaPooja'] = "DailyPooja/editPanchangaPooja";   
$route['editPanchangaPooja/(:num)'] = "DailyPooja/editPanchangaPooja/$1";

// Daily Details
$route['dailyDetailsListing'] = "DailyDetails/dailyDetailsListing";  
$route['dailyDetailsListing/(:num)'] = "DailyDetails/dailyDetailsListing/$1"; 
$route['getDailyDetails'] = "DailyDetails/getDailyDetails";
$route['addDailyDetails'] = "DailyDetails/addDailyDetails";
$route['deleteDailyDetails'] = "DailyDetails/deleteDailyDetails";
$route['editDailyDetails'] = 'DailyDetails/editDailyDetails';
$route['editDailyDetails/(:num)'] = 'DailyDetails/editDailyDetails/$1';
$route['updateDailyDetails'] = 'DailyDetails/updateDailyDetails';
$route['addDetails'] = 'DailyDetails/addDetails';
$route['Employeeindex'] = 'employee/index';


$route['viewDailyPooja/(:num)'] = "DailyPooja/viewDailyPooja/$1";
$route['viewPanchangaPooja/(:num)'] = "DailyPooja/viewPanchangaPooja/$1";

$route['puFeePaymentReceiptPrint/(:any)'] = "DailyPooja/feePaymentReceiptPrint/$1";
$route['panchangaReceiptPrint/(:any)'] = "DailyPooja/panchangaReceiptPrint/$1";

$route['donationListing'] = "DailyPooja/donationListing";  
$route['donationListing/(:num)'] = "DailyPooja/donationListing/$1";
$route['addDonationDetails'] = "DailyPooja/addDonationDetails";
$route['deleteDonationDetail'] = 'DailyPooja/deleteDonationDetail';
$route['donationReceiptPrint/(:any)'] = "DailyPooja/donationReceiptPrint/$1";
$route['addSevaDetails'] = "DailyPooja/addSevaDetails";

$route['addPurpose'] = 'setting/addPurpose';


$route['downloadExpenseReport'] = "report/downloadExpenseReport";
$route['downloadDonationReport'] = "report/downloadDonationReport";
$route['deletePurpose'] = 'DailyPooja/deletePurpose';

$route['sevaListing'] = "DailyPooja/sevaListing";  
$route['sevaListing/(:num)'] = "DailyPooja/sevaListing/$1";

$route['deleteSevaDetail'] = 'DailyPooja/deleteSevaDetail';


$route['editSevaPageView'] = "DailyPooja/editSevaDetail";  
$route['editSevaPageView/(:any)'] = "DailyPooja/editSevaDetail/$1"; 

$route['updateSevaDetails'] = "DailyPooja/updateSevaDetails";  

$route['editDonationView'] = "DailyPooja/editDonationView";  
$route['editDonationView/(:any)'] = "DailyPooja/editDonationView/$1"; 

$route['updateDonationDetails'] = "DailyPooja/updateDonationDetails";  

$route['updateNakshathra'] = "setting/updateNakshathra";  

$route['updateGothra'] = "setting/updateGothra";  

$route['updateMasa'] = "setting/updateMasa";  

$route['updateRashi'] = "setting/updateRashi"; 

$route['getSevaInfoByDonationId'] = 'DailyPooja/getSevaInfoByDonationId';


$route['addDonationType'] = 'setting/addDonationType';

$route['deleteDonationType'] = 'DailyPooja/deleteDonationType';
