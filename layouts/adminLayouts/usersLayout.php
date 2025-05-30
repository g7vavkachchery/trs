<?php
    $uid = genUserID($conn);
    if(isset($_POST['btnadduser'])){
        addUser($conn,$_POST['sname'],$_POST['semail'],$_POST['snicno'],$_POST['spno'],$_POST['suserid'],$_POST['usertype']);
    }
    if(isset($_POST['txtRemoveSiteUser'])){
        removeSiteUser($conn,$_POST['txtRemoveSiteUser']);
    }
    if(isset($_POST['txtBlockSiteUser'])){
        blockSiteUser($conn,$_POST['txtBlockSiteUser']);
    }
    if(isset($_POST['txtActiveSiteUser'])){
        activateSiteUser($conn,$_POST['txtActiveSiteUser']);
    }
    if(isset($_POST['txtResetSiteUserPassword'])){
        userPasswordReset($conn,$_POST['txtResetSiteUserPassword']);
    }
    if(isset($_POST['btnedituser'])){
        editUser($conn,$_POST['sname'],$_POST['semail'],$_POST['snicno'],$_POST['spno'],$_POST['suserid'],$_POST['usertype']);
    }
?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Users</h4>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
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
        <div class="col-md-12">
            <?php
                if(isset($_GET['euid'])){
                    $userDataForEditing = fetchUsersLoginDetailsForAllDetails($conn,$_GET['euid']);
            ?>
                    <div class="card">
                        <form class="form-horizontal" method="POST" name="edituserform" id="edituserform" action="admin.php?users">
                            <div class="card-body">
                                <h4 class="card-title">Edit User - <?=$_GET['euid'];?></h4>
                                <div class="form-group row">
                                    <label for="sname" class="col-sm-2 text-end control-label col-form-label">Staff Name*</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="sname" name="sname" placeholder="Staff Name Here" value="<?=$userDataForEditing['name'];?>" required>
                                    </div>
                                    <label for="semail" class="col-sm-2 text-end control-label col-form-label">Staff Email</label>
                                    <div class="col-sm-4">
                                        <input type="email" class="form-control" id="semail" name="semail" placeholder="Staff Email Here" value="<?=$userDataForEditing['email'];?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="snicno" class="col-sm-2 text-end control-label col-form-label">Staff NIC No*</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="snicno" name="snicno" placeholder="Staff NIC No Here" value="<?=$userDataForEditing['nicno'];?>" required>
                                    </div>
                                    <label for="spno" class="col-sm-2 text-end control-label col-form-label">Staff Phone No</label>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" id="spno" name="spno" placeholder="Staff Phone No Here" value="<?=$userDataForEditing['pno'];?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="suserid" class="col-sm-2 text-end control-label col-form-label">User ID*</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="suserid" name="suserid" placeholder="Staff NIC No Here" value="<?=$userDataForEditing['userid'];?>" required readonly>
                                    </div>
                                    <label for="usertype" class="col-sm-2 text-end control-label col-form-label">User Type*</label>
                                    <div class="col-sm-4">
                                        <select class="select2 form-select shadow-none" id="usertype" name="usertype" require>
                                            <option value="TO" <?=($userDataForEditing['usertype']=="TO")?"selected":"";?>>TO</option>
                                            <option value="Supervisor" <?=($userDataForEditing['usertype']=="Supervisor")?"selected":"";?>>Supervisor</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" name="btnedituser" id="btnedituser" class="btn btn-success">Edit</button>
                                </div>
                            </div>
                        </form>
                    </div>
            <?php
                }else{
            ?>
                    <div class="card">
                        <form class="form-horizontal" method="POST" name="adduserform" id="adduserform" action="admin.php?users">
                            <div class="card-body">
                                <h4 class="card-title">Add User</h4>
                                <div class="form-group row">
                                    <label for="sname" class="col-sm-2 text-end control-label col-form-label">Staff Name*</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="sname" name="sname" placeholder="Staff Name Here" required>
                                    </div>
                                    <label for="semail" class="col-sm-2 text-end control-label col-form-label">Staff Email</label>
                                    <div class="col-sm-4">
                                        <input type="email" class="form-control" id="semail" name="semail" placeholder="Staff Email Here">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="snicno" class="col-sm-2 text-end control-label col-form-label">Staff NIC No*</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="snicno" name="snicno" placeholder="Staff NIC No Here" required>
                                    </div>
                                    <label for="spno" class="col-sm-2 text-end control-label col-form-label">Staff Phone No</label>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" id="spno" name="spno" placeholder="Staff Phone No Here">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="suserid" class="col-sm-2 text-end control-label col-form-label">User ID*</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="suserid" name="suserid" placeholder="Staff NIC No Here" value="<?=$uid;?>" required readonly>
                                    </div>
                                    <label for="usertype" class="col-sm-2 text-end control-label col-form-label">User Type*</label>
                                    <div class="col-sm-4">
                                        <select class="select2 form-select shadow-none" id="usertype" name="usertype" require>
                                            <option value="TO" selected>TO</option>
                                            <option value="Supervisor">Supervisor</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" name="btnadduser" id="btnadduser" class="btn btn-success">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
            <?php
                }
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Users Details</h5>
                    <div class="table-responsive">
                        <table id="userdetailtable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>User ID</th>
                                    <th>Email</th>
                                    <th>NIC No</th>
                                    <th>Phone No</th>
                                    <th>User Type</th>
                                    <th>Status</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    showSiteUsers($conn);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>