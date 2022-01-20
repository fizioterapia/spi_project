<?php
    class User {
        function login($username, $password) {
            if (!isset($this->db))  { return; }

            $username = $this->db->escape_string($username);
            $password = $this->db->escape_string($password);

            $users = $this->db->query(sprintf("SELECT id, username, admin FROM `users` WHERE username = '%s' and password = '%s'", $username, $password));

            if (count($users) == 0) {
                return "Użytkownik nie istnieje!";
            } else {
                $_SESSION['userid'] = $users[0]['id'];
                $_SESSION['username'] = $users[0]['username'];
                $_SESSION['admin'] = $users[0]['admin'];

                return "Zalogowano pomyślnie!";
            }
        }

        function register($username, $password) {
            if (!isset($this->db)) { return "Wystąpił błąd z serwerem!"; }

            $username = $this->db->escape_string($username);
            $password = $this->db->escape_string($password);

            if(strlen($username) > 32) {
                return "Za dluga nazwa uzytkownika!";
            }

            if(strlen($password) > 32) {
                return "Za dlugie haslo!";
            }

            if (count($this->db->query(sprintf("SELECT username FROM `users` WHERE username = '%s'", $username))) > 0) {
                return "Nazwa użytkownika jest już zajęta!";
            } else {
                $this->db->query(sprintf("INSERT INTO users(username, password) VALUES ('%s', '%s')", $username, $password));

                return "Konto zostało utworzone!";
            }
        }

        function logout() {
            session_destroy();
            return "Wylogowano pomyślnie!";
        }

        function setDB($db) {
            if (!isset($this->db)) {
                $this->db = $db;
            }
        }
    }
?>