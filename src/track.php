<?php

require_once 'db.php';

// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: *");

class Track
{



    //if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function createTrack($name, $album_id, $mediaType_Id, $genre_Id, $composer, $milliseconds, $bytes, $price)
    {
        global $dbConn;
        // get posted data
        $minute = $milliseconds * 60000;


        $sql = "INSERT INTO track(Name, AlbumId, MediaTypeId, GenreId, Composer, Milliseconds, Bytes, UnitPrice)
    VALUES(?,?,?,?,?,?,?,?)";
        // dbQuery($sql);
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo json_encode(array('status' => 'SQL Error'));
        } else {
            mysqli_stmt_bind_param($stmt, 'siiisdid', $name, $album_id, $mediaType_Id, $genre_Id, $composer, $minute, $bytes, $price);
            mysqli_stmt_execute($stmt);
            echo json_encode(array('status' => 'Track created'));
        }
    }
    //} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
    function deleteTrack($id)
    {
        $sql = "DELETE FROM track WHERE TrackId = " . $id;
        dbQuery($sql);
        echo json_encode(array('status' => 'Track deleted'));
    }
    //} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    function updateTrack($name, $composer, $price, $mediaType_Id, $genre_Id, $milliseconds, $bytes, $album_id, $id)
    {
        global $dbConn;
        $minute = $milliseconds * 60000;


        $sql = "UPDATE track SET Name = ?, Composer = ?, Milliseconds = ? , UnitPrice = ?, MediaTypeId = ?, GenreId = ?,
    Bytes = ?, AlbumId = ? WHERE TrackId = " . $id;
        // dbQuery($sql);
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo json_encode(array('status' => 'SQL Error'));
        } else {
            mysqli_stmt_bind_param($stmt, 'ssidiiii', $name, $composer, $minute, $price, $mediaType_Id, $genre_Id, $bytes, $album_id);
            mysqli_stmt_execute($stmt);
            echo json_encode(array('status' => 'Track Updated'));
        }
    }
    //} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    function getTrackId($id)
    {
        $sql = "SELECT * FROM track WHERE TrackId = " . $id . " LIMIT 1";
        $result = dbQuery($sql);

        $row = dbFetchAssoc($result);

        echo json_encode($row);
    }
    //} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['name'])) {
    function getTrackName($name)
    {
        $sql = "SELECT track.name AS trackName, album.title AS albumTitle, genre.name AS genre, track.unitPrice, track.trackId, track.composer, track.MediaTypeId
	FROM track
	LEFT JOIN album ON album.albumid=track.albumid
	LEFT JOIN genre ON genre.genreid=track.genreid WHERE track.name Like '%" . $name . "%'";
        $results = dbQuery($sql);
        $rows = array();

        while ($row = dbFetchAssoc($results)) {
            $rows[] = $row;
        }
        echo json_encode($rows);
    }
    // } else {
    function getTrack()
    {
        $sql = "SELECT track.name AS trackName, album.title AS albumTitle, genre.name AS genre, track.unitPrice, track.trackId, track.composer, track.MediaTypeId
	FROM track
	LEFT JOIN album ON album.albumid=track.albumid
	LEFT JOIN genre ON genre.genreid=track.genreid";
        $results = dbQuery($sql);

        $rows = array();

        while ($row = dbFetchAssoc($results)) {
            $rows[] = $row;
        }

        echo json_encode($rows);
    }
}
