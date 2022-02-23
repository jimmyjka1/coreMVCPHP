<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CustomMVC</title>
    <?php includeCSS() ?>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">CustomMVC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= $this -> app_name ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $this -> app_name ?>/newuser">Create User</a>
                    </li>
                    <!-- if use is logged in, than drop down will be shown, else login link will be showned  -->
                    <?php
                    if (isset($this->isLoggedIn) && $this->isLoggedIn) {
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $this -> user -> first_name . " " . $this -> user -> last_name ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="nav-link" href="<?= $this->app_name ?>/logout">Logout</a>
                            </ul>
                        </li>

                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $this->app_name ?>/login">Login</a>
                        </li>

                    <?php
                    }

                    ?>




                </ul>
            </div>
        </div>
    </nav>