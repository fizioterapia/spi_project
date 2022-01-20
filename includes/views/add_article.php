<?php
    if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
        header('Location: index.php');
    }
?>
<article>
    <h1>Dodaj artykuł</h1>

    <form method="post" action="index.php">
        <input name="article__name" placeholder="Tytul">
        <textarea name="article__desc" placeholder="Opis"></textarea>
        <input name="method" type="text" value="add_article" hidden>
        <input type="submit" value="Wyślij">
    </form>

</article>