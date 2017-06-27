<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>afpa-bay</title>
        <link rel="stylesheet" href="css/style.css"/>
    </head>
    <?php
    session_start();
    ?>
    <body>
        <header>
            <a href="index.php"><img src="images/afpa_logotb.png" alt="logo"/></a>
            <h1>afpa-bay</h1>
            <?php
            if (!isset($_SESSION['user_id'])){
                echo '<a href="index.php?page=login">login</a>';
                echo '--';
                echo '<a href="index.php?page=register-form">register</a>';
            }else{
                echo '<span>bonjour '. $_SESSION['current_user']. '</span> <a href="index.php?page=logout">logout</a>';
            }
            ?>
        </header>
        <main>
        <?php
        
        $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
        if ($page){
            include($page.'.php');
        }else{
            include("film-list.php");
        }
        
        
        ?>
        </main>
    </body>
</html>
