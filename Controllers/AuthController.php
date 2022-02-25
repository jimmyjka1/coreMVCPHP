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

        /** 
         *  renders login page on the screen.
         *  
         * this method also takes nextURL parameter, which will stored in login form as hidden input field.
         * 
         */
        function loginPage($nextURL = ""){
            $nextURL = ($nextURL != "") ? $nextURL : $this -> app_name;
            unset($_SESSION['user_id']);
            require_once $this -> header;
            require_once $this -> login_page;
            require_once $this -> footer;
        }


        /**
         * login checks email and password parameter from post.
         * if user successfully logs in, their user_id is sotred in session then they are redirected 
         * else error message is shown. 
         * 
         * 
         * If user has successfully logged in , then they are redirected to the url stored in nextURL hidden
         * input field, else to the homepage.
         */
        function login(){
            
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = UserModel::isEmailPassValid($email, $password);
            if ($user){
                $_SESSION['user_id'] = $user -> id;

                if (isset($_POST['nextURL'])){
                    header("Location: ". $_POST['nextURL']);
                } else {
                    header("Location: ". ReverseURL("home"));
                }

                die();
            } else {
                $_SESSION['error'] = "Incorrect Email or Password";
                header("Location: ".ReverseURL('Auth.login_page'));
                die();
            }
        }

        // login method destorys the session, and redirects user to home page 
        function logout(){
            session_destroy();
            session_start();
            header("Location: ".ReverseURL("home"));
            die();
        }

        





    }