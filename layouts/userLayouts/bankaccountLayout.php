<?php
    if(isset($_POST['btnaddbankaccount'])){
        addBankDetails($conn,$_POST['bname'],$_POST['bano']);
    }
?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Bank Account</h4>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="user.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Bank Account</li>
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
            <div class="card">
                <form class="form-horizontal" method="POST" name="addbankaccountform" id="addbankaccountform">
                    <div class="card-body">
                        <h4 class="card-title">Add Bank Account</h4>
                        <div class="form-group row">
                            <label for="bname" class="col-sm-2 text-end control-label col-form-label">Bank Name*</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="bname" name="bname" placeholder="Bank Name Here" required>
                            </div>
                            <label for="bano" class="col-sm-2 text-end control-label col-form-label">Account No*</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="bano" name="bano" placeholder="Account No Here" required>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" name="btnaddbankaccount" id="btnaddbankaccount" class="btn btn-success">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Bank Accounts Details</h5>
                    <div class="table-responsive">
                        <table id="backaccountdetailtable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Bank Name</th>
                                    <th>Account No</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    showBankAccountsForUser($conn);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>