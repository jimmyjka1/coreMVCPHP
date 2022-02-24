<?php 

    $route_list = [];

    function Route(...$data){
        global $route_list;
        if (!isset($data[0]) || !isset($data[1]) || !isset($data[2])){
            throw new Exception("Please provide all three - url pattern, Controller name, and method name", 1);
        }
        array_push($route_list, [
            'pattern' => $data[0],
            'controller' => $data[1],
            'method' => $data[2]
        ]);
    }