<?php
    class ViewController {
        function __construct($articleInstance, $commentsInstance, $projectsInstance) {
            $this->article = $articleInstance;
            $this->comments = $commentsInstance;
            $this->projects = $projectsInstance;
        }

        function build_article($page) {
            $this->article->setID($page);
            $articleData = $this->article->show();
            $comments = $this->comments->getComments($page);

            $deleteBtn = "";

            $commentsContainer = "<div class='comments'><h1>Komentarze</h1><form method='POST' action='index.php?article=%d'><textarea name='comment' placeholder='Komentarz'></textarea><input name='article' type='number' value='%d' hidden><input name='method' type='text' value='addComment' hidden><input type='submit' value='Wyślij'></form>%s</div>";
            $comment = "";
            foreach($comments as $key => $comm) {
                if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                    if(!isset($_GET['article'])) {
                        $article = 1;
                    } else {
                        $article = $_GET['article'];
                    }
                    $deleteBtn = "<a class='btn' href='index.php?article=" . $article . "&method=deleteComment&id=" . $comm['id'] . "'><i class='fas fa-times-circle'></i></a>";
                }
                $comment .= sprintf("<div class='commment'><div class='status'><div class='username'><i class='fas fa-user'></i>%s </div><div class='date'>%s<i class='fas fa-clock'></i></div>%s</div><div class='comment'>%s</div></div>", $this->comments->getUsername($comm['userid']), date('d/m/Y H:i:s', $comm['added']), $deleteBtn, $comm['comment']);
            }
            $commentsContainer = sprintf($commentsContainer, $page, $page, $comment);

            if ($articleData['error']) {
                return sprintf("<div class='error'><h1>%s</h1><h2>%s</h2></div>", $articleData['name'], $articleData['desc']);
            } else {
                return sprintf("<h2>%s</h2><p>%s</p>%s", $articleData['name'], $articleData['desc'], $commentsContainer);
            }
        }

        function build($page) {
            if (is_numeric($page)) {
                include(__DIR__ . "/../views/index.php");
            } else {
                if (file_exists(sprintf(__DIR__ . "/../views/%s.php", $page))) {
                    include(sprintf(__DIR__ . "/../views/%s.php", $page));
                } else {
                    include(__DIR__ . "/../views/error.php");
                }
            }
        }
    }
?>