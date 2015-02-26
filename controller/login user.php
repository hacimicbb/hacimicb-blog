<?php
    require_once(__DIR__ . "/../model/config.php");
    
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    
    /* This is the filter input and filter sanitize for the username and password */
    
    $query = $_SESSION["connection"]->query("SELECT salt, password FROM users WHERE username = '$username'");
    
    if($query->num_rows == 1) {
        $row = $query->fetch_array();
        
        if($row["password"] === crypt($password, $row["salt"])) {
            $_SESSION["authenticated"] =true;
            echo "<p>Login Successful!</p>";
            
        }
        else {
            echo "<p>Invalid username and password</p>";
        }
     }
     else {
         echo "<p>Invalid username and password</p>";
     }
     /* This is the telling us if we have the correct login username and or password */