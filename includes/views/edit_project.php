<?php
    if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
        header('Location: index.php');
    }
?>
<article>
    <h1>Edytuj Projekt</h1>

    <?php
    if (isset($_GET['project'])) { 
        $project = $this->projects->get($_GET['project'])[0];
        ?>

    <form method="post" action="index.php" enctype="multipart/form-data">
        <input name="project__name" placeholder="Tytul" value="<?= $project['name']; ?>">
        <input name="project__technologies" placeholder="HTML;CSS;JS" value="<?= $project['technologies'] ?>">
        <textarea name="project__desc" placeholder="Opis"><?= $project['description']; ?></textarea>
        <input id="project_file" name="pic" type="file">
        <input name="edit_project_id" type="text" value="<?php echo $_GET['project']; ?>" hidden>
        <input name="method" type="text" value="edit_project" hidden>
        <input type="submit" value="Wyślij">
    </form>

    <?php } else {
        echo "<ul>";
        $projects = $this->projects->get(NULL);

        
    foreach($projects as $key => $project) {
            ?>

    <li>
        <a href="?page=edit_project&project=<?php echo $project['id']; ?>"><?php echo $project['name']; ?></a>
    </li>

    <?php 
        }
        echo "</ul>";
    } ?>

</article>