<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title> TTRS - Technical Officer Tracking & Responding System </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <!-- Custom CSS -->
    <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="assets/libs/select2/dist/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/libs/jquery-minicolors/jquery.minicolors.css">
    <link rel="stylesheet" type="text/css" href="assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/libs/quill/dist/quill.snow.css">

    <link href="assets/libs/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
    <link href="assets/extra-libs/calendar/calendar.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="assets/extra-libs/multicheck/multicheck.css">
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        /* Firefox */
        input[type=number] {
        -moz-appearance: textfield;
        }

        .timeclock {
            text-align: center;
            color: blue;
            background: linear-gradient(90deg, rgba(0,140,23,1) 0%, rgba(155,255,0,1) 100%);
            font-size: 75px;
        }

        #profilecard{
            background-color: #85FFBD;
            background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);
            border-radius: 25px;
        }

        #bankseperatedetails{
            background-color: #8BC6EC;
            background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);
            border-radius: 25px;
        }
    </style>
</head>
<?php
    session_start();
    
    if(!$_SESSION['un'] && $_SESSION['ut'] != "User"){
		header('Location: index.php');
	}

    date_default_timezone_set("Asia/Colombo");
    include_once 'config/config.php';
    include_once 'function/function.php';

    $userData = fetchUsersLoginDetailsForAllDetails($conn,$_SESSION['un']);
?>
<body onload="startTime()">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php
          include_once 'layouts/viewerLayouts/headerLayout.php';
        ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php
            include_once 'layouts/viewerLayouts/sidebarLayout.php';
        ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <?php
                if(isset($_GET['users'])){
                    include_once 'layouts/viewerLayouts/usersLayout.php';
                }
                elseif(isset($_GET['bankaccounts'])){
                    include_once 'layouts/viewerLayouts/bankaccountLayout.php';
                }
                elseif(isset($_GET['maintenance'])){
                    include_once 'layouts/viewerLayouts/maintenanceLayout.php';
                }
                elseif(isset($_GET['reports'])){
                    include_once 'layouts/viewerLayouts/reportLayout.php';
                }
                elseif(isset($_GET['profile'])){
                    include_once 'layouts/viewerLayouts/profileLayout.php';
                }
                else{
                    include_once 'layouts/viewerLayouts/dashboardLayout.php';
                }
            ?>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php
                include_once 'layouts/viewerLayouts/footerLayout.php';
            ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="assets/libs/flot/excanvas.js"></script>
    <script src="assets/libs/flot/jquery.flot.js"></script>
    <script src="assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="assets/libs/flot/jquery.flot.time.js"></script>
    <script src="assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="dist/js/pages/chart/chart-page-init.js"></script>

    <script src="assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="dist/js/pages/mask/mask.init.js"></script>
    <script src="assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
    <script src="assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
    <script src="assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/libs/quill/dist/quill.min.js"></script>

    <script src="assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="assets/extra-libs/DataTables/datatables.min.js"></script>

    <script src="assets/libs/moment/min/moment.min.js"></script>
    <script src="assets/libs/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="dist/js/pages/calendar/cal-init.js"></script>

    

    <script>
        $('#userdetailtable').DataTable();
        $('#backaccountdetailtable').DataTable();
        $('#transactiondetailtable').DataTable();
    </script>

    <script>
        function validateForm7(){
            event.preventDefault(); // prevent form submit
            var form = event.target.form; // storing the form
            swal({
                title: 'Are you sure?',
                text: 'You want to Remove this Details!',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                } else {
                    swal('Process was Cancelled Successfully!', {
                        icon: 'info',
                    });
                }
            });
        };
    </script>

