<?php
    if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
        header('Location: index.php');
    }
?>
<header>
    <h1>Panel Administratora</h1>
</header>
<article>
    <ul>
        <li>
            <a href="?page=add_article"><i class="fas fa-wrench"></i>Dodaj artykuły</a>
        </li>
        <li>
            <a href="?page=edit_articles"><i class="fas fa-wrench"></i>Edytuj artykuły</a>
        </li>
        <li>
            <a href="?page=delete_article"><i class="fas fa-wrench"></i>Usuń artykuły</a>
        </li>
        <li>
            <a href="?page=add_project"><i class="fas fa-wrench"></i>Dodaj projekt</a>
        </li>
        <li>
            <a href="?page=edit_project"><i class="fas fa-wrench"></i>Edytuj projekt</a>
        </li>
        <li>
            <a href="?page=delete_project"><i class="fas fa-wrench"></i>Usuń projekt</a>
        </li>
    </ul>
</article>