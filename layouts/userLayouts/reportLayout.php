<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Reports</h4>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="user.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Reports</li>
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
                <form class="form-horizontal" method="POST" name="viewreportform" id="viewreportform">
                    <div class="card-body">
                        <h4 class="card-title">Generate Report</h4>
                        <div class="form-group row">
                            <label for="bname" class="col-sm-2 text-end control-label col-form-label">Bank Name*</label>
                            <div class="col-sm-10">
                                <select class="select2 form-select shadow-none" id="bid" name="bid" require>
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
                            <label for="fdate" class="col-sm-2 text-end control-label col-form-label">From Date*</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="fdate" id="fdate" placeholder="Enter From Date Here" value="<?=(isset($_POST['fdate']))?$_POST['fdate']:date("Y-m-d");?>" required>
                            </div>
                            <label for="todate" class="col-sm-2 text-end control-label col-form-label">To Date*</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="tdate" id="tdate" placeholder="Enter To Date Here" value="<?=(isset($_POST['tdate']))?$_POST['tdate']:date("Y-m-d");?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" name="btngeneratereport" id="btngeneratereport" class="btn btn-success">Generate</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <?php
                      if(isset($_POST['btngeneratereport'])){
                        ?>
                          <div class="btn-group my-3" role="group" aria-label="Basic example">
                            <button id="printTestBillsReport" class="btn btn-dark" onclick="printTPR();"><i class="fas fa-print"></i> Print</button>
                            <button id="downloadTestBillsReport" class="btn btn-dark" onclick="downloadTPR();"><i class="fas fa-file-pdf"></i> PDF</button>
                            <a href="user.php?reports" class="btn btn-danger"><i class="fas fa-times"></i> Close</a>
                          </div>
                        <?php
                      }
                    ?>
                </div>
            </div>
            <div class="row" id="printableDivision">
                <div class="col-md-12">
                    <?php
                        if(isset($_POST['btngeneratereport'])){
                            showGeneratedReport($conn,$_POST['bid'],$_POST['fdate'],$_POST['tdate']);
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>