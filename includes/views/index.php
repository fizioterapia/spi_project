<header>
    <h1>Portfolio</h1>
</header>
<article>
    <?php
        if (isset($_GET['article'])) {
            echo $this->build_article($_GET['article']);
        } else {
            echo $this->build_article(1);
        }
    ?>
</article>