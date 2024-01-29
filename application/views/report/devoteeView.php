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
                    <th style="border: 1px solid black;text-align: center;width: 100px;" colspan="3">DEVOTEE REPORT</th>
                </tr>
                <tr>
                    <th style="border: 1px solid black;text-align: center;width: 100px;">SL. NO.</th>
                    <th style="border: 1px solid black;text-align: center;width: 130px;">DEVOTEE ID</th>
                    <th style="border: 1px solid black;text-align: center;width: 200px;">ADDRESS</th>
                    <th style="text-align: center;width: 200px;"></th>

                </tr>
                <?php 
                $filter = array();
                $filter = $dt_filter;
                    $devoteeInfo = $devotee_model->devoteeInfoForReport($filter,$company_id);
                    if(!empty($devoteeInfo)){
                       
                        
                        $j=1;
        
                        foreach($devoteeInfo as $devotee){  
                            ?>  
                            <tr>
                            <th style="border: 1px solid black;text-align: center;width: 100px;"><?php echo $j++; ?></th>
                            <th style="border: 1px solid black;text-align: center;width: 130px;"><?php echo $devotee->devotee_id; ?></th>
                            <th style="border: 1px solid black;text-align: left;width: 200px;"><?php echo $devotee->devotee_name.', '.$devotee->devotee_address.' , PH: '.$devotee->contact_number; ?></th>
                            <th style="text-align: center;width: 130px;"></th>
                            </tr>        
                            <?php        
                        }
                    }
                
                ?>
               
            </table>
        </div>
    </div>