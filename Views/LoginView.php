<link rel="stylesheet" href="<?= $this->app_name ?>/Views/Styles/loginViewStyle.css">
<div class="mainContainer pt-3 m-2 d-flex justify-content-center align-item-cetner">
    <div class="loginContainer">
        <h1 class="text-center pt-3">Login</h1>

        <form class="loginForm p-5" action="<?= ReverseURL("Auth.login") ?>" method="POST" id="loginForm">
            <div style="color: red">
                <?php
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>
            </div>
            
            <input type="email" name="email" id="input_email" class="form-control my-2" placeholder="Enter Email ID">
            <input type="password" name="password" id="input_password" class="form-control my-2" placeholder="Enter Password">
            <input type="hidden" name="nextURL" value="<?= $nextURL ?>">
            <div class="buttonContainer d-flex justify-content-center align-items-center flex-row">
                <button type="submit" name="submit" value="login" class="btn btn-primary m -2">Login</button>
                <a href="<?= ReverseURL("User.new_user_page") ?>" class="m-2">Create New User</a>
            </div>
        </form>
    </div>
</div>
<script>
    $("#loginForm").validate({
        rules: {
            email: "required",
            password: "required"
        },
        messages: {
            email: "Please Enter Valid Email",
            password: "Please Enter Valid Password"
        }
    })
</script>