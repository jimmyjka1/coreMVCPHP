<?php 


    class DatabaseHelper{

        public function __construct() {
            global $pdo;

            $this -> conn = $pdo;
        }



        public function select($data){
            $table = $data['table'] ?? throw new Exception("Please Specify Table Name", 1);
            $columns = $data['columns'] ?? throw new Exception("Please Specify columns list", 1);
            if (count($columns) <= 0){
                throw new Exception("Please Specify atleast One column", 1);
            }

            $where = $data['where'] ?? "";
            $like = $data['like'] ?? "";

            $sort_columns = $data['sort_columns'] ?? [];
            $sort_direction = $data['sort_direction'] ?? [];

            
            


            

        }
    }
