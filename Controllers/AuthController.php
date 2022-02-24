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
            unset($_SESSION['user_id']);
            require_once $this -> header;
            require_once $this -> login_page;
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
                header("Location: ".$this -> app_name."/Auth/loginPage");
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

        





    }