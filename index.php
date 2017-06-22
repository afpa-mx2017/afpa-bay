<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            
            html{
                margin:0;
                padding:0;
            }


            header{
                box-shadow:15px 10px 12px #eeeeee;
            }
            
            header h1{
                display:inline-block;
                text-align: center;
                margin:0;
                width: 70%;
            }
            
            
            header img{
                display:inline-block;
                left:1em;
                max-width:120px;
                vertical-align: middle;
            }
            
            main{
                margin:1em;
            }

            
            .alert{
                color:red;
            }
            
            input[type="text"]{
                display:block;
            }
            
            .film-list{
                list-style-type: none;
                padding:1em;
                
            }
            .film-list li{
                border:1px solid grey;
                margin:0.5em;
                padding:1em;
                display:inline-block;
                width:20%;
            }
            
            .film-list li img{
                max-height: 400px;
                width: 100%;
                height: auto;
            }
            
            @media screen and (max-width: 640px) {
             .film-list li{
                 width:100%;
                 margin:0;
                 padding:0 0.5em;
             }
                
            }
            
            
        </style>
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
            }else{
                echo 'bonjour '. $_SESSION['current_user']. ' <a href="index.php?page=logout">logout</a>';
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
