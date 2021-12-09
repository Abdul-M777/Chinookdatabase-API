<?php

require_once 'db.php';


class Track
{

    function createTrack($name, $album_id, $mediaType_Id, $genre_Id, $composer, $milliseconds, $bytes, $price)
    {
        global $dbConn;
        // get posted data
        $minute = $milliseconds * 60000;

        $name = htmlspecialchars($name, ENT_QUOTES);
        $composer = htmlspecialchars($composer, ENT_QUOTES);





        $sql = 'INSERT INTO track(Name, AlbumId, MediaTypeId, GenreId, Composer, Milliseconds, Bytes, UnitPrice)
    VALUES(?,?,?,?,?,?,?,?)';
        // dbQuery($sql);
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            return array('status' => 'SQL Error');
        } else {
            mysqli_stmt_bind_param($stmt, 'siiisdid', $name, $album_id, $mediaType_Id, $genre_Id, $composer, $minute, $bytes, $price);
            mysqli_stmt_execute($stmt);
            return array('status' => 'Track created');
        }
    }

    function deleteTrack($id)
    {
        $sql = 'DELETE FROM track WHERE TrackId = ' . $id;
        dbQuery($sql);
        return array('status' => 'Track deleted');
    }

    function updateTrack($name, $composer, $price, $mediaType_Id, $genre_Id, $milliseconds, $bytes, $id)
    {
        global $dbConn;
        $minute = $milliseconds * 60000;
        $name = htmlspecialchars($name, ENT_QUOTES);
        $composer = htmlspecialchars($composer, ENT_QUOTES);


        $sql = 'UPDATE track SET Name = ?, Composer = ?, Milliseconds = ? , UnitPrice = ?, MediaTypeId = ?, GenreId = ?,
    Bytes = ? WHERE TrackId = ' . $id;
        // dbQuery($sql);
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            return array('status' => 'SQL Error');
        } else {
            mysqli_stmt_bind_param($stmt, 'ssidiii', $name, $composer, $minute, $price, $mediaType_Id, $genre_Id, $bytes);
            mysqli_stmt_execute($stmt);
            return array('status' => 'Track Updated');
        }
    }

    function getTrackId($id)
    {
        $sql = 'SELECT * FROM track WHERE TrackId = ' . $id . ' LIMIT 1';
        $result = dbQuery($sql);

        $row = dbFetchAssoc($result);

        return $row;
    }

    function getTrackName($name, $p)
    {

        $page = ($p - 1) * 100;

        $sql = "SELECT track.name AS trackName, album.title AS albumTitle, genre.name AS genre, mediatype.name AS mediatype , track.unitPrice, track.trackId, track.composer, track.milliseconds, track.bytes
	FROM track
	LEFT JOIN album ON album.albumid=track.albumid
	LEFT JOIN genre ON genre.genreid=track.genreid
    LEFT JOIN mediatype ON mediatype.mediatypeid=track.mediatypeid WHERE track.name Like '%" . $name . "%' LIMIT 100 OFFSET $page";
        $results = dbQuery($sql);
        $rows = array();

        while ($row = dbFetchAssoc($results)) {
            $rows[] = $row;
        }
        return $rows;
    }

    function getTrack()
    {
        $sql = 'SELECT track.name AS trackName, album.title AS albumTitle, genre.name AS genre, mediatype.name AS mediatype , track.unitPrice, track.trackId, track.composer, track.milliseconds, track.bytes
	FROM track
	LEFT JOIN album ON album.albumid=track.albumid
	LEFT JOIN genre ON genre.genreid=track.genreid
    LEFT JOIN mediatype ON mediatype.mediatypeid=track.mediatypeid';
        $results = dbQuery($sql);

        $rows = array();

        while ($row = dbFetchAssoc($results)) {
            $rows[] = $row;
        }

        return $rows;
    }
}
