<?php


    class DatabaseHelper{

        public function __construct() {
            global $pdo;

            $this -> conn = $pdo;
        }

        
        
        public function joinKeysValues(&$key, $val, $seperator = " "){
            $key = "$val".$seperator."$key";
        }

        public function select($data, $params = []){
            $table = $data['table'] ?? throw new Exception("Please Specify Table Name", 1);
            $columns = $data['columns'] ?? throw new Exception("Please Specify columns list", 1);
            if (count($columns) <= 0){
                throw new Exception("Please Specify atleast One column", 1);
            }

            $where = $data['where'] ?? "";
            $like = $data['like'] ?? "";

            $sort_columns = $data['sort_columns'] ?? [];
            


            $query = "SELECT ". join(", ", $columns) . " FROM " . $table ;

            if (strlen($where) > 0){
                $query = $query . " WHERE " . $where;
            }

            if (strlen($like) > 0){
                $query = $query . " AND " . $like;
            } 

            // $function = $this -> joinKeysValues;
            array_walk($sort_columns, function(&$key, $value){
                $this -> joinKeysValues($key, $value);
            });

            if (count($sort_columns) > 0){
                $query .= " ORDER BY " . join(", ", $sort_columns);
            }

            $result = executeQueryResult($this -> conn, $query, $params);
            return $result;
        }


        function update($data){
            $table = isset($data['table']) ? $data['table'] : throw new Exception("Please provide column name", 1);
            


            $values = isset($data['values']) && count($data['values']) > 0 ? $data['values'] : throw new Exception("You need to pass at least one new values in array with values as key", 1);

            $condition = $data['condition'] ?? "";

            array_walk($values, function(&$key, $value){
                $this -> joinKeysValues($key, $value, "=");
            });
            
            var_dump($values);


        }   
    }
