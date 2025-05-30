<?php
    if(isset($_POST['acceptTerms'])){
        addAdminDetails($conn,$_POST['name'],$_POST['email'],$_POST['pno'],$_POST['nicno'],$_POST['userName'],$_POST['password'],$_POST['sq1'],$_POST['ans1'],$_POST['sq2'],$_POST['ans2']);
    }
?>
<div class="card bg-dark">
    <div class="card-body wizard-content">
        <h4 class="card-title" style="color: white; text-align: center;">Welcome To BADMS (Bank Accounts Details Management System)</h4>
        <h6 class="card-subtitle"></h6>
        <form id="example-form" action="index.php" name="firstForm" class="mt-5" method="POST">
            <div>
                <h3>Profile</h3>
                <section>
                    <label for="name">Name *</label>
                    <input id="name" name="name" type="text" class="required form-control">
                    <label for="email">Email *</label>
                    <input id="email" name="email" type="text" class="required email form-control">
                    <label for="pno">Phone No *</label>
                    <input id="pno" name="pno" type="number" class="required phone form-control">
                    <label for="nicno">NIC No *</label>
                    <input id="nicno" name="nicno" type="text" class="required nic form-control">
                    <p>(*) Mandatory</p>
                </section>
                <h3>Account</h3>
                <section>
                    <label for="userName">User name *</label>
                    <input id="userName" name="userName" type="text" class="required form-control">
                    <label for="password">Password *</label>
                    <input id="password" name="password" id="password" type="password" class="required form-control">
                    <label for="confirm">Confirm Password *</label>
                    <input id="confirm" name="confirm" id="confirm" type="password" class="required form-control">
                    <p>(*) Mandatory</p>
                </section>
                <h3>Security</h3>
                <section>
                    <label for="sq1">Security Question 1 *</label>
                    <select id="sq1" name="sq1" required="required" class="required form-control">
                        <option value="In what city were you born?">In what city were you born?</option>
                        <option value="What is the name of your favorite pet?">What is the name of your favorite pet?</option>
                        <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                        <option value="What high school did you attend?">What high school did you attend?</option>
                    </select>
                    <label for="ans1">Answer 1 *</label>
                    <input id="ans1" name="ans1" type="text" class="required form-control">
                    <label for="sq2">Security Question 2 *</label>
                    <select id="sq2" name="sq2" required="required" class="required form-control">
                        <option value="What is the name of your first school?">What is the name of your first school?</option>
                        <option value="What was the make of your first car?">What was the make of your first car?</option>
                        <option value="What was your favorite food as a child?">What was your favorite food as a child?</option>
                    </select>
                    <label for="ans2">Answer 2 *</label>
                    <input id="ans2" name="ans2" type="text" class="required form-control">
                </section>
                <h3>Terms & Conditions</h3>
                <section>
                    <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required">
                    <label for="acceptTerms">I agree with the Terms and Conditions.</label>
                </section>
            </div>
        </form>
    </div>
</div>