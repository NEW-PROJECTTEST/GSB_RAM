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
                    <th style="border: 1px solid black;text-align: center;width: 100px;" colspan="13">DATE POOJA MONTH WISE REPORT</th>
                </tr>
                <tr>
                    <th style="border: 1px solid black;text-align: center;">SL. NO.</th>
                    <th style="border: 1px solid black;text-align: center;">Receipt No.</th>
                    <th style="border: 1px solid black;text-align: center;">Seva By</th>
                    <th style="border: 1px solid black;text-align: center;">Pooja Type</th>
                    <th style="border: 1px solid black;text-align: center;">Date</th>
                    <th style="border: 1px solid black;text-align: center;">Nakshatra</th>
                    <th style="border: 1px solid black;text-align: center;">Rashi</th>
                    <th style="border: 1px solid black;text-align: center;">Gothra</th>
                    <th style="border: 1px solid black;text-align: center;">Occasion</th>
                    <th style="border: 1px solid black;text-align: center;">Remarks</th>
                    <th style="border: 1px solid black;text-align: center;">Amount</th>


                </tr>
                <?php 
                $filter = array();
                $filter = $dt_filter;
                    $poojaInfo = $DailyPooja_model->getDPDetailsMonthForReport($pooja_month,$filter);
                    if(!empty($poojaInfo)){
                       
                        
                        $j=1;
        
                        foreach($poojaInfo as $pooja){  
                            if(empty($pooja->date) || $pooja->date == '1970-01-01'){
                                $event_date = '';
                              }else{
                                  $event_date = $pooja->date.'-'.date('Y');       
                              }
                            ?>  
                            <tr>
                            <th style="border: 1px solid black;text-align: center"><?php echo $j++; ?></th>
                            <th style="border: 1px solid black;text-align: center;"><?php echo $pooja->row_id; ?></th>
                            <th style="border: 1px solid black;text-align: center;"><?php echo $pooja->devotee_name; ?></th>
                            <th style="border: 1px solid black;text-align: left;"><?php echo $pooja->event_type; ?></th>
                            <th style="border: 1px solid black;text-align: left;"><?php echo $event_date; ?></th>
                            <th style="border: 1px solid black;text-align: left;"><?php echo $pooja->nakshathra; ?></th>
                            <th style="border: 1px solid black;text-align: left;"><?php echo $pooja->rashi; ?></th>
                            <th style="border: 1px solid black;text-align: left;"><?php echo $pooja->gothra; ?></th>
                            <th style="border: 1px solid black;text-align: left;"><?php echo $pooja->occation; ?></th>
                            <th style="border: 1px solid black;text-align: left;"><?php echo $pooja->remarks; ?></th>
                            <th style="border: 1px solid black;text-align: left;"><?php echo $pooja->amount; ?></th>

                            </tr>        
                            <?php        
                        }
                    }
                
                ?>
               
            </table>
        </div>
    </div>