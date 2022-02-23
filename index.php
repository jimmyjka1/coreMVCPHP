<?php 
    require_once "./Utilities/helper.php";
    $auth_controller = new AuthController();
    $home_controller = new HomeController();


    // view attribute is checked if request method is get 
    // submit attribute is checked if request method is post
    if ($_SERVER['REQUEST_METHOD'] === 'GET'){
        if (isset($_GET['view'])){
            if ($_GET['view'] == 'login'){
                // get login page 
                $auth_controller -> loginPage();
            } else if ($_GET['view'] == 'logout'){
                // logout 
                $auth_controller -> logout();
            } else if ($_GET['view'] == 'newuser'){
                // get new user page
                $auth_controller -> newUserPage();
            } else {

                // page not found if view attribute does not match any value 
                http_response_code(404);
                die();
            }

        } else {
            
            $home_controller -> showHomePage();
        }
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['submit'])){

            if ($_POST['submit'] == 'login'){

                // post request from login page goes here 
                $auth_controller -> login();
            } else if ($_POST['submit'] == 'newuser'){

                // post request from create new user goes here
                $auth_controller -> createNewUser();
            }

        }
    } else {

        // if nothing matches 
        http_response_code(404);
        die();
    }