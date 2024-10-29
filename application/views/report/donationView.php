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
                    <th style="border: 1px solid black;text-align: center;width: 100px;" colspan="12">DONATION/SEVA REPORT</th>
                </tr>
                <tr>
                    <th style="border: 1px solid black;text-align: center;width: 100px;">SL. NO.</th>
                    <th style="border: 1px solid black;text-align: center;width: 130px;">RECEIPT NO.</th>
                    <th style="border: 1px solid black;text-align: center;width: 130px;">DATE</th>
                    <th style="border: 1px solid black;text-align: center;width: 130px;">NAME</th>
                    <!-- <th style="border: 1px solid black;text-align: center;width: 100px;">EMAIL</th> -->
                    <th style="border: 1px solid black;text-align: center;width: 100px;">ADDRESS</th>
                    <!-- <th style="border: 1px solid black;text-align: center;width: 100px;">NOTE</th> -->
                    <th style="border: 1px solid black;text-align: center;width: 100px;">COLLECTED BY</th>
                    <th style="border: 1px solid black;text-align: center;width: 60px;">TYPE</th>
                    <th style="border: 1px solid black;text-align: center;width: 130px;">PURPOSE</th>
                    <th style="border: 1px solid black;text-align: center;width: 100px;">SEVA</th>
                    <th style="border: 1px solid black;text-align: center;width: 100px;">DONATION TYPE</th>
                    <th style="border: 1px solid black;text-align: center;width: 60px;">PAYMENT TYPE</th>
                    <th style="border: 1px solid black;text-align: center;width: 60px;">AMOUNT</th>

                    <!-- <th style="text-align: center;width: 200px;"></th> -->

                </tr>
                <?php 
                $filter = array();
                $filter = $dt_filter;
                $total_amount = 0;
                    $donationInfo = $DailyPooja_model->donationInfoForReport($filter,$company_id);
                    if(!empty($donationInfo)){
                        $j=1;
                       

                        foreach($donationInfo as $donation){  
                            $total_amount+= $donation->amount;
                            if($donation->date=="1970-01-01")
                            {
                                $donation_date = '';
                            }
                            else
                            {
                                $donation_date = date('d-m-Y',strtotime($donation->date)); 
                            }
                            ?>  
                            <tr>
                            <th style="border: 1px solid black;text-align: center;width: 100px;"><?php echo $j++; ?></th>
                            <th style="border: 1px solid black;text-align: center;width: 100px;"><?php echo $donation->row_id; ?></th>
                            <th style="border: 1px solid black;text-align: center;width: 50px;"><?php echo $donation_date; ?></th>
                            <th style="border: 1px solid black;text-align: left;width: 300px;"><?php echo $donation->devotee_name; ?></th>
                            <!-- <th style="border: 1px solid black;text-align: left;width: 200px;"><?php echo $donation->email; ?></th> -->
                            <th style="border: 1px solid black;text-align: left;width: 250px;"><?php echo $donation->address; ?></th>
                            <!-- <th style="border: 1px solid black;text-align: left;width: 200px;"><?php echo $donation->note; ?></th> -->
                            <th style="border: 1px solid black;text-align: left;width: 200px;"><?php echo $donation->name; ?></th>
                            <th style="border: 1px solid black;text-align: left;width: 100px;"><?php echo $donation->donation_type; ?></th>
                            <th style="border: 1px solid black;text-align: left;width: 250px;"><?php echo $donation->purpose_name; ?></th>
                            <th style="border: 1px solid black;text-align: left;width: 200px;"><?php echo $donation->seva_name; ?></th>
                            <th style="border: 1px solid black;text-align: left;width: 200px;"><?php echo $donation->type_of_donation; ?></th>
                            <th style="border: 1px solid black;text-align: center;width: 150px;"><?php echo $donation->payment_type; ?></th>
                            <th style="border: 1px solid black;text-align: center;width: 150px;"><?php echo $donation->amount; ?></th>

                            <!-- <th style="text-align: center;width: 130px;"></th> -->
                            </tr>        
                            <?php        
                        } ?>
                        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style="padding-top: 20px;font-size:20px;width: 200px;"><b>Total : <?php echo $total_amount ?></b></td></tr>
                    <?php }
                
                ?>
               
            </table>
        </div>
    </div>