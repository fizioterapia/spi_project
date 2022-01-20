<?php
    if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
        header('Location: index.php');
    }
?>
<article>
    <h1>Usuń Projekt</h1>
    <ul>
        <?php
        $projects = $this->projects->get(NULL);

        
        foreach($projects as $key => $project) {
                ?>

        <li>
            <a href="?method=delete_project&project=<?php echo $project['id']; ?>"><?php echo $project['name']; ?></a>
        </li>

        <?php 
            }
            echo "</ul>";
        ?>
</article>