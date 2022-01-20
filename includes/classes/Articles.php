<?php
    class Article {
        function setID($id) {
            $this->id = $id;
        }

        function setDB($db) {
            if (!isset($this->db)) {
                $this->db = $db;
            }
        }

        function add($name, $desc) {
            if (!isset($this->db)) { return "Wystąpił błąd z serwerem!"; };
            $this->db->query(sprintf("INSERT INTO article(name, content) VALUES('%s', '%s')", $name, $desc));

            return "Dodano artykuł!";
        }
        
        function update($id, $name, $desc) {
            if (!isset($this->db)) { return "Wystąpił błąd z serwerem!"; };

            $this->db->query(sprintf("UPDATE article SET name = '%s', content = '%s' WHERE id = %d", $name, $desc, $id));            

            return "Edytowano artykuł!";
        }

        function remove($id) {
            if (!isset($this->db)) { return "Wystąpił błąd z serwerem!"; };

            $this->db->query(sprintf("DELETE FROM articles WHERE id = %d", $id));            

            return "Usunięto artykuł!";
        }

        function getArticles() {
            if (!isset($this->db)) { return "Wystąpił błąd z serwerem!"; }

            $articles = $this->db->query("SELECT * from `article`");

            return $articles;
        }

        function show() {
            if (!isset($this->db)) { return "Wystąpił błąd z serwerem!"; }

            $article = $this->db->query(sprintf("SELECT * from `article` WHERE id = %d;", $this->id));
            if (count($article) == 0) {
                return Array(
                    'name' => 'Wystąpił błąd!',
                    'desc' => 'Nie istnieje taki artykuł!',
                    'error' => true
                );
            } else {
                return Array(
                    'name' => $article[0]['name'],
                    'desc' => $article[0]['content'],
                    'error' => false
                );
            }
        }
    }
?>