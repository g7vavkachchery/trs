<?php
    date_default_timezone_set("Asia/Colombo");
	include_once '../config/config.php';

    if(isset($_POST["query"]))  
    {  
        $output = '';  
        $query = "SELECT * FROM `tbltransaction` WHERE bid='".$_POST["query"]."' ORDER BY `transactiondate` DESC, `addeddate` DESC";  
        $result = mysqli_query($conn, $query);  
        $lasttransactiondate = "";
        $lasttransactiontype = "";
        $lasttransactionamount = 0.00;
        $totalamount = 0.00;
        $no = 1;
        while($row = mysqli_fetch_array($result))  
        {  
            if($no == 1){
                $lasttransactiondate = $row['transactiondate'];
                $lasttransactiontype = $row['type'];
                if($lasttransactiontype == "Withdraw"){
                    $lasttransactiontype = $row['type'] . ": Cheque No - " . $row['slporchkno'] . " for " . $row['transactioncompany'];
                }
                $lasttransactionamount = $row['money'];
            }

            if($row['type'] == "Deposite"){
                $totalamount = $totalamount + $row['money'];
            }
            else{
                $totalamount = $totalamount - $row['money'];
            }

            $no++;
        }

        $tbloutputArray = array();
        $query0 = "SELECT * FROM `tbltransaction` WHERE bid='".$_POST["query"]."' ORDER BY `transactiondate` ASC, `addeddate` ASC";  
        $result0 = mysqli_query($conn, $query0);
        $no0 = 0;
        $totalForArray = 0;
        while($row0 = mysqli_fetch_array($result0)){
            $note = "No Note Available";
            if($row0['note'] != NULL || $row0['note'] != null || $row0['note'] != "" || $row0['note'] != ''){
                $note = $row0['note'];
            }

            $operation =    "<div class='row'>
                                <div class='col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6'>
                                    <form action='' method='POST' name='formRemove".$row0['rowid']."'>
                                        <input type='hidden' name='txtRemoveRow' value='".$row0['rowid']."'>
                                        <input type='hidden' name='bid' value='".$row0['bid']."'>
                                        <button type='submit' class='btn btn-sm' onclick='validateForm8()' style='background-color: #ff0000; color: #fff;' name='btnRemove' title='Remove Account'>
                                            <i class='far fa-trash-alt'></i>
                                        </button>
                                    </form>
                                </div>
                                <div class='col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6'>
                                    <a href='admin.php?maintenance&erid=".$row0['rowid']."' class='btn btn-sm btn-warning' title='Edit'>
                                        <i class='fas fa-edit'></i>
                                    </a>
                                </div>
                            </div>";

            if($row0['type'] == "Deposite"){
                $totalForArray += $row0['money'];
                $tbloutputArray[$no0] = "<tr><td>".($no0 + 1)."</td><td>".$row0['transactiondate']."</td><td><font class='text-dark'>-Not Applicable-</font></td><td><font class='text-dark'>-Not Applicable-</font></td><td class='text-success'><strong>+".number_format($row0['money'],2)." Rs</strong></td><td><font class='text-dark'>-Not Applicable-</font></td><td><font class='text-primary'><strong>".number_format($totalForArray,2)." Rs</strong></font></td><td><font class='text-dark'>".$note."</font></td><td>".$operation."</td></tr>";
            }
            else{
                $totalForArray -= $row0['money'];
                $tbloutputArray[$no0] = "<tr><td>".($no0 + 1)."</td><td>".$row0['transactiondate']."</td><td>".$row0['slporchkno']."</td><td>".$row0['transactioncompany']."</td><td><font class='text-dark'>-Not Applicable-</font></td><td class='text-danger'><strong>-".number_format($row0['money'],2)." Rs</strong></td><td><font class='text-primary'><strong>".number_format($totalForArray,2)." Rs</strong></font></td><td><font class='text-dark'>".$note."</font></td><td>".$operation."</td></tr>";
            }
            $no0++;
        }
        $tbloutputArrayReverse = array_reverse($tbloutputArray);
        $tbloutputArrayReverseOutput = implode(" ",$tbloutputArrayReverse);

        $lasttransactionamount = number_format($lasttransactionamount,2);
        $totalamount = number_format($totalamount,2);
        $output = array("lasttransactiondate"=>$lasttransactiondate, "lasttransactiontype"=>$lasttransactiontype, "lasttransactionamount"=>$lasttransactionamount, "totalamount"=>$totalamount, "outputtbl"=>$tbloutputArrayReverseOutput);  
        echo json_encode($output);  
    }  
?>