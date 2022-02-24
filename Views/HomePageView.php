<div class="m-2 d-flex justify-content-center align-items-cetner flex-row flex-wrap">
    <?php

    // if user is logged in, then use details will be shown, else 
    // a button to login page will be shown
    if ($this->isLoggedIn) {
    ?>
        <div class="userDetailContainer">
            <p>Name: <?= $this->user->first_name . " " . $this->user->last_name ?></p>
            <p>Email: <?= $this->user->email ?></p>
        </div>

    <?php
    } else {
    ?>
        <a class="btn btn-primary" href="<?= $this->app_name ?>/Auth/loginPage">Login</a>
    <?php
    }

    ?>
</div>