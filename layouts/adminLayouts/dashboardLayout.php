<?php
    $showDashboardDetails = showDashboardDetails($conn,$userData['userid']);
?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Dashboard</h4>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
    <!-- ============================================================== -->
    <!-- Sales Cards  -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-cyan text-center">
                    <h1 class="font-light text-white"><i class="fa fa-user mb-1 font-16"></i></h1>
                    <h5 class="mb-0 mt-1 text-white"><?=$showDashboardDetails['noOfUsers'];?></h5>
                    <small class="font-light text-white">Total Users</small>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white"><i class="fa fa-piggy-bank mb-1 font-16"></i></h1>
                    <h5 class="mb-0 mt-1 text-white"><?=$showDashboardDetails['noOfBank'];?></h5>
                    <small class="font-light text-white">Total Contracts</small>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-success text-center">
                    <h1 class="font-light text-white"><i class="fa fa-database mb-1 font-16"></i></h1>
                    <h5 class="mb-0 mt-1 text-white"><?=$showDashboardDetails['noOfRecord'];?></h5>
                    <small class="font-light text-white">No of Feedbacks</small>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-warning text-center">
                    <h1 class="font-light text-white"><i class="fa fa-id-badge mb-1 font-16"></i></h1>
                    <h5 class="mb-0 mt-1 text-white"><?=$showDashboardDetails['profileOutof13persentage'];?>%</h5>
                    <small class="font-light text-white">Total Profile Completion</small>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Sales chart -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Welcome!!</h4>
                            <h5 class="card-subtitle">Overview of System</h5>
                        </div>
                    </div>
                    <div class="row">
                        <!-- column -->
                        <div class="col-lg-7">
                            <div class="card">
                                <div class="row" id="profilecard">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <?php
                                                    if($showDashboardDetails['profileOutof13persentage']==100){
                                                        echo "<p color='#15ff00' align='center' style='font-size: 60px'>".$showDashboardDetails['profileOutof13persentage']."%</p>";
                                                        echo "<p color='#15ff00' align='center' style='font-size: 24px'>Completed</p>";
                                                    }
                                                    else{
                                                        echo "<p color='#ff545a' align='center' style='font-size: 60px'>".$showDashboardDetails['profileOutof13persentage']."%</p>";
                                                        echo "<p color='#ff545a' align='center' style='font-size: 24px'>Not Completed</p>";
                                                    }
                                                ?>
                                            </div>
                                            <div class="col-lg-7">
                                                <?php
                                                    if(sizeof($showDashboardDetails['profileProp'])>=1){
                                                        echo "<p color='#ff545a' align='left' style='font-size: 24px'>";
                                                            echo "<ul>";
                                                            foreach ($showDashboardDetails['profileProp'] as $value) {
                                                                echo "<li>".$value."</li>";
                                                            }
                                                            echo "</ul>";
                                                        echo "</p>";
                                                    }
                                                    else{
                                                        echo "<p color='#15ff00' align='center' style='font-size: 24px;'>No Action Needed</p>";
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p></p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div id="time" class="timeclock"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="card">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-body b-l calender-sidebar">
                                            <div id="calendar"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div id="time" class="timeclock"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- column -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>