<?php

function getAutori($conn) {
    return $conn->query("SELECT * FROM Autori");
}

function getLibri($conn) {
    return $conn->query("SELECT * FROM Libri");
}

function getUtenti($conn) {
    return $conn->query("SELECT * FROM Utenti");
}

function inserisciLibro($conn, $titolo, $autore) {
    $conn->query("INSERT INTO Libri (titolo, id_autore) VALUES ('$titolo', $autore)");
}

function inserisciPrestito($conn, $libro, $utente) {
    $conn->query("INSERT INTO Prestiti (id_libro, id_utente, data_inizio, data_fine_prevista)
                  VALUES ($libro, $utente, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY))");
}

function getPrestitiUtente($conn, $utente) {
    return $conn->query("
        SELECT p.id_prestito, l.titolo, p.restituito
        FROM Prestiti p
        JOIN Libri l ON p.id_libro = l.id_libro
        WHERE p.id_utente = $utente
    ");
}

function restituisciLibro($conn, $id) {
    $conn->query("UPDATE Prestiti SET restituito = 1 WHERE id_prestito = $id");
}

?>
