<?php

require_once 'db.php';

//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Methods: *");

class Artist
{

    function createArtist($name)
    {

        //if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        //$data = json_decode(file_get_contents("php://input", true));
        //$name =  mysqli_real_escape_string($dbConn, $data->name);
        global $dbConn;
        $sql = "INSERT INTO artist(Name) VALUES(?)";
        // dbQuery($sql);
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo json_encode(array('status' => 'SQL Error'));
        } else {
            mysqli_stmt_bind_param($stmt, 's', $name);
            mysqli_stmt_execute($stmt);
            echo json_encode(array('status' => 'Artist created'));
        }
    }
    function deleteArtist($id)
    {

        $sql = "DELETE FROM artist WHERE ArtistId = " . $id;
        dbQuery($sql);
        echo json_encode(array('status' => 'artist deleted'));
    }
    //} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    function updateArtist($id, $name)
    {
        global $dbConn;
        // get posted data
        //$data = json_decode(file_get_contents("php://input", true));
        //$name =  mysqli_real_escape_string($dbConn, $data->name);
        $sql = "UPDATE artist SET Name = ? WHERE ArtistId = " . $id;
        // dbQuery($sql);
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo json_encode(array('status' => 'SQL Error'));
        } else {
            mysqli_stmt_bind_param($stmt, 's', $name);
            mysqli_stmt_execute($stmt);
            echo json_encode(array('status' => 'Artist Updated'));
        }
    }
    //} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    function getArtistId($id)
    {
        global $dbConn;
        $sql = "SELECT * FROM artist WHERE ArtistId = " . $id . " LIMIT 1";
        $result = dbQuery($sql);

        $row = dbFetchAssoc($result);

        echo json_encode($row);
    }

    //} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['name'])) {
    function getArtistName($name)
    {
        $sql = "SELECT * FROM artist WHERE Name Like '%" . $name . "%'";
        $results = dbQuery($sql);
        $rows = array();

        while ($row = dbFetchAssoc($results)) {
            $rows[] = $row;
        }
        echo json_encode($rows);
    }

    //} else {
    function getArtist()
    {
        $sql = "SELECT * FROM artist";
        $results = dbQuery($sql);
        $rows = array();

        while ($row = dbFetchAssoc($results)) {
            $rows[] = $row;
        }

        echo json_encode($rows);
    }
}
