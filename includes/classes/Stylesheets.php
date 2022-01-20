<?php
    class Stylesheet {
        function get($id) {
            if (!isset($this->db)) { return "Wystąpił błąd z serwerem!"; }

            $stylesheet = $this->db->query(sprintf("SELECT * FROM stylesheets WHERE page = '%s'", strtolower($id)));

            if(count($stylesheet) > 0) {
                return sprintf("<style>%s</style>", $stylesheet['0']['stylesheet']);
            }
        }

        function update($id, $stylesheet) {
            if (!isset($this->db)) { return "Wystąpił błąd z serwerem!"; }

            $this->db->query(sprintf("UPDATE stylesheets SET stylesheet = '%s' WHERE page = '%s'", $stylesheet, $id));

            return "Zaktualizowano skoroszyt.";
        }

        function setDB($db) {
            if (!isset($this->db)) {
                $this->db = $db;
            }
        }
    }
?>