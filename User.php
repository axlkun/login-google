<?php
require_once __DIR__ . '/config/database/database.php';

class User
{

    private $db;

    function __construct()
    {
        if (!isset($this->db)) {
            $this->db = connectDB();
        }
    }

    function checkUser($data = array())
    {
        if (!empty($data)) {

            // Escapamos los valores para prevenir inyección de SQL
            $oauth_id = pg_escape_string($this->db, $data['oauth_id']);

            // Consulta SQL segura utilizando placeholders
            $checkUserquery = "SELECT * FROM public.user WHERE oauth_id = $1";

            // Preparamos la consulta
            $result = pg_prepare($this->db, "checkUser", $checkUserquery);


            // Ejecutamos la consulta con los valores
            $result = pg_execute($this->db, "checkUser", array($oauth_id));

            // Add modified time to the data array 
            if (!array_key_exists('updated_at', $data)) {
                $data['updated_at'] = date("Y-m-d H:i:s");
            }

            if (pg_fetch_row($result) > 0) {

                // Prepare column and value format 
                $colvalSet = '';
                $i = 0;

                foreach ($data as $key => $val) {
                    $pre = ($i > 0) ? ', ' : '';
                    $colvalSet .= $pre . $key . "='" . pg_escape_string($this->db, $val) . "'";
                    $i++;
                }

                $whereSql = " WHERE oauth_id = '" . $oauth_id . "'";

                // Update user data in the database 
                $updateQuery = "UPDATE public.user SET " . $colvalSet . $whereSql;

                // exec query
                $update = pg_query($this->db, $updateQuery);

            }else{ 

                // Add created time to the data array 
                if(!array_key_exists('created_at',$data)){ 
                    $data['created_at'] = date("Y-m-d H:i:s"); 
                } 
                 
                // Prepare column and value format 
                $columns = $values = ''; 
                $i = 0; 

                foreach($data as $key=>$val){ 
                    $pre = ($i > 0)?', ':''; 
                    $columns .= $pre.$key; 
                    $values  .= $pre . "'" . pg_escape_string($this->db, $val) . "'"; 
                    $i++; 
                } 
                 
                // Insert user data in the database 
                $insertQuery = "INSERT INTO public.user (". $columns. ") VALUES (" . $values . ")"; 
                
                $insert = pg_query($this->db, $insertQuery);
            } 

            // Get user data from the database 
            $result = pg_prepare($this->db, "getUser", $checkUserquery);
            $result = pg_execute($this->db, "getUser", array($oauth_id));

            $userData = pg_fetch_row($result);
        }

        // Return user data 
        return !empty($userData)?$userData:false; 
    }
}
