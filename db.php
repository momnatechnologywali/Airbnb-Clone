<?php
$servername = "localhost";
$username = "uws1gwyttyg2r";
$password = "k1tdlhq4qpsf";
$dbname = "dbppl4h5j6bz9g";
 
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>
