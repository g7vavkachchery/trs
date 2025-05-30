<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
	date_default_timezone_set("Asia/Colombo");

    function chkUserAvailable($conn){
		$sql = "SELECT * FROM `tbluser`";
		$result = $conn->query($sql);
		if(mysqli_num_rows($result)>=1){
			return true;
		}
		else{
			return false;
		}
        
	}

	function addAdminDetails($conn,$name,$email,$pno,$nicno,$userName,$password,$sq1,$ans1,$sq2,$ans2){
		$addedDateAndTime = date("Y-m-d h:i:s");
		$password = md5($password);
		$password = md5($password);
		$sql = "INSERT INTO `tbluser`(`userid`, `password`, `name`, `email`, `pno`, `nicno`, `sq1`, `sqa1`, `sq2`, `sqa2`, `usertype`, `addeddate`, `status`) VALUES ('".$userName."','".$password."','".$name."','".$email."','".$pno."','".$nicno."','".$sq1."','".$ans1."','".$sq2."','".$ans2."','Admin','".$addedDateAndTime."','Active')";
		$result = $conn->query($sql);
		if($result){
			header("Refresh:0");
		}
        
	}

	function login($conn,$un,$pwd){
        $isUserAvailable = checkUsersPasswordAndId($conn,$un,$pwd);
        if($isUserAvailable){
            $data = fetchUsersLoginDetails($conn,$un);
            $_SESSION['un'] = $un;
            $_SESSION['ut'] = $data['usertype'];
            if($data['usertype']=='Admin'){
                header('Location: admin.php');
            }
            if($data['usertype']=='TO'){
                header('Location: user.php');
            }
            if($data['usertype']=='Supervisor'){
                header('Location: viewer.php');
            }
        }
        else{
            echo " <script>
                    	setTimeout(function(){ swal('Failed!', 'Email / Username or Password is wrong!', 'error');},25);
					</script> ";
        }
		
    }

	function checkUsersPasswordAndId($conn,$un,$pwd){
        $txtHashedPwd = md5($pwd);
        $txtHashedPwd = md5($txtHashedPwd);
        $isUserAvailable = false;
        if (strpos($un, '@') > 0) {
            $sql = "SELECT * FROM `tbluser` WHERE email='".$un."' AND password='".$txtHashedPwd ."'";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)==1){
                $isUserAvailable = true;
            }
            else{
                $isUserAvailable = false;
            }
        }
        else{
            $sql = "SELECT * FROM `tbluser` WHERE userid='".$un."' AND password='".$txtHashedPwd ."'";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)==1){
                $isUserAvailable = true;
            }
            else{
                $isUserAvailable = false;
            }
        }
        return $isUserAvailable;
    }

    function fetchUsersLoginDetails($conn,$un){
        if (strpos($un, '@') !== false) {
            $sql = "SELECT * FROM `tbluser` WHERE email='".$un."'";
            $result = mysqli_query($conn,$sql);
            $data = $result->fetch_assoc();
            return $data;
        }
        else{
            $sql = "SELECT * FROM `tbluser` WHERE userid='".$un."'";
            $result = mysqli_query($conn,$sql);
            $data = $result->fetch_assoc();
            return $data;
        }
    }

    function fetchUsersLoginDetailsForAllDetails($conn,$un){
        if (strpos($un, '@') !== false) {
            $sql = "SELECT * FROM `tbluser` WHERE email='".$un."'";
            $result = mysqli_query($conn,$sql);
            $data = $result->fetch_assoc();
            
            return $data;
        }
        else{
            $sql = "SELECT * FROM `tbluser` WHERE userid='".$un."'";
            $result = mysqli_query($conn,$sql);
            $data = $result->fetch_assoc();
            
            return $data;
        }
    }

    function updateGeneralDetails($conn,$name,$email,$pno,$nicno,$userName){
        $sql = "UPDATE `tbluser` SET `name`='".$name."',`email`='".$email."',`pno`='".$pno."',`nicno`='".$nicno."' WHERE `userid`='".$userName."'";
        $result = mysqli_query($conn,$sql);
        if($result){	
            echo " <script>
                        setTimeout(function(){ swal('Success!', 'The General Details has been updated successfully!', 'success');},25);
                        setTimeout(function(){ location.reload();},2000);
                    </script>";
        }
        else{
            echo " <script>
                        setTimeout(function(){ swal('Error!', 'Please try agine later!', 'error');},25);
                    </script>";
        }
    }

    function updateSecurityDetails($conn,$sq1,$sqa1,$sq2,$sqa2,$userName){
        $sql = "UPDATE `tbluser` SET `sq1`='".$sq1."',`sqa1`='".$sqa1."',`sq2`='".$sq2."',`sqa2`='".$sqa2."' WHERE `userid`='".$userName."'";
        $result = mysqli_query($conn,$sql);
        if($result){	
            echo " <script>
                        setTimeout(function(){ swal('Success!', 'The Security Details has been updated successfully!', 'success');},25);
                        setTimeout(function(){ location.reload();},2000);
                    </script>";
        }
        else{
            echo " <script>
                        setTimeout(function(){ swal('Error!', 'Please try agine later!', 'error');},25);
                    </script>";
        }
    }

    function updatePasswordDetails($conn,$oldPass,$newPass,$confPass,$userName){
        $data = fetchUsersLoginDetails($conn,$userName);
        $oldPass = md5($oldPass);
        $oldPass = md5($oldPass);
        if($data['password']==$oldPass){
            if($newPass == $confPass){
                $newPass = md5($newPass);
                $newPass = md5($newPass);
                $sql = "UPDATE `tbluser` SET `password`='".$newPass."' WHERE `userid`='".$userName."'";
                $result = mysqli_query($conn,$sql);
                if($result){	
                    echo " <script>
                                setTimeout(function(){ swal('Success!', 'The Password Details has been updated successfully!', 'success');},25);
                            </script>";
                }
                else{
                    echo " <script>
                                setTimeout(function(){ swal('Error!', 'Please try agine later!', 'error');},25);
                            </script>";
                }
            }
            else{
                echo " <script>
                            setTimeout(function(){ swal('Error!', 'Password are missmatched. Please Correct It', 'error');},25);
                        </script>";
            }
        }
        else{
            echo " <script>
                        setTimeout(function(){ swal('Error!', 'Old Password is Wrong', 'error');},25);
                    </script>";
        }
    }

    function genUserID($conn){
        $stafId = 'uid0' . rand(10,99);

        $sql = "SELECT * FROM tbluser WHERE userid='" . $stafId . "'";
        $result = mysqli_query($conn,$sql);

        while(mysqli_num_rows($result)==1){
                $stafId = 'uid0' . rand(10,99);

                $sql = "SELECT * FROM tbluser WHERE userid='" . $stafId . "'";
                $result = mysqli_query($conn,$sql);
        }
        return $stafId;
    }

    function addUser($conn,$sname,$semail,$snicno,$spno,$suserid,$usertype){
        $addedDateAndTime = date("Y-m-d h:i:s");
        $encrptPass = md5($snicno);
        $encrptPass = md5($encrptPass);
        $sql = "INSERT INTO `tbluser`(`userid`, `password`, `name`, `email`, `pno`, `nicno`, `usertype`, `addeddate`, `status`) VALUES ('".$suserid."','".$encrptPass."','".$sname."','".$semail."','".$spno."','".$snicno."','".$usertype."','".$addedDateAndTime."','Active')";
		$result = $conn->query($sql);
        if($result){	
            echo " <script>
                        setTimeout(function(){ swal('Success!', 'The User has been added successfully!', 'success');},25);
                    </script>";
        }
        else{
            echo " <script>
                        setTimeout(function(){ swal('Error!', 'Please try agine later!', 'error');},25);
                    </script>";
        }
    }

    function showSiteUsers($conn){
		$sql = "SELECT * FROM `tbluser`";
		$result0 = $conn->query($sql);
		if(mysqli_num_rows($result0)>=1){
			$num = 1;
			while($row = mysqli_fetch_assoc($result0)){
				echo "<tr>
						<td>".$num."</td>
						<td>".$row['name']."</td>
						<td>".$row['userid']."</td>
                        <td>".$row['email']."</td>
                        <td>".$row['nicno']."</td>
                        <td>".$row['pno']."</td>
                        <td>".$row['usertype']."</td>
						<td>";
                            if($row['status']=="Active"){
                                echo "<center><span style='background-color: green; color: black'>Active</span></center>";
                            }
                            if($row['status']=="Block"){
                                echo "<center><span style='background-color: red; color: white'>Block</span></center>";
                            }
				echo	"</td>";
				if($row['usertype']=="Admin"){
					echo	"<td>
								<div style='background-color: gray;width: 100%;align: center;color: red'>
									No Operation for Site Admin
								</div>
							</td>";
				}
				else{
					echo	"<td>
								<div class='row'>";
					if($row['status']=="Active"){
						echo		"<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3'>
										<form action='' method='POST' name='formBlock".$row['userid']."'>
											<input type='hidden' name='txtBlockSiteUser' value='".$row['userid']."'>
											<button type='submit' class='btn btn-sm' onclick='validateForm1()' style='background-color: #ff00ff; color: #fff;' name='btnRemove' title='Block User'>
												<i class='fas fa-ban'></i>
											</button>
										</form>
									</div>";
					}
					if($row['status']=="Block" || $row['status']=="Waiting"){
						echo		"<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3'>
										<form action='' method='POST' name='formActive".$row['userid']."'>
											<input type='hidden' name='txtActiveSiteUser' value='".$row['userid']."'>
											<button type='submit' class='btn btn-sm' onclick='validateForm2()' style='background-color: #00ff00; color: #fff;' name='btnRemove' title='Active User'>
                                                <i class='fas fa-check-circle'></i>
											</button>
										</form>
									</div>";
					}
					echo			"<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3'>
										<form action='' method='POST' name='formRemove".$row['userid']."'>
											<input type='hidden' name='txtRemoveSiteUser' value='".$row['userid']."'>
											<button type='submit' class='btn btn-sm' onclick='validateForm3()' style='background-color: #ff0000; color: #fff;' name='btnRemove' title='Remove User'>
                                                <i class='far fa-trash-alt'></i>
											</button>
										</form>
									</div>
									<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3'>
										<form action='' method='POST' name='formPasswordReset".$row['userid']."'>
											<input type='hidden' name='txtResetSiteUserPassword' value='".$row['userid']."'>
											<button type='submit' class='btn btn-sm' onclick='validateForm4()' style='background-color: #7a7a7a; color: #fff;' name='btnRemove' title='Reset Password'>
                                                <i class='fas fa-cog'></i>
											</button>
										</form>
									</div>
                                    <div class='col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3'>
										<form action='' method='POST' name='formPasswordReset".$row['userid']."'>
											<input type='hidden' name='txtResetSiteUserPassword' value='".$row['userid']."'>
											<a href='admin.php?users&euid=".$row['userid']."' class='btn btn-sm btn-warning' title='Edit'>
                                                <i class='fas fa-edit'></i>
											</a>
										</form>
									</div>
								</div>
							</td>";
				}
				echo "</tr>";
				$num++;
			}
		}
	}

    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 12; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    function removeSiteUser($conn,$id){
		$sql = "DELETE FROM `tbluser` WHERE userid='".$id."'";
		$result = $conn->query($sql);
		if($result){	
            echo " <script>
                        setTimeout(function(){ swal('Success!', 'The User has been removed successfully!', 'success');},25);
                    </script>";
        }
        else{
            echo " <script>
                        setTimeout(function(){ swal('Error!', 'Please try agine later!', 'error');},25);
                    </script>";
        }
	}

    function activateSiteUser($conn,$id){		
		$sql = "UPDATE `tbluser` SET status='Active' WHERE userid='".$id."'";
		$result = $conn->query($sql);		
		if($result){	
            echo " <script>
                        setTimeout(function(){ swal('Success!', 'The User has been activated successfully!', 'success');},25);
                    </script>";
        }
        else{
            echo " <script>
                        setTimeout(function(){ swal('Error!', 'Please try agine later!', 'error');},25);
                    </script>";
        }	
	}
	
	function blockSiteUser($conn,$id){
		$sql = "UPDATE `tbluser` SET status='Block' WHERE userid='".$id."'";
		$result = $conn->query($sql);
		if($result){	
            echo " <script>
                        setTimeout(function(){ swal('Success!', 'The User has been blocked successfully!', 'success');},25);
                    </script>";
        }
        else{
            echo " <script>
                        setTimeout(function(){ swal('Error!', 'Please try agine later!', 'error');},25);
                    </script>";
        }	
	}
	
	function userPasswordReset($conn,$id){		
		$newpwd = randomPassword();
		$hashpwd = md5($newpwd);		
		$sql = "UPDATE `tbluser` SET `password`='".$hashpwd."' WHERE userid='".$id."'";
		$result = $conn->query($sql);	
        if($result){	
            echo " <script>
                        setTimeout(function(){ swal('Success!', 'The password has been changed successfully! New password is ".$newpwd."', 'success');},25);
                    </script>";
        }
        else{
            echo " <script>
                        setTimeout(function(){ swal('Error!', 'Please try agine later!', 'error');},25);
                    </script>";
        }
	}

    function editUser($conn,$sname,$semail,$snicno,$spno,$suserid,$usertype){
        $sql = "UPDATE `tbluser` SET `name`='".$sname."',`email`='".$semail."',`pno`='".$spno."',`nicno`='".$snicno."' WHERE `userid`='".$suserid."'";
		$result = $conn->query($sql);
        if($result){	
            echo " <script>
                        setTimeout(function(){ swal('Success!', 'The User has been updated successfully!', 'success');},25);
                    </script>";
        }
        else{
            echo " <script>
                        setTimeout(function(){ swal('Error!', 'Please try agine later!', 'error');},25);
                    </script>";
        }
    }

    function genBankID($conn){
        $stafId = 'bid0' . rand(10,99);

        $sql = "SELECT * FROM tblbankaccount WHERE bankaccountid='" . $stafId . "'";
        $result = mysqli_query($conn,$sql);

        while(mysqli_num_rows($result)==1){
                $stafId = 'uid0' . rand(10,99);

                $sql = "SELECT * FROM tblbankaccount WHERE bankaccountid='" . $stafId . "'";
                $result = mysqli_query($conn,$sql);
        }
        return $stafId;
    }

    function addBankDetails($conn,$file_no,$name_of_work,$name_of_contract,$agreement_no,$agreement_date,$allocation_of_work,$estemate_amount,$contract_amount,$date_of_commencement,$actual_date_of_completion){
        $sql = "INSERT INTO `tblcontract`(`file_no`, `name_of_work`, `name_of_contract`, `agreement_no`, `agreement_date`, `allocation_of_work`, `estemate_amount`, `contract_amount`, `date_of_commencement`, `actual_date_of_completion`) VALUES ('".$file_no."','".$name_of_work."','".$name_of_contract."','".$agreement_no."','".$agreement_date."','".$allocation_of_work."','".$estemate_amount."','".$contract_amount."','".$date_of_commencement."','".$actual_date_of_completion."')";
		$result = $conn->query($sql);
        if($result){	
            echo " <script>
                        setTimeout(function(){ swal('Success!', 'The User has been added successfully!', 'success');},25);
                    </script>";
        }
        else{
            echo " <script>
                        setTimeout(function(){ swal('Error!', 'Please try agine later!', 'error');},25);
                    </script>";
        }
    }

    function showBankAccounts($conn){
		$sql = "SELECT * FROM `tblcontract` ORDER BY 'file_no' ASC";
		$result0 = $conn->query($sql);
		if(mysqli_num_rows($result0)>=1){
			$num = 1;
			while($row = mysqli_fetch_assoc($result0)){
				echo "<tr>
						<td>".$num."</td>
						<td>".$row['file_no']."</td>
						<td>".$row['name_of_work']."</td>
                        <td>".$row['name_of_contract']."</td>
                        <td>".$row['agreement_no']."</td>
                        <td>".$row['agreement_date']."</td>
                        <td>".$row['allocation_of_work']."</td>
                        <td>".$row['estemate_amount']."</td>
                        <td>".$row['contract_amount']."</td>
                        <td>".$row['date_of_commencement']."</td>
                        <td>".$row['actual_date_of_completion']."</td>";
					echo	"<td>
								<div class='row'>";
					echo			"<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4'>
										<form action='' method='POST' name='formRemove".$row['file_no']."'>
											<input type='hidden' name='txtRemoveSiteAccount' value='".$row['file_no']."'>
											<button type='submit' class='btn btn-sm' onclick='validateForm7()' style='background-color: #ff0000; color: #fff;' name='btnRemove' title='Remove Account'>
                                                <i class='far fa-trash-alt'></i>
											</button>
										</form>
									</div>
                                    <div class='col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4'>
										<form action='' method='POST' name='formPasswordReset".$row['file_no']."'>
											<input type='hidden' name='txtResetSiteAccountPassword' value='".$row['file_no']."'>
											<a href='admin.php?bankaccounts&ebid=".$row['file_no']."' class='btn btn-sm btn-warning' title='Edit'>
                                                <i class='fas fa-edit'></i>
											</a>
										</form>
									</div>
								</div>
							</td>";
				echo "</tr>";
				$num++;
			}
		}
	}

    function showBankAccountsForUser($conn){
		$sql = "SELECT * FROM `tblbankaccount` ORDER BY 'addeddate' ASC";
		$result0 = $conn->query($sql);
		if(mysqli_num_rows($result0)>=1){
			$num = 1;
			while($row = mysqli_fetch_assoc($result0)){
				echo "<tr>
						<td>".$num."</td>
						<td>".$row['bankaccountid']."</td>
						<td>".$row['bankname']."</td>
                        <td>".$row['accountnumber']."</td>
						<td>";
                            if($row['status']=="Active"){
                                echo "<center><span style='background-color: green; color: black'>Active</span></center>";
                            }
                            if($row['status']=="Block"){
                                echo "<center><span style='background-color: red; color: white'>Block</span></center>";
                            }
				echo	"</td>";
				echo "</tr>";
				$num++;
			}
		}
	}

    function removeSiteAccount($conn,$id){
		$sql = "DELETE FROM `tblcontract` WHERE file_no='".$id."'";
		$result = $conn->query($sql);
		if($result){	
            echo " <script>
                        setTimeout(function(){ swal('Success!', 'The Contract has been removed successfully!', 'success');},25);
                    </script>";
        }
        else{
            echo " <script>
                        setTimeout(function(){ swal('Error!', 'Please try agine later!', 'error');},25);
                    </script>";
        }
	}

    function activateSiteAccount($conn,$id){		
		$sql = "UPDATE `tblbankaccount` SET status='Active' WHERE bankaccountid='".$id."'";
		$result = $conn->query($sql);		
		if($result){	
            echo " <script>
                        setTimeout(function(){ swal('Success!', 'The Account has been activated successfully!', 'success');},25);
                    </script>";
        }
        else{
            echo " <script>
                        setTimeout(function(){ swal('Error!', 'Please try agine later!', 'error');},25);
                    </script>";
        }	
	}
	
	function blockSiteAccount($conn,$id){
		$sql = "UPDATE `tblbankaccount` SET status='Block' WHERE bankaccountid='".$id."'";
		$result = $conn->query($sql);
		if($result){	
            echo " <script>
                        setTimeout(function(){ swal('Success!', 'The Account has been blocked successfully!', 'success');},25);
                    </script>";
        }
        else{
            echo " <script>
                        setTimeout(function(){ swal('Error!', 'Please try agine later!', 'error');},25);
                    </script>";
        }	
	}

    function fetchBankAccountDetails($conn,$id){
        $sql = "SELECT * FROM `tblcontract` WHERE `file_no`='".$id."'";
		$result0 = $conn->query($sql);
        $data = $result0->fetch_assoc();
        return $data;
    }

    function editAccount($conn,$file_no,$name_of_work,$name_of_contract,$agreement_no,$agreement_date,$allocation_of_work,$estemate_amount,$contract_amount,$date_of_commencement,$actual_date_of_completion){
        $sql = "UPDATE `tblcontract` SET `name_of_work`='".$name_of_work."', `name_of_contract`='".$name_of_contract."', `agreement_no`='".$agreement_no."', `agreement_date`='".$agreement_date."', `allocation_of_work`='".$allocation_of_work."', `estemate_amount`='".$estemate_amount."', `contract_amount`='".$contract_amount."', `date_of_commencement`='".$date_of_commencement."', `actual_date_of_completion`='".$actual_date_of_completion."' WHERE `file_no`='".$file_no."'";
		$result = $conn->query($sql);
        if($result){	
            echo " <script>
                        setTimeout(function(){ swal('Success!', 'The Account has been updated successfully!', 'success');},25);
                    </script>";
        }
        else{
            echo " <script>
                        setTimeout(function(){ swal('Error!', 'Please try agine later!', 'error');},25);
                    </script>";
        }
    }

    function showBankNamesOnOptions($conn){
        $sql = "SELECT * FROM `tblcontract` ORDER BY 'file_no' ASC";
		$result0 = $conn->query($sql);
        echo "<option value='NULL' selected disabled>Select a Bank & Account</option>";
		if(mysqli_num_rows($result0)>=1){
            while($row = mysqli_fetch_assoc($result0)){
                echo "<option value='".$row['file_no']."'><strong>".$row['name_of_contract']."</strong> | <tt>".$row['file_no']."</tt></option>";
            }
        }
    }

    function showBankNamesOnOptionsBySelected($conn,$bid){
        $sql = "SELECT * FROM `tblcontract` ORDER BY 'file_no' ASC";
		$result0 = $conn->query($sql);
        echo "<option value='NULL' disabled>Select a Contract</option>";
		if(mysqli_num_rows($result0)>=1){
            while($row = mysqli_fetch_assoc($result0)){
                $selected = "";
                if($row['file_no'] == $bid){
                    $selected = " selected";
                }
                echo "<option value='".$row['file_no']."'".$selected."><strong>".$row['name_of_contract']."</strong> | <tt>".$row['file_no']."</tt></option>";
            }
        }
    }

    function showBankNamesOnOptions1($conn){
        $sql = "SELECT * FROM `tbluser` WHERE `usertype`='TO' ORDER BY 'name' ASC";
		$result0 = $conn->query($sql);
        echo "<option value='NULL' selected disabled>Select a Bank & Account</option>";
		if(mysqli_num_rows($result0)>=1){
            while($row = mysqli_fetch_assoc($result0)){
                echo "<option value='".$row['userid']."'><strong>".ucwords($row['name'])."</strong></option>";
            }
        }
    }

    function showBankNamesOnOptionsBySelected1($conn,$bid){
        $sql = "SELECT * FROM `tbluser` WHERE `usertype`='TO' ORDER BY 'file_no' ASC";
		$result0 = $conn->query($sql);
        echo "<option value='NULL' disabled>Select a Contract</option>";
		if(mysqli_num_rows($result0)>=1){
            while($row = mysqli_fetch_assoc($result0)){
                $selected = "";
                if($row['userid'] == $bid){
                    $selected = " selected";
                }
                echo "<option value='".$row['userid']."'".$selected."><strong>".ucwords($row['name'])."</strong></option>";
            }
        }
    }

    function retriveContractAssignmentDetails($conn){
        $sql = "SELECT * FROM `tbldocontract` ORDER BY 'file_no' ASC";
		$result0 = $conn->query($sql);
		if(mysqli_num_rows($result0)>=1){
			$num = 1;
			while($row = mysqli_fetch_assoc($result0)){
                $data = fetchBankAccountDetails($conn,$row['file_no']);
                $data1 = fetchUsersLoginDetails($conn,$row['userid']);
				echo "<tr>
						<td>".$num."</td>
						<td>".$row['file_no']."</td>
						<td>".$data['name_of_contract']."</td>
                        <td>".ucwords($data1['name'])."</td>
						<td>";
                        echo "<div class='row'>";
                            echo"<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4'>
                                <form action='' method='POST' name='formRemove".$row['file_no']."'>
                                    <input type='hidden' name='txtRemoveFileNo' value='".$row['file_no']."'>
                                    <input type='hidden' name='txtRemoveUserId' value='".$row['userid']."'>
                                    <button type='submit' class='btn btn-sm' onclick='validateForm7()' style='background-color: #ff0000; color: #fff;' name='btnRemove' title='Remove Account'>
                                        <i class='far fa-trash-alt'></i>
                                    </button>
                                </form>
                            </div>
                        </div>";
				echo	"</td>";
				echo "</tr>";
				$num++;
			}
		}
    }

    function retriveContractAssignmentDetailsByUID($conn,$uid){
        $sql = "SELECT * FROM `tbldocontract` WHERE `userid`='".$uid."' ORDER BY 'file_no' ASC";
		$result0 = $conn->query($sql);
		if(mysqli_num_rows($result0)>=1){
			$num = 1;
			while($row = mysqli_fetch_assoc($result0)){
                $data = fetchBankAccountDetails($conn,$row['file_no']);
				echo "<tr>
						<td>".$num."</td>
						<td>".$row['file_no']."</td>
						<td>".$data['name_of_contract']."</td>
						<td>";
                        echo "<div class='row'>";
                            echo"<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3'>
                                <button type='button' class='btn btn-sm' style='background-color:rgb(0, 120, 172); color: #fff;' name='btnRemove' title='Remove Account' data-toggle='modal' data-target='#myModal".$row['file_no']."'>
                                    <i class='fas fa-plus-square'></i>
                                </button>
                            </div>
                            <div class='col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3'>
                                <button type='button' class='btn btn-sm' style='background-color:rgb(0, 141, 28); color: #fff;' name='btnRemove' title='Remove Account' data-toggle='modal' data-target='#myModal2".$row['file_no']."'>
                                    <i class='fas fa-eye'></i>
                                </button>
                            </div>
                        </div>";
				echo	"</td>";
				echo "</tr>";
				$num++;



                echo "<div class='container'>
                        <!-- The Modal -->
                        <div class='modal fade' id='myModal2".$row['file_no']."'>
                            <div class='modal-dialog modal-xl'>
                                <div class='modal-content'>
                                
                                    <!-- Modal Header -->
                                    <div class='modal-header'>
                                        <h4 class='modal-title'>Added Status of File No : ".ucwords($row['file_no'])."</h4>
                                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                    </div>
                                    
                                    <!-- Modal body -->
                                    <div class='modal-body'>
                                        <div>";
                                        $sql1 = "SELECT * FROM `tbldofeedbacks` WHERE `file_no`='".$row['file_no']."' AND `userid`='".$uid."' ORDER BY `date_time` DESC";
		                                $result1 = $conn->query($sql1);
                                        if(mysqli_num_rows($result1)>=1){
                                            $num1 = 1;
                                            echo "<div class='row' style='background-color: black; color: white;'>
                                                        <div class='col-1'>
                                                            <strong>No.</strong>
                                                        </div>
                                                        <div class='col-3'>
                                                            <strong>Title</strong>
                                                        </div>
                                                        <div class='col-3'>
                                                            <strong>Discription</strong>
                                                        </div>
                                                        <div class='col-2'>
                                                            <strong>Responces</strong>
                                                        </div>
                                                        <div class='col-3'>
                                                            <strong>Operations</strong>
                                                        </div>
                                                    </div>";
                                            while($row1 = mysqli_fetch_assoc($result1)){
                                                $rowbgcolor = ($num1%2==0)?"#a6a6a6":"#e3e3e3";
                                                echo "<div class='row' style='background-color: ".$rowbgcolor.";'>
                                                        <div class='col-1'>
                                                            ".$num1."
                                                        </div>
                                                        <div class='col-3'>
                                                            ".ucwords($row1['feedback_title'])."
                                                        </div>
                                                        <div class='col-3'>
                                                            ".$row1['feedback_discrption']."<br><br>";

                                                $sql2 = "SELECT * FROM `tblimagesforfeedback` WHERE `feeback_id`='".$row1['feeback_id']."'";
                                                $result2 = $conn->query($sql2);

                                                if(mysqli_num_rows($result2)>=1){
                                                    echo "<div class='row'>";
                                                    while($row2 = mysqli_fetch_assoc($result2)){
                                                        echo "<a href='".$row2['img_path']."' data-lightbox='photos' target='_blank' class='col-sm-4'>
                                                            <img src='".$row2['img_path']."' class='img-fluid'>
                                                        </a>";
                                                        /*echo "<div class='col-4'>";
                                                        echo "<a class='example-image-link' href='".$row2['img_path']."' data-lightbox='example-set'>";
                                                        echo "<img class='example-image' src='".$row2['img_path']."'>";
                                                        echo "</a>";
                                                        echo "</div>";*/
                                                    }
                                                    echo "</div>";
                                                }
                                                            
                                                echo        "<br/><br/> updated On : ".$row1['date_time']."
                                                        </div>
                                                        <div class='col-2'>
                                                            
                                                        </div>
                                                        <div class='col-3'>
                                                            <div class='row'>
                                                                <div class='col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3'>
                                                                    <form action='#' method='post'>
                                                                        <input type='hidden' name='feeback_id' id='feeback_id' value='".$row1['feeback_id']."'>
                                                                        <button type='button' class='btn btn-sm btn-danger' onclick='validateForm7()' name='btnRemove' id='btnRemove' title='Remove Account' ";
                                                            echo (checkFeedbackHasFeedback($conn,$row1['feeback_id']))?"":"disabled";
                                                                   echo ">
                                                                            <i class='fas fa-trash-alt'></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                                <div class='col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3'>";
                                                        if(!checkFeedbackHasFeedback($conn,$row1['feeback_id'])){
                                                            echo "<button type='button' class='btn btn-sm' style='background-color:rgb(0, 141, 28); color: #fff;' name='btnRemove' title='View Feedbacks' data-toggle='modal' data-target='#myModal3".$row1['feeback_id']."' data-dismiss='myModal2".$row['file_no']."' data-dismiss='modal'>
                                                                <i class='fas fa-eye'></i>
                                                            </button>";


                                                        }
                                                        echo    "</div>
                                                            </div>
                                                        </div>
                                                    </div>";
                                                $num1++;
                                                echo "<div class='container'>
                                                        <!-- The Modal -->
                                                        <div class='modal fade' id='myModal3".$row1['feeback_id']."'>
                                                            <div class='modal-dialog modal-lg'>
                                                                <div class='modal-content'>
                                                                
                                                                    <!-- Modal Header -->
                                                                    <div class='modal-header bg-dark'>
                                                                        <h4 class='modal-title'>Feedbacks From Viewers</h4>
                                                                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                                    </div>
                                                                    
                                                                    <!-- Modal body -->
                                                                    <div class='modal-body'>
                                                                        <div>
                                                                        
                                                                        </div>
                                                                    </div>                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>";
                                            }
                                echo    "</div>";
                                        }
                                echo "</div>                                    
                                </div>
                            </div>
                        </div>
                    </div>";

                    echo "<div class='container'>
                        <!-- The Modal -->
                        <div class='modal fade' id='myModal".$row['file_no']."'>
                            <div class='modal-dialog modal-lg'>
                                <div class='modal-content'>
                                
                                    <!-- Modal Header -->
                                    <div class='modal-header'>
                                        <h4 class='modal-title'>Add Status on ".date("d-m-Y")."</h4>
                                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                    </div>
                                    
                                    <!-- Modal body -->
                                    <div class='modal-body'>
                                        <div>
                                        <form action='#' method='post'  enctype='multipart/form-data'>
                                            <div class='row'>
                                                <div class='col-4'>
                                                    Subject<span style='color: red;'>*</span>
                                                </div>
                                                <div class='col-1'>
                                                    :
                                                </div>
                                                <div class='col-7'>
                                                    <input type='text' name='txtsubject' id='txtsubject' size='47' required/>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-4'>
                                                    Details<span style='color: red;'>*</span>
                                                </div>
                                                <div class='col-1'>
                                                    :
                                                </div>
                                                <div class='col-7'>
                                                    <textarea name='txtdetails' id='txtdetails' cols='50' rows='5' required no-resize></textarea>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-4'>
                                                    Photos (if any)
                                                </div>
                                                <div class='col-1'>
                                                    :
                                                </div>
                                                <div class='col-7'>
                                                    <input type='file' id='photos[]' name='photos[]' accept='.jpeg,.jpg,.png' multiple>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-4'>
                                                    
                                                </div>
                                                <div class='col-1'>
                                                    
                                                </div>
                                                <div class='col-7'>
                                                    <input type='hidden' id='fileno' name='fileno' value='".$row['file_no']."'/>
                                                    <input type='hidden' id='userid' name='userid' value='".$uid."'/>
                                                    <button class='btn btn-success' type='submit' id='subdetailsform' name='subdetailsform'>Add</button>
                                                    <button class='btn btn-warning' type='reset'>Reset</button>
                                                    <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>";
                    
			}
		}
    }

    function checkFeedbackHasFeedback($conn,$feeback_id){
        $sql = "SELECT * FROM `tblfeedbacksfeedback` WHERE `feedback_id`='".$feeback_id."'";
        $result = $conn->query($sql);
        if(mysqli_num_rows($result)>=1){	
            return false;
        }
        else{
            return true;
        }
    }

    function delAFeedback($conn,$feeback_id){
        $sql = "DELETE FROM `tbldofeedbacks` WHERE `feeback_id`='".$feeback_id."'";
        $result = $conn->query($sql);
        if($result){	
            echo " <script>
                        setTimeout(function(){ swal('Success!', 'The Data has been deleted successfully!', 'success');},25);
                    </script>";
        }
        else{
            echo " <script>
                        setTimeout(function(){ swal('Error!', 'Please try agine later!', 'error');},25);
                    </script>";
        }
    }

    function addStatusOnFileWithoutPhotos($conn,$file_no,$uid,$txtsubject,$txtdetails){
        $sql = "INSERT INTO `tbldofeedbacks`(`file_no`, `userid`, `feedback_title`, `feedback_discrption`, `date_time`) VALUES ('".$file_no."','".$uid."','".$txtsubject."','".$txtdetails."','".date("Y-m-d H:i:s")."')";
        $result = $conn->query($sql);
        if($result){	
            echo " <script>
                        setTimeout(function(){ swal('Success!', 'The Data has been added successfully!', 'success');},25);
                    </script>";
        }
        else{
            echo " <script>
                        setTimeout(function(){ swal('Error!', 'Please try agine later!".$txtsubject."', 'error');},25);
                    </script>";
        }
    }

    function addStatusOnFileWithPhotos($conn,$file_no,$uid,$txtsubject,$txtdetails,$photo_name,$photo_tmp_name){
        $sql = "INSERT INTO `tbldofeedbacks`(`file_no`, `userid`, `feedback_title`, `feedback_discrption`, `date_time`) VALUES ('".$file_no."','".$uid."','".$txtsubject."','".$txtdetails."','".date("Y-m-d H:i:s")."')";
        $result = $conn->query($sql);
        if($result){	
            $last_id = $conn->insert_id;

            $uploadDirectory = "uploads/img/";
            $uploaded = false;
            if(basename($photo_name[0]) != ""){
                foreach ($photo_tmp_name as $key => $tmp_name) {
                    $fileName = $file_no . "-" . $last_id . "-" . basename($photo_name[$key]);
                    $targetFile = $uploadDirectory . $fileName;

                    $sql1 = "INSERT INTO `tblimagesforfeedback`(`feeback_id`, `img_name`, `img_path`, `img_caption`) VALUES ('".$last_id."','".$fileName."','".$targetFile."','')";
                    $result1 = $conn->query($sql1);
                    
                    if (move_uploaded_file($tmp_name, $targetFile) && $result1) {
                        $uploaded = true;
                    } else {
                        $uploaded = false;
                    }
                }
            }
            else{
                $uploaded = true;
            }
            if($uploaded){
                echo " <script>
                        setTimeout(function(){ swal('Success!', 'The Data has been added successfully!', 'success');},25);
                    </script>";
            }
            else{
                echo " <script>
                        setTimeout(function(){ swal('Error!', 'Please try agine later!', 'error');},25);
                    </script>";
            }
            
        }
        else{
            echo " <script>
                        setTimeout(function(){ swal('Error!', 'Please try agine later!', 'error');},25);
                    </script>";
        }
    }


    function retriveContractAssignmentDetailsForAdmin($conn){
        $sql = "SELECT DISTINCT file_no FROM `tbldocontract` ORDER BY 'file_no' ASC";
		$result0 = $conn->query($sql);
		if(mysqli_num_rows($result0)>=1){
			$num = 1;
			while($row = mysqli_fetch_assoc($result0)){
                $data = fetchBankAccountDetails($conn,$row['file_no']);
				echo "<tr>
						<td>".$num."</td>
						<td>".$row['file_no']."</td>
						<td>".$data['name_of_contract']."</td>
						<td>";
                        echo "<div class='row'>";
                            echo"<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3'>
                                <button type='button' class='btn btn-sm' style='background-color:rgb(0, 120, 172); color: #fff;' name='btnRemove' title='Remove Account' data-toggle='modal' data-target='#myModal".$row['file_no']."'>
                                    <i class='fas fa-plus-square'></i>
                                </button>
                            </div>
                            <div class='col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3'>
                                <button type='button' class='btn btn-sm' style='background-color:rgb(0, 141, 28); color: #fff;' name='btnRemove' title='Remove Account' data-toggle='modal' data-target='#myModal2".$row['file_no']."'>
                                    <i class='fas fa-eye'></i>
                                </button>
                            </div>
                        </div>";
				echo	"</td>";
				echo "</tr>";
				$num++;



                echo "<div class='container'>
                        <!-- The Modal -->
                        <div class='modal fade' id='myModal2".$row['file_no']."'>
                            <div class='modal-dialog modal-xl'>
                                <div class='modal-content'>
                                
                                    <!-- Modal Header -->
                                    <div class='modal-header'>
                                        <h4 class='modal-title'>Added Status of File No : ".ucwords($row['file_no'])."</h4>
                                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                    </div>
                                    
                                    <!-- Modal body -->
                                    <div class='modal-body'>
                                        <div>";
                                        $sql1 = "SELECT * FROM `tbldofeedbacks` WHERE `file_no`='".$row['file_no']."' ORDER BY `date_time` DESC";
		                                $result1 = $conn->query($sql1);
                                        if(mysqli_num_rows($result1)>=1){
                                            $num1 = 1;
                                            echo "<div class='row' style='background-color: black; color: white;'>
                                                        <div class='col-1'>
                                                            <strong>No.</strong>
                                                        </div>
                                                        <div class='col-3'>
                                                            <strong>Title</strong>
                                                        </div>
                                                        <div class='col-3'>
                                                            <strong>Discription</strong>
                                                        </div>
                                                        <div class='col-2'>
                                                            <strong>Responces</strong>
                                                        </div>
                                                        <div class='col-3'>
                                                            <strong>Operations</strong>
                                                        </div>
                                                    </div>";
                                            while($row1 = mysqli_fetch_assoc($result1)){
                                                $rowbgcolor = ($num1%2==0)?"#a6a6a6":"#e3e3e3";
                                                echo "<div class='row' style='background-color: ".$rowbgcolor.";'>
                                                        <div class='col-1'>
                                                            ".$num1."
                                                        </div>
                                                        <div class='col-3'>
                                                            ".ucwords($row1['feedback_title'])."
                                                        </div>
                                                        <div class='col-3'>
                                                            ".$row1['feedback_discrption']."<br><br>";

                                                $sql2 = "SELECT * FROM `tblimagesforfeedback` WHERE `feeback_id`='".$row1['feeback_id']."'";
                                                $result2 = $conn->query($sql2);

                                                if(mysqli_num_rows($result2)>=1){
                                                    echo "<div class='row'>";
                                                    while($row2 = mysqli_fetch_assoc($result2)){
                                                        echo "<a href='".$row2['img_path']."' data-lightbox='photos' target='_blank' class='col-sm-4'>
                                                            <img src='".$row2['img_path']."' class='img-fluid'>
                                                        </a>";
                                                        /*echo "<div class='col-4'>";
                                                        echo "<a class='example-image-link' href='".$row2['img_path']."' data-lightbox='example-set'>";
                                                        echo "<img class='example-image' src='".$row2['img_path']."'>";
                                                        echo "</a>";
                                                        echo "</div>";*/
                                                    }
                                                    echo "</div>";
                                                }
                                                            
                                                echo        "<br/><br/> updated On : ".$row1['date_time']."
                                                        </div>
                                                        <div class='col-2'>
                                                            
                                                        </div>
                                                        <div class='col-3'>
                                                            <div class='row'>
                                                                <div class='col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3'>
                                                                    <form action='#' method='post'>
                                                                        <input type='hidden' name='feeback_id' id='feeback_id' value='".$row1['feeback_id']."'>
                                                                        <button type='button' class='btn btn-sm btn-danger' onclick='validateForm7()' name='btnRemove' id='btnRemove' title='Remove Account' ";
                                                            echo (checkFeedbackHasFeedback($conn,$row1['feeback_id']))?"":"disabled";
                                                                   echo ">
                                                                            <i class='fas fa-trash-alt'></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                                <div class='col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3'>";
                                                        if(!checkFeedbackHasFeedback($conn,$row1['feeback_id'])){
                                                            echo "<button type='button' class='btn btn-sm' style='background-color:rgb(0, 141, 28); color: #fff;' name='btnRemove' title='View Feedbacks' data-toggle='modal' data-target='#myModal3".$row1['feeback_id']."' data-dismiss='myModal2".$row['file_no']."' data-dismiss='modal'>
                                                                <i class='fas fa-eye'></i>
                                                            </button>";


                                                        }
                                                        echo    "</div>
                                                            </div>
                                                        </div>
                                                    </div>";
                                                $num1++;
                                                echo "<div class='container'>
                                                        <!-- The Modal -->
                                                        <div class='modal fade' id='myModal3".$row1['feeback_id']."'>
                                                            <div class='modal-dialog modal-lg'>
                                                                <div class='modal-content'>
                                                                
                                                                    <!-- Modal Header -->
                                                                    <div class='modal-header bg-dark'>
                                                                        <h4 class='modal-title'>Feedbacks From Viewers</h4>
                                                                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                                    </div>
                                                                    
                                                                    <!-- Modal body -->
                                                                    <div class='modal-body'>
                                                                        <div>
                                                                        
                                                                        </div>
                                                                    </div>                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>";
                                            }
                                echo    "</div>";
                                        }
                                echo "</div>                                    
                                </div>
                            </div>
                        </div>
                    </div>";

                    echo "<div class='container'>
                        <!-- The Modal -->
                        <div class='modal fade' id='myModal".$row['file_no']."'>
                            <div class='modal-dialog modal-lg'>
                                <div class='modal-content'>
                                
                                    <!-- Modal Header -->
                                    <div class='modal-header'>
                                        <h4 class='modal-title'>Add Status on ".date("d-m-Y")."</h4>
                                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                    </div>
                                    
                                    <!-- Modal body -->
                                    <div class='modal-body'>
                                        <div>
                                        <form action='#' method='post'  enctype='multipart/form-data'>
                                            <div class='row'>
                                                <div class='col-4'>
                                                    Subject<span style='color: red;'>*</span>
                                                </div>
                                                <div class='col-1'>
                                                    :
                                                </div>
                                                <div class='col-7'>
                                                    <input type='text' name='txtsubject' id='txtsubject' size='47' required/>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-4'>
                                                    Details<span style='color: red;'>*</span>
                                                </div>
                                                <div class='col-1'>
                                                    :
                                                </div>
                                                <div class='col-7'>
                                                    <textarea name='txtdetails' id='txtdetails' cols='50' rows='5' required no-resize></textarea>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-4'>
                                                    Photos (if any)
                                                </div>
                                                <div class='col-1'>
                                                    :
                                                </div>
                                                <div class='col-7'>
                                                    <input type='file' id='photos[]' name='photos[]' accept='.jpeg,.jpg,.png' multiple>
                                                </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-4'>
                                                    
                                                </div>
                                                <div class='col-1'>
                                                    
                                                </div>
                                                <div class='col-7'>
                                                    <input type='hidden' id='fileno' name='fileno' value='".$row['file_no']."'/>
                                                    <button class='btn btn-success' type='submit' id='subdetailsform' name='subdetailsform'>Add</button>
                                                    <button class='btn btn-warning' type='reset'>Reset</button>
                                                    <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>";
                    
			}
		}
    }



    function addTransactionDetails($conn,$file_no,$userid){
        $sql = "INSERT INTO `tbldocontract`(`file_no`, `userid`) VALUES ('".$file_no."','".$userid."')";
		$result = $conn->query($sql);
        if($result){	
            echo " <script>
                        setTimeout(function(){ swal('Success!', 'The Data has been added successfully!', 'success');},25);
                    </script>";
        }
        else{
            echo " <script>
                        setTimeout(function(){ swal('Error!', 'Please try agine later!', 'error');},25);
                    </script>";
        }
    }

    function removeRow($conn,$file_no,$userid){
        $sql = "DELETE FROM `tbldocontract` WHERE file_no='".$file_no."' AND userid='".$userid."'";
		$result = $conn->query($sql);
		if($result){	
            echo " <script>
                        setTimeout(function(){ swal('Success!', 'The Row has been removed successfully!', 'success');},25);
                    </script>";
        }
        else{
            echo " <script>
                        setTimeout(function(){ swal('Error!', 'Please try agine later!', 'error');},25);
                    </script>";
        }
    }

    function fetchTransactionDetails($conn,$rid){
        $sql = "SELECT * FROM `tbltransaction` WHERE `rowid`='".$rid."'";
		$result0 = $conn->query($sql);
        $data = $result0->fetch_assoc();
        return $data;
    }

    function showBankNamesOnOptionsBySelectedForEdit($conn,$bid){
        $sql = "SELECT * FROM `tblbankaccount` ORDER BY 'addeddate' ASC";
		$result0 = $conn->query($sql);
        echo "<option value='NULL' disabled>Select a Bank & Account</option>";
		if(mysqli_num_rows($result0)>=1){
            while($row = mysqli_fetch_assoc($result0)){
                $selected = "";
                $disabled = " disabled";
                if($row['bankaccountid'] == $bid){
                    $selected = " selected";
                    $disabled = "";
                }
                echo "<option value='".$row['bankaccountid']."'".$selected."".$disabled."><strong>".$row['bankname']."</strong> | <tt>".$row['accountnumber']."</tt></option>";
            }
        }
    }

    function editTransactionDetailsByDeposite($conn,$rowid,$chqordeptdate,$amount,$note){
        $sql = "UPDATE `tbltransaction` SET `transactiondate`='".$chqordeptdate."', `money`='".$amount."', `note`='".$note."' WHERE `rowid`='".$rowid."'";
        $result = $conn->query($sql);
		if($result){	
            echo " <script>
                        setTimeout(function(){ swal('Success!', 'The Data has been updated successfully!', 'success');},25);
                    </script>";
        }
        else{
            echo " <script>
                        setTimeout(function(){ swal('Error!', 'Please try agine later!', 'error');},25);
                    </script>";
        }
    }

    function editTransactionDetailsByWithdraw($conn,$rowid,$chqordeptdate,$chequeno,$company,$amount,$note){
        $sql = "UPDATE `tbltransaction` SET `transactiondate`='".$chqordeptdate."', `slporchkno`='".$chequeno."', `transactioncompany`='".$company."', `money`='".$amount."', `note`='".$note."' WHERE `rowid`='".$rowid."'";
        $result = $conn->query($sql);
		if($result){	
            echo " <script>
                        setTimeout(function(){ swal('Success!', 'The Data has been updated successfully!', 'success');},25);
                    </script>";
        }
        else{
            echo " <script>
                        setTimeout(function(){ swal('Error!', 'Please try agine later!', 'error');},25);
                    </script>";
        }
    }

    function showGeneratedReport($conn,$bid,$fdate,$tdate){
        $sql1 = "SELECT * FROM `tbltransaction` WHERE (bid='".$bid."') AND (`transactiondate` BETWEEN '1990-01-01' AND '".$fdate."') ORDER BY `transactiondate` ASC, `addeddate` ASC";
        $result = $conn->query($sql1);
        $untilTotal = 0;
        if(mysqli_num_rows($result)>=1){
            while($row = mysqli_fetch_assoc($result)){
                if($row['type'] == "Deposite"){
                    $untilTotal = $untilTotal + $row['money'];
                }
                else{
                    $untilTotal = $untilTotal - $row['money'];
                }
            }
        }
        $bd = fetchBankAccountDetails($conn,$bid);
        echo "<div class='row'>
                <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                    <h1 align='center'><strong>Transaction Report</strong></h1>
                    <h3 align='center'><strong>From ".$fdate." To ".$tdate."</strong></h3>
                </div>
             </div>";
        echo "<div class='row'>
                <div class='col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6'>
                    <h5 align='left'>Bank : ".$bd['bankname']."</h5>
                </div>
                <div class='col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6'>
                    <h5 align='right'>Account No : ".$bd['accountnumber']."</h5>
                </div>
             </div>";
        echo "<div class='row'>
                <div class='col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4'>
                    <h5 align='left'>From Date : ".$fdate."</h5>
                </div>
                <div class='col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4'>
                    <h5 align='center'>To Date : ".$tdate."</h5>
                </div>
                <div class='col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4'>
                    <h5 align='right'>Balance Start with At ".$fdate." : ".number_format($untilTotal,2)."</h5>
                </div>
             </div>";
        echo "<div class='row'>
                <div class='col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'>
                    <h5 align='center'>#</h5>
                </div>
                <div class='col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2'>
                    <h5 align='center'>Transaction Date</h5>
                </div>
                <div class='col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2'>
                    <h5 align='center'>Transaction Type</h5>
                </div>
                <div class='col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3'>
                    <h5 align='center'>Description</h5>
                </div>
                <div class='col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2'>
                    <h5 align='center'>Amount</h5>
                </div>
                <div class='col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2'>
                    <h5 align='center'>Balance</h5>
                </div>
             </div>";
        $sql2 = "SELECT * FROM `tbltransaction` WHERE (bid='".$bid."') AND (`transactiondate` BETWEEN '".$fdate."' AND '".$tdate."') ORDER BY `transactiondate` ASC, `addeddate` ASC";
        $result2 = $conn->query($sql2);
        if(mysqli_num_rows($result2)>=1){
            $no = 1;
            while($row2 = mysqli_fetch_assoc($result2)){
                if($row2['type'] == "Deposite"){
                    $untilTotal = $untilTotal + $row2['money'];
                    echo "<div class='row'>
                            <div class='col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'>
                                <h5 align='right'>".$no."</h5>
                            </div>
                            <div class='col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2'>
                                <h5 align='left'>".$row2['transactiondate']."</h5>
                            </div>
                            <div class='col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2'>
                                <h5 align='left'>".$row2['type']."</h5>
                            </div>
                            <div class='col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3'>
                                <h5 align='left'>Deposite</h5>
                            </div>
                            <div class='col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2'>
                                <h5 align='right' style='color: green;'>Rs +".number_format($row2['money'],2)."</h5>
                            </div>
                            <div class='col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2'>
                                <h5 align='right' style='color: blue;'>Rs ".number_format($untilTotal,2)."</h5>
                            </div>
                         </div>";
                }
                else{
                    $untilTotal = $untilTotal - $row2['money'];
                    echo "<div class='row'>
                            <div class='col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'>
                                <h5 align='right'>".$no."</h5>
                            </div>
                            <div class='col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2'>
                                <h5 align='left'>".$row2['transactiondate']."</h5>
                            </div>
                            <div class='col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2'>
                                <h5 align='left'>".$row2['type']."</h5>
                            </div>
                            <div class='col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3'>
                                <h5 align='left'>Cheque No : ".$row2['slporchkno']."  | Company : ".$row2['transactioncompany']." | Note : ".$row2['note']."</h5>
                            </div>
                            <div class='col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2'>
                                <h5 align='right' style='color: red;'>Rs -".number_format($row2['money'],2)."</h5>
                            </div>
                            <div class='col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2'>
                                <h5 align='right' style='color: blue;'>Rs ".number_format($untilTotal,2)."</h5>
                            </div>
                         </div>";
                }
                $no++;
            }
                echo "<div class='row'>
                        <div class='col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10'>
                            <h5 align='left'>Final Balance at ".$tdate."</h5>
                        </div>
                        <div class='col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2'>
                            <h5 align='right' style='color: blue;'>Rs ".number_format($untilTotal,2)."</h5>
                        </div>
                     </div>";
        }
        else{
            echo "<div class='row'>
                    <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                        <h5 align='center'>No Transactions have been done in this time</h5>
                    </div>
                 </div>";
        }
    }

    function showDashboardDetails($conn,$userid){
        $sql = "SELECT * FROM `tbluser`";
		$result = $conn->query($sql);
        $noOfUsers = 0;
        while($row = mysqli_fetch_assoc($result)){
            $noOfUsers += 1;
        }

        $sql1 = "SELECT * FROM `tblcontract`";
		$result1 = $conn->query($sql1);
        $noOfBank = 0;
        while($row1 = mysqli_fetch_assoc($result1)){
            $noOfBank += 1;
        }

        $sql2 = "SELECT * FROM `tbldofeedbacks`";
		$result2 = $conn->query($sql2);
        $noOfRecord = 0;
        while($row2 = mysqli_fetch_assoc($result2)){
            $noOfRecord += 1;
        }

        $sql02 = "SELECT * FROM `tblfeedbacksfeedback`";
		$result02 = $conn->query($sql02);
        while($row02 = mysqli_fetch_assoc($result02)){
            $noOfRecord += 1;
        }

        $sql3 = "SELECT * FROM `tbluser` WHERE `userid`='".$userid."'";
		$result3 = $conn->query($sql3);
        $data = $result3->fetch_assoc();
        $profileOutof13 = 0;
        $profileProp = array();

        if($data['userid'] != ""){
            $profileOutof13 += 1;
        }

        if($data['password'] != ""){
            $profileOutof13 += 1;
        }

        if($data['name'] != ""){
            $profileOutof13 += 1;
        }

        if($data['email'] != ""){
            $profileOutof13 += 1;
        }

        if($data['pno'] != ""){
            $profileOutof13 += 1;
        }
        else{
            $profileProp[] = "No Phone Number Added";
        }

        if($data['sq1'] != ""){
            $profileOutof13 += 1;
        }
        else{
            $profileProp[] = "No Securty Question 1 Added";
        }

        if($data['sqa1'] != ""){
            $profileOutof13 += 1;
        }
        else{
            $profileProp[] = "No Securty Question 1 Answer Added";
        }

        if($data['sq2'] != ""){
            $profileOutof13 += 1;
        }
        else{
            $profileProp[] = "No Securty Question 2 Added";
        }

        if($data['sqa2'] != ""){
            $profileOutof13 += 1;
        }
        else{
            $profileProp[] = "No Securty Question 2 Answer Added";
        }

        if($data['usertype'] != ""){
            $profileOutof13 += 1;
        }

        if($data['addeddate'] != ""){
            $profileOutof13 += 1;
        }

        if($data['status'] != ""){
            $profileOutof13 += 1;
        }

        if($data['password'] != md5(md5($data['nicno']))){
            $profileOutof13 += 1;
        }
        else{
            $profileProp[] = "Your Password is Default. Please Customize it.";
        }

        $profileOutof13persentage = ($profileOutof13 / 13) * 100;
        $profileOutof13persentage = number_format($profileOutof13persentage,2);

        $outputarray = array("noOfUsers"=>$noOfUsers,"noOfBank"=>$noOfBank,"noOfRecord"=>$noOfRecord,"profileOutof13persentage"=>$profileOutof13persentage,"profileProp"=>$profileProp);

        return $outputarray;
    }

    function showAddedBankDetails($conn){
        $sql1 = "SELECT * FROM `tblbankaccount`";
		$result1 = $conn->query($sql1);
        while($row1 = mysqli_fetch_assoc($result1)){
            $fetchBAD = getTransactionDetailsWithBankId($conn,$row1['bankaccountid']);
            echo "<div class='row' id='bankseperatedetails'>
                    <div class='col-lg-12'>
                        <div class='row'>
                            <div class='col-lg-12'>
                                Bank Name : ".$row1['bankname']." | Account No : ".$row1['accountnumber']." | Added Date : ".$row1['addeddate']." | Status : ".$row1['status']."
                            </div>
                        </div>

                        <div class='row'>
                            <div class='col-lg-6'>
                                <div class='card card-hover'>
                                    <div class='box bg-cyan text-center'>
                                        <h1 class='font-light text-white'><i class='fa fa-money-bill-alt mb-1 font-48'></i></h1>
                                        <h2 class='mb-0 mt-1 text-white'>".$fetchBAD['lasttransactionamount']."</h2>
                                        <small class='font-light text-white'>Last Transation | ".$fetchBAD['lasttransactiondate']." | ".$fetchBAD['lasttransactiontype']."</small>
                                    </div>
                                </div>
                            </div>
                            <div class='col-lg-6'>
                                <div class='card card-hover'>
                                    <div class='box bg-info text-center'>
                                        <h1 class='font-light text-white'><i class='fa fa-piggy-bank mb-1 font-48'></i></h1>
                                        <h2 class='mb-0 mt-1 text-white'>".$fetchBAD['totalamount']."</h2>
                                        <small class='font-light text-white'>Total Sum in This Account | 
                                            <span>
                                                <script type='text/javascript'>
                                                    document.write ('<span id='date-time'>', new Date().toLocaleString(), '<\/span>.')
                                                    if (document.getElementById) onload = function () {
                                                        setInterval ('document.getElementById ('date-time').firstChild.data = new Date().toLocaleString()', 50)
                                                    }
                                                </script>
                                            </span>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class='row'>
                    <div class='col-lg-12'>
                    <p></p>
                    </div>
                 </div>";
        }
    }

    function getTransactionDetailsWithBankId($conn,$bid)  {  
        $output = '';  
        $query = "SELECT * FROM `tbltransaction` WHERE bid='".$bid."' ORDER BY `transactiondate` DESC, `addeddate` DESC";  
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
        $query0 = "SELECT * FROM `tbltransaction` WHERE bid='".$bid."' ORDER BY `transactiondate` ASC, `addeddate` ASC";  
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
        return $output;  
    }  

    function chkNICNoInDB($conn,$nicno){
        $sql = "SELECT * FROM `tbluser` WHERE nicno='".$nicno."'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>=1){
			return true;
		}
		else{
			return false;
		}

    }

    function searchNICNoForResetPassword($conn,$nicno){
        $sql = "SELECT * FROM `tbluser` WHERE nicno='".$nicno."'";
        $result = mysqli_query($conn,$sql);
        $data = $result->fetch_assoc(); 
        return $data;
    }

    function updateNICNoAsPwd($conn,$userid,$nicno){
        $newPass = md5($nicno);
        $newPass = md5($newPass);
        $sql = "UPDATE `tbluser` SET `password`='".$newPass."' WHERE `userid`='".$userid."'";
        $result = mysqli_query($conn,$sql);
        if($result){	
            return true;
        }
        else{
            return false;
        }
    }
?>

