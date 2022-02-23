<link rel="stylesheet" href="<?= $this->app_name ?>/Views/Styles/loginViewStyle.css">
<div class="mainContainer pt-3 m-2 d-flex justify-content-center align-item-cetner">
    <div class="loginContainer">
        <h1 class="text-center pt-3">Create New User</h1>

        <form class="loginForm p-5" action="" method="POST" id="createUserForm">
            <div style="color: red">
                <?php
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>
            </div>
            <input type="text" name="first_name" id="input_first_name" class="form-control my-2" placeholder="First Name">
            <input type="text" name="last_name" id="input_last_name" class="form-control my-2" placeholder="Last Name">
            <input type="email" name="email" id="input_email" class="form-control my-2" placeholder="Enter Email ID">
            <input type="password" name="password" id="input_password" class="form-control my-2" placeholder="Enter Password">
            <div class="buttonContainer d-flex justify-content-center align-items-center flex-row">
                <button type="submit" name="submit" value="newuser" class="btn btn-primary m -2">Create New User</button>
                <a href="<?= $this -> app_name ?>?view=login" class="m-2">Already have account? Login</a>
            </div>
        </form>
    </div>
</div>
<script>
    $("#createUserForm").validate({
        rules: {
            first_name : "required",
            last_name: "required",
            email: "required",
            password: "required"
        }
    })
</script>