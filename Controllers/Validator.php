<?php 

    /**
     * Validate class's validate method is executed is you have params_validator in 
     * requirements array. 
     * Value of params shoulbe of the form 
     * 
     * params_validator = [
     *     "GET" => [
     *         "param1" => [],
     *         "param2" => [
     *              "max_length" => 123,
     *              "min_length" => 5
     *          ],
     *          
     *      ],
     *     "POST" => [
     *          "param1" => [],
     *         "param2" => [
     *              "max_length" => 123,
     *              "min_length" => 5
     *          ],
     *      ]
     * 
     * ] 
     */
    class Validator{


        /**
         * 
         * 
         * 
         * 
         * COnstructore initializes two lists 
         * 
         * validate_method_list - maps REQUEST method types to methods to be executed 
         * for that method 
         * 
         * 
         * validate_condition_list - maps conditions to methods which is to be executed when the condition 
         * is present. 
         */
        function __construct() {
            $this -> validate_condition_list = [
                "max_length" => 'validate_max_length',
                "min_length" => 'validate_min_length',
                "int" => 'validate_int'
                
            ];
        }

        public function validate($data){
            foreach ($data as $request_method => $value) {

                $parameters = [];

                switch ($request_method) {
                    case 'GET':
                        $parameters = $_GET;
                        break;
                    case 'POST':
                        $parameters = $_POST;
                        break;
                    
                    default:
                        throw new Exception("Unknown Keyword : " . $request_method, 1);
                        break;
                }



                
                $this -> validate_param($value, $parameters);
            }
        }




        // validate request functions 

        public function validate_param($data, $parameters){
            foreach ($data as $param => $conditions) {
                if (!isset($parameters[$param])){
                    http_response_code(404);
                    die();
                }

                foreach ($conditions as $condition => $attribute) {
                    $condition_validate_function = $this -> validate_condition_list[$condition];
                    if (!$this -> $condition_validate_function($parameters[$param], $attribute)){
                        echo "Condition Failed: " . $condition . " For Param: " . $param;
                        die();
                    }
                }
            }
        }

        // validate conditions functions 

        public function validate_max_length($param, $value){
            // var_dump($param, $value);
            return strlen($param) <= $value;
        }

        public function validate_min_length($param, $value){
            return strlen($param) >= $value;
        }

        public function validate_int($param, $value){
            return is_numeric($param);
        }



    }