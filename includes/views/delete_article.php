<?php
    if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
        header('Location: index.php');
    }
?>
<article>
    <h1>Usuń artykuł</h1>
    <ul>
        <?php
            $articles = $this->article->getArticles();

        
            foreach($articles as $key => $article) {
                ?>

        <li>
            <a href="?method=delete_article&article=<?php echo $article['id']; ?>"><?php echo $article['name']; ?></a>
        </li>

        <?php 
            }
            echo "</ul>";
        ?>
</article>