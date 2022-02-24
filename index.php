<?php


require_once "./Utilities/Helper.php";
$auth_controller = new AuthController();
$home_controller = new HomeController();
$user_controller = new UserController();

$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : '/';

if ($url === '/') {
    $home_controller->showHomePage();
    die();
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    switch ($url[0]) {
        case 'login':
            $auth_controller->loginPage();
            break;
        case 'logout':
            $auth_controller->logout();
            break;
        case 'newuser':
            $user_controller->newUserPage();
            break;
        case 'users':
            if (!isset($url[1])){
                $user_controller -> allUsersPage();
            } else {
                http_response_code(404);
                die();
            }
        default:
            http_response_code(404);
            die();
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($_POST['submit']) {
        case 'login':
            $auth_controller->login();
            break;
        case 'newuser':
            $auth_controller->createNewUser();
            break;
        default:
            http_response_code(404);
            die();
    }
} else {
    http_response_code(404);
    die();
}





// // view attribute is checked if request method is get 
// // submit attribute is checked if request method is post
// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     if (isset($_GET['view'])) {
//         if ($_GET['view'] == 'login') {
//             // get login page 
//             $auth_controller->loginPage();
//         } else if ($_GET['view'] == 'logout') {
//             // logout 
//             $auth_controller->logout();
//         } else if ($_GET['view'] == 'newuser') {
//             // get new user page
//             $auth_controller->newUserPage();
//         } else {

//             // page not found if view attribute does not match any value 
//             http_response_code(404);
//             die();
//         }
//     } else {

//         $home_controller->showHomePage();
//     }
// } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     if (isset($_POST['submit'])) {

//         if ($_POST['submit'] == 'login') {

//             // post request from login page goes here 
//             $auth_controller->login();
//         } else if ($_POST['submit'] == 'newuser') {

//             // post request from create new user goes here
//             $auth_controller->createNewUser();
//         }
//     }
// } else {

//     // if nothing matches 
//     http_response_code(404);
//     die();
// }
