<?php
    if(isset($_POST['btnGeneralUpdate'])){
        if(!($_POST['name'] == ucwords($userData['name']) && $_POST['pno'] == $userData['pno'] && $_POST['email'] == $userData['email'] && $_POST['nicno'] == strtoupper($userData['nicno']))){
            updateGeneralDetails($conn,$_POST['name'],$_POST['email'],$_POST['pno'],$_POST['nicno'],$_POST['userid']);
        }
    }

    if(isset($_POST['btnSeurityUpdate'])){
        if(!($_POST['q1'] == $userData['sq1'] && $_POST['a1'] == $userData['sqa1'] && $_POST['q2'] == $userData['sq2'] && $_POST['a2'] == $userData['sqa2'])){
            updateSecurityDetails($conn,$_POST['q1'],$_POST['a1'],$_POST['q2'],$_POST['a2'],$_POST['useridhide1']);
        }
    }

    if(isset($_POST['btnPasswordUpdate'])){
        if(!($_POST['opwd'] == "" && $_POST['npwd'] == "" && $_POST['cnpwd'] == "")){
            updatePasswordDetails($conn,$_POST['opwd'],$_POST['npwd'],$_POST['cnpwd'],$_POST['useridhide2']);
        }
    }
?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Profile</h4>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="user.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form class="form-horizontal" method="POST" name="updatebasicdetailform" id="updatebasicdetailform" action="user.php?profile">
                    <div class="card-body">
                        <h4 class="card-title">General Details</h4>
                        <div class="form-group row">
                            <label for="userid" class="col-sm-3 text-end control-label col-form-label">User ID*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="userid" name="userid" value="<?=$userData['userid'];?>" readonly required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 text-end control-label col-form-label">Name*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" value="<?=ucwords($userData['name']);?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nicno" class="col-sm-3 text-end control-label col-form-label">NIC No*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nicno" name="nicno" value="<?=strtoupper($userData['nicno']);?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pno" class="col-sm-3 text-end control-label col-form-label">Phone No*</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="pno" name="pno" value="<?=$userData['pno'];?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 text-end control-label col-form-label">Email*</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email" value="<?=$userData['email'];?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="utype" class="col-sm-3 text-end control-label col-form-label">User Type</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="utype" name="utype" value="<?=$userData['usertype'];?>" required readonly>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" name="btnGeneralUpdate" id="btnGeneralUpdate" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <form class="form-horizontal" method="POST" name="updatesecuritydetails" id="updatesecuritydetails" action="user.php?profile">
                    <div class="card-body">
                        <h4 class="card-title">Security Details</h4>
                        <div class="form-group row">
                            <label for="q1" class="col-sm-3 text-end control-label col-form-label">Question 1*</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="q1" name="q1" value="" required>
                                    <option value="In what city were you born?" <?=($userData['sq1'] == "In what city were you born?")?"selected":"";?>>In what city were you born?</option>
                                    <option value="What is the name of your favorite pet?" <?=($userData['sq1'] == "What is the name of your favorite pet?")?"selected":"";?>>What is the name of your favorite pet?</option>
                                    <option value="What is your mother's maiden name?" <?=($userData['sq1'] == "What is your mother's maiden name?")?"selected":"";?>>What is your mother's maiden name?</option>
                                    <option value="What high school did you attend?" <?=($userData['sq1'] == "What high school did you attend?")?"selected":"";?>>What high school did you attend?</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="a1" class="col-sm-3 text-end control-label col-form-label">Answer 1*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="a1" name="a1" value="<?=$userData['sqa1'];?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="q2" class="col-sm-3 text-end control-label col-form-label">Question 2*</label>
                            <div class="col-sm-9">
                                <select type="text" class="form-control" id="q2" name="q2" value="" required>
                                    <option value="What is the name of your first school?" <?=($userData['sq2'] == "What is the name of your first school?")?"selected":"";?>>What is the name of your first school?</option>
                                    <option value="What was the make of your first car?" <?=($userData['sq2'] == "What was the make of your first car?")?"selected":"";?>>What was the make of your first car?</option>
                                    <option value="What was your favorite food as a child?" <?=($userData['sq2'] == "What was your favorite food as a child?")?"selected":"";?>>What was your favorite food as a child?</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="a2" class="col-sm-3 text-end control-label col-form-label">Answer 2*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="a2" name="a2" value="<?=$userData['sqa2'];?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <input type="hidden" class="form-control" id="useridhide1" name="useridhide1" value="<?=$userData['userid'];?>">
                            <button type="submit" name="btnSeurityUpdate" id="btnSeurityUpdate" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form class="form-horizontal" method="POST" name="updatepassword" id="updatepassword" action="user.php?profile">
                    <div class="card-body">
                        <h4 class="card-title">Change Password</h4>
                        <div class="form-group row">
                            <label for="opwd" class="col-sm-3 text-end control-label col-form-label">Old Password*</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="opwd" name="opwd" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="npwd" class="col-sm-3 text-end control-label col-form-label">New Password*</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="npwd" name="npwd" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cnpwd" class="col-sm-3 text-end control-label col-form-label">Confirm New Password*</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="cnpwd" name="cnpwd" required>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <input type="hidden" class="form-control" id="useridhide2" name="useridhide2" value="<?=$userData['userid'];?>">
                            <button type="submit" name="btnPasswordUpdate" id="btnPasswordUpdate" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>