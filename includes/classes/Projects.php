<?php
    class Project {
        function add($name, $desc, $img, $technologies) {
            if (!isset($this->db)) { return "Wystąpił błąd z serwerem!"; }

            $this->db->query(sprintf("INSERT INTO projects(name, description, image, technologies) VALUES ('%s','%s','%s','%s')", $name, $desc, $img, $technologies));

            return "Dodano projekt: " . $name;
        }

        function remove($id) {
            if (!isset($this->db)) { return "Wystąpił błąd z serwerem!"; }

            $this->db->query(sprintf("DELETE FROM projects WHERE id = %d", $id));

            return "Usunięto projekt: " . $id;
        }

        function update($id, $name, $desc, $img, $technologies) {
            if (!isset($this->db)) { return "Wystąpił błąd z serwerem!"; }

            $this->db->query(sprintf("UPDATE projects SET name = '%s', description = '%s', image = '%s', technologies = '%s' WHERE id = %d", $name, $desc, $img, $technologies, $id));        
            
            return "Zaktualizowano projekt: " . $id;
        }

        function get($id) {
            if (!isset($this->db)) { return "Wystąpił błąd z serwerem!"; }

            return isset($id) ? $this->db->query("SELECT * from projects WHERE ID = " . $id): $this->db->query("SELECT * from projects");
        }

        function setDB($db) {
            if (!isset($this->db)) {
                $this->db = $db;
            }
        }
    }
?>