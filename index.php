<?php


require_once "./Utilities/Helper.php";
$url = $_SERVER['PATH_INFO'] ?? '/';

// Route(pattern, controller, method, [name])
Route(['pattern' => "/", "controller" => "HomeController", "method" => "home", "name" => "home"]);
Route(['pattern' => "/Auth/loginPage","controller" => "AuthController", "method" => "loginPage", "name" => "Auth.login_page"]);
Route(['pattern' => "/Auth/login","controller" => "AuthController", "method" => "login", "name" => "Auth.login"]);
Route(['pattern' => "/Auth/logout","controller" => "AuthController", "method" => "logout", "name" => "Auth.logout"]);
Route(['pattern' => "/User/newUserPage", "controller" => "UserController",  "method" => "newUserPage", "name" => "User.new_user_page"]);
Route(['pattern' => "/User/createNewUser", "controller" => "UserController",  "method" => "createNewUser", "name" => "User.create_new_user"]);
Route(['pattern' => "/User/allUsersPage", "controller" => "UserController",  "method" => "allUsersPage", "name" => "User.all_users"]);



ParseURL($url);
// var_dump(ReverseURL('home'));
// var_dump(ReverseURL('Auth.login_page'));