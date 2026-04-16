<?php include "connessione.php"; ?>

<form method="get">
    Utente:
    <select name="utente">
        <?php
        $utenti = $conn->query("SELECT * FROM Utenti");
        while ($row = $utenti->fetch_assoc()) {
            echo "<option value='".$row['id_utente']."'>".$row['nome']."</option>";
        }
        ?>
    </select>

    <input type="submit" value="Visualizza">
</form>

<?php
if (isset($_GET['utente'])) {
    $utente = $_GET['utente'];

    $query = "SELECT p.id_prestito, l.titolo, p.restituito
              FROM Prestiti p
              JOIN Libri l ON p.id_libro = l.id_libro
              WHERE p.id_utente = $utente";

    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        echo $row['titolo'];

        if (!$row['restituito']) {
            echo " <a href='restituisci.php?id=".$row['id_prestito']."'>[Restituisci]</a>";
        } else {
            echo " (restituito)";
        }

        echo "<br>";
    }
}
?>