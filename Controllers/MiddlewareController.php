<?php 


    
    class MiddlewareController{

        
        /**
         * Controller initializes a list of controller keyword (keyword which should be passed
         * in requirements array, and method name which should be executed if that keyword is found. 
         */
        public function __construct() {

            $this -> middleware_mapping = [
                "login_required" => "login_required_validator",
            ];

            

        }

        /**
         * Each keyword in requirement array has corresponding value, that value will be passed 
         * in that validator function. For eg, params_validator keywords has corresponding array as value
         * that array will be passed in param_validator 
         */
        public function validate($data, $url = "") {
            foreach ($data as $middleware) {
                $function = $this -> middleware_mapping[$middleware];
                $this -> $function($url);
            }
        }

        /**
         * First example of middleware validator, where we have all the statemtns we require in 
         * single function, so we dont have to make any special class for the same . 
         */
        public function login_required_validator($url){
            // checking if use is logged in or not . 
            if (!isset($_SESSION['user_id'])){

                // if not then create auth_controller object, and render login page. 
                $auth_controller = new AuthController();

                /**
                 * We pass a $url parameter to loginpage method on AuthController, which 
                 * specified where to redirect the user when logged in. 
                 */
                $auth_controller -> loginPage($url);
                die();
            }
        }




    }