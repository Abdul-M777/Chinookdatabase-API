<?php

require_once 'db.php';

//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Methods:*");

class Album
{

    function createAlbum($name, $artist_id)
    {
        global $dbConn;
        //if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // get posted data
        // $data = json_decode(file_get_contents("php://input", true));
        // $name = mysqli_real_escape_string($dbConn, $data->name);
        // $artist_id = mysqli_real_escape_string($dbConn, $data->artist_id);

        $sql = "INSERT INTO album(Title, ArtistId) VALUES(?,?)";
        // dbQuery($sql);
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo json_encode(array('status' => 'SQL Error'));
        } else {
            mysqli_stmt_bind_param($stmt, 'si', $name, $artist_id);
            mysqli_stmt_execute($stmt);
            echo json_encode(array('status' => 'Album created'));
        }
    }
    //} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
    function deleteAlbum($id)
    {
        $sql = "DELETE FROM album WHERE AlbumId = " . $id;
        dbQuery($sql);
        echo json_encode(array('status' => 'Album deleted'));
    }
    //} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // get posted data
    function updateAlbum($name, $artist_id, $id)
    {
        global $dbConn;
        // $data = json_decode(file_get_contents("php://input", true));
        // $name = mysqli_real_escape_string($dbConn, $data->name);
        // $artist_id = mysqli_real_escape_string($dbConn, $data->artist_id);

        // Check if artist exist
        $check_artist = "SELECT * FROM artist WHERE ArtistId = " . $artist_id . " LIMIT 1";
        $result = dbQuery($check_artist);

        $row = dbFetchAssoc($result);

        if ($row == null) {
            echo json_encode("Artist don't exist in the database");
        } else {


            $sql = "UPDATE album SET Title = ?, ArtistId = ? WHERE AlbumId = " . $id;
            // dbQuery($sql);
            $stmt = mysqli_stmt_init($dbConn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo json_encode(array('status' => 'SQL Error'));
            } else {
                mysqli_stmt_bind_param($stmt, 'si', $name, $artist_id);
                mysqli_stmt_execute($stmt);
                echo json_encode(array('status' => 'Album updated'));
            }
        }
    }
    //} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    function getAlbumId($id)
    {
        $sql = "SELECT * FROM album WHERE AlbumId = " . $id . " LIMIT 1";
        $result = dbQuery($sql);

        $row = dbFetchAssoc($result);

        echo json_encode($row);
    }
    //} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['name'])) {
    function getAlbumName($name)
    {
        $sql = "SELECT artist.name, album.title, album.albumId, artist.artistId FROM album
	LEFT JOIN artist ON album.ArtistId = artist.ArtistID WHERE album.title Like '%" . $name . "%'";
        $results = dbQuery($sql);
        $rows = array();

        while ($row = dbFetchAssoc($results)) {
            $rows[] = $row;
        }
        echo json_encode($rows);
    }
    //} else {
    function getAlbums()
    {
        $sql = " SELECT artist.name, album.title, album.albumId, artist.artistId
	FROM album
	LEFT JOIN artist ON album.ArtistId = artist.ArtistID";
        $results = dbQuery($sql);

        $rows = array();

        while ($row = dbFetchAssoc($results)) {
            $rows[] = $row;
        }

        echo json_encode($rows);
    }
}
