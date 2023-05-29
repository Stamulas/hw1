<?php
    
    include 'auth.php';
    if (checkAuth()) {
        header('Location: home.php');
        exit;
    }
    
    if (!empty($_POST["username"]) && !empty($_POST["password"]) )
    {
        
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        
        $query = "SELECT * FROM users WHERE username = '".$username."'";
        
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));;
       
        if (mysqli_num_rows($res) > 0) {
            
            $entry = mysqli_fetch_assoc($res);
             if (password_verify($_POST['password'], $entry['password'])) {
                 echo "ok";
              
                $_SESSION["_agora_username"] = $entry['username'];
                $_SESSION["_agora_user_id"] = $entry['user_id'];
                 header("Location: home.php");
                mysqli_free_result($res);
               mysqli_close($conn);
                exit;
             }
        }
       
        echo $error = "Username e/o password errati.";
    }
    else if (isset($_POST["username"]) || isset($_POST["password"])) {
       
        echo $error = "Inserisci username e password.";
    }

?>

<html>
    <head>
        <link rel='stylesheet' href='login.css'>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Accedi - CinemaUniverse</title>
    </head>
    <body>
        <div id="logo">
            CinemaUniverse
        </div>
        <main class="login">
        <section class="main">
            <h5>Per continuare, accedi a CinemaUniverse.</h5>
            <?php
                // Verifica la presenza di errori
                if (isset($error)) {
                    echo "<p class='error'>$error</p>";
                }
                
            ?>
            <form name='login' method='post'>
                
                <div class="username">
                    <label for='username'>Username</label>
                    <input type='text' name='username' <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                </div>
                <div class="password">
                    <label for='password'>Password</label>
                    <input type='password' name='password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                </div>
                <div class="submit-container">
                    <div class="login-btn">
                        <input type='submit' value="ACCEDI">
                    </div>
                </div>
            </form>
            <div class="signup"><h4>Non hai un account?</h4></div>
            <div class="signup-btn-container"><a class="signup-btn" href="signup.php">ISCRIVITI </a></div>
        </section>
        </main>
    </body>
</html>