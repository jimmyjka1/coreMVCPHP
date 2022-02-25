<?php 


    /**
     * This list will store routes in form ['url' => $data] - where data is the array passed in Route method.
     * It'll be used by ParseURL method
     */
    $route_list = [];
    /**
     * If name is passed in Route method, then that route will be added to this list. 
     * This list will look like 
     * ['name' => $data]
     * 
     * It'll be used by ReverseURL method
     */
    $reverse_routing_list = [];

    
    
    /**
     * Route(['pattern' => $url, 'controller' => $controller, 'method' => $controller_method, 'name' => $name_for_reverse_routing])
     * 
     * This method take in data array, and stores it in $route_list, with key as url pattern
     * If you have specified name attribute, then this function also adds $data to $reverse_routing_list with key as name 
     * 
     * 
     * Name is optional.
     */
    function Route($data){
        global $route_list, $reverse_routing_list;

        if (!isset($data["pattern"]) || !isset($data["controller"]) || !isset($data["method"])){
            throw new Exception("Please provide all three - url pattern, Controller name, and method name required", 1);
        }

        $route_list[$data["pattern"]] = $data;

        if (isset($data["name"])){
            $reverse_routing_list[$data["name"]] = $data;
        }

    }


    /**
     * This methods takes in $url pattern, and if that url is present in $routing_list, then it 
     * calls the specified method of the specified controller
     * 
     * IF that pattern is not present in rout_list, then response codd 404 is returned. 
     */
    function ParseURL($url){
        global $route_list;
        if (isset($route_list[$url])){

            $controller = $route_list[$url]["controller"];
            $method = $route_list[$url]["method"];


            $cnt_object = new $controller();
            $cnt_object -> $method();

        } else {
            http_response_code(404);
            die();
        }
    }

    /**
     * Get URL from their names, only works if you pass name parameter in Route method. 
     */
    function ReverseURL($name){
        global $app_name, $reverse_routing_list;
        return $app_name . $reverse_routing_list[$name]["pattern"];
    }