<?php
    /*if(isset($_POST['btnaddtransaction'])){
        addTransactionDetails($conn,$_POST['bid'],$_POST['chqordeptdate'],$_POST['transactiontype'],$_POST['chequeno'],$_POST['company'],$_POST['amount']);
    }*/

    if(isset($_POST['txtsubject'])){
        if($_FILES['photos']['name']==""){
            addStatusOnFileWithoutPhotos($conn,$_POST['fileno'],$_POST['userid'],$_POST['txtsubject'],$_POST['txtdetails']);
        }
        else{
            addStatusOnFileWithPhotos($conn,$_POST['fileno'],$_POST['userid'],$_POST['txtsubject'],$_POST['txtdetails'],$_FILES['photos']['name'],$_FILES['photos']['tmp_name']);
        }
    }

    if(isset($_POST['feeback_id'])){
        delAFeedback($conn,$_POST['feeback_id']);
    }
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
                        <li class="breadcrumb-item"><a href="user.php">Home</a></li>
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
                                        <th>Operations</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodytd">
                                    <?php
                                        retriveContractAssignmentDetailsByUID($conn,$userData['userid']);
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