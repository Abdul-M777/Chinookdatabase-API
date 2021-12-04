<?php

require_once 'db.php';

class Album
{

    function createAlbum($name, $artist_id)
    {
        global $dbConn;

        $sql = 'INSERT INTO album(Title, ArtistId) VALUES(?,?)';
        // dbQuery($sql);
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            return array('status' => 'SQL Error');
        } else {
            mysqli_stmt_bind_param($stmt, 'si', $name, $artist_id);
            mysqli_stmt_execute($stmt);
            return array('status' => 'Album created');
        }
    }

    function deleteAlbum($id)
    {
        $sql = 'DELETE FROM album WHERE AlbumId = ' . $id;
        dbQuery($sql);
        return array('status' => 'Album deleted');
    }

    function updateAlbum($name, $id)
    {
        global $dbConn;


        $sql = 'UPDATE album SET Title = ? WHERE AlbumId = ' . $id;
        // dbQuery($sql);
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            return array('status' => 'SQL Error');
        } else {
            mysqli_stmt_bind_param($stmt, 's', $name);
            mysqli_stmt_execute($stmt);
            return array('status' => 'Album updated');
        }
    }


    function getAlbumId($id)
    {
        $sql = 'SELECT * FROM album WHERE AlbumId = ' . $id . ' LIMIT 1';
        $result = dbQuery($sql);

        $row = dbFetchAssoc($result);

        return $row;
    }

    function getAlbumName($name)
    {
        $sql = "SELECT artist.name, album.title, album.albumId, artist.artistId FROM album
	LEFT JOIN artist ON album.ArtistId = artist.ArtistID WHERE album.title Like '%" . $name . "%'";
        $results = dbQuery($sql);
        $rows = array();

        while ($row = dbFetchAssoc($results)) {
            $rows[] = $row;
        }
        return $rows;
    }

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

        return $rows;
    }
}
