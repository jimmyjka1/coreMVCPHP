<?php 

    /**
     * Controller reders home page 
     */
    class HomeController {

        /**
         * constructor stores some global constants , and also checks if use is logged in or not.
         */
        function __construct() {
            global $base_path, $app_name;
            $this -> app_name = $app_name;
            $this -> base_path = $base_path;
            $this -> header = $base_path . "/Views/Layouts/header.php";
            $this -> footer = $base_path . "/Views/Layouts/footer.php";
            $this -> home_page = $base_path . "/Views/HomePageView.php";
            $this -> isLoggedIn = false;


            // check if user is logged in, if yes, then store its user model object in this -> user 
            $id = getLoggedInUserId();
            if ($id){
                $this -> user = UserModel::getUserById($id);
                $this -> isLoggedIn = true;
            }

        }

        // renders home page on the screen
        function showHomePage(){
            require_once $this -> header;
            require_once $this -> home_page;
            require_once $this -> footer;
        }




    }