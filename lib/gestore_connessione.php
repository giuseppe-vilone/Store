<?php
    $username = "web_visitor";
    $password = "sporting93"; 
    $hostname = "localhost";
    $database = "magazzino";

class GestoreConnessione
        {
            public static function apriConnessione($hostname, $username, $password, $database)
            {
                $conn = mysqli_connect($hostname, $username, $password)
                or die("ERRORE<br />");
                
                //select a database to work with
                
                $selected = mysqli_select_db($conn, $database)
                or die("ERRORE<br />");
            
                return $conn;
            }
            public static function chiudiConnessione($conn)
            {
                 mysqli_close($conn);
            }
            
        }
        
?>