<?php
    if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
        header('Location: index.php');
    }
?>
<article>
    <h1>Edytuj artykuł</h1>
    <?php
    if (isset($_GET['article'])) { 
        $this->article->setID($_GET['article']);
        $articleData = $this->article->show();
        ?>

    <form method="post" action="index.php">
        <input name="article__name" placeholder="Tytul" value="<?php echo $articleData['name']; ?>">
        <textarea name="article__desc" placeholder="Opis"><?php echo $articleData['desc']; ?></textarea>
        <input name="method" type="text" value="edit_article" hidden>
        <input name="edit_article_id" type="text" value="<?php echo $_GET['article']; ?>" hidden>
        <input type="submit" value="Wyślij">
    </form>
    <?php } else {
        echo "<ul>";
        $articles = $this->article->getArticles();

        
        foreach($articles as $key => $article) {
            ?>

    <li>
        <a href="?page=edit_articles&article=<?php echo $article['id']; ?>"><?php echo $article['name']; ?></a>
    </li>

    <?php 
        }
        echo "</ul>";
    } ?>
</article>