<script>
        $(document).ready(function(){
            $('#chkinput').hide();
            $('#chequeno').prop('required',false);
            $('#company').prop('required',false);

            $('#transactiontype').change(function(){  
                var query4 = $(this).val();  
                if(query4 == 'Withdraw')  
                {  
                    $('#chkinput').show();
                    $('#chequeno').prop('required',true);
                    $('#company').prop('required',true);
                }
                else
                {
                    $('#chkinput').hide();
                    $('#chequeno').prop('required',false);
                    $('#company').prop('required',false);
                }
            });
        });

        $(document).ready(function(){
            $('#lasttransactionamount').html("-----");
            $('#totalamountinaccount').html("-----");
            $('#lrd').html("-----");
            $('#lrt').html("-----");
            $('#modalcontainer').html("");

            if($('#bid').find(":selected").val() != "NULL"){
                var query0 = $(this).find(":selected").val();
                if(query0 != '')  
                {  
                    $.ajax({  
                        url:"ajax/data2.php",  
                        method:"POST",  
                        data:{query:query0},  
                        success:function(data)  
                        {  
                            var id_numbers0 = {};
                            id_numbers0 = data;
                            $('#lasttransactionamount').html(id_numbers0["lasttransactionamount"] + " Rs");
                            $('#totalamountinaccount').html(id_numbers0["totalamount"] + " Rs");
                            $('#lrd').html(id_numbers0["lasttransactiondate"]);
                            $('#lrt').html(id_numbers0["lasttransactiontype"]);
                            $('#tbodytd').html(id_numbers0["outputtbl"]);
                        },
                        dataType:"json"
                    });  
                }  
            }

            $('#bid').change(function(){  
                var query = $(this).val();
                if(query != '')  
                {  
                    $.ajax({  
                        url:"ajax/data2.php",  
                        method:"POST",  
                        data:{query:query},  
                        success:function(data)  
                        {  
                            var id_numbers = {};
                            id_numbers = data;
                            $('#lasttransactionamount').html(id_numbers["lasttransactionamount"] + " Rs");
                            $('#totalamountinaccount').html(id_numbers["totalamount"] + " Rs");
                            $('#lrd').html(id_numbers["lasttransactiondate"]);
                            $('#lrt').html(id_numbers["lasttransactiontype"]);
                            $('#tbodytd').html(id_numbers["outputtbl"]);
                        },
                        dataType:"json"
                    });  
                }  
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <script>
        function printTPR(){
            const invoice = document.getElementById("printableDivision");
            var opt = {
                margin: [0.5, 0.05, 0.5, 0.05],
                filename: 'Transaction_Report_<?=date("d-m-Y H:m:s");?>.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'a4', orientation: 'landscape' }
            };
            //html2pdf().from(invoice).set(opt).save();
            html2pdf().from(invoice).set(opt).toPdf().get('pdf').then(function (pdf) {
                var totalPages = pdf.internal.getNumberOfPages(); 
                for (var i = 1; i <= totalPages; i++) {
                    pdf.setPage(i);
                    pdf.setFontSize(10);
                    pdf.setTextColor(150);
                    //divided by 2 to go center
                    pdf.text('Page ' + i + ' of ' + totalPages, pdf.internal.pageSize.getWidth()/2, 
                    (pdf.internal.pageSize.getHeight()/ 100)*97.5);
                    pdf.text('BADMS - Transaction Reports Printed at <?=date("h:m:s a d-m-Y");?>', (pdf.internal.pageSize.getWidth()/100)*1, 
                    (pdf.internal.pageSize.getHeight()/ 100)*2.5);
                }
                pdf.autoPrint();
                window.open(pdf.output('bloburl'), '_blank');
            });
        }
    </script>

    <script>
        <?php
            if(isset($_GET['maintenance'])){
                ?>
                    document.getElementById('chqordeptdate').valueAsDate = new Date();
                <?php
            }
        ?>
    </script>

    <script>
        function startTime() {
            const today = new Date();
            let h = today.getHours();
            let m = today.getMinutes();
            let s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('time').innerHTML =  h + ":" + m + ":" + s;
                setTimeout(startTime, 1000);
            }

            function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }
    </script>

</body>

</html>