<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>

  <head>
    <title>CinemaUniverse</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="home1.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="home.js" defer="true"></script>
    <script src="index1.js" defer="true"></script>
  </head>
  
  <body>
    
    <header>
      <nav>
        <div id="logo">
         CinemaUniverse
        </div>
        <div id="links">
          <a>HOME</a>
          <a href="incoming.php">DISCOVER </a>
          <a>ABOUT</a>
          <a>CONTACT</a>
          <div id="separator"></div>
          <a href='profile.php'>PROFILO</a>
          <a href='logout.php' class='button'>LOGOUT</a>
        </div>
        <div id="menu">
          <div></div>
          <div></div>
          <div></div>
        </div><div id="menulinks" class="hidden">
        <a>HOME</a>
          <a href="incoming.php">DISCOVER </a>
          <a>ABOUT</a>
          <a>CONTACT</a>
          <div id="separator"></div>
          <a href='profile.php'>PROFILO</a>
          <a href='logout.php' class='button'>LOGOUT</a>
        </div>
      </nav>
      <h1>Rimani sempre aggiornato, cerca un film.</h1>
      <a class="subtitle">
        Esplora con noi il mondo del cinema!
      </a>
    </header>
    <section id="search">
      <img id="lente"src="assets/lente.png"></img>
      <form autocomplete="off">
        <div class="search">
          <label for='search'></label>
          <input type='text' name="search" class="searchBar">
          <input type="submit" value="Cerca">
        </div>
      </form>
      
    </section>
    <section class="container">

            <div id="results">
                
            </div>
    </section>
    <footer>
      <nav>
        <div class="footer-container">
          <div class="footer-col">
            <h1>CinemaUniverse</h1>
          </div>
          <div class="footer-col">
            <strong>AZIENDA</strong>
            <p>Chi siamo</p>
            <p>Lavora con noi</p>
          </div>
          <div class="footer-col">
            <strong>CATEGORIE</strong>
            <p>Attori</p>
            <p>Film</p>
            <p>Eventi</p>
            <p>Registi</p>
          </div>
          <div class="footer-col">
            <strong>LINK UTILI</strong>
            <p>Assistenza</p>
            <p>App per cellulare</p>
            <p>Informazioni legali</p>
          </div>
        </div>
      </nav>
    </footer>
  </body>
  </html>