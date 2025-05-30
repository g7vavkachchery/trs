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

            if($row0['type'] == "Deposite"){
                $totalForArray += $row0['money'];
                $tbloutputArray[$no0] = "<tr><td>".($no0 + 1)."</td><td>".$row0['transactiondate']."</td><td><font class='text-dark'>-Not Applicable-</font></td><td><font class='text-dark'>-Not Applicable-</font></td><td class='text-success'><strong>+".number_format($row0['money'],2)." Rs</strong></td><td><font class='text-dark'>-Not Applicable-</font></td><td><font class='text-primary'><strong>".number_format($totalForArray,2)." Rs</strong></font></td><td><font class='text-dark'>".$note."</font></td></tr>";
            }
            else{
                $totalForArray -= $row0['money'];
                $tbloutputArray[$no0] = "<tr><td>".($no0 + 1)."</td><td>".$row0['transactiondate']."</td><td>".$row0['slporchkno']."</td><td>".$row0['transactioncompany']."</td><td><font class='text-dark'>-Not Applicable-</font></td><td class='text-danger'><strong>-".number_format($row0['money'],2)." Rs</strong></td><td><font class='text-primary'><strong>".number_format($totalForArray,2)." Rs</strong></font></td><td><font class='text-dark'>".$note."</font></td></tr>";
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