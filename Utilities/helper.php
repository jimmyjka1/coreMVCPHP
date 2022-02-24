<?php 
    /**
     * Helper file contains function to import all modals, and contains some micellaneous function which reduces code size 
     */
    require_once './db_config/config.php';

    $base_path = $_SERVER['DOCUMENT_ROOT']. "/coreMVC";
    $app_name = "/coreMVC";

    session_start();


    // import all Models 
    require_once $base_path . "/Models/UserModel.php";


    // importing all Controllers 
    require_once $base_path . "/Controllers/HomeController.php";
    require_once $base_path . "/Controllers/AuthController.php";
    require_once $base_path . "/Controllers/UserController.php";

    // flag to set if passwords needs to be hashed or not 
    $useHashedPassword = false;
    

    



    
    /**
     * Function to just execute the query. Item returned can be checked to see if the query was successful of not 
     */
    function executeQuery($pdo, $query, $params){

        $stmt = $pdo -> prepare($query);
        $rs = $stmt -> execute($params);
        return $rs;

    }

    /**
     * Function to execute the query and return the result. if query was unsuccessful then return false.
     */
    function executeQueryResult($pdo, $query, $params){

        $stmt = $pdo -> prepare($query);
        $rs = $stmt -> execute($params);
        if ($rs){
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }

    }

    function includeCSS(){
        ?>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php 
    }



    


    /**
     * function to get user_id of the current loggged in user 
     * if the use is not logged in , then it returns false 
     * 
     * returns: int / bool
     */
    function getLoggedInUserId(){
        if (isset($_SESSION['user_id']) && $_SESSION['user_id']){
            return $_SESSION['user_id'];
        } else {
            return false;
        }
    }


    



?>