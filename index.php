<?php 
include "connessioneDB.php";
include "funzioni.php";

// AZIONI
if (isset($_POST['addLibro'])) {
    inserisciLibro($conn, $_POST['titolo'], $_POST['autore']);
}

if (isset($_POST['addPrestito'])) {
    inserisciPrestito($conn, $_POST['libro'], $_POST['utente']);
}

if (isset($_GET['restituisci'])) {
    restituisciLibro($conn, $_GET['restituisci']);
}
?>

<h2>Inserisci Libro</h2>
<form method="post">
    Titolo: <input type="text" name="titolo">

    Autore:
    <select name="autore">
        <?php
        $autori = getAutori($conn);
        while ($a = $autori->fetch_assoc()) {
            echo "<option value='{$a['id_autore']}'>{$a['nome']}</option>";
        }
        ?>
    </select>

    <input type="submit" name="addLibro" value="Inserisci">
</form>

<hr>

<h2>Inserisci Prestito</h2>
<form method="post">

    Libro:
    <select name="libro">
        <?php
        $libri = getLibri($conn);
        while ($l = $libri->fetch_assoc()) {
            echo "<option value='{$l['id_libro']}'>{$l['titolo']}</option>";
        }
        ?>
    </select>

    Utente:
    <select name="utente">
        <?php
        $utenti = getUtenti($conn);
        while ($u = $utenti->fetch_assoc()) {
            echo "<option value='{$u['id_utente']}'>{$u['nome']}</option>";
        }
        ?>
    </select>

    <input type="submit" name="addPrestito" value="Inserisci">
</form>

<hr>

<h2>Prestiti Utente</h2>

<form method="get">
    <select name="utente">
        <?php
        $utenti = getUtenti($conn);
        while ($u = $utenti->fetch_assoc()) {
            echo "<option value='{$u['id_utente']}'>{$u['nome']}</option>";
        }
        ?>
    </select>

    <input type="submit" value="Visualizza">
</form>

<?php
if (isset($_GET['utente'])) {
    $prestiti = getPrestitiUtente($conn, $_GET['utente']);

    while ($p = $prestiti->fetch_assoc()) {
        echo $p['titolo'];

        if (!$p['restituito']) {
            echo " <a href='?restituisci={$p['id_prestito']}'>[Restituisci]</a>";
        } else {
            echo " (restituito)";
        }

        echo "<br>";
    }
}
?>
