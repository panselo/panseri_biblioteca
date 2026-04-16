<?php include "connessione.php"; ?>

<form method="post">
    Libro:
    <select name="libro">
        <?php
        $libri = $conn->query("SELECT * FROM Libri");
        while ($row = $libri->fetch_assoc()) {
            echo "<option value='".$row['id_libro']."'>".$row['titolo']."</option>";
        }
        ?>
    </select><br>

    Utente:
    <select name="utente">
        <?php
        $utenti = $conn->query("SELECT * FROM Utenti");
        while ($row = $utenti->fetch_assoc()) {
            echo "<option value='".$row['id_utente']."'>".$row['nome']."</option>";
        }
        ?>
    </select><br>

    <input type="submit" name="invia" value="Inserisci Prestito">
</form>

<?php
if (isset($_POST['invia'])) {
    $libro = $_POST['libro'];
    $utente = $_POST['utente'];

    $conn->query("INSERT INTO Prestiti (id_libro, id_utente, data_inizio, data_fine_prevista)
                  VALUES ($libro, $utente, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY))");

    echo "Prestito inserito!";
}
?>