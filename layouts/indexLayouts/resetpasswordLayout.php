<div id="recoverform">
    <?php
        if(isset($_POST['resetpwdnicno'])){
            $chkIsUserAvailable = chkNICNoInDB($conn,$_POST['resetnicno']);
            if($chkIsUserAvailable){
                $data = searchNICNoForResetPassword($conn,$_POST['resetnicno']);
                if($data['sq1']!='' && $data['sq2']!='' && $data['sqa1']!='' && $data['sqa2']!=''){
                    if(isset($_POST['submitanswers'])){
                        if((strtolower($_POST['a1']) == strtolower($data['sqa1'])) && (strtolower($_POST['a2']) == strtolower($data['sqa2']))){
                            $isupdated = updateNICNoAsPwd($conn,$data['userid'],$data['nicno']);
                            if($isupdated){
                                ?>
                                    <div class="text-center">
                                        <span class="text-white">Your Password has been changed. You can login with your NIC No as New Password. Your Username is <?=$data['userid'];?><br> <a href="index.php"> <i class="ti-arrow-left"></i> Go Login Page</a></span>
                                    </div>
                                <?php
                            }
                            else{
                                ?>
                                    <div class="text-center">
                                        <span class="text-white">There is a proble in updating. Please inform your admin.<br> <a href="index.php?recover"> <i class="ti-arrow-left"></i> Go Recovery Page</a></span>
                                    </div>
                                <?php
                            }
                        }
                        else{
                            ?>
                                <div class="text-center">
                                    <span class="text-white">Your Answers are not correct or partialy correct. Please enter correct answers please or contact your admin.<br> <a href="index.php?recover"> <i class="ti-arrow-left"></i> Go Recovery Page</a></span>
                                </div>
                            <?php
                        }
                    }
                    else{
                        ?>
                            <div class="text-center">
                                <span class="text-white">Answers the Questions which are determin by you.<br> <a href="index.php"> <i class="ti-arrow-left"></i> Go Login Page</a></span>
                            </div>
                            <div class="row mt-3">
                                <!-- Form -->
                                <form class="col-12" action="index.php?recover" method="POST">
                                    <!-- email -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-danger text-white h-100" id="basic-addon1">Question 1</span>
                                        </div>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white h-100" id="basic-addon1"><?=$data['sq1'];?></span>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-danger text-white h-100" id="basic-addon1">Answer 1</span>
                                        </div>
                                        <input type="text" name="a1" class="form-control form-control-lg" placeholder="Enter Your Answer" required>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-danger text-white h-100" id="basic-addon1">Question 2</span>
                                        </div>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-secondary text-white h-100" id="basic-addon1"><?=$data['sq2'];?></span>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-danger text-white h-100" id="basic-addon1">Answer 2</span>
                                        </div>
                                        <input type="text" name="a2" class="form-control form-control-lg" placeholder="Enter Your Answer" required>
                                    </div>
                                    <!-- pwd -->
                                    <div class="row mt-3 pt-3 border-top border-secondary">
                                        <div class="col-12">
                                            <a class="btn btn-success text-white" href="index.php?recover" id="to-login" name="action">NIC No Search</a>
                                            <button class="btn btn-info float-end" type="submit" name="submitanswers">Submit Answers</button>
                                            <input type="hidden" name="resetpwdnicno" value="<?=$_POST['resetpwdnicno'];?>">
                                            <input type="hidden" name="resetnicno" value="<?=$_POST['resetnicno'];?>">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php
                    }
                }
                else{
                    ?>
                        <div class="text-center">
                            <span class="text-white">Youshould inform your admin to change your password because you didn't select a security question and answers for this recovery section.<br> <a href="index.php"> <i class="ti-arrow-left"></i> Go Login Page</a></span> 
                        </div>
                    <?php
                }
            }
            else{
                ?>
                    <div class="text-center">
                        <span class="text-white">This NIC No is not in this system. Please Check your NIC No or Contact Admin.<br> <a href="index.php"> <i class="ti-arrow-left"></i> Go Login Page</a></span> 
                    </div>
                <?php
            }
        }
        else{
            ?>
                <div class="text-center">
                    <span class="text-white">Enter your NIC No (If your NIC No with letter like 'V' then you have to type it in capital letter) below and you can recover your account with new password.</span>
                </div>
                <div class="row mt-3">
                    <!-- Form -->
                    <form class="col-12" action="index.php?recover" method="POST">
                        <!-- email -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-danger text-white h-100" id="basic-addon1"><i class="ti-id-badge"></i></span>
                            </div>
                            <input type="text" name="resetnicno" class="form-control form-control-lg" placeholder="NIC No" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <!-- pwd -->
                        <div class="row mt-3 pt-3 border-top border-secondary">
                            <div class="col-12">
                                <a class="btn btn-success text-white" href="index.php" id="to-login" name="action">Back To Login</a>
                                <button class="btn btn-info float-end" type="submit" name="resetpwdnicno">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php
        }
    ?>        
</div>