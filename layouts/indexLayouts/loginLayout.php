<?php

    if(isset($_POST['loginBtn'])){
        login($conn,$_POST['username'],$_POST['password']);
    }

?>
<div id="loginform">
    <div class="text-center pt-3 pb-3">
        <h1 style="color: white;">TTRS (Technical Officer Tracking & Responding System)</h1>
        <p></p>
        <p></p>
        <p></p>
        <p></p>
    </div>
    <!-- Form -->
    <form class="form-horizontal mt-3" id="loginform" action="index.php" method="POST">
        <div class="row pb-4">
            <div class="col-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-success text-white h-100" id="basic-addon1"><i class="ti-user"></i></span>
                    </div>
                    <input type="text" class="form-control form-control-lg" placeholder="Username" aria-label="Username" name="username" id="username" aria-describedby="basic-addon1" required="">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-warning text-white h-100" id="basic-addon2"><i class="ti-pencil"></i></span>
                    </div>
                    <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" name="password" id="password" aria-describedby="basic-addon1" required="">
                </div>
            </div>
        </div>
        <div class="row border-top border-secondary">
            <div class="col-12">
                <div class="form-group">
                    <div class="pt-3">
                        <a class="btn btn-info" href="index.php?recover" ><i class="fa fa-lock me-1"></i> Lost password?</a>
                        <button class="btn btn-success float-end text-white" name="loginBtn" type="submit">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>