<?php
require "dbconnection.php";
$dbcon = createDbConnection();

//Määritellään muuttujat
$youtube = 'Youtube';
$podcasts = 'Podcasts';
$id1 = '-1';
$id2 = '-2';

//Kirjoitetaan sql-lause, joka lisää playlists tauluun Youtube ja Podcasts sarakkeet
$sql = "INSERT INTO playlists (PlaylistId, Name) 
VALUES(:id2, :podcasts), (:id1, :youtube)";

//Luodaan parametrit
$statement = $dbcon->prepare($sql);
$statement->bindParam(':youtube', $youtube);
$statement->bindParam(':podcasts', $podcasts);
$statement->bindParam(':id1', $id1);
$statement->bindParam(':id2', $id2);

$statement->execute();
