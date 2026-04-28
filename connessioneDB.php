<?php
$conn = new mysqli("localhost", "root", "", "panseri_biblioteca");

if ($conn->connect_error) {
    die("Errore connessione");
}
?>
