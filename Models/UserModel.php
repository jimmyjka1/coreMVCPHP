<?php 

    class UserModel {

        // Model Attributes 
        public $id;
        public $first_name;
        public $last_name;
        public $email;
        public $password;
        



        /**
         * Constructor takes in user details
         * PASSWORDS will be HASHED if you assign it using constructor 
         */
        function __construct($first_name, $last_name, $email, $password, $id = NULL) {
            // sanitizing inputs 
            $first_name = htmlspecialchars(strip_tags($first_name));
            $last_name = htmlspecialchars(strip_tags($last_name));
            $email = htmlspecialchars(strip_tags($email));
            


            $this -> first_name = $first_name;
            $this -> last_name = $last_name;
            $this -> email = $email;
            $this -> password = self::hashPassword($password);
            $this -> id = $id;
        }



        /**
         * Save the model to the database. If id is assigned & id is not null & id is present in database, then
         * User will be updated, else new user will be created and id for the same will be stored in id attribute 
         * id attribute is optional as when creating new use, you'll not have an id. 
         */
        function save(){
            $db_conn = self::conn();

            
            if (isset($this -> id) && $this -> id != NULL && self::isIDPresent($this -> id)){
                $query = "UPDATE `User` SET first_name = :fn, last_name = :ln, email = :em, password = :pass WHERE id = :id";
                $params = [
                    ':fn' => $this -> first_name,
                    ':ln' => $this -> last_name,
                    ':em' => $this -> email,
                    ':pass' => $this -> password,
                    ':id' => $this -> id
                ];
                
                return executeQuery($db_conn, $query, $params);
            
            } else {
                
                $query = "INSERT INTO `User` (first_name, last_name, email, password) VALUES (:fn, :ln, :em, :pass)";
                $params = [
                    ':ln' => $this -> last_name,
                    ':fn' => $this -> first_name,
                    ':em' => $this -> email,
                    'pass' => $this -> password,
                ];

                $res = executeQuery($db_conn, $query, $params);
                $this -> id = $db_conn -> lastInsertId();

            }
        }

        


        /**
         * Function to check if email and password match.
         * 
         * return: UserModel object for the user if email and password is correct
         *         else return false
         */
        public static function isEmailPassValid($email, $password){
            $user = self::getUserByEmail($email);
            if (!$user){
                return false;
            } else {
                if ($user -> password === self::hashPassword($password)){
                    return $user;
                } else {
                    return false;
                }
            }
            

        }

        /**
         * Static method to get user by id 
         * 
         * return: UserModel object
         */
        public static function getUserById($id){
            $query = "SELECT * FROM `User` WHERE id = :id";
            $params = [
                ":id" => $id
            ];

            $result = executeQueryResult(self::conn(), $query, $params);
            if ($result){

                $result = $result[0];
                $id = $result['id'];
                $first_name = $result['first_name'];
                $last_name = $result['last_name'];
                $email = $result['email'];
                $password = $result['password'];


                /**
                 * Here we passed blank string as password because 
                 * constructor hashes the password, which we already have
                 * so we'll assign password directly to password attrbute 
                 */
                $userObj = new self($first_name, $last_name, $email, "", $id);
                $userObj -> password = $password;
                return $userObj;
            } else {
                return false;
            }
        }

        /**
         * Static method to get User by email
         * 
         * return: UserModel Object  
         */
        public static function getUserByEmail($email){
            $query = "SELECT * FROM `User` WHERE email = :eml";
            $params = [
                ":eml" => $email
            ];

            $result = executeQueryResult(self::conn(), $query, $params);
            if ($result){

                $result = $result[0];
                $id = $result['id'];
                $first_name = $result['first_name'];
                $last_name = $result['last_name'];
                $email = $result['email'];
                $password = $result['password'];

                /**
                 * Here we passed blank string as password because 
                 * constructor hashes the password, which we already have
                 * so we'll assign password directly to password attrbute 
                 */
                $userObj = new self($first_name, $last_name, $email, "", $id);
                $userObj -> password = $password;
                return $userObj;
            } else {
                return false;
            }
        }


        /**
         * Function to test if ID is present or not 
         * 
         * return: boolean 
         */
        public static function isIDPresent($id){
            $query = "SELECT id FROM User WHERE id=:id";
            $params = [
                ':id' => $id
            ];
            if (executeQueryResult(self::conn(), $query, $params)){
                return true;
            } else {
                return false;
            }
        }


        /**
         * take and return global $pdo object, so dont need global statement in every function 
         * 
         * return: pdo object
         */
        public static function conn(){
            global $pdo;
            return $pdo;
        }

        /**
         * Hash user password, uses sha256 algo, and uses $useHashedPassword to determine if password should be hashed or not. $salt variable is defined in db_config/config.php file 
         * 
         * 
         * return: string (hashed password)
         */
        public static function hashPassword($password){
            global $salt, $useHashedPassword;
            if ($useHashedPassword){
                return hash('sha256', $salt.$password);
            } else {
                return $password;
            }
        }

    }

