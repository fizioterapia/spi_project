<?php
    class Database {
        function __construct($host, $login, $password, $db) {
            $this->db = new mysqli($host, $login, $password, $db);
            $this->db->set_charset("utf8mb4");
        }

        function escape_string($input) {
            $input = htmlspecialchars($input); // prevent XSS
            return $this->db->escape_string($input);
        }

        function query($statement) {
            $query_result = $this->db->query($statement);

            $tmp = array();

            while (!is_bool($query_result) && $row = $query_result->fetch_assoc()) {
                array_push($tmp, $row);
            };
            
            return $tmp;
        }
    }
?>