<?php
    $projects = $this->projects->get(NULL);
?>
<header>
    <h1>Projekty</h1>
</header>
<article>
    <div class="projects">
        <?php
    foreach($projects as $key => $project) {
    ?>
        <div class="project">
            <div class="project-bg"><img
                    src="<?= $project['image'] != NULL ? $project['image'] : "assets/img/404.png"; ?>" /></div>
            <div class="inner">
                <div class="project-name"><?= $project['name']; ?></div>
                <div class="project-technologies">
                    <?php
                    foreach(explode( ";", $project['technologies']) as $tech) { ?>
                    <span class="project-technology"><?= $tech ?></span>
                    <?php } 
                ?>
                </div>
                <div class="project-description"><?= $project['description']; ?></div>
            </div>
        </div>
        <?php
    }
    ?>
    </div>
</article>