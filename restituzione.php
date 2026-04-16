<?php include "connessione.php"; ?>

$id = $_GET['id'];

$conn->query("UPDATE Prestiti SET restituito = 1 WHERE id_prestito = $id");

echo "Libro restituito! <br>";
echo "<a href='prestiti.php'>Torna indietro</a>";
?>