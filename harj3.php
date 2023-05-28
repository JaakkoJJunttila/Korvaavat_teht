<?php
require "dbconnection.php";
$dbcon = createDbConnection();

//Määritellään muuttujat
$title = 'Sales Support Agent';
$lastNameLetter = '%K';

//Kirjoitetaan SQL-lause, joka etsii työntekijät joiden ammatti on 'Sales Support Agent' ja Sukunimen viimeinen kirjain on 'K'
$sql = "SELECT * FROM employees WHERE Title = :title AND LastName LIKE :lastNameLetter";

//Luodaan parametrit
$statement = $dbcon->prepare($sql);
$statement->bindParam(':title', $title);
$statement->bindParam(':lastNameLetter', $lastNameLetter);

$statement->execute();

//Haetaan kaikki SQL-lauseeseen sopivat tiedot
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

//Määritellään miten tulostus näkyy
$filteredRows = array_map(function($row) {
    return $row["FirstName"]." ".$row["LastName"];
    }, $rows);

//Tulostetaan JSON-muodossa
header('Content-Type: application/json');
echo json_encode($filteredRows, JSON_PRETTY_PRINT);
