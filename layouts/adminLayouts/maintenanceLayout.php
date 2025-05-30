<?php
    /*if(isset($_POST['btnaddtransaction'])){
        addTransactionDetails($conn,$_POST['file_no'],$_POST['userid']);
    }
    if(isset($_POST['txtRemoveFileNo'])){
        removeRow($conn,$_POST['txtRemoveFileNo'],$_POST['txtRemoveUserId']);
    }*/
    /*if(isset($_POST['btnedittransaction'])){
        if($_POST['transactiontype'] == "Deposite"){
            editTransactionDetailsByDeposite($conn,$_POST['rowid'],$_POST['echqordeptdate'],$_POST['amount'],$_POST['note']);
        }
        else{
            editTransactionDetailsByWithdraw($conn,$_POST['rowid'],$_POST['echqordeptdate'],$_POST['chequeno'],$_POST['company'],$_POST['amount'],$_POST['note']);
        }
    }*/
?>

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Maintenance</h4>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Maintenance</li>
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
                    <form class="form-horizontal" action="" method="POST" name="addmaintancedetailsform" id="addmaintancedetailsform">
                        <div class="card-body">
                            <h4 class="card-title">Assign Contracts to TOs</h4>
                            <div class="form-group row">
                                <label for="bid" class="col-sm-2 text-end control-label col-form-label">Contract Name*</label>
                                <div class="col-sm-10">
                                    <select class="select2 form-select shadow-none" id="file_no" name="file_no" require>
                                        <?php
                                            if(isset($_POST['bid'])){
                                                showBankNamesOnOptionsBySelected($conn,$_POST['bid']);
                                            }
                                            else{
                                                showBankNamesOnOptions($conn);
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bid" class="col-sm-2 text-end control-label col-form-label">TO's Name*</label>
                                <div class="col-sm-10">
                                    <select class="select2 form-select shadow-none" id="userid" name="userid" require>
                                        <?php
                                            if(isset($_POST['bid'])){
                                                showBankNamesOnOptionsBySelected1($conn,$_POST['bid']);
                                            }
                                            else{
                                                showBankNamesOnOptions1($conn);
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" name="btnaddtransaction" id="btnaddtransaction" class="btn btn-success">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>

    <div class="row">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Assignment Details</h5>
                        <div class="table-responsive">
                            <table id="transactiondetailtable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>File No</th>
                                        <th>Contract No</th>
                                        <th>Assigned TOs</th>
                                        <th>Operations</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodytd">
                                    <?php
                                        retriveContractAssignmentDetails($conn);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>