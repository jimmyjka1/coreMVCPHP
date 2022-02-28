<?php


require_once "./Utilities/Helper.php";
$url = $_SERVER['PATH_INFO'] ?? '/';

// Route(pattern, controller, method, [name])
Route(["/", "HomeController", "home", "home"]);
Route(["/Auth/loginPagePratyush", "AuthController", "loginPage", "Auth.login_page"]);
Route(["/Auth/login", "AuthController", "login", "Auth.login"]);
Route(["/Auth/logout", "AuthController", "logout", "Auth.logout"]);
Route(["/User/newUserPage", "UserController", "newUserPage", "User.new_user_page", "requirements" => ["login_required"]]);
Route(["/User/createNewUser", "UserController", "createNewUser", "User.create_new_user", "requirements" => ["login_required"]]);
Route(["/User/allUsersPage", "UserController", "allUsersPage", "User.all_users"]);



ParseURL($url);
// var_dump(ReverseURL('home'));
// var_dump(ReverseURL('Auth.login_page'));