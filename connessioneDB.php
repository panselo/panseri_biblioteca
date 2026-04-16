<?php
$conn = new mysqli("localhost", "root", "", "tuocognome_biblioteca");

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
?>