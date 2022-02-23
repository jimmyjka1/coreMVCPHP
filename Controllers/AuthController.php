<?php 


    class AuthController {
        /**
        * constructor stores some global constants , and also checks if use is logged in or not.
        */
        function __construct() {
            global $base_path, $app_name;
            $this -> app_name = $app_name;
            $this -> base_path = $base_path;
            $this -> header = $base_path . "/Views/Layouts/header.php";
            $this -> footer = $base_path . "/Views/Layouts/footer.php";
            $this -> login_page = $base_path . "/Views/LoginView.php";
            $this -> new_user_page = $base_path . "/Views/CreateUserView.php";


            // check if user is logged in, if yes, then store its user model object in this -> user 
            $this -> isLoggedIn = false;
            $id = getLoggedInUserId();
            if ($id){
                $this -> user = UserModel::getUserById($id);
                $this -> isLoggedIn = true;
            }
        }

        // renders login page on the screen
        function loginPage(){
            require_once $this -> header;
            require_once $this -> login_page;
            require_once $this -> footer;
        }

        // renders newUserPage on the screen 
        function newUserPage(){
            require_once $this -> header;
            require_once $this -> new_user_page;
            require_once $this -> footer;
        }

        /**
         * login checks email and password parameter from post.
         * if user successfully logs in, their user_id is sotred in session then they are redirected to home page 
         * else error message is shown. 
         */
        function login(){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = UserModel::isEmailPassValid($email, $password);
            if ($user){
                $_SESSION['user_id'] = $user -> id;
                header("Location: ". $this -> app_name);
                die();
            } else {
                $_SESSION['error'] = "Incorrect Email or Password";
                header("Location: ".$this -> app_name."?view=login");
                die();
            }
        }

        // login method destorys the session, and redirects user to home page 
        function logout(){
            session_destroy();
            session_start();
            header("Location: ".$this -> app_name);
            die();
        }

        /**
         * createNewUser method takes all user details from post, and stores it in user model.
         * 
         * if some error occures, then user gets redirectd to newuser page
         * 
         */
        function createNewUser(){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $password = $_POST['password'];
            $email = $_POST['email'];


            if (strlen($first_name) > 0 && strlen($last_name) > 0 && strlen($password) > 0 && strlen($email) > 0 ){
                $user = new UserModel($first_name, $last_name, $email, $password);
                try{
                    $user -> save();
                } catch(Exception $e){
                    $_SESSION['error'] = "Unable to create User. Try again with different email id";
                    header("Location: ".$this -> app_name . "?view=newuser");
                    die();
                }
                header("Location: " . $this -> app_name);
                die();

            } else {
                $_SESSION['error'] = "All Fields are required";
                header("Location: " . $this -> app_name . "?view=newuser");
                die();
            }


        }






    }