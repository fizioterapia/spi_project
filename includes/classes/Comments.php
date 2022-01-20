<?php
    class Comments {
        function setDB($db) {
            if (!isset($this->db)) {
                $this->db = $db;
            }
        }

        function getUsername($uid) {
            if ($uid == 0) {
                return "Niezarejestrowany";
            } else {
                $results = $this->db->query(sprintf("SELECT * FROM users WHERE id = %d", $uid));
                if (count($results) > 0) {
                    return $results[0]['username'];
                } else {
                    return "Konto usunięte";
                }
            }
        }

        function addComment($uid, $articleid, $comment) {
            // id, userid, comment, added, articleid
            if (!isset($this->db)) { return "Wystąpił błąd z serwerem!"; }

            $this->db->query(sprintf("INSERT INTO comments(userid, comment, articleid) VALUES (%d, '%s', %d)", $uid, $this->db->escape_string($comment), $articleid));

            return "Dodano komentarz o treści: " . $comment;
        }

        function removeComment($commentid) {
            if (!isset($this->db)) { return "Wystąpił błąd z serwerem!"; }

            $this->db->query(sprintf("DELETE FROM comments where id = %d", $commentid));

            return "Usunięto komentarz: " . $commentid;
        }

        function getComments($articleid) {
            if (!isset($this->db)) { return "Wystąpił błąd z serwerem!"; }

            return $this->db->query(sprintf("SELECT * FROM comments WHERE articleid = %d ORDER BY ID DESC", $articleid));
        }
    }
?>