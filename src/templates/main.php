<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>afpa-bay</title>
        <link rel="stylesheet" href="/public/css/style.css"/>
    </head>
    <body>
        <header>
            <a href="/"><img src="/public/images/afpa_logotb.png" alt="logo"/></a>
            <h1>afpa-bay</h1>
            <?php
            if (!isset($_SESSION['user_id'])){
                echo '<a href="/login">login</a>';
                echo '--';
                echo '<a href="/register">register</a>';
            }else{
                echo '<span>bonjour '. $_SESSION['current_user']. '</span> <a href="/logout">logout</a>';
            }
            ?>
        </header>
        <main>
        <?php
        

        
            echo $content;
        
        
        ?>
        </main>
    </body>
</html>
