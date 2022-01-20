<?php
    if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
        header('Location: index.php');
    }
?>
<article>
    <h1>Dodaj Projekt</h1>

    <form method="post" action="index.php" enctype="multipart/form-data">
        <input name="project__name" placeholder="Tytul">
        <input name="project__technologies" placeholder="HTML;CSS;JS">
        <textarea name="project__desc" placeholder="Opis"></textarea>
        <input id="project_file" name="pic" type="file">
        <input name="method" type="text" value="add_project" hidden>
        <input type="submit" value="Wyślij">
    </form>

</article>