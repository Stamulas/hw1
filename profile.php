<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
    
    if (!empty($_POST["title"]) && !empty($_POST["name"]) && !empty($_POST["time"]) && !empty($_POST["city"]) && !empty($_POST["cinema"])&& !empty($_POST["data"])){
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
        echo "ok";
       
           
            $userid = mysqli_real_escape_string($conn, $userid);
            $title = mysqli_real_escape_string($conn,$_POST["title"]);
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $time = mysqli_real_escape_string($conn, $_POST['time']);
            $city = mysqli_real_escape_string($conn, $_POST['city']);
            $cinema = mysqli_real_escape_string($conn, $_POST['cinema']);
            $data = mysqli_real_escape_string($conn,$_POST['data']);

            $username = mysqli_real_escape_string($conn, $_POST['username']);
        
            # check if booking is already present for user
            $query = "SELECT * FROM prenotazioni WHERE user_id = '$userid'  AND titolo = '$title' AND orario ='$time' AND città = '$city' AND cinema='$cinema' AND data1='$data'";
            $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if(mysqli_num_rows($res)>0){
                
                echo json_encode(array('ok' => true));
            exit;
            } 



        $query = "SELECT * FROM users WHERE user_id = '$userid' AND username = '$username'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        
        if(mysqli_num_rows($res) > 0) {
           
          

       $query = "INSERT INTO prenotazioni(user_id,titolo,nome,orario,città,data1,cinema ) VALUES('$userid', '$title','$name','$time','$city','$data','$cinema')";

        error_log($query);
        # Se corretta, ritorna un JSON con {ok: true}
        if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {

           mysqli_close($conn);
           header("Location: profile.php");
        }
    }
   
    }
?>

<html>
    <?php 
        
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM users WHERE user_id = $userid";
        $res_1 = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res_1);   
    ?>

    <head>
        <link rel='stylesheet' href='profile.css'>
        <script src='profile1.js' defer></script>
        <script src="index1.js" defer="true"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">

        <title>CinemaUniverse - <?php echo $userinfo['username'] ?></title>
    </head>

    <body>
    <div id="overlay">
    </div>
        <header>
            <nav>
                <div class="nav-container">
                    <div id="logo">
                         CinemaUniverse
                    </div>
                    <div id="links">
                        <a href='home.php'>HOME</a>
                        <a href ='incoming.php'>DISCOVER</a>
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
            <a>HOME</a>
            <a href="incoming.php">DISCOVER</a>
          <a>ABOUT</a>
          <a>CONTACT</a>
          <a href='signup.php'>ISCRIVITI</a>
          <a href='login.php'>ACCEDI</a>
        </div>
                </div>
                <div class="userInfo">
                    <div >
                    </div>
                    <h1><div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <h3 ><?php echo $userinfo['username'] ?> </h3>
    </div>
  </div>
</div></h1>
                </div>               
            </nav>
        </header>
        <section class ="agenda">
            <h1>Agenda </h1>
            <h3>Qui potrai visualizzare le tue prenotazioni:</h3>
            <ul></ul>
        </section>
        <section class = "form hidden">
        
        <form name='booking' method='post' enctype="multipart/form-data" autocomplete="off">
           <h1>Form prenotazione</h1>
         <div class="title">
        <label for='title'>Titolo </label>
        <input type='text' name='title'readonly>
         </div>
        <div class="username">
        <label for='username'>Username </label>
        <input type='text' name='username'>
                
        </div>
        
        <div class="name">
        <label for='name'>Nome </label>
        <input type='text ' name='name' >
                
        </div>
        <div class="time">
        <label for='time'>Orario </label>
        <select id='time' name='time'>
        <option value = "11:30">11.30</option>
        <option value = "15:00">15.00</option> 
        <option value = "18:40">18.45</option> 
        <option value = "23:30">23.30</option>     
        </select>
        
              
         </div> 
         <div class="city">
        <label for='city'>Città </label>
        <select id='city' name='city'>
        <option value = "Catania">Catania</option>
        <option value = "Milano">Milano</option> 
        <option value = "Torino">Torino</option> 
        <option value = "Palermo">Palermo</option>     
        </select>
        <div class="data">
        <label for='data'>Data</label>
        <input type='date' name='data'>
                
        </div>
              
         </div>
         <div class="cinema">
        <label for='cinema'>Nome Cinema</label>
        <input type='text' name='cinema'>
                
        </div>
        <input id="submit"type="submit">
         <form> 
        </section>
<section class="preferences">
        <div id=preferences>

        </div>
    </section>
        <section class="container">
            <h1>Qui Puoi Visualizzare i tuoi film preferiti!!
            </h1>
            <div id="results">
                
            </div>
    </section>
    

    </body>
</html>

<?php mysqli_close($conn); ?>