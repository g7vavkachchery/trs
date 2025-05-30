<?php
    if(isset($_POST['file_no'])){
        addBankDetails($conn,$_POST['file_no'],$_POST['name_of_work'],$_POST['name_of_contract'],$_POST['agreement_no'],$_POST['agreement_date'],$_POST['allocation_of_work'],$_POST['estemate_amount'],$_POST['contract_amount'],$_POST['date_of_commencement'],$_POST['actual_date_of_completion']);
    }
    if(isset($_POST['txtRemoveSiteAccount'])){
        removeSiteAccount($conn,$_POST['txtRemoveSiteAccount']);
    }
    /*if(isset($_POST['txtBlockSiteAccount'])){
        blockSiteAccount($conn,$_POST['txtBlockSiteAccount']);
    }
    if(isset($_POST['txtActiveSiteAccount'])){
        activateSiteAccount($conn,$_POST['txtActiveSiteAccount']);
    }*/
    if(isset($_POST['btneditbankaccount'])){
        editAccount($conn,$_POST['edit_file_no'],$_POST['edit_name_of_work'],$_POST['edit_name_of_contract'],$_POST['edit_agreement_no'],$_POST['edit_agreement_date'],$_POST['edit_allocation_of_work'],$_POST['edit_estemate_amount'],$_POST['edit_contract_amount'],$_POST['edit_date_of_commencement'],$_POST['edit_actual_date_of_completion']);
    }
?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Contracts</h4>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
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
            <?php
                if(isset($_GET['ebid'])){
                    $bankDataForEditing = fetchBankAccountDetails($conn,$_GET['ebid']);
            ?>
                <div class="card">
                    <form action="admin.php?bankaccounts" class="form-horizontal" method="POST" name="editbankaccountform" id="editbankaccountform">
                        <div class="card-body">
                            <h4 class="card-title">Edit Contract</h4>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="file_no" class="form-label">File No</label>
                                    <input type="text" class="form-control" id="edit_file_no" name="edit_file_no" value="<?=$bankDataForEditing['file_no'];?>" readonly required>
                                </div>
                                <div class="mb-3">
                                    <label for="name_of_work" class="form-label">Name of Work</label>
                                    <input type="text" class="form-control" id="edit_name_of_work" name="edit_name_of_work" value="<?=$bankDataForEditing['name_of_work'];?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="name_of_contract" class="form-label">Name of Contract</label>
                                    <input type="text" class="form-control" id="edit_name_of_contract" name="edit_name_of_contract" value="<?=$bankDataForEditing['name_of_contract'];?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="agreement_no" class="form-label">Agreement No</label>
                                    <input type="text" class="form-control" id="edit_agreement_no" name="edit_agreement_no" value="<?=$bankDataForEditing['agreement_no'];?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="agreement_date" class="form-label">Agreement Date</label>
                                    <input type="date" class="form-control" id="edit_agreement_date" name="edit_agreement_date" value="<?=$bankDataForEditing['agreement_date'];?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="allocation_of_work" class="form-label">Allocation of Work</label>
                                    <input type="number" class="form-control" id="edit_allocation_of_work" name="edit_allocation_of_work" value="<?=$bankDataForEditing['allocation_of_work'];?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="estemate_amount" class="form-label">Estemate Amount</label>
                                    <input type="number" class="form-control" id="edit_estemate_amount" name="edit_estemate_amount" value="<?=$bankDataForEditing['estemate_amount'];?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="contract_amount" class="form-label">Contract Amount</label>
                                    <input type="number" class="form-control" id="edit_contract_amount" name="edit_contract_amount" value="<?=$bankDataForEditing['contract_amount'];?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="date_of_commencement" class="form-label">Date of Commencement</label>
                                    <input type="date" class="form-control" id="edit_date_of_commencement" name="edit_date_of_commencement" value="<?=$bankDataForEditing['date_of_commencement'];?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="actual_date_of_completion" class="form-label">Actual Date of Completion</label>
                                    <input type="date" class="form-control" id="edit_actual_date_of_completion" name="edit_actual_date_of_completion" value="<?=$bankDataForEditing['actual_date_of_completion'];?>" required>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" name="btneditbankaccount" id="btneditbankaccount" class="btn btn-success">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php
                }
                else{
            ?>
                <div class="card">
                <form action="#" method="POST">
                    <div class="card-body">
                    <h4 class="card-title">Add Contract</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="file_no" class="form-label">File No</label>
                        <input type="text" class="form-control" id="file_no" name="file_no" required>
                    </div>
                    <div class="mb-3">
                        <label for="name_of_work" class="form-label">Name of Work</label>
                        <input type="text" class="form-control" id="name_of_work" name="name_of_work" required>
                    </div>
                    <div class="mb-3">
                        <label for="name_of_contract" class="form-label">Name of Contract</label>
                        <input type="text" class="form-control" id="name_of_contract" name="name_of_contract" required>
                    </div>
                    <div class="mb-3">
                        <label for="agreement_no" class="form-label">Agreement No</label>
                        <input type="text" class="form-control" id="agreement_no" name="agreement_no" required>
                    </div>
                    <div class="mb-3">
                        <label for="agreement_date" class="form-label">Agreement Date</label>
                        <input type="date" class="form-control" id="agreement_date" name="agreement_date" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="allocation_of_work" class="form-label">Allocation of Work</label>
                        <input type="number" class="form-control" id="allocation_of_work" name="allocation_of_work" required>
                    </div>
                    <div class="mb-3">
                        <label for="estemate_amount" class="form-label">Estemate Amount</label>
                        <input type="number" class="form-control" id="estemate_amount" name="estemate_amount" required>
                    </div>
                    <div class="mb-3">
                        <label for="contract_amount" class="form-label">Contract Amount</label>
                        <input type="number" class="form-control" id="contract_amount" name="contract_amount" required>
                    </div>
                    <div class="mb-3">
                        <label for="date_of_commencement" class="form-label">Date of Commencement</label>
                        <input type="date" class="form-control" id="date_of_commencement" name="date_of_commencement" required>
                    </div>
                    <div class="mb-3">
                        <label for="actual_date_of_completion" class="form-label">Actual Date of Completion</label>
                        <input type="date" class="form-control" id="actual_date_of_completion" name="actual_date_of_completion" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
            <button type="reset" class="btn btn-warning">Reset</button>
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
                    <h5 class="card-title">Bank Accounts Details</h5>
                    <div class="table-responsive">
                        <table id="backaccountdetailtable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>File No</th>
                                    <th>Name of Work</th>
                                    <th>Name of Contract</th>
                                    <th>Agreement No</th>
                                    <th>Agreement Date</th>
                                    <th>Allocation of Work</th>
                                    <th>Estimate Amount</th>
                                    <th>Contract Amount</th>
                                    <th>Date of Commencement</th>
                                    <th>Actual Date of Completion</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    showBankAccounts($conn);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>