<?php 
ini_set('memory_limit', '1024M');
ini_set("pcre.backtrack_limit", "5000000");
ini_set('max_execution_time', -1); 
?>
<style>
.break { page-break-before: always; } 
.break_after { page-break-before: none; } 

table{
    width: 100% !important;
}

u {    
    border-bottom: 2px dotted #00000;
    text-decoration: none;
    font-weight: bold;
    font-family:timesnewroman;
    font-size:16px;
}
/*.border{
    border: 2px solid black;
}*/
.border_full{
    border: 1px solid black;
    
    /* height: 90% !important; */
}
.border_bottom{
    
    border-bottom: 1px solid black;
}
.hr_line{
    margin: 0px;
    color: black;
}

.table_bordered{
    border-collapse: collapse;
}
.table_bordered th,.table_bordered td{
    border-top: 1px solid black;
    
    border-right: 1px solid black;
    padding: 3px;
}

.table_bordered th .border_right_none,.table_bordered td .border_right_none{
    border-right: 1px solid transparent !important;
}


</style>
    <div class="container-fluid " style="padding-right:0px; padding-left:0px;">
        <div class="row" >
            <table style="width: 100%;border-collapse: collapse;">
                <tr>
                    <th style="border: 1px solid black;text-align: center;width: 100px;" colspan="8">Expense Report</th>
                </tr>
                <tr>
                    <th style="border: 1px solid black;text-align: center;">SL No.</th>
                    <th style="border: 1px solid black;text-align: center;">Expense Date</th>
                    <th style="border: 1px solid black;text-align: center;">Event Type</th>
                    <th style="border: 1px solid black;text-align: center;">Committee</th>
                    <th style="border: 1px solid black;text-align: center;">Payment Type</th>
                    <th style="border: 1px solid black;text-align: center;">Expense Name</th>
                    <th style="border: 1px solid black;text-align: center;">Amount</th>
                    <th style="border: 1px solid black;text-align: center;">Notes</th>
                    


                </tr>
                <?php 
                $filter = array();
                $total_amount = 0;

                // $filter = $dt_filter;
                $filter['report_type']= "Asset";
                     if(!empty($expense_fromDate)) {
                    $filter['expense_fromDate']= date('Y-m-d',strtotime($expense_fromDate));
                    }
                    else{
                        $filter['expense_fromDate'] = ''; 
                    }
                    if(!empty($expense_toDate)) {
                    $filter['expense_toDate']=  date('Y-m-d',strtotime($expense_toDate));
                    }
                    else{
                        $filter['expense_toDate']= '';
                    }
                    if($event_type == 'other'){
                    $filter['type_of_expense']= 'Other';
                    }else{
                        $filter['event_type']= $event_type;  
                    }
                    $filter['committee_id']= $committe_id; 

                    $expenseInfo = $expenses_model->getexpensesInfoForReport($filter,$company_id);
                    if(!empty($expenseInfo)){
                       
                        
                        $j=1;

        
                        foreach($expenseInfo as $expense){  
                            $total_amount+= $expense->amount;
                            if($expense->expense_date=="1970-01-01")
                            {
                                $expense_date = '';
                            }
                            else
                            {
                                $expense_date = date('d-m-Y',strtotime($expense->expense_date)) ; 
                            }
                            ?>  
                            <tr>
                            <th style="border: 1px solid black;text-align: center"><?php echo $j++; ?></th>
                            <th style="border: 1px solid black;text-align: center;"><?php echo $expense_date; ?></th>
                            <th style="border: 1px solid black;text-align: center;"><?php echo $expense->event_type; ?></th>
                            <th style="border: 1px solid black;text-align: left;"><?php echo $expense->committee_name; ?></th>
                            <th style="border: 1px solid black;text-align: left;"><?php echo $expense->account_type; ?></th>
                            <th style="border: 1px solid black;text-align: left;"><?php echo $expense->expense_type; ?></th>
                            <th style="border: 1px solid black;text-align: left;"><?php echo $expense->amount; ?></th>
                            <th style="border: 1px solid black;text-align: left;"><?php echo $expense->comments; ?></th>
                            

                            </tr>        
                            <?php        
                        } ?>
                        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td style="padding-top: 20px;font-size:20px;width: 200px;"><b>Total : <?php echo $total_amount ?></b></td></tr>

                <?php    }
                
                ?>
               
            </table>
        </div>
    </div>