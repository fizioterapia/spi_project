<?php
    session_start();

    $config = include("includes/config/Config.php");
    include("includes/classes/Database.php");
    include("includes/classes/User.php");
    include("includes/classes/Articles.php");
    include("includes/classes/Comments.php");
    include("includes/classes/Stylesheets.php");
    include("includes/classes/Projects.php");
    include("includes/classes/ViewController.php");

    $db = new Database(
        "host",
        "username",
        "password",
        "database"
    );

    $user = new User();
    $article = new Article();
    $comments = new Comments();
    $projects = new Project();
    $stylesheets = new Stylesheet();

    $user->setDB($db);
    $article->setDB($db);
    $comments->setDB($db);
    $projects->setDB($db);
    $stylesheets->setDB($db);


    if(isset($_SESSION['admin']) and $_SESSION['admin'] > 0) {
        if(isset($_GET['method'])) {
            switch($_GET['method']) {
                case "delete_article":
                    $alert = $article->remove($_GET['article']);
                    break;
                case "delete_project":
                    $alert = $projects->remove($_GET['project']);
                    break;
                case "deleteComment":
                    $alert = $comments->removeComment($_GET['id']);
                    break;
                case "default":
                    break;
            }
        }

        if(isset($_POST['method'])) {
            switch($_POST['method']) {
                case "login":
                    $alert = $user->login($_POST['username'], $_POST['password']);
                    break;
                case "register":
                    $alert = $user->register($_POST['username'], $_POST['password']);
                    break;
                case "addComment":
                    $alert = $comments->addComment(isset($_SESSION['userid']) ? $_SESSION['userid'] : 0, $_POST['article'], $_POST['comment']);
                    break;
                case "edit_article":
                    $alert = $article->update($_POST['edit_article_id'], $_POST['article__name'], $_POST['article__desc']);
                    break;
                case "add_article":
                    $alert = $article->add($_POST['article__name'], $_POST['article__desc']);
                    break;
                case "edit_project":
                    if (!isset($_FILES['pic']) || count(getimagesize($_FILES["pic"]["tmp_name"])) == 0) {
                        return;
                    }
        
                    $target_dir = "assets/img/";
                    $target_file = $target_dir . basename($_FILES["pic"]["name"]);
        
                    move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file);
        
                    $alert = $projects->update($_POST['edit_project_id'], $_POST['project__name'], $_POST['project__desc'], $target_file, $_POST['project__technologies']);
                    break;
                case "add_project":
                    if (!isset($_FILES['pic']) || count(getimagesize($_FILES["pic"]["tmp_name"])) == 0) {
                        return;
                    }

                    $target_dir = "assets/img/";
                    $target_file = $target_dir . basename($_FILES["pic"]["name"]);

                    move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file);

                    $alert = $projects->add($_POST['project__name'], $_POST['project__desc'], $target_file, $_POST['project__technologies']);
                    break;
            }
        }
    }

    $viewController = new ViewController($article, $comments, $projects);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $config['site']['name']; ?></title>
    <meta name="description" content="<?= $config['site']['description']; ?>" />
    <meta property="og:type" content="website">
    <meta property="og:url"
        content="<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"; ?>">
    <meta property="og:title" content="<?= $config['site']['name']; ?>">
    <meta property="og:description" content="<?= $config['site']['description']; ?>">
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <?= $stylesheets->get(isset($_GET['page']) == true ? $_GET['page'] : 'index'); ?>
</head>

<body>
    <div id="site">
        <nav>
            <div class="nav__site">
                Portfolio
            </div>
            <div class="nav__links">
                <a class="nav__item" href="?page=index">
                    Strona Główna
                </a>
                <a class="nav__item" href="?article=2">
                    O mnie
                </a>
                <a class="nav__item" href="?article=3">
                    Kontakt
                </a>
                <a class="nav__item" href="?page=projects">
                    Projekty
                </a>
            </div>
            <div class="nav__user">
                <?php if (isset($_SESSION['username'])) { 
                    echo '<span class="nav__username"> <i class="fas fa-user"></i> ' . $_SESSION['username'] . '</span>';

                    if ($_SESSION['admin'] > 0) {
                        ?> <a class="nav__link" href="?page=admin">
                    <i class="fas fa-wrench"></i> Panel Administratora
                </a> <?php
                    }
                    ?>

                <a class="nav__link" href="?page=logout">
                    <i class="fas fa-sign-out-alt"></i> Wyloguj
                </a>

                <?php
                 } else {?>
                <a class="nav__link" href="?page=login">
                    <i class="fas fa-user"></i> Zaloguj się
                </a>
                <a class="nav__link" href="?page=register">
                    <i class="fas fa-wrench"></i> Rejestracja
                </a>
                <?php 
                }
                ?>
            </div>
        </nav>
        <div class="inner">
            <?php
            if (isset($alert)) { echo "<div class='alert'>" . $db->escape_string($alert) . "</div>";}
        ?>
            <?php
        if (isset($_GET['page'])) {
            $viewController->build($_GET['page']);
        } else {
            $viewController->build("index");
        }

        ?>
        </div>
        <footer>
            <div class="column">
                <h2>Copyright</h2>
                <p>&copy; 2021, made by <a href="https://fizi.pw">Tomasz Gradek</a></p>
            </div>
            <div class="column">
                <h2>Made with</h2>
                <p>
                    <i class="fab fa-html5 fa-3x"></i>
                    <i class="fab fa-css3 fa-3x"></i>
                    <i class="fab fa-php fa-3x"></i>
                    <i class="fab fa-sass fa-3x"></i>
                    <i class="fas fa-database fa-3x"></i>
                </p>
            </div>
        </footer>
    </div>
</body>

</html>