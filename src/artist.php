<?php

require_once 'db.php';

class Artist
{

    function createArtist($name)
    {
        global $dbConn;
        $sql = 'INSERT INTO artist(Name) VALUES(?)';
        // dbQuery($sql);
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            return array('status' => 'SQL Error');
        } else {
            mysqli_stmt_bind_param($stmt, 's', $name);
            mysqli_stmt_execute($stmt);
            return array('status' => 'Artist created');
        }
    }
    function deleteArtist($id)
    {

        $sql = 'DELETE FROM artist WHERE ArtistId = ' . $id;
        dbQuery($sql);
        return array('status' => 'artist deleted');
    }


    function updateArtist($id, $name)
    {
        global $dbConn;
        // get posted data

        $sql = 'UPDATE artist SET Name = ? WHERE ArtistId = ' . $id;
        // dbQuery($sql);
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            return array('status' => 'SQL Error');
        } else {
            mysqli_stmt_bind_param($stmt, 's', $name);
            mysqli_stmt_execute($stmt);
            return array('status' => 'Artist Updated');
        }
    }
    //} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    function getArtistId($id)
    {
        global $dbConn;
        $sql = "SELECT * FROM artist WHERE ArtistId = " . $id . " LIMIT 1";
        $result = dbQuery($sql);

        $row = dbFetchAssoc($result);

        return $row;
    }

    //} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['name'])) {
    function getArtistName($name, $p)
    {
        $page = ($p - 1) * 100;


        $sql = "SELECT * FROM artist WHERE Name Like '%" . $name . "%' LIMIT 100 OFFSET $page";
        $results = dbQuery($sql);
        $rows = array();

        while ($row = dbFetchAssoc($results)) {
            $rows[] = $row;
        }
        return $rows;
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

        return $rows;
    }
}
