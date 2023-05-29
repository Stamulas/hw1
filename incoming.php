<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>

 <head>
        <link rel='stylesheet' href='profile.css'>
        
        <script src='incoming1.js' defer></script>
        <script src='index1.js' defer></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">

        <title>CinemaUniverse </title>
    </head>

    <body>
    
        <header>
            <nav>
                <div class="nav-container">
                    <div id="logo">
                         CinemaUniverse
                    </div>
                    <div id="links">
                        <a href='home.php'>HOME</a>
                        <a>DISCOVER</a>
                        <a>ABOUT</a>
                        <a>CONTACT</a>
                        <div id="separator"></div>
                        <a href='logout.php' class='button'>LOGOUT</a>
                    </div>
                    <div id="menu">
                        <div></div>
                        <div></div>
                        <div></div>
                        
                    </div>
                    <div id="menulinks" class="hidden">
                    <a href='home.php'>HOME</a>
                        <a>DISCOVER</a>
                        <a>ABOUT</a>
                        <a>CONTACT</a>
            
                        <a href='logout.php' class='button'>LOGOUT</a>
        </div>
                </div>
                             
            </nav>
        </header>
   
        <section class="container">
            <div class="divcontainer">
                <h1>Scopri i film in arrivo nelle sale</h1>
                
        <button class ="incoming">clicca qui</button>
    
            <div id="results">
                
            </div>
    </section>

    </body>
</html>
