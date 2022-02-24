<?php 


    class UserController {
        /**
        * constructor stores some global constants , and also checks if use is logged in or not.
        */
        function __construct() {
            global $base_path, $app_name;
            $this -> app_name = $app_name;
            $this -> base_path = $base_path;
            $this -> header = $base_path . "/Views/Layouts/header.php";
            $this -> footer = $base_path . "/Views/Layouts/footer.php";
            $this -> create_user_view = $base_path . '/Views/CreateUserView.php';
            $this -> all_users_view = $base_path . "/Views/AllUsersView.php";
            


            // check if user is logged in, if yes, then store its user model object in this -> user 
            $this -> isLoggedIn = false;
            $id = getLoggedInUserId();
            if ($id){
                $this -> user = UserModel::getUserById($id);
                $this -> isLoggedIn = true;
            }
        }

        
        // renders newUserPage on the screen 
        function newUserPage(){
            require_once $this -> header;
            require_once $this -> create_user_view;
            require_once $this -> footer;
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
                    header("Location: ".$this -> app_name . "/newuser");
                    die();
                }
                header("Location: " . $this -> app_name);
                die();

            } else {
                $_SESSION['error'] = "All Fields are required";
                header("Location: " . $this -> app_name . "/newuser");
                die();
            }


        }


        /**
         * This function renders user list on the screen. it reads num_rows, 
         * search, and num_location parameter from get request. if any parameter 
         * is not set, then defualt value is taken. 
         */
        function allUsersPage(){


            $num_rows = (isset($_GET['num_rows'])) ? $_GET['num_rows'] : '10';
            $search = (isset($_GET['search'])) ? $_GET['search'] : '';
            $num_location = (isset($_GET['num_location'])) ? $_GET['num_location'] : '1';
            
            // by default, first name is sorted in ascending order
            $sort_column = (isset($_GET['sort_column'])) ? $_GET['sort_column'] : 'first_name';
            $sort_direction = (isset($_GET['sort_direction'])) ? $_GET['sort_direction'] : "ASC";
 
            $user_count = UserModel::getUserCount($search);

            
            $num_tabs = ($num_rows > 0) ? ceil($user_count / $num_rows): http_response_code(404) && die();
            
            $num_tabs = ($num_tabs) ? $num_tabs : 1;

            if ($num_location > $num_tabs || $num_location <= 0){
                http_response_code(404);
                die();
            }

            $offset = ($num_location - 1) * $num_rows;
            $limit = $num_rows;

            $users = UserModel::getAllUsers($offset, $limit, $search, $sort_column, $sort_direction);
            



            require_once $this -> header;
            require_once $this -> all_users_view;
            require_once $this -> footer;
        }






    }