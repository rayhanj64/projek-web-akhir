<?php 

$server = "localhost";
$user = "root";
$password = "";
$database = "personal_health_record";

$port = "8111"; 
// sebenarnya port 8111 khusus buat laptopku yg XAMPP-nya berkebutuhan khusus, butuh port 8111
// mending dihapus klo di laptop lain biar gak error

$connect = mysqli_connect(
            $server, 
            $user, 
            $password, 
            $database, 
                $port);
                    
if (!$connect) {
    die("failed to connect database: ".mysqli_connect_error());
}

?>