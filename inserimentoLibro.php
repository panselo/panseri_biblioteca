<?php include "connessione.php"; ?>

<form method="post">
    Titolo: <input type="text" name="titolo"><br>

    Autore:
    <select name="autore">
        <?php
        $result = $conn->query("SELECT * FROM Autori");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='".$row['id_autore']."'>".$row['nome']."</option>";
        }
        ?>
    </select><br>

    <input type="submit" name="invia" value="Inserisci">
</form>

<?php
if (isset($_POST['invia'])) {
    $titolo = $_POST['titolo'];
    $autore = $_POST['autore'];

    $conn->query("INSERT INTO Libri (titolo, id_autore) VALUES ('$titolo', $autore)");
    echo "Libro inserito!";
}
?>