<?php


require_once "./Utilities/Helper.php";
// var_dump($_SERVER['PATH_INFO']);


$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : '/';

// if ($url == '/'){
//     $controller = "HomeController";
//     $method = "home";
// } else if (isset($url[0]) && isset($url[1])){
//         $controller = $url[0]."Controller";
//         $method = $url[1];
// } else {
//     http_response_code(404);
//     die();
// }
    

// try {
//     $c_obj = new $controller();
//     $c_obj -> $method();
// } catch (\Throwable $th) {
//     http_response_code(404);
//     die();
// }

Route("/","HomeController","home");
Route("/Auth/loginPage","AuthController","loginPage");
Route("/Auth/login","AuthController","loginPage");
Route("/Auth/logout","AuthController","loginPage");
var_dump($route_list);